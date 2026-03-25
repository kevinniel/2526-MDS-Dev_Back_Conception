# TP Guidé - POO avancée en PHP avec les échecs

## Principe du TP

Dans ce TP, tout le monde doit produire la même architecture de base.

Le but n'est pas de "faire à sa manière", mais de :

- respecter une structure de projet imposée ;
- utiliser les mêmes noms de classes ;
- utiliser les mêmes noms de méthodes ;
- appliquer les mêmes relations d'héritage ;
- mettre en place plusieurs design patterns de manière contrôlée ;
- avancer étape par étape sans tout coder dès le début.

Le sujet est donc volontairement directif.

---

## Objectif pédagogique

Vous devez construire un mini moteur métier d'échecs en PHP pour travailler :

- l'encapsulation ;
- l'héritage ;
- les classes abstraites ;
- les interfaces ;
- le polymorphisme ;
- la composition ;
- les exceptions métier ;
- plusieurs design patterns simples et utiles.

Ce TP ne demande pas :

- d'interface graphique ;
- d'intelligence artificielle ;
- de multijoueur réseau.

---

## Règle importante

Vous ne devez pas improviser l'architecture.

Vous devez respecter exactement :

- les dossiers ;
- les fichiers ;
- les classes ;
- les signatures de méthodes ;
- les relations entre classes.

Si une méthode est demandée, elle doit exister avec le nom indiqué.

Si une classe est demandée, elle doit être créée dans le fichier indiqué.

---

## Arborescence imposée

Votre projet doit respecter exactement cette structure à la fin :

```text
chess/
├── readme.md
├── index.php
└── src/
    ├── Board.php
    ├── Game.php
    ├── Position.php
    ├── Move.php
    ├── Factory/
    │   └── PieceFactory.php
    ├── Contract/
    │   └── Renderable.php
    ├── Enum/
    │   ├── PieceColor.php
    │   └── PieceType.php
    ├── Exception/
    │   ├── ChessException.php
    │   ├── InvalidMoveException.php
    │   ├── NoPieceException.php
    │   ├── WrongTurnException.php
    │   └── OccupiedByAllyException.php
    └── Piece/
        ├── Piece.php
        ├── King.php
        ├── Queen.php
        ├── Rook.php
        ├── Bishop.php
        ├── Knight.php
        └── Pawn.php
```

---

## Classes imposées

Vous devez créer exactement les classes suivantes :

- `Board`
- `Game`
- `Position`
- `Move`
- `PieceFactory`
- `Piece`
- `King`
- `Queen`
- `Rook`
- `Bishop`
- `Knight`
- `Pawn`
- `ChessException`
- `InvalidMoveException`
- `NoPieceException`
- `WrongTurnException`
- `OccupiedByAllyException`

Vous devez également créer :

- l'interface `Renderable`
- l'enum `PieceColor`
- l'enum `PieceType`

---

## Relations d'héritage imposées

Vous devez respecter exactement ce schéma :

### Héritage métier

- `Piece` est une classe abstraite
- `King` hérite de `Piece`
- `Queen` hérite de `Piece`
- `Rook` hérite de `Piece`
- `Bishop` hérite de `Piece`
- `Knight` hérite de `Piece`
- `Pawn` hérite de `Piece`

### Héritage des exceptions

- `ChessException` hérite de `Exception`
- `InvalidMoveException` hérite de `ChessException`
- `NoPieceException` hérite de `ChessException`
- `WrongTurnException` hérite de `ChessException`
- `OccupiedByAllyException` hérite de `ChessException`

### Contrat commun

- `Piece` implémente `Renderable`
- `Board` implémente `Renderable`

---

## Design patterns imposés

Vous devez mettre en place les patterns suivants.

### 1. Factory

Classe concernée :

- `PieceFactory`

Rôle :

- centraliser la création des pièces ;
- éviter d'instancier les pièces directement dans `Game`.

### 2. Strategy via polymorphisme

Classes concernées :

- `Piece`
- toutes les classes filles de `Piece`

Rôle :

- chaque pièce possède sa propre stratégie de déplacement ;
- on évite un gros bloc de `if/else` dans `Game`.

### 3. Template Method

Classe concernée :

- `Piece`

Rôle :

- la classe abstraite porte la structure commune de validation ;
- les sous-classes ne redéfinissent que la logique spécifique de déplacement.

### 4. Value Object

Classe concernée :

- `Position`

Rôle :

- représenter une case valide ;
- éviter de manipuler des coordonnées brutes partout.

---

## Ordre de travail obligatoire

Vous devez avancer dans cet ordre :

1. `Position`
2. `PieceColor` et `PieceType`
3. `Renderable`
4. `Piece`
5. `King`, `Queen`, `Rook`, `Bishop`, `Knight`, `Pawn`
6. `Move`
7. `Board`
8. `ChessException` et les exceptions filles
9. `PieceFactory`
10. `Game`
11. `index.php`

