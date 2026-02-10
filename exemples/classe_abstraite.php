<?php 
/*
class PaiementCarte {
    public function payer(float $montant) {
        echo "Paiement par carte de $montant €";
    }
}

class PaiementPaypal {
    public function payer(float $montant) {
        echo "Paiement via PayPal de $montant €";
    }
}

class PaiementCrypto {
    public function payer(string $montant) {
        echo "Paiement crypto de $montant";
    }
}

function effectuerPaiement($moyenPaiement, float $montant) {
    $moyenPaiement->payer($montant);
}

effectuerPaiement(new PaiementCarte(), 100);
effectuerPaiement(new PaiementPaypal(), 50);
*/

/* Les problèmes

1. On n'a aucune garantie que "$moyenPaiement" ait bien une fonction "payer"
2. On n'a aucune garantie de signature
3. Pas de règle métier précisément définie.
    - combien de méthodes je dois avoir dans $moyenPaiement ?
    - Que doit retourner la méthode "payer()" ?
    - quelles sont les règles communes ?
*/

// On cadre correctement la chose 

abstract class MoyenPaiement
{
    abstract public function payer(float $montant): bool;

    // Méthode concrète
    protected function verifierMontant(float $montant): bool
    {
        if ($montant <= 0) {
            throw new InvalidArgumentException("Le montant doit être supérieur à 0");
        }
        return true;
    }
}

class PaiementCarte extends MoyenPaiement
{
    public function payer(float $montant): bool
    {
        if( $this->verifierMontant($montant) ) {
            echo "Paiement par carte de $montant €";
            return true;
        }
        return false;
    }
}

class PaiementPaypal extends MoyenPaiement
{
    public function payer(float $montant): bool
    {
        echo "Paiement via PayPal de $montant €";
        return true;
    }
}

class PaiementCrypto extends MoyenPaiement
{
    public function payer(float $montant): bool
    {
        echo "Paiement crypto de $montant €";
        return true;
    }
}

class PaiementCheque extends MoyenPaiement
{
    public function payer(float $montant): bool
    {
        echo "Paiement chèque de $montant €";
        return true;
    }
}

function effectuerPaiement(MoyenPaiement $moyenPaiement, float $montant) {
    $moyenPaiement->payer($montant);
}

effectuerPaiement(new PaiementCarte(), 100);
effectuerPaiement(new PaiementPaypal(), 50);
effectuerPaiement(new PaiementCrypto(), 150);
effectuerPaiement(new PaiementCheque(), 150);