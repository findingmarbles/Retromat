<?php

namespace App\Model\Sitemap;

use App\Model\Activity\ActivityByPhase;
use App\Repository\ActivityRepository;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ActivityUrlGenerator
{
    private const DEFAULT_LOCALE = 'en';
    private const LOCALE = ['en', 'de', 'fr', 'es', 'nl'];

    private UrlGeneratorInterface $urlGenerator;
    private ActivityRepository $activityRepository;
    private ActivityByPhase $activityByPhase;

    public function __construct(UrlGeneratorInterface $urlGenerator, ActivityRepository $activityRepository, ActivityByPhase $activityByPhase)
    {
        $this->urlGenerator = $urlGenerator;
        $this->activityRepository = $activityRepository;
        $this->activityByPhase = $activityByPhase;
    }

    public function generateHomeUrls(UrlContainerInterface $urlContainer): void
    {
        foreach (self::LOCALE as $locale) {
            $urlContainer->addUrl(
                new UrlConcrete(
                    $this->urlGenerator->generate(
                        'activities_by_id',
                        ['_locale' => $locale],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    )
                ),
                'home'
            );
        }
    }

    public function generateAllActivityUrls(UrlContainerInterface $urlContainer): void
    {
        $activities = $this->activityRepository->findAll();

        $activityIds = [];
        foreach ($activities as $activity) {
            $activityIds[] = $activity->getRetromatId();
        }

        $urlContainer->addUrl(
            new UrlConcrete(
                $this->urlGenerator->generate(
                    'activities_by_id',
                    [
                        'id' => \implode('-', $activityIds),
                        'all' => 'yes',
                        '_locale' => self::DEFAULT_LOCALE,
                    ],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            ),
            'home'
        );
    }

    public function generateIndividualActivityUrls(UrlContainerInterface $urlContainer): void
    {
        $activities = $this->activityRepository->findAll();

        foreach ($activities as $activity) {
            $urlContainer->addUrl(
                new UrlConcrete(
                    $this->urlGenerator->generate(
                        'activities_by_id',
                        [
                            'id' => $activity->getRetromatId(),
                            '_locale' => self::DEFAULT_LOCALE,
                        ],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    )
                ),
                'activity'
            );
        }
    }

    public function generateAllPhaseUrls(UrlContainerInterface $urlContainer): void
    {
        foreach (\range(0, 5) as $phase) {
            $urlContainer->addUrl(
                new UrlConcrete(
                    $this->urlGenerator->generate(
                        'activities_by_id',
                        [
                            'id' => $this->activityByPhase->getActivitiesString($phase),
                            'phase' => $phase,
                            '_locale' => self::DEFAULT_LOCALE,
                        ],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    )
                ),
                'home'
            );
        }
    }
}
