<?php

namespace App\Controller;

use App\Model\Activity\ActivityByPhase;
use App\Model\Activity\Expander\ActivityExpander;
use App\Model\Plan\DescriptionRenderer;
use App\Model\Plan\Exception\InconsistentInputException;
use App\Model\Plan\Exception\NoGroupLeftToDrop;
use App\Model\Plan\TitleChooser;
use App\Model\Twig\ColorVariation;
use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private ActivityExpander $activityExpander;
    private ColorVariation $colorVariation;
    private ActivityByPhase $activityByPhase;
    private TitleChooser $titleChooser;
    private DescriptionRenderer $descriptionRenderer;
    private ActivityRepository $activityRepository;

    public function __construct(
        ActivityExpander $activityExpander,
        ColorVariation $colorVariation,
        ActivityByPhase $activityByPhase,
        TitleChooser $titleChooser,
        DescriptionRenderer $descriptionRenderer,
        ActivityRepository $activityRepository
    ) {
        $this->activityExpander = $activityExpander;
        $this->colorVariation = $colorVariation;
        $this->activityByPhase = $activityByPhase;
        $this->titleChooser = $titleChooser;
        $this->descriptionRenderer = $descriptionRenderer;
        $this->activityRepository = $activityRepository;
    }

    /**
     * @Route("/{_locale}/", requirements={"_locale": "en|de|fa|fr|es|ja|nl|pl|pt-br|ru|zh"}, name="activities_by_id")
     * @param Request $request
     * @return Response
     */
    public function homeAction(Request $request)
    {
        $locale = $request->getLocale();
        $ids = $this->parseIds($request->query->get('id'));
        $phase = $request->query->get('phase');
        $activities = [];
        $title = '';
        $description = '';

        if (0 < \count($ids) and ('en' === $locale or 'de' === $locale or 'ru' === $locale)) {
            $activities = $this->activityRepository->findOrdered($ids);
            if (\count($ids) !== \count($activities)) {
                throw $this->createNotFoundException();
            }
            foreach ($activities as $activity) {
                $this->activityExpander->expandSource($activity);
            }
            list($title, $description) = $this->planTitleAndDescription($ids, $activities, $locale);
        }

        return $this->render(
            'home/generated/index_'.$locale.'.html.twig',
            [
                'ids' => $ids,
                'phase' => $phase,
                'activities' => $activities,
                'activityCounts' => $this->activityRepository->countActivities(),
                'color_variation' => $this->colorVariation,
                'activity_by_phase' => $this->activityByPhase,
                'title' => $title,
                'description' => $description,
            ]
        );
    }

    /**
     * @Route("/", defaults={"_locale": "en"}, name="home_slash")
     * @Route("/index.html", defaults={"_locale": "en"}, name="home_index")
     * @Route("/index_{_locale}.html", requirements={"_locale": "en|de|fa|fr|es|ja|nl|pl|pt-br|ru|zh"}, name="home")
     * @param Request $request
     * @return RedirectResponse
     */
    public function redirectAction(Request $request): RedirectResponse
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
            $rawIds = \explode('-', $idString);
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
        if ((1 === \count($activities)) and (1 === \count($ids))) {
            $title = \html_entity_decode(
                'Retromat: '.($activities[0])->getName().' (#'.($activities[0])->getRetromatId().')',
                ENT_NOQUOTES
            );
            $description = \html_entity_decode(($activities[0])->getSummary(), ENT_NOQUOTES);
        } else {
            // Titles are generated from a separate config, so html_entity_decode is not necessary
            $title = $this->titleChooser->renderTitle(\implode('-', $ids), $locale);
            $description = \html_entity_decode(
                $this->descriptionRenderer->render($activities),
                ENT_NOQUOTES
            );
        }

        return [$title, $description];
    }
}
