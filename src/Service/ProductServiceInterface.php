<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Data\ProductData;

interface ProductServiceInterface
{
    public function findById(int $id): ProductData;
    public function listProduct(): array;
}