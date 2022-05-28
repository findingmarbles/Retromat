<?php

declare(strict_types=1);

namespace App\Model\Importer\Activity;

use App\Entity\Activity;
use App\Model\Importer\Activity\Exception\InvalidActivityException;
use App\Model\Importer\ArrayToObjectMapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ActivityImporter
 * @package App\Importer\Activity
 */
class ActivityImporter
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

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
     * @param EntityManagerInterface $entityManager
     * @param ActivityReader $reader
     * @param ArrayToObjectMapper $mapper
     * @param ValidatorInterface $validator
     * @param array|string[] $locales
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ActivityReader $reader,
        ArrayToObjectMapper $mapper,
        ValidatorInterface $validator,
        array $locales = ['en']
    ) {
        $this->entityManager = $entityManager;
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
        $activityRepository = $this->entityManager->getRepository('App:Activity');

        foreach ($this->reader->extractAllActivities() as $activityArray) {
            $newActivity = new Activity();
            $newActivity->setDefaultLocale($locale);
            $activityFromReader = $this->mapper->fillObjectFromArray($activityArray, $newActivity);

            $violations = $this->validator->validate($activityFromReader);
            if (0 === \count($violations)) {
                $activityFromDb = $activityRepository->findOneBy(['retromatId' => $activityArray['retromatId']]);
                if (isset($activityFromDb)) {
                    $activityFromDb->setDefaultLocale($locale);
                    $this->mapper->fillObjectFromArray($activityArray, $activityFromDb);
                    $activityFromDb->mergeNewTranslations();
                } else {
                    $activityFromReader->mergeNewTranslations();
                    $this->entityManager->persist($activityFromReader);
                }
            } else {
                $message = " This activity:\n ".(string)$activityFromReader."\n has these validations:\n ".(string)$violations."\n";

                throw new InvalidActivityException($message);
            }
        }

        $this->entityManager->flush();
    }
}
