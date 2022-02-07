# Cahier des charges BDSOL prototype 1.1

On a mis de côté la version 1 du prototype. Nous passons tout de suite à une version 1.1.
**Avec déjà la mise en forme qui nous voulions pour l'alpha et toujours avec l'utilisateur au centre des décisions.**

## Structure
- Vue publique (*front-end*)
- Section de gestion pour les utilisateurs - section utilisateur publique (*user's backend*)
- Section de gestion de l'application, API et autres mécanismes (*Backend*)

## Choix technologiques

### Pour les vues publiques

#### La vue publique et la zone utilisateur
Elles seront une application [NEXTJS](https://nextjs.org/). Avec une gestion des authorisations via une API.

#### La gestionde l'application
Elle sera via Laravel en mode API et avec une des interfaces de gestions. Pour aider les administrateurs à gérer la plateforme avec des outils précis sans avoir à ajouter des permissions dans l'application nextjs.



### Gestion de l'administration

#### Laravel comme *framework* pour l'API et gestion de l'application web.
- Versatile pour plusieurs grosseurs de projet.
    - Framework répandu et versatile, possible d'augmenter l'envergure du code facilement.
    - Facile à installer sur plusieurs services d'hébergement pour toutes les étapes du projet.
- Une très grande communauté active de développeur.
- Outil Open Source
- SolidProject développe aussi des outils pour leur projet dans le web sémantique et 3.0 sous Laravel. (https://gitlab.com/solid-data-workers/laravel-sparql)
- EasyRDF : https://github.com/easyrdf/easyrdf

#### Backpack for Laravel comme interface CRUD
- A été utilisé pour la version du prototype 1.0.
- Une administration Laravel permet de sauter plusieurs étapes énergivores.
- Backpack for Laravel permet une gestion des entités bien faite et à jour.

#### Type de relation utiliser dans la base de données relationnelles.
- Relation 1:n
- Relation 1:1
- Relation n:n
- [Relation polymorphique](https://laravel.com/docs/8.x/eloquent-relationships#polymorphic-relationships)
- Planification d'ajouter les Enums

### Méthode de développement
- Utilisation du DDD ([Domain Driven Design](https://fr.wikipedia.org/wiki/Conception_pilot%C3%A9e_par_le_domaine)).
- Prototype 1.1 utilise le MVC de Laravel pour la section de gestion de l'application.
- Pour la zone d'utilisateur : MVC aussi ?
- Pour la zone publique : MVC aussi ?


## Gestion des autorisations (structure des utilisateurs)
Cette facette a été mise de côté dans le prototype #1.

Le plugin `backpack/permissionmanager` qui est basé sur spatie-permission.

Le système aura 2 base de données :

- Pour les utilisateurs, leur compte personnel et pour les accès.
- Pour les données publiques, l'API et l'application web publique.

Cette structure permettra d'avoir plus de facilité à augmenter les ressources, pour l'une ou l'autre des facettes.

Mais surtout afin de permettre la duplication et la synchronisation entre les données avec moins de risque pour les données personnelles et sensibles.

Cette structure demande un peu plus de travail et un petit peu de duplication, pour ce qui a trait au *ownsership* des entrées dans la BD publique.



## Gestion de l'API

L'API Pour l'application publique (zone membre et vue publique) se fera via Laravel développer pour NextJS.
Pour l'accès à notre base de donnée en mode graph, on explore encore :
GraphQL, Walder ?, Node, flask/django/python, etc.


## Plan de développement

### Prototype 1.1

1. Mise en place d'une interface CRUD pour les données.
    1. Dans une interface web sous
    2. Dans une méthodes de batch import (CSV ou autre format).
2. Mise en place d'une présentation des données dans la vue publique de la BDSOL.

### Ontologie 0.6 à 1.0
1. [X] Lié avec l'ontologie [schema.org](https://schema.org/)
2. [ ] Lié avec l'ontologie [FoaF](http://xmlns.com/foaf/spec/)
3. [ ] Lié l'ontologie avec la nouvelle version d'artsdata qui s'en vient
4. [ ] Lié l'ontologie avec le projet Dia-Log des conseils de la cultures développé par culture Laval.
5. [X] Mise en graphe théorique de la structure de la base de données relationnel (schema.org)
    1. [X] Détermination des classes pour chacun des `nœuds`.
    2. [ ] Détermination des propriétés des classes établies.
    3. [X] Détermination des types de liens entre les `nœuds` principaux.
6. [ ] Documenter toutes ces informations dans un microsite.
    1. Où chacun des nœuds a une page pour décrire ses propriétés, l'utilisation de ces propriétés.
    2. En créant une structure dynamique pour que l'ontologie officielle et la documentation soient bien liées ensemble.
    3. On peut héberger le microsite sur github et le bâtir avec Jekyll ou autres.
7. [ ] Affronter les données au monde réel.
    1. Tenter de décrire un nom X de projets, personnes, org, etc. (BÉRÉNICE, préparer cette étable d'avance.)
8. [ ] Retgroupement des classes dans un fichier `rdf`.
9. [ ] Tester le fichier RDF.

### Design Système 0.5
1. [ ] Détermination du spectre d'application du design system (BDSOL seulement ?).
2. [ ] Partage des personnes déterminé par Camille et Maude.
3. [ ] Élaboration des outils de formulaire et visuel pour le prototype actuel.


## Livrables

### Prototype 1.1
- Application web avec un système d'accès de base où on peut modifier et ajout des données dans l'ensemble de la structure de la base de données relationnelles.

### Ontologie
- Microsite documentant la structure du graphe de la BDSOL permettant à un humain de consulter la structure des données et de préparer ses données afin de permettre l'ajout en `bulk` dans notre BD.
- Structure ontologique technique
- Point d'accès de requête à nos donnés


## Lexique des concepts

**Ontologie** :
Ensemble structuré de concepts, organisés dans un graphe et liés par des relations sémantiques et logiques, destiné à modéliser un ensemble de connaissances dans un domaine donné

**Graphe** : Une base de données orientée graphe est une base de données orientée objet utilisant la théorie des graphes, donc avec des nœuds et des arcs, permettant de représenter et stocker les données. [Source](https://fr.wikipedia.org/wiki/Base_de_donn%C3%A9es_orient%C3%A9e_graphe)

**Domain Driven Design (DDD)** : La conception dirigée par le domaine (ou DDD, de l'anglais domain-driven design) est une approche de la conception logicielle fondée sur deux principes : les conceptions complexes doivent être basées sur un modèle[pas clair] ; l'accent doit être sur le domaine et la logique associée. [Source](https://fr.wikipedia.org/wiki/Conception_pilot%C3%A9e_par_le_domaine)

**CRUD** : Create, Read, Update, Delete : quatres actions de base dans la plupart des actions que l'on pose sur une base de données.

**MVC** : Model, view, controller

**JWT** : JSON Web Token
