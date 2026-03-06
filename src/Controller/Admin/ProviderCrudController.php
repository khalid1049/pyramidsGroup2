<?php

namespace App\Controller\Admin;

use App\Entity\Provider;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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
            TextField::new('user.username', 'Username'),
            TextField::new('user.firstName', 'First Name'),
            TextField::new('user.lastName', 'Last Name'),
            TextField::new('user.phone', 'Phone'),
            TextField::new('user.password','Password')->hideOnIndex()->hideOnDetail()->setFormTypeOption('attr', ['type' => 'password', 'placeholder'=>'set your new password']) ->setFormTypeOption('data', '')->setRequired(true),
            TextField::new('adresse'),
            TextField::new('activityType'),
            TextEditorField::new('serviceOffered'),
            

        ];
    }
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            // ->add(Crud::PAGE_EDIT, Action::SAVE_AND_ADD_ANOTHER)
        ;
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
