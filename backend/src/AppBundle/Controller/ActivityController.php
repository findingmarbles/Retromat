<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;

class ActivityController extends FOSRestController implements ClassResourceInterface
{
    public function getAction($id)
    {
        $repo = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity');
        /** @var $activity Activity */
        $activity = $repo->find($id);

        $source = $activity->getSource();
        $source = str_replace('"', '', $source);
        $source = str_replace("'", '"', $source);
        $activity->setSource($source);

        return new View($activity);
    }

    public function cgetAction()
    {
        $repo = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity');
        $activities = $repo->findOrdered('en', range(1,1000));

        return new View($activities);
    }
}