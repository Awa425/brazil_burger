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
        foreach ($profils as $key => $libelle) {
            $profil = new Profil();
            $profil->setLibelle($libelle);
            $manager->persist($profil);
            $manager->flush();
            for ($i = 1; $i <= 3; $i++) {
                $user = new User();
                $user->setProfil($profil);
                $user->setEmail(strtolower($libelle) . $i);
                //Génération des Users

                $password = $this->encoder->hashPassword($user, 'ok');
                $user->setPassword($password);
                $manager->persist($user);
            }
            $manager->flush();
        }
    }
}
