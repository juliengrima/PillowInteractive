<?php

namespace App\Controller;

use App\Entity\ZonesText;
use App\Form\ZonesTextType;
use App\Repository\ZonesTextRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/zones/text')]
class ZonesTextController extends AbstractController
{
    #[Route('/', name: 'app_zones_text_index', methods: ['GET'])]
    public function index(ZonesTextRepository $zonesTextRepository): Response
    {
        return $this->render('zones_text/index.html.twig', [
            'zones_texts' => $zonesTextRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_zones_text_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $zonesText = new ZonesText();
        $form = $this->createForm(ZonesTextType::class, $zonesText);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($zonesText);
            $entityManager->flush();

            return $this->redirectToRoute('app_zones_text_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('zones_text/new.html.twig', [
            'zones_text' => $zonesText,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_zones_text_show', methods: ['GET'])]
    public function show(ZonesText $zonesText): Response
    {
        return $this->render('zones_text/show.html.twig', [
            'zones_text' => $zonesText,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_zones_text_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ZonesText $zonesText, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ZonesTextType::class, $zonesText);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_zones_text_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('zones_text/edit.html.twig', [
            'zones_text' => $zonesText,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_zones_text_delete', methods: ['POST'])]
    public function delete(Request $request, ZonesText $zonesText, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$zonesText->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($zonesText);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_zones_text_index', [], Response::HTTP_SEE_OTHER);
    }
}
