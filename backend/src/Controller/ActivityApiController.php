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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ActivityApiController extends AbstractFOSRestController
{
    private const SERIALIZER_GROUP = 'api';

    private ActivityLocalizer $activityLocalizer;
    private ActivityExpander $activityExpander;
    private ActivityRepository $activityRepository;

    /**
     * @param ActivityRepository $activityRepository
     * @param ActivityExpander $activityExpander
     * @param ActivityLocalizer $activityLocalizer
     */
    public function __construct(
        ActivityRepository $activityRepository,
        ActivityExpander $activityExpander,
        ActivityLocalizer $activityLocalizer
    ) {
        $this->activityLocalizer = $activityLocalizer;
        $this->activityExpander = $activityExpander;
        $this->activityRepository = $activityRepository;
    }

    /**
     * @Rest\Get("/api/activities", name="activities")
     * @param Request $request
     * @return View
     */
    public function getActivities(Request $request): View
    {
        $request->setLocale($request->query->get('locale', 'en'));

        $activities = $this->activityRepository->findAllOrdered();
        $localizedActivities = $this->activityLocalizer->localize($activities, $request->getLocale(), true);

        $response = $this->view($localizedActivities, Response::HTTP_OK)->setContext((new Context())->addGroup(self::SERIALIZER_GROUP));

        // cache for 1 day on CloudFlare edge (can be purged as needed) and 1 hour on Uberspace server
        $response->setHeaders(['Cache-Control' => 'public, s-maxage=84600, max-age=3600']);

        return $response;
    }

    /**
     * @Rest\Get("/api/activity/{id}", name="activity")
     * @param Request $request
     * @param string $id
     * @return View
     */
    public function getActivity(Request $request, string $id): View
    {
        $request->setLocale($request->query->get('locale', 'en'));

        /** @var $activity Activity */
        $activity = $this->activityRepository->find($id);

        $this->activityExpander->expandSource($activity);

        $response = $this->view($activity, Response::HTTP_OK)->setContext((new Context())->addGroup(self::SERIALIZER_GROUP));

        // cache for 1 day on CloudFlare edge (can be purged as needed) and 1 hour on Uberspace server
        $response->setHeaders(['Cache-Control' => 'public, s-maxage=84600, max-age=3600']);

        return $response;
    }
}
