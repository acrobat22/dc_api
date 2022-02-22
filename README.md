# Installation du projet

Récupérer le projet via git :
https://framagit.org/acrobat22/dc_api.git

## Technologies & Environnement
- Symfony v4.4.0
- PHP v7.1.10
- Bootstrap v4.0.0

## Fonctionnalités

Récupération d'article de presse via l'API RSS Le monde info en continu
(https://www.lemonde.fr/rss/en_continu.xml)

Utilisation de Twig pour le front
-> Récupération des données en GET



## Liste des commandes pour l'installation du projet

- composer install.
- Modifier le fichier .ENV (définir base de données)
- php bin/console doctrine:database:create
- php bin/console doctrine:schema:update --force


## Evolutions
- Mise en place :  
    - de filtre pour trouver les articles en fonction des différents fluxs RSS proposés (https://www.lemonde.fr/actualite-medias/article/2019/08/12/les-flux-rss-du-monde-fr_5498778_3236.html)
    - d'une barre de navBar
    - amélioration des visuels
    - de vue.js pour plus de fluidité
     
