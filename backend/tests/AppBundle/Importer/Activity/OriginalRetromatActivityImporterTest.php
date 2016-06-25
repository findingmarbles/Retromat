<?php

namespace tests\AppBundle\Importer\Activity;

use AppBundle\Importer\Activity\OriginalRetromatActivityImporter;

class OriginalRetromatActivityImporterTest extends \PHPUnit_Framework_TestCase
{
    public function testExtractActivityString()
    {
        $activityFileName = __DIR__.'/../../../../../lang/activities_en.php';

        $importer = new OriginalRetromatActivityImporter($activityFileName);

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
        $this->assertEquals($expected, $importer->extractActivityString(0));

        $expected = <<<'HTML'
phase:     0,
name:      "Weather Report",
summary:   "Participants mark their 'weather' (mood) on a flipchart",
desc:      "Prepare a flipchart with a drawing of storm, rain, clouds and sunshine.\
Each participant marks their mood on the sheet.",
source:  source_agileRetrospectives,
HTML;
        $this->assertEquals($expected, $importer->extractActivityString(1));
    }
}
