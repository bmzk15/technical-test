# Boris MALEZYK / Test technique

## Démarage du projet 
Lancer les commande `make start` et `make create-db`

## Utilisation du Makefile

Le `Makefile` fourni avec ce projet simplifie plusieurs tâches courantes lors du développement et du test de l'application. Voici les commandes disponibles:

- `make start`: Lance tous les services requis pour le projet, y compris la base de données et le serveur web, en utilisant `docker-compose`.
- `make create-db`: Met en place la base de donnée`.
- `make stop`: Arrête tous les services lancés par `make start`.


## Temps Passé sur le Test

- **Lecture, conception et mise en place de l’environnement :** 30 minutes
- **Développement back :** 2h30
- **Développement Front :** 1h

## Commentaires sur le Projet

### Setup et Tests
- Le setup de base me sert de sandbox et était déjà prêt pour le test.
- Version de PHP : 8.3
- Front en Next.js : 14.2
- Back en Symfony 7.1

### Optimisation de la base de données
- **Création de relations de clé étrangère** entre `article` et `source` pour lier les articles à leurs sources via `source_id`.
- **Ajout des champs `created_at` et `updated_at`** pour suivre les dates de création et de mise à jour des enregistrements.
- **Création d'Index sur `source_id`, `author` et `created_at`** dans la table `article` pour améliorer les performances des requêtes.
- **Modification du type de données pour `content`** de BLOB à TEXT pour optimiser le stockage de données textuelles.

### Architecture et Code
- **DTO Article** : Dans le cadre de la gestion des flux RSS et des articles de la base de donnée, il est essentiel de maintenir une flexibilité maximale en raison de la diversité des formats et des structures des flux que nous pouvons rencontrer. Voici pourquoi j'ai opté pour l'utilisation d'un Data Transfer Object (DTO).
- **Factory** : Les flux RSS peuvent varier en termes de structure et de format. En utilisant une Factory, je peux facilement adapter le traitement en fonction de chaque type de flux. Cela me permet d'ajouter de nouvelles sources de flux RSS sans avoir à refactorer l'ensemble du code existant.
- **Gestion des sources** : Développement axé sur la facilité d'ajout de nouvelles sources de données.

### Pistes d'amélioration
- **Sécurité** : Revoir la création des container et la gestion de l'environement.
- **Tests unitaires** : Ils doivent être implémentés pour assurer la qualité et la maintenabilité du code.
- **Tri des articles par date** : Utiliser les dates pour afficher les articles les plus récents en premier pourrait améliorer l'expérience utilisateur.
