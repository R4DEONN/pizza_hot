<?php
declare(strict_types=1);

namespace App\Controller;

use App\Service\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class StorefrontController extends AbstractController
{
    private ProductServiceInterface $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index(): Response
    {
        $pizzasView = $this->productService->listProduct();

        $host = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        return $this->render('product/catalog.html.twig', [
           'pizzas' => $pizzasView,
           'host' => $host
        ]);
    }
}