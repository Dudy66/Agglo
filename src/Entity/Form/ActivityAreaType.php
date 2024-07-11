<?php

namespace App\Form;

use App\Entity\Prosuccess;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ActivityAreaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Prosuccess', Prosuccess::class, [
                'class' => 'App\Entity\Prosuccess',
                'choice_label' => 'activityArea',
            ]);
    }
}
