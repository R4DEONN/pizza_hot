<?php
declare(strict_types=1);

namespace App\Controller\Input;

use Service\Input\RegisterUserInputInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterUserInput extends AbstractType implements RegisterUserInputInterface
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private string $phone;
    private ?string $avatar;

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('firstName', TextType::class, [
                    'attr' => [
                        'class' => 'form-row__input'
                    ]
                ])
                ->add('lastName', TextType::class, [
                    'attr' => [
                        'class' => 'form-row__input'
                    ]
                ])
                ->add('email', EmailType::class, [
                    'attr' => [
                        'class' => 'form-row__input'
                    ]
                ])
                ->add('password', PasswordType::class, [
                    'attr' => [
                        'class' => 'form-row__input'
                    ]
                ])
                ->add('phone', TelType::class, [
                    'attr' => [
                        'class' => 'form-row__input'
                    ]
                ])
                ->add('avatar', FileType::class, [
                    'attr' => [
                        'accept' => 'image/png,image/gif,image/jpeg'
                    ]
                ])
                ->add('register', SubmitType::class, [
                    'attr' => [
                        'class' => 'form-row__submit'
                    ]
                ]);
    }
}