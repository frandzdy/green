<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Annotation\Route;

#[Cache(maxage: 3600, public: true)]
class BlogController extends AbstractController
{
    public function blogs(
    ): Response {
        return $this->render('front/blog/index.html.twig');
    }
}
