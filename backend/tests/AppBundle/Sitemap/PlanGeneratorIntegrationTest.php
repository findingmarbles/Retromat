<?php
declare(strict_types = 1);

namespace tests\AppBundle\Sitemap;

use AppBundle\Activity\ActivityByPhase;
use AppBundle\Plan\PlanIdGenerator;
use AppBundle\Sitemap\PlanGenerator;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\Url;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;

/*
 * Self shunt pattern as described by Kent Beck: Test class implements interfaces to mock and injects $this
 */

class PlanGeneratorIntegrationTest extends \PHPUnit_Framework_TestCase implements UrlContainerInterface, UrlGeneratorInterface
{
    private $urlContainer;

    private $baseUrl = 'https://plans-for-retrospectives.com/en/?id=';

    public function testPopulatePlans()
    {
        $activitiesByPhase = [
            0 => [1, 6],
            1 => [2, 7],
            2 => [3],
            3 => [4],
            4 => [5],
        ];
        $activitiyByPhase = $this
            ->getMockBuilder(ActivityByPhase::class)
            ->setMethods(['getAllActivitiesByPhase'])
            ->disableOriginalConstructor()
            ->getMock();
        $activitiyByPhase->expects($this->any())
            ->method('getAllActivitiesByPhase')
            ->will($this->returnValue($activitiesByPhase));
        $idGenerator = new PlanIdGenerator($activitiyByPhase);
        $planGenerator = new PlanGenerator($this, $idGenerator);

        $this->urlContainer = [];
        $planGenerator->populatePlans($this);

        $this->assertEquals($this->baseUrl.'1-2-3-4-5', $this->urlContainer[0]->getLoc());
        $this->assertEquals($this->baseUrl.'6-2-3-4-5', $this->urlContainer[1]->getLoc());
        $this->assertEquals($this->baseUrl.'1-7-3-4-5', $this->urlContainer[2]->getLoc());
        $this->assertEquals($this->baseUrl.'6-7-3-4-5', $this->urlContainer[3]->getLoc());
    }

    public function addUrl(Url $url, $section)
    {
        $this->urlContainer[] = $url;
    }

    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        return $this->baseUrl.$parameters['id'];
    }

    public function setContext(RequestContext $context)
    {
    }

    public function getContext()
    {
    }
}