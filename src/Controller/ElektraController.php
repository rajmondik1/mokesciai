<?php

namespace App\Controller;

use App\Entity\Elektra;
use App\Form\ElektraType;
use App\Repository\ElektraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/elektra")
 */
class ElektraController extends Controller
{
    /**
     * @Route("/", name="elektra_index", methods="GET")
     */
    public function index(ElektraRepository $elektraRepository): Response
    {
        return $this->render('elektra/index.html.twig', [
            'elektras' => $elektraRepository->findBy(['userid' => $this->getUser()->getId()], ['date' => 'ASC']),
            'username' => $this->getUser()->getUsername()
        ]);
    }

    /**
     * @Route("/new", name="elektra_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $elektra = new Elektra();
        $elektra->setUserid($this->getUser()->getId());
        $form = $this->createForm(ElektraType::class, $elektra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($elektra);
            $em->flush();

            return $this->redirectToRoute('elektra_index');
        }

        return $this->render('elektra/new.html.twig', [
            'elektra' => $elektra,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="elektra_show", methods="GET")
     */
    public function show(Elektra $elektra): Response
    {
        return $this->render('elektra/show.html.twig', ['elektra' => $elektra]);
    }

    /**
     * @Route("/{id}/edit", name="elektra_edit", methods="GET|POST")
     */
    public function edit(Request $request, Elektra $elektra): Response
    {
        $form = $this->createForm(ElektraType::class, $elektra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('elektra_edit', ['id' => $elektra->getId()]);
        }

        return $this->render('elektra/edit.html.twig', [
            'elektra' => $elektra,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="elektra_delete", methods="DELETE")
     */
    public function delete(Request $request, Elektra $elektra): Response
    {
        if ($this->isCsrfTokenValid('delete'.$elektra->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($elektra);
            $em->flush();
        }

        return $this->redirectToRoute('elektra_index');
    }
}
