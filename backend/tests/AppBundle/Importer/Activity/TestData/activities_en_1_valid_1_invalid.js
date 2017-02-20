var phase_titles = ['Set the stage', 'Gather data', 'Generate insights', 'Decide what to do', 'Close the retrospective', 'Something completely different'];

// BIG ARRAY OF ALL ACTIVITIES
// Mandatory: id, phase, name, summary, desc
// Example:
//all_activities[i] = {
//  id:        i+1,
//  phase:     int in {1-5},
//  name:      "",
//  summary:   "",
//  desc:      "Multiple \
//              Lines",
//  durationDetail:  "",
//  duration:    "Short | Medium | Long | Flexible",
//  stage:    "All" or one or more of "Forming, Norming, Storming, Performing, Stagnating, Adjourning",
//  source:    "",
//  more:      "", // a link
//  suitable:  "",
//};
// Values for durationDetail: "<minMinutes>-<maxMinutes> perPerson"
// Values for suitable: "iteration, realease, project, introverts, max10People, rootCause, smoothSailing, immature, largeGroup"

all_activities = [];
all_activities[0] = {
phase:     0,
name:      "ESVP",
summary:   "How do participants feel at the retro: Explorer, Shopper, Vacationer, or Prisoner?",
desc:      "Prepare a flipchart with areas for E, S, V, and P. Explain the concept: <br>\
<ul>\
    <li>Explorer: Eager to dive in and research what did and didn't work and how to improve.</li>\
    <li>Shopper: Positive attitude. Happy if one good things comes out.</li>\
    <li>Vacationer: Reluctant to actively take part but the retro beats the regular work.</li>\
    <li>Prisoner: Only attend because they (feel they) must.</li>\
</ul>\
Take a poll (anonymously on slips of paper). Count out the answers and keep track on the flipchart \
for all to see. If trust is low, deliberately destroy the votes afterwards to ensure privacy. Ask \
what people make of the data. If there's a majority of Vacationers or Prisoners consider using the \
retro to discuss this finding.",
source:  source_agileRetrospectives,
durationDetail:  "5-10 numberPeople",
duration:    "Short",
stage:    "Forming, Storming",
suitable:   "iteration, release, project, immature"
};
all_activities[1] = {
phase:     9,
name:      "",
summary:   "",
desc:      "Prepare a flipchart with a drawing of storm, rain, clouds and sunshine.\
Each participant marks their mood on the sheet.",
duration:    "Short",
stage:    "All",
source:  source_agileRetrospectives,
};
// Values for duration: "<minMinutes>-<maxMinutes> perPerson"
// Values for suitable: "iteration, realease, project, introverts, max10People, rootCause, smoothSailing, immature, largeGroup"
