<?php

namespace App\Form;

use App\Entity\Application;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ApplicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('actualJob', TextType::class,[
                'label' => 'Poste actuel',
                'required' =>false
            ]
            )
            ->add('cvFile', VichImageType::class,
            
            [
                'label' => 'CV *',
            ]) 
            ->add('motivationLetter', TextareaType::class,
            [
                'label' => 'Lettre de motivation *'
            ])       
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Application::class,
        ]);
    }
}
