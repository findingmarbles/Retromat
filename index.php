<?php

$lang = 'en';
if (ISSET($_GET['lang'])) {
    $input_lang = $_GET['lang'];
    if ($input_lang == 'en' ||
        $input_lang == 'de' ||
        $input_lang == 'es' ||
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

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

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
    $("#footer_no_of_activities").html(all_activities.length);
    $("#footer_no_of_combinations").html(get_number_of_combinations());
    $("#footer_no_of_combinations_formula").html(get_combinations_string());
}


/************** PLANS *****************/

function get_ids_of_current_activities() {
    return $('.activity_id');
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
    var form = document.forms['plan_id_form'];
    form.elements['plan_id'].value = plan_id;

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


// Returns: <div class="item">-string
function format_item(activity_index) {
    var activity = get_activity_array(activity_index);
    var res = "";
    if (activity != null) {
        res += "<div class='item'>";
        res += " <h2>" + activity.name + " <span class='activity_id_wrapper'>(#<span class='activity_id'>" + convert_index_to_id(activity_index) + "</span>)</span></h2>";

        res += "  <div class='summary'>" + activity.summary;
        if (activity.source != null) {
            res += "  <br><span class='source'><?php echo($_lang['ACTIVITY_SOURCE']); ?> " + activity.source + "</span>";
        }
        res += "  </div><!-- END summary -->";
        res += "  <div class='description'>" + activity.desc;
        res += "  </div><!-- END description -->";

        res += "</div><!-- END item -->";
    }
    return res;
}

// Returns: <div class="photo-link">-string
function format_photo_link(activity_index) {
    var activity = get_activity_array(activity_index);
    var res = "";

    if (activity != null) {
        res += "    <div class='photo_link'>";
        if (activity.photo != null) {
            res += activity.photo + " | ";
        }
        res += "        <a href='mailto:corinna@finding-marbles.com?subject=<?php echo($_lang['ACTIVITY_PHOTO_MAIL_SUBJECT']); ?>&body=<?php echo($_lang['ACTIVITY_PHOTO_MAIL_BODY']); ?>' class='less_pronounced'><?php echo($_lang['ACTIVITY_PHOTO_ADD']); ?></a>";
        res += "</span>";
        res += "      </div><!-- END .photo_link -->";
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
function wrap_up_scroll_button(activity_index, block_id) {
    $('#' + block_id).find('.item').replaceWith(format_item(activity_index));
    $('#' + block_id).find('.photo_link').replaceWith(format_photo_link(activity_index));
    publish_plan_id(format_plan_id());
}


function enable_next() {

    $('.next_button').click(function() {

        var current_activity_id = read_activity_id($(this).parent().parent());
        var tmp_activity = get_activity_array(convert_id_to_index(current_activity_id));
        var phase_index = tmp_activity.phase;

        var found = -1;
        for (var i=current_activity_id; i<all_activities.length; i++) {
            tmp_activity = get_activity_array(i);
            if (tmp_activity.phase == phase_index) {
                found = i;
                break;
            }
        }
        if (found == -1) { // Not found in rest of array -> Continue at beginning
            for (var i=0; i<=current_activity_id; i++) {
                tmp_activity = get_activity_array(i);
                if (tmp_activity.phase == phase_index) {
                    found = i;
                    break;
                }
            }
        }
        var block_id = $(this).parents('.activity_block').attr('id');
        wrap_up_scroll_button(found, block_id);

    });
}


function enable_prev() {

    $('.prev_button').click(function() {

        var current_activity_id = read_activity_id($(this).parent().parent());
        var tmp_activity = get_activity_array(convert_id_to_index(current_activity_id));
        var phase_index = tmp_activity.phase;

        var found = -1;
        for (var i=current_activity_id-2; i>=0; i--) {
            tmp_activity = get_activity_array(i);
            if (tmp_activity.phase == phase_index) {
                found = i;
                break;
            }
        }
        if (found == -1) { // Not found in rest of array -> Continue at beginning
            for (var i=all_activities.length-1; i>=current_activity_id-1; i--) {
                tmp_activity = get_activity_array(i);
                if (tmp_activity.phase == phase_index) {
                    found = i;
                    break;
                }
            }
        }
        var block_id = $(this).parents('.activity_block').attr('id');
        wrap_up_scroll_button(found, block_id);

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

function format_block(activity_index, block_number) {
    var activity = get_activity_array(activity_index);

    res = "";
    if (activity != null) {
        var bg = get_contrasting_bg();
        res += "\n\n<div class='activity_block bg" + bg + "' id='" + PHASE_ID_TAG + block_number + "'>\n";
        res += "  <div class='activity-wrapper'>\n";

        res += "      <a href='JavaScript:prev()' class='phase-stepper prev_button' title='<?php echo($_lang['ACTIVITY_PREV']); ?>'>&#9668;</a>\n";

        res += "    <div class='activity-content'>\n";
        res += "      <div class='phase_title'><a href='#' onClick='JavaScript:show_activities_in_phase(" + activity.phase + ")'>" + phase_titles[activity.phase] + "</a></div>";

        res += format_item(activity_index);
        res += format_photo_link(activity_index);

        res += "    </div><!-- END .activity-content -->\n";
        res += "      <a href='JavaScript:next()' class='phase-stepper next_button' title='<?php echo($_lang['ACTIVITY_NEXT']); ?>'>&#9658;</a>\n";

        res += "  </div><!-- END .activity-wrapper -->\n";
        res += "</div><!-- END .activity_block -->\n";
    }
    return res;
}


function format_plan(plan_id) {
    var ids = String(plan_id).split("-");
    var res = '';
    var error_msg = '';
    for(var i=0; i<ids.length; i++) {
        if (ids[i] != '') { // ignore incorrect single '-' at beginning or end of plan_id
            res += format_block(parseInt(ids[i])-1, i);
        }
    }
    return res;
}

//Input: String
function show_plan(plan_id) {
    var plan_id = String(plan_id.match(/[0-9-]+/)); // Ignore everything that's not a digit or '-'
    if (plan_id) {
        var plan = format_plan(plan_id);
        $('#plan').html(plan);
        enable_prev();
        enable_next();
        $('.phase-stepper').addClass('display_table-cell');
        $('.phase-stepper ').removeClass('display_none');
        $('#plan_title_container').addClass('display_none');
        publish_plan_id(plan_id);
    }
}


function show_plan_title(title) {
    $('#plan_title').html(title);
    $('#plan_title_container').removeClass('display_none');
}


function show_activities_in_phase(phase_index) {
    var plan_id = get_activities_in_phase_as_plan_id(phase_index);
    show_plan(plan_id);
    show_plan_title(phase_titles[phase_index]);
    enable_prev();
    enable_next();
    $('.phase-stepper').addClass('display_none');
    $('.phase-stepper').removeClass('display_table-cell');
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

//]]>
</script>

</head>

<body onload="JavaScript:init()">

<div id="header">
    <img id="logo" src="static/images/logo_white.png" alt="Retr-O-Mat" title="Retr-O-Mat">
    <!--
    <select class="languageswitcher" onchange="switchLanguage(this.value)">
        <option value="en" <?php echo($selected_EN); ?> >English</option>
        <option value="de" <?php echo($selected_DE); ?> >Deutsch</option>
        <option value="es" <?php echo($selected_ES); ?> >Espa&ntilde;ol</option>
        <option value="nl" <?php echo($selected_NL); ?> >Nederlands</option>
    </select>
    -->

      <span id="navi"><a href="http://finding-marbles.com/retr-o-mat/what-is-a-retrospective/">What is a retrospective?</a> |
        <a href="http://finding-marbles.com/retr-o-mat/about-retr-o-mat/">About Retr-O-Mat</a> |
          <!--
          <a href="http://plans-for-retrospectives.com/getting-started-with-retrospectives-book/index.html">Getting Started with Retrospectives</a> |
          <a href="http://finding-marbles.com">By Finding-Marbles.com</a> |
          -->
        <a href="https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ">Add activity</a>
      </span>
</div>

<div id="pitch">
    <div class="content">
        <?php echo($_lang['INDEX_PITCH']); ?>
    </div>
</div>
<div id="book">
    <div class="content" style="display: table;">
            You like to click around in Retr-O-Mat?
            Then you might like our <a href="/analog/index.html">upcoming product</a>!
    </div>
</div>
<div class="plan_id">
    <div class="content">
        <div id="header-print">
            Retr-O-Mat <span class="finding_marbles">(plans-for-retrospectives.com) <?php echo($_lang['PRINT_HEADER']); ?></span>
        </div>
        <div>
            <?php echo($_lang['INDEX_PLAN_ID']); ?>
            <form action="JavaScript:show_plan($('.plan_id_input').val())" name="plan_id_form" class="plan_id_form">
                <input type="text" size="12" name="plan_id" class="plan_id_input" value="">
                <input type="submit" class="plan_id_submit" value="<?php echo($_lang['INDEX_BUTTON_SHOW']); ?>">
            </form>
        </div>
        <div class="new_plan"><a href="JavaScript:show_random_plan()"><?php echo($_lang['INDEX_RANDOM_RETRO']); ?></a>
        </div>
    </div>
</div>
<div id="plan_title_container" class="display_none">
    <div class="content"><?php echo($_lang['INDEX_ALL_ACTIVITIES_FOR_PHASE']); ?> <span id="plan_title" class="uppercase">Replaced by JS</span>
    </div>
</div>

<div id="plan">
    <noscript>
        <?php echo($_lang['ERROR_NO_SCRIPT']); ?>
    </noscript>

</div><!-- END plan -->

<div id="mini-about">
    <div class="content">
        <?php echo($_lang['INDEX_MINI_ABOUT']); ?>
        <a href="https://docs.google.com/a/finding-marbles.com/spreadsheet/viewform?formkey=dEZZV1hPYWVZUDc2MFNsUEVRdXpMNWc6MQ"><?php echo($_lang['INDEX_MINI_ABOUT_SUGGEST']); ?></a>!
    </div>
</div>

<div id="mini-team">
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