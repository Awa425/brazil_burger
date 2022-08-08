<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BurgerMenuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BurgerMenuRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => ['burgerMenu:read']],  
        ],
        "post" 
    ],
    subresourceOperations: [
        'api_menus_burger_menus_get_subresource' => [
           'normalization_context' => ['groups' => ['burgerSubresource:read']],
        ]
    ]
)]
class BurgerMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('catalogue:read')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: 'burgerMenus')]
    #[Groups("menu:read",'catalogue:read','burger:read','catalogue:read','burgerSubresource:read','burgerMenu:read')]
    private $burger;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'burgerMenus')]
    // #[Groups('catalogue:read')]
    private $menu;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups('menu:read','catalogue:read','burgerSubresource:read','burgerMenu:read')]
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
