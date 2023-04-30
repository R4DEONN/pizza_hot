<?php

declare(strict_types=1);

namespace App\Entity;

class User
{
   private ?int $id;
   private string $firstName;
   private string $lastName;
   private string $email;
   private string $phone;
   private ?string $avatarUrl;
   private int $admin;

   public function __construct(?int $id, string $firstName, string $lastName, string $email, string $phone, ?string $avatarPath, int $admin)
   {
       $this->id = $id;
       $this->firstName = $firstName;
       $this->lastName = $lastName;
       $this->email = $email;
       $this->phone = $phone;
       $this->avatarUrl = $avatarPath;
       $this->admin = $admin;
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

   public function getPhone(): string
   {
       return $this->phone;
   }

   public function getAvatarUrl(): ?string
   {
       return $this->avatarUrl;
   }

   public function getAdmin(): int
   {
       return $this->admin;
   }
}