<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class WifiFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => "Nom du WIFI",
                'attr'=>[
                    "class" => "form-control mb-3"
                ]
            ])
            ->add('encryption',ChoiceType::class,[
                "label" => 'Encryption',
                'attr'=>[
                    "class" => "form-select mb-3"
                ],
                'choices' =>[
                    'WPA2' => 'WPA2',
                    'WPA' => 'WPA',
                    'WEP' => 'WEP',

                ],
                'help' => 'Le type de protocol de sécurité de votre réseau'
            ])
            ->add('mdp',TextType::class,[
                'label' => "Mot de passe",
                'attr'=>[
                    "class" => "form-control mb-3"
                ]
            ])
            ->add('hidden',CheckboxType::class,[
                'label' => "Caché ?",
                'required' => false,
                'attr' => [
                    "class" => ""
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
