<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FritteRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\Entity(repositoryClass: FritteRepository::class)]
#[ApiResource()]
class Fritte extends Produit
{

    public function getId(): ?int
    {
        return $this->id;
    }
}
