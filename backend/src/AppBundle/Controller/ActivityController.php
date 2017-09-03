<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\Activity;
use AppBundle\Entity\Activity2;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Cache(smaxage="86400")
 */
class ActivityController extends FOSRestController implements ClassResourceInterface
{
    public function getAction($id, Request $request)
    {
        $request->setLocale($request->query->get('locale', 'en'));
        /** @var $activity Activity2 */
        $activity = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity2')->find($id);
        $activity->setSource($this->expandSource($activity->getSource()));

        return $this->view($activity, 200)->setContext((new Context())->addGroup('rest'));
    }

    public function cgetAction(Request $request)
    {
        $request->setLocale($request->query->get('locale', 'en'));
        $activities = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity2')->findAllOrdered();
        /** @var $activity Activity2 */
        foreach ($activities as $activity) {
            $activity->setSource($this->expandSource($activity->getSource()));
        }

        return $this->view($activities, 200)->setContext((new Context())->addGroup('rest'));
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