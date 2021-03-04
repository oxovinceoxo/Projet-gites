## CRUD-Project



[TOC]





----------------

### I - Structure des dossiers et contenu des fichiers applicatifs : 

```
\-- Projet-gites
  |-- index.php
  |-- login.php
  |-- details.php
  |-- functions.php
  |-- config.php
   \-- css
    |-- style.css
  \-- img
  \-- sql
  	|-- projet_gites.sql
```

Le contenu des fichiers est le suivant : 

- *index.php* — Page d'accueil de l'application de réservation de gîtes

- *functions.php* — Template basique des fonctions PHP et de la fonction de connexion à MySQL (afin de ne pas devoir répéter le code sur chaque fichier).

- *config.php* — Constantes de configuration utilisées sur les différentes pages du site (identifiants BDD, etc...)

  - Paramètres BDD (contient les identifiant de connexion et BDD)
  - Paramètres Généraux (permet de modifier des options comme le nom du site, la bannière d'accueil, la devise monétaire, etc..)

- *style.css* — La feuille de style de l'application pour paramétrer l'apparence.

  

-----------------

### II - Création de la base de donnée ``projet_gites``

<u>Avec phpMyAdmin :</u>

- Créer une nouvelle base de donnée, nommée ``projet_gites``
- Importer le fichier ``projet_gites.sql``

<u>Manuellement :</u> 

- Se référer aux commentaires du fichier ````

-------------------------------------------

### 
