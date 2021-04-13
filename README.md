

# Base de données structurée, ouverte et liée
*Version 1.5.1 de ce document, 2021-02-11*

Établir une base de données structurées, ouvertes et liées (BDSOL) qui recense et géolocalise dans le Croissant Boréal les talents, compétences, équipements, initiatives technocréatives et apprentissages. 
La BDSOL utilisera les données de la communauté Avantage numérique et intégrera ensuite celles existantes dans le Croissant boréal.
La mise en ligne de cet outil augmentera la découvrabilité, la visibilité, ainsi que la transmission des savoirs. Les données seront structurées selon un travail méthodique de métadonnées et référencement. En parallèle, des formations, accompagnements et wikiclub seront réalisés, ainsi qu’une activité de cocréation sur une plateforme de partage des équipements. Des chantiers de réflexion seront organisés autour de la gouvernance des données et de la réduction de l’impact environnemental.


## Outils de gestions

- [Gestion du projet et de l'avancement](https://github.com/Avantage-Numerique/bdsol/projects/1) 
- [Structure de la base de données](https://whimsical.com/bdsol-prototype-1-Q2abPCFJMh5SbTUEdjPAEw) 
- [Gestion des versions](https://github.com/Avantage-Numerique/bdsol) (Github)
- [Cahier des charge](Cahier-des-charges.md) (choix technologiques pour l'instant seulement, version 1.00)


## Environnements

- Données Ouvertes (données Québec, par exemple)
- Données Liées (via un service de requête et d’une API)
- Plateforme web facilitant la recherche et permettant aux utilisateurs de gérer leurs données.


## Les utilisateurs anticipés

Les organismes et les membres de la communauté d’Avantage numérique
- **Technocréatif et Organisme oeuvrant dans le numérique** : Personne ayant déjà des compétences acquises dans le domaine des technologies numériques.
- **Technocurieux et Organisme qui orbite autour du numérique** : Personne tentant d’acquérir des compétences dans le domaine des technologies numériques.
- **Technonul et Organisme curieuse du numérique** : Personne qui cherche à en savoir plus dans un domaine.


## Objectifs de la plateforme

### Objectifs anticipés pour les utilisateurs
- Trouver une personne ayant les compétences dans un domaine, dans une technologie ou avec un équipement, afin de réaliser un projet technocréatif.
- Trouver des espaces et des équipements permettant de réaliser un projet précis.
- Découvrir les compétences nécessaires pour accomplir un type projet ou pour l’utilisation d’un équipement.
- Partager des solutions et des marches à suivre (tutoriel) à des problèmes techniques et managériaux.
- Poser des questions relatives à la production en contexte technocréatif (équipements, compétences, domaines d’activité, projets, etc.).
- Améliorer la découvrabilité (Repérabilité, Accessibilité et Interopérabilité) d’un projet ou d’un organismes.
- Planifier et budgéter des projets.

### Objectifs intrinsèques et collatéraux pour les utilisateurs
Faire rayonner le Croissant boréal dans la francophonie locale et internationale.
Faire briller les communautés du Croissant boréal entre elles.
Favoriser l’attraction et la rétentiondes talents dans la communauté du Croissant boréal.
Favoriser la collaboration multidisciplinaire et inusitée.

### Objectifs anticipés pour les membres
- Promouvoir leurs œuvres, formations, travaux, projets, etc.
- Ajouter une plateforme à leur stratégie de repérabilité et/ou SEO (dans une stratégie de découvrabilité).
- Participer et réseauter dans la communauté Avantage Numérique.
- Découvrir et apprendre sur un domaine, une compétence, une technologie ou un équipement grâce au partage d’information de la communauté.
- Trouver des partenaires et des ressources pour un projet.

### Objectifs intrinsèques et collatéraux pour les membres
- Augmenter la rentabilité d’une oeuvre, projet, etc.
- Formation de collectifs formels ou informels (plusieurs membres qui deviennent une entité légale de création, par exemple).
- Découvrir de nouveaux talents.

## Livrables et planification du projet 
On gèrera les fonctionnalités ici, dans Github, dans l'outil de gestionde projet.
[Voir les tâches planifiées pour la BDSOL - Protoype #1](https://github.com/Avantage-Numerique/bdsol/projects/1)

## Choix de la technologie du prototype #1
État actuel : version utilisable 1.0, voir [Cahier des charge](Cahier-des-charges.md)
- Backend : Laravel
- Backend interaction avec les tables relationnels : Backpack for Laravel
- Frontend administrateur : À déterminer
- Frontend public : à déterminer

## Structure de la base de données

[Version 1.0.2](https://whimsical.com/bdsol-prototype-1-Q2abPCFJMh5SbTUEdjPAEw) (10 mars) 
En cours de migration du travail effectué dans File Maker.

## Collaboration
Vous aimeriez contribuer ? Ou vous avez des idées pour des fonctionnalités ou pour des choix technologique ?

[Ajouter un ticket en documentant votre idée](https://github.com/Avantage-Numerique/bdsol/issues). 

Plus de mécanismes seront mis en place lorsque les corrections à la version #1 utilisable seront actives.


## Procédure d'installation version 0.0.1 :

### Préalable
- Cloner le répertoire
- S'assurer d'avoir un environnement compatible
    - Composer, 
    - Node, 
    - Npm,
    - Serveur web actif

### Installer
Installer les dépendances `php`
```shell
composer install
```

Installer Backpack for Laravel et le service de permission pour Backpack
```shell
À venir
```

Installer les dépendances javascript
```shell
npm install
```

#### Note à l'installation des dépendances javascript.
Laravel-mix a eu un problème lors de l'installation. Il faut appliquer, suite à l'installation des dépendances javascript.
```shell
npm update --depth 5 @babel/preset-env
```
```shell
npm update --depth 5 @babel/plugin-transform-runtime
```

## Définition :
**Utilisateurs**
Une personne visitant la plateforme via l’accès public avec les données regroupées sur des URL.

**Membres**
Une p*ersonne ayant un compte sur la plateforme qui permet d’ajouter du contenu et de commenter.

**URL**
Une URL, couramment appelée adresse web, est une chaîne de caractères uniforme qui permet d’identifier une ressource du World Wide Web par son emplacement et de préciser le protocole internet pour la récupérer. Uniform Resource Locator - Wikipedia

