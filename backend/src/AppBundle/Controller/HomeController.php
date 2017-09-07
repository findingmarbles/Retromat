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
        $ids = $this->parseIds($request->query->get('id'));
        $phase = $request->query->get('phase');
        $activities = [];
        $title = '';
        $description = '';

        if ('en' === $request->getLocale() and 0 < count($ids)) {
            $repo = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity2');
            $activities = $repo->findOrdered($ids);
            if (count($ids) !== count($activities)) {
                throw $this->createNotFoundException();
            }
            list($title, $description) = $this->planTitleAndDescription($ids, $activities);
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

    /**
     * @param $idString
     * @return array
     */
    private function parseIds(string $idString = null): array
    {
        $ids = [];
        if (!empty($idString)) {
            $rawIds = explode('-', $idString);
            foreach ($rawIds as $rawId) {
                $id = (int)$rawId;
                if (0 !== $id and (string)$id === $rawId) {
                    $ids[] = $id;
                } else {
                    throw $this->createNotFoundException();
                }
            }
        }

        return $ids;
    }

    /**
     * @param $ids
     * @param $activities
     * @return array
     */
    private function planTitleAndDescription(array $ids, array $activities): array
    {
        if ((1 === count($activities)) and (1 === count($ids))) {
            $title = ($activities[0])->getName().' (#'.($activities[0])->getRetromatId().')';
            $description = ($activities[0])->getSummary();
        } else {
            $title = $this->get('retromat.plan.title_chooser')->renderTitle(implode('-', $ids));
            $description = $this->get('retromat.plan.description_renderer')->render($activities);
        }

        return [$title, $description];
    }
}