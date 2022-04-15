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
            ->add('description', null, ['label' => false, 'attr' => ['placeholder' => 'Description']])
            ->add('hasDescription', null, ['label' => 'à une description ?'])
            ->add('prix', null, ['label' => false, 'attr' => ['placeholder' => 'Prix']])
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
