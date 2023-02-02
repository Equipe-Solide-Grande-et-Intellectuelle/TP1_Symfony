<?php

namespace App\Form;

use App\Entity\Inscription;
use App\Entity\Lyceen;
use App\Entity\Atelier;
use App\Entity\Creneau;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('lyceen',EntityType::class,[
                "class" => Lyceen::class,
                "choice_label" => "nom"
            ])
            ->add('atelier',EntityType::class,[
                "class" => Atelier::class,
                "choice_label" => "titre"
            ])
            ->add('creneau',EntityType::class,[
                "class" => Creneau::class,
                "choice_label" => "id"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
