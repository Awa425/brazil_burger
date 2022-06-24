<?php

namespace App\Entity;

use App\Repository\ComplementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "desc", type: "string")]
#[ORM\DiscriminatorMap(["fritte" => "Fritte", "boisson" => "Boisson"])]
#[ORM\Entity(repositoryClass: ComplementRepository::class)]
class Complement extends Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected $nature;

    public function getId(): ?int
    {
        return $this->id;
    }

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
