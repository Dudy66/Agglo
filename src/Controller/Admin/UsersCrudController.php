<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Repository\RolesRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UsersCrudController extends AbstractCrudController
{
    private $rolesRepository;

    public function __construct(RolesRepository $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
    }

    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->remove(Crud::PAGE_INDEX, Action::NEW);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // the labels used to refer to this entity in titles, buttons, etc.
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur')
            ->setPageTitle('index', 'Gestion des Utilisateurs');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideonform(),
            TextField::new('last_Name', 'Nom')->setRequired(true),
            TextField::new('first_Name', 'Prénom')->setRequired(true),
            DateTimeField::new('birthdate', 'Date de naissance'),
            EmailField::new('email'),
            AssociationField::new('role', 'Rôle') // scrolling menu
                ->renderAsNativeWidget()
                ->formatValue(function ($value) {
                    return $value ? $value->getRoleName() : '';
                }),
            TextField::new('address', 'Adresse'),
        ];
    }
}
