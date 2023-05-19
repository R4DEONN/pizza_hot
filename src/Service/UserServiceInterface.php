<?php
declare(strict_types=1);

namespace App\Service;

interface UserServiceInterface
{
    public function createUser(string $firstName, string $lastName, string $email, string $phone, string $imageUrl);
}