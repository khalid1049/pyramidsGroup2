<?php

namespace App\EventSubscriber;

use App\Entity\Provider;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UpdateProviderSubscriber implements EventSubscriber
{
    private UserPasswordHasherInterface $hashPassword;

    public function __construct(UserPasswordHasherInterface $hashPassword)
    {
        $this->hashPassword = $hashPassword;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::preUpdate
        ];
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Provider) {
            return;
        }

        $user = $entity->getUser();

        if (!$user || !$user->getPassword()) {
            return;
        }

        // $hashedPassword = $this->passwordHasher->hashPassword($user, $password);

        $hashedPassword = $this->hashPassword->hashPassword(
            $user,
            $user->getPassword()
        );

        $user->setPassword($hashedPassword);
    }
}