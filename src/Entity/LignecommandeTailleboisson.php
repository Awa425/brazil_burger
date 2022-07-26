<?php

namespace App\Entity;

use App\Repository\LignecommandeTailleboissonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LignecommandeTailleboissonRepository::class)]
class LignecommandeTailleboisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: TailleBoisson::class, inversedBy: 'lignecommandeTailleboissons')]
    private $tailleBoisson;

    #[ORM\ManyToOne(targetEntity: LigneCommande::class, inversedBy: 'lignecommandeTailleboissons')]
    private $ligneCommande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(?int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getTailleBoisson(): ?TailleBoisson
    {
        return $this->tailleBoisson;
    }

    public function setTailleBoisson(?TailleBoisson $tailleBoisson): self
    {
        $this->tailleBoisson = $tailleBoisson;

        return $this;
    }

    public function getLigneCommande(): ?LigneCommande
    {
        return $this->ligneCommande;
    }

    public function setLigneCommande(?LigneCommande $ligneCommande): self
    {
        $this->ligneCommande = $ligneCommande;

        return $this;
    }
}
