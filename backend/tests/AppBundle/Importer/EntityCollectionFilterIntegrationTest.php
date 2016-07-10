<?php

namespace AppBundle\Importer;

use AppBundle\Entity\Activity;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EntityCollectionFilterIntegrationTest extends WebTestCase
{
    /**
     * @var ValidatorInterface $validator
     */
    private $validator;

    /**
     * @var EntityCollectionFilter $filter
     */
    private $filter;

    /**
     * @var StringLogger $logger
     */
    private $logger;

    public function setUp()
    {
        $this->validator = $this->getContainer()->get('validator');
        $this->logger = new StringLogger();
        $this->filter = new EntityCollectionFilter($this->validator, $this->logger);
    }

    public function testIsValidActivityEmpty()
    {
        $this->assertFalse($this->filter->isValid(new Activity()));
    }

    public function testIsValidActivityFull()
    {
        $this->assertTrue($this->filter->isValid($this->createFullActivity()));
    }

    public function testSkipAndLogInvalidEmptyCollection()
    {
        $this->assertEquals([], $this->filter->skipAndLogInvalid([]));
    }

    public function testSkipAndLogInvalidSingleEmptyIsSkipped()
    {
        $collection = [
            new Activity(),
        ];

        $this->assertEquals([], $this->filter->skipAndLogInvalid($collection));
    }

    public function testSkipAndLogInvalidMultipeEmptyAreSkipped()
    {
        $collection = [
            new Activity(),
            new Activity(),
        ];

        $this->assertEquals([], $this->filter->skipAndLogInvalid($collection));
    }

    public function testSkipAndLogInvalidSingleFullIsAccepted()
    {
        $collection = [
            $this->createFullActivity(),
        ];

        $this->assertEquals($collection, $this->filter->skipAndLogInvalid($collection));
    }

    public function testSkipAndLogInvalidMixOnlyFullIsAccepted()
    {
        $collection = [
            new Activity(),
            new Activity(),
            $this->createFullActivity(),
            new Activity(),
            new Activity(),
        ];

        $this->assertEquals([$this->createFullActivity()], $this->filter->skipAndLogInvalid($collection));
    }


    public function testSkipAndLogInvalidValidationsAreLogged()
    {
        $collection = [
            $this->createFullActivity()->setPhase(-1),
        ];
        $this->assertEquals([], $this->filter->skipAndLogInvalid($collection));
        $log = $this->logger->getLog();
        $violations = substr($log, strrpos($log, 'validations:'));
        $this->assertContains('phase', $violations);
        $this->assertNotContains('summary', $violations);

        $collection = [
            $this->createFullActivity()->setSummary(''),
        ];
        $this->assertEquals([], $this->filter->skipAndLogInvalid($collection));
        $log = $this->logger->getLog();
        $violations = substr($log, strrpos($log, 'validations:'));
        $this->assertContains('summary', $violations);
        $this->assertNotContains('phase', $violations);

        $collection = [
            $this->createFullActivity()->setPhase(-1)->setSummary(''),
        ];
        $this->assertEquals([], $this->filter->skipAndLogInvalid($collection));
        $log = $this->logger->getLog();
        $violations = substr($log, strrpos($log, 'validations:'));
        $this->assertContains('summary', $violations);
        $this->assertContains('phase', $violations);
    }

    /**
     * @return Activity
     */
    public function createFullActivity()
    {
        $activity = new Activity();
        $activity->setRetromatId(122);
        $activity->setLanguage('en');
        $activity->setPhase(1);
        $activity->setName('Find your Focus Principle');
        $activity->setSummary('Discuss the 12 agile principles and pick one to work on');
        $activity->setDesc(
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
        $activity->setSource('"<a href=\'http://www.agilesproduktmanagement.de/\'>Tobias Baier</a>"');
        $activity->setMore('Find your Focus Principle');
        $activity->setDuration('long');
        $activity->setSuitable('iteration, project, release');

        return $activity;
    }
}

class StringLogger
{
    /**
     * @var string $log
     */
    private $log;

    public function log($level, $message)
    {
        $this->log .= $level . ': ' . $message;
    }

    /**
     * @return string
     */
    public function getLog()
    {
        return $this->log;
    }
}