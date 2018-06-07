<?php

namespace App\Controller;

use App\Entity\SaltasVanduo;
use App\Form\SaltasVanduoType;
use App\Repository\SaltasVanduoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cold")
 */
class SaltasVanduoController extends Controller
{
    /**
     * @Route("/", name="saltas_vanduo_index", methods="GET")
     */
    public function index(SaltasVanduoRepository $saltasVanduoRepository): Response
    {
        return $this->render('saltas_vanduo/index.html.twig', [
            'saltas_vanduos' => $saltasVanduoRepository->findBy(['userid' => $this->getUser()->getId()], ['date' => 'ASC']),
            'username' => $this->getUser()->getUsername()
        ]);
    }

    /**
     * @Route("/new", name="saltas_vanduo_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $saltasVanduo = new SaltasVanduo();
        $saltasVanduo->setUserid($this->getUser()->getId());
        $form = $this->createForm(SaltasVanduoType::class, $saltasVanduo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($saltasVanduo);
            $em->flush();

            return $this->redirectToRoute('saltas_vanduo_index');
        }

        return $this->render('saltas_vanduo/new.html.twig', [
            'saltas_vanduo' => $saltasVanduo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="saltas_vanduo_show", methods="GET")
     */
    public function show(SaltasVanduo $saltasVanduo): Response
    {
        return $this->render('saltas_vanduo/show.html.twig', ['saltas_vanduo' => $saltasVanduo]);
    }

    /**
     * @Route("/{id}/edit", name="saltas_vanduo_edit", methods="GET|POST")
     */
    public function edit(Request $request, SaltasVanduo $saltasVanduo): Response
    {
        $form = $this->createForm(SaltasVanduoType::class, $saltasVanduo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('saltas_vanduo_edit', ['id' => $saltasVanduo->getId()]);
        }

        return $this->render('saltas_vanduo/edit.html.twig', [
            'saltas_vanduo' => $saltasVanduo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="saltas_vanduo_delete", methods="DELETE")
     */
    public function delete(Request $request, SaltasVanduo $saltasVanduo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$saltasVanduo->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($saltasVanduo);
            $em->flush();
        }

        return $this->redirectToRoute('saltas_vanduo_index');
    }
}
