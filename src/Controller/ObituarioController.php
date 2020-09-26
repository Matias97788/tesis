<?php

namespace App\Controller;

use App\Entity\Obituario;
use App\Form\ObituarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/obituario")
 */
class ObituarioController extends AbstractController
{
    /**
     * @Route("/", name="obituario_index", methods={"GET"})
     */
    public function index(): Response
    {
        $obituarios = $this->getDoctrine()
            ->getRepository(Obituario::class)
            ->findAll();

        return $this->render('obituario/index.html.twig', [
            'obituarios' => $obituarios,
        ]);
    }

    /**
     * @Route("/obituarios", name="obituarios", methods={"GET"})
     */
    public function obituarios(): Response
    {
        $obituarios = $this->getDoctrine()
            ->getRepository(Obituario::class)
            ->findAll();

        return $this->render('obituarios.html.twig', [
            'obituarios' => $obituarios,]);
    }

    

    /**
     * @Route("/new", name="obituario_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $obituario = new Obituario();
        $form = $this->createForm(ObituarioType::class, $obituario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($obituario);
            $entityManager->flush();

            return $this->redirectToRoute('obituario_index');
        }

        return $this->render('obituario/new.html.twig', [
            'obituario' => $obituario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="obituario_show", methods={"GET"})
     */
    public function show(Obituario $obituario): Response
    {
        return $this->render('obituario/show.html.twig', [
            'obituario' => $obituario,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="obituario_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Obituario $obituario): Response
    {
        $form = $this->createForm(ObituarioType::class, $obituario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('obituario_index');
        }

        return $this->render('obituario/edit.html.twig', [
            'obituario' => $obituario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="obituario_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Obituario $obituario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$obituario->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($obituario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('obituario_index');
    }
}
