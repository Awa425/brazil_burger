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
`NB: La Normalisation permet de définir le format de la donnee de la réponse avec la notion de Groups.`
`Lors de l'opération GET(ALL) si on veut cacher certaines informations,c'est moment de la normalisation qu'on agit`

# Notion de Deormalisation (Array vers Object)
* Sur l'entité :
`NB: La Normalisation permet de définir le format de la donnee de la réponse avec la notion de Groups.`

# NB: Un Data Persister :
`Il permet de redéfinir les opérations de persist(insert,update) ou de remove(suppression)`

# EventSubscriber:
` C'est un ecouteur d'événement qui permet d'intercepepter une requete et de faire un traitement lorsque l'événement se réalise`