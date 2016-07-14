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
     * @Route("/index_{_locale}.html", requirements={"_locale": "de|fr|es|nl"}, name="homepage_languages")
     */
    public function indexDeAction(Request $request)
    {
        return $this->render('home/index_'.$request->getLocale().'.html.twig');
    }
}
