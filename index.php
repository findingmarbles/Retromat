<?php

$lang = 'en';
if (ISSET($_GET['lang'])) {
    $input_lang = $_GET['lang'];
    if ($input_lang == 'en' ||
        $input_lang == 'de' ||
        $input_lang == 'es' ||
        $input_lang == 'fr' ||
        $input_lang == 'nl')
    {
        $lang = $input_lang;
    }
}

$_lang = array();
$language_file = 'lang/index_' . $lang . '.php';
require($language_file);

$activities_file = 'lang/activities_' . $lang . '.php';

?>

<!DOCTYPE html>
<html>
<head>
<title>Retr-O-Mat - <?php echo($_lang['HTML_TITLE']); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans|Droid+Serif" />

<link rel="stylesheet" type="text/css" href="static/retromat.css" />

<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="http://plans-for-retrospectives.com/images/apple-touch-icon.png" />

<script src="static/jquery.min.js"></script>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>-->

<script src="static/lightbox/lightbox.js"></script>
<link href="static/lightbox/lightbox.css" rel="stylesheet" />

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
//<![CDATA[

// "CONFIG"
var NUMBER_OF_REGULAR_PHASES = 5;
var PHASE_SOMETHING_DIFFERENT = 5;
var INVERTED_CHANCE_OF_SOMETHING_DIFFERENT = 25; // Probability to show "different" phase is 1:INVERTED_CHANCE

// Frequent sources for activities
var source_agileRetrospectives = '<a href="http://www.amazon.com/Agile-Retrospectives-Making-Teams-Great/dp/0977616649/">Agile Retrospectives<\/a>';
var source_findingMarbles = '<a href="http://www.finding-marbles.com/">Corinna Baldauf<\/a>';
var source_kalnin = '<a href="http://vinylbaustein.net/tag/retrospective/">Thorsten Kalnin<\/a>';
var source_innovationGames = '<a href="http://www.amazon.com/Innovation-Games-Creating-Breakthrough-Collaborative/dp/0321437292/">Innovation Games<\/a>';
var source_facilitatorsGuide = '<a href="http://www.amazon.de/Facilitators-Participatory-Decision-Making-Jossey-Bass-Management/dp/0787982660/">Facilitator\'s Guide to Participatory Decision-Making<\/a>';
var source_skycoach = '<a href="http://skycoach.be/ss/">Nick Oostvogels</a>';
var source_judith = '<a href="https://leanpub.com/ErfolgreicheRetrospektiven">Judith Andresen</a>';
var source_unknown = 'Unknown';

var PHASE_ID_TAG = 'phase';

<?php

require($activities_file);

$selected_EN = '';
$selected_DE = '';
$selected_ES = '';
$selected_FR = '';
$selected_NL = '';
switch ($lang) {
    case 'en':
        $selected_EN = 'selected';
        break;
    case 'de':
        $selected_DE = 'selected';
        break;
    case 'es':
        $selected_ES = 'selected';
        break;
    case 'es':
        $selected_FR = 'selected';
        break;
    case 'nl':
        $selected_NL = 'selected';
    }

?>

last_block_bg = -1; // Stores bg of last block so that no consecutive blocks have the same background



/************* FUNCTIONS ******************************************************************/

// Input: int - lowest integer that shall NOT be returned
// Returns: Random number between 0 and (upper_limit-1)
function get_random_integer(upper_limit) {
    return Math.floor(Math.random()*upper_limit);
}

/************ FOOTER ***************/

function get_number_of_activities_in_phase(phase_index) {
    var activities = get_indexes_of_activities_in_phase(phase_index);
    return activities.length;
}

function get_number_of_combinations() {
    var res = 1;
    for (var i=0; i<NUMBER_OF_REGULAR_PHASES; i++) {
        res *= get_number_of_activities_in_phase(i);
    }
    res += get_number_of_activities_in_phase(PHASE_SOMETHING_DIFFERENT);
    return res;
}

