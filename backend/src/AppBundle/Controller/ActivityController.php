<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;

class ActivityController extends FOSRestController implements ClassResourceInterface
{
    public function getAction($id)
    {
        $repo = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity');
        $activity = $repo->find($id);

        return new View($activity);
    }

    public function cgetAction()
    {
    }
}