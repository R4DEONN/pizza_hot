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
        $user = $this->getUser();
        $pizzasView = $this->productService->listProduct();
        foreach ($pizzasView as $pizza)
        {
            $pizza->setCanRemove($user->isAdmin());
        }

        $host = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        return $this->render('product/catalog.html.twig', [
           'pizzas' => $pizzasView,
           'host' => $host
        ]);
    }

    public function deleteProduct(int $productId): Response
    {
        $user = $this->getUser();
        $product = $this->productService->findById($productId);
        if ($product === null)
        {
            return $this->redirect('index');
        }
        if (!$user->isAdmin())
        {
            throw $this->createNotFoundException();
        }
        $this->productService->deleteProduct($productId);
        
        return $this->redirectToRoute('index');
    }
}