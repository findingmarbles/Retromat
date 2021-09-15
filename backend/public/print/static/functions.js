last_block_bg = -1; // Stores bg of last block so that no consecutive blocks have the same background

function init() {
    var urlParams = getUrlVars();
    var plan_id = urlParams.id;
    var phase = urlParams.phase;

    if (typeof all_activities === "undefined") {
        $.getJSON("/activities.json", {locale: getLocale()})
            .fail(function (jqxhr, textStatus, error) {
                console.log("Loading activities via AJAX request failed: " + textStatus + ", " + jqxhr.status + ", " + error);
            })
            .done(function (json) {
                all_activities = json;
                if (plan_id) {
                    publish_plan(plan_id, phase);
                } else {
                    publish_random_plan();
                }
                publish_footer_stats();
            });
    } else {
        if (plan_id) {
            publish_plan(plan_id, phase);
        } else {
            publish_random_plan();
        }
        publish_footer_stats();
    }
}

function getLocale() {
    var pathPart1 = window.location.pathname.split('/')[1];
    if ('app_dev.php' == pathPart1) {
        return window.location.pathname.split('/')[2];
    } else {
        return pathPart1;
    }
}

// From http://jquery-howto.blogspot.de/2009/09/get-url-parameters-values-with-jquery.html
// Read a page's GET URL variables and return them as an associative array
function getUrlVars() {
    var vars = [], hash;
    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    for (var i = 0; i < hashes.length; i++) {
        hash = hashes[i].split('=');
        vars.push(hash[0]);
        vars[hash[0]] = hash[1];
    }
    return vars;
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
    for (var i = 0; i < ids.length; i++) {
        if (ids[i] != '') { // ignore incorrect single '-' at beginning or end of plan_id
            activity_block = get_activity_block(parseInt(ids[i]) - 1, i);
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
    return Math.floor(Math.random() * upper_limit);
}

function populate_activity_block(activity_index, activity_block) {
    var activity = get_activity_array(activity_index);
    var id = convert_index_to_id(activity_index);

    $(activity_block).addClass('js_activity' + activity_index);

    $(activity_block).find('.js_fill_phase_title').html(phase_titles[activity.phase]);
    $(activity_block).find('.js_fill_phase_link').prop('href', '?id=' + get_activities_in_phase_as_plan_id(activity.phase) + '&phase=' + activity.phase);
    $(activity_block).find('.js_fill_name').html(activity.name);
    $(activity_block).find('.js_fill_activity_link').prop('href', '?id=' + id);
    $(activity_block).find('.js_fill_id').html(id);
    $(activity_block).find('.js_fill_summary').html(activity.summary);
    $(activity_block).find('.js_fill_source').html(activity.source);
    $(activity_block).find('.js_fill_description').html(activity.desc);
    $(activity_block).find('.js_fill_photo-link').html(get_photo_string(activity_index));

}

function convert_index_to_id(index) {
    return parseInt(index) + 1;
}

/************ BEGIN Phase Navigation (Prev, Next, All activities in Phase) ************/

function enable_phase_browsing() {
    enable_prev();
    enable_next();
}

function enable_prev() {
    $('.js_prev_button').click(function () {
        var activity_index = convert_id_to_index(read_activity_id($(this).parent().parent()));
        enable_phase_stepper(activity_index, get_index_of_prev_activity_in_phase);
        prefix_html_title();
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
    for (var i = activity_index - 1; i >= 0; i--) {
        candidate = get_activity_array(i);
        if (candidate.phase == phase_index) {
            found_index = i;
            break;
        }
    }
    if (found_index == -1) { // Not found in rest of array -> Continue at beginning
        for (var i = all_activities.length - 1; i >= activity_index; i--) {
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

    for (var i = 0; i < current_activities.length; i++) {
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
    $('.js_next_button').click(function () {
        var activity_index = convert_id_to_index(read_activity_id($(this).parent().parent()));
        enable_phase_stepper(activity_index, get_index_of_next_activity_in_phase);
        prefix_html_title();
    });
}

function get_index_of_next_activity_in_phase(activity_index, phase_index) {
    var found_index = -1;
    var candidate;
    for (var i = activity_index + 1; i < all_activities.length; i++) {
        candidate = get_activity_array(i);
        if (candidate.phase == phase_index) {
            found_index = i;
            break;
        }
    }
    if (found_index == -1) { // Not found in rest of array -> Continue at beginning
        for (var i = 0; i < activity_index; i++) {
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

    for (var i = 0; i < phase_activities.length; i++) {
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

function prefix_html_title() {
    if (0 != document.title.indexOf('Retromat')) {
        document.title = 'Retromat: ' + document.title;
    }
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
    if (is_time_for_something_different()) {
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
    for (var i = 0; i < all_activities.length; i++) {
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
    for (var i = 0; i < NUMBER_OF_REGULAR_PHASES; i++) {
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
    for (var i = 0; i < NUMBER_OF_REGULAR_PHASES; i++) {
        res *= get_number_of_activities_in_phase(i);
    }
    res += get_number_of_activities_in_phase(PHASE_SOMETHING_DIFFERENT);
    return res;
}

function get_combinations_string() {
    var res = '';
    for (var i = 0; i < NUMBER_OF_REGULAR_PHASES; i++) {
        if (i != 0) {
            res += "x";
        }
        res += get_number_of_activities_in_phase(i);
    }
    res += '+' + get_number_of_activities_in_phase(PHASE_SOMETHING_DIFFERENT);
    return res;
}

function publish_footer_stats() {
    $(".js_footer_no_of_activities").html(create_link_to_all_activities(all_activities.length));
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
    for (var i = 0; i < all_activities.length; i++) {
        isMatch = has_found_match(all_activities[i], keyword);
        if (isMatch) {
            plan_id += convert_index_to_id(i) + '-';
        }
    }
    if (plan_id.length > 0) {
        plan_id = plan_id.substr(0, plan_id.length - 1)
    }

    return plan_id; // Remove trailing '-'

}

function has_found_match(activity, keyword) {
    var regEx = new RegExp(keyword, "i");
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

/************ END PopUps Plan Navigation ************/

function switchLanguage(new_lang) {
    new_url = location.protocol + '//' + location.host + '/' + new_lang + '/';
    window.open(new_url, "_self");
}

