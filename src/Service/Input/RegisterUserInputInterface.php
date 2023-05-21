<?php
declare(strict_types=1);

namespace Service\Input;

interface RegisterUserInputInterface
{
    public function getFirstName(): string;
    public function getLastName(): string;
    public function getEmail(): string;
    public function getPassword(): string;
    public function getPhone(): string;
    public function getAvatar(): ?string;
}