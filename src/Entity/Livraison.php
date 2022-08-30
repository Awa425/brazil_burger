<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LivraisonRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
#[ApiResource(
    collectionOperations:[
        // 'get',
        'post' => [
            'denormalization_context' => ['groups' => ['livraison:write']],
        ],
        'get' => [
            'normalization_context' => ['groups' => ['livraison:read']],
        ]
    ],
    itemOperations:[
        'put',
        'get' => [
            'normalization_context' => ['groups' => ['livraison:read']],
        ]
    ],
    subresourceOperations: [
        'api_livreurs_livraisons_get_subresource' => [
        //    'normalization_context' => ['groups' => ['livraisonsSubressource:read']],
        ]
    ]
)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['livraison:read'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Livreur::class, inversedBy: 'livraisons')]
    #[Groups(['livraison:write','livraison:read'])]
    private $livreur;

    #[ORM\OneToMany(mappedBy: 'livraison', targetEntity: Commande::class)]
    #[Groups(['livraison:write','livraison:read','itemLivreur:read'])]
    private $commande;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['livraison:write','livraison:read'])]
    private $date;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['livraison:read'])]
    private $etat;

    public function __construct()
    {
        $this->date=new DateTime();
        $this->etat='etape 1';
        $this->commande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivreur(): ?Livreur
    {
        return $this->livreur;
    }

    public function setLivreur(?Livreur $livreur): self
    {
        $this->livreur = $livreur;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
            $commande->setLivraison($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getLivraison() === $this) {
                $commande->setLivraison(null);
            }
        }

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
