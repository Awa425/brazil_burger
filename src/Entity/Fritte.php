<?php

namespace App\Entity;

use App\Repository\FritteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FritteRepository::class)]
class Fritte extends Complement
{
}
