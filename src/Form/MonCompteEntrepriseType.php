<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonCompteEntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class,[
            'label'=> false,
            'attr' => [
                'placeholder' => 'nom',
                'style'=> 'color: black !important'
            ]
        ])
        ->add('adresse', TextType::class,[
            'label'=> false,
            'attr' => [
                'placeholder' => 'adresse',
                'style'=> 'color: black !important'
            ]
        ])
        ->add('telephone', TextType::class,[
            'label'=> false,
            'attr' => [
                'placeholder' => 'telephone',
                'style'=> 'color: black !important'
            ]
        ])
        ->add('Effectif', NumberType::class,[
            'label'=> false,
            'attr' => [
                'placeholder' => 'Effectif',
                'style'=> 'color: black !important'
            ]
        ])
        ->add('siret', TextType::class,[
            'label'=> false,
            'attr' => [
                'placeholder' => 'siret'
            ]
        ])
        ->add('NAF', TextType::class,[
            'label'=> false,
            'attr' => [
                'placeholder' => 'NAF'
            ]
        ])
        ->add('raisonSocial', TextType::class,[
            'label'=> false,
            'attr' => [
                'placeholder' => 'Raison Social'
            ]
        ])



        ->add('old_password', PasswordType::class,[
            'mapped'=>false,
            'label'=> false,
            'attr' => [
                'placeholder' => 'Mot de passe actuel'
                
            ] 
            ])
            ->add('new_password', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
                'required' => true,
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre nouveau mot de passe.'
                    ]
                ],
                'second_options' => [
                    'label' => false, 
                    'attr' => [
                        'placeholder' => 'Merci de confirmer votre nouveau mot de passe.'
                    ]
                ]
            ])

        
        ->add('save', SubmitType::class,[
            'label'=> "Enregistrer",
            'attr' => [
                'class' => 'boutonForm'
            ]
            ]);
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
