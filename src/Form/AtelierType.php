<?php

namespace App\Form;

use App\Entity\Atelier;
use App\Entity\Salle;
use App\Entity\Secteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AtelierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('ressource')
            ->add('salle',EntityType::class,[
                "class" => Salle::class,
                "choice_label" => "nom"
            ])
            ->add('secteurs',EntityType::class,[
                "class" => Secteur::class,
                "choice_label" => "nom",
                "multiple" => "true"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Atelier::class,
        ]);
    }
}
