<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Model\Activity\Expander\ActivityExpander;
use App\Model\Activity\Localizer\ActivityLocalizer;
use App\Repository\ActivityRepository;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ActivityApiController extends AbstractFOSRestController
{
    private const SERIALIZER_GROUP = 'api';

    private ActivityLocalizer $activityLocalizer;
    private ActivityExpander $activityExpander;
    private ActivityRepository $activityRepository;

    public function __construct(
        ActivityRepository $activityRepository,
        ActivityExpander $activityExpander,
        ActivityLocalizer $activityLocalizer,
    ) {
        $this->activityLocalizer = $activityLocalizer;
        $this->activityExpander = $activityExpander;
        $this->activityRepository = $activityRepository;
    }

    /**
     * @Rest\Get("/api/activities_{_locale}.json", name="activities", defaults={ "_format" = "json" })
     */
    #[Cache(public: true, maxage: 3600, smaxage: 84600)]
    public function getActivities(Request $request): View
    {
        $locale = $request->getLocale();
        $activities = $this->activityRepository->findAllOrdered();
        $localizedActivities = $this->activityLocalizer->localize($activities, $locale, true);

        $view = $this->view($localizedActivities, Response::HTTP_OK)->setContext((new Context())->addGroup(self::SERIALIZER_GROUP));

        // Write Data to static file
        $response = $this->handleView($view);
        $publicDir = $this->getParameter('kernel.project_dir').'/public';
        $staticDir = $publicDir.'/api';
        if (!is_dir($staticDir)) {
            mkdir($staticDir, 0755, true);
        }
        file_put_contents($staticDir.'/activities_'.$locale.'.json', $response->getContent());

        return $view;
    }

    /**
     * @Rest\Get("/api/activity_{id}_{_locale}.json", name="activity", defaults={ "_format" = "json" })
     */
    #[Cache(public: true, maxage: 3600, smaxage: 84600)]
    public function getActivity(Request $request, string $id): View
    {
        $locale = $request->getLocale();

        /** @var $activity Activity */
        $activity = $this->activityRepository->find($id);

        $this->activityExpander->expandSource($activity);

        $view = $this->view($activity, Response::HTTP_OK)->setContext((new Context())->addGroup(self::SERIALIZER_GROUP));

        // Write HTML to static file
        $response = $this->handleView($view);
        $publicDir = $this->getParameter('kernel.project_dir').'/public';
        $staticDir = $publicDir.'/api';
        if (!is_dir($staticDir)) {
            mkdir($staticDir, 0755, true);
        }
        file_put_contents($staticDir.'/activity_'.$id.'_'.$locale.'.json', $response->getContent());

        return $view;
    }
}
