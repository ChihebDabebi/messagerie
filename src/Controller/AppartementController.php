<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AppartementType;
use App\Entity\Appartement;
use App\Repository\AppartementRepository;
use Doctrine\ORM\EntityManagerInterface;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppartementController extends AbstractController
{
    
    #[Route('/appartement', name: 'app_appartement_index', methods: ['GET'])]
    public function index(AppartementRepository $appartementRepository): Response
    {
        return $this->render('appartement/index.html.twig', [
            'appartements' => $appartementRepository->findAll(),
        ]);
    }
  
    #[Route('/appartement/new', name: 'app_appartement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $appartement = new Appartement();
        $form = $this->createForm(AppartementType::class, $appartement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($appartement);
            $entityManager->flush();

            return $this->redirectToRoute('app_appartement_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('/appartement/add.html.twig', [
            'appartement' => $appartement,
            'form' => $form,
        ]);
    }

    #[Route('/appartement/{idAppartement}', name: 'app_appartement_show', methods: ['GET'])]
    public function show(int $idAppartement, AppartementRepository $appartementRepository): Response
    {
        $appartement = $appartementRepository->find($idAppartement);
        // Vérifiez si l'appartement existe
        if (!$appartement) {
            throw $this->createNotFoundException('Appartement not found');
        }
        return $this->render('appartement/show.html.twig', [
            'appartement' => $appartement,
        ]);
    }
    #[Route('/appartement/{idAppartement}/edit', name: 'app_appartement_edit', methods: ['GET', 'POST'])]
    public function edit(int $idAppartement, Request $request, EntityManagerInterface $entityManager, AppartementRepository $appartementRepository): Response
    {
        $appartement = $appartementRepository->find($idAppartement);
        $form = $this->createForm(AppartementType::class, $appartement);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_appartement_edit', ['idAppartement' => $idAppartement], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('appartement/edit.html.twig', [
            'appartement' => $appartement,
            'form' => $form->createView(), // Appel de createView() sur le formulaire
        ]);
    }
    

    
    #[Route('/appartement/{idAppartement}/delete', name: 'app_appartement_delete')]
    public function delete(int $idAppartement, EntityManagerInterface $entityManager, AppartementRepository $appartementRepository): Response
    {
        $appartement = $appartementRepository->find($idAppartement);
    
        if (!$appartement) {
            throw $this->createNotFoundException('Appartement not found');
        }
    
        $entityManager->remove($appartement);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_appartement_index', [], Response::HTTP_SEE_OTHER);
    }

   




   
}


