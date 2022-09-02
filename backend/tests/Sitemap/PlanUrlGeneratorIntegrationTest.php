<?php

declare(strict_types=1);

namespace App\Tests\Sitemap;

use App\Model\Activity\ActivityByPhase;
use App\Model\Sitemap\PlanUrlGenerator;
use App\Model\Sitemap\PlanIdGenerator;
use PHPUnit\Framework\TestCase;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\Url;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;

class PlanUrlGeneratorIntegrationTest extends TestCase implements UrlContainerInterface, UrlGeneratorInterface
{
    private array $urlContainer;
    private string $baseUrl = 'https://plans-for-retrospectives.com/en/?id=';

    /**
     * @return void
     */
    public function testPopulatePlans(): void
    {
        $activitiesByPhase = [
            0 => [1, 6],
            1 => [2, 7],
            2 => [3],
            3 => [4],
            4 => [5],
        ];
        $activityByPhase = $this
            ->getMockBuilder(ActivityByPhase::class)
            ->setMethods(['getAllActivitiesByPhase'])
            ->disableOriginalConstructor()
            ->getMock();
        $activityByPhase->expects($this->any())
            ->method('getAllActivitiesByPhase')
            ->willReturn($activitiesByPhase);
        $idGenerator = new PlanIdGenerator($activityByPhase);
        $planUrlGenerator = new PlanUrlGenerator($this, $idGenerator);

        $this->urlContainer = [];
        $planUrlGenerator->generatePlanUrls($this);

        $this->assertEquals($this->baseUrl.'1-2-3-4-5', $this->urlContainer[0]->getLoc());
        $this->assertEquals($this->baseUrl.'6-2-3-4-5', $this->urlContainer[1]->getLoc());
        $this->assertEquals($this->baseUrl.'1-7-3-4-5', $this->urlContainer[2]->getLoc());
        $this->assertEquals($this->baseUrl.'6-7-3-4-5', $this->urlContainer[3]->getLoc());
    }

    /**
     * @param Url $url
     * @param string $section
     * @return void
     */
    public function addUrl(Url $url, string $section): void
    {
        $this->urlContainer[] = $url;
    }

    /**
     * @param string $name
     * @param array $parameters
     * @param int $referenceType
     * @return string
     */
    public function generate(string $name, array $parameters = array(), int $referenceType = self::ABSOLUTE_PATH): string
    {
        return $this->baseUrl.$parameters['id'];
    }

    /**
     * @param RequestContext $context
     * @return void
     */
    public function setContext(RequestContext $context): void
    {
    }

    /**
     * @return void
     */
    public function getContext(): void
    {
    }
}
