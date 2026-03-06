<?php

namespace App\EventSubscriber;

use App\Entity\Event;
use App\Entity\Provider;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class CreateProviderSubscriber implements EventSubscriberInterface
{

    private $entityManager, $hashPassword;

    public function __construct(EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $hashPassword)
    {
        $this->entityManager = $entityManagerInterface;
        $this->hashPassword = $hashPassword;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            // Events::preUpdate

        ];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        //dd($entity->getClient()); 
        if ($entity instanceof Provider) {

            $provider = $entity;
            $user = $provider->getUser();
            // $userPassword = $provider->getUser();

            $hash = $this->hashPassword->hashPassword(
                $user,
                $user->getPassword()
            );

            if ($user) {
                $user->setRoles([User::ROLE_PRESTATAIRE]);
                $user->setPassword($hash);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
            }
        }
    }
}
