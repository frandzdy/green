<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LegalMentionController extends AbstractController
{
    #[Route('/mentions-legales', name: 'legal_mentions', methods: ['GET'])]
    public function legalMentions(
    ): Response {
        return $this->render('front/right/legal_mentions.html.twig');
    }

    #[Route('/confidentialite', name: 'privacy', methods: ['GET'])]
    public function privacy(
    ): Response {
        return $this->render('front/right/privacy.html.twig');
    }
}
