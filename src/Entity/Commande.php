<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Date;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" ,
        "post" => [
            'denormalization_context' => ['groups' => ['commande:writes']]
        ]
    ],
    subresourceOperations: [
        'api_clients_commandes_get_subresource' => [
           'normalization_context' => ['groups' => ['clentsSubressource:read']],
        ]
    ],
    itemOperations: [
        "get"  =>[
            'normalization_context' => ['groups' => ['commande:writes']],
        ],
        "put" => [
            'denormalization_context' => ['groups' => ['commandePatch:write']]
        ]
    ]
)]
// #[ApiFilter(SearchFilter::class, properties: ['zone' => 'partial'])] 
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['livraison:read','clentsSubressource:read','itemCommande:read','zone:read', 'livraison:write'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'commande')]
    private $livraison;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'commande')]
    #[Groups(['commande:write','itemCommande:read','clentsSubressource:read','lire:commande','commande:writes','livraison:read'])] 
    private $zone;

    #[ORM\Column(type: 'datetime', nullable: true)]
    #[Groups(['clentsSubressource:read','itemCommande:read','lire:commande','commande:writes'])]
    private $date;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $prix;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    #[Groups(['commande:writes','lire:commande','zone:read','livraison:read'])]
    private $client;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    #[Groups(['clentsSubressource:read','commandePatch:write','zone:read'])]
    private $etat = "en cours";

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: LigneCommande::class, cascade:["persist"])]
    #[Groups(['commande:writes','itemCommande:read','commande:write','clentsSubressource:read','zone:read'])]
    private $ligneCommande;

    public function __construct()
    {
        $this->date=new DateTime();
        $this->ligneCommande = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): self
    {
        $this->livraison = $livraison;

        return $this;
    }

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

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



    public function findPrixCommande($data){
        $prix = 0;
        // foreach($data->getTailleBoissonMenus() as $boisson){
        //     $prix += $boisson->getTailleBoisson()->getPrix() * $boisson->getQuantite();  
        // }
       
        foreach($data->getFritteMenus() as $fritte){
            $prix += $fritte->getFritte()->getPrix() * $fritte->getQuantite();  
        } 
        foreach($data->getBurgerMenus() as $burger){
            $prix += $burger->getBurger()->getPrix() * $burger->getQuantite();  
        }
        return $prix;
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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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
   

    /**
     * Get the value of ligneCommandes
     */

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommande(): Collection
    {
        return $this->ligneCommande;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommande->contains($ligneCommande)) {
            $this->ligneCommande[] = $ligneCommande;
            $ligneCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommande->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getCommande() === $this) {
                $ligneCommande->setCommande(null);
            }
        }

        return $this;
    } 
    /**
     * Set the value of ligneCommande
     *
     * @return  self
     */ 
    public function setLigneCommande($ligneCommande)
    {
        $this->ligneCommande = $ligneCommande;

        return $this;
    }
}
