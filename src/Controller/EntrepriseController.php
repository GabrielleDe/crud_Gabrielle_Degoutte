<?php

namespace App\Controller;

use App\DataFixtures\EmployesFixtures;
use App\Entity\Employes;
use App\Form\EmployeType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EntrepriseController extends AbstractController
{
    #[Route('/entreprise', name: 'app_entreprise')]

    public function index(EmployesRepository $repo): Response
    {
        $employes=$repo->findAll();
        return $this->render('entreprise/index.html.twig', [
            'employes' => $employes,
        ]);
    }

    #[Route('/entreprise/edit/{id}', name: 'entreprise_edit')]
    #[Route('/entreprise/add', name: 'entreprise_add')]
    public function edit(Request $globals, EntityManagerInterface $manager, Employes $employes = null)
    {
        if($employes == null)
        {
            $employes = new Employes;
        }

        
        $form = $this->createForm(EmployeType::class, $employes);
        
        $form->handleRequest($globals);

        
        if($form->isSubmitted() && $form->isValid())
        {
            //dd($employes);
            $manager->persist($employes);
            $manager->flush();
            return $this->redirectToRoute("app_entreprise");
        }

     return $this->renderForm('entreprise/form.html.twig',[
        'form' => $form,
        'edit' => $employes->getId() !==null
     ]) ;
    }
    
    #[Route('/entreprise/delete/{id}', name:'entreprise_delete')]

    public function delete(Employes $employe,EntityManagerInterface $manager,)
    {
        $manager->remove($employe);
        $manager->flush();
     
     return $this->redirectToRoute(("app_entreprise"));
    }
}
