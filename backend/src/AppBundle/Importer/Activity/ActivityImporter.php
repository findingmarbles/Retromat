<?php

namespace AppBundle\Importer\Activity;

use AppBundle\Entity\Activity;
use AppBundle\Importer\ArrayToObjectMapper;
use AppBundle\Importer\EntityCollectionFilter;
use Doctrine\Common\Persistence\ObjectManager;

class ActivityImporter
{
    private $objectManager;

    private $reader;

    private $mapper;

    private $filter;

    /**
     * ActivityImporter constructor.
     */
    public function __construct(ObjectManager $objectManager, ActivityReader $reader, ArrayToObjectMapper $mapper, EntityCollectionFilter $filter)
    {
        $this->objectManager = $objectManager;
        $this->reader = $reader;
        $this->mapper = $mapper;
        $this->filter = $filter;
    }

    public function getAllValidActivities()
    {
        $activity = [];
        foreach ($this->reader->extractAllActivities() as $activityArray) {
            /** @var Activity $activityEntity */
            $activityEntity = $this->mapper->fillObjectFromArray($activityArray, new Activity());
            $activityEntity->setLanguage('en');
            $activity [] = $activityEntity;
        }

        return $this->filter->skipAndLogInvalid($activity);
    }

    public function import()
    {
        $activityRepository = $this->objectManager->getRepository('AppBundle:Activity');

        $activities = [];
        foreach ($this->reader->extractAllActivities() as $activityArray) {
            $activity = $activityRepository->findOneBy(['retromatId' => $activityArray['retromatId']]);
            if (!isset($activity)) {
                $activity = $this->mapper->fillObjectFromArray($activityArray, new Activity());
                $activity->setLanguage('en');
                $this->objectManager->persist($activity);
            } else {
                $activity = $this->mapper->fillObjectFromArray($activityArray, $activity);
            }
            $activities [] = $activity;
        }

        $this->objectManager->flush();
    }
}