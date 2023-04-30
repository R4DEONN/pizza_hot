<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\ConnectionProvider;
use App\Entity\User;
use App\Repository\UserRepository;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private const EMAIL = "email";
    private const LAST_NAME = "lastName";
    private const FIRST_NAME = "firstName";
    private const PHONE = "phone";

    private UserRepository $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): Response
    {
        $vars['host'] = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        return $this->render('auth/register.html.twig', $vars);
    }

    public function createUser(Request $request): Response
    {
        $user = new User(
            null, 
            $request->get(self::FIRST_NAME), 
            $request->get(self::LAST_NAME),  
            $request->get(self::EMAIL),  
            $request->get(self::PHONE), 
            null,
            0
        );

        $userId = $this->userRepository->store($user);
        
        return $this->redirectToRoute(
            'catalog',
            [],
            Response::HTTP_SEE_OTHER
        );
    }}