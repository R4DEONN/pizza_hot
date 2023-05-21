<?php
declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;

interface UserRepositoryInterface
{
    public function store(User $user): int;

    public function findByEmail(string $email): ?User;
}