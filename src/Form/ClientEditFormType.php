<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Client;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientEditFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('libelleCivilite', ChoiceType::class, [
                'choices' => [
                    'Mr' => 'Mr',
                    'Mme' => 'Mme',
                ],
                'expanded' => false, 
                'multiple' => false, 
            ])
            ->add('telephoneDomicile')
            ->add('telephonePortable')
            ->add('telephoneJob')
            ->add('email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
