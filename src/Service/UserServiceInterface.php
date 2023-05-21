<?php
declare(strict_types=1);

namespace App\Service;

interface UserServiceInterface
{
    public function register(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $phone,
        ?string $imageUrl): void;
}