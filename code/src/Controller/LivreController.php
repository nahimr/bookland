<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreFilterType;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/livre")
 */
class LivreController extends AbstractController
{
    /**
     * @Route("/", name="livre_index", methods={"GET", "POST"})
     */
    public function index(Request $request, LivreRepository $livreRepository): Response
    {
        $form = $this->createForm(LivreFilterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $fromDate = $form->get('fromDate')->getData();
            $toDate = $form->get('toDate')->getData();

            return $this->render('livre/index.html.twig', [
                'livres' => $livreRepository->filter($form->get('titre')->getData(),
                    $fromDate, $toDate,
                    $form->get('fromScore')->getData(), $form->get('toScore')->getData(),
                    $form->get('sexualParity')->getData(), $form->get('distinctNationality')->getData()),
                'form' => $form->createView(),
            ]);
        }

        return $this->render('livre/index.html.twig', [
            'livres' => $livreRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="livre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $livre = new Livre();
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livre);
            $entityManager->flush();

            return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/new.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livre_show", methods={"GET"})
     */
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="livre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Livre $livre): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $livre = $form->getData();

            try{
                $em->persist($livre);
            } catch (\Exception $e)
            {
                dump($e->getMessage());
            }

            $em->flush();
            $this->addFlash('success', $livre->getTitre() . ' a été modifié !');

            return $this->redirectToRoute('livre_show', [
                'id' => $livre->getId()
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livre_delete", methods={"POST"})
     */
    public function delete(Request $request, Livre $livre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->request->get('_token')))
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
    }
}
