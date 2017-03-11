<?php
declare(strict_types = 1);

namespace AppBundle\EventListener;

use AppBundle\Sitemap\PlanGenerator;
use AppBundle\Activity\ActivityByPhase;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use AppBundle\Entity\Activity;

class SitemapPopulateSubscriber implements EventSubscriberInterface
{
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * @var PlanGenerator
     */
    private $planGenerator;

    /**
     * @var ActivityByPhase
     */
    private $activityByPhase;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param ObjectManager $objectManager
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        ObjectManager $objectManager,
        PlanGenerator $planGenerator,
        ActivityByPhase $activityByPhase
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->objectManager = $objectManager;
        $this->planGenerator = $planGenerator;
        $this->activityByPhase = $activityByPhase;
    }

    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            SitemapPopulateEvent::ON_SITEMAP_POPULATE => 'populate',
        ];
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function populate(SitemapPopulateEvent $event)
    {
        /*
         * @var UrlContainerInterface
         */
        $urlContainer = $event->getUrlContainer();

        $this->populateHome($urlContainer);
        $this->populatePhases($urlContainer);
        $this->populateAllActivitiesPage($urlContainer);
        $this->populateIndividualActivities($urlContainer);
        $this->planGenerator->populatePlans($urlContainer);
    }

    /**
     * @param UrlContainerInterface $urlContainer
     */
    private function populateHome(UrlContainerInterface $urlContainer)
    {
        foreach (['en', 'de', 'fr', 'es', 'nl'] as $locale) {
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

    /**
     * @param UrlContainerInterface $urlContainer
     */
    private function populatePhases(UrlContainerInterface $urlContainer)
    {
        $language = 'en';

        foreach (range(0,5) as $phase) {
            $urlContainer->addUrl(
                new UrlConcrete(
                    $this->urlGenerator->generate(
                        'activities_by_id',
                        [
                            'id' => $this->activityByPhase->getActivitiesString($phase),
                            'phase' => $phase,
                            '_locale' => $language,
                        ],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    )
                ),
                'home'
            );
        }
    }

    /**
     * @param UrlContainerInterface $urlContainer
     */
    private function populateAllActivitiesPage(UrlContainerInterface $urlContainer)
    {
        $language = 'en';
        $activities = $this->objectManager->getRepository('AppBundle:Activity')->findBy(['language' => $language]);

        $activityIds = [];
        foreach ($activities as $activity) {
            $activityIds[] = $activity->getRetromatId();
        }

        $urlContainer->addUrl(
            new UrlConcrete(
                $this->urlGenerator->generate(
                    'activities_by_id',
                    [
                        'id' => implode('-', $activityIds),
                        'all' => 'yes',
                        '_locale' => $language,
                    ],
                    UrlGeneratorInterface::ABSOLUTE_URL
                )
            ),
            'home'
        );
    }

    /**
     * @param UrlContainerInterface $urlContainer
     */
    private function populateIndividualActivities(UrlContainerInterface $urlContainer)
    {
        $language = 'en';
        $activities = $this->objectManager->getRepository('AppBundle:Activity')->findBy(['language' => $language]);

        foreach ($activities as $activity) {
            $urlContainer->addUrl(
                new UrlConcrete(
                    $this->urlGenerator->generate(
                        'activities_by_id',
                        [
                            'id' => $activity->getRetromatId(),
                            '_locale' => $language,
                        ],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    )
                ),
                'activity'
            );
        }
    }
}