<?php

namespace App\Controller;

use App\Entity\NewsLetters;
use App\Repository\GamesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Request $request, GamesRepository $gamesRepository): Response
    {
        $games = $gamesRepository->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'games' => $games,
        ]);
    }

    #[Route('/conditions', name: 'app_conditions')]
    public function conditions(Request $request, GamesRepository $gamesRepository): Response
    {
        $games = $gamesRepository->findAll();
        return $this->render('home/conditions.html.twig', [
            'controller_name' => 'HomeController',
            'games' => $games,
        ]);
    }

    #[Route('/confidentialities', name: 'app_confidentialities')]
    public function confidentialities(Request $request, GamesRepository $gamesRepository): Response
    {
        $games = $gamesRepository->findAll();
        return $this->render('home/confidentialities.html.twig', [
            'controller_name' => 'HomeController',
            'games' => $games,
        ]);
    }
}
