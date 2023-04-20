<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\ConnectionProvider;
use App\Database\UserTable;
use App\Model\User;
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

    private UserTable $userTable;
    
    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->userTable = new UserTable($connection);
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
            null
        );
       if (!$userId = $this->userTable->add($user))
       {
           throw new RuntimeException('Пользователь не был добавлен в базу данных');
       }
        
        return $this->redirectToRoute(
            'catalog',
            [],
            Response::HTTP_SEE_OTHER
        );
    }}