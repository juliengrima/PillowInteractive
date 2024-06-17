<?php

namespace App\Controller;

use App\Entity\NewsLetters;
use App\Form\NewsLettersType;
use App\Repository\NewsLettersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/news/letters')]
class NewsLettersController extends AbstractController
{
    #[Route('/', name: 'app_news_letters_index', methods: ['GET'])]
    public function index(NewsLettersRepository $newsLettersRepository): Response
    {
        return $this->render('news_letters/index.html.twig', [
            'news_letters' => $newsLettersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_news_letters_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $newsLetter = new NewsLetters();
        $form = $this->createForm(NewsLettersType::class, $newsLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($newsLetter);
            $entityManager->flush();

            return $this->redirectToRoute('app_news_letters_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('news_letters/new.html.twig', [
            'news_letter' => $newsLetter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_letters_show', methods: ['GET'])]
    public function show(NewsLetters $newsLetter): Response
    {
        return $this->render('news_letters/show.html.twig', [
            'news_letter' => $newsLetter,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_news_letters_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, NewsLetters $newsLetter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NewsLettersType::class, $newsLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_news_letters_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('news_letters/edit.html.twig', [
            'news_letter' => $newsLetter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_news_letters_delete', methods: ['POST'])]
    public function delete(Request $request, NewsLetters $newsLetter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsLetter->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($newsLetter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_news_letters_index', [], Response::HTTP_SEE_OTHER);
    }
}
