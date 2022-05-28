<?php

namespace App\Model\Sitemap\Subscriber;

use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

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
