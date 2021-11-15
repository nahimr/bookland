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
               "nom" => "Ayn Rand",
               "sexe" => "F",
               "dateNaissance" => date_create("06/21/1950"),
               "nationalite" => "Russie"
            ],
            [
                "nom" => "Duschmol",
                "sexe" => "M",
                "dateNaissance" => date_create("12/23/2001"),
                "nationalite" => "Groland"
            ],
            [
                "nom" => "Nancy Grave",
                "sexe" => "F",
                "dateNaissance" => date_create("10/24/1952"),
                "nationalite" => "USA"
            ],
            [
                "nom" => "James Enckling",
                "sexe" => "M",
                "dateNaissance" => date_create("07/03/1970"),
                "nationalite" => "France"
            ],

        ];

        foreach ($data as $auteur)
        {
            $autObj = new Auteur();
            $autObj->setNomPrenom($auteur["nom"]);
            $autObj->setSexe($auteur["sexe"]);
            $autObj->setDateDeNaissance($auteur["dateNaissance"]);
            $autObj->setNationalite($auteur["nationalite"]);
            $manager->persist($autObj);
        }

        $manager->flush();
    }
}
