<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class ProductRepository
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Product::class);
    }

    /**
     * @return Product[]
     */
    public function listAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @param int $id
     * @return ?Product
     */
    public function findById(int $id): ?Product
    {
        return $this->repository->findOneBy(['id' => (string) $id]);
    }
}