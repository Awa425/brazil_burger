<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BurgerMenuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BurgerMenuRepository::class)]
// #[ApiResource()]
class BurgerMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: 'burgerMenus')]
    #[Groups('menu:read')]
    private $burger;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'burgerMenus')]
    private $menu;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups('menu:read')]
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBurger(): ?Burger
    {
        return $this->burger;
    }

    public function setBurger(?Burger $burger): self
    {
        $this->burger = $burger;

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
