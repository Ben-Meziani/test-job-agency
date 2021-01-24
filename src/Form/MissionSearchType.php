<?php

namespace App\Form;

use App\Data\MissionData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
            'label' => false,
            'required' =>false,
            'attr' => [
                'placeholder' => 'Métier'
            ]
            ])
            ->add('p', TextType::class, [
                'label' => false,
                'required' =>false,
                'attr' => [
                    'placeholder' => 'Ville'
                ]
                ])
            ->add('salaryMax', NumberType::class, [
              'required' =>false, 
              'label' => false,
              'attr' => [
                  'placeholder' => 'Salaire max'
              ] 
            ])
            ->add('salaryMin', NumberType::class, [
                'required' =>false, 
                'label' => false,
                'attr' => [
                    'placeholder' => 'Salaire minimum'
                ] 
              ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MissionData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    //Methode qui permet d'avoir une plus propre
    public function getBlockPrefix()
    {
        return '';
    }
}
