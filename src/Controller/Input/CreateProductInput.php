<?php
declare(strict_types=1);

namespace App\Controller\Input;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateProductInput extends AbstractType
{
    private string $title;
    private string $subtitle;
    private int $price;
    private string $image;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    /**
     * @param string $subtitle
     */
    public function setSubtitle(string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('title', TextType::class, [
                    'attr' => [
                        'class' => 'form-row__input'
                    ]
                ])
                ->add('subtitle', TextType::class, [
                    'attr' => [
                        'class' => 'form-row__input'
                    ]
                ])
                ->add('price', NumberType::class, [
                    'attr' => [
                        'class' => 'form-row__input'
                    ]
                ])
                ->add('image', FileType::class, [
                    'attr' => [
                        'accept' => 'image/png,image/gif,image/jpeg'
                    ]
                ])
                ->add('create', SubmitType::class, [
                    'attr' => [
                        'class' => 'form-row__submit'
                    ]
                ]);
    }
}