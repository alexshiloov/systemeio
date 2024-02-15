<?php

namespace App\Controller;

use App\Exception\FormErrorsException;
use App\Exception\PaymentException;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class BaseController extends AbstractController
{
    public function submitForm(Request $request, FormInterface $form, ValidatorInterface $validator): void
    {
        /** @var array<string, mixed> $data */
        $data = json_decode((string) $request->getContent(), true);
        if (json_last_error()) {
            throw new \JsonException();
        }

        $form->submit($data);
        $errors = $validator->validate($form->getViewData());
        if (count($errors) > 0) {
            throw new FormErrorsException($errors);
        }
    }

    public function getResponseByException(\Throwable $exception): JsonResponse
    {
        if ($exception instanceof JsonException) {
            return new JsonResponse(['error' => 'Invalid json: ' . json_last_error_msg()], 400);
        }
        if ($exception instanceof FormErrorsException) {
            $exceptionMessages = [];
            foreach ($exception->getViolationList() as $error) {
                $exceptionMessages[] = $error->getMessage();
            }

            return new JsonResponse(['error' => implode(' .', $exceptionMessages)], 400);
        }

        if ($exception instanceof PaymentException) {
            return new JsonResponse(['error' => 'Ошибка при оплате'], 400);
        }

        return new JsonResponse(['error' => 'Неизвестная ошибка'], 500);
    }
}