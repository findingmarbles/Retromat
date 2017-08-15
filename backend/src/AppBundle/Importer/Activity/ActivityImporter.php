<?php
declare(strict_types=1);

namespace AppBundle\Importer\Activity;

use AppBundle\Entity\Activity;
use AppBundle\Entity\Activity2;
use AppBundle\Entity\Activity2Translation;
use AppBundle\Importer\Activity\Exception\InvalidActivityException;
use AppBundle\Importer\ArrayToObjectMapper;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ActivityImporter
{
    private $objectManager;

    private $reader;

    private $mapper;

    private $validator;

    /**
     * ActivityImporter constructor.
     */
    public function __construct(
        ObjectManager $objectManager,
        ActivityReader $reader,
        ArrayToObjectMapper $mapper,
        ValidatorInterface $validator
    ) {
        $this->objectManager = $objectManager;
        $this->reader = $reader;
        $this->mapper = $mapper;
        $this->validator = $validator;
    }

    public function import(string $locale = 'en')
    {
        // structure we are migrating away from
        // import1 only supports English
        $this->import1();

        // structure we are migrating to
        $this->import2($locale);
    }

    // structure we are migrating away from
    public function import1()
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
            } else {
                $message = " This activity:\n ".(string)$activityFromReader."\n has these validations:\n ".(string)$violations."\n";

                throw new InvalidActivityException($message);
            }
        }

        $this->objectManager->flush();
    }

    // structure we are migrating to
    public function import2(string $locale = 'en')
    {
        $this->reader->setCurrentLocale($locale);
        $activityRepository = $this->objectManager->getRepository('AppBundle:Activity2');

        foreach ($this->reader->extractAllActivities() as $activityArray) {
            $newActivity = new Activity2();
            $newActivity->setDefaultLocale($locale);
            $activityFromReader = $this->mapper->fillObjectFromArray($activityArray, $newActivity);

            $violations = $this->validator->validate($activityFromReader);
            if (0 === count($violations)) {
                $activityFromDb = $activityRepository->findOneBy(['retromatId' => $activityArray['retromatId']]);
                if (isset($activityFromDb)) {
                    $activityFromDb->setDefaultLocale($locale);
                    $this->mapper->fillObjectFromArray($activityArray, $activityFromDb);
                    $activityFromDb->mergeNewTranslations();
                } else {
                    $activityFromReader->mergeNewTranslations();
                    $this->objectManager->persist($activityFromReader);
                }
            } else {
                $message = " This activity:\n ".(string)$activityFromReader."\n has these validations:\n ".(string)$violations."\n";

                throw new InvalidActivityException($message);
            }
        }

        $this->objectManager->flush();
    }
}