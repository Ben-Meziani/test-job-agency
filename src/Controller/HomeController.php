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
        //to see the 10 latest missions
        $missions = $repository->findLatest(array(), array('id' => 'asc'));
        
        return $this->render('pages/home.html.twig', [
            'missions' => $missions,
        ]);
    }
}
