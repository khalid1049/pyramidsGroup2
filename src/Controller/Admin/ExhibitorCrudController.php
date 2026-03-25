<?php

namespace App\Controller\Admin;

use App\Entity\Exhibitor;
use App\Entity\Stand;
// use App\Entity\Stand;
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
                'placeholder' => 'Enter the phone of exhibitor'
            ]),
            TextField::new('user.username', 'Username')
                    ->setLabel('<i class="fa-solid fa-circle-user adding"></i> Username')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the user name of exhibitor'
            ]),
            TextField::new('user.password','Password')->hideOnIndex()->hideOnDetail()
                    ->setLabel('<i class="fa-solid fa-lock adding"></i> Password')
                    ->setFormTypeOption('attr', ['type' => 'password', 'placeholder'=>'Enter the password of exhibitor'])
                    ->setFormTypeOption('data', '')->setRequired(true),


            FieldFormField::addTab('company Informations'),
            FieldFormField::addRow(),
            FieldFormField::addColumn('col-lg-4 col-xl-4'),

            TextField::new('CompanyName')
                    ->setLabel('<i class="fa-solid fa-building adding"></i> Company')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the company of exhibitor'
            ]),
            TextField::new('facia_name')
                    ->setLabel('facia_name')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter l\'entreprise d\'exposant'
            ]),
            CountryField::new('country')
                    ->setLabel('<i class="fa-solid fa-globe adding"></i> Country')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the country of exhibitor'
            ]),
            FieldFormField::addColumn('col-lg-4 col-xl-4'),

            TextField::new('sectorActivity')
                    ->setLabel('<i class="fa-solid fa-briefcase adding"></i> Sector of activity')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the exhibitor\'s sector of activity'
            ]),
            TextField::new('productDisplay')
                    ->setLabel('<i class="fa-solid fa-box adding"></i> Product')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter exhibitor\'s product'
            ]),
            FieldFormField::addColumn('col-lg-4 col-xl-4'),

            TextField::new('adresse')
                    ->setLabel('<i class="fa-solid fa-address-card adding"></i> Adress')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the adress of exhibitor'
            ]),
            TextField::new('email')
                    ->setLabel('<i class="fa-solid fa-at adding"></i> Email')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter email of exhibitor'
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