Vous ne devez pas commencer `Game` avant d'avoir terminé `Board` et les pièces.

---

## Ce qu'il ne faut pas faire au début

Au début du TP, vous ne devez pas coder :

- le roque ;
- la promotion ;
- la prise en passant ;
- l'échec et mat ;
- le pat ;
- un historique complet des coups.

On construit d'abord un socle propre.

---

## Phase 1 - Mise en place du socle

À cette phase, vous ne travaillez que sur :

- `Position`
- `PieceColor`
- `PieceType`
- `Renderable`

### 1. Classe `Position`

Fichier :

- `src/Position.php`

### Propriétés imposées

```php
private int $row;
private int $column;
```

### Méthodes imposées

```php
public function __construct(int $row, int $column)
public function getRow(): int
public function getColumn(): int
public function equals(Position $other): bool
// Transforme une position en chaine de caractère (exemple : Position(6, 4) -> "6:4" (row:column) )
public function toKey(): string
<!-- Fait la transformation inverse (exemple : "6:4" -> Position(6, 4) ) -->
public static function fromKey(string $key): Position
```

### Contraintes

- `row` doit être compris entre `0` et `7`
- `column` doit être compris entre `0` et `7`
- `toKey()` doit retourner une chaîne du type `"6:4"`

### Ce que vous devez faire ici

- créer la classe ;
- encapsuler les données ;
- valider les coordonnées dans le constructeur.

### Ce que vous ne devez pas faire ici

- aucune logique de déplacement ;
- aucune logique de plateau ;
- aucune logique de partie.

---

### 2. Enum `PieceColor`

Fichier :

- `src/Enum/PieceColor.php`

### Valeurs imposées

```php
case WHITE;
case BLACK;
```

### Méthode imposée

```php
public function opposite(): PieceColor
```

### Explication

Cette méthode doit retourner la couleur opposée à la couleur courante.

Exemple attendu :

- si la couleur courante est `PieceColor::WHITE`, la méthode retourne `PieceColor::BLACK`
- si la couleur courante est `PieceColor::BLACK`, la méthode retourne `PieceColor::WHITE`

### Indications

Dans une méthode d'enum en PHP :

- `$this` désigne le cas courant de l'enum ;
- `self::WHITE` et `self::BLACK` désignent les cas possibles de cet enum.

### Exemple d'utilisation

Cette méthode servira dans `Game` pour changer facilement de joueur :

```php
$this->currentPlayer = $this->currentPlayer->opposite();
```

---

### 3. Enum `PieceType`

Fichier :

- `src/Enum/PieceType.php`

### Valeurs imposées

```php
case KING;
case QUEEN;
case ROOK;
case BISHOP;
case KNIGHT;
case PAWN;
```

---

### 4. Interface `Renderable`

Fichier :

- `src/Contract/Renderable.php`

### Méthode imposée

```php
public function render(): string;
```

---

## Phase 2 - Hiérarchie des pièces

À cette phase, vous créez l'héritage métier.

### 1. Classe abstraite `Piece`

Fichier :

- `src/Piece/Piece.php`

### Propriétés imposées

```php
protected PieceColor $color;
protected Position $position;
protected PieceType $type;
```

### Méthodes imposées

```php
public function __construct(PieceColor $color, Position $position)
public function getColor(): PieceColor
public function getPosition(): Position
public function setPosition(Position $position): void
public function getType(): PieceType
public function render(): string
public function canMove(Board $board, Position $target): bool
abstract protected function isValidMovementShape(Position $target): bool
protected function canCapture(Board $board, Position $target): bool
```

### Rôle de `render()`

La méthode `render()` doit retourner une représentation texte de l'objet.

### Attendu pour `Piece::render()`

La méthode doit retourner une chaîne courte représentant la pièce, utilisable dans l'affichage du plateau.

Convention imposée :

- roi blanc : `"K"`
- reine blanche : `"Q"`
- tour blanche : `"R"`
- fou blanc : `"B"`
- cavalier blanc : `"N"`
- pion blanc : `"P"`
- roi noir : `"k"`
- reine noire : `"q"`
- tour noire : `"r"`
- fou noire : `"b"`
- cavalier noir : `"n"`
- pion noir : `"p"`

La méthode `Board::render()` devra utiliser `Piece::render()` pour construire l'affichage texte du plateau.

### Règle de conception imposée

Vous devez appliquer ici un Template Method :

- `canMove()` contient la logique commune ;
- `isValidMovementShape()` est redéfinie dans chaque sous-classe ;
- `canCapture()` porte une partie de la logique partagée.

### Ce que `canMove()` doit vérifier

Dans cet ordre :

