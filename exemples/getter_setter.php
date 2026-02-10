<?php

// ✅ Typage
// ✅ age on peut mettre 25000
// ✅ regex mail
// ✅ Visibilité

class User
{

    private string $email;
    private int $age = 3;

    public function __toString(): string
    {
        return "Mon utilisateur à " . $this->age . " ans.";
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email invalide");
        }

        $this->email = strtolower($email);
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {

        if($age < 0 || $age > 120) {
            throw new InvalidArgumentException("Age invalide");
        }

        $this->age = $age;
    }




}

$user = new User();

$user->setAge(120);


// echo('<pre>');
// echo('<code>');
// var_dump($user);
// echo('</code>');
// echo('</pre>');

echo(120);
echo($user);