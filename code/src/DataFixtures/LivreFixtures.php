<?php

namespace App\DataFixtures;

use App\Entity\Auteur;
use App\Entity\Livre;
use App\Repository\AuteurRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LivreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
               "nom" => "Symfonystique",
               "isbn" => "978-2-07-036822-8",
                "nbPages" => 117,
                "date" => date_create("01/20/2008"),
                "note" => 8,
                "genres" => ["Policier", "Philosophie"],
                "auteurs" => ["Francis Gabrelot", "Ayn Rand", "Nancy Grave"]
            ]
        ];

        foreach ($data as $livre)
        {
            $livreObj = new Livre();
            $livreObj->setTitre($livre["nom"]);
            $livreObj->setIsbn($livre["isbn"]);
            $livreObj->setNbpages($livre["nbPages"]);
            $livreObj->setDateDeParution($livre["date"]);
            $livreObj->setNote($livre["note"]);

            // TODO: Make auteur with books here instead of AuteurFixtures
            foreach ($livre["auteurs"] as $auteur)
            {
                $repo = $manager->getRepository(Auteur::class);
                $auteurObj = $repo->findOneBy(["nom_prenom" => $auteur]);
                $livreObj->addAuteur($auteurObj);
            }
            foreach ($livre["genres"] as $genre)
            {
                $repo = $manager->getRepository(Genre::class);
                $genreObj = $repo->findOneBy(["nom" => $genre]);
                $livreObj->addAuteur($genreObj);
            }

            $manager->persist($livreObj);
        }

        $manager->flush();
    }
}
