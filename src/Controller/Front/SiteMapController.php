<?php

namespace App\Controller\Front;

use App\Service\SiteMapManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SiteMapController extends AbstractController
{
    /**
     * Génère le sitemap du site.
     */
    #[Route('/sitemap.{_format}', name: 'sitemap', requirements: ['_format' => 'xml'])]
    public function siteMap(SiteMapManager $siteMapManager): Response
    {
        return $this->render(
            'front/sitemap/sitemap.xml.twig',
            ['urls' => $siteMapManager->generateUrls()]
        );
    }
}
