<?php

namespace App\Controller;

use App\Entity\Studio;
use App\Form\StudioType;
use App\Repository\StudioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/studio')]
class StudioController extends AbstractController
{
    #[Route('/', name: 'app_studio_index', methods: ['GET'])]
    public function index(StudioRepository $studioRepository): Response
    {
        return $this->render('studio/index.html.twig', [
            'studios' => $studioRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_studio_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $studio = new Studio();
        $form = $this->createForm(StudioType::class, $studio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($studio);
            $entityManager->flush();

            return $this->redirectToRoute('app_studio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('studio/new.html.twig', [
            'studio' => $studio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_studio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Studio $studio, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StudioType::class, $studio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_studio_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('studio/edit.html.twig', [
            'studio' => $studio,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_studio_delete', methods: ['POST'])]
    public function delete(Request $request, Studio $studio, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$studio->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($studio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_studio_index', [], Response::HTTP_SEE_OTHER);
    }
}
