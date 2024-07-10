<?php

namespace App\Form;

use App\Entity\Games;
use App\Entity\PlateForms;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlateFormsType extends AbstractType
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PlateForms::class,
        ]);
    }
}
