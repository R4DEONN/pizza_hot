<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\ProductRepository;
use App\Service\Data\ProductData;

class ProductService implements ProductServiceInterface
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function findById(int $id): ProductData
    {
        $pizza = $this->productRepository->findById($id);

        return new ProductData(
            $pizza->getId(),
            $pizza->getTitle(),
            $pizza->getSubtitle(),
            $pizza->getPrice(),
            $pizza->getImageUrl()
        );
    }

    public function listProduct(): array
    {
        $pizzas = $this->productRepository->listAll();

        $pizzasView = [];
        foreach ($pizzas as $pizza)
        {
            $pizzasView[] = new ProductData(
                $pizza->getId(),
                $pizza->getTitle(),
                $pizza->getSubtitle(),
                $pizza->getPrice(),
                $pizza->getImageUrl()
            );
        }
        return $pizzasView;
    }
}