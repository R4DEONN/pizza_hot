<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;

class UserService implements UserServiceInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(string $firstName, string $lastName, string $email, string $phone, ?string $imageUrl): void
    {
        $user = new User(
            null,
            $firstName,
            $lastName,
            $email,
            $phone,
            $imageUrl,
            0
        );

        $this->userRepository->store($user);
    }
}