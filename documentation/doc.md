#Connexion gestionnaire:
` {
  "email": "gestionnaire@gmail.com",
  "password": "ok",
  "prenom": "MyBoy",
  "nom": "Diop",
  "etat": true
} `


# Password "ok"
# API Autodécouvrable: `C'est un api qui nous permet lorsqu'on est sur une ressource d'obtenir toutes les endPoint nous permettant d'acceder à cette ressource(Par exemple:API PLATEFORM).`

# API Autodecrite: `Si on a une action que l'on doit effectuer sur une ressource,on doit connaitre les données que l'on doit lui transmettre dans l'entete(Header) et on doit savoir aussi quel format de donnees il va retounée.`

# JWT(Json Web Token): `Il nous perment de realiser la partie connexion de notre projet`

# Dans api plate forme le format Json permet d'afficher les donnees du Response en format `json`.

# Dans api plate forme le format Json Ld permet d'afficher en plus des donnees la descriptions du response `ld-json`.

# Dans la Requete POST: ` La Response et la Request contiennentt des informations `

# Dans la Requete GET: ` La Response contient des informations tandis que la Request est vide `

# Fixer les opérations possibles sur le burger:
* Collection Operations:`Ce sont les opérations qui s'appliquent sur une collection de données c'est à dire une Liste`
`Par exemple: GETALL recupere tous les Burgers donc on à une opération de collections qui s'appliquent sur plusiers valeurs plus l'opération de creation(POST).`
* Item Operations:`C'est une opération qui n'est pas un ajout et n'impacte qu'un seul élément`
`En d'autre terme c'est toutes les opérations qui s'appliquent sur une seule valeur de l'element.`
`Par exemple: GetById,PUT,DELETE s'appliquent sur une seule valeur.`

* #[ApiResource(
    `collectionOperations:["get","post"]` 
    `itemOperations:["put","get"]`
    )]
* Cette annotation nous permet de définir les verbes qu'on veut utiliser dans API PLATEFORM
* Ainsi dans cet exemple ci dessus on aura les verbes:
`GET:Recupere toutes les données de la ressource`
`POST: Ajoute un element dans la ressource`
`PUT(modifier(id)): Modifie un element dans la ressource`
`GET(recuperer(id): Recupere un element dans la ressource` 

# Notion de Normalisation (Object vers Array)
* Sur l'entité :
`NB: La Normalisation permet de définir le format de donnee de la réponse avec la notion de Groups.`
`Lors de l'opération GET(ALL) si on veut cacher certaines informations,c'est moment de la normalisation qu'on agit . Donc elle nous permet d' afficher ce qu'on veut afficher lorsqu' on recupere l'objet.`

# Notion de Denormalisation (Array vers Object)
* Sur l'entité :
`NB: La Normalisation permet de définir le format de la donnee de la réponse avec la notion de Groups.`

# NB: Un Data Persister :
`Il permet de redéfinir les opérations de persist(insert,update) ou de remove(suppression)`

# EventSubscriber:
` C'est un ecouteur d'événement qui permet d'intercepepter une requete et de faire un traitement lorsque l'événement se réalise`

# Validation email
`#[Assert\Email(message: "Le mail '{{ value }}' est invalide.")]`

# Pour filtrer par recherche
* Sur l'entite
`#[ApiFilter(SearchFilter::class, properties: ['attribut 1' => 'exact', 'attribut 2' => 'exact', 'attribut 3' => 'partial'])] `

# Uploader Image 
* Sur l'entite: 
 itemOperations: [
        'image' => [
            'method' => 'POST',
            'path' => '/frittes/{id}/image',
            'deserialize' => false,
            'controller' => PostImageController::class
        ]
    ]
* Dans le controller personnalise, on met :
`  public function __invoke(Request $request)
    {
        $fritte = $request->attributes->get('data');
        $file = $request->files->get('file');
        dd($file, $fritte);
        
    }`

# Notion de dependance ORM doctrine: 
` Ca permet au developpeur de se concentrer sur le coeur du metier c a d sur la logique, la use case, on a plus besoin de savoir comment on insert les donnees. Il ya toujours ce qu' on appel le code metier et le code technique, et c'est le code metier qui change d'une application a un autre, c'est les fonctionnalite qu'on realise nous meme alors que le code technique en generale c'est la partie securite et ca ne change d'une appli a autre comme l' envoie des mails, ou ajout dans la bdd... Les HUB de dependance (en php c'est le packegiste, en java c'es Maven) . Donc les dependances permet`

# Gestionnaire de Dependance
` C'est un outils que l' on installe, avant les outils, a chaque fois qu' on voulait utiliser une dependance on le telecharger, ajouter ds le projet et le configurer mais maintenent c' est ces outils qui joue ce role, il permet de telecharger les dependances, l'ajouter ds le projet le configurer et gerer les conflits entre les dependances.`

# Api Subresource
` #[ApiResource(
    subresourceOperations: [
        'tailles_get_subresource' => [
            'method' => 'GET',
            'path' => '/tailles/{id}/taille_boissons',
        ]
    ]
)] `

`  subresourceOperations: [
        'api_tailles_taille_boissons_get_subresource' => [
           'normalization_context' => ['groups' => ['tailleSubressource:read']],
        ]
    ]`

# Desactiver la pagination par defaut, dans api_platform.yaml, on ajoute ca: 
*  defaults:
        pagination_enabled: false    
