<?php

namespace App\Form;

use App\Entity\DetailVente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailVenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vente', null, ['label' => false, 'attr' => ['placeholder' => 'Achat']])
            ->add('produit', null, ['label' => false, 'placeholder' => 'Produit'])
            ->add('quantite', null, ['label' => false, 'attr' => ['placeholder' => 'Quantité']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailVente::class,
        ]);
    }
}
