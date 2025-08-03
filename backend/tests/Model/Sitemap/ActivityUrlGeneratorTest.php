<?php

declare(strict_types=1);

namespace App\Tests\Model\Sitemap;

use App\Entity\Activity;
use App\Model\Activity\ActivityByPhase;
use App\Model\Sitemap\ActivityUrlGenerator;
use App\Repository\ActivityRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ActivityUrlGeneratorTest extends TestCase
{
    private MockObject|UrlGeneratorInterface $urlGenerator;
    private MockObject|ActivityRepository $activityRepository;
    private MockObject|ActivityByPhase $activityByPhase;
    private MockObject|UrlContainerInterface $urlContainer;
    private ActivityUrlGenerator $activityUrlGenerator;

    public function setUp(): void
    {
        $this->urlGenerator = $this->createMock(UrlGeneratorInterface::class);
        $this->activityRepository = $this->createMock(ActivityRepository::class);
        $this->activityByPhase = $this->createMock(ActivityByPhase::class);
        $this->urlContainer = $this->createMock(UrlContainerInterface::class);

        $this->activityUrlGenerator = new ActivityUrlGenerator(
            $this->urlGenerator,
            $this->activityRepository,
            $this->activityByPhase
        );
    }

    public function testGenerateHomeUrls(): void
    {
        $locales = ['en', 'de', 'fr', 'es', 'nl'];

        $this->urlGenerator
            ->expects($this->exactly(count($locales)))
            ->method('generate')
            ->with('activities_by_id', $this->anything(), UrlGeneratorInterface::ABSOLUTE_URL)
            ->willReturn('https://example.com/test-url');

        $this->urlContainer
            ->expects($this->exactly(count($locales)))
            ->method('addUrl');

        $this->activityUrlGenerator->generateHomeUrls($this->urlContainer);
    }

    public function testGenerateAllActivityUrls(): void
    {
        $activity1 = $this->createMock(Activity::class);
        $activity1->method('getRetromatId')->willReturn(1);

        $activity2 = $this->createMock(Activity::class);
        $activity2->method('getRetromatId')->willReturn(2);

        $activities = [$activity1, $activity2];

        $this->activityRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($activities);

        $this->urlGenerator
            ->expects($this->once())
            ->method('generate')
            ->with(
                'activities_by_id',
                [
                    'id' => '1-2',
                    'all' => 'yes',
                    '_locale' => 'en',
                ],
                UrlGeneratorInterface::ABSOLUTE_URL
            )
            ->willReturn('https://example.com/all-activities');

        $this->urlContainer
            ->expects($this->once())
            ->method('addUrl');

        $this->activityUrlGenerator->generateAllActivityUrls($this->urlContainer);
    }

    public function testGenerateIndividualActivityUrls(): void
    {
        $activity1 = $this->createMock(Activity::class);
        $activity1->method('getRetromatId')->willReturn(1);

        $activity2 = $this->createMock(Activity::class);
        $activity2->method('getRetromatId')->willReturn(2);

        $activities = [$activity1, $activity2];

        $this->activityRepository
            ->expects($this->once())
            ->method('findAll')
            ->willReturn($activities);

        $this->urlGenerator
            ->expects($this->exactly(2))
            ->method('generate')
            ->withConsecutive(
                [
                    'activities_by_id',
                    ['id' => 1, '_locale' => 'en'],
                    UrlGeneratorInterface::ABSOLUTE_URL,
                ],
                [
                    'activities_by_id',
                    ['id' => 2, '_locale' => 'en'],
                    UrlGeneratorInterface::ABSOLUTE_URL,
                ]
            )
            ->willReturn('https://example.com/activity');

        $this->urlContainer
            ->expects($this->exactly(2))
            ->method('addUrl');

        $this->activityUrlGenerator->generateIndividualActivityUrls($this->urlContainer);
    }

    public function testGenerateAllPhaseUrls(): void
    {
        $this->activityByPhase
            ->expects($this->exactly(6)) // phases 0-5
            ->method('getActivitiesString')
            ->willReturn('1-2-3-4-5');

        $this->urlGenerator
            ->expects($this->exactly(6))
            ->method('generate')
            ->with(
                'activities_by_id',
                $this->callback(function ($params) {
                    return isset($params['id'])
                           && isset($params['phase'])
                           && 'en' === $params['_locale']
                           && in_array($params['phase'], [0, 1, 2, 3, 4, 5]);
                }),
                UrlGeneratorInterface::ABSOLUTE_URL
            )
            ->willReturn('https://example.com/phase');

        $this->urlContainer
            ->expects($this->exactly(6))
            ->method('addUrl');

        $this->activityUrlGenerator->generateAllPhaseUrls($this->urlContainer);
    }

    public function testConstants(): void
    {
        $reflection = new \ReflectionClass(ActivityUrlGenerator::class);
        $constants = $reflection->getConstants();

        $this->assertEquals('en', $constants['DEFAULT_LOCALE']);
        $this->assertEquals(['en', 'de', 'fr', 'es', 'nl'], $constants['LOCALE']);
    }
}