1. la pièce ne reste pas sur place ;
2. la forme du déplacement est valide ;
3. la case cible n'est pas occupée par un allié ;
4. si la pièce n'est pas un cavalier, le chemin est libre ;

Vous ne devez pas changer cet ordre.

---

### 2. Classes filles imposées

Fichiers :

- `src/Piece/King.php`
- `src/Piece/Queen.php`
- `src/Piece/Rook.php`
- `src/Piece/Bishop.php`
- `src/Piece/Knight.php`
- `src/Piece/Pawn.php`

### Méthode imposée dans chaque sous-classe

```php
protected function isValidMovementShape(Position $target): bool
```

### Type imposé dans chaque constructeur

Chaque sous-classe doit initialiser son `PieceType` correspondant.

Exemple attendu :

- `King` doit porter `PieceType::KING`
- `Queen` doit porter `PieceType::QUEEN`
- etc.

### Règles à implémenter dans cette phase

- Roi : une case dans toutes les directions
- Reine : ligne ou diagonale
- Tour : ligne
- Fou : diagonale
- Cavalier : déplacement en L
- Pion : avance simple, avance double au départ, capture en diagonale

### Ce que vous ne devez toujours pas faire

- pas de gestion d'échec ;
- pas de gestion des tours de jeu ;
- pas de gestion de partie complète.

---

## Phase 3 - Représenter une intention de coup

### Classe `Move`

Fichier :

- `src/Move.php`

### Propriétés imposées

```php
private Position $from;
private Position $to;
```

### Méthodes imposées

```php
public function __construct(Position $from, Position $to)
public function getFrom(): Position
public function getTo(): Position
```

### Rôle

Cette classe représente un déplacement demandé.

Elle ne valide pas les règles.

---

## Phase 4 - Construire le plateau

Vous pouvez maintenant créer `Board`.

### Classe `Board`

Fichier :

- `src/Board.php`

### Propriété imposée

```php
private array $pieces = [];
```

### Format imposé de stockage

Le tableau `$pieces` doit être indexé par la clé retournée par `Position::toKey()`.

Exemple :

```php
$this->pieces['6:4'] = $piece;
```

### Méthodes imposées

```php
// Permet de placer la pièce AU DEBUT du jeu
public function placePiece(Piece $piece): void
public function getPieceAt(Position $position): ?Piece
public function hasPieceAt(Position $position): bool
public function removePieceAt(Position $position): void
// permet de déplacer les pièces PENDANT le jeu
public function movePiece(Position $from, Position $to): void
public function isPathClear(Position $from, Position $to): bool
public function getPieces(): array
public function getKingPosition(PieceColor $color): ?Position
public function render(): string
```

### Règles imposées

- `placePiece()` pose ou remplace une pièce sur la case ;
- `movePiece()` déplace réellement la pièce dans le tableau ;
- `isPathClear()` vérifie uniquement les cases intermédiaires ;
- `render()` doit retourner une représentation texte du plateau ;
- `getPieces()` doit retourner un tableau de `Piece`.

### Point technique important

`Board` ne décide pas si un joueur a le droit de jouer maintenant.

`Board` gère uniquement l'état du plateau.

---

## Phase 5 - Exceptions métier

### Fichiers imposés

- `src/Exception/ChessException.php`
- `src/Exception/InvalidMoveException.php`
- `src/Exception/NoPieceException.php`
- `src/Exception/WrongTurnException.php`
- `src/Exception/OccupiedByAllyException.php`

### Rôle imposé

Vous devez utiliser :

- `NoPieceException` si aucune pièce n'existe sur la case source ;
- `WrongTurnException` si le joueur tente de jouer la mauvaise couleur ;
- `InvalidMoveException` si la forme du coup est interdite ;
- `OccupiedByAllyException` si la case cible contient un allié.

Vous ne devez pas remplacer tout cela par de simples `false`.

---

## Phase 6 - Factory de pièces

### Classe `PieceFactory`

Fichier :

- `src/Factory/PieceFactory.php`

### Méthode imposée

```php
public function create(PieceType $type, PieceColor $color, Position $position): Piece
```

### Interdiction

Dans `Game`, vous ne devez pas écrire :

```php
new King(...)
new Queen(...)
new Pawn(...)
```

Toute création de pièce doit passer par la factory.

---

## Phase 7 - Construire la partie

Vous pouvez maintenant coder la classe la plus haute : `Game`.

### Classe `Game`

Fichier :

- `src/Game.php`

### Propriétés imposées

```php
private Board $board;
private PieceColor $currentPlayer;
private PieceFactory $pieceFactory;
```

### Méthodes imposées

```php
public function __construct()
public function start(): void
public function getBoard(): Board
public function getCurrentPlayer(): PieceColor
public function play(Move $move): void
public function isCheck(PieceColor $color): bool
private function setupPieces(): void
private function switchPlayer(): void
```

