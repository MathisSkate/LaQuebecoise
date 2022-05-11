<?php

namespace App\Form;

use App\Entity\DetailAchat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailAchatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('achat', null, ['label' => false, 'attr' => ['placeholder' => 'Achat']])
            ->add('matiere', null, ['label' => false, 'attr' => ['placeholder' => 'Matière']])
            ->add('quantite', null, ['label' => false, 'attr' => ['placeholder' => 'Quantité']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetailAchat::class,
        ]);
    }
}
