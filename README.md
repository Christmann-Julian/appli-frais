# SWISS PHARMA - Applis frais

Applis Frais est un projet de BTS SIO option SLAM consistant à réaliser un site web de gestion des fiches de frais pour l'entreprise pharmaceutique fictive nommée SWISS PHARMA.

## Sommaire

- [Installation](#installation)
- [Architecture](#architecture)
- [Créateurs](#créateurs)
- [Copyright et licence](#copyright-et-licence)

## Installation

Pour récuperer le projet, vous pouvez utiliser la ligne de commande git suivante :

```git
$ git clone https://github.com/Christmann-Julian/appli-frais
```
Ou vous pouvez télécharger le fichier .zip du projet en vous rendant sur le [github](https://github.com/Christmann-Julian/appli-frais) du projet.

Ensuite vous devez créer la base de données MySQL et importer le fichier ***applifrais.sql***.

Enfin vous devez modifier les informations de connexion à la base de données dans le fichier config.php

```php
// BDD information
define('DB_HOST', 'localhost');
define('DB_USER', 'nom_utilisateur');
define('DB_PASSWORD', 'mot_de_passe');
define('DB_NAME', 'nom_bdd');
```
> [!NOTE]
> Si vous utilisez une base de donnée local avec les paramètres par défaut, le nom est root et il n'y a pas de mot de passe.

## Architecture

Le projet a une architecture MVC.

```text
applis-frais/
├── app/
│    ├── Controllers/
│    │    ├── AuthController.php
│    │    ├── Controller.php
│    │    ├── ExpenseController.php
│    │    ├── HelpController.php
│    │    └── UserController.php
│    ├── Models/
│    │    ├── ExpenseModel.php
│    │    └── UserModel.php
│    ├── Forms/
│    │    └── FormValidation.php
│    ├── DbConnection.php
│    └── Helpers.php
├── assets/
├── vendor/
├── views/
│    ├── auth/
│    │    └── login.php
│    ├── expense/
│    │    ├── add.php
│    │    ├── edit.php
│    │    └── index.php
│    ├── help/
│    │    └── index.php
│    ├── user/
│    │    └── index.php
│    ├── default.php
│    └── error404.php
├── composer.json
├── config.php
└── default.php
```

## Créateurs

**Christmann-Julian**

- <https://github.com/Christmann-Julian>

**Fernandes Gabriel**

- <https://github.com/gabrielfds95>
- <https://sites.google.com/view/portfolio-gabrielfernandes/accueil>

**1rawski**

- <https://github.com/1rawski>

## Copyright et licence

Code et documentation copyright 2023-2024. Le Code du projet est publié sous [Licence MIT ](https://fr.wikipedia.org/wiki/Licence_MIT).
