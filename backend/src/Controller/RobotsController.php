<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RobotsController extends AbstractController
{
    /**
     * @Route("/robots.txt", host="retromat.org")
     */
    public function robotsAllow(): Response
    {
        $response = new Response(
            <<<EOT
            User-agent: *
            Disallow:
            Crawl-delay: 1
            
            Sitemap: https://retromat.org/sitemap.xml
            EOT
        );
        $response->headers->set('content-type', 'text/plain; charset=UTF-8');

        return $response;
    }

    /**
     * @Route("/robots.txt")
     */
    public function robotsDisallow(): Response
    {
        $response = new Response(
            <<<EOT
            User-agent: *
            Disallow: /
            EOT
        );
        $response->headers->set('content-type', 'text/plain; charset=UTF-8');

        return $response;
    }
}
