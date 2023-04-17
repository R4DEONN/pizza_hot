<?php
declare(strict_types=1);

namespace App\Model;

class Product 
{
    private ?int $id;
    private string $title;
    private string $subtitle;
    private int $price;
    private string $image_url;

    public function __construct(?int $id, string $title, string $subtitle, int $price, string $image_url)
    {
        $this->id = $id;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->price = $price;
        $this->image_url = $image_url;
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
        return $this->image_url;
    }
}