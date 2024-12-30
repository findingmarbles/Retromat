<?php

$_lang['HTML_TITLE'] = 'Inspiracje i plany na Retrospektywy';

$_lang['INDEX_PITCH'] = 'Planujesz kolejną <b>retrospektywę</b> swojego agile-owego zespołu? Zacznij od losowego planu, pozmieniaj go i dostosuj do swojej sytuacji,
a następnie wydrukuj lub udostępnij unikalny adres URL. Albo po prostu przeglądaj dalej, zainspiruj się i stwórz własne pomysły!<br><br>Jeżeli to twoja pierwsza Retrospektywa to <a href="/blog/best-retrospective-for-beginners/">zacznij tutaj!</a>';
$_lang['INDEX_PLAN_ID'] = 'Plan ID:';
$_lang['INDEX_BUTTON_SHOW'] = 'Show!';
$_lang['INDEX_RANDOM_RETRO'] = 'Wylosuj kolejny plan na Retro';
$_lang['INDEX_SEARCH_KEYWORD'] = 'Szukaj po numerze ID lub słowie kluczowym';
$_lang['INDEX_ALL_ACTIVITIES'] = 'All activities for';

$_lang['INDEX_NAVI_WHAT_IS_RETRO'] = '<a href="http://finding-marbles.com/retr-o-mat/what-is-a-retrospective/">Czy jest Retrospektywa?</a>';
$_lang['INDEX_NAVI_ABOUT'] = '<a href="http://finding-marbles.com/retr-o-mat/about-retr-o-mat/">O Retromacie</a>';
$_lang['INDEX_NAVI_PRINT'] = '<a href="/en/print">Wersja drukowana</a>';
$_lang['INDEX_NAVI_ADD_ACTIVITY'] = '<a href="https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ">Dodaj pomysł na aktywość</a>';

if (is_output_format_full_twig($argv)) {
    $_lang['INDEX_ABOUT'] = "{% include 'home/footer/footer.html.twig' %}";
} else {
    $_lang['INDEX_ABOUT'] = 'Retromat zawiera <span class="js_footer_no_of_activities"></span> pomysłów, umożliwiających <span class="js_footer_no_of_combinations"></span> unikalnych kombinacji (<span class="js_footer_no_of_combinations_formula"></span>) i wciąż dodajemy nowe.'; // Masz własny pomysł albo znasz ciekawą grę na Retrospektywę?
}
$_lang['INDEX_ABOUT_SUGGEST'] = 'Prześlij ją do nas';

$_lang['INDEX_TEAM_TRANSLATOR_TITLE'] = 'Tłumaczenie ';
$_lang['INDEX_TEAM_TRANSLATOR_NAME'][0] = 'Jarosław Łojko';
$_lang['INDEX_TEAM_TRANSLATOR_LINK'][0] = 'https://www.linkedin.com/in/jaroslawlojko/';
$_lang['INDEX_TEAM_TRANSLATOR_IMAGE'][0] = '/static/images/team/jaroslaw_lojko.png';
$_lang['INDEX_TEAM_TRANSLATOR_TEXT'][0] = <<<EOT
Jarek to pragmatyczny i wszechstronny Agile Coach z wieloletnim doświadczeniem w różnych branżach. Nigdy nie przestaje się uczyć i rozwijać zarówno siebie jak i tych z którymi pracuje. Autor popularnego bloga <a href="https://agileadept.pl">Agile Adept</a>. 


EOT;

$_lang['INDEX_TEAM_CORINNA_TITLE'] = 'Stworzone przez ';
$_lang['INDEX_TEAM_CORINNA_TEXT'] = $_lang['INDEX_MINI_TEAM'] = <<<EOT
    Gdy Corinna pełniła rolę Scrum Masterki marzyła o narzędziu takim jak Retromat.
    W końcu zdecydowała się, że zbuduje je sama z nadzieją, że może być też przydatne dla innych.
    Masz pytania, sugestie, zachęty?
    Napisz <a href="mailto:corinna@retromat.org">wiadomość</a> lub
    <a href="https://twitter.com/corinnabaldauf">śledź na Twitterze</a>.
    Jeżeli podoba ci się Retromat, możesz także polubbić    <a href="http://finding-marbles.com">Blog Corinny</a> oraz jej materiały na <a href="http://wall-skills.com">Wall-Skills.com</a>.  
EOT;


$_lang['INDEX_TEAM_TIMON_TITLE'] = 'Współautor ';
$_lang['INDEX_TEAM_TIMON_TEXT'] = <<<EOT
Timon prowadzi <a href="/en/team/timon">Szkolenia Scrumowe</a>. Jako Integral Coach i <a href="/en/team/timon">Agile Coach</a> pracuje z kadrą zarządzającą, menedżerami, product ownerami and scrum masterami. Używa Retromatu od 2013, a od 2016 rozwija jego dodatkowe funkcjonalmności. Wyślij <a href="mailto:retromat@fiddike.com">wiadomość do Timona</a> lub
    <a href="https://twitter.com/TimonFiddike">śledź go na Twitterze</a>. Photo © Ina Abraham.
EOT;

$_lang['PRINT_HEADER'] = '(retromat.org)';

$_lang['ACTIVITY_SOURCE'] = 'Źródło:';
$_lang['ACTIVITY_PREV'] = 'Pokaż poprzednią aktywność';
$_lang['ACTIVITY_NEXT'] = 'Pokaż następną aktywność';
$_lang['ACTIVITY_PHOTO_ADD'] = 'Dodaj zdjęcie';
$_lang['ACTIVITY_PHOTO_MAIL_SUBJECT'] = 'Photos%20for%20Activity%3A%20ID';
$_lang['ACTIVITY_PHOTO_MAIL_BODY'] = 'Hi%20Corinna%21%0D%0A%0D%0A[%20]%20Photo%20is%20attached%0D%0A[%20]%20Photo%20is%20online%20at%3A%20%0D%0A%0D%0ABest%2C%0D%0AYour%20Name';
$_lang['ACTIVITY_PHOTO_VIEW_PHOTO'] = 'Pokaż zdjęcie';
$_lang['ACTIVITY_PHOTO_VIEW_PHOTOS'] = 'Pokaż zdjęcia';
$_lang['ACTIVITY_PHOTO_BY'] = 'Autor zdjęcia ';

$_lang['ERROR_MISSING_ACTIVITY'] = 'Przepraszamy, nie możemy znaleźć aktywności o takim numerze ID.';

$_lang['POPUP_CLOSE'] = 'Zamknij';
$_lang['POPUP_IDS_BUTTON'] = 'Pokaż!';
$_lang['POPUP_IDS_INFO']= 'Przykładowe ID: 3-33-20-13-45';
$_lang['POPUP_SEARCH_BUTTON'] = 'Szukaj';
$_lang['POPUP_SEARCH_INFO']= 'Szukaj po tytule, podsumowaniu &amp; opisie';
$_lang['POPUP_SEARCH_NO_RESULTS'] = 'Nie znaleziono';
