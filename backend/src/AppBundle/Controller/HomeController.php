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

    /**
     * @Route("/index_es.html", name="homepage_index_es")
     */
    public function indexEsAction(Request $request)
    {
        return $this->render('home/index_es.html.twig');
    }

    /**
     * @Route("/index_fr.html", name="homepage_index_fr")
     */
    public function indexFrAction(Request $request)
    {
        return $this->render('home/index_fr.html.twig');
    }

    /**
     * @Route("/index_nl.html", name="homepage_index_nl")
     */
    public function indexNlAction(Request $request)
    {
        return $this->render('home/index_nl.html.twig');
    }
}
