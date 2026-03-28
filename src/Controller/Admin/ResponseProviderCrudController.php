<?php

namespace App\Controller\Admin;

use App\Entity\ResponseProvider;
use App\Repository\ProviderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class ResponseProviderCrudController extends AbstractCrudController
{

    private ProviderRepository $providerRepository;

    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public static function getEntityFqcn(): string
    {
        return ResponseProvider::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [

            IdField::new('id')->hideOnForm(),

            AssociationField::new('customerRequest')
                ->setLabel('Customer Request')
                ->setRequired(true)
                ->setQueryBuilder(function (QueryBuilder $qb) {

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
                }),

            AssociationField::new('stand')
                ->hideOnForm(),

            AssociationField::new('provider')
                ->hideOnForm(),

            CollectionField::new('requestedItems')
                ->allowAdd()
                ->allowDelete()
                ->useEntryCrudForm(),

        ];
    }


   
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof ResponseProvider) {
            return;
        }

        $customerRequest = $entityInstance->getCustomerRequest();

        if (!$customerRequest) {
            throw new \RuntimeException('CustomerRequest must be set before saving ResponseProvider.');
        }

        // dd($customerRequest->getExhibitor());

        $entityInstance->setStand($customerRequest->getStand());
        $entityInstance->setProvider($customerRequest->getProvider());
        $entityInstance->setExhibitor($customerRequest->getExhibitor());

        foreach ($entityInstance->getRequestedItems() as $item) {
            $item->setCustomerRequest($customerRequest);
            $item->setResponseProvider($entityInstance); 
        }
        parent::persistEntity($entityManager, $entityInstance);
    }

}