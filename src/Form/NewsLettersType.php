<?php

namespace App\Form;

use App\Entity\NewsLetters;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewsLettersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Abonnez-vous à la newsletter et restez à l\'écoute.',
                'attr' => [
                    'class' => 'form-control input-width',
                    'placeholder' => 'Enter email',
                    'aria-describedby' => 'emailHelp'
                ],
                'help' => 'Nous ne partagerons jamais votre e-mail avec les autres.'
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
                'attr' => ['class' => 'btn btn-primary button-top']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsLetters::class,
        ]);
    }
}
