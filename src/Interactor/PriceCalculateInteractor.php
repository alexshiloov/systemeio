<?php

namespace App\Interactor;

use App\Enum\TaxCountryEnum;
use App\Processor\PriceCalculator;
use App\Repository\ProductRepository;
use App\Repository\PromotionalCodeRepository;

class PriceCalculateInteractor
{
    public function __construct(
        private PriceCalculator $priceCalculator,
        private ProductRepository $productRepository,
        private PromotionalCodeRepository $promotionalCodeRepository,
    ) {
    }

    public function calculatePrice(
        int $productId,
        string $taxNumber,
        ?string $promotionalCodeName,
    ): float
    {
        $taxCountryEnum = TaxCountryEnum::getFromTaxNumber($taxNumber);
        if (null === $taxCountryEnum) {
            throw new \Exception('Internal error. Cannot detect tax number country code. Value:' . $taxNumber);
        }

        $productPrice = $this->productRepository->getProductPrice($productId);
        if (null === $productPrice) {
            throw new \Exception('Internal error. Cannot detect product price. Value:' . $productId);
        }

        $promotionalCode = null;
        if (null !== $promotionalCodeName) {
            $promotionalCode = $this->promotionalCodeRepository->getPromotionalCodeByName($promotionalCodeName);
            if (null === $promotionalCode) {
                throw new \Exception(
                    'Internal error. Cannot detect promotional code. Value:' . $promotionalCodeName
                );
            }
        }

        return $this->priceCalculator->calculate(
            taxCountryEnum: $taxCountryEnum,
            productPrice: $productPrice,
            promotionalCodeDTO:$promotionalCode,
        );
    }
}