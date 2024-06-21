<?php

namespace App\Controller;

use App\Entity\Platforms;
use App\Form\PlatformsType;
use App\Repository\PlatformsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/platforms')]
class PlatformsController extends AbstractController
{
    #[Route('/', name: 'app_platforms_index', methods: ['GET'])]
    public function index(PlatformsRepository $platformsRepository): Response
    {
        return $this->render('platforms/index.html.twig', [
            'platforms' => $platformsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_platforms_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $platform = new Platforms();
        $form = $this->createForm(PlatformsType::class, $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($platform);
            $entityManager->flush();

            return $this->redirectToRoute('app_platforms_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('platforms/new.html.twig', [
            'platform' => $platform,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_platforms_show', methods: ['GET'])]
    public function show(Platforms $platform): Response
    {
        return $this->render('platforms/show.html.twig', [
            'platform' => $platform,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_platforms_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Platforms $platform, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlatformsType::class, $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_platforms_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('platforms/edit.html.twig', [
            'platform' => $platform,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_platforms_delete', methods: ['POST'])]
    public function delete(Request $request, Platforms $platform, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$platform->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($platform);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_platforms_index', [], Response::HTTP_SEE_OTHER);
    }
}
