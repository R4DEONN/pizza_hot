<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class OrderHistory extends AbstractController
{
    private OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function history(): Response
    {
        $user = $this->getUser();
        $products = $this->orderService->listOrdersByUserId($user->getId());
        return $this->render('order/list.html.twig', [
            'products' => $products
        ]);
    }
}