<?php

namespace App\Controller;

use App\DataFixtures\AuteurFixtures;
use App\DataFixtures\GenreFixtures;
use App\DataFixtures\LivreFixtures;
use App\Tests\FixtureLoader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        return $this->render('index.html.twig', [
            'init_loaded' => $request->query->get('init_loaded'),
        ]);
    }

    /**
     * @Route("/bookland/init", name="init")
     */
    public function init(): Response
    {
        $registry = $this->getDoctrine();
        $entityManager = $registry->getManager();
        $fixtureLoader = new FixtureLoader($entityManager, $registry);
        $fixtureLoader->loadFixtures([
            GenreFixtures::class,
            AuteurFixtures::class,
            LivreFixtures::class,
        ]);

        return $this->redirectToRoute('accueil', [
            'init_loaded' => true,
        ]);
    }
}
