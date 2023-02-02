<?php

namespace App\Form;

use App\Entity\Activite;
use App\Entity\Competence;
use App\Entity\Metier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MetierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('activites',EntityType::class,[
                "class" => Activite::class,
                "choice_label" => "nom",
                "multiple" => true
            ])
            ->add('competences',EntityType::class,[
                "class" => Competence::class,
                "choice_label" => "nom",
                "multiple" => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Metier::class,
        ]);
    }
}
