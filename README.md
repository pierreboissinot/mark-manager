# Mark manager

Application web permettant à ENI Ecole de suivre les résultats de ses stagiaires.

## Demo

Accéder à la [demo](https://vast-headland-38919.herokuapp.com)
Un admin vous permet d'éditer le jeu de données de test si besoiN

## Features

* Saisir les résultats
* Gérer les repassages
* Envoyer la synthèse de résultats

## Métier

### De quoi parle-t-on ?

* Un résultat est compris entre 0 et 20.
* Un résultat appartient à une matière.
* Une matère a un coefficient.
* Un résultat est donc pondéré par le coefficient de la matière auquel il est lié.
* Un domaine regroupe plusieurs matières.

### Règles

* Un domaine est invalide si une des notes est inférieure strictement à 7/20.
* Un domaine est valide si toutes ses notes sont supérieures à 10/20 ou si toutes ses notes sont supérieures à 7/20 et que la moyenne du domaine est supérieure à 12.
* Une note obtenue dans le cadre d'un rattrapage ne peut dépasser 12/20

### Comportement attendu

* Si un domaine est invalide, l'utilisateur propose un rattrapage au stagiaire.
* Si une note est strictement inférieure à 7/20, l'utilisateur propose un rattrapage.


## Stack

* Symfony 4
* Amazon SES pour l'envoi de mail
* Bootstrap 3.3 (css et js managés via Webpack)
