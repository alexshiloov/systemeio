<?php

namespace App\Repository;

use App\DTO\PromotionalCodeDTO;
use App\Entity\PromotionalCode;
use App\Enum\PromotionalCodeTypeEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PromotionalCodeRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, PromotionalCode::class);
    }

    public function isCouponExist(string $value): bool
    {
        return null !== $this->findOneBy(['name' => $value]);
    }

    public function getPromotionalCodeByName(string $name): ?PromotionalCodeDTO
    {
        /** @var PromotionalCode|null $entity */
        $entity = $this->findOneBy(['name' => $name]);
        if (null === $entity) {
            return null;
        }

        return new PromotionalCodeDTO(
            type: new PromotionalCodeTypeEnum($entity->getType()),
            name: $entity->getName(),
            amount: $entity->getValue(),
        );
    }
}