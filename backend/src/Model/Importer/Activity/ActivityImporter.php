<?php

declare(strict_types=1);

namespace App\Model\Importer\Activity;

use App\Entity\Activity;
use App\Model\Importer\Activity\Exception\InvalidActivityException;
use App\Model\Importer\Activity\Hydrator\ActivityHydrator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ActivityImporter
{
    private EntityManagerInterface $entityManager;

    private ActivityReader $reader;

    private ActivityHydrator $activityHydrator;

    private ValidatorInterface $validator;

    private array $locales;

    /**
     * @param array|string[] $locales
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ActivityReader $reader,
        ActivityHydrator $activityHydrator,
        ValidatorInterface $validator,
        array $locales = ['en'],
    ) {
        $this->entityManager = $entityManager;
        $this->reader = $reader;
        $this->activityHydrator = $activityHydrator;
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
     * @throws InvalidActivityException
     */
    public function import2(string $locale = 'en')
    {
        $this->reader->setCurrentLocale($locale);
        $activityRepository = $this->entityManager->getRepository(Activity::class);

        foreach ($this->reader->extractAllActivities() as $activityArray) {
            $activity = new Activity();
            $activity->setDefaultLocale($locale);
            $activityFromReader = $this->activityHydrator->hydrateFromArray($activityArray, $activity);

            $violations = $this->validator->validate($activityFromReader);
            if (0 === \count($violations)) {
                $activityFromDb = $activityRepository->findOneBy(['retromatId' => $activityArray['retromatId']]);
                if (isset($activityFromDb)) {
                    $activityFromDb->setDefaultLocale($locale);
                    $this->activityHydrator->hydrateFromArray($activityArray, $activityFromDb);
                    $activityFromDb->mergeNewTranslations();
                } else {
                    $activityFromReader->mergeNewTranslations();
                    $this->entityManager->persist($activityFromReader);
                }
            } else {
                $message = " This activity:\n ".(string) $activityFromReader."\n has these validations:\n ".(string) $violations."\n";

                throw new InvalidActivityException($message);
            }
        }

        $this->entityManager->flush();
    }
}
