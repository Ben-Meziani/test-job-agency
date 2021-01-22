<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => array(
                    'placeholder' => 'email@youremail.com'
                )
            ])
            ->add('name', TextType::class, [
                'label' => 'Prénom','attr' => array(
                    'placeholder' => 'Votre prénom ici'
                )

            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => array(
                    'placeholder' => 'Votre nom de famille ici'
                )

            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'attr' => array(
                    'placeholder' => 'Votre adresse ici'
                ) 
            ])
            ->add('postalCode', NumberType::class, [
                'label' => 'Code postal',
                'attr' => array(
                    'placeholder' => 'Votre code postal ici'
                ) 
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'attr' => array(
                    'placeholder' => 'Votre pays ici'
                ) 
            ])
            
            ->add('phone', NumberType::class, [
                'label' => 'Téléphone',
                'attr' => array(
                    'placeholder' => 'Votre adresse ici'
                ) 
            ])
             ->add('agreeTerms', CheckboxType::class, [
                'label' => 'J\'accepte les conditions générales',
                 'mapped' => false,
                 'constraints' => [
                     new IsTrue([
                         'message' => 'Acceptez les conditions générales.',
                     ]),
                 ],
             ])
            
            ->add('password', RepeatedType::class, [
                'label' =>'Confirmation de mot de passe',
                'attr' => array(
                'placeholder' => 'Votre confirmation de mot de passe ici'
            ),
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe',
                'attr' => array(
                'placeholder' => 'Votre mot de passe ici'
            )],
                'second_options' => ['label' => 'Confirmation de mot de passe',
                'attr' => array(
                'placeholder' => 'Votre confirmation de mot de passe ici'
            )],
            ])
            ->add('send', SubmitType::class, [
                'label' => 'Valider'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
