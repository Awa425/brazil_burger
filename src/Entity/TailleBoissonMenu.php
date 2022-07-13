<?php

namespace App\Entity;

use App\Repository\TailleBoissonMenuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TailleBoissonMenuRepository::class)]
class TailleBoissonMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: TailleBoisson::class, inversedBy: 'tailleBoissonMenus')]
    private $tailleBoisson;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'tailleBoissonMenus')]
    private $menu;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
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
}
