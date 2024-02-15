<?php

namespace App\Controller;

use App\Form\DTO\CalculatePriceDTO;
use App\Form\Type\CalculatePriceType;
use App\Interactor\PriceCalculateInteractor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PriceController extends BaseController
{
    public function __construct(private PriceCalculateInteractor $interactor)
    {
    }

    public function calculateAction(Request $request, ValidatorInterface $validator): JsonResponse
    {
        try {
            $dto = new CalculatePriceDTO();
            $form = $this->createForm(CalculatePriceType::class, $dto);
            $this->submitForm($request, $form, $validator);

            return new JsonResponse([
                'result' => $this->interactor->calculatePrice(
                    productId: $dto->getProduct(),
                    taxNumber: $dto->getTaxNumber(),
                    promotionalCodeName: $dto->getCouponCode(),
                )
            ]);
        } catch (\Throwable $exception) {
            return $this->getResponseByException($exception);
        }
    }
}