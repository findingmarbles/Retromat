<?php

$_lang['HTML_TITLE'] = 'Inspiration &amp; plans for (agile) retrospectives';

$_lang['INDEX_PITCH'] = 'アジャイル<b>レトロスペクティブ</b>の計画はありますか？ ランダムに生成されたプランから始めて、チームの状況に合わせて変更し、印刷またはURLを共有しましょう。 あるいは色々見て回って新しいアイデアを探してください！<br><br>初めてのレトロスペクティブの場合は、<a href="/blog/best-retrospective-for-beginners/">ここから始めましょう！</a><br><br><b>リモート</b>でレトロスペクティブを行うのは初めての場合は、<a href="/blog/distributed-retrospectives-remote/">この記事が役立つかもしれません。</a>';
$_lang['INDEX_PLAN_ID'] = 'プランIDの組み合わせ:';
$_lang['INDEX_BUTTON_SHOW'] = '表示！';
$_lang['INDEX_RANDOM_RETRO'] = 'ランダムなプランを生成';
$_lang['INDEX_SEARCH_KEYWORD'] = 'IDまたはキーワードでアクティビティを検索';
$_lang['INDEX_ALL_ACTIVITIES'] = 'すべてのアクティビティ: フェーズ';
$_lang['INDEX_LOADING'] = '... アクティビティを読み込んでいます ...';

$_lang['INDEX_NAVI_WHAT_IS_RETRO'] = '<a href="http://finding-marbles.com/retr-o-mat/what-is-a-retrospective/">レトロスペクティブとは？</a>';
$_lang['INDEX_NAVI_ABOUT'] = '<a href="http://finding-marbles.com/retr-o-mat/about-retr-o-mat/">Retromatについて</a>';
$_lang['INDEX_NAVI_PRINT'] = '<a href="/en/print">印刷版</a>';
$_lang['INDEX_NAVI_ADD_ACTIVITY'] = '<a href="https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ">アクティビティを追加</a>';

if (is_output_format_twig($argv)) {
    $_lang['INDEX_ABOUT'] = "{% include 'home/footer/footer.html.twig' %}";
} else {
    $_lang['INDEX_ABOUT'] = 'Retromatは現在、<span class="js_footer_no_of_activities"></span>のアクティビティがあり、<span class="js_footer_no_of_combinations"></span>通り(<span class="js_footer_no_of_combinations_formula"></span>)の組み合わせがあります。アクティビティは定期的に追加されます。'; // Do you know a great activity?
}
$_lang['INDEX_ABOUT_SUGGEST'] = '提案する';

$_lang['INDEX_TEAM_TRANSLATOR_TITLE'] = '翻訳: ';
$_lang['INDEX_TEAM_TRANSLATOR_NAME'][0] = '武田 智博';
$_lang['INDEX_TEAM_TRANSLATOR_LINK'][0] = 'https://github.com/msiu-takeda/Retromat';
$_lang['INDEX_TEAM_TRANSLATOR_IMAGE'][0] = '/static/images/team/takeda_70_93.jpg';
$_lang['INDEX_TEAM_TRANSLATOR_TEXT'][0] = <<<EOT
ソフトウェア開発で日夜スクラムを実践し、よりよい価値を世の中に届けるため、スクラムマスター、プロダクトオーナーを育成しています。 Retromatでよりよい振り返りにつなげられたなら幸いです。
I practice Scrum in software development everyday and coach Scrum Masters and Product Owners to deliver true user value to the real world. I am glad that Retromat can help you practice better retrospective. Thank you.
EOT;

$_lang['INDEX_TEAM_CORINNA_TITLE'] = 'Created by ';
$_lang['INDEX_TEAM_CORINNA_TEXT'] = $_lang['INDEX_MINI_TEAM'] = <<<EOT
    Corinna自身、スクラムマスターをやっていた頃にRetromatのようなものを欲していました。
    最終的には、「他の人の役に立つ」と思い、彼女自身が作り出しました。
    ご質問、ご提案、励ましの言葉などがありましたら、<a href="mailto:corinna@retromat.org">eメール</a>、または<a href="https://twitter.com/corinnabaldauf">Twitter</a>へお願いします。
    Retromatを気に入った方は、<a href="http://finding-marbles.com">Corinnaのブログ</a>や<a href="http://wall-skills.com">Wall-Skills.comのまとめ</a>もぜひご覧ください。
EOT;

$_lang['INDEX_TEAM_TIMON_TITLE'] = 'Co-developed by ';
$_lang['INDEX_TEAM_TIMON_TEXT'] = <<<EOT
Timonは<a href="/en/team/timon">スクラムトレーナー</a>です。インテグラルコーチ、<a href="/en/team/timon">アジャイルコーチ</a>として、エグゼクティブ、マネージャー、プロダクトオーナー、スクラムマスターを指導しています。2013年からRetromatを使用しており、2016年からは新機能の構築にも携わっています。<a href="mailto:retromat@fiddike.com">eメール</a>、または<a href="https://twitter.com/TimonFiddike">Twitter</a>へどうぞ。Photo © Ina Abraham.
EOT;

$_lang['PRINT_HEADER'] = '(retromat.org)';

$_lang['ACTIVITY_SOURCE'] = '出典:';
$_lang['ACTIVITY_PREV'] = 'このフェーズの他のアクティビティを表示';
$_lang['ACTIVITY_NEXT'] = 'このフェーズの他のアクティビティを表示';
$_lang['ACTIVITY_PHOTO_ADD'] = '写真を追加';
$_lang['ACTIVITY_PHOTO_MAIL_SUBJECT'] = 'Photos%20for%20Activity%3A%20ID';
$_lang['ACTIVITY_PHOTO_MAIL_BODY'] = 'Hi%20Corinna%21%0D%0A%0D%0A[%20]%20Photo%20is%20attached%0D%0A[%20]%20Photo%20is%20online%20at%3A%20%0D%0A%0D%0ABest%2C%0D%0AYour%20Name';
$_lang['ACTIVITY_PHOTO_VIEW_PHOTO'] = '写真を表示';
$_lang['ACTIVITY_PHOTO_VIEW_PHOTOS'] = '写真を表示';
$_lang['ACTIVITY_PHOTO_BY'] = 'Photo by ';


$_lang['ERROR_NO_SCRIPT'] = 'RetromatはJavaScriptを使用しており、ご利用いただくためにはJavaScriptを有効にしていただく必要がございます。';
$_lang['ERROR_MISSING_ACTIVITY'] = '指定のアクティビティは見つかりませんでした。ID';

$_lang['POPUP_CLOSE'] = '閉じる';
$_lang['POPUP_IDS_BUTTON'] = '表示！';
$_lang['POPUP_IDS_INFO']= 'IDの組み合わせ例: 3-33-20-13-45';
$_lang['POPUP_SEARCH_BUTTON'] = '検索する';
$_lang['POPUP_SEARCH_INFO']= 'タイトル、概要、説明で検索';
$_lang['POPUP_SEARCH_NO_RESULTS'] = '見つかりませんでした。';
