# Système de Suivi des Parcelles et Interventions Agricoles (SSPIA)

Le **Système de Suivi des Parcelles et Interventions Agricoles (SSPIA)** est une solution innovante permettant de gérer efficacement les parcelles agricoles et les interventions associées. Ce projet vise à offrir une plateforme moderne de gestion agricole, contribuant à une agriculture plus productive et durable.

---

## Fonctionnalités Clés

- **Gestion des parcelles agricoles** :
  - Suivi des détails des parcelles (taille, emplacement, type de culture).
  - Historique des cultures pour chaque parcelle.
- **Suivi des interventions agricoles** :
  - Gestion des activités (fertilisation, irrigation, traitements phytosanitaires, etc.).
  - Planification et gestion des calendriers d'interventions.
- **Génération de rapports analytiques** pour évaluer les performances agricoles.
- **Interface utilisateur intuitive** adaptée aux besoins des agriculteurs.

---

## Prérequis

Avant de démarrer, assurez-vous d'avoir installé :
- **PHP** (version 8.0 ou supérieure).
- **Composer**, le gestionnaire de dépendances PHP.
- **MySQL** ou un autre gestionnaire de base de données.
- **Node.js** (optionnel, pour le front-end).

---

## Installation

### 1. Cloner le projet

Clonez ce dépôt sur votre machine locale :

```bash
git clone https://github.com/pharelgit/Systeme-de-Suivi-des-Parcelles-et-Interventions-Agricoles.git
cd Systeme-de-Suivi-des-Parcelles-et-Interventions-Agricoles
```

### 2. Configuration de la base de données

Créez une base de données MySQL :

```sql
CREATE DATABASE farmtrack;
```

Configurez le fichier `.env` avec vos paramètres de connexion MySQL.

### 3. Installation des dépendances

Installez les dépendances PHP avec Composer :

```bash
composer install
```

### 4. Migration de la base de données

Lancez les migrations pour créer les tables :

```bash
php artisan migrate
```

### 5. Création des tables supplémentaires

Création de la table `roles` :

```bash
php artisan make:migration create_roles_table
```

Modification de la table `users` pour ajouter `nom` et `prénom`, et supprimer `name` :

```bash
php artisan make:migration update_users_table_add_nom_prenom_remove_name
```

Association des rôles aux utilisateurs :

```bash
php artisan make:migration associate_roles_with_users
```

### 6. Peuplement des tables

Créez le seeder pour les rôles :

```bash
php artisan make:seeder RoleSeeder
```

Exécutez les seeder :

```bash
php artisan db:seed
```

Création du modèle Role avec migration :

```bash
php artisan make:model Role -m
```

Création de la table `statuts` :

```bash
php artisan make:migration create_statuts_table
```

Création de la table `parcelles` :

```bash
php artisan make:migration create_parcelles_table
```

Ajout d'une relation entre `parcelles` et `users` :

```bash
php artisan make:migration add_user_id_to_parcelles_table
```

Peuplement des statuts :

```bash
php artisan make:seeder StatutSeeder
php artisan db:seed --class=StatutSeeder
```

Création de la table des types d'intervention :

```bash
php artisan make:migration create_types_intervention_table
```

Création de la table des interventions :

```bash
php artisan make:migration create_interventions_table
```

Peuplement des types d'intervention :

```bash
php artisan make:seeder TypeInterventionSeeder
php artisan db:seed --class=TypeInterventionSeeder
```

---

## Démarrage du Serveur

Lancez le serveur Laravel en mode développement :

```bash
php artisan serve
```

Le projet sera accessible sur `http://127.0.0.1:8000`.

---

## Contribuer

Les contributions sont les bienvenues ! Merci de suivre ces étapes :

1. Forker le projet
2. Créer une branche avec vos modifications :
   ```bash
   git checkout -b feature-nouvelle-fonctionnalite
   ```
3. Valider et pousser vos modifications :
   ```bash
   git commit -m "Ajout d'une nouvelle fonctionnalité"
   git push origin feature-nouvelle-fonctionnalite
   ```
4. Soumettre une Pull Request

---

Merci d'utiliser **SSPIA** ! 🚜🌱

