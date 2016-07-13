<?php

namespace tests\AppBundle\Importer;

use AppBundle\Entity\Activity;
use AppBundle\Importer\ArrayToObjectMapper;

class ArrayToObjectMapperIntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function testFillActivityFromArray()
    {
        $inputArray = [
            'retromatId' => 123,
            'language' => 'en',
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
            'more' => 'Find your Focus Principle',
            'duration' => 'long',
            'suitable' => 'iteration, project, release',
        ];

        $entity = new Activity();
        $entity->setRetromatId(123);
        $entity->setLanguage('en');
        $entity->setPhase(1);
        $entity->setName('Find your Focus Principle');
        $entity->setSummary('Discuss the 12 agile principles and pick one to work on');
        $entity->setDesc(
            'Print the <a href=\'http://www.agilemanifesto.org/principles.html\'>principles of the Agile Manifesto</a> \
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
rather choose the second position, why?'
        );
        $entity->setSource('"<a href=\'http://www.agilesproduktmanagement.de/\'>Tobias Baier</a>"');
        $entity->setMore('Find your Focus Principle');
        $entity->setDuration('long');
        $entity->setSuitable('iteration, project, release');

        $activity = new Activity();
        $mapper = new ArrayToObjectMapper();
        $mapper->fillObjectFromArray($inputArray, $activity);

        $this->assertEquals($activity, $entity);
    }
}