<?php
declare(strict_types = 1);

namespace AppBundle\Importer\Activity;

use AppBundle\Entity\Activity2;
use AppBundle\Importer\Activity\Exception\InvalidActivityException;
use AppBundle\Importer\ArrayToObjectMapper;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ActivityImporter
 * @package AppBundle\Importer\Activity
 */
class ActivityImporter
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var ActivityReader
     */
    private $reader;

    /**
     * @var ArrayToObjectMapper
     */
    private $mapper;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var array
     */
    private $locales;

    /**
     * ActivityImporter constructor.
     * @param ObjectManager $objectManager
     * @param ActivityReader $reader
     * @param ArrayToObjectMapper $mapper
     * @param ValidatorInterface $validator
     * @param array $locales
     */
    public function __construct(
        ObjectManager $objectManager,
        ActivityReader $reader,
        ArrayToObjectMapper $mapper,
        ValidatorInterface $validator,
        array $locales = ['en']
    ) {
        $this->objectManager = $objectManager;
        $this->reader = $reader;
        $this->mapper = $mapper;
        $this->validator = $validator;
        $this->locales = $locales;
    }

    /**
     * @throws InvalidActivityException
     */
    public function import()
    {
        $this->import2Multiple($this->locales);
    }

    /**
     * @param array $locales
     * @throws InvalidActivityException
     */
    public function import2Multiple(array $locales = [])
    {
        foreach ($locales as $locale) {
            $this->import2($locale);
        }

        // Re-import English at the end to guarantee that
        // all meta data is used from Enlish translation.
        // Not the most beautiful or efficient soultion,
        // but it runs very rarely and will be deleted
        // as soon as activities live in the database.
        $this->import2('en');
    }

    /**
     * @param string $locale
     * @throws InvalidActivityException
     */
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