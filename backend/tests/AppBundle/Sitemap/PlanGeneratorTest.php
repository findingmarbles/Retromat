<?php

namespace tests\AppBundle\Sitemap;

use AppBundle\Sitemap\PlanGenerator;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Presta\SitemapBundle\Service\UrlContainerInterface;
use Presta\SitemapBundle\Sitemap\Url\Url;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RequestContext;

/*
 * Self shunt pattern as described by Kent Beck: Test class implements interfaces to mock and injects $this
 */
class PlanGeneratorTest extends \PHPUnit_Framework_TestCase implements UrlContainerInterface, UrlGeneratorInterface
{
    private $urlContainer;

    private $baseUrl = 'https://plans-for-retrospectives.com/en/?id=';

    public function testPopulatePlans()
    {
        $planGenerator = new PlanGenerator($this);

        $activitiesByPhase = [
            0 => [1, 6],
            1 => [2, 7],
            2 => [3],
            3 => [4],
            4 => [5],
        ];

        $this->urlContainer = [];
        $planGenerator->populatePlans($this, $activitiesByPhase, 'en');

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