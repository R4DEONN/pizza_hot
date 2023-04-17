<?php

declare(strict_types=1);

namespace App\Controller;

use App\Database\ConnectionProvider;
use App\Database\UserTable;
use App\Model\User;
use App\View\PhpTemplateEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private const HTTP_STATUS_303_SEE_OTHER = 303;
    private const USER_ID = "user_id";
    private const EMAIL = "email";
    private const LAST_NAME = "lastName";
    private const FIRST_NAME = "firstName";
    private const PHONE = "phone";
    private const AVATAR = "avatar";
    private const ERROR = "error";
    private const NAME = "name";
    private const TMP_NAME = "tmp_name";

    private UserTable $userTable;
    
    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->userTable = new UserTable($connection);
    }

    public function index(): Response
    {
        $contents = PhpTemplateEngine::render('register.php');
        return new Response($contents);
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
        $userId = $this->userTable->add($user);
        
        return $this->redirectToRoute(
            'catalog',
            [],
            Response::HTTP_SEE_OTHER
        );
    }

    private static function writeRedirectSeeOther(string $url): void
    {
        header('Location: ' . $url, true, self::HTTP_STATUS_303_SEE_OTHER);
    }
}