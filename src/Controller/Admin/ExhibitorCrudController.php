<?php

namespace App\Controller\Admin;

use App\Entity\Exhibitor;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CountryField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField as FieldFormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ExhibitorCrudController extends AbstractCrudController
{
    private $hashPassword;
    public static function getEntityFqcn(): string
    {
        return Exhibitor::class;
    }

    public function __construct(UserPasswordHasherInterface $hashPassword)
    {
        $this->hashPassword = $hashPassword;        
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            
            IdField::new('id')->onlyOnIndex(),

            FieldFormField::addTab('User Informations'),

            FieldFormField::addRow(),
            
            FieldFormField::addColumn('col-lg-6 col-xl-6'),
            TextField::new('user.firstName', 'First Name')
                    ->setLabel('<i class="fa-solid fa-user adding"></i> First Name')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the first name of exhibitor'
            ]),
            TextField::new('user.lastName', 'Last Name')
                    ->setLabel('<i class="fa-solid fa-user adding"></i> Last Name')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the last name of exhibitor'
            ]),
            TelephoneField::new('user.phone', 'Phone')
                    ->setLabel('<i class="fa-solid fa-phone adding"></i> Phone')
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

            // FieldFormField::addTab('Stand Informations'),
            // FieldFormField::addRow(),

            // FieldFormField::addColumn('col-lg-4 col-xl-4'),
            // TextField::new('stand.surface')
            //         ->setLabel('numéro de stand')
            //         ->setFormTypeOption('attr', [
            //     'placeholder' => 'Enter le numéro de stand d\'exposant'
            // ]),
            // TextField::new('stand.number')
            //         ->setLabel('numéro de stand')
            //         ->setFormTypeOption('attr', [
            //     'placeholder' => 'Enter le numéro de stand d\'exposant'
            // ]),

            NumberField::new('stand.surface')
                    ->setLabel('surface de stand')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter la surface de stand d\'exposant'
            ]),
            ChoiceField::new('stand.type')
                    ->setLabel('type de stand')
                    ->setChoices([
                        'Modulaire' => 'Modulaire',
                        'Personnalisé' => 'Personnalisé',
                    ])
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter le type de stand d\'exposant'
            ]),

            // BooleanField::new('stand.status')
            //         ->setLabel('status de stand')
            //         ->setFormTypeOption('attr', [
            //     'placeholder' => 'Enter le status de stand d\'exposant'
            // ]),
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
    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        parent::updateEntity($entityManager, $entityInstance);

        $user = $entityInstance->getUser();

        $hash = $this->hashPassword->hashPassword(
            $user,
            $user->getPassword()
        );
        
        $user->setPassword($hash);

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }
}
