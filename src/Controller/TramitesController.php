<?php

namespace App\Controller;

use App\Entity\Tramites;
use App\Form\TramitesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/tramites")
 */
class TramitesController extends AbstractController
{
    /**
     * @Route("/", name="tramites_index", methods={"GET"})
     */
    public function index(): Response
    {
        $tramites = $this->getDoctrine()
            ->getRepository(Tramites::class)
            ->findAll();

        return $this->render('tramites/index.html.twig', [
            'tramites' => $tramites,]);
    }
     /**
     * @Route("/tramites", name="tramites", methods={"GET"})
     */
    public function tramites(): Response
    {
        $tramites = $this->getDoctrine()
            ->getRepository(Tramites::class)
            ->findAll();

        return $this->render('tramites.html.twig', [
            'tramites' => $tramites,]);
    }


    /**
     * @Route("/new", name="tramites_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tramite = new Tramites();
        $form = $this->createForm(TramitesType::class, $tramite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tramite);
            $entityManager->flush();

            return $this->redirectToRoute('tramites_index');
        }

        return $this->render('tramites/new.html.twig', [
            'tramite' => $tramite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tramites_show", methods={"GET"})
     */
    public function show(Tramites $tramite): Response
    {
        return $this->render('tramites/show.html.twig', [
            'tramite' => $tramite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tramites_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tramites $tramite): Response
    {
        $form = $this->createForm(TramitesType::class, $tramite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tramites_index');
        }

        return $this->render('tramites/edit.html.twig', [
            'tramite' => $tramite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tramites_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Tramites $tramite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tramite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tramite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tramites_index');
    }
}