function get_combinations_string() {
    var res = '';
    for (var i=0; i<NUMBER_OF_REGULAR_PHASES; i++) {
        if (i != 0) {
            res += "x";
        }
        res += get_number_of_activities_in_phase(i);
    }
    res += '+' + get_number_of_activities_in_phase(PHASE_SOMETHING_DIFFERENT);
    return res;
}

function write_footer() {
    $("#js_footer_no_of_activities").html(all_activities.length);
    $("#js_footer_no_of_combinations").html(get_number_of_combinations());
    $("#js_footer_no_of_combinations_formula").html(get_combinations_string());
}


/************** PLANS *****************/

function get_ids_of_current_activities() {
    return $('.js_plan').find('.js_fill_id');
}


// Returns string (e.g. 'd-d-d') of activity_ids of shown activities
function format_plan_id() {
    var current_activities = get_ids_of_current_activities();
    var id = '';
    var activity;

    for (var i=0; i<current_activities.length; i++) {
        if (i != 0) {
            id += "-";
        }
        activity = current_activities[i];
        id += $(activity).text();
    }

    return id;
}


function publish_plan_id(plan_id) {
    // On page
    var form = document.forms['id-display__form'];
    form.elements['display'].value = plan_id;

    // URL
    var param = '?id=' + plan_id + '&lang=<?php echo($lang); ?>';

    // history.push doesn't work in IEs < v10 and seems to break IE9 and IE8 works but throws errors - so suppress it for >=IE9
    if (!is_ie) {
        history.pushState(param, plan_id, param); // pushState(state object, a title (ignored), URL)
    }
}


function get_activity_array(index) {
    var activity_array = all_activities[index];
    if (activity_array == null) {
        alert("<?php echo($_lang['ERROR_MISSING_ACTIVITY']); ?> " + convert_index_to_id(index));
    }
    return activity_array;
}


function convert_index_to_id(index) {
    return parseInt(index) + 1;
}


function convert_id_to_index(id) {
    return parseInt(id) - 1;
}


function get_indexes_of_activities_in_phase(phase_index) {
    var activities = new Array();
    var tmp_activity;
    for (var i=0; i<all_activities.length; i++) {
        tmp_activity = get_activity_array(i);
        if (tmp_activity.phase == phase_index) {
            activities.push(i);
        }
    }
    return activities;
}


// Input: phase_id
// Returns: String of all activities in this plan formatted as plan id
function get_activities_in_phase_as_plan_id(phase_index) {
    // TODO Fehlerbehandlung - Phase nicht gefunden oder leer
    var res = '';
    var phase_activities = get_indexes_of_activities_in_phase(phase_index);

    for(var i=0; i<phase_activities.length; i++) {
        if (i != 0) {
            res += '-';
        }
        res += convert_index_to_id(phase_activities[i]);
    }
    return res;
}

