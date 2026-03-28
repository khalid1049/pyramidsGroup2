<?php

namespace App\Controller\Admin;

use App\Entity\Provider;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProviderCrudController extends AbstractCrudController
{

    private $hashPassword;

    public static function getEntityFqcn(): string
    {
        return Provider::class;
    }


    public function __construct(UserPasswordHasherInterface $hashPassword)
    {
        $this->hashPassword = $hashPassword;        
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [

            IdField::new('id')->onlyOnIndex(),
            FormField::addTab('User Informations'),

            
            TextField::new('user.firstName', 'First Name')
                    ->setLabel('<i class="fa-solid fa-user adding"></i> First Name')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the first name of provider',

            ]),
            TextField::new('user.lastName', 'Last Name')
                    ->setLabel('<i class="fa-solid fa-user adding"></i> Last Name')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the last name of provider'
            ]),
            TextField::new('user.phone', 'Phone')
                    ->setLabel('<i class="fa-solid fa-phone adding"></i> Phone')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the number phone of provider'
            ]),
            TextField::new('user.username', 'Username')
                    ->setLabel('<i class="fa-solid fa-circle-user adding"></i> Username')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the user name of provider'
            ]),
            TextField::new('user.password','Password')->hideOnIndex()->hideOnDetail()
                    ->setLabel('<i class="fa-solid fa-lock adding"></i> Password')
                    ->setFormTypeOption('attr', ['type' => 'password', 'placeholder'=>'Enter the password of provider'])
                     ->setFormTypeOption('data', '')->setRequired(true),

            FormField::addTab('Other Informations'),
            TextField::new('adresse')
                    ->setLabel('<i class="fa-solid fa-address-card adding"></i> Adress')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the adress of provider'
            ]),
            TextField::new('activityType')
                    ->setLabel('<i class="fa-solid fa-briefcase adding"></i> Type of activity')
                    ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the provider\'s type of activity'
            ]),
            TextareaField::new('serviceOffered')
                        ->setLabel('<i class="fa-solid fa-handshake adding"></i> Service offered')
                        ->setFormTypeOption('attr', [
                'placeholder' => 'Enter the provider\'s service'
            ]),
            

        ];
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
