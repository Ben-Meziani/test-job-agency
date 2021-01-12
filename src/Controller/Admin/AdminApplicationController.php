<?php

namespace App\Controller\Admin;

use App\Entity\Application;
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

public function __construct(ApplicationRepository $repository, EntityManagerInterface $em)
{
    $this->repository = $repository;
    $this->em = $em;
}

/** 
 * @Route("/admin/application", name="admin.application.index")
 * @return \Symfony\Component\HttpFoundation\Response
 */
public function index()
{
   $applications = $this->repository->findAll();
   return $this->render('admin/application/index.html.twig', compact('applications'));
}

//Edit a application 

/** 
 * @Route("/admin/application/{id}", name="admin.application.edit", methods="GET|POST")
 * @param Application $application
 * @param Request $request
 * @return \Symfony\Component\HttpFoundation\Response
 */
public function edit(Application $application, Request $request)
{   
    $form = $this->createForm(ApplicationType::class, $application);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->em->flush();
        $this->addFlash('success', 'Bien modifié avec succès');
        return $this->redirectToRoute('admin.application.index');
    }


    return $this->render('admin/application/edit.html.twig', [
        
        "application" => $application, 
        "form" => $form->createView()
    ]);
}

//Delete a application

/**
 *@Route("/admin/application/{id}/delete", name="admin.application.delete", methods="DELETE")
 * @param application $application
 * @return \Symfony\Component\HttpFoundation\RedirectResponse
 */
public function delete(application $application,Request $request)
{
    if ($this->isCsrfTokenValid('delete'. $application->getId(), $request->get('_token'))) {
         $this->em->remove($application);
         $this->em->flush();
         $this->addFlash('success', 'Bien supprimé avec succès');
    }
   return $this->redirectToRoute('admin.application.index');
}
}