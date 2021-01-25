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
     * @Route("/admin/application/{id}", name="admin.application.edit", methods="GET|POST")
     * @param Application $application
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Application $applicationStatus, Request $request)
    {
        

        // On initialise le formulaire
        $form = $this->createForm(StatusApplicationType::class, $applicationStatus);

        //On traite le formulaire
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            if ($applicationStatus == true) {
                $this->em->flush();
                $this->addFlash('success', 'La candidature a bien été acceptée');
                return $this->redirectToRoute('admin.application.index', [
                    "application" => $applicationStatus,
                ]);
            } elseif ($applicationStatus == false) {
                $this->em->flush();
                $this->addFlash('success', 'La candidature a bien été refusé');
                return $this->redirectToRoute('admin.application.index', [
                    "application_status" => $applicationStatus,
                ] );
            }
        }


        return $this->render('admin/application/show.html.twig', [

            "application" => $applicationStatus,
            "form" => $form->createView()
        ]);
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
