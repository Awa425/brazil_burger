<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FritteRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\PostImageController;

#[ORM\Entity(repositoryClass: FritteRepository::class)]
#[ApiResource()]
class Fritte extends Produit
{

  

    #[ORM\OneToMany(mappedBy: 'fritte', targetEntity: FritteMenu::class)]
    private $fritteMenus;

    public function __construct()
    {
        $this->fritteMenus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $fritteMenu->setFritte($this);
        }

        return $this;
    }

    public function removeFritteMenu(FritteMenu $fritteMenu): self
    {
        if ($this->fritteMenus->removeElement($fritteMenu)) {
            // set the owning side to null (unless already changed)
            if ($fritteMenu->getFritte() === $this) {
                $fritteMenu->setFritte(null);
            }
        }

        return $this;
    }
}
