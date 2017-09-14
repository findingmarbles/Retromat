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
$_lang['INDEX_TEAM_TRANSLATOR_NAME'][1] = 'Юлиана Степанова';
$_lang['INDEX_TEAM_TRANSLATOR_LINK'][1] = 'https://twitter.com/Yuliana_Step';
$_lang['INDEX_TEAM_TRANSLATOR_IMAGE'][1] = '/static/images/team/yuliana_step.jpg';
$_lang['INDEX_TEAM_TRANSLATOR_TEXT'][1] = <<<EOT
	Юлиана работает скрам мастером, я так же является "генератором идей", как на работе, так и в личной жизни. Вы можете связаться с ней через <a href="https://www.linkedin.com/in/yuliana-stepanova-2b99b349/">LinkedIn</a>!.
	<br><br><br>
EOT;

$_lang['INDEX_TEAM_TRANSLATOR_TITLE'] = 'Переводчик 3';
$_lang['INDEX_TEAM_TRANSLATOR_NAME'][2] = 'Александр Мартюшев';
$_lang['INDEX_TEAM_TRANSLATOR_LINK'][2] = 'http://onagile.ru/team/alex-martyushev/';
$_lang['INDEX_TEAM_TRANSLATOR_IMAGE'][2] = '/static/images/team/alex.jpg';
$_lang['INDEX_TEAM_TRANSLATOR_TEXT'][2] = <<<EOT
	Александр работает agile коучем и тренером в компании OnAgile. Связаться с Александром можно по <a href="mailto:alex@onagile.ru?subject=Вопрос по Agile">электронной почте</a>.
	<br><br><br>
EOT;

$_lang['INDEX_TEAM_CORINNA_TITLE'] = 'Создатель';
$_lang['INDEX_TEAM_CORINNA_TEXT'] = $_lang['INDEX_MINI_TEAM'] = <<<EOT
	Когда Корина работала скрам мастером она сама нуждалась в Ретромате.
	В конце концов она сама построила его в надежде на то, что он и другим поможет.
    У вас есть вопросы, предложения или тёплые слова? 
    <a href="mailto:corinna@finding-marbles.com">Пишите ей</a> или
    <a href="https://twitter.com/findingmarbles">читайте её Twitter</a>.
    Если вам нравится Ретромат, вам может понравится <a href="http://finding-marbles.com">блог Коринны</a> и
 	её сайт с <a href="http://wall-skills.com">обзорами и распечатками Wall-Skills.com</a>.
EOT;

$_lang['INDEX_TEAM_TIMON_TITLE'] = 'Ко-создатель';
$_lang['INDEX_TEAM_TIMON_TEXT'] = <<<EOT
Тимон использовал Ретромат на протяжении долгово времени как разработчик, продукт-оунер, скрам мастер и <a href="https://agile.coach/">аджайл коуч</a>. С 2016-ого года он разрабатывает Ретромат вместе с Коринной и вносит много своих идей. Вы можете <a href="mailto:timon.fiddike@agile.coach">написать ему email</a> или <a href="https://twitter.com/TimonFiddike"> читать его на Twitter</a>.
EOT;

$_lang['PRINT_HEADER'] = 'от Finding-Marbles.com';

$_lang['ACTIVITY_SOURCE'] = 'Источник:';
$_lang['ACTIVITY_PREV'] = 'Показать предыдущую активность для этой фазы';
$_lang['ACTIVITY_NEXT'] = 'Показать следующию активность для этой фазы';
$_lang['ACTIVITY_PHOTO_ADD'] = 'Добавить фотографию';
$_lang['ACTIVITY_PHOTO_MAIL_SUBJECT'] = 'Photos%20for%20Activity%3A%20ID';
$_lang['ACTIVITY_PHOTO_MAIL_BODY'] = 'Hi%20Corinna%21%0D%0A%0D%0A[%20]%20Photo%20is%20attached%0D%0A[%20]%20Photo%20is%20online%20at%3A%20%0D%0A%0D%0ABest%2C%0D%0AYour%20Name';
$_lang['ACTIVITY_PHOTO_VIEW_PHOTO'] = 'Посмотреть фотографию';
$_lang['ACTIVITY_PHOTO_VIEW_PHOTOS'] = 'Посмотреть фотографии';
$_lang['ACTIVITY_PHOTO_BY'] = 'Фото от ';


$_lang['ERROR_NO_SCRIPT'] = 'Ретромат работает с Javascript. Пожалуйста активируйте в вашем браузере. Спасибо!';
$_lang['ERROR_MISSING_ACTIVITY'] = 'Извиняюсь, не могу найти такой активности';

$_lang['POPUP_CLOSE'] = 'Закрыть';
$_lang['POPUP_IDS_BUTTON'] = 'Показать!';
$_lang['POPUP_IDS_INFO']= 'Пример ID: 3-33-20-13-45';
$_lang['POPUP_SEARCH_BUTTON'] = 'Поиск';
$_lang['POPUP_SEARCH_INFO']= 'Поиск в названиях и описаниях';
$_lang['POPUP_SEARCH_NO_RESULTS'] = 'Извиняюсь, не могу ничего подходящего найти';

?>