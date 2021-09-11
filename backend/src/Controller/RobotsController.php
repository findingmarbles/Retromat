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
    public function robotsOpenAction(): Response
    {
        $response = new Response(
            '
User-agent: *
Disallow:
Crawl-delay: 1

Sitemap: https://retromat.org/sitemap.xml'
        );
        $response->headers->set('content-type', 'text/plain; charset=UTF-8');

        return $response;
    }

    /**
     * @Route("/robots.txt")
     */
    public function robotsClosedAction()
    {
        $response = new Response(
            '
User-agent: *
Disallow: /
'
        );
        $response->headers->set('content-type', 'text/plain; charset=UTF-8');

        return $response;
    }
}
