<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                "nom" => "Richard Thaler",
                "sexe" => "M",
                "dateNaissance" => date_create("12/12/1945"),
                "nationalite" => "USA"
            ],
           [
                "nom" => "Cass Sunstein",
                "sexe" => "M",
                "dateNaissance" => date_create("11/23/1943"),
                "nationalite" => "Allemagne"
            ],
            [
                "nom" => "Duschmol",
                "sexe" => "M",
                "dateNaissance" => date_create("12/23/2001"),
                "nationalite" => "Groland"
            ],
            [
                "nom" => "James Enckling",
                "sexe" => "M",
                "dateNaissance" => date_create("07/03/1970"),
                "nationalite" => "France"
            ],
            [
                "nom" => "Jean Dupont",
                "sexe" => "M",
                "dateNaissance" => date_create("07/03/1970"),
                "nationalite" => "France"
            ],
            [
                "nom" => "Francis Gabrelot",
                "sexe" => "M",
                "dateNaissance" => date_create("01/29/1967"),
                "nationalite" => "France"
            ],
            [
                "nom" => "Ayn Rand",
                "sexe" => "F",
                "dateNaissance" => date_create("06/21/1950"),
                "nationalite" => "Russie"
            ],
            [
                "nom" => "Nancy Grave",
                "sexe" => "F",
                "dateNaissance" => date_create("10/24/1952"),
                "nationalite" => "USA"
            ],
        ];

        foreach ($data as $auteur)
        {
            $autObj = new Auteur();
            $autObj->setNomPrenom($auteur["nom"]);
            $autObj->setSexe($auteur["sexe"]);
            $autObj->setDateDeNaissance($auteur["dateNaissance"]);
            $autObj->setNationalite($auteur["nationalite"]);
            $this->addReference($auteur["nom"], $autObj);
            $manager->persist($autObj);
        }

        $manager->flush();
    }
}
