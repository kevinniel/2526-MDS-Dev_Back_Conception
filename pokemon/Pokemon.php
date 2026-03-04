<?php 

$pokemons = json_decode(file_get_contents(__DIR__ . '/pokemon.json'), true);

// var_dump($pokemons);

class PokemonJSONMapper {
    public $id;
    public $name;
    public $types;
    public $pv;
    public $coeff;
    public $attack;
    public $attackspe;
    public $defense;
    public $defensespe;
    public $learnableCapacities;

    public function __construct($datas) {
        $this->hydrate($datas);
    }

    private function hydrate($datas) {
        // je veux boucler sur les attributs de ma classe
        // et affecter les valeurs qui proviennent du json
        // J'utilise ça : get_object_vars($this);
        // pour récupérer la liste des attributs qu'on a créé.
        foreach ( get_object_vars($this) as $key => $value ) {
            $this->$key = $datas[$key];
        }
    }
}

class Pokemon {
    private int $level;
    private int $xp;
    // taille en cm
    private int $height;
    // baisse ou augmente une statistique
    private $nature;
    // capacité passive
    private $talent;
    // liste des capacités actives. 4 max.
    private array $activeCapacities;
    // liste des capacités apprises
    private array $learntCapacities;
    // peut tenir un objet ou pas
    private $object;
    // si le pokémon est shiny ou pas
    private bool $isShiny;
    
    public function __construct(PokemonJSONMapper $pokemonJSONMapper) {
        $this->hydrate($pokemonJSONMapper);
    }

    private function hydrate(PokemonJSONMapper $pokemonJSONMapper) {
        // hydrater à partir du JSON
        foreach ( get_object_vars($pokemonJSONMapper) as $key => $value ) {
            $this->$key = $pokemonJSONMapper[$key];
        }
        // Gestion du level ? => région ?
    }

    public function getCoeff(): float{
        return $this->coeff / 100;
    }

    public function levelUp(): void {
        if ($this->level < 1 || $this->level > 100) {
            return;
        }
        $this->level++;
        $this->statUp();
    }

    public function statUp(): void{
        $this->attack *= $this->getCoeff();
        $this->defense *= $this->getCoeff();
        $this->pv *= $this->getCoeff();
    }

    public function calculateXpToLevelUp(): float {
        return $this->level * $this->getCoeff();
    }


    // SRP
    // setter level
    public function addXp(int $xpToAdd): void {
        // 1) pas d'xp négatif
        if ($xpToAdd <= 0) {
            return;
        }
        // 2) niveau pas à 100 car plus de gain d'xp
        if ($this->level == 100) {
            return;
        }

        // XP manquante avant levelup
        $xpLeft = $this->calculateXpToLevelUp() - $this->xp;

        // si on level up
        if($xpToAdd >= $xpLeft) {

            // on levelup
            $this->levelUp();
            // on passe l'xp courante à 0 (puisqu'on vient de level up)
            $this->xp = 0;
            // On redéclenche le calcul addXP a partir de l'xp restante
            $xpToAdd - $xpLeft ?? $this->addXp($xpToAdd - $xpLeft);
        } else {
            if ($this->level < 100) {
                $this->xp += $xpToAdd;
            }
        }
    }

    // Je veux hydrater les datas depuis le JSON
    
    
}
