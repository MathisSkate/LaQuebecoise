<?php

namespace App\Form;

use App\Entity\Localisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocalisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, ['label' => false, 'attr' => ['placeholder' => 'Nom']])
            ->add('rue', null, ['label' => false, 'attr' => ['placeholder' => 'Rue']])
            ->add('ville', null, ['label' => false, 'attr' => ['placeholder' => 'Ville']])
            ->add('codepostal', null, ['label' => false, 'attr' => ['placeholder' => 'Code Postal']])
            ->add('pays', HiddenType::class, ['attr' => ['value' => 'France']])
            ->add('description', null, ['label' => false, 'attr' => ['placeholder' => 'Description']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Localisation::class,
        ]);
    }
}
