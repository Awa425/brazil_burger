<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TailleBoissonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TailleBoissonRepository::class)]
#[ApiResource()]
class TailleBoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    // #[Groups(["menu_all"])]
    private $prix;

    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'tailleBoissons')]
    // #[Groups(["menu_all"])]
    private $taille;

    #[ORM\ManyToOne(targetEntity: Boisson::class, inversedBy: 'tailleBoissons')]
    private $boisson;

    #[ORM\OneToMany(mappedBy: 'tailleBoisson', targetEntity: TailleBoissonMenu::class)]
    private $tailleBoissonMenus;

    public function __construct()
    {
        $this->tailleBoissonMenus = new ArrayCollection();
    }

  



   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;

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

    public function getBoisson(): ?Boisson
    {
        return $this->boisson;
    }

    public function setBoisson(?Boisson $boisson): self
    {
        $this->boisson = $boisson;

        return $this;
    }

    /**
     * @return Collection<int, TailleBoissonMenu>
     */
    public function getTailleBoissonMenus(): Collection
    {
        return $this->tailleBoissonMenus;
    }

    public function addTailleBoissonMenu(TailleBoissonMenu $tailleBoissonMenu): self
    {
        if (!$this->tailleBoissonMenus->contains($tailleBoissonMenu)) {
            $this->tailleBoissonMenus[] = $tailleBoissonMenu;
            $tailleBoissonMenu->setTailleBoisson($this);
        }

        return $this;
    }

    public function removeTailleBoissonMenu(TailleBoissonMenu $tailleBoissonMenu): self
    {
        if ($this->tailleBoissonMenus->removeElement($tailleBoissonMenu)) {
            // set the owning side to null (unless already changed)
            if ($tailleBoissonMenu->getTailleBoisson() === $this) {
                $tailleBoissonMenu->setTailleBoisson(null);
            }
        }

        return $this;
    }

}
