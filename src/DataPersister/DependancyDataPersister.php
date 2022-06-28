<?php

namespace App\DataPersister;

use App\Entity\User;
use App\Services\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class DependancyDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(UserPasswordHasherInterface $encoder, EntityManagerInterface $entityManager, Mailer $mailer)
    {
        $this->entityManager = $entityManager;
        $this->encoder = $encoder;
        $this->mailer = $mailer;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function persist($data, array $context = [])
    {
        $password = $this->encoder->hashPassword($data, $data->getPassword());
        $data->setPassword($password);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
        $this->mailer->sendEmail($data);
    }

    public function remove($data, array $context = [])
    {
        // call your persistence layer to delete $data
    }

    // Once called this data persister will resume to the next one
    public function resumable(array $context = []): bool
    {
        return true;
    }
}
