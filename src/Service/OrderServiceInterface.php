<?php
declare(strict_types=1);

namespace App\Service;

interface OrderServiceInterface
{
    public function listOrdersByUserId(int $userId): array;
}