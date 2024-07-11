<?php

namespace App\Controller\Admin;

use App\Entity\HomePage;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;

class HomePageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HomePage::class;
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
            ->setEntityLabelInSingular('Page d\'accueil')
            ->setPageTitle('index', 'Modification de la page d\'accueil');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('bloc n°1'),
            IdField::new('id')->hideonform(),
            TextField::new('title', 'Titre'),
            TextEditorField::new('subtitle', 'Sous-titre'),
            TextEditorField::new('description', 'Description'),
            TextField::new('image', 'Url de l\'image'),

            TextEditorField::new('webSiteDescription', 'Description du site'),
            TextField::new('backgroundImage', 'Url de l\'image de fond'),

            // TextField::new('images','Images'),
            FormField::addPanel('bloc n°2'),
            TextField::new('secondBlocTitle', 'Titre'),
            TextField::new('secondBlocSubTitle', 'Sous-titre'),
            TextEditorField::new('secondBlocDescription', 'Description'),
            // TextField::new('images','Url de l\'image 1'),
            // TextField::new('images','Url de l\'image 2'),
            TextField::new('secondBlocImage', 'Url de l\'image'),
        ];
    }
}
