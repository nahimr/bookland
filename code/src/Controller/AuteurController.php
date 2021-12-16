<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurType;
use App\Form\AuthorFilterType;
use App\Repository\AuteurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/auteur")
 */
class AuteurController extends AbstractController
{
    /**
     * @Route("/", name="auteur_index", methods={"GET", "POST"})
     */
    public function index(Request $request ,AuteurRepository $auteurRepository): Response
    {
        $form = $this->createForm(AuthorFilterType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $form->get('threeDistinctBooks')->getData() == 1)
        {
            return $this->render('auteur/index.html.twig', [
                'auteurs' => $auteurRepository->findByThreeDistinctBooks(),
                'form' => $form->createView()
            ]);
        }

        return $this->render('auteur/index.html.twig', [
            'auteurs' => $auteurRepository->findAll(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new", name="auteur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $auteur = new Auteur();
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($auteur);
            $entityManager->flush();

            return $this->redirectToRoute('auteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('auteur/new.html.twig', [
            'auteur' => $auteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="auteur_show", methods={"GET"})
     */
    public function show(Auteur $auteur): Response
    {
        return $this->render('auteur/show.html.twig', [
            'auteur' => $auteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="auteur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Auteur $auteur): Response
    {
        $form = $this->createForm(AuteurType::class, $auteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'L\'auteur ' . $auteur->getNomPrenom() . ' a été modifié');

            return $this->redirectToRoute('auteur_show', [
                'id' => $auteur->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('auteur/edit.html.twig', [
            'auteur' => $auteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="auteur_delete", methods={"POST"})
     */
    public function delete(Request $request, Auteur $auteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$auteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($auteur);
            $entityManager->flush();
            $this->addFlash('success', 'L\'auteur ' . $auteur->getNomPrenom() . ' a été supprimé');
        }

        return $this->redirectToRoute('auteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
