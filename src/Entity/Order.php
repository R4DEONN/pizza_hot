<?php
declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;

class Order
{
    private ?int $id;
    private string $productName;
    private int $price;
    private DateTimeImmutable $orderedAt;
    private int $userId;

    public function __construct(?int $id, string $productName, int $price, int $userId)
    {
        $this->id = $id;
        $this->productName = $productName;
        $this->price = $price;
        $original = new DateTimeImmutable("now", new \DateTimeZone('UTC'));
        $timezone = timezone_name_from_abbr("Europe/Moscow", 3*3600, 0);
        $modified = $original->setTimezone(new \DateTimeZone($timezone));
        $this->orderedAt = $modified;
        $this->userId = $userId;
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
     * @return DateTimeImmutable
     */
    public function getOrderedAt(): DateTimeImmutable
    {
        return $this->orderedAt;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}