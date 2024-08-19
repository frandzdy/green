<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Annotation\Route;

#[Cache(maxage: '3600')]
class BlogController extends AbstractController
{
    #[Route('/blogs', name: 'blog', methods: ['GET'])]
    public function blogs(
    ): Response {

        return $this->render('front/blog/index.html.twig');
    }
}
