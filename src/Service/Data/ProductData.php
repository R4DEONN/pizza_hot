<?php
declare(strict_types=1);

namespace App\Service\Data;

class ProductData
{
    private ?int $id;
    private string $title;
    private string $subtitle;
    private int $price;
    private string $imageUrl;

    public function __construct(
        ?int $id,
        string $title,
        string $subtitle,
        int $price,
        string $imageUrl,
        ?bool $canRemove)
    {
        $this->id = $id;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->price = $price;
        $this->imageUrl = $imageUrl;
        $this->canRemove = $canRemove;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'subtitle' => $this->getSubtitle(),
            'price' => $this->getPrice(),
            'imageUrl' => $this->getImageUrl(),
        ];
    }
}