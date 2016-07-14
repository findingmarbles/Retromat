<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage_slash")
     * @Route("/index.html", name="homepage_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('home/index_en.html.twig');
    }

    /**
     * @Route("/index_de.html", name="homepage_index_de")
     */
    public function indexDeAction(Request $request)
    {
        return $this->render('home/index_de.html.twig');
    }
}
