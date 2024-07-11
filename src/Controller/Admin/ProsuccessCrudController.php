<?php

namespace App\Entity;

namespace App\Controller\Admin;

use App\Entity\Prosuccess;
use App\Repository\ActivityareaRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProsuccessCrudController extends AbstractCrudController
{
    public const RESOURCE_BASE_PATH = 'images/histoires/';
    public const RESOURCE_UPLOAD_DIR = 'public/images/histoires/';
    private $activityareaRepository;

    public function __construct(ActivityareaRepository $activityareaRepository)
    {
        $this->activityareaRepository = $activityareaRepository;
    }

    public static function getEntityFqcn(): string
    {
        return Prosuccess::class;
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
            ->setEntityLabelInPlural('Histoires Inspirantes')
            ->setEntityLabelInSingular('Histoire Inspirante')
            ->setPageTitle('index', 'Gestion des Histoires Inspirantes');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideonform(),
            TextField::new('title', 'Titre'),

            AssociationField::new('activityArea', 'Secteur d\'activité') // scrolling menu
                ->renderAsNativeWidget()
                ->formatValue(function ($value) {
                    return $value ? $value->getActivityAreaName() : '';
                }),
            // TextField::new('image', 'Url de l\'image'),
            ImageField::new('image', 'Image')
                ->setBasePath(self::RESOURCE_BASE_PATH)
                ->setUploadDir(self::RESOURCE_UPLOAD_DIR)
                ->setRequired(false)
                ->setUploadedFileNamePattern('[timestamp]-[contenthash].[extension]'), // change the picture name for added in BDD
            TextareaField::new('history', 'Description de l\'histoire')->setRequired(true),
            TextField::new('author', 'Auteur'),
            DateTimeField::new('publication_date', 'Date de publication')->setRequired(true),
            TextField::new('address', 'Adresse'),
            // IntegerField::new('nb_view', 'Nombre de vues')->hideonform(),
        ];
    }
}
