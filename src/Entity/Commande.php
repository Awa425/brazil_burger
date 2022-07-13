<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
   normalizationContext: [
       'groups' => ['read:commande']
   ]
)]
// #[ApiFilter(SearchFilter::class, properties: ['zone' => 'partial'])] 
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['read:commande'])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'commande')]
    private $livraison;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'commande')]
    #[Groups(['read:commande'])]
    private $zone;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $etat = true;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: LigneCommande::class, cascade:["persist"])]
    #[Groups(['read:commande'])]
    private $ligneCommandes;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $prix;

    public function __construct()
    {
        $this->ligneCommandes = new ArrayCollection();
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

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(?bool $etat): self
    {
        $this->etat = $etat;

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

    /**
     * @return Collection<int, LigneCommande>
     */
    public function getLigneCommandes(): Collection
    {
        return $this->ligneCommandes;
    }

    public function addLigneCommande(LigneCommande $ligneCommande): self
    {
        if (!$this->ligneCommandes->contains($ligneCommande)) {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLigneCommande(LigneCommande $ligneCommande): self
    {
        if ($this->ligneCommandes->removeElement($ligneCommande)) {
            // set the owning side to null (unless already changed)
            if ($ligneCommande->getCommande() === $this) {
                $ligneCommande->setCommande(null);
            }
        }

        return $this;
    }


    public function findPrixCommande($data){
        $prix = 0;
        foreach($data->getTailleBoissonMenus() as $boisson){
            $prix += $boisson->getTailleBoisson()->getPrix() * $boisson->getQuantite();  
        }
       
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
   
}
