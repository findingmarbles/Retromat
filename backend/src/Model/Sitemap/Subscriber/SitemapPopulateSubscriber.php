<?php

namespace App\Model\Sitemap\Subscriber;

use App\Model\Sitemap\ActivityUrlGenerator;
use App\Model\Sitemap\PlanUrlGenerator;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SitemapPopulateSubscriber implements EventSubscriberInterface
{
    private ActivityUrlGenerator $activityUrlGenerator;
    private PlanUrlGenerator $planUrlGenerator;

    public function __construct(ActivityUrlGenerator $activityUrlGenerator, PlanUrlGenerator $planUrlGenerator)
    {
        $this->activityUrlGenerator = $activityUrlGenerator;
        $this->planUrlGenerator = $planUrlGenerator;
    }

    public function onPrestaSitemapPopulate(SitemapPopulateEvent $event): void
    {
        $this->activityUrlGenerator->generateHomeUrls($event->getUrlContainer());
        $this->activityUrlGenerator->generateAllActivityUrls($event->getUrlContainer());
        $this->activityUrlGenerator->generateIndividualActivityUrls($event->getUrlContainer());
        $this->activityUrlGenerator->generateAllPhaseUrls($event->getUrlContainer());
        $this->planUrlGenerator->generatePlanUrls($event->getUrlContainer());
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
