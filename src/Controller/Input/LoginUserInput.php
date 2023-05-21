<?php
declare(strict_types=1);

namespace App\Controller\Input;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class LoginUserInput extends AbstractType
{
    private string $email;
    private string $password;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('email', EmailType::class, [
                    'attr' => [
                        'class' => 'form-row__input'
                    ]
                ])
                ->add('password', PasswordType::class, [
                    'attr' => [
                        'class' => 'form-row__input'
                    ]
                ])
                ->add('login', SubmitType::class, [
                    'attr' => [
                        'class' => 'form-row__submit'
                    ]
                ]);

    }
}