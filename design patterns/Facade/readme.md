# Facade

[Retour au sommaire](../readme.md)

## Problèmatique de départ

Quand on code, on travaille rarement exclusivement avec son propre code. On a très souvent besoin de code externe. 

Lorsqu'on en utilise, on peut se retrouver avec du code fortement couplé avec le code externe, ce qui peut rendre la lecture du code compliquée.

## Principe et fonctionnement

L'idée est de créer un portail entre la librairie et le code qui donne un accès certes plus limité mais plus simple, ne donnant accès uniquement à ce dont vous avez besoin.

## Structure

La facade est une classe qui a pour attribut le moyen d'accèder au code externe et en méthodes les comportements que l'on souhaite récupérer du code externe.

[Ici un exemple](./exemple.php)

## Avantages / Inconvénients

|                                                      Avantages                                                     |                                                    Inconvénients                                                   |
|--------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------|
| On peut isoler la complexité du code externe                                                                       | Limite l'utilisation du code externe, et demande de repasser sur la facade en cas d'oubli                          |
|                                                                                                                    | Risque de devenir un objet omniscient, qui peut tout faire -> contre le principe de simple responsabilité          |
|                                                                                                                    |                                                                                                                    |

## Cas d'usage

- Utilistation d'une grosse librairie ou d'un gros framework