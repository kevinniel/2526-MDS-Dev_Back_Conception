# Rappels des concepts de la POO

POO = Programmation orientée objet
PP = Programmation procédurale

## Les classes

Les classes sont une représentation d'objets réels ou conceptuels (ex. : signes astrologiques).

Cette représentation est possible grâce à la création d'un plan ou d'un modèle, et permet de se concrétiser en créant des objets à partir de ceux-ci.

Les classes permettent donc de décrire des objets, puis d'en créer.

### De quoi est composée une classe ?

Une classe est composée d'un ensemble de _caractéristiques_. Celles-ci se présentent sous forme de **variables** qu'on appelle des **attributs** dans le contexte objet. On les appelle aussi des **propriétés**.

Une classe dispose aussi d'un _comportement_ qui représente ce que les objets issus de la classe pourront faire.

Ce _comportement_ est constitué de **fonctions** qu'on appelle dans le contexte objet des **méthodes**.

Ces méthodes représentent des actions que peuvent réaliser les objets créés à partir de la classe.

----------

## Objet

Les objets sont aussi appelés des instances _concrètes_ (ou aussi instances de classes) et sont créés à partir des classes.

Le fait de créer un objet s'appelle : **l'instanciation**.

Un objet à un instant donné dispose d'un **État** : c'est ce qui regroupe l'ensemble des caractéristiques réelles de l'objet. En clair, il s'agit des valeurs réelles des attributs de l'objet à un instant donné.

Un objet peut aussi être appelé une **Entité** lorsque l'objet lui-même est directement lié au domaine métier. L'exemple le plus courant que vous utilisez régulièrement est : le modèle (architecture MVC).


### Le cycle de vie d'un objet

#### 1. Création / instanciation

L'objet est instancié souvent à partir d'un mot-clé propre au langage de programmation.

La création d'un objet déclenche automatiquement et systématiquement son **constructeur**. 

Le constructeur est une méthode qui - même si elle n'est pas définie explicitement - est exécutée.

Le constructeur permet de définir les caractéristiques d'un objet.

#### 2. Utilisation & modification de l'état

Une fois l'objet créé, on peut s'en servir en accédant à ses _caractéristiques_ et en exploitant ses **méthodes**.

Son utilisation entraine souvent la modification de son état, puisque les méthodes sont souvent basées dessus.

#### 3. Destruction

Lorsque l'objet n'a plus d'utilité, il est détruit. Plusieurs cas de figure en fonction du contexte : 

- `Dans le cadre d'une application web` : La durée de vie des objets est directement corrélée aux pages sur lesquelles ils sont utilisés. Cela signifie donc qu'à chaque changement de page les objets sont détruits.
- `Dans le cadre d'un logiciel` : C'est souvent le **Garbage Collector** (_Collecteur de Déchets_) qui s'occupe de détruire les objets qui ne sont plus utilisés pour libérer de la mémoire (RAM).

Dans tous les cas, il est possible de supprimer des objets manuellement.


----------

## Encapsulation

Le principe de l'encapsulation est de résoudre la problématique que tout le monde puisse faire ce qu'il veut dans le code.

Sans encapsulation, n'importe qui peut modifier : 

- n'importe quoi ;
- n'importe quand ;
- n'importe où ;
- n'importe comment ;

Et donc les données sont accessibles partout, sans restriction et sans règle commune.

Les problèmes qui peuvent découler de cette situation sont : 

- les erreurs ne sont pas bloquées (car vous ne limitez pas l'accès)
- les erreurs s'accumulent silencieusement
- vous ne savez pas d'où proviennent les erreurs - elles sont souvent loin de leur cause

Le principe qui en découle est de restreindre l'accès aux caractéristiques et aux méthodes, et on n'autorise que ce qui est nécessaire, et de manière contrôlée.

> Restreindre ne signifie pas bloquer, mais guider











tout le monde ne peut pas tout utiliser ?
pour protéger des méthodes ?
Restreindre l'accès aux caractéristiques et aux méthodes __pour les gens qui sont externes__












----------

getter / setter
constructeur

----------
responsabilité / SRP / SoC
couplage
cohésion
API publique de classe
Injection de dépendance
garbage collector (C)


