<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\OrderServiceInterface;
use App\Service\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class OrderForm extends AbstractController
{
    private ProductServiceInterface $productService;
    private OrderServiceInterface $orderService;

    public function __construct(ProductServiceInterface $productService, OrderServiceInterface $orderService)
    {
        $this->productService = $productService;
        $this->orderService = $orderService;
    }

    public function index(int $productId): Response
    {
        $user = $this->getUser();
        $pizzaView = $this->productService->findById($productId);

        $this->orderService->createOrder(
            $pizzaView->getTitle(),
            $pizzaView->getPrice(),
            $user->getId(),
        );

        return $this->render('product/order.html.twig', [
            'pizza' => $pizzaView,
        ]);
    }
}