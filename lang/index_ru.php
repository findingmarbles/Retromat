<?php

$_lang['HTML_TITLE'] = 'Инспирация, структуры &amp; планы для (аджайл) ретроспектив';

$_lang['INDEX_PITCH'] = 'Планируете вашу следующию аджайл <b>ретроспективу</b>? Начните со случайного плана, адаптируйте его к вашей команде и ситуации, распечатайте его или поделитесь URL вашего плана с другими. Или просто полистайте в поиске новых идей!';
$_lang['INDEX_PLAN_ID'] = 'ID активности';
$_lang['INDEX_BUTTON_SHOW'] = 'Показать';
$_lang['INDEX_RANDOM_RETRO'] = 'Новый случайную активность';
$_lang['INDEX_ENTER_ID'] = 'Напрямую ввести ID';
$_lang['INDEX_SEARCH_KEYWORD'] = 'Поиск в активностях';
$_lang['INDEX_ALL_ACTIVITIES'] = 'Все активности для';
$_lang['INDEX_LOADING'] = '... ЗАГРУЖАЮ АКТИВНОСТИ ...';

$_lang['INDEX_NAVI_WHAT_IS_RETRO'] = '<a href="http://finding-marbles.com/retr-o-mat/what-is-a-retrospective/">Что такое ретроспектива?</a>';
$_lang['INDEX_NAVI_ABOUT'] = '<a href="http://finding-marbles.com/retr-o-mat/about-retr-o-mat/">О Ретромате</a>';
$_lang['INDEX_NAVI_PRINT'] = '<a href="/print/index.html">Печатная версия</a>';
$_lang['INDEX_NAVI_ADD_ACTIVITY'] = '<a href="https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ">Добавить активность</a>';

if (is_output_format_twig($argv)) {
    $_lang['INDEX_ABOUT'] = "{% include 'home/footer/footer.html.twig' %}";
} else {
    $_lang['INDEX_ABOUT'] = 'Ретромат содержит <span class="js_footer_no_of_activities"></span> активности позволяющие <span class="js_footer_no_of_combinations"></span> комбинаций (<span class="js_footer_no_of_combinations_formula"></span>) и мы постоянно добавляем новые.'; // Ты знаешь хорошую активность?
}
$_lang['INDEX_ABOUT_SUGGEST'] = 'Предложи её';

$_lang['INDEX_TEAM_TRANSLATOR_TITLE'] = 'Переводчик 1';
$_lang['INDEX_TEAM_TRANSLATOR_NAME'][0] = 'Антон Скорняков';
$_lang['INDEX_TEAM_TRANSLATOR_LINK'][0] = 'http://skornyakov.info';
$_lang['INDEX_TEAM_TRANSLATOR_IMAGE'][0] = '/static/images/team/antonskornyakov.jpg';
$_lang['INDEX_TEAM_TRANSLATOR_TEXT'][0] = <<<EOT
	Антон работает аджайл коучом и тренером со множеством разных организаций в ИТ и вне ИТ! Пишите ему на <a href="https://twitter.com/antonskornyakov">Twitter</a> или через <a href="https://www.linkedin.com/in/antonskornyakov/">LinkedIn</a>!
	<br><br><br>
EOT;

$_lang['INDEX_TEAM_TRANSLATOR_TITLE'] = 'Переводчик 2';
$_lang['INDEX_TEAM_TRANSLATOR_NAME'][1] = 'Юлиана Степанова;
$_lang['INDEX_TEAM_TRANSLATOR_LINK'][1] = 'https://twitter.com/Yuliana_Step';
$_lang['INDEX_TEAM_TRANSLATOR_IMAGE'][1] = '/static/images/team/yuliana_step';
$_lang['INDEX_TEAM_TRANSLATOR_TEXT'][1] = <<<EOT
	Юлиана работает скрам мастером, я так же является "генератором идей", как на работе, так и в личной жизни. Вы можете связаться с ней через <a href="https://www.linkedin.com/in/yuliana-stepanova-2b99b349/">LinkedIn</a>!.
	<br><br><br>
EOT;

$_lang['INDEX_TEAM_CORINNA_TITLE'] = 'Created by ';
$_lang['INDEX_TEAM_CORINNA_TEXT'] = $_lang['INDEX_MINI_TEAM'] = <<<EOT
    Corinna wished for something like Retromat during her Scrummaster years.
    Eventually she just built it herself in the hope that it would be useful to others, too.
    Any questions, suggestions or encouragement?
    You can <a href="mailto:corinna@finding-marbles.com">email her</a> or
    <a href="https://twitter.com/findingmarbles">follow her on Twitter</a>.
    If you like Retromat you might also like <a href="http://finding-marbles.com">Corinna's blog</a> and her <a href="http://wall-skills.com">summaries on Wall-Skills.com</a>.  
EOT;

$_lang['INDEX_TEAM_TIMON_TITLE'] = 'Co-developed by ';
$_lang['INDEX_TEAM_TIMON_TEXT'] = <<<EOT
As developer, product owner, scrum master and <a href="https://agile.coach/">agile coach</a>, Timon has been a Retromat user and fan for more than three years. He had quite a few feature ideas. In 2016 he started to build some of those features himself. You can <a href="mailto:timon.fiddike@agile.coach">email him</a> or
    <a href="https://twitter.com/TimonFiddike">follow him on Twitter</a>.
EOT;

$_lang['PRINT_HEADER'] = 'by Finding-Marbles.com';

$_lang['ACTIVITY_SOURCE'] = 'Source:';
$_lang['ACTIVITY_PREV'] = 'Show other activity for this phase';
$_lang['ACTIVITY_NEXT'] = 'Show other activity for this phase';
$_lang['ACTIVITY_PHOTO_ADD'] = 'Add Photo';
$_lang['ACTIVITY_PHOTO_MAIL_SUBJECT'] = 'Photos%20for%20Activity%3A%20ID';
$_lang['ACTIVITY_PHOTO_MAIL_BODY'] = 'Hi%20Corinna%21%0D%0A%0D%0A[%20]%20Photo%20is%20attached%0D%0A[%20]%20Photo%20is%20online%20at%3A%20%0D%0A%0D%0ABest%2C%0D%0AYour%20Name';
$_lang['ACTIVITY_PHOTO_VIEW_PHOTO'] = 'View photo';
$_lang['ACTIVITY_PHOTO_VIEW_PHOTOS'] = 'View photos';
$_lang['ACTIVITY_PHOTO_BY'] = 'Photo by ';


$_lang['ERROR_NO_SCRIPT'] = 'Retromat relies heavily on JavaScript and doesn\'t work without it. Please enable JavaScript in your browser. Thanks!';
$_lang['ERROR_MISSING_ACTIVITY'] = 'Sorry, can\'t find activity with ID';

$_lang['POPUP_CLOSE'] = 'Close';
$_lang['POPUP_IDS_BUTTON'] = 'Show!';
$_lang['POPUP_IDS_INFO']= 'Example ID: 3-33-20-13-45';
$_lang['POPUP_SEARCH_BUTTON'] = 'Search';
$_lang['POPUP_SEARCH_INFO']= 'Search titles, summaries &amp; descriptions';
$_lang['POPUP_SEARCH_NO_RESULTS'] = 'Sorry, nothing found for';

?>