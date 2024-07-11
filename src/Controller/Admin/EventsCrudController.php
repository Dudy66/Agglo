<?php

namespace App\Controller\Admin;

use App\Entity\Events;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Events::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInPlural('Évènements');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->hideonform(),
            TextField::new('title', 'Titre'),
            TextEditorField::new('description', 'Description'),
            TextField::new('address', 'Adresse'),
            DateTimeField::new('dateHours', 'Date')
            ->setFormat('dd/MM/Y'),
            IntegerField::new('nb_participants', 'Participants')->hideonform(),
            AssociationField::new('users', 'Nom participants')
            ->formatValue(function ($value) {
                $names = [];
                foreach ($value as $user) {
                    $names[] = $user->getFirstName().' '.$user->getLastName().' : '.$user->getEmail().'<br>';
                }

                return implode($names);
            })
            ->hideOnForm(),
            IntegerField::new('max_participant', 'Participants max'),
        ];
    }
}
