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

    private UserTable $userTable;

    private const USER_ID = "user_id";
    private const EMAIL = "email";
    private const LAST_NAME = "lastName";
    private const FIRST_NAME = "firstName";
    private const PHONE = "phone";
    private const AVATAR = "avatar";
    private const ERROR = "error";
    private const NAME = "name";
    private const TMP_NAME = "tmp_name";
    
    public function __construct()
    {
        $connection = ConnectionProvider::connectDatabase();
        $this->userTable = new UserTable($connection);
    }

    public function index(): Response
    {
        require __DIR__ . '/../View/register.php';
    }

    public function createUser(array $requestData): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
        {
            $this->writeRedirectSeeOther('/');
            return;
        }

        $user = new User(
            null, 
            $requestData[self::FIRST_NAME], 
            $requestData[self::LAST_NAME],  
            $requestData[self::EMAIL],  
            $requestData[self::PHONE], 
            null
        );
        $userId = $this->userTable->add($user);
        $this->addAvatar($userId, $requestData[self::AVATAR]);
        $redirectUrl = "/show_user.php?user_id=$userId";
        $this->writeRedirectSeeOther($redirectUrl);
    }

    private function addAvatar(int $userId, array $avatar): void
    {
        if (!empty($avatar) && $avatar[self::ERROR] == UPLOAD_ERR_OK) 
        {
            $extension = pathinfo($avatar[self::NAME], PATHINFO_EXTENSION);
            $fileName = "avatar$userId.$extension";
            $fileFullPath = "/src/View/uploads/$fileName"; 
            rename($avatar[self::TMP_NAME], $fileFullPath);
            $this->userTable->updateAvatar($userId, $fileName); 
        }
    }

    private function writeRedirectSeeOther(string $url): void
    {
        header('Location: ' . $url, true, self::HTTP_STATUS_303_SEE_OTHER);
    }
}