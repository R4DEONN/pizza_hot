<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\Product;
use App\Database\ProductTable;
use App\Database\ConnectionProvider;
use App\View\PhpTemplateEngine;
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
        $vars['rows'] = $this->productTable->getAllProduct();
        $contents = PhpTemplateEngine::render('catalog.php', $vars);
        return new Response($contents);
    }
}