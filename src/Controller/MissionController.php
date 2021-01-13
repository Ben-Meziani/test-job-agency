<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Mission;
use App\Entity\MissionSearch;
use App\Form\ApplicationType;
use App\Form\MissionSearchType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(MissionRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {   
        $search = new MissionSearch();
        $form = $this->createForm(MissionSearchType::class, $search);
        $form->handleRequest($request);

        //pagination
        $data = $repository->findAllVisible($search);

        $missions = $paginator->paginate(
            $data, //on passe les données
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('mission/index.html.twig', [
            'missions' => $missions,
            'form'     => $form->createView()
        ]);
    }
    //Vue en détail de la mission 

    /**
     * @Route("/mission/{slug}-{id}", name="mission.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Mission $mission, string $slug, Request $request): Response
    { 
        //Je fais un slug 
         if ($mission->getSlug() !== $slug)
         {
             return $this->redirectToRoute('mission.show', [
                 'id' => $mission->getId(),
                 'slug' => $mission->getSlug()
             ], 301);
         }
        //Formulaire lettre de motivation
       
        $application = new Application();
       
        $form = $this->createForm(ApplicationType::class, $application);
        $form->handleRequest($request);
    

        if($form->isSubmitted() && $form->isValid()){

            if (in_array('ROLE_RECRUITER',$this->getUser()->getRoles())){
                $this->addFlash('failed', "Vous êtes recruteur et vous n'êtes pas authorisé(e) à candidater");
                return $this->redirectToRoute('admin.application.index',['id'=> $this->getUser()->getId()]);
            }

            $application->setMission($mission);
            $application->setUser($this->getUser());
            $this->em->persist($application);
            $this->em->flush();
            $this->addFlash('success', 'Votre candidature à bien été soumise');
            return $this->redirectToRoute('user.applicant',['id'=> $this->getUser()->getId()]);
        }

        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
            'current_menu' => 'missions',
            'form' => $form->createView()
            ]);
    }

}