<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Service\Data\OrderData;

class OrderService implements OrderServiceInterface
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    public function createOrder(string $productName, int $price, int $userId)
    {
        $order = new Order(
            null,
            $productName,
            $price,
            $userId,
        );
        $this->orderRepository->store($order);
    }

    /**
     * @param int $userId
     * @return OrderData[]
     */
    public function listOrdersByUserId(int $userId): array
    {
        $orders = $this->orderRepository->listOrdersByUserId($userId);

        $ordersView = [];
        foreach ($orders as $order)
        {
            $ordersView[] = new OrderData(
                $order->getId(),
                $order->getProductName(),
                $order->getPrice(),
                $order->getOrderedAt()
            );
        }

        return $ordersView;
    }
}