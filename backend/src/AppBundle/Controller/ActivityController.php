<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

/**
 * @Cache(smaxage="86400")
 */
class ActivityController extends FOSRestController implements ClassResourceInterface
{
    public function getAction($id)
    {
//      // Keeping working Activity2 based version commented out until it's fast through caching.

        /** @var $activity Activity */
//        $activity = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity2')->find($id);
        $activity = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity')->find($id);
        $activity->setSource($this->expandSource($activity->getSource()));

//        $context = new Context();
//        $context->addGroup('rest');
//        $view = $this->view($activity, 200);
//        $view->setContext($context);
//
//        return $view;

        return new View($activity);
    }

    public function cgetAction()
    {
        $repo = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity');
        $activities = $repo->findAllOrdered('en');
        /** @var $activity Activity */
        foreach ($activities as $activity) {
            $activity->setSource($this->expandSource($activity->getSource()));
        }

        return new View($activities);
    }

    // @todo remove duplication with app/Resources/views/home/activities/activities.html.twig
    private function expandSource(string $source): string
    {
        $sources = $this->getParameter('retromat.activity.source');

        $source = str_replace([' + "', '" + '], '', $source);
        $source = str_replace('"', '', $source);
        $source = str_replace(["='", "'>"], ['="', '">'], $source);
        $source = str_replace(array_keys($sources), $sources, $source);

        return $source;
    }
}