<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MenuTailleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuTailleRepository::class)]
#[ApiResource()]
class MenuTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['catalogue:read'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuTailles')]
    private $menu;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['catalogue:read'])]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'menuTailles')]
    #[Groups(['catalogue:read'])]
    private $taille;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): self
    {
        $this->taille = $taille;

        return $this;
    }
}
