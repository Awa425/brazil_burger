<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailValider extends AbstractController
{
    public function __invoke(Request $request, UserRepository $userRepo, EntityManagerInterface $em)
    {
        $token = $request->get('token');
        $user = $userRepo->findOneBy(['token' => $token]);
        if (!$user) {
            return new JsonResponse(['message' => "Le token n' est pas valide"], Response::HTTP_BAD_REQUEST);
        }
        if ($user->isIsEnable()) {
            return new JsonResponse(['message' => "Votre compte est deja active"], Response::HTTP_BAD_REQUEST);
        }
        if ($user->getExpireAt() < new \DateTime()) {
            return new JsonResponse(['message' => "Token expire"], Response::HTTP_BAD_REQUEST);
        }
        $user->setIsEnable(true);
        $em->flush();
        return new JsonResponse(['message' => "LE COMPTE EST ACTIVE "], Response::HTTP_OK);
    }
}
