<?php

declare(strict_types=1);

namespace App\Tests\Model\Sitemap\Subscriber;

use App\Model\Sitemap\ActivityUrlGenerator;
use App\Model\Sitemap\Subscriber\SitemapPopulateSubscriber;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SitemapPopulateSubscriberTest extends TestCase
{
    private MockObject|ActivityUrlGenerator $activityUrlGenerator;
    private SitemapPopulateSubscriber $subscriber;

    public function setUp(): void
    {
        $this->activityUrlGenerator = $this->createMock(ActivityUrlGenerator::class);

        $this->subscriber = new SitemapPopulateSubscriber(
            $this->activityUrlGenerator
        );
    }

    public function testImplementsEventSubscriberInterface(): void
    {
        $this->assertInstanceOf(EventSubscriberInterface::class, $this->subscriber);
    }

    public function testGetSubscribedEvents(): void
    {
        $subscribedEvents = SitemapPopulateSubscriber::getSubscribedEvents();

        $this->assertArrayHasKey(SitemapPopulateEvent::class, $subscribedEvents);
        $this->assertEquals('onPrestaSitemapPopulate', $subscribedEvents[SitemapPopulateEvent::class]);
    }

    public function testOnPrestaSitemapPopulate(): void
    {
        $event = $this->createMock(SitemapPopulateEvent::class);
        $urlContainer = $this->createMock(UrlContainerInterface::class);

        $event
            ->expects($this->once()) // Called once for generateHomeUrls
            ->method('getUrlContainer')
            ->willReturn($urlContainer);

        $this->activityUrlGenerator
            ->expects($this->once())
            ->method('generateHomeUrls')
            ->with($urlContainer);


        $this->subscriber->onPrestaSitemapPopulate($event);
    }

    public function testConstructor(): void
    {
        $subscriber = new SitemapPopulateSubscriber(
            $this->activityUrlGenerator
        );

        $this->assertInstanceOf(SitemapPopulateSubscriber::class, $subscriber);
    }
}
