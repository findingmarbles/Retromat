<?php

namespace App\Model\Sitemap\Subscriber;

use App\Model\Sitemap\ActivityUrlGenerator;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SitemapPopulateSubscriber implements EventSubscriberInterface
{
    private ActivityUrlGenerator $activityUrlGenerator;

    /**
     * @param ActivityUrlGenerator $activityUrlGenerator
     */
    public function __construct(ActivityUrlGenerator $activityUrlGenerator)
    {
        $this->activityUrlGenerator = $activityUrlGenerator;
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    public function onPrestaSitemapPopulate(SitemapPopulateEvent $event): void
    {
        $this->activityUrlGenerator->generateHomeUrls($event->getUrlContainer());
        $this->activityUrlGenerator->generateAllActivityUrls($event->getUrlContainer());
        $this->activityUrlGenerator->generateIndividualActivityUrls($event->getUrlContainer());
        $this->activityUrlGenerator->generateAllPhaseUrls($event->getUrlContainer());
    }

    /**
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            SitemapPopulateEvent::class => 'onPrestaSitemapPopulate',
        ];
    }
}
