<?php
namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Produit;
use ContainerO1FXeJs\getPropertyNamerService;
use Doctrine\ORM\EntityManagerInterface;

class ProduitImagePersister implements ContextAwareDataPersisterInterface{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
       
    }

    public function supports($data, array $context = []):bool{
        return $data instanceof Produit;
        
    }
    public function persist($data, array $context = []){
       
        $data->setImage(file_get_contents($data->getPathFile()));
        $this->entityManager->persist($data);
        $this->entityManager->flush();

    }

    public function remove($data, array $context = []){

    }
}