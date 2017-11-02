<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Entity\Activity2;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Cache(smaxage="600")
 */
class ActivityController extends FOSRestController implements ClassResourceInterface
{
    public function getAction($id, Request $request)
    {
        $request->setLocale($request->query->get('locale', 'en'));
        /** @var $activity Activity2 */
        $activity = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity2')->find($id);
        $this->get('retromat.activity_source_expander')->expandSource($activity);

        return $this->view($activity, 200)->setContext((new Context())->addGroup('rest'));
    }

    public function cgetAction(Request $request)
    {
        $request->setLocale($request->query->get('locale', 'en'));
        $activities = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity2')->findAllOrdered();
        $localizedActivities = [];
        /** @var $activity Activity2 */
        foreach ($activities as $activity) {
            if (!empty($activity->translate($request->getLocale(), false)->getId())) {
                $this->get('retromat.activity_source_expander')->expandSource($activity);
                $localizedActivities[] = $activity;
            } else {
                break;
            }
        }

        return $this->view($localizedActivities, 200)->setContext((new Context())->addGroup('rest'));
    }
}