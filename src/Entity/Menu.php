<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu extends Produit
{

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $nom_menu;


    public function getNomMenu(): ?string
    {
        return $this->nom_menu;
    }

    public function setNomMenu(?string $nom_menu): self
    {
        $this->nom_menu = $nom_menu;

        return $this;
    }
}
