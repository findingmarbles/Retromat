<?php

namespace App\Tests\Importer\Activity\Hydrator;

use App\Entity\Activity;
use App\Model\Importer\Activity\Hydrator\ActivityHydrator;
use PHPUnit\Framework\TestCase;

class ActivityHydratorTest extends TestCase
{
    /**
     * @return void
     */
    public function testHydrateEmptyActivity(): void
    {
        $activityHydrator = new ActivityHydrator();
        $inputArray = $this->createInputArray();
        $activity = new Activity();
        $activityHydrator->hydrateFromArray($inputArray, $activity);

        $this->assertEquals($inputArray['phase'], $activity->getPhase());
        $this->assertEquals($inputArray['name'], $activity->getName());
        $this->assertEquals($inputArray['desc'], $activity->getDesc());
        $this->assertEquals($inputArray['source'], $activity->getSource());
        $this->assertEquals($inputArray['more'], $activity->getMore());
        $this->assertEquals($inputArray['duration'], $activity->getDuration());
        $this->assertEquals($inputArray['stage'], $activity->getStage());
        $this->assertEquals($inputArray['suitable'], $activity->getSuitable());
    }

    /**
     * @return void
     */
    public function testHydrateActivity(): void
    {
        $inputArray = $this->createInputArray();
        $exampleActivity = $this->createActivity();

        $activity = new Activity();
        $activityHydrator = new ActivityHydrator();
        $activityHydrator->hydrateFromArray($inputArray, $activity);

        $this->assertEquals($activity, $exampleActivity);
    }

    /**
     * @return Activity
     */
    private function createActivity(): Activity
    {
        $activity = new Activity();
        $activity->setRetromatId(123);
        $activity->setPhase(1);
        $activity->setName('Find your Focus Principle');
        $activity->setSummary('Discuss the 12 agile principles and pick one to work on');
        $activity->setDesc('Print the <a href=\'http://www.agilemanifesto.org/principles.html\'>principles of the Agile Manifesto</a> \
onto cards, one principle \
per card. If the group is large, split it and provide each smaller group with \
their own set of the principles. \
<br><br> \
Explain that you want to order the principles according to the following question: \
\'How much do we need to improve regarding this principle?\'. In the end the \
principle that is the team\'s weakest spot should be on top of the list. \
<br><br> \
Start with a random principle, discuss what it means and how much need for \
improvement you see, then place it in the middle. \
Pick the next principle, discuss what it means and sort it relatively to the other \
principles. You can propose a position depending on the previous discussion and \
move from there by comparison. \
Repeat this until all cards are sorted. \
<br><br> \
Now consider the card on top: This is presumeably the most needed and most urgent \
principle you should work on. How does the team feel about it? Does everyone still \
agree? What are the reasons there is the biggest demand for change here? Should you \
compare to the second or third most important issue again? If someone would now \
rather choose the second position, why?');
        $activity->setSource('"<a href=\'http://www.agilesproduktmanagement.de/\'>Tobias Baier</a>"');
        $activity->setMore('EMPTY_IN_ORIGINAL_ACTIVITY');
        $activity->setDuration('long');
        $activity->setStage('All');
        $activity->setSuitable('iteration, project, release');

        return $activity;
    }

    /**
     * @return array
     */
    private function createInputArray(): array
    {
        $inputArray = [
            'retromatId' => 123,
            'phase' => 1,
            'name' => 'Find your Focus Principle',
            'summary' => 'Discuss the 12 agile principles and pick one to work on',
            'desc' => 'Print the <a href=\'http://www.agilemanifesto.org/principles.html\'>principles of the Agile Manifesto</a> \
onto cards, one principle \
per card. If the group is large, split it and provide each smaller group with \
their own set of the principles. \
<br><br> \
Explain that you want to order the principles according to the following question: \
\'How much do we need to improve regarding this principle?\'. In the end the \
principle that is the team\'s weakest spot should be on top of the list. \
<br><br> \
Start with a random principle, discuss what it means and how much need for \
improvement you see, then place it in the middle. \
Pick the next principle, discuss what it means and sort it relatively to the other \
principles. You can propose a position depending on the previous discussion and \
move from there by comparison. \
Repeat this until all cards are sorted. \
<br><br> \
Now consider the card on top: This is presumeably the most needed and most urgent \
principle you should work on. How does the team feel about it? Does everyone still \
agree? What are the reasons there is the biggest demand for change here? Should you \
compare to the second or third most important issue again? If someone would now \
rather choose the second position, why?',
            'source' => '"<a href=\'http://www.agilesproduktmanagement.de/\'>Tobias Baier</a>"',
            'more' => 'EMPTY_IN_ORIGINAL_ACTIVITY',
            'duration' => 'long',
            'stage' => 'All',
            'suitable' => 'iteration, project, release',
        ];

        return $inputArray;
    }
}
