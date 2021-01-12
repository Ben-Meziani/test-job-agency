<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\Mission;
use App\Form\ApplicationType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Route("/missio", name="mission.index")
     * @return \Symfony\Component\HttpFoundation\Response
     * 
     */
    public function index(MissionRepository $repository, Request $request, PaginatorInterface $paginator): Response
    {   
        //pagination
        $data = $repository->findAllVisible();

        $missions = $paginator->paginate(
            $data, //on passe les données
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('mission/index.html.twig', [
            'missions' => $missions,
        ]);
    }
    //Vue en détail de la mission 

    /**
     * @Route("/missions/{slug}-{id}", name="mission.show", requirements={"slug": "[a-z0-9\-]*"})
     * @ParamConverter("mission", class="App\Entity\Mission")
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
        
        $application = new Application();
        $application->setMission($mission);
        $form = $this->createForm(ApplicationType::class, $application);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($application);
            $this->em->flush();
            $this->addFlash('success', 'Votre candidature à bien été soumise');
            return $this->redirectToRoute('admin.application.index', [
                'id' => $application->getId(),
                'slug' => $application->getSlug()
            ]);
        }

        return $this->render('mission/show.html.twig', [
            'mission' => $mission,
            'current_menu' => 'missions',
            'form' => $form->createView()
            ]);
    }

}