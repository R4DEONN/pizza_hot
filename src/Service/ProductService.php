<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\Data\ProductData;

class ProductService implements ProductServiceInterface
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function findById(int $id): ?ProductData
    {
        $pizza = $this->productRepository->findById($id);

        if ($pizza === null)
        {
            throw new \InvalidArgumentException("Пицца с номером $id не найдена");
        }

        return new ProductData(
            $pizza->getId(),
            $pizza->getTitle(),
            $pizza->getSubtitle(),
            $pizza->getPrice(),
            $pizza->getImageUrl(),
            false
        );
    }

    /**
     * @return ProductData[]
     */
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
                $pizza->getImageUrl(),
                false
            );
        }
        return $pizzasView;
    }

    public function create(
        string $title,
        string $subtitle,
        int $price,
        string $image): void
    {
        $product = new Product(
            null,
            $title,
            $subtitle,
            $price,
            $image
        );

        $this->productRepository->add($product);
    }

    public function deleteProduct(int $id): void
    {
        $product = $this->productRepository->findById($id);
        if ($product === null)
        {
            return;
        }

        $this->productRepository->delete($product);
    }
}