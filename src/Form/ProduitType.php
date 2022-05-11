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
            ->add('nom', null, ['label' => false, 'attr' => ['placeholder' => 'Nom']])
            ->add('prix', null, ['label' => false, 'attr' => ['placeholder' => 'Prix']])
            ->add(
                'type',
                ChoiceType::class,
                [
                    'label' => false,
                    'choices' => [
                        'Plat' => 'Plat',
                        'Dessert' => 'Dessert',
                        'Boisson' => 'Boisson',
                        'Frite' => 'Frite',
                        'Autre' => 'Autre',
                    ],
                    'placeholder' => 'Type'
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
