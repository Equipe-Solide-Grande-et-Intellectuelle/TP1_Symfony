<?php

namespace App\Form;

use App\Entity\Lyceens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LyceensType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lycee')
            ->add('section')
            ->add('email')
            ->add('tel')
            ->add('date_inscription')
            ->add('inscription')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lyceens::class,
        ]);
    }
}
