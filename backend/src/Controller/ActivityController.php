<?php

namespace App\Controller;

use App\Entity\Activity;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;

class ActivityController extends AbstractFOSRestController
{
    /**
     * @param $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function getAction($id, Request $request)
    {
        $request->setLocale($request->query->get('locale', 'en'));

        $activity = $this->getDoctrine()
            ->getRepository('App:Activity')
            ->find($id);

        $this->get('retromat.activity_source_expander')->expandSource($activity);

        return $this->view($activity, 200)->setContext((new Context())->addGroup('rest'));
    }
}
