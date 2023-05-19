<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ImageServiceInterface;
use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private const EMAIL = "email";
    private const LAST_NAME = "lastName";
    private const FIRST_NAME = "firstName";
    private const PHONE = "phone";

    private UserServiceInterface $userService;
    private ImageServiceInterface $imageService;
    
    public function __construct(UserServiceInterface $userService, ImageServiceInterface $imageService)
    {
        $this->userService = $userService;
        $this->imageService = $imageService;
    }

    public function index(): Response
    {
        $vars['host'] = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        return $this->render('auth/register.html.twig', $vars);
    }

    public function createUser(Request $request): Response
    {
        $imagePath = (isset($_FILES['avatar'])) ? $this->imageService->moveImageToUploads($_FILES['avatar']) : null;

        $this->userService->createUser(
            $request->get(self::FIRST_NAME),
            $request->get(self::LAST_NAME),  
            $request->get(self::EMAIL),  
            $request->get(self::PHONE),
            $imagePath,
        );

        return $this->redirectToRoute(
            'catalog',
            [],
            Response::HTTP_SEE_OTHER
        );
    }
}