<?php

namespace App\Controller\Admin;

use App\Entity\CustomerRequest;
use App\Repository\ProviderRepository;
use App\Repository\StandRepository;
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
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CustomerRequestCrudController extends AbstractCrudController
{
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

  

    public static function getEntityFqcn(): string
    {
        return CustomerRequest::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),

            // AssociationField::new('exhibitor')
            //             ->setLabel('<i class="fa-solid fa-user-tie adding"></i> Exhibitor'),
            // AssociationField::new('stand')
            //             ->setLabel('<i class="fa-solid fa-store adding"></i> Stand'),
            AssociationField::new('exhibitor')
                ->setLabel('<i class="fa-solid fa-user-tie adding"></i> Exhibitor')
                ->setRequired(true)
                ->setFormTypeOptions([
                    'attr' => [
                        // juste URL sans id
                        'data-stand-url' => $this->generateUrl('admin_stand_by_exhibitor', ['id' => 0])
                    ]
                ]),
            AssociationField::new('stand')
                    ->setLabel('<i class="fa-solid fa-store adding"></i> Stand')
                    ->setRequired(true)
                    // ->setFormTypeOptions([
                    //     'choices' => [] 
                    // ]),
                    ,
            AssociationField::new('provider')
                        ->setLabel('<i class="fa-solid fa-briefcase adding"></i> Provider'),
            CollectionField::new('requestedItems')
                        ->setLabel('<i class="fa-solid fa-list-ul adding"></i> Requested Items')    
                        ->useEntryCrudForm()
                        ->allowAdd()
                        ->allowDelete()
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        if (!$this->isGranted('ROLE_ADMIN')) {

            $actions
                ->remove(Crud::PAGE_INDEX, Action::NEW)
                ->remove(Crud::PAGE_INDEX, Action::EDIT)
                ->remove(Crud::PAGE_INDEX, Action::DELETE)
                // ->remove(Crud::PAGE_DETAIL, Action::NEW)
                ->remove(Crud::PAGE_DETAIL, Action::EDIT)
                ->remove(Crud::PAGE_DETAIL, Action::DELETE);

        }
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
        return $actions
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa-solid fa-pen');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
                return $action->setIcon('fa-solid fa-arrow-left');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action
                    ->setIcon('fa-solid fa-eye')
                    ->setLabel(false);
            });
    }

    #[Route('/admin/stands-by-exhibitor/{id}', name: 'admin_stand_by_exhibitor')]
    public function getStandsByExhibitor(StandRepository $standRepository, int $id): JsonResponse
    {
        $stands = $standRepository->findBy(['exhibitor' => $id]);
        dd($stands);
        $data = [];

        foreach ($stands as $stand) {
            $data[] = [
                'id' => $stand->getId(),
                'label' => (string)$stand, // Stand 12
            ];
        }

        return new JsonResponse($data);
    }
    // public function configureCrud(Crud $crud): Crud
    // {
    //     if (!$this->isGranted('ROLE_ADMIN')) {
    //         throw $this->createAccessDeniedException();
    //     }

    //     return $crud;
    // }
    public function createIndexQueryBuilder(SearchDto $searchDto,EntityDto $entityDto,FieldCollection $fields,
    FilterCollection $filters): QueryBuilder {

        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        if ($this->isGranted('ROLE_PRESTATAIRE')) {

            $provider = $this->providerRepository->findOneBy([
                'user' => $this->getUser()
            ]);

            if ($provider) {
                $qb->andWhere('entity.provider = :provider')
                ->setParameter('provider', $provider);
            } else {
                $qb->andWhere('1 = 0');
            }
        }

        return $qb;
    }
}
