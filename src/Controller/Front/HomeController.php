<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function index(Request $request): Response
    {
        return $this->render('front/home/index.html.twig');
    }

    #[Route(path: '/reservation', name: 'calendly')]
    public function calendly(): Response
    {
        return $this->render('front/home/calendly.html.twig');
    }

    #[Route(path: '/procedure', name: 'process')]
    public function process(): Response
    {
        return $this->render('front/home/process.html.twig');
    }

    #[Route(path: '/engagement', name: 'commitment')]
    public function commitment(): Response
    {
        return $this->render('front/home/commitment.html.twig');
    }
}
