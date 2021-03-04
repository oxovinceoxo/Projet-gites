## CRUD-Project



[TOC]





----------------

### I - Structure des fichiers et configuration : 

```
\-- Projet-gites
  |-- index.php
  |-- login.php
  |-- details.php
  |-- functions.php
  |-- config.php
   \-- css
    |-- style.css
    |-- login.css
  \-- img
  \-- sql
```

Le contenu des fichiers est le suivant : 

- *index.php* — Page d'accueil de l'application de réservation de gîtes
- *functions.php* — Template basique des fonctions PHP et de la fonction de connexion à MySQL (afin de ne pas devoir répéter le code sur chaque fichier).
- *config.php* — Constantes de configuration utilisées sur les différentes pages du site (identifiants BDD, etc...)
- *style.css* — La feuille de style de l'application pour paramétrer l'apparence.
- *login.css* — La feuille de style temporaire de la page de login.

-----------------

### II - Création de la base de donnée ``shop``

<u>Avec phpMyAdmin :</u>

- Créer une nouvelle base de donnée, nommée ``shop``
- Importer le fichier ``shop.sql``

<u>Manuellement :</u> 

- Se référer au fichier ``conception-DB.md``

-------------------------------------------

### 
