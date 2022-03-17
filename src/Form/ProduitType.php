<?php

namespace App\Form;

use App\Entity\Produit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('description')
            ->add('hasDescription')
            ->add('prix')
            ->add(
                'type',
                ChoiceType::class,
                [
                    'choices' => [
                        'Plat' => 'plat',
                        'Dessert' => 'dessert',
                        'Boisson' => 'boisson',
                        'Frite' => 'frite',
                        'Normand' => 'normand',
                        'Autre' => 'autre',
                    ],
                    'expanded' => true
                ]
            );;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
