<?php

namespace App\Form;

use App\Entity\Mission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre'
            ])
            ->add('description', null, [
                'label' => 'Description'
            ])
            ->add('city', null, [
                'label' => 'Ville'
            ])
            ->add('adress', null, [
                'label' => 'Adresse'
            ])
            ->add('postal_code', null, [
                'label' => 'Code postal'
            ])
            ->add('created_at', null, [
                'label' => 'Date de création'
            ])
            ->add('updated_at', null, [
                'label' => 'Date de modification'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mission::class,
        ]);
    }
}
