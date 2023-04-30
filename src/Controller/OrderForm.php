<?php
declare(strict_types=1);

namespace App\Controller;

use App\Database\ConnectionProvider;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class OrderForm extends AbstractController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(int $productId): Response
    {
        $pizza = $this->productRepository->findById($productId);

        $pizzaView = [
            'id' => $pizza->getId(),
            'title' => $pizza->getTitle(),
            'subtitle' => $pizza->getSubtitle(),
            'price' => $pizza->getPrice(),
            'imageUrl' => $pizza->getImageUrl()
        ];

        $host = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        return $this->render('product/order.html.twig', [
            'pizza' => $pizzaView,
            'host' => $host
        ]);
    }
}