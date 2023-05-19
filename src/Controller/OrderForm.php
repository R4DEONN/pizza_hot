<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class OrderForm extends AbstractController
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index(int $productId): Response
    {
        $pizzaView = $this->productService->findById($productId);

        $host = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        return $this->render('product/order.html.twig', [
            'pizza' => $pizzaView,
            'host' => $host
        ]);
    }
}