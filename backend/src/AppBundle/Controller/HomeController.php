<?php
declare(strict_types = 1);

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Plan\Exception\InconsistentInputException;
use AppBundle\Plan\Exception\NoGroupLeftToDrop;

class HomeController extends Controller
{
    /**
     * @Route("/{_locale}/", requirements={"_locale": "en|de|fr|es|nl|pt-br|ru|zh"}, name="activities_by_id")
     * @param Request $request
     * @throws InconsistentInputException
     * @throws NoGroupLeftToDrop
     */
    public function homeAction(Request $request)
    {
        $locale = $request->getLocale();
        $ids = $this->parseIds($request->query->get('id'));
        $phase = $request->query->get('phase');
        $activities = [];
        $title = '';
        $description = '';

        if (0 < count($ids) and ('en' === $locale or 'de' === $locale or 'ru' === $locale)) {
            $repo = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Activity2');
            $activities = $repo->findOrdered($ids);
            if (count($ids) !== count($activities)) {
                throw $this->createNotFoundException();
            }
            foreach ($activities as $activity) {
                $this->get('retromat.activity_source_expander')->expandSource($activity);
            }
            list($title, $description) = $this->planTitleAndDescription($ids, $activities, $locale);
        }

        return $this->render(
            'home/generated/index_'.$locale.'.html.twig',
            [
                'ids' => $ids,
                'phase' => $phase,
                'activities' => $activities,
                'color_variation' => $this->get('retromat.color_varation'),
                'activity_by_phase' => $this->get('retromat.activity_by_phase'),
                'title' => $title,
                'description' => $description,
            ]
        );
    }

    /**
     * @Route("/", defaults={"_locale": "en"}, name="home_slash")
     * @Route("/index.html", defaults={"_locale": "en"}, name="home_index")
     * @Route("/index_{_locale}.html", requirements={"_locale": "en|de|fr|es|nl|pt-br|ru|zh"}, name="home")
     * @param Request $request
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
     * @param array $ids
     * @param array $activities
     * @return array
     * @throws InconsistentInputException
     * @throws NoGroupLeftToDrop
     */
    private function planTitleAndDescription(array $ids, array $activities, string $locale): array
    {
        if ((1 === count($activities)) and (1 === count($ids))) {
            $title = html_entity_decode(
                'Retromat: '.($activities[0])->getName().' (#'.($activities[0])->getRetromatId().')',
                ENT_NOQUOTES
            );
            $description = html_entity_decode(($activities[0])->getSummary(), ENT_NOQUOTES);
        } else {
            // Titles are generated from a separate config, so html_entity_decode is not necessary
            $title = $this->get('retromat.plan.title_chooser')->renderTitle(implode('-', $ids), $locale);
            $description = html_entity_decode(
                $this->get('retromat.plan.description_renderer')->render($activities),
                ENT_NOQUOTES
            );
        }

        return [$title, $description];
    }
}