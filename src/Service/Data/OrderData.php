<?php
declare(strict_types=1);

namespace App\Service\Data;

class OrderData
{
    private ?int $id;
    private string $productName;
    private int $price;
    private \DateTimeImmutable $orderedAt;

    public function __construct(?int $id, string $productName, int $price, \DateTimeImmutable $orderedAt)
    {
        $this->id = $id;
        $this->productName = $productName;
        $this->price = $price;
        $this->orderedAt = $orderedAt;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getOrderedAt(): \DateTimeImmutable
    {
        return $this->orderedAt;
    }
}