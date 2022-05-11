<?php

namespace App\Form;

use App\Entity\Matiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, ['label' => false, 'attr' => ['placeholder' => 'Nom']])
            ->add('prix', null, ['label' => false, 'attr' => ['placeholder' => 'Prix']])
            ->add('stock', null, ['label' => false, 'attr' => ['placeholder' => 'Quantité']])
            ->add('isUnite', ChoiceType::class, [
                'label' => false,
                'placeholder' => 'Conditionnement',
                'choices' => [
                    'Kilogramme' => '0',
                    'Unite' => '1',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matiere::class,
        ]);
    }
}
