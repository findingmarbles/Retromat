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
        $activities = $this->activityRepository->findAllOrdered();
        $localizedActivities = $this->activityLocalizer->localize($activities, $request->getLocale(), true);

        $response = $this->view($localizedActivities, Response::HTTP_OK)->setContext((new Context())->addGroup(self::SERIALIZER_GROUP));

        return $response;
    }

    /**
     * @Rest\Get("/api/activity_{id}_{_locale}.json", name="activity", defaults={ "_format" = "json" })
     */
    #[Cache(public: true, maxage: 3600, smaxage: 84600)]
    public function getActivity(Request $request, string $id): View
    {
        /** @var $activity Activity */
        $activity = $this->activityRepository->find($id);

        $this->activityExpander->expandSource($activity);

        $response = $this->view($activity, Response::HTTP_OK)->setContext((new Context())->addGroup(self::SERIALIZER_GROUP));

        return $response;
    }
}
