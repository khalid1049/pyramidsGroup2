<?php

namespace App\Controller\Admin;

use App\Entity\Stand;
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
            TextField::new('Number')->setDisabled(true)->setColumns(4),
            NumberField::new('Surface')->setColumns(4),
            ChoiceField::new('Type')->setChoices([
                'Modulaire' => 'Modulaire',
                'Personnalisé' => 'Personnalisé',
            ])->setColumns(4),
            BooleanField::new('status', 'payement status')->renderAsSwitch(false)->setColumns(4)->addCssClass('align-boolean'),
            MoneyField::new('price')->setCurrency('MAD')->setColumns(4),
            AssociationField::new('exhibitor', 'Exhibitor')->setColumns(4),
        ];
    }
    
}
