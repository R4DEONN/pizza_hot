<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepositoryInterface;
use App\Service\PasswordHasher;
use Doctrine\Instantiator\Exception\InvalidArgumentException;

class UserService implements UserServiceInterface
{
    private UserRepositoryInterface $userRepository;
    private PasswordHasher $passwordHasher;

    public function __construct(UserRepositoryInterface $userRepository, PasswordHasher $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function register(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $phone,
        ?string $imageUrl): void
    {
        $existingUser = $this->userRepository->findByEmail($email);
        if ($existingUser !== null)
        {
            throw new InvalidArgumentException("User with email $email already exists");
        }

        $user = new User(
            null,
            $firstName,
            $lastName,
            $email,
            $this->passwordHasher->hash($password),
            $phone,
            $imageUrl,
            0
        );

        $this->userRepository->store($user);
    }
}