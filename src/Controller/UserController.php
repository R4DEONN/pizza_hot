<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ImageServiceInterface;
use App\Service\UserServiceInterface;
use App\Controller\Input\RegisterUserInput;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private UserServiceInterface $userService;
    private ImageServiceInterface $imageService;
    
    public function __construct(UserServiceInterface $userService, ImageServiceInterface $imageService)
    {
        $this->userService = $userService;
        $this->imageService = $imageService;
    }

    public function index(): Response
    {
        return $this->redirectToRoute('catalog');
//        $vars['host'] = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
//        return $this->render('auth/register.html.twig', $vars);
    }

    public function register(Request $request): Response
    {
        $input = new RegisterUserInput();
        $form = $this->createForm(RegisterUserInput::class, $input, [
            'action' => $this->generateUrl('signup')
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $imageData = $form->get('avatar')->getData();
            $imagePath = null;
            if ($imageData !== null)
            {
                $imagePath = $this->imageService->moveImageToUploadsAndGetPath($imageData);
            }
            $input = $form->getData();
            $this->userService->register(
                $input->getFirstName(),
                $input->getLastName(),
                $input->getEmail(),
                $input->getPassword(),
                $input->getPhone(),
                $imagePath
            );

            return $this->redirectToRoute('signin');
        }

        return $this->render('auth/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}