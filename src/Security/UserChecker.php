<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (! $user instanceof User) 
        {
            return;
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        if (! $user instanceof User) {
            return;
        }

        // si l'utilisateur qui essye de ce connecter n'a pas vérifier son compte,
        if ( ! $user->isIsVerified()) 
        {
            // ne fonctionne pas
            // levons une execption (erreur) accompgné d'un message afin de lui epliquer le problème.
            throw new CustomUserMessageAccountStatusException('Veuillez confirmer votre compte par email avant de vous connecter.');
        }
    }
} 