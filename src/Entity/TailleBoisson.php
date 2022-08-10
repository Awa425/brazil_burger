<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TailleBoissonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TailleBoissonRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'normalization_context' => ['groups' => ['tailleBoisson:read']],    
        ],
        "post" => [
            'denormalization_context' => ['groups' => ['tailleBois:write']],
            // "security" => "is_granted('ROLE_GESTIONNAIRE')",
            // "security_message" => "Vous n'avez pas access à cette Ressource",
        ]
        ],
    subresourceOperations: [
        'api_tailles_taille_boissons_get_subresource' => [
           'normalization_context' => ['groups' => ['tailleSubressource:read']],
        ]
    ]
)]
class TailleBoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['menu:read','tailleBoisson:read'])]
    private $id;

    // #[ORM\Column(type: 'string', length: 50, nullable: true)]
    // // #[Groups(["menu_all"])]
    // private $prix;

    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'tailleBoissons')]
    #[Groups(['menu:read','tailleBois:write','tailleBoisson:read'])]
    private $taille;

   

    // #[ORM\OneToMany(mappedBy: 'tailleBoisson', targetEntity: TailleBoissonMenu::class)]
    // private $tailleBoissonMenus;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['menu:read','tailleSubressource:read','catalogue:read','tailleBois:write'])]
    private $stock;

    #[ORM\OneToMany(mappedBy: 'tailleBoisson', targetEntity: LignecommandeTailleboisson::class)]
    #[Groups(['tailleBoisson:read'])]
    private $lignecommandeTailleboissons;

    #[ORM\ManyToOne(targetEntity: Boisson::class, inversedBy: 'tailleBoissons')]
    #[Groups(['tailleSubressource:read','catalogue:read','tailleBois:write','tailleBoisson:read'])]
    private $boisson;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $prix;

    public function __construct()
    {
        $this->lignecommandeTailleboissons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

  


    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return Collection<int, LignecommandeTailleboisson>
     */
    public function getLignecommandeTailleboissons(): Collection
    {
        return $this->lignecommandeTailleboissons;
    }

    public function addLignecommandeTailleboisson(LignecommandeTailleboisson $lignecommandeTailleboisson): self
    {
        if (!$this->lignecommandeTailleboissons->contains($lignecommandeTailleboisson)) {
            $this->lignecommandeTailleboissons[] = $lignecommandeTailleboisson;
            $lignecommandeTailleboisson->setTailleBoisson($this);
        }

        return $this;
    }

    public function removeLignecommandeTailleboisson(LignecommandeTailleboisson $lignecommandeTailleboisson): self
    {
        if ($this->lignecommandeTailleboissons->removeElement($lignecommandeTailleboisson)) {
            // set the owning side to null (unless already changed)
            if ($lignecommandeTailleboisson->getTailleBoisson() === $this) {
                $lignecommandeTailleboisson->setTailleBoisson(null);
            }
        }

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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

}
