<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Data\OrderData;

interface OrderServiceInterface
{
    /**
     * @param int $userId
     * @return OrderData[]
     */
    public function listOrdersByUserId(int $userId): array;
}