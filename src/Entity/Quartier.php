<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\QuartierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: QuartierRepository::class)]
#[ApiResource()]
class Quartier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $nom_quartier;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'quartiers')]
    private $zone;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomQuartier(): ?string
    {
        return $this->nom_quartier;
    }

    public function setNomQuartier(?string $nom_quartier): self
    {
        $this->nom_quartier = $nom_quartier;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }
}
