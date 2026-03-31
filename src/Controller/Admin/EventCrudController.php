<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title')
                    ->setLabel(
                            $pageName === Crud::PAGE_INDEX
                            ? 'Title'
                            :'<i class="fa-solid fa-calendar-days adding"></i> Title')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the title of event'
            ]),
            TextareaField::new('description')
                        ->setLabel(
                                $pageName === Crud::PAGE_INDEX
                                ? 'Description'
                                :'<i class="fa-solid fa-file adding"></i> Description')
                        ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the description of event'
            ]),
            TextField::new('localisation')
                    ->setLabel(
                            $pageName === Crud::PAGE_INDEX
                            ? 'Location'
                            :'<i class="fa-solid fa-location-dot adding"></i> Location')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the location of event'
            ]),
            DateField::new('startedAt')
                    ->setLabel(
                            $pageName === Crud::PAGE_INDEX
                            ? 'Date of event'
                            :'<i class="fa-solid fa-calendar adding"></i> Date of event')
                    ->setFormTypeOption('widget', 'single_text')           
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Select the start date and time of the event'
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
