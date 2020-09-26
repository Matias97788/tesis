<?php

namespace App\Controller;

use App\Entity\Otros;
use App\Form\OtrosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/otros")
 */
class OtrosController extends AbstractController
{
    /**
     * @Route("/", name="otros_index", methods={"GET"})
     */
    public function index(): Response
    {
        $otros = $this->getDoctrine()
            ->getRepository(Otros::class)
            ->findAll();

        return $this->render('otros/index.html.twig', [
            'otros' => $otros,
        ]);
    }
     /**
     * @Route("/otros", name="otros", methods={"GET"})
     */
    public function otros(): Response
    {
        $otros = $this->getDoctrine()
            ->getRepository(Otros::class)
            ->findAll();

        return $this->render('otros.html.twig', [
            'otros' => $otros,
        ]);
    }

    /**
     * @Route("/new", name="otros_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $otro = new Otros();
        $form = $this->createForm(OtrosType::class, $otro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($otro);
            $entityManager->flush();

            return $this->redirectToRoute('otros_index');
        }

        return $this->render('otros/new.html.twig', [
            'otro' => $otro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="otros_show", methods={"GET"})
     */
    public function show(Otros $otro): Response
    {
        return $this->render('otros/show.html.twig', [
            'otro' => $otro,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="otros_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Otros $otro): Response
    {
        $form = $this->createForm(OtrosType::class, $otro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('otros_index');
        }

        return $this->render('otros/edit.html.twig', [
            'otro' => $otro,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="otros_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Otros $otro): Response
    {
        if ($this->isCsrfTokenValid('delete'.$otro->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($otro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('otros_index');
    }
}
