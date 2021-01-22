<?php

namespace App\Controller;

use App\Entity\Application;
use App\Entity\User;
use App\Repository\ApplicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    public function __construct(ApplicationRepository $appRepository, EntityManagerInterface $em)
{
    $this->appRepository = $appRepository;
    $this->em = $em;
}

    /**
     * @Route("/user/applicant/{id}", name="user.applicant" ,requirements={"id" = "\d+"})
     */
    public function indexApplicant(User $user): Response
    {

        $this->denyAccessUnlessGranted('onlyuser', $user);
        
        $applications = $this->appRepository->findBy([
            'user' => $user,
             ]);

        return $this->render('user/index-applicant.html.twig', [
            'user' => $user,
            'applications' => $applications 
        ]);
    }

    /**
     * @Route("/user/application/{id}", name="user.delete.application", requirements={"id" = "\d+"}, methods="DELETE")
     */
    public function deleteApplication(Application $application, Request $request): Response
    {

        $user = $application->getUser();
        $this->denyAccessUnlessGranted('onlyuser', $user);


        if ($this->isCsrfTokenValid('delete'. $application->getId(), $request->get('_token'))) {
             $this->em->remove($application);
             $this->em->flush();
             $this->addFlash('success', 'Bien supprimé avec succès');
        }
       
            return $this->redirectToRoute('user.applicant',['id'=>$user->getId()]);
        }
    }



