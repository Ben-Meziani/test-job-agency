<?php

namespace App\Controller;

use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MissionRepository $repository): Response
    {
        $missions = $repository->findAll();
        
        return $this->render('pages/home.html.twig', [
            'missions' => $missions,
        ]);
    }
}
