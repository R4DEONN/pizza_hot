<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Input\LoginUserInput;
use App\Service\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    private UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        if ($this->getUser())
        {
            return $this->redirectToRoute('index');
        }

        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('auth/login.html.twig', [
            'error' => $error
        ]);
    }

    public function logout(): void
    {
        $this->redirectToRoute('signin');
    }
}