<?php

namespace App\Controller\Admin;

use App\Entity\CustomerRequest;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;

class CustomerRequestCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CustomerRequest::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            AssociationField::new('exhibitor'),
            AssociationField::new('stand'),
            AssociationField::new('provider'),
            CollectionField::new('requestedItems')
                            ->useEntryCrudForm()
                            ->allowAdd()
                            ->allowDelete()
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            $actions
                ->remove(Crud::PAGE_INDEX, Action::NEW);
        }

        return $actions
            ->remove(Crud::PAGE_DETAIL, Action::EDIT);
    }

    public function createIndexQueryBuilder(
        SearchDto $searchDto,
        EntityDto $entityDto,
        FieldCollection $fields,
        FilterCollection $filters
    ): QueryBuilder {

        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        // Si l'utilisateur est provider, ne montrer que ses requests
        if ($this->isGranted('ROLE_PROVIDER')) {
            $qb->andWhere('entity.provider = :provider')
            ->setParameter('provider', $this->getUser());
        }

        return $qb;
    }
}
