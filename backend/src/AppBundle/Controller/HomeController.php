<?php
declare(strict_types=1);

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/{_locale}/", requirements={"_locale": "en|de|fr|es|nl|ru"}, name="activities_by_id")
     */
    public function homeAction(Request $request)
    {
        $ids = [];
        $activities = [];
        $title = '';
        $description = '';
        $phase = $request->query->get('phase');

        if ($request->query->has('id')) {
            $ids = explode('-', $request->query->get('id'));
            if (array_filter($ids) !== $ids) {
                return $this->redirectToRoute(
                    'activities_by_id',
                    ['id' => implode('-', array_filter($ids)), 'phase' => $phase],
                    301
                );
            }
            $repo = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity');
            $activities = $repo->findOrdered($request->getLocale(), $ids);
            if ((1 === count($activities)) and (1 === count($ids))) {
                $title = ($activities[0])->getName() . ' (#' . ($activities[0])->getRetromatId() . ')';
                $description = ($activities[0])->getSummary();
            } else {
                $title = $this->get('retromat.plan.title_chooser')->renderTitle($request->query->get('id'));
                $description = $this->get('retromat.plan.description_renderer')->render($activities);
            }
        }

        return $this->render(
            'home/generated/index_'.$request->getLocale().'.html.twig',
            [
                'ids' => $ids,
                'phase' => $phase,
                'activities' => $activities,
                'color_variation' => $this->get('retromat.color_varation'),
                'activity_by_phase' => $this->get('retromat.activity_by_phase'),
                'activity_source' => $this->getParameter('retromat.activity.source'),
                'title' => $title,
                'description' => $description,
            ]
        );
    }

    /**
     * @Route("/", defaults={"_locale": "en"}, name="home_slash")
     * @Route("/index.html", defaults={"_locale": "en"}, name="home_index")
     * @Route("/index_{_locale}.html", requirements={"_locale": "en|de|fr|es|nl"}, name="home")
     */
    public function redirectAction(Request $request)
    {
        return $this->redirectToRoute(
            'activities_by_id',
            ['id' => $request->query->get('id'), 'phase' => $request->query->get('phase')],
            301
        );
    }
}