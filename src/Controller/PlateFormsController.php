<?php

namespace App\Controller;

use App\Entity\PlateForms;
use App\Form\PlateFormsType;
use App\Repository\PlateFormsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/plate/forms')]
class PlateFormsController extends AbstractController
{
    #[Route('/', name: 'app_plate_forms_index', methods: ['GET'])]
    public function index(PlateFormsRepository $plateFormsRepository): Response
    {
        return $this->render('plate_forms/index.html.twig', [
            'plate_forms' => $plateFormsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plate_forms_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $plateForm = new PlateForms();
        $form = $this->createForm(PlateFormsType::class, $plateForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($plateForm);
            $entityManager->flush();

            return $this->redirectToRoute('app_plate_forms_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plate_forms/new.html.twig', [
            'plate_form' => $plateForm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plate_forms_show', methods: ['GET'])]
    public function show(PlateForms $plateForm): Response
    {
        return $this->render('plate_forms/show.html.twig', [
            'plate_form' => $plateForm,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plate_forms_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlateForms $plateForm, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlateFormsType::class, $plateForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_plate_forms_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('plate_forms/edit.html.twig', [
            'plate_form' => $plateForm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plate_forms_delete', methods: ['POST'])]
    public function delete(Request $request, PlateForms $plateForm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plateForm->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($plateForm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_plate_forms_index', [], Response::HTTP_SEE_OTHER);
    }
}
