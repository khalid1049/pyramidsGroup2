<?php

namespace App\Controller\Admin;

use App\Entity\Exhibitor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField as FieldFormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
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

            FieldFormField::addTab('User Informations'),

            FieldFormField::addRow(),
            
            FieldFormField::addColumn('col-lg-6 col-xl-6'),
            TextField::new('firstName', 'First Name')
                    ->setLabel('First Name')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le prénom d\'exposant'
            ]),
            TextField::new('lastName', 'Last Name')
                    ->setLabel('Last Name')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le nom d\'exposant'
            ]),
            TelephoneField::new('phone', 'Phone')
                    ->setLabel('Phone')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le numéro portable d\'exposant'
            ]),


            FieldFormField::addTab('company Informations'),
            FieldFormField::addRow(),
            FieldFormField::addColumn('col-lg-4 col-xl-4'),

            TextField::new('CompanyName')
                    ->setLabel('entreprise')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter l\'entreprise d\'exposant'
            ]),
            CountryField::new('country')
                    ->setLabel('pays')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le pays d\'exposant'
            ]),
            FieldFormField::addColumn('col-lg-4 col-xl-4'),

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
            FieldFormField::addColumn('col-lg-4 col-xl-4'),

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

            // FieldFormField::addTab('Stand Informations'),
            // FieldFormField::addRow(),

            // FieldFormField::addColumn('col-lg-4 col-xl-4'),
            // TextField::new('stand.surface')
            //         ->setLabel('numéro de stand')
            //         ->setFormTypeOption('attr', [
            //     'placeholder' => 'Enter le numéro de stand d\'exposant'
            // ]),
            // TextField::new('stand.number')
            //         ->setLabel('numéro de stand')
            //         ->setFormTypeOption('attr', [
            //     'placeholder' => 'Enter le numéro de stand d\'exposant'
            // ]),

            // NumberField::new('stand.surface')
            //         ->setLabel('surface de stand')
            //         ->setFormTypeOption('attr', [
            //     'placeholder' => 'Enter la surface de stand d\'exposant'
            // ]),
            // ChoiceField::new('stand.type')
            //         ->setLabel('type de stand')
            //         ->setChoices([
            //             'Modulaire' => 'Modulaire',
            //             'Personnalisé' => 'Personnalisé',
                       
            //         ])
            //         ->setFormTypeOption('attr', [
            //     'placeholder' => 'Enter le type de stand d\'exposant'
            // ]),

            // BooleanField::new('stand.status')
            //         ->setLabel('status de stand')
            //         ->setFormTypeOption('attr', [
            //     'placeholder' => 'Enter le status de stand d\'exposant'
            // ]),
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
