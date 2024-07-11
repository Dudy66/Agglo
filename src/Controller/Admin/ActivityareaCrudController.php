<?php

namespace App\Controller\Admin;

use App\Entity\Activityarea;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ActivityareaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Activityarea::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInPlural('Secteurs d\'activités')
            ->setEntityLabelInSingular('Secteur d\'activité')
            ->setPageTitle('index', 'Gestion des secteurs d\'activités')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideonform(),
            TextField::new('activity_area_name', 'Nom du secteur d\'activité'),
        ];
    }
}
