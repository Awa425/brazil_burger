<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BoissonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
#[ApiResource(
    normalizationContext:[
        'groups' => ['boisson:read']
    ],
    denormalizationContext:[
        'groups' => ['boisson:write']
    ]
)]
class Boisson extends Produit
{
    #[ORM\OneToMany(mappedBy: 'boisson', targetEntity: TailleBoisson::class)]
    // #[Groups(['boisson:read'])]
    private $tailleBoissons;

    public function __construct()
    {
        $this->type='BOISSON';
        $this->tailleBoissons = new ArrayCollection();
    }

    /**
     * @return Collection<int, TailleBoisson>
     */
    public function getTailleBoissons(): Collection
    {
        return $this->tailleBoissons;
    }

    public function addTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if (!$this->tailleBoissons->contains($tailleBoisson)) {
            $this->tailleBoissons[] = $tailleBoisson;
            $tailleBoisson->setBoisson($this);
        }

        return $this;
    }

    public function removeTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if ($this->tailleBoissons->removeElement($tailleBoisson)) {
            // set the owning side to null (unless already changed)
            if ($tailleBoisson->getBoisson() === $this) {
                $tailleBoisson->setBoisson(null);
            }
        }

        return $this;
    }



}
