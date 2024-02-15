<?php

namespace App\Interactor;

use App\Enum\PaymentProcessorEnum;
use App\Enum\TaxCountryEnum;
use App\Processor\Payment\PaymentProcessorFactory;
use App\Processor\PriceCalculator;
use App\Repository\ProductRepository;
use App\Repository\PromotionalCodeRepository;

class PurchaseInteractor
{
    public function __construct(
        private PriceCalculator $priceCalculator,
        private ProductRepository $productRepository,
        private PromotionalCodeRepository $promotionalCodeRepository,
        private PaymentProcessorFactory $paymentProcessorFactory,
    ) {
    }

    public function purchase(
        int $productId,
        string $taxNumber,
        string $paymentProcessor,
        ?string $promotionalCodeName,
    ): void
    {
        $taxCountryEnum = TaxCountryEnum::getFromTaxNumber($taxNumber);
        if (null === $taxCountryEnum) {
            throw new \Exception('Internal error. Cannot detect tax number country code. Value:' . $taxNumber);
        }

        $productPrice = $this->productRepository->getProductPrice($productId);
        if (null === $productPrice) {
            throw new \Exception('Internal error. Cannot detect product price. Value:' . $productId);
        }

        if (!PaymentProcessorEnum::isValid($paymentProcessor)) {
            throw new \Exception('Internal error. Cannot detect payment processor. Value:' . $paymentProcessor);
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

        $price = $this->priceCalculator->calculate(
            taxCountryEnum: $taxCountryEnum,
            productPrice: $productPrice,
            promotionalCodeDTO:$promotionalCode,
        );

        $this->paymentProcessorFactory
            ->get(new PaymentProcessorEnum($paymentProcessor))
            ->pay($price)
        ;
    }
}