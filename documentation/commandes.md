# Creer un projet Symfony Api :
`composer create-project symfony/skeleton my_project_name`

# Installation des Bundles Suivants:
`composer require symfony/maker-bundle --dev `
`composer require doctrine/annotations`
`composer require symfony/orm-pack`

# Creation de la Base donnee: 
`php bin/console doctrine:database:create`
`symfony console doctrine:database:create`

# Creation d’un Controller: 
`php bin/console make:controller Api`
`symfony console make:controller Api`

# Creation d’un Entité: 
`php bin/console make:entity name_entity`
`symfony console  make:entity name_entity`

# Installation du Bundle Serializer: 
`composer require symfony/serializer-pack`

# Installation du Composant Pour la Validation:
`composer require symfony/validator`

# Installation du Composant Pour Insérer des Données par Fixtures:
`composer require --dev orm-fixtures`

# Installation du Composant Pour hacher les passwords: 
`composer require symfony/password-hasher`

# Groupe de Sérialisation :indique les attributs à sérialisés Composant:
`composer require sensio/framework-extra-bundle`

# Installation de la Sécurité:
`composer require security` 

# Installation des dependances du token:
`composer require lexik/jwt-authentication-bundle`

# Générer les clés(public et privée):
`symfony console lexik:jwt:generate-keypair`

* ############################ REALISATION DE API AVEC API PLATEFORM ############################
# Présentation: `API Platform est un framework web utilisé pour générer des APIREST et GraphQL, se basant sur le patron de conception MVC. La partie serveur du framework est écrite en PHP et basée sur le framework Symfony.`

# Installation des dépendances: 
`composer require api`

# Documentation swagger
`path : Post http://localhost:8000/api`

# Configuration des entités:
`Ajouter l’annotation` #[ApiResource()] `sur chaque entité gérée par Api PlatForm.`