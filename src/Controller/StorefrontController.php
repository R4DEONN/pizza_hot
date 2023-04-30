<?php
declare(strict_types=1);

namespace App\Controller;

use App\Database\ConnectionProvider;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class StorefrontController extends AbstractController
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(): Response
    {
        $pizzas = $this->productRepository->listAll();

        $pizzasView = [];
        foreach ($pizzas as $pizza)
        {
            $pizzasView[] = [
                'id' => $pizza->getId(),
                'title' => $pizza->getTitle(),
                'subtitle' => $pizza->getSubtitle(),
                'price' => $pizza->getPrice(),
                'imageUrl' => $pizza->getImageUrl()
            ];
        }

        $host = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        return $this->render('product/catalog.html.twig', [
           'pizzas' => $pizzasView,
           'host' => $host
        ]);
    }
}