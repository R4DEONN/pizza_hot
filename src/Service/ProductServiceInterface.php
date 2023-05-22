<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Service\Data\ProductData;

interface ProductServiceInterface
{
    public function findById(int $id): ProductData;
    public function listProduct(): array;
    public function create(string $title, string $subtitle, int $price, string $image): void;
    public function deleteProduct(int $id): void;
}