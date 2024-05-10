<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Discussion;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

use App\Form\DiscussionType;
use App\Repository\DiscussionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiscussionController extends AbstractController
{
    #[Route('/discussion', name: 'app_discussion')]
    public function index(): Response
    {
        return $this->render('discussion/index.html.twig', [
            'controller_name' => 'DiscussionController',
        ]);
    }
    #[Route('/discussions', name: 'list_discussions', methods: ['GET'])]
    public function show(Request $request,DiscussionRepository $discussionRepository,ManagerRegistry $doctrine,PaginatorInterface $paginator):Response{
        $discussions = $discussionRepository->findAll();
        $userRepository = $doctrine->getRepository(User::class);
        $connectedUser = $userRepository->find(49); 
        $discussions = $paginator->paginate(
            $discussions, /* query NOT result */
            $request->query->getInt('page', 1),
            4
        );
        return $this->render('discussion/listDiscussion.html.twig', [
            'discussions' => $discussions,
            'connectedUser' => $connectedUser
        ]);
        

    }
    #[Route('/discussion/add', name: 'add_discussion', methods: ['GET', 'POST'])]
    public function new(Request $request,ManagerRegistry $doctrine): Response
    {
        $userRepository = $doctrine->getRepository(User::class);
        $connectedUser = $userRepository->find(49); 
        if (!$connectedUser) {
            throw $this->createNotFoundException('No user found for id 1');
        }
        $em = $doctrine->getManager();
        $discussion = new Discussion();
        $discussion->setCreateur($connectedUser);
        $form = $this->createForm(DiscussionType::class, $discussion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($discussion);
            $em->flush();

            return $this->redirectToRoute('list_discussions');
        }

        return $this->renderForm('/discussion/add.html.twig', [
            'discussion' => $discussion,
            'form' => $form,
        ]);
    }
    #[Route('/discussion/edit/{id}', name: 'edit_discussion', methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request, EntityManagerInterface $entityManager,DiscussionRepository $discussionRepository): Response
    {
        $discussion = $discussionRepository->find($id);
        $form = $this->createForm(DiscussionType::class, $discussion);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('list_discussions', ['id' => $id], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('discussion/modifier.html.twig', [
            'discussion' => $discussion,
            'form' => $form->createView(), // Appel de createView() sur le formulaire
        ]);
    }
    #[Route('/discussion/delete/{idDiscussion}', name: 'delete_discussion')]
    public function delete(int $idDiscussion, EntityManagerInterface $entityManager, DiscussionRepository $discussionRepository): Response
    {
        $discussion = $discussionRepository->find($idDiscussion);
    
        if (!$discussion) {
            throw $this->createNotFoundException('Discussion not found');
        }
    
        $entityManager->remove($discussion);
        $entityManager->flush();
    
        return $this->redirectToRoute('list_discussions', [], Response::HTTP_SEE_OTHER);
    }



}
