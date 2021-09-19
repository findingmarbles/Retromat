<?php

namespace App\Model\Sitemap\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;

class SitemapPopulateSubscriber implements EventSubscriberInterface
{
    public function onPrestaSitemapPopulate(SitemapPopulateEvent $event)
    {
        // @todo implement
    }

    public static function getSubscribedEvents()
    {
        return [
            SitemapPopulateEvent::ON_SITEMAP_POPULATE => 'onPrestaSitemapPopulate',
        ];
    }
}
