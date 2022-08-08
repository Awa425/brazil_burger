<?php
namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Repository\TailleBoissonRepository;

 class TailleBoissonProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface{

    public function __construct(TailleBoissonRepository $tailleBoisson)
    {
        $this->tailleBoisson = $tailleBoisson;
    }
    
    public function getCollection(string $resourceClass, string $operationName = null, array $context = [])
    {   
        
        
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass == Catalogue::class;
    }
 }
