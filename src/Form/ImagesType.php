<?php

namespace App\Form;

use App\Entity\Games;
use App\Entity\Images;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                'label' => 'Image (PNG, JPEG, MP4 files)',
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\File([
                        'maxSize' => '2048k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'video/mp4',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PNG, JPEG or MP4 file',
                    ])
                ],
            ])
            ->add('title', CheckboxType::class, [
                'label' => 'Title',
                'required' => false,
            ])
            ->add('game', EntityType::class, [
                'class' => Games::class,
                'choice_label' => 'name',
            ])
            ->add('text', TextareaType::class, [
                'label' => 'Text',
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
