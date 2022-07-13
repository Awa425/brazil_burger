<?php

namespace App\EventSubscriber;

use App\Entity\Burger;
use App\Entity\Commande;
use App\Entity\Fritte;
use App\Entity\Livraison;
use App\Entity\Menu;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GestionnaireSubscriber implements EventSubscriberInterface
{
    private ?TokenInterface $token;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->token = $tokenStorage->getToken();
    }


    public static function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
        ];
    }

    private function getUser()
    {
        // dd($this->token);
        if (null === $token = $this->token) {
            return null;
        }
        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return null;
        }
        return $user;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        if ($args->getObject() instanceof Burger) {
            $args->getObject()->setGestionnaire($this->getUser());
        }
        if ($args->getObject() instanceof Menu) {
            if(count($args->getObject()->getburgerMenus())!=0){
                $args->getObject()->setGestionnaire($this->getUser());
                $args->getObject()->setPrix($args->getObject()->findPrixMenu($args->getObject())); 
            }
            else{
                dd('veuillez entrer au moins un burger');
            }
        }

        if ($args->getObject() instanceof Commande) {
            // if(count($args->getObject()->getLigneCommandes())!=0){
                $cpt = 0;
                $prix = 0;
                foreach($args->getObject()->getLigneCommandes() as $ligneCommande){
                    if($ligneCommande->getProduit() instanceof Burger or $ligneCommande->getProduit() instanceof Menu){
                        $cpt = 1;
                    }
                } 
                if($cpt == 1){ 
                    foreach($args->getObject()->getLigneCommandes() as $ligneCommande){
                        $prix += $ligneCommande->getProduit()->getPrix() * $ligneCommande->getQuanite();  
                    }
                    $prix = $prix + $args->getObject()->getZone()->getPrixLivraison();
                    $args->getObject()->setPrix($prix); 
                }
                else
                dd('veuillez entrer au moins un burger');
            // }
        }

        if ($args->getObject() instanceof Livraison) {
            $test = 1;
            $zoneRef = $args->getObject()->getCommande()[0]->getZone()->getNomZone();
            foreach($args->getObject()->getCommande() as $commande){
                if($zoneRef != $commande->getZone()->getNomZone()){
                    $test = 0;
                }
            }
            if($test==0){
                dd("Les livraison doivent se faire dans une meme zone");
            }
        }
    }
}
