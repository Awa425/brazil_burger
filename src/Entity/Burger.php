<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
// use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Response;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['simple']],
        ],
        "post" => [
            // 'denormalization_context' => ['groups' => ['write']],
            // 'normalization_context' => ['groups' => ['all']],
            "security" => "is_granted('ROLE_GESTIONNAIRE')",
            "security_message" => "Vous n'avez pas access à cette Ressource",
        ]
    ],
    itemOperations: [
        "get" => [
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['all']],
        ],
        "put" => [
            'method' => 'put',
            "security" => "is_granted('ROLE_GESTIONNAIRE')",
            "security_message" => "Vous n'avez pas access à cette Ressource",
            'status' => Response::HTTP_OK,
        ]
    ]
)]

class Burger extends Produit
{



    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'burgers')]
    private $menus;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'burgers')]
    // #[Groups(["all"])]
    private $gestionnaire;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
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

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }
}
