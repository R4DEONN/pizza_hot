<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Product;
use App\Database\ProductTable;
use App\Database\ConnectionProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class StorefrontController extends AbstractController
{
    private ProductTable $productTable;

    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->productTable = new ProductTable($connection);
    }

    public function index(): Response
    {
        $vars['pizzas'] = $this->productTable->list();
        return $this->render('product/catalog.html.twig', $vars);
    }
}