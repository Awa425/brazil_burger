<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ComplementRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "descrim", type: "string")]
#[ORM\DiscriminatorMap(["complement" => "Complement"])]
#[ORM\Entity(repositoryClass: ComplementRepository::class)]
#[ApiResource(
    collectionOperations: ['GET'],
    itemOperations: ['GET']
)]
class Complement extends Produit
{
    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    protected $nature;

    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'complements')]
    private $menus;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(?string $nature): self
    {
        $this->nature = $nature;
        return $this;
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
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }
}
