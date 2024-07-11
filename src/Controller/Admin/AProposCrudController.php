<?php

namespace App\Controller\Admin;

use App\Entity\APropos;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class AProposCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return APropos::class;
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
            ->setEntityLabelInSingular('Page A Propos')
            ->setPageTitle('index', 'Modification de la page A Propos');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titleAPropos', 'Titre'),
            TextEditorField::new('contentAPropos'),
        ];
    }
}
