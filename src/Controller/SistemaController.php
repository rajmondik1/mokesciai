<?php

namespace App\Controller;


use App\Repository\ElektraRepository;
use App\Repository\SaltasVanduoRepository;
use App\Repository\VanduoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}