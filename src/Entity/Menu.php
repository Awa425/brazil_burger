<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ORM\Entity(repositoryClass: MenuRepository::class)]
#[ApiFilter(SearchFilter::class, properties: ['prix' => 'exact'])] 
#[ApiResource(
    collectionOperations: [
        "get" =>[
            'normalization_context' => ['groups' => ['menu:read']],
        ],
        "post" => [
            "security" => "is_granted('ROLE_GESTIONNAIRE')",
            "security_message" => "Vous n'avez pas access à cette Ressource",
        ]
    ] ,
    subresourceOperations: [
        'menus_get_subresource' => [
            'method' => 'GET',
            'path' => '/menus/{id}/burger_menus',
        ]
    ]   
)]
class Menu extends Produit
{

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'menus')]
    private $gestionnaire;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: FritteMenu::class, cascade:["persist"])]
    // #[SerializedName('Fritte')]
    #[Groups(['menu:read','catalogue:read'])]
    private $fritteMenus;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: BurgerMenu::class, cascade:["persist"])]
    #[Assert\NotBlank(message: "Champs obligatoire.")]
    // #[SerializedName('Burger')]
    #[Groups(['menu:read','catalogue:read'])]
    #[ApiSubresource()]
    private $burgerMenus;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuTaille::class, cascade:["persist"])]
    #[Groups(['menu:read','catalogue:read'])]
    // #[SerializedName('Boisson')]
    #[ApiSubresource()]
    private $menuTailles;



    public function __construct()
    {
        $this->fritteMenus = new ArrayCollection();
        $this->burgerMenus = new ArrayCollection();
        $this->menuTailles = new ArrayCollection();
        $this->type='MENU';
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

    public function findPrixMenu($data){
        $prix = 0;
        // dd($args->getObject()->getMenuTailles()[0]->getTaille()->getPrix());

        foreach($data->getMenuTailles() as $boisson){
            $prix += $boisson->getTaille()->getPrix() * $boisson->getQuantite();  
        }
       
        foreach($data->getFritteMenus() as $fritte){
            $prix += $fritte->getFritte()->getPrix() * $fritte->getQuantite();  
        } 
        foreach($data->getBurgerMenus() as $burger){
            $prix += $burger->getBurger()->getPrix() * $burger->getQuantite();  
        }
        return $prix;
    }

    /**
     * @return Collection<int, FritteMenu>
     */
    public function getFritteMenus(): Collection
    {
        return $this->fritteMenus;
    }

    public function addFritteMenu(FritteMenu $fritteMenu): self
    {
        if (!$this->fritteMenus->contains($fritteMenu)) {
            $this->fritteMenus[] = $fritteMenu;
            $fritteMenu->setMenu($this);
        }

        return $this;
    }

    public function removeFritteMenu(FritteMenu $fritteMenu): self
    {
        if ($this->fritteMenus->removeElement($fritteMenu)) {
            // set the owning side to null (unless already changed)
            if ($fritteMenu->getMenu() === $this) {
                $fritteMenu->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BurgerMenu>
     */
    public function getBurgerMenus(): Collection
    {
        return $this->burgerMenus;
    }

    public function addBurgerMenu(BurgerMenu $burgerMenu): self
    {
        if (!$this->burgerMenus->contains($burgerMenu)) {
            $this->burgerMenus[] = $burgerMenu;
            $burgerMenu->setMenu($this);
        }

        return $this;
    }

    public function removeBurgerMenu(BurgerMenu $burgerMenu): self
    {
        if ($this->burgerMenus->removeElement($burgerMenu)) {
            // set the owning side to null (unless already changed)
            if ($burgerMenu->getMenu() === $this) {
                $burgerMenu->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MenuTaille>
     */
    public function getMenuTailles(): Collection
    {
        return $this->menuTailles;
    }

    public function addMenuTaille(MenuTaille $menuTaille): self
    {
        if (!$this->menuTailles->contains($menuTaille)) {
            $this->menuTailles[] = $menuTaille;
            $menuTaille->setMenu($this);
        }

        return $this;
    }

    public function removeMenuTaille(MenuTaille $menuTaille): self
    {
        if ($this->menuTailles->removeElement($menuTaille)) {
            // set the owning side to null (unless already changed)
            if ($menuTaille->getMenu() === $this) {
                $menuTaille->setMenu(null);
            }
        }

        return $this;
    }
}