function read_activity_id(div_item_jquery_object) {
    var text = div_item_jquery_object.text();
    var string_activity_id = text.match(/#\d+/);
    var activity_id = String(string_activity_id).substr(1);
    return activity_id;
}

// Called at the end of both enable_next & enable_prev
function wrap_up_scroll_button(old_activity_index, new_activity_index) {

    var activity_block = $('.js_activity' + old_activity_index);

    populate_activity_block(new_activity_index, activity_block);
    activity_block.removeClass('js_activity' + old_activity_index);

    publish_plan_id(format_plan_id());
}

function enable_next() {

    $('.js_next_button').click(function() {

        var current_activity_id = read_activity_id($(this).parent().parent());
        var tmp_activity = get_activity_array(convert_id_to_index(current_activity_id));
        var phase_index = tmp_activity.phase;

        var found_index = -1;
        for (var i=current_activity_id; i<all_activities.length; i++) {
            tmp_activity = get_activity_array(i);
            if (tmp_activity.phase == phase_index) {
                found_index = i;
                break;
            }
        }
        if (found_index == -1) { // Not found in rest of array -> Continue at beginning
            for (var i=0; i<=current_activity_id; i++) {
                tmp_activity = get_activity_array(i);
                if (tmp_activity.phase == phase_index) {
                    found_index = i;
                    break;
                }
            }
        }
        wrap_up_scroll_button(convert_id_to_index(current_activity_id), found_index);
    });
}

function enable_prev() {

    $('.js_prev_button').click(function() {

        var current_activity_id = read_activity_id($(this).parent().parent());
        var tmp_activity = get_activity_array(convert_id_to_index(current_activity_id));
        var phase_index = tmp_activity.phase;

        var found_index = -1;
        for (var i=current_activity_id-2; i>=0; i--) {
            tmp_activity = get_activity_array(i);
            if (tmp_activity.phase == phase_index) {
                found_index = i;
                break;
            }
        }
        if (found_index == -1) { // Not found in rest of array -> Continue at beginning
            for (var i=all_activities.length-1; i>=current_activity_id-1; i--) {
                tmp_activity = get_activity_array(i);
                if (tmp_activity.phase == phase_index) {
                    found_index = i;
                    break;
                }
            }
        }
        wrap_up_scroll_button(convert_id_to_index(current_activity_id), found_index);
    });
}


function get_contrasting_bg() {
    var bg;
    do {
        bg = get_random_integer(5);
    } while (last_block_bg == bg);
    last_block_bg = bg;

    return bg;
}

function publish_plan(plan_id) {
    var ids = String(plan_id).split("-");
    var activity_block;
// TODO Fehlerbehandlung    var error_msg = '';
    for(var i=0; i<ids.length; i++) {
        if (ids[i] != '') { // ignore incorrect single '-' at beginning or end of plan_id
            activity_block = get_activity_block(parseInt(ids[i])-1, i);
            activity_block.appendTo($('.js_plan'));
        }
    }
}

//Input: String
function show_plan(plan_id) {
    var plan_id = String(plan_id.match(/[0-9-]+/)); // Ignore everything that's not a digit or '-'
    if (plan_id) {
        $('.js_plan').html(""); // RESET

        //TODO show_plan & publish_plan?? ... Horrible!
        publish_plan(plan_id);
        enable_phase_browsing();

        // This function really doesn't read like prose... -> set_visibilities(ENUM);
        $('.js_phase-stepper').addClass('display_table-cell');
        $('.js_phase-stepper ').removeClass('display_none');
        $('.js_plan_title_container').addClass('display_none');
        publish_plan_id(plan_id);
    }
}


function show_plan_title(title) {
    $('.js_plan_title').html(title);
    $('.js_plan_title_container').removeClass('display_none');
}

function enable_phase_browsing() {
    enable_prev();
    enable_next();
    enable_phase_link();
}

function show_activities_in_phase(phase_index) {
    var plan_id = get_activities_in_phase_as_plan_id(phase_index);
    show_plan(plan_id);
    show_plan_title(phase_titles[phase_index]);
    enable_phase_browsing();
    $('.js_phase-stepper').addClass('display_none');
    $('.js_phase-stepper').removeClass('display_table-cell');
}

function search_activities_for(phrase) {
    var plan_id = "";
    var haystack = "";
    var flag_first = true;
    var found;
    var re = new RegExp(phrase,"i");
    for (var i=0; i<all_activities.length; i++) {
        found = false;
        haystack = all_activities[i].name;
        if (haystack.search(re) != -1) {
            found = true;
        }
        else {
            haystack = all_activities[i].summary;
            if (haystack.search(re) != -1) {
                found = true;
            } else {
                haystack = all_activities[i].desc;
                if (haystack.search(re) != -1) {
                    found = true;
                }
            }
        }

        if (found) {
            if (flag_first) {
                flag_first = false;
            } else {
                    plan_id += "-";
            }
            plan_id += convert_index_to_id(i);
        }
    }

    if (plan_id) {
        show_plan(plan_id);
        enable_phase_browsing();
        $('.js_phase-stepper').addClass('display_none');
        $('.js_phase-stepper').removeClass('display_table-cell');
        hidePopup('search');
    } else {
        plan_id = '';
        publish_plan_id(plan_id);
        $('#plan').html('<div class="js_activity_block activity_block bg1"><div class="activity-wrapper"><div class="activity-content">Sorry, nothing found</div></div></div>');
    }
    show_plan_title("'" + phrase + "'"); // Call must be after "show_plan()" or plan_title_container won't be displayed
}

// Input: int phase_id
// Returns: int activity_index - randomly chosen activity from given phase
function get_index_of_random_activity_in_phase(phase_index) {
    var indexes = get_indexes_of_activities_in_phase(phase_index);
    return indexes[get_random_integer(indexes.length)];
}

function show_random_plan() {
    var plan_id = '';
    if(get_random_integer(INVERTED_CHANCE_OF_SOMETHING_DIFFERENT)) { // Show something completely different if 0
        for (var i=0; i<NUMBER_OF_REGULAR_PHASES; i++) {
            if (i != 0) {
                plan_id += '-';
            }
            plan_id += convert_index_to_id(get_index_of_random_activity_in_phase(i));
        }
    } else {
        plan_id += convert_index_to_id(get_index_of_random_activity_in_phase(PHASE_SOMETHING_DIFFERENT));
    }
    show_plan(plan_id);
}


// From http://jquery-howto.blogspot.de/2009/09/get-url-parameters-values-with-jquery.html
// Read a page's GET URL variables and return them as an associative array
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for(var i=0; i < hashes.length; i++)
    {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
}

function switchLanguage(new_lang) {
    var urlParams = getUrlVars();
    window.open(location.protocol + '//' + location.host + location.pathname + '?id=' + urlParams.id + "&lang=" + new_lang, "_self");
}

function showPopup(popup) {
    var identifier = '.js_popup--' + popup;
    $(identifier).removeClass('display_none');
}

function hidePopup(popup) {
    var identifier = '.js_popup--' + popup;
    $(identifier).addClass('display_none');
}

function init() {
    var urlParams = getUrlVars();
    var plan_id = urlParams.id;
    if(plan_id) {
        show_plan(plan_id);
    } else {
        show_random_plan();
    }
    write_footer();
}


function enable_phase_link() {

    $('.js_phase_link').click(function() {

        var current_activity_id = read_activity_id($(this).parent().parent());
        var tmp_activity = get_activity_array(convert_id_to_index(current_activity_id));

        show_activities_in_phase(tmp_activity.phase);

    });
}

/* Param: activity.photo
 * Returns: String (empty or link to photo)
 */
function get_photo_string(photo) {
    res = "";
    if (photo != null) {
        res = photo + " | ";
    }
    return res;
}

function populate_activity_block(activity_index, activity_block) {
    var activity = get_activity_array(activity_index);

    $(activity_block).addClass('js_activity' + activity_index);

    $(activity_block).find('.js_fill_phase_title').html(phase_titles[activity.phase]);
    $(activity_block).find('.js_fill_name').html(activity.name);
    $(activity_block).find('.js_fill_id').html(convert_index_to_id(activity_index));
    $(activity_block).find('.js_fill_summary').html(activity.summary);
    $(activity_block).find('.js_fill_source').html(activity.source);
    $(activity_block).find('.js_fill_description').html(activity.desc);
    $(activity_block).find('.js_fill_photo-link').html(get_photo_string(activity.photo));

}


/* Param: Index of activity
 * Returns: Object containing "activity_block"-div
 */
function get_activity_block(activity_index) {
    var activity_block = $('.js_activity_block_template').clone()
    activity_block.removeClass('js_activity_block_template');

    activity_block.addClass('bg' + get_contrasting_bg());

    populate_activity_block(activity_index, activity_block);

    activity_block.removeClass('display_none');

    return activity_block;
}

//]]>
</script>

</head>

<body onload="JavaScript:init()">

<div class="header">
    <img class="header__logo" src="static/images/logo_white.png" alt="Retr-O-Mat" title="Retr-O-Mat">
    <!--
    <select class="languageswitcher" onchange="switchLanguage(this.value)">
        <option value="de" <?php echo($selected_DE); ?> >Deutsch</option>
        <option value="en" <?php echo($selected_EN); ?> >English</option>
        <option value="es" <?php echo($selected_ES); ?> >Espa&ntilde;ol</option>
        <option value="fr" <?php echo($selected_FR); ?> >Fran&ccedil;ais</option>
        <option value="nl" <?php echo($selected_NL); ?> >Nederlands</option>
    </select>
    -->

      <span class="navi"><a href="http://finding-marbles.com/retr-o-mat/what-is-a-retrospective/">What is a retrospective?</a> |
        <a href="http://finding-marbles.com/retr-o-mat/about-retr-o-mat/">About Retr-O-Mat</a> |
          <!--
          <a href="http://plans-for-retrospectives.com/getting-started-with-retrospectives-book/index.html">Getting Started with Retrospectives</a> |
          <a href="http://finding-marbles.com">By Finding-Marbles.com</a> |
          -->
         <a href="/print/index.html">Print Edition</a> |
        <a href="https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ">Add activity</a>
      </span>
</div>

<div class="pitch">
    <div class="content">
        <?php echo($_lang['INDEX_PITCH']); ?>
    </div>
</div>

<?php if ($lang == 'en') { ?>
    <div class="book">
        <div class="content">
                Did you know there's a
                <a href="/print/index.html">Print Editon of the Retr-O-Mat</a>?
        </div>
    </div>
<?php } ?>

<div class="plan-header">
    <div class="content">
        <div class="print-header">
            Retr-O-Mat <span class="finding_marbles">(plans-for-retrospectives.com) <?php echo($_lang['PRINT_HEADER']); ?></span>
        </div>
        <div class="plan-header__wrapper">
            <div class="id-display">
                <?php echo($_lang['INDEX_PLAN']); ?>
                <form name="id-display__form" class="id-display__form">
                    <input type="text" size="18" name="display" class="id-display__input" value="">
                </form>
            </div>
            <div class="plan-navi">
                <ul>
                    <li>
                        <a class="plan-navi__random" title="<?php echo($_lang['INDEX_RANDOM_RETRO']); ?>" href="JavaScript:show_random_plan()">
                            <?php echo($_lang['INDEX_RANDOM_RETRO']); ?>
                        </a>
                    </li>
                    <li>
                        <a class="plan-navi__ids" title="<?php echo($_lang['INDEX_ENTER_ID']); ?>" href="JavaScript:showPopup('ids');">
                            <?php echo($_lang['INDEX_ENTER_ID']); ?>
                        </a>
                        <div class="js_popup--ids popup--ids popup display_none">
                            <form action="JavaScript:show_plan($('.js_popup--ids__input').val())" name="ids_form" class="ids_form">
                                <input type="text" size="12" name="ids" class="js_popup--ids__input popup--ids__input" value="">
                                <input type="submit" class="popup__submit" value="<?php echo($_lang['POPUP_IDS_BUTTON']); ?>">
                                <a href="JavaScript:hidePopup('ids');" class="popup__close-link"><?php echo($_lang['POPUP_CLOSE']); ?></a>
                            </form>
                            <div class="popup__info"><?php echo($_lang['POPUP_IDS_INFO']); ?></div>
                        </div>
                    </li>
                    <li>
                        <a class="plan-navi__search" title="<?php echo($_lang['INDEX_SEARCH_KEYWORD']); ?>" href="JavaScript:showPopup('search');">
                            <?php echo($_lang['INDEX_SEARCH_KEYWORD']); ?>
                        </a>
                        <div class="js_popup--search popup--search popup display_none">
                            <form action="JavaScript:search_activities_for($('.js_popup--search__input').val())" name="search_form" class="search_form">
                                <input type="text" size="12" name="search_phrase" class="js_popup--search__input popup--search__input" value="">
                                <input type="submit" class="popup__submit" value="<?php echo($_lang['POPUP_SEARCH_BUTTON']); ?>">
                                <a href="JavaScript:hidePopup('search');" class="popup__close-link"><?php echo($_lang['POPUP_CLOSE']); ?></a>
                            </form>
                            <div class="popup__info"><?php echo($_lang['POPUP_SEARCH_INFO']); ?></div>
                        </div>
                    </li>
                </ul>
            </div><!-- plan-navi -->
        </div><!-- plan-header__wrapper -->
    </div><!-- content -->
</div>

<div class="js_plan_title_container plan_title_container display_none">
    <div class="content"><?php echo($_lang['INDEX_ALL_ACTIVITIES_FOR_PHASE']); ?> <span class="js_plan_title uppercase">Replaced by JS</span>
    </div>
</div>

<div class="js_plan">
    <noscript>
        <?php echo($_lang['ERROR_NO_SCRIPT']); ?>
    </noscript>
</div><!-- END plan -->

<div class="js_activity_block_template js_activity_block activity_block display_none">
    <div class="activity-wrapper">
        <a href="JavaScript:Previous" class="js_phase-stepper phase-stepper js_prev_button display_table-cell" title="<?php echo($_lang['ACTIVITY_PREV']) ?>">&#9668;</a>
        <div class="activity-content">
            <div class="js_phase_title phase_title">
                <a href="#" onclick="JavaScript:All_activities_in_phase" class="js_phase_link">
                    <span class="js_fill_phase_title"></span>
                </a>
            </div>
            <div class="js_item">
                <h2><span class="js_fill_name"></span>
                    <span class="activity_id_wrapper">(#<span class="js_fill_id"></span>)</span>
                </h2>
                <div class="summary">
                    <span class="js_fill_summary"></span>
                    <br>
                        <span class="source"><?php echo($_lang['ACTIVITY_SOURCE']) ?>
                            <span class="js_fill_source"></span>
                        </span>
                </div><!-- END summary -->
                <div class="description">
                    <span class="js_fill_description"></span>
                </div><!-- END description -->
            </div><!-- END js_item -->
            <div class="js_photo_link photo_link">
                <span class="js_fill_photo-link"></span>
                <a href="mailto:corinna@finding-marbles.com?subject=<?php echo($_lang['ACTIVITY_PHOTO_MAIL_SUBJECT']) ?>&body=<?php echo($_lang['ACTIVITY_PHOTO_MAIL_BODY']) ?>" class="less_pronounced">
                    <?php echo($_lang['ACTIVITY_PHOTO_ADD']) ?>
                </a>
            </div><!-- END .js_photo_link -->
        </div><!-- END .activity-content -->
        <a href="JavaScript:Next" class="js_phase-stepper phase-stepper js_next_button display_table-cell" title="<?php echo($_lang['ACTIVITY_NEXT']) ?>">&#9658;</a>
    </div><!-- END .activity-wrapper -->
</div>

<div class="about">
    <div class="content">
        <?php echo($_lang['INDEX_MINI_ABOUT']); ?>
        <a href="https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ"><?php echo($_lang['INDEX_MINI_ABOUT_SUGGEST']); ?></a>!
    </div>
</div>

<div class="team">
   <div class="content">
       <?php echo($_lang['INDEX_MINI_TEAM']); ?>
    </div>
</div>

<!-- Piwik -->
<script type="text/javascript">
    var _paq = _paq || [];
    _paq.push(["trackPageView"]);
    _paq.push(["enableLinkTracking"]);

    (function() {
        var u=(("https:" == document.location.protocol) ? "https" : "http") + "://finding-marbles.com/piwik/";
        _paq.push(["setTrackerUrl", u+"piwik.php"]);
        _paq.push(["setSiteId", "3"]);
        var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
        g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
    })();
</script>
<!-- End Piwik Code -->
</body>
</html>