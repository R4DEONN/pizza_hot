<?php
declare(strict_types=1);

namespace App\Controller;

use App\Database\ProductTable;
use App\Database\ConnectionProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
class OrderForm extends AbstractController
{
    private ProductTable $productTable;

    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->productTable = new ProductTable($connection);
    }

    public function index(int $productId): Response
    {
        $vars['pizza'] = $this->productTable->productById($productId);
        $vars['host'] = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        return $this->render('product/order.html.twig', $vars);
    }
}