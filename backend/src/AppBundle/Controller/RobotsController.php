<?php
declare(strict_types = 1);

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class RobotsController extends Controller
{
    /**
     * @Route("/robots.txt", host="plans-for-retrospectives.com")
     */
    public function robotsOpenAction()
    {
        $response = new Response(
            '
User-agent: *
Disallow:
Crawl-delay: 1

Sitemap: https://plans-for-retrospectives.com/sitemap.xml'
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
