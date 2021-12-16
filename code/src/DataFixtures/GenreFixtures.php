<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class GenreFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            "Science Fiction",
            "Policier",
            "Philosophie",
            "Économie",
            "Psychologie"
        ];

        foreach ($data as $value)
        {
            $genre = new Genre();
            $genre->setNom($value);
            $manager->persist($genre);
        }

        $manager->flush();
    }
}
