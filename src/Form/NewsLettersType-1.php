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
            // ->add('email', EmailType::class, [
            //     'label' => 'Subscribe to the newsletter and stay tuned.',
            //     'attr' => [
            //         'class' => 'form-control input-width',
            //         'placeholder' => 'Enter your email',
            //         'aria-describedby' => 'emailHelp'
            //     ],
            //     'help' => 'We will never share your email with others.'
            // ])
            ->add('email')
            // ->add('submit', SubmitType::class, [
            //     'label' => 'Submit',
            //     'attr' => ['class' => 'btn btn-primary button-top']
            // ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewsLetters::class,
        ]);
    }
}
