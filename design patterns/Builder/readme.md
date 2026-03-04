Retour au <a href="../../README.md"> sommaire</a>

# 📌 Builder

## 🎯 Problème qu'il résout

Lorsqu'un objet a de nombreux paramètres de construction (certains obligatoires, d'autres optionnels), utiliser un constructeur avec de nombreux paramètres devient problématique. On se retrouve avec des constructeurs très longs, difficiles à lire, et où l'ordre des paramètres est crucial. De plus, si certains paramètres sont optionnels, il faut créer plusieurs constructeurs surchargés ou utiliser des valeurs par défaut, ce qui rend le code complexe et peu flexible.

Le Builder résout ce problème en séparant la construction d'un objet complexe de sa représentation. Il permet de construire l'objet étape par étape, en utilisant des méthodes fluides (fluent interface) qui rendent le code plus lisible et plus flexible.

## 🧠 Principe de fonctionnement

Le pattern Builder fonctionne en créant une classe Builder séparée qui contient des méthodes pour configurer chaque aspect de l'objet à construire. Chaque méthode de configuration retourne le Builder lui-même (méthode fluide), permettant d'enchaîner les appels. Une méthode finale (généralement `build()`) assemble tous les paramètres et retourne l'objet final. Le constructeur de l'objet cible peut ainsi rester simple ou même privé, et toute la complexité de construction est gérée par le Builder.

## 🏗 Structure (rôles des classes)

Le pattern Builder implique généralement :

- **Classe produit (Product)** : L'objet complexe à construire, avec potentiellement de nombreux attributs

- **Classe Builder** : Contient des méthodes pour configurer chaque aspect du produit. Chaque méthode retourne le Builder pour permettre l'enchaînement (fluent interface). Contient une méthode `build()` qui assemble et retourne le produit final

- **Directeur (Director)** : Optionnel. Peut définir des séquences de construction prédéfinies en utilisant le Builder

## 📈 Avantages

Les **avantages** du Builder :

- **Lisibilité améliorée :** Le code de construction devient beaucoup plus lisible grâce aux méthodes nommées et à l'enchaînement fluide. On comprend immédiatement ce que chaque paramètre représente

- **Flexibilité :** On peut construire des objets avec différentes combinaisons de paramètres sans créer de multiples constructeurs. Les paramètres optionnels peuvent être omis facilement

- **Validation centralisée :** La méthode `build()` peut valider que tous les paramètres requis sont présents et cohérents avant de créer l'objet

- **Séparation des responsabilités :** La logique de construction est séparée de la classe du produit, ce qui facilite la maintenance et les modifications

## ⚠️ Inconvénients

Les **inconvénients** du Builder :

- **Complexité accrue :** Le pattern introduit une classe supplémentaire (le Builder), ce qui peut être excessif pour des objets simples avec peu de paramètres

- **Surcharge de code :** Il faut écrire beaucoup de code pour créer le Builder et toutes ses méthodes de configuration, ce qui peut être fastidieux

- **Performance légèrement réduite :** La construction via Builder peut être légèrement plus lente qu'un constructeur direct, mais cette différence est généralement négligeable

- **Immutabilité compromise :** Si l'objet construit doit être immuable, il faut s'assurer que le Builder ne garde pas de références à l'objet après sa construction

## 🧩 Cas d'usage réel possible

Le Builder est très utilisé pour construire des objets complexes comme les requêtes SQL, les configurations d'applications, les objets de transfert de données (DTO), et les objets de domaine avec de nombreux attributs optionnels.

Pour ce TP, nous allons explorer le cas d'un **configurateur d'ordinateur sur mesure** :

- **Contexte métier :** Un site e-commerce permet aux clients de configurer leur ordinateur sur mesure en choisissant le processeur, la carte graphique, la RAM, le stockage, le boîtier, etc. Chaque composant a plusieurs options, et certains sont obligatoires (processeur, RAM) tandis que d'autres sont optionnels (carte graphique dédiée, SSD supplémentaire)

- **Problématique :** Si on utilise un constructeur avec tous les paramètres, on obtient quelque chose comme `new Computer(cpu, gpu, ram, storage, case, cooling, ...)` avec potentiellement 10+ paramètres. C'est illisible, difficile à maintenir, et l'ordre des paramètres devient crucial. De plus, certains paramètres sont optionnels, ce qui complique encore la situation

- **Solution Builder :** On crée une classe `ComputerBuilder` avec des méthodes fluides comme `withCPU()`, `withGPU()`, `withRAM()`, `withStorage()`, etc. Le client peut alors construire son ordinateur de manière lisible : `new ComputerBuilder().withCPU("Intel i7").withRAM(16).withStorage("1TB SSD").build()`. Les paramètres optionnels peuvent être omis, et la méthode `build()` valide que tous les composants requis sont présents

➡️ Consulter l'exemple <a href="./example.ts">ici</a> ou lancer la commande suivante `node example.ts`
