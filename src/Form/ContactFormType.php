<?php

namespace App\Form;

use App\Entity\Contacts;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('object', TextType::class, [
            'label' => 'Objet :',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Saisissez le titre du message',
            ],
        ])
        ->add('name', TextType::class, [
            'label' => 'Votre nom :',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Saisissez votre nom ici',
            ],
        ])
        ->add('email', TextType::class, [
            'label' => 'Votre email :',
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Saisissez votre email ici',
            ],
        ])
        // ->add('content', TextType::class,[
        //     'label' => 'Contenu du message :',
        //     'attr' => [
        //         'class' => 'form-label',
        //         'placeholder' => 'Saisissez votre message ici',
        //     ],
        // ])
        ->add('content', TextareaType::class, [
            'label' => 'Contenu du message :',
            'attr' => [
                'class' => 'form-control',
                'rows' => 9,
                'style' => 'font-weight: normal;',
                'placeholder' => 'Saisissez votre message ici',
            ],
        ])
        ->add('date', null, [
            'widget' => 'single_text',
        ]);
        // ->add('users', EntityType::class, [
        //     'class' => Users::class,
        //     'choice_label' => 'id',
        // ])
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contacts::class,
        ]);
    }
}
