<?php
// src/EventSubscriber/TwigEventSubscriber.php

namespace App\EventSubscriber;

use App\Repository\GamesRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $gamesRepository;

    public function __construct(Environment $twig, GamesRepository $gamesRepository)
    {
        $this->twig = $twig;
        $this->gamesRepository = $gamesRepository;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $games = $this->gamesRepository->findAll();
        $this->twig->addGlobal('games', $games);
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}