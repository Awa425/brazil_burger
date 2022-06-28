<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ComplementRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "descrim", type: "string")]
#[ORM\DiscriminatorMap(["fritte" => "Fritte", "boisson" => "Boisson"])]
#[ORM\Entity(repositoryClass: ComplementRepository::class)]

#[ApiResource()]
class Complement extends Produit
{
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected $nature;

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(?string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }
}
