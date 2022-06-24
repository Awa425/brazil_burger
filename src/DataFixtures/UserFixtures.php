<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {

        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $profils = ["GESTIONNAIRE", "CLIENT", "LIVREUR"];
        foreach ($profils as $libelle) {

            for ($i = 1; $i <= 3; $i++) {
                $user = new User();
                $user->setRoles(['ROLE_' . $libelle]);
                $user->setEmail(strtolower($libelle) . $i);
                $password = $this->encoder->hashPassword($user, 'ok');
                $user->setPassword($password);
                $manager->persist($user);
            }
            $manager->flush();
        }
    }
}
