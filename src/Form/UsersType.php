<?php

namespace App\Form;

use App\Entity\Activityarea;
use App\Entity\Events;
use App\Entity\Gamifications;
use App\Entity\Notifications;
use App\Entity\Resources;
use App\Entity\Roles;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('lastName')
            ->add('firstName')
            ->add('photo')
            ->add('birthdate', null, [
                'widget' => 'single_text',
            ])
            ->add('address')
            ->add('goal')
            ->add('schoolCareer')
            ->add('professionnalCareer')
            ->add('instagram')
            ->add('facebook')
            ->add('linkedIn')
            ->add('activityArea', EntityType::class, [
                'class' => Activityarea::class,
                'choice_label' => 'id',
            ])
            ->add('resources', EntityType::class, [
                'class' => Resources::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('events', EntityType::class, [
                'class' => Events::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('gamifications', EntityType::class, [
                'class' => Gamifications::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('notifications', EntityType::class, [
                'class' => Notifications::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('followers', EntityType::class, [
                'class' => Users::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('mentors', EntityType::class, [
                'class' => Users::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('role', EntityType::class, [
                'class' => Roles::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
