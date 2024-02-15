<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(
        ManagerRegistry $registry,
    ) {
        parent::__construct($registry, Product::class);
    }

    public function isExist(int $id): bool
    {
        return null !== $this->find($id);
    }

    public function getProductPrice(int $id): ?float
    {
        /** @var Product|null $entity */
        $entity = $this->find($id);

        return $entity?->getAmount();
    }
}