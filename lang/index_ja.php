<?php

$_lang['HTML_TITLE'] = 'Put Japanese: Inspiration &amp; plans for (agile) retrospectives';

$_lang['INDEX_PITCH'] = 'Put Japanese: Planning your next agile <b>retrospective</b>? Start with a random plan, change it to fit the team\'s situation, print it and share the URL. Or browse around for new ideas!<br><br>Is this your first retrospective? <a href="/blog/best-retrospective-for-beginners/">Start here!</a><br><br>Preparing your first <b>remote</b> retrospective? <a href="/blog/distributed-retrospectives-remote/">This might help.</a>';
$_lang['INDEX_PLAN_ID'] = 'Put Japanese: Plan-ID:';
$_lang['INDEX_BUTTON_SHOW'] = 'Put Japanese: Show!';
$_lang['INDEX_RANDOM_RETRO'] = 'Put Japanese: New random retrospective plan';
$_lang['INDEX_SEARCH_KEYWORD'] = 'Put Japanese: Search activities for ID or keyword';
$_lang['INDEX_ALL_ACTIVITIES'] = 'Put Japanese: All activities for';
$_lang['INDEX_LOADING'] = '... Put Japanese: LOADING ACTIVITIES ...';

$_lang['INDEX_NAVI_WHAT_IS_RETRO'] = 'Put Japanese: <a href="http://finding-marbles.com/retr-o-mat/what-is-a-retrospective/">What\'s a retrospective?</a>';
$_lang['INDEX_NAVI_ABOUT'] = 'Put Japanese: <a href="http://finding-marbles.com/retr-o-mat/about-retr-o-mat/">About Retromat</a>';
$_lang['INDEX_NAVI_PRINT'] = 'Put Japanese: <a href="/en/print">Print Edition</a>';
$_lang['INDEX_NAVI_ADD_ACTIVITY'] = 'Put Japanese: <a href="https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ">Add activity</a>';

if (is_output_format_twig($argv)) {
    $_lang['INDEX_ABOUT'] = "{% include 'home/footer/footer.html.twig' %}";
} else {
    $_lang['INDEX_ABOUT'] = 'Put Japanese: Retromat contains <span class="js_footer_no_of_activities"></span> activities, allowing for <span class="js_footer_no_of_combinations"></span> combinations (<span class="js_footer_no_of_combinations_formula"></span>) and we are constantly adding more.'; // Do you know a great activity?
}
$_lang['INDEX_ABOUT_SUGGEST'] = 'Put Japanese: Suggest it';

//$_lang['INDEX_TEAM_TRANSLATOR_TITLE'] = 'Translation: ';
//$_lang['INDEX_TEAM_TRANSLATOR_NAME'][0] = 'Your Name';
//$_lang['INDEX_TEAM_TRANSLATOR_LINK'][0] = 'Your URL';
//$_lang['INDEX_TEAM_TRANSLATOR_IMAGE'][0] = '/static/images/team/ - send me a picture; will be cut to 70x93px :)';
//$_lang['INDEX_TEAM_TRANSLATOR_TEXT'][0] = <<<EOT
//             Tell us something about you! <a href="https://twitter.com/YourHandle">Twitter</a>!
//EOT;

$_lang['INDEX_TEAM_CORINNA_TITLE'] = 'Put Japanese: Created by ';
$_lang['INDEX_TEAM_CORINNA_TEXT'] = $_lang['INDEX_MINI_TEAM'] = <<<EOT
    Put Japanese:  Corinna wished for something like Retromat during her Scrummaster years.
    Eventually she just built it herself in the hope that it would be useful to others, too.
    Any questions, suggestions or encouragement?
    You can <a href="mailto:corinna@retromat.org">email her</a> or
    <a href="https://twitter.com/corinnabaldauf">follow her on Twitter</a>.
    If you like Retromat you might also like <a href="http://finding-marbles.com">Corinna's blog</a> and her <a href="http://wall-skills.com">summaries on Wall-Skills.com</a>.  
EOT;

$_lang['INDEX_TEAM_TIMON_TITLE'] = 'Put Japanese: Co-developed by ';
$_lang['INDEX_TEAM_TIMON_TEXT'] = <<<EOT
Put Japanese: Timon gives <a href="/en/team/timon">Scrum Trainings</a>. As Integral Coach and <a href="/en/team/timon">Agile Coach</a> he coaches executives, managers, product owners and scrum masters. He has used Retromat since 2013 and started to build new features in 2016. You can <a href="mailto:retromat@fiddike.com">email him</a> or
    <a href="https://twitter.com/TimonFiddike">follow him on Twitter</a>. Photo © Ina Abraham.
EOT;

$_lang['PRINT_HEADER'] = '(retromat.org)';

$_lang['ACTIVITY_SOURCE'] = 'Put Japanese: Source:';
$_lang['ACTIVITY_PREV'] = 'Put Japanese: Show other activity for this phase';
$_lang['ACTIVITY_NEXT'] = 'Put Japanese: Show other activity for this phase';
$_lang['ACTIVITY_PHOTO_ADD'] = 'Add Photo';
$_lang['ACTIVITY_PHOTO_MAIL_SUBJECT'] = 'Photos%20for%20Activity%3A%20ID';
$_lang['ACTIVITY_PHOTO_MAIL_BODY'] = 'Hi%20Corinna%21%0D%0A%0D%0A[%20]%20Photo%20is%20attached%0D%0A[%20]%20Photo%20is%20online%20at%3A%20%0D%0A%0D%0ABest%2C%0D%0AYour%20Name';
$_lang['ACTIVITY_PHOTO_VIEW_PHOTO'] = 'View photo';
$_lang['ACTIVITY_PHOTO_VIEW_PHOTOS'] = 'View photos';
$_lang['ACTIVITY_PHOTO_BY'] = 'Photo by ';


$_lang['ERROR_NO_SCRIPT'] = 'Put Japanese: Retromat relies heavily on JavaScript and doesn\'t work without it. Please enable JavaScript in your browser. Thanks!';
$_lang['ERROR_MISSING_ACTIVITY'] = 'Put Japanese: Sorry, can\'t find activity with ID';

$_lang['POPUP_CLOSE'] = 'Put Japanese: Close';
$_lang['POPUP_IDS_BUTTON'] = 'Put Japanese: Show!';
$_lang['POPUP_IDS_INFO']= 'Put Japanese: Example ID: 3-33-20-13-45';
$_lang['POPUP_SEARCH_BUTTON'] = 'Put Japanese: Search';
$_lang['POPUP_SEARCH_INFO']= 'Put Japanese: Search titles, summaries &amp; descriptions';
$_lang['POPUP_SEARCH_NO_RESULTS'] = 'Put Japanese: Sorry, nothing found for';