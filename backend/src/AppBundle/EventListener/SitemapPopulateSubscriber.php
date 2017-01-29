<?php

namespace AppBundle\EventListener;

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
     * @param UrlGeneratorInterface $urlGenerator
     * @param ObjectManager $objectManager
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, ObjectManager $objectManager)
    {
        $this->urlGenerator = $urlGenerator;
        $this->objectManager = $objectManager;
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
        $this->populateActivities($urlContainer);
        // $this->populatePlans($urlContainer);
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
    private function populateActivities(UrlContainerInterface $urlContainer)
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

    /**
     * @param UrlContainerInterface $urlContainer
     */
    private function populatePlans(UrlContainerInterface $urlContainer)
    {
        $language = 'en';
        $activitiesByPhase = $this->objectManager->getRepository('AppBundle:Activity')->findAllActivitiesByPhases();

        $ids = [];
        foreach ($activitiesByPhase[4] as $ids[4]) {
            foreach ($activitiesByPhase[3] as $ids[3]) {
                foreach ($activitiesByPhase[2] as $ids[2]) {
                    foreach ($activitiesByPhase[1] as $ids[1]) {
                        foreach ($activitiesByPhase[0] as $ids[0]) {
                            $urlContainer->addUrl(
                                new UrlConcrete(
                                    $this->urlGenerator->generate(
                                        'activities_by_id',
                                        [
                                            'id' => implode('-', $ids),
                                            '_locale' => $language,
                                        ],
                                        UrlGeneratorInterface::ABSOLUTE_URL
                                    )
                                ),
                                'plan'
                            );
                        }
                    }
                }
            }
        }
    }
}