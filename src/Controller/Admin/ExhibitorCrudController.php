<?php

namespace App\Controller\Admin;

use App\Entity\Exhibitor;
use App\Entity\Stand;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField as FieldFormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExhibitorCrudController extends AbstractCrudController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
   
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
            TextField::new('facia_name')
                    ->setLabel('facia_name')
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

       
        ];
    }

     public function configureActions(Actions $actions): Actions
    {
        $import = Action::new('importExcel', 'Import Excel')
        ->linkToCrudAction('importExcel')
        ->createAsGlobalAction();

        return $actions
            // ...
            ->add(Crud::PAGE_INDEX, $import)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            // ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
            
        ;
    }

    public function importExcel(Request $request): Response
    {
        if ($request->isMethod('POST')) {

            $file = $request->files->get('excel');

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            // dd($file);
            $rows = $spreadsheet->getActiveSheet()->toArray();

            $entityManager = $this->entityManager;

            foreach ($rows as $index => $row) {

                if ($index === 0) continue; // skip header

                // dd($row[0]);

                $exhibitor = new Exhibitor();

                // $exhibitor->setPhone($row[2] ?? null);
                $exhibitor->setCompanyName($row[0]);
                $exhibitor->setFaciaName($row[2]);
                $exhibitor->setCountry($row[1]);
                $exhibitor->setProductGroup($row[3]);
                $stand = new Stand();
                $stand->setNumber($row[4]); 
                $stand->settype($row[6]);
                $stand->setSize($row[7]);
                $stand->setOpenSide($row[8]);
                $exhibitor->addStand($stand);
                $exhibitor->setSqm($row[5]);


                // $exhibitor->addStand($row[4]);
                // $exhibitor->
                // $exhibitor->setSectorActivity($row[5] ?? null);
                // $exhibitor->setProductDisplay($row[6] ?? null);
                // $exhibitor->setAdresse($row[7] ?? null);
                // $exhibitor->setEmail($row[8] ?? null);

                $entityManager->persist($exhibitor);
                $entityManager->persist($stand);

            }

            $entityManager->flush();

            $this->addFlash('success', 'Excel imported successfully');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/import_excel.html.twig');
    }
    
}
