<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiFilter(SearchFilter::class, properties: ['email' => 'exact'])]
#[ApiResource(
    collectionOperations: [
        "get" =>[
            // 'normalization_context' => ['groups' => ['client:read']],
        ],
        "post" => [
            'denormalization_context' => ['groups' => ['client:write']]
        ]
    ],
    subresourceOperations: [
        'clients_get_subresource' => [
            'method' => 'GET',
            'path' => '/clients/{id}/commandes',
        ]
    ]
)]
class Client extends User
{
    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Groups(['client:write','zone:read','livraison:read'])]
    private $telephone;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $adresse;

    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commande::class)]
    #[ApiSubresource()]
    private $commandes;

    public function __construct()
    {
        parent::__construct();
        $this->commandes = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }
}
