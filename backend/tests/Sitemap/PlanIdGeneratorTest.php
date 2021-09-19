<?php
declare(strict_types = 1);

namespace App\Tests\Sitemap;

use App\Model\Sitemap\PlanIdGenerator;
use App\Model\Activity\ActivityByPhase;
use PHPUnit\Framework\TestCase;

class PlanIdGeneratorTest extends TestCase
{
    /**
     * @var array
     */
    private $ids = [];

    /**
     * @var PlanIdGenerator
     */
    private $planIdGenerator;

    public function setUp(): void
    {
        $this->ids = [];

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
        $this->planIdGenerator = new PlanIdGenerator($activitiyByPhase);
    }

    public function testGenerateAll()
    {
        $this->planIdGenerator->generate([$this, 'collect']);

        $this->assertEquals('1-2-3-4-5', $this->ids[0]);
        $this->assertEquals('6-2-3-4-5', $this->ids[1]);
        $this->assertEquals('1-7-3-4-5', $this->ids[2]);
        $this->assertEquals('6-7-3-4-5', $this->ids[3]);
    }

    public function testGenerateMaxResults()
    {
        $maxResults = 2;

        $this->planIdGenerator->generate([$this, 'collect'], $maxResults);

        $this->assertCount($maxResults, $this->ids);
        $this->assertEquals('1-2-3-4-5', $this->ids[0]);
        $this->assertEquals('6-2-3-4-5', $this->ids[1]);
    }

    public function testGenerateSkip0()
    {
        $skip = 0;
        $maxResults = 2;

        $this->planIdGenerator->generate([$this, 'collect'], $maxResults, $skip);

        $this->assertCount($maxResults, $this->ids);
        $this->assertEquals('1-2-3-4-5', $this->ids[0]);
        $this->assertEquals('6-2-3-4-5', $this->ids[1]);
    }

    public function testGenerateSkip1()
    {
        $skip = 1;
        $maxResults = 2;

        $this->planIdGenerator->generate([$this, 'collect'], $maxResults, $skip);

        $this->assertEquals('6-2-3-4-5', $this->ids[0]);
        $this->assertEquals('1-7-3-4-5', $this->ids[1]);
        $this->assertCount($maxResults, $this->ids);
    }

    public function testGenerateSkip2()
    {
        $skip = 2;
        $maxResults = 1;

        $this->planIdGenerator->generate([$this, 'collect'], $maxResults, $skip);

        $this->assertEquals('1-7-3-4-5', $this->ids[0]);
        $this->assertCount($maxResults, $this->ids);
    }

    /**
     * @param string $id
     */
    public function collect(string $id)
    {
        $this->ids[] = $id;
    }
}
