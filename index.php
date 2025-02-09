<?php
if (empty($lang = $argv[1])) exit(
    PHP_EOL . $argv[0] . ' needs to be executed with specific parameters from index_deploy-from-php-to-twig.sh to produce TWIG templates which then produce HTML.' .
    PHP_EOL . 'In development, you may run "sh index_deploy-from-php-to-twig.sh" manually.' .
    PHP_EOL . 'On our live space it is triggered from: backend/bin/cordelia/deploy.sh' . PHP_EOL . PHP_EOL
);

require 'lang/index_' . $lang . '.php';
?>
<!DOCTYPE html>
<html lang="{{ app.request.locale }}">
<head>
    {% if title is not empty %}
        <title>{{ title|raw }}</title>
    {% else %}
        <title>Retromat - <?php echo($_lang['HTML_TITLE']); ?></title>
    {% endif %}
    {% if description is not empty %}
        <meta name="description" content="{{ description|raw }}">
    {% endif %}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1"> 

    <link rel="stylesheet" type="text/css" href="/static/retromat.css?v=2" />

<link rel="shortcut icon" href="/static/images/favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="/static/images/apple-touch-icon.png" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/static/jquery.min.js"><\/script>')</script>

<script src="/static/lightbox/lightbox.js"></script>
<link href="/static/lightbox/lightbox.css" rel="stylesheet" />

<!-- Detect IE9 - It has problems, probably because of history.pushState -->
<script>
    var is_ie = false;
</script>
<!--[if lt IE 10 ]>
<script>
    var is_ie = true;
</script>
<![endif]-->

<script type="text/javascript">
// CONFIG
var NUMBER_OF_REGULAR_PHASES = 5;
var PHASE_SOMETHING_DIFFERENT = 5;
var INVERTED_CHANCE_OF_SOMETHING_DIFFERENT = 25; // Probability to show "different" phase is 1:INVERTED_CHANCE
var PHASE_ID_TAG = 'phase';
</script>

<script src="/static/lang/phase_titles_{{ app.request.locale }}.js"></script>
<script src="/static/lang/photos.js"></script>
<script src="/static/functions.js"></script>

    <script type="text/javascript">
        // Functions that need translations from PHP.
        // @todo save bandwidth by moving these functions to functions.js,
        // which is cached by browsers and crawlers.

        //Input: String
        function publish_plan(plan_id, phase) {
            var plan_id = sanitize_plan_id(plan_id);
            if (plan_id) {
                empty_plan();
                publish_activity_blocks(plan_id);
                enable_phase_browsing();

                if (phase != undefined) {
                    publish_plan_title("<?php echo($_lang['INDEX_ALL_ACTIVITIES']); ?> " + phase_titles[phase].toUpperCase());
                    hide_phase_stepper();
                } else {
                    show_phase_stepper();
                    hide_plan_title();
                }
                publish_plan_id(plan_id);
            }
        }

        function get_activity_array(index) {
            var activity_array = all_activities[index];
            if (activity_array == null) {
                alert("<?php echo($_lang['ERROR_MISSING_ACTIVITY']); ?> " + convert_index_to_id(index));
            }
            return activity_array;
        }

        /* Param: activity index
         * Returns: String (empty or link to photo(s))
         */
        function get_photo_string(index) {
            res = "";
            if (all_photos[index] != null) {
                for (var i = 0; i < all_photos[index].length; i++) {
                    res += "<a href='";
                    res += all_photos[index][i]['filename'];
                    res += "' rel='lightbox[activity" + index + "]' ";
                    res += "title='<?php echo($_lang['ACTIVITY_PHOTO_BY']); ?>";
                    res += all_photos[index][i]['contributor'];
                    res += "'>";
                    if (i == 0) {
                        if (all_photos[index].length < 2) {
                            res += "<?php echo($_lang['ACTIVITY_PHOTO_VIEW_PHOTO']); ?>";
                        } else {
                            res += "<?php echo($_lang['ACTIVITY_PHOTO_VIEW_PHOTOS']); ?>";
                        }
                    }
                    res += "</a>";
                }
                //        res += " | "; PAUSED Until I've got more time
            }
            return res;
        }

        /************ BEGIN Footer Functions ************/
        function create_link_to_all_activities(number_of_activities) {
            var link_string = "<a href='?id=1";
            for (i = 2; i <= number_of_activities; i++) {
                link_string += "-" + i;
            }
            return link_string + "&all=yes'>" + number_of_activities + "</a>";
        }
        /************ END Footer Functions ************/

        /************ BEGIN PopUps Plan Navigation (Search) ************/
        function publish_activities_for_keywords(keywords) {
            var keywords_array = keywords.split(' ');
            var plan_id = '';
            for (var i = 0; i < keywords_array.length; i++) {
                var sub_ids = search_activities_for_keyword(keywords_array[i]);
                if (sub_ids.length > 0) {
                    plan_id += sub_ids + '-';
                }
            }
            plan_id = plan_id.substr(0, plan_id.length - 1); // Remove trailing '-'

            plan_id += find_ids_in_keyword(keywords);

            var text = '<?php echo($_lang["INDEX_ALL_ACTIVITIES"]) ?>';
            if (plan_id != '') {
                publish_plan(plan_id);
                hide_phase_stepper();
                hide_popup('search');
            } else {
                publish_plan_id(plan_id);
                empty_plan();
                text = '<?php echo($_lang["POPUP_SEARCH_NO_RESULTS"]) ?>';
            }
            publish_plan_title(text + " '" + keywords + "'"); // Call must be after "publish_plan()" or plan_title_container won't be displayed
        }
        /************ END PopUps Plan Navigation ************/

        /************ BEGIN Newsletter Subscribe ************/
    
        var default_value = 'Your email address';

        function removeDefaultText(){
            var email_field = document.getElementById("email_address");
            if(email_field.value == default_value){
                email_field.value = "";
            }
        }

        function setDefaultText(){
            var email_field = document.getElementById("email_address");
            if(email_field.value == ''){
                email_field.value = default_value;
            }
        }

        /************ END Newsletter Subscribe ************/

    </script>

