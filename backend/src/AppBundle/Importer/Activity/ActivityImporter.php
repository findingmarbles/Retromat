<?php

namespace AppBundle\Importer\Activity;

use AppBundle\Entity\Activity;
use AppBundle\Importer\ArrayToObjectMapper;
use AppBundle\Importer\EntityCollectionFilter;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ActivityImporter
{
    private $objectManager;

    private $reader;

    private $mapper;

    private $filter;

    private $validator;

    /**
     * ActivityImporter constructor.
     */
    public function __construct(
        ObjectManager $objectManager,
        ActivityReader $reader,
        ArrayToObjectMapper $mapper,
        EntityCollectionFilter $filter,
        ValidatorInterface $validator
    ) {
        $this->objectManager = $objectManager;
        $this->reader = $reader;
        $this->mapper = $mapper;
        $this->filter = $filter;
        $this->validator = $validator;
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

        foreach ($this->reader->extractAllActivities() as $activityArray) {
            $activityFromReader = $this->mapper->fillObjectFromArray($activityArray, new Activity());
            $activityFromReader->setLanguage('en');

            $violations = $this->validator->validate($activityFromReader);
            if (0 === count($violations)) {
                $activityFromDb = $activityRepository->findOneBy(['retromatId' => $activityArray['retromatId']]);
                if (isset($activityFromDb)) {
                    $this->mapper->fillObjectFromArray($activityArray, $activityFromDb);
                } else {
                    $this->objectManager->persist($activityFromReader);
                }
            }
        }

        $this->objectManager->flush();
    }
}