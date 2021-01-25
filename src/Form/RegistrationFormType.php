<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'email@youremail.com'
                )
            ])
            ->add('name', TextType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Votre prénom ici'
                )

            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Votre nom de famille ici'
                )

            ])
            ->add('address', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Votre adresse ici'
                ) 
            ])
            ->add('postalCode', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Votre code postal ici'
                ) 
            ])
            ->add('country', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => array(
                    'placeholder' => 'Votre pays ici'
                ) 
            ])
            
            ->add('phone', null, [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Votre numéro de téléphone ici'
                ),
            ])
             ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Accepter les conditions générales d\'utilisation',
                 'mapped' => false,
                 'constraints' => [
                     new IsTrue([
                         'message' => 'Acceptez les conditions générales.',
                     ]),
                 ],
             ])
            
            ->add('plainPassword', RepeatedType::class, [
                'attr' => array(
                'placeholder' => 'Votre confirmation de mot de passe ici'
            ),
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => false,
                'attr' => array(
                'placeholder' => 'Votre mot de passe ici'
            )],
                'second_options' => ['label' => false,
                'attr' => array(
                'placeholder' => 'Votre confirmation de mot de passe ici'
            )],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