<link rel="alternate" hreflang="en" href="/en/" />
<link rel="alternate" hreflang="es" href="/es/" />
<link rel="alternate" hreflang="fr" href="/fr/" />
<link rel="alternate" hreflang="de" href="/de/" />
<link rel="alternate" hreflang="nl" href="/nl/" />
<link rel="alternate" hreflang="pl" href="/pl/" />
<link rel="alternate" hreflang="ru" href="/ru/" />
<link rel="alternate" hreflang="zh" href="/zh/" />
<link rel="alternate" hreflang="ja" href="/ja/" />

<!-- Matomo -->
<script type="text/javascript">
    var _paq = _paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u="//retromat.org/piwik/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '3']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
</script>
<!-- End Matomo Code -->
</head>

<body onload="JavaScript:init()">

    <div class="header">
        <div class="header__leftblock">
            <div class="header__logo">
                <a href="/{{ app.request.locale }}/" class="header__logo">
                    <img src="/static/images/retromat-logo.svg"
                     alt="Retromat"
                     title="Retromat">
                </a>
            </div>

            <div class="header__navi">
                <ul>
                  <li><a href="/blog/books-products/">Books</a></li>
                  <li><a href="/blog/">Blog</a></li>
                  <li><a href="/en/membership">Supporters</a></li>
                  <li><a href="/en/about">About</a></li>
                </ul>
            </div>
        </div>

        <div class="header__languageswitcher">
            <select onchange="switchLanguage(this.value)">
                <!-- Yes, this will probably be turned into a loop some time -->
                <option value="de" {{ app.request.locale == 'de' ? 'selected' }}>Deutsch ({{ activityCounts['de'] }} Aktivit&auml;ten)</option>
                <option value="en" {{ app.request.locale == 'en' ? 'selected' }}>English ({{ activityCounts['en'] }} activities)</option>
                <option value="es" {{ app.request.locale == 'es' ? 'selected' }}>Espa&ntilde;ol ({{ activityCounts['es'] }} actividades)</option>
                <option value="fr" {{ app.request.locale == 'fr' ? 'selected' }}>Fran&ccedil;ais ({{ activityCounts['fr'] }} activit&eacute;s)</option>
                <option value="nl" {{ app.request.locale == 'nl' ? 'selected' }}>Nederlands ({{ activityCounts['nl'] }} activiteiten)</option>
                <option value="pl" {{ app.request.locale == 'pl' ? 'selected' }}>Polski ({{ activityCounts['pl'] }} aktywności)</option>
                <option value="ru" {{ app.request.locale == 'ru' ? 'selected' }}>Русский ({{ activityCounts['ru'] }} упражнений)</option>
                <option value="zh" {{ app.request.locale == 'zh' ? 'selected' }}>中文 ({{ activityCounts['zh'] }} 活动)</option>
                <option value="ja" {{ app.request.locale == 'ja' ? 'selected' }}>日本語（{{ activityCounts['ja'] }}アクティビティ）</option>
            </select>
        </div>
    </div>

    <div class="pitch">
        <div class="content">
            <div class="inner font-serif">
                <?php echo($_lang['INDEX_PITCH']); ?>  
            </div>
        </div>
    </div>
    
    <!-- Promo Miroboard -->
    <div class="promo">
        <div class="content">
            <div class="promo-inner">
