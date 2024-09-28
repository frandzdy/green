<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Attribute\Route;

#[Cache(maxage: 3600, public: true)]
class TestimonyController extends AbstractController
{
    #[Route('/temoignages', name: 'testimonials', methods: ['GET'])]
    public function testimonials(
    ): Response {
        return $this->render('front/testimony/index.html.twig');
    }
}
