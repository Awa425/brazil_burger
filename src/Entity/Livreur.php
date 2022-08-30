<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreurRepository;
use PhpParser\Node\Scalar\MagicConst\Dir;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
#[ApiResource(
    collectionOperations:[
        'post',
        'get' => [
            'normalization_context' => ['groups' => ['livreur:read']],
        ]
    ],
    subresourceOperations: [
        'tailles_get_subresource' => [
            'method' => 'GET',
            'path' => '/livreurs/{id}/livraisons',
        ]
    ],
    itemOperations:[
        'put',
        'get'=>['normalization_context' => ['groups' => ['itemLivreur:read']],]
    ]
)]
class Livreur extends User
{
    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['livreur:read','livraison:read','itemLivreur:read'])]
    private $telephone;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Groups(['livreur:read','livraison:read','itemLivreur:read'])]
    private $matricule;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'livreur')]
    private $gestionnaire;

    #[ORM\OneToMany(mappedBy: 'livreur', targetEntity: Livraison::class)]
    #[Groups(['itemLivreur:read'])]
    #[ApiSubresource()]
    private $livraisons;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    #[Groups(['livreur:read','itemLivreur:read'])]
    private $disponibilite;

    public function __construct()
    {
        parent::__construct();
        $this->disponibilite = "oui";
        $this->livraisons = new ArrayCollection();
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): self
    {
        $this->matricule = $matricule;

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
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons[] = $livraison;
            $livraison->setLivreur($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getLivreur() === $this) {
                $livraison->setLivreur(null);
            }
        }

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(?string $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }
}
