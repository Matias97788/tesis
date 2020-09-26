<?php

namespace App\Controller;

use App\Entity\Productos;
use App\Form\ProductosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/productos")
 */
class ProductosController extends AbstractController
{
    /**
     * @Route("/", name="productos_index", methods={"GET"})
     */
    public function index(): Response
    {
        $productos = $this->getDoctrine()
            ->getRepository(Productos::class)
            ->findAll();

        return $this->render('productos/index.html.twig', [
            'productos' => $productos,
        ]);
    }
    /**
     * @Route("/", name="productos", methods={"GET"})
     */
    public function productos(): Response
    {
        $productos = $this->getDoctrine()
            ->getRepository(Productos::class)
            ->findAll();

        return $this->render('productos.html.twig', [
            'productos' => $productos,
        ]);
    }

    /**
     * @Route("/new", name="productos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $producto = new Productos();
        $form = $this->createForm(ProductosType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
              /** @var UploadedFile $brochureFile */
              $brochureFile = $form['brochure']->getData();

              if ($brochureFile) {
                  $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                  // this is needed to safely include the file name as part of the URL
                 //$a = Transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                  $newFilename = '-'.uniqid().'.'.$brochureFile->guessExtension();
                
                  // Move the file to the directory where brochures are stored
                  try {
                      $brochureFile->move(
                          $this->getParameter('brochures_directory'),
                          $newFilename
                      );
                  } catch (FileException $e) {
                      // ... handle exception if something happens during file upload
                  }
  
                  // updates the 'brochureFilename' property to store the PDF file name
                  // instead of its contents
                  $producto->setBrochureFilename($newFilename);
              }
            
            
            
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($producto);
            $entityManager->flush();

            return $this->redirectToRoute('productos_index');
        }

        return $this->render('productos/new.html.twig', [
            'producto' => $producto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="productos_show", methods={"GET"})
     */
    public function show(Productos $producto): Response
    {
        return $this->render('productos/show.html.twig', [
            'producto' => $producto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="productos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Productos $producto): Response
    {
        $form = $this->createForm(ProductosType::class, $producto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('productos_index');
        }

        return $this->render('productos/edit.html.twig', [
            'producto' => $producto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="productos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Productos $producto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$producto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($producto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('productos_index');
    }
}
