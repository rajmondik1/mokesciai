<?php

namespace App\Controller;

use App\Entity\Vanduo;
use App\Form\VanduoType;
use App\Repository\VanduoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vanduo")
 */
class VanduoController extends Controller
{
    /**
     * @Route("/", name="vanduo_index", methods="GET")
     */
    public function index(VanduoRepository $vanduoRepository): Response
    {

        return $this->render('vanduo/index.html.twig', [
            'vanduos' => $vanduoRepository->findBy(['userid' => $this->getUser()->getId()])
        ]);
    }

    /**
     * @Route("/new", name="vanduo_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {

        $vanduo = new Vanduo();
        $vanduo->setUserid($this->getUser()->getId());
        $form = $this->createForm(VanduoType::class, $vanduo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($vanduo);
            $em->flush();

            return $this->redirectToRoute('sistema');
        }

        return $this->render('vanduo/new.html.twig', [
            'vanduo' => $vanduo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vanduo_show", methods="GET")
     */
    public function show(Vanduo $vanduo): Response
    {
        return $this->render('vanduo/show.html.twig', ['vanduo' => $vanduo]);
    }

    /**
     * @Route("/{id}/edit", name="vanduo_edit", methods="GET|POST")
     */
    public function edit(Request $request, Vanduo $vanduo): Response
    {
        $form = $this->createForm(VanduoType::class, $vanduo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vanduo_edit', ['id' => $vanduo->getId()]);
        }

        return $this->render('vanduo/edit.html.twig', [
            'vanduo' => $vanduo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vanduo_delete", methods="DELETE")
     */
    public function delete(Request $request, Vanduo $vanduo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vanduo->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vanduo);
            $em->flush();
        }

        return $this->redirectToRoute('sistema');
    }
}
