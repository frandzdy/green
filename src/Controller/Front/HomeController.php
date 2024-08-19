<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function index(): Response
    {
        return $this->render('front/home/index.html.twig');
    }

    #[Route(path: '/resevation', name: 'calendly')]
    public function calendly(): Response
    {
        return $this->render('front/home/calendly.html.twig');
    }
}
