<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Entity\Appartement;

use App\Form\FactureType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FactureRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class FactureController extends AbstractController
{
    #[Route('/facture', name: 'app_facture_index', methods: ['GET'])]
public function index(FactureRepository $factureRepository): Response
{
    return $this->render('facture/index.html.twig', [
        'factures' => $factureRepository->findAll(),
    ]);
}
#[Route('/facture/new', name: 'app_facture_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $facture = new Facture();
    $form = $this->createForm(FactureType::class, $facture);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($facture);
        $entityManager->flush();

        return $this->redirectToRoute('app_facture_new', [], Response::HTTP_SEE_OTHER);
    }

    // Rendez le formulaire et la vue associée
    return $this->render('facture/add.html.twig', [
        'facture' => $facture,
        'form' => $form->createView(),
    ]);
}

#[Route('/facture/{idFacture}', name: 'app_facture_show', methods: ['GET'])]
public function show(int $idFacture, FactureRepository $factureRepository): Response
{
    $facture = $factureRepository->find($idFacture);
    if (!$facture) {
        throw $this->createNotFoundException('Facture non Trouveé');
    }
    return $this->render('facture/show.html.twig', [
        'facture' => $facture,
    ]);
}
#[Route('/facture/{idFacture}/edit', name: 'app_facture_edit', methods: ['GET', 'POST'])]
public function edit(int $idFacture, Request $request, EntityManagerInterface $entityManager, FactureRepository $factureRepository): Response
{
    $facture = $factureRepository->find($idFacture);
    $form = $this->createForm(FactureType::class, $facture);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        return $this->redirectToRoute('app_facture_edit', ['idFacture' => $idFacture], Response::HTTP_SEE_OTHER);
    }

    return $this->render('facture/edit.html.twig', [
        'facture' => $facture,
        'form' => $form->createView(), // Appel de createView() sur le formulaire
    ]);
}

#[Route('/facture/{idfacture}/delete', name: 'app_facture_delete')]
public function delete(int $idfacture, EntityManagerInterface $entityManager, FactureRepository $factureRepository): Response
{
    $facture = $factureRepository->find($idfacture);

    if (!$facture) {
        throw $this->createNotFoundException('Appartement not found');
    }

    $entityManager->remove($facture);
    $entityManager->flush();

    return $this->redirectToRoute('app_facture_index', [], Response::HTTP_SEE_OTHER);
}
#[Route('/appartement/{idAppartement}/factures', name: 'app_appartement_factures')]
public function showAppartementFactures(int $idAppartement, FactureRepository $factureRepository, EntityManagerInterface $entityManager): Response
{
    $appartement = $entityManager->getRepository(Appartement::class)->find($idAppartement); // Utilisez directement le gestionnaire d'entité
    if (!$appartement) {
        throw $this->createNotFoundException('Appartement non trouvé');
    }

    // Récupérer les factures liées à l'appartement
    $factures = $factureRepository->findBy(['idAppartement' => $idAppartement]);

    return $this->render('appartement/factures.html.twig', [
        'appartement' => $appartement,
        'factures' => $factures,
    ]);
}


}
