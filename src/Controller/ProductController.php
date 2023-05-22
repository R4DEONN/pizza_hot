<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Input\CreateProductInput;
use App\Service\ImageServiceInterface;
use App\Service\ProductServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    private ProductServiceInterface $productService;
    private ImageServiceInterface $imageService;

    public function __construct(ProductServiceInterface $productService, ImageServiceInterface $imageService)
    {
        $this->productService = $productService;
        $this->imageService = $imageService;
    }

    public function create(Request $request): Response
    {
        $input = new CreateProductInput();
        $form = $this->createForm(CreateProductInput::class, $input);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $imageData = $form->get('image')->getData();
            $imagePath = null;
            if ($imageData !== null)
            {
                $imagePath = $this->imageService->moveImageToUploadsAndGetPath($imageData);
            }
            $input = $form->getData();
            $this->productService->create(
                $input->getTitle(),
                $input->getSubtitle(),
                $input->getPrice(),
                $imagePath
            );

            return $this->redirectToRoute('catalog');
        }

        return $this->render('product/createProduct.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}