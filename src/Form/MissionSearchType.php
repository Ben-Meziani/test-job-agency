<?php

namespace App\Form;

use App\Entity\MissionSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxSalary', IntegerType::class, [
              'required' =>false, 
              'label' => false,
              'attr' => [
                  'placeholder' => 'Salaire max'
              ] 
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MissionSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    //Methode qui permet d'avoir une plus propre
    public function getBlockPrefix()
    {
        return '';
    }
}
