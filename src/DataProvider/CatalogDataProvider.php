<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Catalogue;
use App\Repository\BurgerRepository;
use App\Repository\MenuRepository;

class CatalogDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{

    public function __construct(BurgerRepository $repoBurger, MenuRepository $repoMenu)
    {
        $this->repoBurger = $repoBurger;
        $this->repoMenu = $repoMenu;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {
        $tab[] = $this->repoBurger->findBy(["etat" => true]);
        $tab[] = $this->repoMenu->findBy(["etat" => true]);
        return $tab;
    }
    //Cette methode nous permet de savoir la classe de cette provider
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass == Catalogue::class;
    }
}
