

## SymfonyProjectV1

La ville de Chambéry souhaite mettre en place un système de covoiturage dans l’agglomération du grand Chambéry. Votre agence a décroché l’appel d’offre pour la version 1 du projet !


## Prérequis

Avant de pouvoir exécuter le projet, assurez-vous d'avoir les éléments suivants installés :

- PHP
- Composer
- Node.js
- npm
- MySQL (ou un autre serveur de base de données)

## Installation

Clonez le projet en utilisant la commande suivante :
git clone git@github.com:SpaceRag/SymfonyProject.git

# Accédez au répertoire du projet :
```
cd SymfonyProject/
```

# Installez les dépendances PHP et JavaScript en exécutant les commandes suivantes :
```
composer install
npm install
```

# Modifiez l'URL de la base de données dans le fichier `.env.dist`. 
Remplacez `<MY-DATABASE>` par le nom de votre base de données et configurez les autres paramètres de connexion appropriés : 
```
DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/?<VotreDATABASEici>=8.0.32&charset=utf8mb4"
```


## Démarrage du serveur

Pour lancer le serveur de développement, exécutez les commandes suivantes :
```
php/bin console server:start
npm run watch
```

Ces commandes créeront et mettront à jour les tables de la base de données en fonction des entités définies dans le projet.

Vous pouvez maintenant suivre ces étapes pour cloner, installer et exécuter le projet .


## Migrations de la base de données

Pour effectuer les migrations de la base de données, utilisez les commandes suivantes :

```
php/bin console m:mig
php/bin console d:m:m
php/bin console d:f:l
```


Ces commandes créeront et mettront à jour les tables de la base de données en fonction des entités définies dans le projet.

Vous pouvez installer et exécuter le projet SymfonyProject !


## Livrable

- Un dépôt Git contenant le projet au complet
- Maquettes

## Cirèteres de performance 

- Respect du cahier des charges techniques et fonctionnelles
- L’application respecte le modèle MVC
- Un jeu de fixtures pour peupler la base de données
- Les fonctionnalités attendues ne produisent pas d’erreurs
- Les pages sont fonctionnelles
- Le site est responsif
- Respect des bonnes pratiques de nommages / indentation / sémantique
