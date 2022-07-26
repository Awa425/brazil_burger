<?php

namespace App\Entity;

use App\Repository\FritteMenuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FritteMenuRepository::class)]
class FritteMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'fritteMenus')]
    private $menu;

    #[ORM\ManyToOne(targetEntity: Fritte::class, inversedBy: 'fritteMenus')]
    #[Groups(['menu:read'])]
    private $fritte;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['menu:read'])]
    private $quantite;

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

    public function getFritte(): ?Fritte
    {
        return $this->fritte;
    }

    public function setFritte(?Fritte $fritte): self
    {
        $this->fritte = $fritte;

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
