<?php

namespace tests\AppBundle\Importer\Activity;

use AppBundle\Importer\Activity\OriginalRetromatActivityImporter;

class OriginalRetromatActivityImporterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OriginalRetromatActivityImporter
     */
    private $importer;

    public function setUp ()
    {
        $activityFileName = __DIR__.'/../../../../../lang/activities_en.php';
        $this->importer = new OriginalRetromatActivityImporter($activityFileName);
    }

    public function testExtractActivityBlock()
    {
        $expected = <<<'HTML'
phase:     0,
name:      "ESVP",
summary:   "How do participants feel at the retro: Explorer, Shopper, Vacationer, or Prisoner?",
desc:      "Prepare a flipchart with areas for E, S, V, and P. Explain the concept: <br>\
<ul>\
    <li>Explorer: Eager to dive in and research what did and didn't work and how to improve.</li>\
    <li>Shopper: Positive attitude. Happy if one good things comes out.</li>\
    <li>Vacationer: Reluctant to actively take part but the retro beats the regular work.</li>\
    <li>Prisoner: Only attend because they (feel they) must.</li>\
</ul>\
Take a poll (anonymously on slips of paper). Count out the answers and keep track on the flipchart \
for all to see. If trust is low, deliberately destroy the votes afterwards to ensure privacy. Ask \
what people make of the data. If there's a majority of Vacationers or Prisoners consider using the \
retro to discuss this finding.",
source:  source_agileRetrospectives,
duration:  "5-10 numberPeople",
suitable:   "iteration, release, project, immature"
HTML;
        $this->assertEquals($expected, $this->importer->extractActivityBlock(0));

        $expected = <<<'HTML'
phase:     0,
name:      "Weather Report",
summary:   "Participants mark their 'weather' (mood) on a flipchart",
desc:      "Prepare a flipchart with a drawing of storm, rain, clouds and sunshine.\
Each participant marks their mood on the sheet.",
source:  source_agileRetrospectives,
HTML;
        $this->assertEquals($expected, $this->importer->extractActivityBlock(1));
    }

    public function testExtractActivityPhaseMissing() {
        $activityBlock = <<<'HTML'
name:      "Check In - Quick Question", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Ask one question that each participant answers in turn",
HTML;
        $this->expectException('AppBundle\Importer\Activity\Exception\ActivitySyntaxException');
        $this->importer->extractActivityPhase($activityBlock);
    }


        public function testExtractActivityPhaseNotFirstInBlock() {
            $activityBlock = <<<'HTML'
name:      "Check In - Quick Question", // TODO This can be expanded to at least 10 different variants - how?
phase:     0,
summary:   "Ask one question that each participant answers in turn",
HTML;
            $this->expectException('AppBundle\Importer\Activity\Exception\ActivitySyntaxException');
            $this->importer->extractActivityPhase($activityBlock);
        }

    public function testExtractActivityPhase()
    {
        $activityBlock = <<<'HTML'
phase:     3,
name:      "foo",
summary:   "bar",
HTML;
        $this->assertEquals(3, $this->importer->extractActivityPhase($activityBlock));

        $activityBlock = <<<'HTML'
phase:     0,
name:      "Check In - Quick Question", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Ask one question that each participant answers in turn",
HTML;
        $this->assertEquals(0, $this->importer->extractActivityPhase($activityBlock));
    }

    public function testExtractActivityPhaseWhenPhaseHasJSComment()
    {
        $activityBlock = <<<'HTML'
phase:     4, // 5 geht auch
name:      "SaMoLo (More of, Same of, Less of)",
HTML;
        $this->assertEquals(4, $this->importer->extractActivityPhase($activityBlock));
    }

    public function testExtractActivityName()
    {
        $activityBlock = <<<'HTML'
phase:     0,
name:      "Check In - Amazon Review",
HTML;
        $this->assertEquals('Check In - Amazon Review', $this->importer->extractActivityName($activityBlock));
    }

    public function testExtractActivityNameWhenPhaseHasJSComment()
    {
        $activityBlock = <<<'HTML'
phase:     4, // 5 geht auch
name:      "SaMoLo (More of, Same of, Less of)",
HTML;
        $this->assertEquals('SaMoLo (More of, Same of, Less of)', $this->importer->extractActivityName($activityBlock));
    }

    // this was introduced expecting that it may help unify extractActivityPhase and extractActivityName
    // not used yet, may need to be removed again
    public function testUnquoteIfHasQuotes()
    {
        $this->assertEquals('Foo', $this->importer->unquoteIfHasQuotes('Foo'));
        $this->assertEquals('Foo"', $this->importer->unquoteIfHasQuotes('Foo"'));
        $this->assertEquals('"Foo', $this->importer->unquoteIfHasQuotes('"Foo'));
        $this->assertEquals('Foo', $this->importer->unquoteIfHasQuotes('"Foo"'));
    }
}