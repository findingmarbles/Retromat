<?php

$lang = 'en';

if (isset($argv[1])) {
    $lang = $argv[1];
} else if (array_key_exists('lang', $_GET)) {
    $lang = $_GET['lang'];
}

$isEnglish = false;
if ($lang == 'en') {
    $isEnglish = true;
}

require(get_language_file_path($lang));

$activities_file = 'lang/activities_' . $lang . '.php';
$activities_photos_file = 'lang/photos.php';

// PHP FUNCTIONS

function get_language_file_path($lang) {
    $res = 'lang/index_' . $lang . '.php';
    return $res;
}

function print_if_selected($candidate, $chosen) {
    $res = '';
    if ($chosen == $candidate) {
        $res = 'selected';
    }
    return $res;
}

function get_url_to_index() {
    global $isEnglish;
    $res = 'http://plans-for-retrospectives.com/';
    if (!$isEnglish) {
        global $lang;
        $res .= 'index_' . $lang . '.html';
    }
    return $res;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Retromat - <?php echo($_lang['HTML_TITLE']); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans|Droid+Serif" />

<link rel="stylesheet" type="text/css" href="static/retromat.css" />

<link rel="shortcut icon" href="images/favicon.ico" />
<link rel="apple-touch-icon-precomposed" href="http://plans-for-retrospectives.com/images/apple-touch-icon.png" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="static/jquery.min.js"><\/script>')</script>

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
var source_innovationGames = '<a href="http://www.amazon.com/Innovation-Games-Creating-Breakthrough-Collaborative/dp/0321437292/">Luke Hohmann<\/a>';
var source_facilitatorsGuide = '<a href="http://www.amazon.de/Facilitators-Participatory-Decision-Making-Jossey-Bass-Management/dp/0787982660/">Facilitator\'s Guide to Participatory Decision-Making<\/a>';
var source_skycoach = '<a href="http://skycoach.be/ss/">Nick Oostvogels</a>';
var source_judith = '<a href="https://leanpub.com/ErfolgreicheRetrospektiven">Judith Andresen</a>';
var source_unknown = 'Unknown';

var PHASE_ID_TAG = 'phase';

<?php

    require($activities_file);
    require($activities_photos_file);

?>

last_block_bg = -1; // Stores bg of last block so that no consecutive blocks have the same background



/************* FUNCTIONS ******************************************************************/



function init() {
    var urlParams = getUrlVars();
    var plan_id = urlParams.id;
    var phase = urlParams.phase;
    if(plan_id) {
        publish_plan(plan_id, phase);
    } else {
        publish_random_plan();
    }
    publish_footer_stats();
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

function sanitize_plan_id(plan_id) {
    return String(plan_id.match(/[0-9-]+/)); // Ignore everything that's not a digit or '-'
}

function empty_plan() {
    $('.js_plan').html("");
}

function publish_activity_blocks(plan_id) {
    var ids = String(plan_id).split("-");
    var activity_block;
    for(var i=0; i<ids.length; i++) {
        if (ids[i] != '') { // ignore incorrect single '-' at beginning or end of plan_id
            activity_block = get_activity_block(parseInt(ids[i])-1, i);
            activity_block.appendTo($('.js_plan'));
        }
    }
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

function get_contrasting_bg() {
    var bg;
    do {
        bg = get_random_integer(5);
    } while (last_block_bg == bg);
    last_block_bg = bg;

    return bg;
}

// Input: int - lowest integer that shall NOT be returned
// Returns: Random number between 0 and (upper_limit-1)
function get_random_integer(upper_limit) {
    return Math.floor(Math.random()*upper_limit);
}

function populate_activity_block(activity_index, activity_block) {
    var activity = get_activity_array(activity_index);
    var id = convert_index_to_id(activity_index);

    $(activity_block).addClass('js_activity' + activity_index);

    $(activity_block).find('.js_fill_phase_title').html(phase_titles[activity.phase]);
    $(activity_block).find('.js_fill_phase_link').prop('href','?id=' + get_activities_in_phase_as_plan_id(activity.phase) + '&phase=' + activity.phase);
    $(activity_block).find('.js_fill_name').html(activity.name);
    $(activity_block).find('.js_fill_activity_link').prop('href','?id=' + id);
    $(activity_block).find('.js_fill_id').html(id);
    $(activity_block).find('.js_fill_summary').html(activity.summary);
    $(activity_block).find('.js_fill_source').html(activity.source);
    $(activity_block).find('.js_fill_description').html(activity.desc);
    $(activity_block).find('.js_fill_photo-link').html(get_photo_string(activity_index));

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

/* Param: activity index
 * Returns: String (empty or link to photo(s))
 */
function get_photo_string(index) {
    res = "";
    if (all_photos[index] != null) {
        for (var i=0; i<all_photos[index].length; i++) {
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

    /************ BEGIN Phase Navigation (Prev, Next, All activities in Phase) ************/

function enable_phase_browsing() {
    enable_prev();
    enable_next();
}

function enable_prev() {
    $('.js_prev_button').click(function() {
        var activity_index = convert_id_to_index(read_activity_id($(this).parent().parent()));
        enable_phase_stepper(activity_index, get_index_of_prev_activity_in_phase);
    });
}

function convert_id_to_index(id) {
    return parseInt(id) - 1;
}

function read_activity_id(div_js_item_jquery_object) {
    return $(div_js_item_jquery_object.html()).find('.js_fill_id').text();
}

function get_index_of_prev_activity_in_phase(activity_index, phase_index) {
    var found_index = -1;
    var candidate;
    for (var i=activity_index-1; i>=0; i--) {
        candidate = get_activity_array(i);
        if (candidate.phase == phase_index) {
            found_index = i;
            break;
        }
    }
    if (found_index == -1) { // Not found in rest of array -> Continue at beginning
        for (var i=all_activities.length-1; i>=activity_index; i--) {
            candidate = get_activity_array(i);
            if (candidate.phase == phase_index) {
                found_index = i;
                break;
            }
        }
    }

    return found_index;
}

function enable_phase_stepper(activity_index, get_neighbor_function) {
    var phase_index = get_phase_from_activity_index(activity_index);

    var next = get_neighbor_function(activity_index, phase_index);

    var old_identifier = '.js_activity' + activity_index;
    var activity_block = $(old_identifier);

    populate_activity_block(next, activity_block);
    activity_block.removeClass(old_identifier);

    publish_plan_id(format_plan_id());
}

function get_phase_from_activity_index(activity_index) {
    return get_activity_array(activity_index).phase;
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

function get_ids_of_current_activities() {
    return $('.js_plan').find('.js_fill_id');
}

function enable_next() {

    $('.js_next_button').click(function() {
        var activity_index = convert_id_to_index(read_activity_id($(this).parent().parent()));
        enable_phase_stepper(activity_index, get_index_of_next_activity_in_phase);
    });
}

function get_index_of_next_activity_in_phase(activity_index, phase_index) {
    var found_index = -1;
    var candidate;
    for (var i=activity_index+1; i<all_activities.length; i++) {
        candidate = get_activity_array(i);
        if (candidate.phase == phase_index) {
            found_index = i;
            break;
        }
    }
    if (found_index == -1) { // Not found in rest of array -> Continue at beginning
        for (var i=0; i<activity_index; i++) {
            candidate = get_activity_array(i);
            if (candidate.phase == phase_index) {
                found_index = i;
                break;
            }
        }
    }

    return found_index;
}

/************ END Phase Navigation (Prev, Next, All activities in Phase) ************/

/* Returns: String of all activities in this phase formatted as plan id
 */
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

function publish_plan_title(title) {
    $('.js_fill_plan_title').html(title);
    show_plan_title();
}

function show_plan_title() {
    $('.js_plan_title_container').removeClass('display_none');
}


function hide_phase_stepper() {
    $('.js_phase-stepper').addClass('hidden');
}

function show_phase_stepper() {
    $('.js_phase-stepper').removeClass('hidden');
}

function hide_plan_title() {
    $('.js_plan_title_container').addClass('display_none');
}

function publish_plan_id(plan_id) {
    // On page
    var form = document.forms['js_ids-display__form'];
    form.elements['js_display'].value = plan_id;

    // URL
    var param = '?id=' + plan_id;

    // history.push doesn't work in IEs < v10 and seems to break IE9 and IE8 works but throws errors - so suppress it for >=IE9
    if (!is_ie) {
        history.pushState(param, plan_id, param); // pushState(state object, a title (ignored), URL)
    }
}

function publish_random_plan() {
    var plan_id = '';
    if(is_time_for_something_different()) {
        plan_id += pick_random_activity_id_in_phase(PHASE_SOMETHING_DIFFERENT);
    } else {
        plan_id += generate_random_regular_plan_id();
    }
    publish_plan(plan_id);
}

/* Returns: Boolean
 */
function is_time_for_something_different() {
    res = false;
    if (get_random_integer(INVERTED_CHANCE_OF_SOMETHING_DIFFERENT) == 0) {
        res = true;
    }
    return res;
}

function pick_random_activity_id_in_phase(phase_index) {
    return convert_index_to_id(pick_random_activity_index_in_phase(phase_index));
}

// Input: int phase_id
// Returns: int activity_index - randomly chosen activity from given phase
function pick_random_activity_index_in_phase(phase_index) {
    var indexes = get_indexes_of_activities_in_phase(phase_index);
    return indexes[get_random_integer(indexes.length)];
}

function get_indexes_of_activities_in_phase(phase_index) {
    var activities = new Array();
    var tmp_activity;
    for (var i=0; i<all_activities.length; i++) {
        candidate_activity = get_activity_array(i);
        if (candidate_activity.phase == phase_index) {
            activities.push(i);
        }
    }
    return activities;
}

/* Returns: String, example: 14-3-77-34-22
 * Digits are IDs of activities from the 5 different phases
 */
function generate_random_regular_plan_id() {
    var plan_id = '';
    for (var i=0; i<NUMBER_OF_REGULAR_PHASES; i++) {
        if (i != 0) {
            plan_id += '-';
        }
        plan_id += pick_random_activity_id_in_phase(i);
    }
    return plan_id;
}



/************ BEGIN Footer Functions ************/

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

function publish_footer_stats() {
    $(".js_footer_no_of_activities").html(all_activities.length);
    $(".js_footer_no_of_combinations").html(get_number_of_combinations());
    $(".js_footer_no_of_combinations_formula").html(get_combinations_string());
}

/************ END Footer Functions ************/



/************ BEGIN PopUps Plan Navigation (Search) ************/

function get_input_field(popup_name) {
    var form = document.forms['js_' + popup_name + '_form'];
    var element_name = 'js_popup--' + popup_name + '__input';
    return form.elements[element_name];
}

function reset_input_field(input_field) {
    input_field.value = "";
}

function focus_input_field(input_field) {
    input_field.focus();
}

function show_popup(popup_name) {
    $('.js_popup--' + popup_name).removeClass('display_none');

    var input = get_input_field(popup_name);
    reset_input_field(input);
    focus_input_field(input);
}

function hide_popup(popup_name) {
    $('.js_popup--' + popup_name).addClass('display_none');
}

/* Returns: String
 * Success: Ids of activities containing $keyword in name, summary or description
 * Failure: Nothing found -> Empty string
 */
function search_activities_for_keyword(keyword) {
    var plan_id = '';
    var isMatch = false;
    for (var i=0; i<all_activities.length; i++) {
        isMatch = has_found_match(all_activities[i], keyword);
        if (isMatch) {
            plan_id += convert_index_to_id(i) + '-';
        }
    }
    if (plan_id.length > 0) {
        plan_id = plan_id.substr(0, plan_id.length-1)
    }

    return plan_id; // Remove trailing '-'

}

function has_found_match(activity, keyword) {
    var regEx = new RegExp(keyword,"i");
    var isMatch = false;
    var haystack = activity.name;
    if (haystack.search(regEx) != -1) {
        isMatch = true;
    } else {
        haystack = activity.summary;
        if (haystack.search(regEx) != -1) {
            isMatch = true;
        } else {
            haystack = activity.desc;
            if (haystack.search(regEx) != -1) {
                isMatch = true;
            }
        }
    }
    return isMatch;
}

function find_ids_in_keyword(keyword) {
    var res = sanitize_plan_id(keyword);
    if (res == "null") {
        res = '';
    } else {
        res = '-' + res;
    }
    return res;
}

function publish_activities_for_keywords(keywords) {

    var keywords_array = keywords.split(' ');
    var plan_id = '';
    for (var i=0; i<keywords_array.length; i++) {
        var sub_ids = search_activities_for_keyword(keywords_array[i]);
        if (sub_ids.length > 0) {
            plan_id += sub_ids + '-';
        }
    }
    plan_id = plan_id.substr(0, plan_id.length-1); // Remove trailing '-'

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

    publish_plan_title(text +  " '" + keywords + "'"); // Call must be after "publish_plan()" or plan_title_container won't be displayed
}

/************ END PopUps Plan Navigation ************/



function switchLanguage(new_lang) {
    new_url = location.protocol + '//' + location.host + '/index';
    if (new_lang != 'en') {
        new_url += '_' + new_lang;
    }
    new_url += '.html',
    window.open(new_url, "_self");
}

//]]>
</script>

<link rel="alternate" hreflang="en" href="index.html" />
<link rel="alternate" hreflang="es" href="index_es.html" />
<link rel="alternate" hreflang="fr" href="index_fr.html" />
<link rel="alternate" hreflang="de" href="index_de.html" />
<link rel="alternate" hreflang="nl" href="index_nl.html" />

</head>

<body onload="JavaScript:init()">

<div class="header">
    <a href="<?php echo(get_url_to_index()) ?>" class="header__logo">
        <img class="header__logo" src="static/images/logo_white.png" alt="Retromat" title="Retromat"></a>

    <select class="languageswitcher" onChange="switchLanguage(this.value)">
        <option value="de" <?php echo(print_if_selected("de", $lang)); ?> >Deutsch (39 Aktivit&auml;ten)</option>
        <option value="en" <?php echo(print_if_selected("en", $lang)); ?> >English (118 activities)</option>
        <option value="es" <?php echo(print_if_selected("es", $lang)); ?> >Espa&ntilde;ol (95 actividades)</option>
        <option value="fr" <?php echo(print_if_selected("fr", $lang)); ?> >Fran&ccedil;ais (47 activit&eacute;s)</option>
        <option value="nl" <?php echo(print_if_selected("nl", $lang)); ?> >Nederlands (96 activiteiten)</option>
    </select>

      <span class="navi">
        <?php echo($_lang['INDEX_NAVI_WHAT_IS_RETRO']); ?> |
        <?php echo($_lang['INDEX_NAVI_ABOUT']); ?> |
        <?php echo($_lang['INDEX_NAVI_PRINT']); ?>
		  <!-- PAUSED Until I've got more time
		  |
        <?php echo($_lang['INDEX_NAVI_ADD_ACTIVITY']); ?>
        -->
      </span>
</div>

<div class="pitch">
    <div class="content">
        <?php echo($_lang['INDEX_PITCH']); ?>
    </div>
</div>
<!--
<?php if ($isEnglish) { ?>
    <div class="book">
        <div class="content">
                For an interesting new perspective on retrospectives why not try a
                <a href="http://frontrowagile.com/themed">themed retrospective</a>?
        </div>
    </div>
<?php } ?>
-->
<div class="plan-header">
    <div class="content">
        <div class="print-header">
            Retromat <span class="finding_marbles">(plans-for-retrospectives.com) <?php echo($_lang['PRINT_HEADER']); ?></span>
        </div>
        <div class="plan-header__wrapper">
            <div class="ids-display">
                <?php echo($_lang['INDEX_PLAN_ID']); ?>
                <form name="js_ids-display__form" class="ids-display__form" action="JavaScript:publish_plan($('.ids-display__input').val());">
                    <input type="text" size="18" name="js_display" class="ids-display__input" value="">
                </form>
            </div>
            <div class="plan-navi">
                <ul>
                    <li>
                        <a class="plan-navi__random" title="<?php echo($_lang['INDEX_RANDOM_RETRO']); ?>" href="JavaScript:publish_random_plan()">
                            <?php echo($_lang['INDEX_RANDOM_RETRO']); ?>
                        </a>
                    </li>
                    <li>
                        <a class="plan-navi__ids" title="<?php echo($_lang['INDEX_ENTER_ID']); ?>" href="JavaScript:show_popup('ids');">
                            <?php echo($_lang['INDEX_ENTER_ID']); ?>
                        </a>
                        <div class="js_popup--ids popup--ids popup display_none">
                            <form action="JavaScript:publish_plan($('.js_popup--ids__input').val());hide_popup('ids');" name="js_ids_form" class="ids_form">
                                <input type="text" size="12" name="js_popup--ids__input" class="js_popup--ids__input popup__input" value="">
                                <input type="submit" class="popup__submit" value="<?php echo($_lang['POPUP_IDS_BUTTON']); ?>">
                                <a href="JavaScript:hide_popup('ids');" class="popup__close-link"><?php echo($_lang['POPUP_CLOSE']); ?></a>
                            </form>
                            <div class="popup__info"><?php echo($_lang['POPUP_IDS_INFO']); ?></div>
                        </div>
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
                            <div class="popup__info"><?php echo($_lang['POPUP_SEARCH_INFO']); ?></div>
                        </div>
                    </li>
                </ul>
            </div><!-- plan-navi -->
        </div><!-- plan-header__wrapper -->
    </div><!-- content -->
</div>

<div class="js_plan_title_container plan_title_container display_none">
    <div class="content"><span class="js_fill_plan_title">Replaced by JS</span>
    </div>
</div>

<div class="js_plan">
    <div class="activity_block bg1">
        <div class="activity-wrapper">
            <div class="activity-content">
                    <?php echo($_lang['INDEX_LOADING']); ?>
                    <noscript>
                        <?php echo($_lang['ERROR_NO_SCRIPT']); ?>
                    </noscript>
            </div>
        </div>
    </div>
</div><!-- END plan -->

<div class="js_activity_block_template js_activity_block activity_block display_none">
    <div class="activity-wrapper">
        <a href="JavaScript:Previous" class="js_phase-stepper phase-stepper js_prev_button display_table-cell" title="<?php echo($_lang['ACTIVITY_PREV']) ?>">&#9668;</a>
        <div class="activity-content">
            <div class="js_phase_title phase_title">
                <a href="#" class="js_fill_phase_link">
                    <span class="js_fill_phase_title"></span>
                </a>
            </div>
            <div class="js_item">
                <h2><span class="js_fill_name"></span>
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
                </div><!-- END summary -->
                <div class="description">
                    <span class="js_fill_description"></span>
                </div><!-- END description -->
            </div><!-- END js_item -->
            <div class="js_photo_link photo_link">
                <span class="js_fill_photo-link"></span>
				<!-- PAUSED Until I've got more time
                <a href="mailto:corinna@finding-marbles.com?subject=<?php echo($_lang['ACTIVITY_PHOTO_MAIL_SUBJECT']) ?>&body=<?php echo($_lang['ACTIVITY_PHOTO_MAIL_BODY']) ?>" class="less_pronounced">
                    <?php echo($_lang['ACTIVITY_PHOTO_ADD']) ?>
                </a>
                -->
            </div><!-- END .js_photo_link -->
        </div><!-- END .activity-content -->
        <a href="JavaScript:Next" class="js_phase-stepper phase-stepper js_next_button display_table-cell" title="<?php echo($_lang['ACTIVITY_NEXT']) ?>">&#9658;</a>
    </div><!-- END .activity-wrapper -->
</div>

<div class="about">
    <div class="content">
        <?php echo($_lang['INDEX_ABOUT']); ?>
<!-- PAUSED Until I've got more time
        <a href="https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ"><?php echo($_lang['INDEX_ABOUT_SUGGEST']); ?></a>!
-->
    </div>
</div>

<div class="team">
   <div class="content">

<?php if (!$isEnglish) { ?>
       <div class="team__translator">
           <h2>
               <?php echo($_lang['INDEX_TEAM_TRANSLATOR_TITLE']); ?>
           </h2>
           <?php for($i=0; $i < count($_lang['INDEX_TEAM_TRANSLATOR_LINK']); $i++) { ?>
               <a href="<?php echo($_lang['INDEX_TEAM_TRANSLATOR_LINK'][$i]); ?>">
                   <img src="<?php echo($_lang['INDEX_TEAM_TRANSLATOR_IMAGE'][$i]); ?>" width="70" height="93" title="<?php echo($_lang['INDEX_TEAM_TRANSLATOR_NAME']); ?>" class="team-photo">
               </a>
                <h3 style="margin-bottom: 10px">
                   <a href="<?php echo($_lang['INDEX_TEAM_TRANSLATOR_LINK'][$i]); ?>">
                       <?php echo($_lang['INDEX_TEAM_TRANSLATOR_NAME'][$i]); ?>
                   </a>
                </h3>

               <div class="team-text">
                   <?php echo($_lang['INDEX_TEAM_TRANSLATOR_TEXT'][$i]); ?>
               </div>
           <?php } ?>
       </div><!-- .team--translator -->
<?php } ?>

       <div>
           <h2><?php echo($_lang['INDEX_TEAM_CORINNA_TITLE']); ?>
           </h2>
           <a href="http://finding-marbles.com/">
               <img src="static/images/team/corinna_baldauf.jpg" width="70" height="93" title="Corinna Baldauf" class="team-photo">
           </a>
           <h3 style="margin-bottom: 10px">
               <a href="http://finding-marbles.com/">
                   Corinna Baldauf
               </a>
           </h3>
           <div class="team-text" style="margin-right:0">
               <?php echo($_lang['INDEX_TEAM_CORINNA_TEXT']); ?>
           </div>
       </div><!-- .team--corinna -->
    </div><!-- .content -->
</div><!-- .team -->

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