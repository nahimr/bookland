<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use App\Entity\Livre;
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
            ],
            [
                "nom" => "La grève",
                "isbn" => "978-2-251-44417-8",
                "nbPages" => 1245,
                "date" => date_create("06/12/1961"),
                "note" => 19,
                "genres" => ["Philosophie"],
                "auteurs" => ["Ayn Rand", "James Enckling"]
            ],
            [
                "nom" => "Symfonyland",
                "isbn" => "978-2-212-55652-0",
                "nbPages" => 131,
                "date" => date_create("09/17/1980"),
                "note" => 15,
                "genres" => ["Science Fiction"],
                "auteurs" => ["Jean Dupont", "Ayn Rand", "James Enckling"]
            ],
            [
                "nom" => "Négociation Complexe",
                "isbn" => "978-2-0807-1057-4",
                "nbPages" => 234,
                "date" => date_create("09/25/1992"),
                "note" => 16,
                "genres" => ["Psychologie"],
                "auteurs" => ["Richard Thaler", "Cass Sunstein"]
            ],
            [
                "nom" => "Ma vie",
                "isbn" => "978-0-300-12223-7",
                "nbPages" => 5,
                "date" => date_create("11/08/2021"),
                "note" => 3,
                "genres" => ["Policier"],
                "auteurs" => ["Jean Dupont"]
            ],
            [
                "nom" => "Ma vie : suite",
                "isbn" => "978-0-141-18776-1",
                "nbPages" => 5,
                "date" => date_create("11/09/2021"),
                "note" => 1,
                "genres" => ["Policier"],
                "auteurs" => ["Jean Dupont"]
            ],
            [
                "nom" => "Le monde comme volonté et comme représentation",
                "isbn" => "978-0-141-18786-0",
                "nbPages" => 1987,
                "date" => date_create("11/09/1821"),
                "note" => 19,
                "genres" => ["Philosophie"],
                "auteurs" => ["Nancy Grave", "Francis Gabrelot"]
            ],
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
                $livreObj->addAuteur($this->getReference($auteur));
            }

            foreach ($livre["genres"] as $genre)
            {
                $repo = $manager->getRepository(Genre::class);
                $genreObj = $repo->findOneBy(["nom" => $genre]);
                $livreObj->addGenre($genreObj);
            }

            $manager->persist($livreObj);
        }

        $manager->flush();
    }
}
