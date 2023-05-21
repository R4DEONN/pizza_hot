<?php

declare(strict_types=1);

namespace App\Entity;

class User
{
   private ?int $id;
   private string $firstName;
   private string $lastName;
   private string $email;
   private string $password;
   private string $phone;
   private ?string $avatarUrl;
   private int $role;

   public function __construct(?int $id, string $firstName, string $lastName, string $email, string $password, string $phone, ?string $avatarPath, int $role)
   {
       $this->id = $id;
       $this->firstName = $firstName;
       $this->lastName = $lastName;
       $this->email = $email;
       $this->password = $password;
       $this->phone = $phone;
       $this->avatarUrl = $avatarPath;
       $this->role = $role;
   }

   public function getId(): ?int
   {
       return $this->id;
   }

   public function getFirstName(): string
   {
       return $this->firstName;
   }

   public function getLastName(): string
   {
       return $this->lastName;
   }


   public function getEmail(): string
   {
       return $this->email;
   }

   public function getPassword(): string
   {
       return $this->password;
   }

   public function getPhone(): string
   {
       return $this->phone;
   }

   public function getAvatarUrl(): ?string
   {
       return $this->avatarUrl;
   }

   public function getRole(): int
   {
       return $this->role;
   }
}