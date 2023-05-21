<?php
declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use App\Entity\Order;

class OrderRepository
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Order::class);
    }

    public function store(Order $order): void
    {
        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }

    /**
     * @param int $userId
     * @return Order[]
     */
    public function listById(int $userId): array
    {
        return $this->repository->findBy(
            array('userId' => $userId),
            array('orderedAt' => 'DESC')
        );
    }
}