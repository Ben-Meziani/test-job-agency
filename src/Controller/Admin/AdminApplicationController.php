<?php

namespace App\Controller\Admin;

use App\Entity\Application;
use App\Form\StatusApplicationType;
use App\Repository\ApplicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminApplicationController extends AbstractController
{

    /**
     * @var ApplicationRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ApplicationRepository $appRepository, EntityManagerInterface $em)
    {
        $this->appRepository = $appRepository;
        $this->em = $em;
    }

    /** 
     * @Route("/admin/application", name="admin.application.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $applications = $this->appRepository->findLatest();


        return $this->render('admin/application/index.html.twig', compact('applications'));
    }

    //Edit a application 

    /** 
     * @Route("/admin/application/{id}", name="admin.application.show", methods="GET")
     * @param Application $application
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Application $application, Request $request)
    {
       
        // // On initialise le formulaire
        // $form = $this->createForm(StatusApplicationType::class, $application);


        
        // $form->handleRequest($request);
        // if ($form->isSubmitted()  ) {
        //     dd($form->getErrors());
        //     $answer = $form->get('is_accepted')->getData();
        //     if ($answer == true) {
                
        //         $this->em->flush();
        //         $this->addFlash('success', 'La candidature a bien été acceptée');
        //         return $this->redirectToRoute('admin.application.index', [
        //             "application" => $application,
        //         ]);
        //     } elseif ($answer == false) {
        //         $this->em->flush();
        //         $this->addFlash('success', 'La candidature a bien été refusé');
        //         return $this->redirectToRoute('admin.application.index', [
        //             "application_status" => $application,

        //         ] );
        //     }
        // }


        return $this->render('admin/application/show.html.twig', [

            "application" => $application,
        ]);
    }

    /**
     * 
     * @Route("/admin/application/{id}/{bool}", requirements={"bool" = "[01]"}, name="admin.application.editStatus", methods="GET"))
     *
     */
    public function editStatus(Application $application, $bool, Request $request)
    {
        
        if($application->getIsAccepted() != null){
        }
        //             condition ? si vrai : si faux 
        $isAccepted = $bool != 1 ? false : true;
        
        $application->setIsAccepted($isAccepted);
        $this->em->flush();

    
       return $this->redirectToRoute('admin.application.index');
    }

    //Delete a application

    /**
     *@Route("/admin/application/{id}/delete", name="admin.application.delete", methods="DELETE")
     * @param application $application
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(application $application, Request $request)
    {


        $this->denyAccessUnlessGranted('onlyuser', $this->getUser());
        if ($this->isCsrfTokenValid('delete' . $application->getId(), $request->get('_token'))) {
            $this->em->remove($application);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');
        }
        return $this->redirectToRoute('admin.application.index');
    }
}
