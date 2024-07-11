<?php

namespace App\Entity\Form;

use App\Data\SearchEventsData;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchEventsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', DateType::class, [
                'widget' => 'choice',
                'input'  => 'datetime_immutable',
                // 'format' => 'dd-MM-yyyy',
                // 'html5' => false,
            ])
            ->add('to', DateType::class, [
                'widget' => 'choice',
                'input'  => 'datetime_immutable',
                // 'format' => 'dd-MM-yyyy',
                // 'html5' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchEventsData::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}