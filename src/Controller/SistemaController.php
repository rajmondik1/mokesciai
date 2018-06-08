<?php

namespace App\Controller;


use App\Entity\Elektra;
use App\Entity\SaltasVanduo;
use App\Entity\Vanduo;
use App\Form\ElektraType;
use App\Form\SaltasVanduoType;
use App\Form\VanduoType;
use App\Repository\ElektraRepository;
use App\Repository\SaltasVanduoRepository;
use App\Repository\VanduoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SistemaController extends AbstractController
{

    /**
     * @Route("/sistema", name="sistema")
     */
    public function index(VanduoRepository $vanduoRepository, SaltasVanduoRepository $saltasVanduoRepository, ElektraRepository $elektraRepository)
    {
        return $this->render('sistema/index.html.twig', [
            'username' => $this->getUser()->getUsername(),
            'vanduos' => $vanduoRepository->findBy(['userid' => $this->getUser()->getId()],[ 'date' => 'ASC']),
            'saltas_vanduos' => $saltasVanduoRepository->findBy(['userid' => $this->getUser()->getId()], ['date' => 'ASC']),
            'elektras' => $elektraRepository->findBy(['userid' => $this->getUser()->getId()], ['date' => 'ASC']),
        ]);
        }

    /**
     * suds kazkoks , nes neveikia
     */

    /**
     * @Route("/new", name="new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {

        $vanduo = new Vanduo();
        $vanduo->setUserid($this->getUser()->getId());
        $form = $this->createForm(VanduoType::class, $vanduo);
        $form->handleRequest($request);

        $elektra = new Elektra();
        $elektra->setUserid($this->getUser()->getId());
        $formm = $this->createForm(ElektraType::class, $elektra);
        $formm->handleRequest($request);

        $saltasVanduo = new SaltasVanduo();
        $saltasVanduo->setUserid($this->getUser()->getId());
        $formmm = $this->createForm(SaltasVanduoType::class, $saltasVanduo);
        $formmm->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($vanduo);
            $em->persist($elektra);
            $em->persist($saltasVanduo);
            $em->flush();

            return $this->redirectToRoute('sistema');
        }

        return $this->render('sistema/new.html.twig', [
            'vanduo' => $vanduo,
            'elektra' => $elektra,
            'form' => $form->createView(),
            'formm' => $formm->createView(),
            'formmm' => $formmm->createView(),
        ]);
    }

}