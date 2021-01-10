<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\ApplicationType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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


    /**
     * @Route("/register", name="app_register")
     */
    public function application(Request $request): Response
    {
        $form = $this->createForm(ApplicationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            // recuperer la relation ManyToMany entre user et mission 
            // set user_id + set mission_id set 

            //user_id|mission_id|motivation letter

            $user->setCv();

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email


        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    

}

}