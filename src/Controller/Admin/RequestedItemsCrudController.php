<?php

namespace App\Controller\Admin;

use App\Entity\RequestedItems;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField as FieldFormField;


class RequestedItemsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RequestedItems::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            FieldFormField::addTab('Items Informations'),
            FieldFormField::addRow(),
            FieldFormField::addColumn('col-lg-6 col-xl-6'),
            AssociationField::new('customerRequest')->onlyOnIndex(),
            NumberField::new('chair')
                    ->setLabel(
                        $pageName === Crud::PAGE_INDEX
                        ? 'Chair'
                        :'<i class="fa-solid fa-chair adding"></i> Chair'),
            NumberField::new('tables')
                    ->setLabel(
                        $pageName === Crud::PAGE_INDEX
                        ? 'Table'
                        :'<i class="fa-solid fa-table adding"></i> Table'),
            NumberField::new('spot')
                    ->setLabel(
                        $pageName === Crud::PAGE_INDEX
                        ? 'Spot'
                        :'<i class="fa-solid fa-lightbulb adding"></i> Spot'),
            NumberField::new('wallHanger')
                    ->setLabel(
                        $pageName === Crud::PAGE_INDEX
                        ? 'Wall hanger'
                        :'<i class="fa-solid fa-sign-hanging adding"></i> Wall hanger'),
            FieldFormField::addRow(),
            FieldFormField::addColumn('col-lg-6 col-xl-6'),
            NumberField::new('shelf')
                    ->setLabel(
                        $pageName === Crud::PAGE_INDEX
                        ? 'Shelf'
                        :'<i class="fa-solid fa-layer-group adding"></i> Shelf'),
            NumberField::new('electricPlug')
                    ->setLabel(
                        $pageName === Crud::PAGE_INDEX
                        ? 'Electric plug'
                        :'<i class="fa-solid fa-plug adding"></i> Electric plug'),
            NumberField::new('carpet')
                    ->setLabel(
                        $pageName === Crud::PAGE_INDEX
                        ? 'Carpet'
                        :'<i class="fa-solid fa-rug adding"></i> Carpet'),

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