<?php if ($lang == 'de') { ?>
                <div class="promo-image">
                    <a href="/blog/deutsches-retromat-miroboard-mega-template/" target="_blank">
                        <img src="/static/images/miroboard/Retromat-Miroboard-Mega-Template.jpg" alt="Retromat Miroboard Mega Template">
                    </a>
                </div>
                    
                <div class="promo-text inner">
                    Macht ihr eure Retros in <b>Miro</b>? Gestalte schönere Boards in kürzerer Zeit mit dem <b>Retromat Miroboard Mega Template!</b>
                    <br><br>
                    <a href="/blog/deutsches-retromat-miroboard-mega-template/" class="button-medium" style="color:white" target="_blank" rel="noopener">
                       Mega Template ansehen
                    </a>
                </div>
<?php } else { ?>
                <div class="promo-image">
                    <a href="/blog/retromat-miroboard-mega-template/" target="_blank">
                        <img src="/static/images/miroboard/Retromat-Miroboard-Mega-Template.jpg" alt="Retromat Miroboard Mega Template">
                    </a>
                </div>
                    
                <div class="promo-text inner">
                    Are you running your retrospectives with <b>Miro</b>? Create prettier boards faster with the giant <b>Retromat Miroboard Mega Template</b>!
                    <br><br>
                    <a href="/blog/retromat-miroboard-mega-template/" class="button-medium" style="color:white" target="_blank" rel="noopener">
                       Check out the Mega Template
                    </a>
                </div>   
<?php } ?>
            </div>
        </div>
    </div>


    <div class="plan-header">
        <div class="content">
            <div class="inner">
                <div class="ids-display">
                    <div class="print-header font-serif">
                        Retromat.org – by Corinna Baldauf
                    </div>
                    <?php echo($_lang['INDEX_PLAN_ID']); ?>
                    {% include 'home/header/idDisplay.html.twig' %}
                </div>
                
                <div class="plan-header-inner-right">
                    <div class="plan-navi">
                       <ul>
                            <li>
                                <a class="plan-navi__random" title="<?php echo($_lang['INDEX_RANDOM_RETRO']); ?>" href="JavaScript:publish_random_plan()">
                                    <?php echo($_lang['INDEX_RANDOM_RETRO']); ?>         
                                </a>
                            </li>
                            <li>
                                <a class="plan-navi__search" title="<?php echo($_lang['INDEX_SEARCH_KEYWORD']); ?>" href="JavaScript:show_popup('search');">
                                    <?php echo($_lang['INDEX_SEARCH_KEYWORD']); ?>                       
                                </a>
                                <div class="js_popup--search popup--search popup display_none">
                                    <form action="JavaScript:publish_activities_for_keywords($('.js_popup--search__input').val())" name="js_search_form" class="search_form">
                                        <input type="text" size="12" name="js_popup--search__input" class="js_popup--search__input popup__input" value="">
                                        <input type="submit" class="popup__submit" value="<?php echo($_lang['POPUP_SEARCH_BUTTON']); ?>">
                                        <a href="JavaScript:hide_popup('search');" class="popup__close-link"><?php echo($_lang['POPUP_CLOSE']); ?></a>
                                    </form>
                                    <div class="popup__info"><?php echo($_lang['POPUP_SEARCH_INFO']); ?> </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {% include 'home/titles/planTitle.html.twig' %}

    {% include 'home/activities/activities.html.twig' %}

    <div class="js_activity_block_template js_activity_block display_none">
        <div class="content">
            <div class="activity">
                <div class="js_phase-stepper phase-stepper js_prev_button">
                    <a href="javascript:" class="js_prev_button_href"
                       title="<?php echo($_lang['ACTIVITY_PREV']) ?>">&#9668;
                    </a>
                </div>
                <div class="activity_content">
                    <div class="js_phase_title phase_title">
                        <a href="#" class="js_fill_phase_link">
                            <span class="js_fill_phase_title"></span>
                        </a>
                    </div>

                    <div class="js_item">
                        <h2 class="font-serif">
                            <span class="js_fill_name"></span>
                            <span class="activity_id_wrapper">
                                    (<a class="js_fill_activity_link" href="#">#<span class="js_fill_id"></span></a>)
                            </span>
                        </h2>
                        <div class="summary">
                            <span class="js_fill_summary"></span>
                            <br>
                            <span class="source"><?php echo($_lang['ACTIVITY_SOURCE']) ?>
                                <span class="js_fill_source"></span>
                            </span>
                        </div>
                        <div class="description">
                            <span class="js_fill_description"></span>
                        </div>
                    </div><!-- END js_item -->

                    <div class="js_photo_link photo_link">
                        <span class="js_fill_photo-link"></span>
                    </div><!-- END .js_photo_link -->

                </div>
                <div class="js_phase-stepper phase-stepper js_next_button">
                    <a href="Javascript:" class="js_next_button_href"
                       title="<?php echo($_lang['ACTIVITY_NEXT']) ?>">&#9658;
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="about">
        <div class="content font-serif">
            <div class="inner">
                <?php echo($_lang['INDEX_ABOUT']); ?>
            </div>
        </div>
    </div>

    <div class="team">
        <div class="content">
            <div class="inner">
            <?php if ($lang != 'en') { ?>
                <?php for($i=0; $i < count($_lang['INDEX_TEAM_TRANSLATOR_LINK']); $i++) { ?>
                <div class="team-member">
                    <a href="<?php echo($_lang['INDEX_TEAM_TRANSLATOR_LINK'][$i]); ?>">
                        <img src="<?php echo($_lang['INDEX_TEAM_TRANSLATOR_IMAGE'][$i]); ?>" width="70" height="93" title="<?php echo($_lang['INDEX_TEAM_TRANSLATOR_NAME'][$i]); ?>" class="team-photo">
                    </a>

                    <h3>
                        <?php echo($_lang['INDEX_TEAM_TRANSLATOR_TITLE']); ?>
                        <a href="<?php echo($_lang['INDEX_TEAM_TRANSLATOR_LINK'][$i]); ?>">
                            <?php echo($_lang['INDEX_TEAM_TRANSLATOR_NAME'][$i]); ?>
                        </a>
                    </h3>

                    <div class="team-text">
                        <?php echo($_lang['INDEX_TEAM_TRANSLATOR_TEXT'][$i]); ?>
                    </div>
                </div><!-- .team--translator -->
               <?php } ?>
            <?php } ?>

                <div class="team-member">
                    <a href="https://www.corinnabaldauf.de/">
                       <img src="/static/images/team/corinna_baldauf.jpg" width="70" height="93" title="Corinna Baldauf" class="team-photo">
                    </a>
                    <h3>
                        <?php echo($_lang['INDEX_TEAM_CORINNA_TITLE']); ?> 
                        <a href="https://www.corinnabaldauf.de/">
                           Corinna Baldauf
                       </a>
                    </h3>
                    <div class="team-text">
                        <?php echo($_lang['INDEX_TEAM_CORINNA_TEXT']); ?>    
                    </div>
                </div><!-- .team--corinna -->

                <div class="team-member">
                    <a href="/en/team/timon">
                        <img src="/static/images/team/timon_fiddike.jpg" width="70" height="93" title="Timon Fiddike" class="team-photo">
                    </a>
                    <h3>
                        <?php echo($_lang['INDEX_TEAM_TIMON_TITLE']); ?> 
                        <a href="/en/team/timon">
                           Timon Fiddike
                        </a>
                    </h3>
                    <div class="team-text">
                          <?php echo($_lang['INDEX_TEAM_TIMON_TEXT']); ?>          
                    </div>
                </div><!-- .team--timon-->

            </div><!-- END .inner-->
        </div>
    </div>


    <div class="footer">
        <ul>
            <li><a href="/blog/faq-frequently-asked-questions/">FAQ</a>
            </li>
            <li><a href="/blog/privacy-policy">Imprint &amp; Privacy Policy</a></li>
        </ul>
    </div>

    <!-- Matomo -->
    <noscript><img src="//retromat.org/piwik/piwik.php?idsite=3&amp;rec=1" style="border:0;" alt="" /></noscript>
    <!-- End Matomo Code -->

</body>
</html>
