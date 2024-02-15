<?php

namespace App\Controller;

use App\Form\DTO\PurchaseDTO;
use App\Form\Type\PurchaseType;
use App\Interactor\PurchaseInteractor;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PurchaseController extends BaseController
{
    public function __construct(private PurchaseInteractor $interactor)
    {
    }

    public function purchaseAction(Request $request, ValidatorInterface $validator): JsonResponse
    {
        try {
            $dto = new PurchaseDTO();
            $form = $this->createForm(PurchaseType::class, $dto);
            $this->submitForm($request, $form, $validator);

            $this->interactor->purchase(
                productId: $dto->getProduct(),
                taxNumber: $dto->getTaxNumber(),
                paymentProcessor: $dto->getPaymentProcessor(),
                promotionalCodeName: $dto->getCouponCode(),
            );

            return new JsonResponse(['result' => []]);
        } catch (\Throwable $exception) {
            return $this->getResponseByException($exception);
        }
    }
}