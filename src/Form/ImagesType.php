<?php

namespace App\Form;

use App\Entity\Games;
use App\Entity\Images;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('link', FileType::class, [
                'label' => 'Image (PNG, JPEG file)',
                'mapped' => false,
                'required' => true,
            ])
            ->add('title', CheckboxType::class, [
                'label' => 'Title',
                'required' => false,
            ])
            ->add('game', EntityType::class, [
                'class' => Games::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Images::class,
        ]);
    }
}
