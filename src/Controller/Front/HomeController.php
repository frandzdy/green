<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Attribute\Route;

#[Cache(smaxage: 3600, public: true)]
class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function index(Request $request): Response
    {
        $response = $this->render('front/home/index.html.twig');

        // Calcul d'un etag ou d'une date de dernière modification en fonction du contenu
        if ($response->getContent()) {
            $response->setEtag(md5($response->getContent()));
        }

        // Validation du cache et mise à jour de la réponse en fonction du cache existant
        if ($response->isNotModified($request)) {
            return $response;
        }

        return $response;
    }

    #[Route(path: '/reservation', name: 'calendly')]
    public function calendly(): Response
    {
        return $this->render('front/home/calendly.html.twig');
    }

    #[Route(path: '/procedure', name: 'process')]
    public function process(Request $request): Response
    {
        $response = $this->render('front/home/process.html.twig');

        if ($response->getContent()) {
            // Calcul d'un etag ou d'une date de dernière modification en fonction du contenu
            $response->setEtag(md5($response->getContent()));
        }

        // Validation du cache et mise à jour de la réponse en fonction du cache existant
        if ($response->isNotModified($request)) {
            return $response;
        }

        return $response;
    }

    #[Route(path: '/engagement', name: 'commitment')]
    public function commitment(Request $request): Response
    {
        $response = $this->render('front/home/commitment.html.twig');

        if ($response->getContent()) {
            // Calcul d'un etag ou d'une date de dernière modification en fonction du contenu
            $response->setEtag(md5($response->getContent()));
        }

        // Validation du cache et mise à jour de la réponse en fonction du cache existant
        if ($response->isNotModified($request)) {
            return $response;
        }

        return $response;
    }
}
