<?php 

// class PaymentService
// {
//     public function pay(string $type, float $amount): void
//     {
//         if ($type === 'card') {
//             echo "Paiement par carte de {$amount}€\n";
//         } elseif ($type === 'paypal') {
//             echo "Paiement PayPal de {$amount}€\n";
//         } else {
//             throw new Exception("Moyen de paiement inconnu");
//         }
//     }
// }


// $service = new PaymentService();
// $service->pay('card', 100);
// $service->pay('paypal', 50);

// Les problèmes avec cette approche 
// - trop de conditions (if/else) / répétition
// - Ajoute d'un type = obligatoirement : modification du code existant
// - logique centralisée & rigide


// ON PASSE EN POLYMORPHISME
// Avec les interfaces

Interface Payment 
{
    public function pay(float $amount): void;
}

class CardPayment implements Payment
{
    public function pay(float $amount): void
    {
        echo "Paiement par carte de {$amount}€\n";
    }
}

class PaypalPayment implements Payment
{
    public function pay(float $amount): void
    {
        echo "Paiement par paypal de {$amount}€\n";
    }
}

class Commercant implements Payment
{
    public function rembourser(float $amount, $client): void
    {
        $this->pay($amount);
    }

    public function pay(float $amount): void
    {
        echo "Paiement par paypal de {$amount}€\n";
    }
}


function effectuerPaiement(Payment $moyenPaiement, float $montant) {
    $moyenPaiement->payer($montant);
}

effectuerPaiement(new CardPayment(), 100);
effectuerPaiement(new PaypalPayment(), 50);