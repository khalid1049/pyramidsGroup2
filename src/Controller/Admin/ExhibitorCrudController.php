<?php

namespace App\Controller\Admin;

use App\Entity\Exhibitor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExhibitorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exhibitor::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('user.firstName', 'First Name')
                    ->setLabel('prénom')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le prénom d\'exposant'
            ]),
            TextField::new('user.lastName', 'Last Name')
                    ->setLabel('nom')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le nom d\'exposant'
            ]),
            TextField::new('user.phone', 'Phone')
                    ->setLabel('portable')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le numéro portable d\'exposant'
            ]),
            TextField::new('CompanyName')
                    ->setLabel('entreprise')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter l\'entreprise d\'exposant'
            ]),
            TextField::new('country')
                    ->setLabel('pays')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le pays d\'exposant'
            ]),
            TextField::new('sectorActivity')
                    ->setLabel('secteur d\'activité')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le secteur d\'activité d\'exposant'
            ]),
            TextField::new('productDisplay')
                    ->setLabel('produit')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le produit d\'exposant'
            ]),
            TextField::new('adresse')
                    ->setLabel('adresse')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter adresse d\'exposant'
            ]),
            TextField::new('email')
                    ->setLabel('email')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter email d\'exposant'
            ]),
        ];
    }

     public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            // ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
        ;
    }
    
}
