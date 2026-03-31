<?php

namespace App\Controller\Admin;

use App\Entity\ResponseProvider;
use App\Repository\ProviderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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

    public function configureActions(Actions $actions): Actions
    {
        if (!$this->isGranted('ROLE_PRESTATAIRE')) {

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

    public function configureFields(string $pageName): iterable
    {
        return [

            FormField::addTab('customerRequest Informations'),
             FormField::addRow(),
            FormField::addColumn('col-lg-6 col-xl-6'),
            IdField::new('id')->hideOnForm(),

            AssociationField::new('customerRequest')
                ->setLabel('Customer Request')
                ->onlyOnForms()
                ->setQueryBuilder(function (QueryBuilder $qb) use ($pageName) {

                    if ($pageName === Crud::PAGE_NEW && $this->isGranted('ROLE_PRESTATAIRE')) {
                        $provider = $this->providerRepository->findOneBy([
                            'user' => $this->getUser()
                        ]);

                        if ($provider) {
                            $qb->leftJoin('entity.responseProvider', 'rp')
                                ->andWhere('entity.provider = :provider')
                                ->andWhere('rp.id IS NULL')
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
            FormField::addTab('Stand Informations'),

            FormField::addRow(),
            FormField::addColumn('col-lg-6 col-xl-6'),
            NumberField::new('chair')->setLabel('<i class="fa-solid fa-chair adding"></i> Chair')->hideOnIndex(),
            NumberField::new('tableStand')->setLabel('<i class="fa-solid fa-table adding"></i> Table Stand')->hideOnIndex(),
            NumberField::new('spot')->setLabel('<i class="fa-solid fa-map-pin adding"></i> Spot')->hideOnIndex(),
            NumberField::new('wallHanger')->setLabel('<i class="fa-solid fa-hanger adding"></i> Wall Hanger')->hideOnIndex(),
            NumberField::new('shelf')->setLabel('<i class="fa-solid fa-boxes-stacked adding"></i> Shelf')->hideOnIndex(),
            NumberField::new('electricPlug')->setLabel('<i class="fa-solid fa-plug adding"></i> Electric Plug')->hideOnIndex(),
           
            NumberField::new('carpet')->setLabel('<i class="fa-solid fa-carpenter assembling"></i> Carpet')->hideOnIndex(),
             FormField::addColumn('col-lg-6 col-xl-6'),
            NumberField::new('tribleSocket')->setLabel('<i class="fa-solid fa-plug-circle-bolt adding"></i> Trible Socket')->hideOnIndex(),
            NumberField::new('rod')->setLabel('<i class="fa-solid fa-rod-asbestos adding"></i> Rod')->hideOnIndex(),
            NumberField::new('sqm')->setLabel('<i class="fa-solid fa-ruler-combined adding"></i> Square Meter')->hideOnIndex(),
            TextEditorField::new('extra')->setLabel('<i class="fa-solid fa-pen-to-square adding"></i> Extra')->hideOnIndex(),
            ImageField::new('photoStand')->setLabel('<i class="fa-solid fa-image adding"></i> Photo Stand')->setBasePath('uploads/images/')->setUploadDir('public/uploads/images/'),

            


            Field::new('getProgressPercentage', 'Progress')
                ->onlyOnDetail()
                ->setVirtual(true) // important
                ->formatValue(function ($value, $entity) {
                    /** @var \App\Entity\ResponseProvider $entity */
                    $progress = $entity->getProgressPercentage();
                    // dd($progress);

                    $color = $progress > 70 ? 'bg-success' : ($progress > 40 ? 'bg-warning' : 'bg-danger');

                    // **return string only**
                    return sprintf(
                        '<div class="progress" style="height:20px;">
                            <div class="progress-bar %s" role="progressbar" style="width:%d%%">%d%%</div>
                        </div>',
                        $color,
                        $progress,
                        $progress
                    );
                })
                // ->renderAsHtml()

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

        if ($customerRequest->getResponseProvider()) {
            $existingRp = $customerRequest->getResponseProvider();

            // Copy values from $entityInstance to $existingRp
            $existingRp->setChair($entityInstance->getChair());
            $existingRp->setTableStand($entityInstance->getTableStand());
            $existingRp->setSpot($entityInstance->getSpot());
            $existingRp->setWallHanger($entityInstance->getWallHanger());
            $existingRp->setShelf($entityInstance->getShelf());
            $existingRp->setElectricPlug($entityInstance->getElectricPlug());
            $existingRp->setCarpet($entityInstance->getCarpet());
            $existingRp->setTribleSocket($entityInstance->getTribleSocket());
            $existingRp->setRod($entityInstance->getRod());
            $existingRp->setSqm($entityInstance->getSqm());
            $existingRp->setExtra($entityInstance->getExtra());

            foreach ($entityInstance->getRequestedItems() as $item) {
                $item->setCustomerRequest($customerRequest);
                $item->setResponseProvider($existingRp);
            }

            $this->updateEntity($entityManager, $existingRp);
            return;
        }

        $entityInstance->setStand($customerRequest->getStand());
        $entityInstance->setProvider($customerRequest->getProvider());
        $entityInstance->setExhibitor($customerRequest->getExhibitor());

        foreach ($entityInstance->getRequestedItems() as $item) {
            $item->setCustomerRequest($customerRequest);
            $item->setResponseProvider($entityInstance);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }


   public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            if (!$entityInstance instanceof ResponseProvider) {
                return;
            }

            $customerRequest = $entityInstance->getCustomerRequest();

            if (!$customerRequest) {
                throw new \RuntimeException('CustomerRequest must be set before updating ResponseProvider.');
            }

            $entityInstance->setStand($customerRequest->getStand());
            $entityInstance->setProvider($customerRequest->getProvider());
            $entityInstance->setExhibitor($customerRequest->getExhibitor());

            foreach ($entityInstance->getRequestedItems() as $item) {
                if (!$item->getCustomerRequest()) {
                    $item->setCustomerRequest($customerRequest);
                }
                if (!$item->getResponseProvider()) {
                    $item->setResponseProvider($entityInstance);
                }
              
            }

            parent::updateEntity($entityManager, $entityInstance);
        }
    
}
