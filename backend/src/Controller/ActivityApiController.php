<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Model\Activity\ActivitySourceExpander;
use App\Repository\ActivityRepository;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityApiController extends AbstractFOSRestController
{
    private const SERIALIZER_GROUP = 'api';

    private ActivitySourceExpander $activitySourceExpander;
    private ActivityRepository $activityRepository;

    public function __construct(ActivitySourceExpander $activitySourceExpander, ActivityRepository $activityRepository)
    {
        $this->activitySourceExpander = $activitySourceExpander;
        $this->activityRepository = $activityRepository;
    }
    
    /**
     * @Rest\Get("/api/activities", name="activities")
     */
    public function getActivities(Request $request): View
    {
        $request->setLocale($request->query->get('locale', 'en'));

        $activities = $this->activityRepository
            ->findAllOrdered();

        $localizedActivities = [];
        foreach ($activities as $activity) {
            /** @var $activity Activity */
            if (!$activity->translate($request->getLocale(), false)->isEmpty()) {
                $this->activitySourceExpander->expandSource($activity);
                $localizedActivities[] = $activity;
            } else {
                break;
            }
        }

        return $this->view($localizedActivities, Response::HTTP_OK)->setContext((new Context())->addGroup(self::SERIALIZER_GROUP));
    }

    /**
     * @Rest\Get("/api/activity/{id}", name="activity")
     */
    public function getActivity(Request $request, string $id): View
    {
        $request->setLocale($request->query->get('locale', 'en'));

        /** @var $activity Activity */
        $activity = $this->activityRepository->find($id);

        $this->activitySourceExpander->expandSource($activity);

        return $this->view($activity, Response::HTTP_OK)->setContext((new Context())->addGroup(self::SERIALIZER_GROUP));
    }
}
