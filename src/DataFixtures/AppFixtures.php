<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++)
        {
            $user = new User();

            $user->setUsername('utilisateur'.$i);
            
            $password = $this->hasher->hashPassword($user, 'password'.$i);
            $user->setPassword($password);
            if ($i <= 1)
            {
                $user->setRoles(['ROLE_ADMIN']);
            }
            else
            {
                $user->setRoles(['ROLE_USER']);
            }
            
            $manager->persist($user);
        }

        $manager->flush();
    }
}
