<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GestionnaireRepository;

#[ORM\Entity(repositoryClass: GestionnaireRepository::class)]
class Gestionnaire extends User
{

    public function __construct()
    {
    }
}
