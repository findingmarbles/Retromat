<?php

namespace AppBundle\Importer\Activity;

use AppBundle\Entity\Activity;
use AppBundle\Importer\ArrayToObjectMapper;
use AppBundle\Importer\EntityCollectionFilter;

class ActivityImporter
{
    private $reader;

    private $mapper;

    private $filter;

    /**
     * ActivityImporter constructor.
     */
    public function __construct(ActivityReader $reader, ArrayToObjectMapper $mapper, EntityCollectionFilter $filter)
    {
        $this->reader = $reader;
        $this->mapper = $mapper;
        $this->filter = $filter;
    }

    public function import()
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
}