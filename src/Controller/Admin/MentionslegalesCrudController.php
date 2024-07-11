<?php

namespace App\Controller\Admin;

use App\Entity\Mentionslegales;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class MentionslegalesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mentionslegales::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInSingular('Page Mention légales')
            ->setPageTitle('index', 'Modification de la page Mention légales');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('description'),
        ];
    }
}
