# Cahier des charges

BDSOL prototype 1.00


## Choix technologiques


### Gestion de l'administration

#### Laravel 8 comme *framework*

**Les raisons du choix  :**

- Versatile pour plusieurs grosseurs de projet.
    - Pour le prototype #1 et #2, possible d'augmenter l'envergure  du code facilement.
    - Facile à installer sur plusieurs services d'hébergement pour  toutes les étapes du projet.
- Une très grande communauté active de  développeur.
- Outil Open Source
- SolidProject développe aussi des outils pour leur projet dans  le web sémantique et 3.0 sous Laravel. (https://gitlab.com/solid-data-workers/laravel-sparql)
- EasyRDF : https://github.com/easyrdf/easyrdf

#### Backpack for Laravel comme interface CRUD

**Les raisons du choix  :**

- Une administration Laravel permet de sauter plusieurs étapes  énergivores
- Backpack for Laravel permet une gestion des entités bien faite  et à jour.



### Gestion des autorisations  (structure des utilisateurs)

Le plugin `backpack/permissionmanager` qui est basé  sur spatie-permission.

Le système aura 2 base de données :

- Pour les utilisateurs, leur  compte personnel et pour les accès.
- Pour les données publiques,  l'API et l'application web publique.

Cette structure permettra  d'avoir plus de facilité à augmenter les ressources, pour l'une ou l'autre des  facettes.

Mais surtout afin de permettre  la duplication et la synchronisation entre les données avec moins de risque pour  les données personnelles et sensibles.

Cette structure demande un peu  plus de travail et un petit peu de duplication, pour ce qui a trait au  *ownsership* des entrées dans la BD  publique.



### Gestion de l'API

Par Laravel pour l'instant.  Étant donné que l'API est dû pour plus tard. Fais partie des raisons pour  lesquelles j'ai choisi Laravel.

Mais la porte est ouverte pour  tout : GraphQL, Walder ?, Node, flask/django/python, etc.
