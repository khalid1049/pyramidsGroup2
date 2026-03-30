<?php

namespace App\Controller\Admin;

use App\Entity\Stand;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CurrencyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField as FieldFormField;


class StandCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stand::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FieldFormField::addTab('Stand Informations'),
            FieldFormField::addRow(),
            // FieldFormField::addColumn('col-lg-4 col-xl-4'),
            IdField::new('id')->onlyOnIndex(),
            TextField::new('Number')
                    ->setColumns(4)
                    ->setLabel('<i class="fa-solid fa-hashtag adding"></i> Number')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the number of stand'
            ]),
            TextField::new('size')
                    ->setColumns(4)
                    ->setLabel('<i class="fa-solid fa-ruler-combined adding"></i> Surface')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the surface of stand'
            ]),
            NumberField::new('open_side')
                    ->setColumns(4)
                    ->setLabel('<i class="fa-solid fa-border-all adding"></i> Open side')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the open side of stand'
            ]),
            
            ChoiceField::new('Type')
                    ->setColumns(4)
                    ->setChoices([
                'Modulaire' => 'Modulaire',
                'Personnalisé' => 'Personnalisé',
            ])
                    ->setLabel('<i class="fa-solid fa-shop adding"></i> Type')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Choose the type of stand'
            ]),
            BooleanField::new('status', 'payement status')
                    ->renderAsSwitch(false)
                    ->setColumns(4)
                    ->addCssClass('align-boolean')
                    ->setLabel('<i class="fa-solid fa-credit-card adding"></i> Payement status')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the type of stand'
            ]),
            TextField::new('price')
                    ->setColumns(4)
                    ->setLabel('<i class="fa-solid fa-money-bill-wave adding"></i> Price')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the price of stand'
            ]),
            AssociationField::new('exhibitor', 'Exhibitor')
                    ->setColumns(4)
                    ->setLabel('<i class="fa-solid fa-user-tie adding"></i> Exhibitor')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Choose the Exhibitor'
            ]),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
            return $action
                ->setIcon('fa-solid fa-pen');
        })
        ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
            return $action
                ->setIcon('fa-solid fa-arrow-left');
        });
    }
    
}