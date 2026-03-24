<?php

namespace App\Controller\Admin;

use App\Entity\RequestedItems;
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
            FieldFormField::addTab('User Informations'),
            FieldFormField::addRow(),
            FieldFormField::addColumn('col-lg-6 col-xl-6'),
            AssociationField::new('customerRequest')->onlyOnIndex(),
            NumberField::new('chair'),
            NumberField::new('tables'),
            NumberField::new('spot'),
            NumberField::new('info'),
            NumberField::new('shelf'),
            FieldFormField::addRow(),
            FieldFormField::addColumn('col-lg-6 col-xl-6'),
            NumberField::new('cabin'),
            NumberField::new('showcase'),
            NumberField::new('trible_scoket'),
            NumberField::new('brochure_stand'),
            NumberField::new('bar_chair'),

        ];
    }
    
}
