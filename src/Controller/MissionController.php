<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MissionController extends AbstractController
{
     
    /**
     * @var MissionRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface 
     */
    private $em;

   public function __construct(MissionRepository $repository, EntityManagerInterface $em)
   {
       $this->repository = $repository;
      $this->em = $em;
   }
    /**
     * @Route("/missions", name="mission.index")
     */
    public function index(MissionRepository $repository): Response
    {
        $missions = $repository->findAllVisible();
        return $this->render('mission/index.html.twig', [
            'missions' => $missions,
        ]);
    }
    //Vue en détail de la mission 

    /**
     * @Route("/missions/{slug}-{id}", name="mission.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Mission $mission, string $slug): Response
    {
        if ($mission->getSlug() !== $slug)
        {
            return $this->redirectToRoute('mission.show', [
                'id' => $mission->getId(),
                'slug' => $mission->getSlug()
            ], 301);
        }
        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
            'current_menu' => 'missions'
            ]);
    }
}