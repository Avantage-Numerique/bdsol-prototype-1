# Cahier des charges
BDSOL prototype 1.00

Voir le lexique des concepts.


## Choix technologiques

### Gestion de l'administration

#### Laravel 8 comme *framework*
- Versatile pour plusieurs grosseurs de projet.
    - Pour le prototype #1 et #2, possible d'augmenter l'envergure du code facilement.
    - Facile à installer sur plusieurs services d'hébergement pour toutes les étapes du projet.
- Une très grande communauté active de développeur.
- Outil Open Source
- SolidProject développe aussi des outils pour leur projet dans le web sémantique et 3.0 sous Laravel. (https://gitlab.com/solid-data-workers/laravel-sparql)
- EasyRDF : https://github.com/easyrdf/easyrdf

#### Backpack for Laravel comme interface CRUD
- Une administration Laravel permet de sauter plusieurs étapes énergivores
- Backpack for Laravel permet une gestion des entités bien faite et à jour.

#### Type de relation utiliser dans la base de données
- Relation 1:n
- Releation 1:1
- Relation n:n
- Relation polymorhpique
- Planification d'ajouter les Enums

#### Méthode de développement
- Utilisation du DDD (Domain Driven Design).
- Prototype #1 utilise le MVC de Laravel.


### Gestion des autorisations (structure des utilisateurs)
Cette facette a été mise de côté dans le prototype #1.

Le plugin `backpack/permissionmanager` qui est basé sur spatie-permission.

Le système aura 2 base de données :

- Pour les utilisateurs, leur compte personnel et pour les accès.
- Pour les données publiques, l'API et l'application web publique.

Cette structure permettra d'avoir plus de facilité à augmenter les ressources, pour l'une ou l'autre des facettes.

Mais surtout afin de permettre la duplication et la synchronisation entre les données avec moins de risque pour les données personnelles et sensibles.

Cette structure demande un peu plus de travail et un petit peu de duplication, pour ce qui a trait au *ownsership* des entrées dans la BD publique.



### Gestion de l'API

Par Laravel pour l'instant. Étant donné que l'API est dû pour plus tard. Fais partie des raisons pour lesquelles j'ai choisi Laravel.

Mais la porte est ouverte pour tout : GraphQL, Walder ?, Node, flask/django/python, etc.


## Plan de développement

### Version utilisable
1. Transfert en web de la BD File Maker.
   1. Restructuration pour avoir une base de données relationnels un peu plus versatile.
2. Mise en place de l'interface CRUD pour une entrée
3. Mise en place d'une interface pour importé des CSV/JSON, etc.
4. 

### Prototype #1

1. Mise en place d'une interface CRUD  pour les données.
    1. Dans une interface web sous
    2. Dans une méthodes de batch import (CSV ou autre format).
2. Mise en place d'une présentation des données dans la vue publique de la BDSOL.

### Ontologie 0.5
1. Mise en graphe la structure de la base de données relationnel.
   1. Détermination des classes pour chacune des `nœuds`.
   3. Détermniation de toutes les propriétés des classes établies.
   2. Détermination des types de liens entre les `nœuds` principales.
2. Documenter toutes ces informations dans un microsite
    1. Où chacun des nœuds ont une page pour décrire ses propriétés, l'utilisation de ces propriétés.
    2. En créant une structure dynamique pour que l'ontologie officiel et la documentation soit bien lié ensemble.
    3. On peut hébergerle microsite sur github et le bâtir avec Jekyll ou autres.
3. Affronter les donners au monde réelle
   1. Tenter de décrire un nom X de projets, personnes, org, etc. (BÉRÉNICE, préparer cette étable d'avance.)
4. Retgroupement des classes dans un fichier `rdf`.
5. Tester le fichier RDF.

### Design Système 0.5
1. Détermination du spectre d'application du design system (BDSOL seulement ?).
2. Partage des personnnas déterminé par Camille et Maude.

### Application de connexion multiplateforme
1. Élaboration de l'algorithme selon les besoins actuels
    1. Connexion à la BDSOL
    2. Connexion à la plateforme du Hub numérique virtuel
    3. Connexion à X service tier
    4. Connexion partiel et accès granulaire à plusieurs niveaux.
    5. Méthode de gestion des rôles.
    6. Données nécessaires pour la gestion.
    7. Élaboration de la politique de confidentialité.
    8. On touche à [SOLID](https://inrupt.com/solid/) ?
2. Choix de la meilleure technologie pour permettre cette connexion et son maintient
    1. Jeton JWT [Exemple](https://www.vaadata.com/blog/fr/jetons-jwt-et-securite-principes-et-cas-dutilisation/)
    2. oauth2 [Exemple](https://medium.com/google-cloud/understanding-oauth2-and-building-a-basic-authorization-server-of-your-own-a-beginners-guide-cf7451a16f66)
    3. Autres (N'hésitez pas à ajouter des algorithmes ici).
    4. Gestion
3. Designer la mise en ligne de la plateforme pour être en parallèle aux plateformes : BDSOL, site web d'avantage numérique, etc.
    1. Docker parallèle à la BDSOL ?
    2. Autres serveurs ?
4. Conceptualisation du logiciel
    1. Backend/API
    2. Frontend
5. Développement
    1. Backend
    2. API
    3. Frontend
6. Mise en prod avec un produit en production
7. Mise en prod avec tous les produits en production
8. 
### Livrables

#### Prototype #1
- Application web avec un système d'accès de base où on peut modifier et ajout des données dans l'ensemble de la structure de la base de données.

#### Ontologie
- Microsite documentant la structure du graphe de la BDSOL permettant à un humain de consulter la structure des données et de préparer ses données afin de permettre l'ajout en `bulk`  dans notre BD.


## Lexique des concepts

**Ontologie** :
Ensemble structuré de concepts, organisés dans un graphe et liés par des relations sémantiques et logiques, destiné à modéliser un ensemble de connaissances dans un domaine donné

**Graphe** : Une base de données orientée graphe est une base de données orientée objet utilisant la théorie des graphes, donc avec des nœuds et des arcs, permettant de représenter et stocker les données. [Source](https://fr.wikipedia.org/wiki/Base_de_donn%C3%A9es_orient%C3%A9e_graphe)

**Domain Driven Design (DDD)** : La conception dirigée par le domaine (ou DDD, de l'anglais domain-driven design) est une approche de la conception logicielle fondée sur deux principes : les conceptions complexes doivent être basées sur un modèle[pas clair] ; l'accent doit être sur le domaine et la logique associée. [Source](https://fr.wikipedia.org/wiki/Conception_pilot%C3%A9e_par_le_domaine)

**CRUD** : Create, Read, Update, Delete : quatres actions de base dans la plupart des actions que l'on pose sur une base de données.

**MVC** : Model, view, controller

**JWT** : JSON Web Token