### Responsabilités imposées de `Game`

`Game` doit :

- créer le plateau ;
- initialiser le joueur courant à `WHITE` ;
- appeler la factory pour créer les pièces ;
- placer les pièces au démarrage ;
- recevoir un `Move` ;
- vérifier que la pièce source existe ;
- vérifier que la pièce jouée appartient au bon joueur ;
- demander à la pièce si le déplacement est valide ;
- déplacer la pièce via `Board` ;
- changer le joueur courant ;
- être capable de tester un échec.

### Responsabilités interdites à `Game`

`Game` ne doit pas :

- recalculer la logique détaillée de chaque pièce ;
- contenir un gros `switch` sur les types de pièces ;
- accéder directement au tableau interne du plateau.

---

## Mise en place du plateau initial

Vous devez utiliser exactement ce placement :

### Pièces noires

- ligne `0` : tour, cavalier, fou, reine, roi, fou, cavalier, tour
- ligne `1` : 8 pions noirs

### Pièces blanches

- ligne `6` : 8 pions blancs
- ligne `7` : tour, cavalier, fou, reine, roi, fou, cavalier, tour

### Convention imposée

- le roi est en colonne `4`
- la reine est en colonne `3`
- ligne `0` en haut
- ligne `7` en bas

---

## Règles métier minimales à obtenir

Quand `Game::play()` est appelé, votre code doit :

1. récupérer la pièce source ;
2. lever `NoPieceException` si nécessaire ;
3. vérifier le tour du joueur ;
4. lever `WrongTurnException` si nécessaire ;
5. vérifier le déplacement via la pièce ;
6. lever `InvalidMoveException` si nécessaire ;
7. lever `OccupiedByAllyException` si nécessaire ;
8. déplacer la pièce ;
9. changer le joueur courant.

Cet ordre doit être respecté.

---

## Détection de l'échec

Cette partie vient seulement après le fonctionnement complet des déplacements.

### Méthode concernée

```php
public function isCheck(PieceColor $color): bool
```

### Algorithme imposé

1. retrouver la position du roi de la couleur demandée ;
2. récupérer toutes les pièces adverses ;
3. tester si l'une d'elles peut atteindre la case du roi ;
4. retourner `true` dès qu'une menace existe ;
5. sinon retourner `false`.

### Ce que vous ne gérez pas encore

- l'échec et mat ;
- l'interdiction d'un coup qui expose son propre roi ;
- le roque.

---

## `index.php` imposé

Le fichier `index.php` doit au minimum :

1. créer une instance de `Game`
2. appeler `start()`
3. afficher le plateau
4. jouer quelques coups de démonstration
5. afficher le plateau après les coups

Vous pouvez utiliser des `try/catch` pour afficher proprement les erreurs métier.

---

## Consignes de développement

### À respecter

- propriétés `private` ou `protected`
- typage strict des paramètres et retours
- une classe par fichier
- aucune logique métier dans `index.php`
- pas de tableau "magique" dispersé partout

### À éviter

- gros `if/else` central dans `Game`
- duplication de logique entre pièces
- coordonnées codées en dur partout
- création directe des pièces dans plusieurs endroits

---

## Déblocage pédagogique par étapes

Vous ne devez pas lire ce TP comme un corrigé complet.

Travaillez dans cet ordre :

### Étape A

Créez uniquement :

- `Position`
- `PieceColor`
- `PieceType`
- `Renderable`

Vérifiez que tout est propre.

### Étape B

Créez :

- `Piece`
- les 6 pièces concrètes

À ce stade, une pièce doit déjà savoir reconnaître la forme d'un déplacement valide.

### Étape C

Créez :

- `Move`
- `Board`

À ce stade, vous devez pouvoir poser et déplacer des pièces.

### Étape D

Ajoutez :

- les exceptions ;
- `PieceFactory`

### Étape E

Créez :

- `Game`

À ce stade, la partie doit fonctionner avec alternance des tours.

### Étape F

Ajoutez :

- `isCheck()`

Seulement maintenant.

---

## Ce qui sera évalué

L'évaluation portera sur :

- le respect strict de l'arborescence ;
- le respect strict des noms de classes ;
- le respect strict des signatures de méthodes ;
- la bonne hiérarchie d'héritage ;
- la mise en place des patterns demandés ;
- la qualité du polymorphisme ;
- la gestion correcte des règles métier de base ;
- la propreté du code.

---

## Bonus autorisés uniquement à la fin

Une fois le sujet principal terminé, vous pouvez ajouter :

- le roque ;
- la promotion ;
- la prise en passant ;
- l'interdiction d'exposer son propre roi ;
- l'échec et mat ;
- des tests automatisés.

Mais ces bonus ne doivent pas casser l'architecture imposée ci-dessus.
