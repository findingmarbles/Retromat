<?php

namespace App\Model\Sitemap\Subscriber;

use App\Model\Sitemap\ActivityUrlGenerator;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SitemapPopulateSubscriber implements EventSubscriberInterface
{
    private ActivityUrlGenerator $activityUrlGenerator;

    public function __construct(ActivityUrlGenerator $activityUrlGenerator)
    {
        $this->activityUrlGenerator = $activityUrlGenerator;
    }

    public function onPrestaSitemapPopulate(SitemapPopulateEvent $event): void
    {
        $this->activityUrlGenerator->generateHomeUrls($event->getUrlContainer());
        // $this->activityUrlGenerator->generateAllActivityUrls($event->getUrlContainer());
        // $this->activityUrlGenerator->generateIndividualActivityUrls($event->getUrlContainer());
        // $this->activityUrlGenerator->generateAllPhaseUrls($event->getUrlContainer());
        // $this->planUrlGenerator->generatePlanUrls($event->getUrlContainer());
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
