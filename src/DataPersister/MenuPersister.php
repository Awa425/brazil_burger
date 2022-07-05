<?php
namespace App\DataPersister;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Burger;
use App\Entity\Menu;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;

class MenuPersister implements ContextAwareDataPersisterInterface{
    

    public function __construct(EntityManagerInterface $entityManager, MenuRepository $repoMenu)
    {
        $this->entityManager = $entityManager;
        $this->repoMenu = $repoMenu;
       
    }

    public function supports($data, array $context = []):bool{
        return $data instanceof Menu;
        
    }
    public function persist($data, array $context = []){
        $pourcentage = 0.05;
        $prix = ($data->findPrixBurger()+ $data->findPrixFritte()+ $data->findPrixBoisson());
        $data->setPrix($prix);
        $this->entityManager->persist($data);
        $this->entityManager->flush();


    }
    public function remove($data, array $context = []){

    }
}