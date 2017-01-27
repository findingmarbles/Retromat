<?php

namespace AppBundle\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;

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
        $this->populateHome($event);
    }

    /**
     * @param SitemapPopulateEvent $event
     */
    private function populateHome(SitemapPopulateEvent $event)
    {
        foreach (['en', 'de', 'fr', 'es', 'nl'] as $locale) {
            $event->getUrlContainer()->addUrl(
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
}