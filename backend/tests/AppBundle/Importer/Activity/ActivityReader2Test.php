<?php
declare(strict_types = 1);

namespace tests\AppBundle\Importer\Activity;

use AppBundle\Importer\Activity\ActivityReader;

class ActivityReader2Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ActivityReader
     */
    private $reader;

    public function setUp()
    {
        $activityFileNames = [
            'en' => __DIR__.'/TestData/activities_en.js',
            'de' => __DIR__.'/TestData/activities_de.js',
        ];

        // signature we are migrating to
        $this->reader = new ActivityReader(null, $activityFileNames, 'en');
    }

    public function testExtractActivity()
    {
        $expected = [
            'retromatId' => 48,
            'phase' => 3,
            'name' => "Take a Stand - Line Dance",
            'summary' => "Get a sense of everyone's position and reach consensus",
            'desc' => "When the team can't decide between two options, create a big scale (i.e. a long line) on the floor with masking tape. Mark one end as option A) and the other as option B). Team members position themselves on the scale according to their preference for either option. Now tweak the options until one option has a clear majority.",
            'source' => 'source_skycoach',
            'more' => "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Original article</a>",
            'duration' => "Short",
            'suitable' => "iteration, release, project",
            'stage' => 'Storming, Norming',
        ];

        $this->assertEquals($expected, $this->reader->extractActivity(48));
    }

    public function testExtractActivityPhaseMissing()
    {
        $this->assertNull($this->reader->extractActivityPhase(''));
    }

    public function testExtractActivityPhaseNotFirstInBlock()
    {
        $activityBlock = <<<'HTML'
name:      "Check In - Quick Question", // TODO This can be expanded to at least 10 different variants - how?
phase:     0,
summary:   "Ask one question that each participant answers in turn",
HTML;

        $this->assertNull($this->reader->extractActivityPhase($activityBlock));
    }

    public function testExtractActivityPhase()
    {
        $activityBlock = <<<'HTML'
phase:     3,
name:      "foo",
summary:   "bar",
HTML;
        $this->assertEquals(3, $this->reader->extractActivityPhase($activityBlock));

        $activityBlock = <<<'HTML'
phase:     0,
name:      "Check In - Quick Question", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Ask one question that each participant answers in turn",
HTML;
        $this->assertEquals(0, $this->reader->extractActivityPhase($activityBlock));
    }

    public function testExtractActivityPhaseWhenPhaseHasJSComment()
    {
        $activityBlock = <<<'HTML'
phase:     4, // 5 geht auch
name:      "SaMoLo (More of, Same of, Less of)",
HTML;
        $this->assertEquals(4, $this->reader->extractActivityPhase($activityBlock));
    }

    public function testExtractActivityName()
    {
        $activityBlock = <<<'HTML'
phase:     0,
name:      "Check In - Amazon Review",
HTML;
        $this->assertEquals('Check In - Amazon Review', $this->reader->extractActivityName($activityBlock));
    }

    public function testExtractActivityNameMissing()
    {
        $this->assertNull($this->reader->extractActivityName(''));
    }

    public function testExtractActivityNameWhenPhaseHasJSComment()
    {
        $activityBlock = <<<'HTML'
phase:     4, // 5 geht auch
name:      "SaMoLo (More of, Same of, Less of)",
HTML;
        $this->assertEquals('SaMoLo (More of, Same of, Less of)', $this->reader->extractActivityName($activityBlock));
    }

    public function testExtractSummary()
    {
        $activityBlock = <<<'HTML'
phase:     0,
name:      "Check In - Quick Question", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Ask one question that each participant answers in turn",
desc:      "In round-robin each participant answers the same question (unless they say 'I pass'). \
Sample questions: <br>\
<ul>\
    <li>In one word - What do you need from this retrospective?</li>\
Address concerns, e.g. by writing it down and setting it - physically and mentally - aside</li>\
    <li>In this retrospective - If you were a car, what kind would it be?</li>\
    <li>What emotional state are you in (e.g. 'glad', 'mad', 'sad', 'scared'?)</li>\
</ul><br>\
Avoid evaluating comments such as 'Great'. 'Thanks' is okay.",
source:  source_agileRetrospectives
HTML;
        $this->assertEquals(
            'Ask one question that each participant answers in turn',
            $this->reader->extractActivitySummary($activityBlock)
        );
    }

    public function testExtractSummaryKeyCanAppearInValue()
    {
        $activityBlock = <<<'HTML'
phase:     0,
name:      "Magic sprint summary: Quick Question",
summary:   "Ask one question that each participant answers in turn",
HTML;
        $this->assertEquals(
            'Ask one question that each participant answers in turn',
            $this->reader->extractActivitySummary($activityBlock)
        );
    }

    public function testExtractActivitySummaryMissing()
    {
        $this->assertNull($this->reader->extractActivitySummary(''));
    }

    public function testExtractDescription()
    {
        $activityBlock = <<<'HTML'
phase:     0,
name:      "Check In - Quick Question", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Ask one question that each participant answers in turn",
desc:      "In round-robin each participant answers the same question (unless they say 'I pass'). \
Sample questions: <br>\
<ul>\
    <li>In one word - What do you need from this retrospective?</li>\
Address concerns, e.g. by writing it down and setting it - physically and mentally - aside</li>\
    <li>In this retrospective - If you were a car, what kind would it be?</li>\
    <li>What emotional state are you in (e.g. 'glad', 'mad', 'sad', 'scared'?)</li>\
</ul><br>\
Avoid evaluating comments such as 'Great'. 'Thanks' is okay.",
source:  source_agileRetrospectives
HTML;

        $expected = <<<'HTML'
In round-robin each participant answers the same question (unless they say 'I pass'). Sample questions: <br><ul>    <li>In one word - What do you need from this retrospective?</li>Address concerns, e.g. by writing it down and setting it - physically and mentally - aside</li>    <li>In this retrospective - If you were a car, what kind would it be?</li>    <li>What emotional state are you in (e.g. 'glad', 'mad', 'sad', 'scared'?)</li></ul><br>Avoid evaluating comments such as 'Great'. 'Thanks' is okay.
HTML;

        $this->assertEquals($expected, $this->reader->extractActivityDescription($activityBlock));
    }

    public function testExtractDescriptionWithHref()
    {
        $activityBlock = <<<'HTML'
summary:   "foo",
desc:      "... <a href='http://www.agilemanifesto.org/principles.html'>principles of the Agile Manifesto</a> ...",
HTML;

        $expected = <<<'HTML'
... <a href="http://www.agilemanifesto.org/principles.html">principles of the Agile Manifesto</a> ...
HTML;

        $this->assertEquals($expected, $this->reader->extractActivityDescription($activityBlock));
    }

    public function testExtractActivityDescriptionMissing()
    {
        $this->assertNull($this->reader->extractActivityDescription(''));
    }

    public function testExtractDuration()
    {
        $activityBlock = <<<'HTML'
phase:     4,
name:      "Appreciations",
summary:   "Let team members appreciate each other and end positively",
desc:      "Start by giving a sincere appreciation of one of the participants. \
It can be anything they contributed: help to the team or you, a solved problem, ...\
Then invite others and wait for someone to work up the nerve. Close, when no one \
has talked for a minute.",
source:    source_agileRetrospectives + " who took it from 'The Satir Model: Family Therapy and Beyond'",
duration:  "5-30 groupsize",
suitable: "iteration, release, project"
HTML;

        $this->assertEquals('5-30 groupsize', $this->reader->extractActivityDuration($activityBlock));
    }

    public function testExtractActivityDurationMissing()
    {
        $this->assertNull($this->reader->extractActivityDuration(''));
    }

    public function testExtractSourcePlaceholderLastLine()
    {
        $activityBlock = <<<'HTML'
phase:     0,
name:      "Temperature Reading",
summary:   "Participants mark their 'temperature' (mood) on a flipchart",
desc:      "Prepare a flipchart with a drawing of a thermometer from freezing to body temperature to hot. \
Each participant marks their mood on the sheet.",
source:  source_unknown,
HTML;

        $this->assertEquals('source_unknown', $this->reader->extractActivitySource($activityBlock));
    }

    public function testExtractSourcePlaceholderLastLineNoComma()
    {
        $activityBlock = <<<'HTML'
phase:     0,
name:      "Check In - Quick Question", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Ask one question that each participant answers in turn",
desc:      "In round-robin each participant answers the same question (unless they say 'I pass'). \
Sample questions: <br>\
<ul>\
    <li>In one word - What do you need from this retrospective?</li>\
Address concerns, e.g. by writing it down and setting it - physically and mentally - aside</li>\
    <li>In this retrospective - If you were a car, what kind would it be?</li>\
    <li>What emotional state are you in (e.g. 'glad', 'mad', 'sad', 'scared'?)</li>\
</ul><br>\
Avoid evaluating comments such as 'Great'. 'Thanks' is okay.",
source:  source_agileRetrospectives
HTML;

        $this->assertEquals('source_agileRetrospectives', $this->reader->extractActivitySource($activityBlock));
    }

    public function testExtractSourceStringAndPlaceholder()
    {
        $activityBlock = <<<'HTML'
phase:     4,
name:      "Feedback Door - Numbers",
summary:   "Gauge participants' satisfaction with the retro on a scale from 1 to 5 in minimum time",
desc:      "Put sticky notes on the door with the numbers 1 through 5 on them. 1 is the topmost and best, \
5 the lowest and worst.\
When ending the retrospective, ask your participants to put a sticky to the number they feel \
reflects the session. The sticky can be empty or have a comment or suggestion on it.",
source:    "ALE 2011, " + source_findingMarbles,
duration:  "2-3",
suitable: "iteration, largeGroups"
HTML;

        $expected = <<<'HTML'
"ALE 2011, " + source_findingMarbles
HTML;

        $this->assertEquals($expected, $this->reader->extractActivitySource($activityBlock));
    }

    public function testExtractSourcePlaceholderAndString()
    {
        $activityBlock = <<<'HTML'
phase:     4,
name:      "Appreciations",
summary:   "Let team members appreciate each other and end positively",
desc:      "Start by giving a sincere appreciation of one of the participants. \
It can be anything they contributed: help to the team or you, a solved problem, ...\
Then invite others and wait for someone to work up the nerve. Close, when no one \
has talked for a minute.",
source:    source_agileRetrospectives + " who took it from 'The Satir Model: Family Therapy and Beyond'",
duration:  "5-30 groupsize",
suitable: "iteration, release, project"
HTML;

        $expected = <<<'HTML'
source_agileRetrospectives + " who took it from 'The Satir Model: Family Therapy and Beyond'"
HTML;

        $this->assertEquals($expected, $this->reader->extractActivitySource($activityBlock));
    }

    public function testExtractSourceString()
    {
        $activityBlock = <<<'HTML'
phase:     4, // 5 geht auch
name:      "SaMoLo (More of, Same of, Less of)",
summary:   "Get course corrections on what you do as a facilitator",
desc:      "Divide a flip chart in 3 sections titled 'More of', 'Same of', and 'Less of'. \
Ask participants to nudge your behaviour into the right direction: Write stickies \
with what you should do more, less and what is exactly right. Read out and briefly \
discuss the stickies section-wise.",
source:    "<a href='http://fairlygoodpractices.com/samolo.htm'>Fairly good practices</a>",
more:      "<a href='http://www.scrumology.net/2010/05/11/samolo-retrospectives/'>David Bland's experiences</a>",
duration:  "5-10",
suitable: "iteration, release, project"
HTML;

        $expected = <<<'HTML'
"<a href='http://fairlygoodpractices.com/samolo.htm'>Fairly good practices</a>"
HTML;

        $this->assertEquals($expected, $this->reader->extractActivitySource($activityBlock));
    }

    public function testExtractSourceKeyCanAppearInValue()
    {
        $activityBlock = <<<'HTML'
phase:     4, // 5 geht auch
name:      "SaMoLo (More of, Same of, Less of)",
summary:   "Get course corrections on what you do as a facilitator",
desc:      "Use the source: This is important for Jedi knights.",
source:    "<a href='http://fairlygoodpractices.com/samolo.htm'>Fairly good practices</a>",
more:      "<a href='http://www.scrumology.net/2010/05/11/samolo-retrospectives/'>David Bland's experiences</a>",
duration:  "5-10",
suitable: "iteration, release, project"
HTML;

        $expected = <<<'HTML'
"<a href='http://fairlygoodpractices.com/samolo.htm'>Fairly good practices</a>"
HTML;

        $this->assertEquals($expected, $this->reader->extractActivitySource($activityBlock));
    }

    public function testExtractActivitySourceMissing()
    {
        $this->assertNull($this->reader->extractActivitySource(''));
    }

    public function testExtractMore()
    {
        $activityBlock = <<<'HTML'
phase:     2,
name:      "Brainstorming / Filtering",
summary:   "Generate lots of ideas and filter them against your criteria",
desc:      "Lay out the rules of brainstorming, and the goal: To generate lots of new ideas \
which will be filtered <em>after</em> the brainstorming.\
<ul>\
    <li>Let people write down their ideas for 5-10 minutes</li>\
    <li>Go around the table repeatedly always asking one idea each, until all ideas are on the flip chart</li>\
    <li>Now ask for filters (e.g. cost, time investment, uniqueness of concept, brand appropriateness, ...). \
Let the group choose 4.</li>\
    <li>Apply each filter and mark ideas that pass all 4.</li>\
    <li>Which ideas will the group carry forward? Does someone feel strongly about one of the ideas?\
Otherwise use majority vote. </li>\
</ul>\
The selected ideas enter Phase 4.",
source:    source_agileRetrospectives,
more:     "<a href='http://www.mpdailyfix.com/the-best-brainstorming-nine-ways-to-be-a-great-brainstorm-lead/'>\
    Nine Ways To Be A Great Brainstorm Lead</a>",
duration:  "40-60",
suitable: "iteration, release, project, introverts"
HTML;

        $expected = <<<'HTML'
<a href='http://www.mpdailyfix.com/the-best-brainstorming-nine-ways-to-be-a-great-brainstorm-lead/'>\
    Nine Ways To Be A Great Brainstorm Lead</a>
HTML;

        $this->assertEquals($expected, $this->reader->extractActivityMore($activityBlock));
    }

    public function testExtractActivityMoreMissing()
    {
        $activityBlock = <<<'HTML'
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

        $this->assertNull($this->reader->extractActivityMore($activityBlock));
    }

    public function testExtractSuitable()
    {
        $activityBlock = <<<'HTML'
phase:     2,
name:      "5 Whys",
summary:   "Drill down to the root cause of problems by repeatedly asking 'Why?'",
desc:      "Divide the participants into small groups (<= 4 people) and give \
each group one of the top identified issues. Instructions for the group:\
<ul>\
    <li>One person asks the others 'Why did that happen?' repeatedly to find the root cause or a chain of events</li>\
    <li>Record the root causes (often the answer to the 5th 'Why?')</li>\
</ul>\
Let the groups share their findings.",
source:    source_agileRetrospectives,
duration:  "15-20",
suitable: "iteration, release, project, root_cause"
HTML;

        $this->assertEquals(
            'iteration, release, project, root_cause',
            $this->reader->extractActivitySuitable($activityBlock)
        );
    }

    public function testExtractActivitySuitableMissing()
    {
        $this->assertNull($this->reader->extractActivitySuitable(''));
    }

    public function testExtractStage()
    {
        $activityBlock = <<<'HTML'
phase:     2,
name:      "5 Whys",
summary:   "Drill down to the root cause of problems by repeatedly asking 'Why?'",
desc:      "Divide the participants into small groups (<= 4 people) and give \
each group one of the top identified issues. Instructions for the group:\
<ul>\
    <li>One person asks the others 'Why did that happen?' repeatedly to find the root cause or a chain of events</li>\
    <li>Record the root causes (often the answer to the 5th 'Why?')</li>\
</ul>\
Let the groups share their findings.",
source:    source_agileRetrospectives,
duration:  "15-20",
stage:    "All",
suitable: "iteration, release, project, root_cause"
HTML;

        $this->assertEquals(
            'All',
            $this->reader->extractActivityStage($activityBlock)
        );
    }

    public function testHighestActivityNumber()
    {
        $activityFileName = __DIR__.'/TestData/activities_en_reduced_example.js';
        $reader = new ActivityReader($activityFileName);

        $this->assertEquals(123, $reader->highestRetromatId());
    }

    public function testExtractAllActivitiesEn()
    {
        $activity = $this->reader->extractAllActivities();

        $this->assertEquals('ESVP', $activity[1]['name']);
        $this->assertEquals('Positive and True', $activity[122]['name']);
        $this->assertEquals('Discuss the 12 agile principles and pick one to work on', $activity[123]['summary']);

        $expected = [
            'retromatId' => 123,
            'phase' => 1,
            'name' => 'Find your Focus Principle',
            'summary' => 'Discuss the 12 agile principles and pick one to work on',
            'desc' => 'Print the <a href="http://www.agilemanifesto.org/principles.html">principles of the Agile Manifesto</a> onto cards, one principle per card. If the group is large, split it and provide each smaller group with their own set of the principles. <br><br> Explain that you want to order the principles according to the following question: \'How much do we need to improve regarding this principle?\'. In the end the principle that is the team\'s weakest spot should be on top of the list. <br><br> Start with a random principle, discuss what it means and how much need for improvement you see, then place it in the middle. Pick the next principle, discuss what it means and sort it relatively to the other principles. You can propose a position depending on the previous discussion and move from there by comparison. Repeat this until all cards are sorted. <br><br> Now consider the card on top: This is presumeably the most needed and most urgent principle you should work on. How does the team feel about it? Does everyone still agree? What are the reasons there is the biggest demand for change here? Should you compare to the second or third most important issue again? If someone would now rather choose the second position, why?',
            'source' => '"<a href=\'http://www.agilesproduktmanagement.de/\'>Tobias Baier</a>"',
            'more' => null,
            'duration' => 'Long',
            'suitable' => 'iteration, project, release',
            'stage' => 'Forming, Storming, Stagnating',
        ];
        $this->assertEquals($expected, $activity[123]);
    }

    public function testExtractAllActivitiesDe()
    {
        $this->reader->setCurrentLocale('de');
        $activity = $this->reader->extractAllActivities();

        $this->assertEquals('FEUG (engl. ESVP)', $activity[1]['name']);
        $this->assertEquals('Schreibe das Unaussprechliche', $activity[75]['name']);
        $this->assertEquals('Schreibe auf was Du niemals sagen könntest', $activity[75]['summary']);

        $expected = [
            'retromatId' => 75,
            'phase' => 1,
            'name' => 'Schreibe das Unaussprechliche',
            'summary' => 'Schreibe auf was Du niemals sagen könntest',
            'desc' => "Vermutest Du, das es im Team unausgesprochene Tabus gibt, die die Zusammenarbeit behindern? Vielleicht hilft diese Methode: Verpflichte alle zu Vertraulichkeit ('Alles was gesagt wird bleibt hier im Raum') und sage an, dass alle Notizen am Ende zerstört werden. Erst dann gebe ein Blatt Papier an jeden Teilnehmer aus, um das größte Tabu im Team bzw. im Unternehmen zu notieren. Wenn alle fertig sind, geben alle das Blatt an den linken Nachbarn weiter. Die Nachbarn lesen und können Kommentare hinzufügen. Lasse die Seiten solange weitergegeben, bis sie zu ihren Autoren zurückgekehrt sind. Jeder liest noch einmal durch. Dann werden alle Blätter feierlich zerkleinert oder verbrannt (wenn Sie draußen sind).",
            'source' => '"Unknown, via Vanessa"',
            'more' => null,
            'duration' => 'Short',
            'suitable' => 'iteration, project, release',
            'stage' => 'Storming, Stagnating',
        ];
        $this->assertEquals($expected, $activity[75]);
    }
}