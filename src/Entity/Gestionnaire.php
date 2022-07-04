<?php

namespace App\Entity;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GestionnaireRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: GestionnaireRepository::class)]
#[ApiResource()]
class Gestionnaire extends User
{

    #[ORM\OneToMany(mappedBy: 'gestionnaire', targetEntity: Menu::class)]
    private $menus;

    #[ORM\OneToMany(mappedBy: 'gestionnaire', targetEntity: Burger::class)]
    #[ApiSubresource]
    private $burgers;

    #[ORM\OneToMany(mappedBy: 'gestionnaire', targetEntity: Livreur::class)]
    private $livreur;

    public function __construct()
    {
        parent::__construct();
        $this->menus = new ArrayCollection();
        $this->burgers = new ArrayCollection();
        $this->livreur = new ArrayCollection();
    }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
            $menu->setGestionnaire($this);
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        if ($this->menus->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getGestionnaire() === $this) {
                $menu->setGestionnaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Burger>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    public function addBurger(Burger $burger): self
    {
        if (!$this->burgers->contains($burger)) {
            $this->burgers[] = $burger;
            $burger->setGestionnaire($this);
        }

        return $this;
    }

    public function removeBurger(Burger $burger): self
    {
        if ($this->burgers->removeElement($burger)) {
            // set the owning side to null (unless already changed)
            if ($burger->getGestionnaire() === $this) {
                $burger->setGestionnaire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Livreur>
     */
    public function getLivreur(): Collection
    {
        return $this->livreur;
    }

    public function addLivreur(Livreur $livreur): self
    {
        if (!$this->livreur->contains($livreur)) {
            $this->livreur[] = $livreur;
            $livreur->setGestionnaire($this);
        }

        return $this;
    }

    public function removeLivreur(Livreur $livreur): self
    {
        if ($this->livreur->removeElement($livreur)) {
            // set the owning side to null (unless already changed)
            if ($livreur->getGestionnaire() === $this) {
                $livreur->setGestionnaire(null);
            }
        }

        return $this;
    }
}
