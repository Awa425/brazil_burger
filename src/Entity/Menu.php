<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiResource(
    collectionOperations: [
        "post" => [
            'normalization_context' => ['groups' => ['menu_all']],
            // "security" => "is_granted('ROLE_GESTIONNAIRE')",
            // "security_message" => "Vous n'avez pas access à cette Ressource",
        ]
    ]
)]
class Menu extends Produit
{

    #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'menus')]
    private $burgers;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'menus')]
    #[Groups(["menu_all"])]
    private $gestionnaire;

    #[ORM\ManyToMany(targetEntity: Fritte::class, inversedBy: 'menus')]
    private $fritte;

    #[ORM\ManyToMany(targetEntity: TailleBoisson::class, mappedBy: 'menu')]
    private $tailleBoissons;

    public function __construct()
    {
        $this->burgers = new ArrayCollection();
        $this->fritte = new ArrayCollection();
        $this->tailleBoissons = new ArrayCollection();
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
            $burger->addMenu($this);
        }

        return $this;
    }

    public function removeBurger(Burger $burger): self
    {
        if ($this->burgers->removeElement($burger)) {
            $burger->removeMenu($this);
        }

        return $this;
    }

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    /**
     * @return Collection<int, Fritte>
     */
    public function getFritte(): Collection
    {
        return $this->fritte;
    }

    public function addFritte(Fritte $fritte): self
    {
        if (!$this->fritte->contains($fritte)) {
            $this->fritte[] = $fritte;
        }

        return $this;
    }

    public function removeFritte(Fritte $fritte): self
    {
        $this->fritte->removeElement($fritte);

        return $this;
    }

    /**
     * @return Collection<int, TailleBoisson>
     */
    public function getTailleBoissons(): Collection
    {
        return $this->tailleBoissons;
    }

    public function addTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if (!$this->tailleBoissons->contains($tailleBoisson)) {
            $this->tailleBoissons[] = $tailleBoisson;
            $tailleBoisson->addMenu($this);
        }

        return $this;
    }

    public function removeTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if ($this->tailleBoissons->removeElement($tailleBoisson)) {
            $tailleBoisson->removeMenu($this);
        }

        return $this;
    }
}
