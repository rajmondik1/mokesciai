<?php

namespace App\Controller;


use App\Repository\VanduoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SistemaController extends AbstractController
{

    /**
     * @Route("/sistema", name="sistema")
     */
    public function index(VanduoRepository $vanduoRepository)
    {
        return $this->render('sistema/index.html.twig');

    }
}