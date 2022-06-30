<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource(
    collectionOperations: [
        "get" => [
            "method" => "GET",
            "statut" => 200,
            "path" => "/catalogue"
        ]
    ]
)]
class Catalogue
{
    #[ApiProperty(identifier: true)]
    private $id;
}
