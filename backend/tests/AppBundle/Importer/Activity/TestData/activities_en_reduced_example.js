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
//  duration:  "",
//  source:    "",
//  more:      "", // a link
//  suitable:  "",
//};
// Values for duration: "<minMinutes>-<maxMinutes> perPerson"
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
duration:  "5-10 numberPeople",
suitable:   "iteration, release, project, immature"
};
all_activities[122] = {
phase:     1,
name:      "Find your Focus Principle",
summary:   "Discuss the 12 agile principles and pick one to work on",
desc:      "Print the <a href='http://www.agilemanifesto.org/principles.html'>principles of the Agile Manifesto</a> \
onto cards, one principle \
per card. If the group is large, split it and provide each smaller group with \
their own set of the principles. \
<br><br> \
Explain that you want to order the principles according to the following question: \
'How much do we need to improve regarding this principle?'. In the end the \
principle that is the team's weakest spot should be on top of the list. \
<br><br> \
Start with a random principle, discuss what it means and how much need for \
improvement you see, then place it in the middle. \
Pick the next principle, discuss what it means and sort it relatively to the other \
principles. You can propose a position depending on the previous discussion and \
move from there by comparison. \
Repeat this until all cards are sorted. \
<br><br> \
Now consider the card on top: This is presumeably the most needed and most urgent \
principle you should work on. How does the team feel about it? Does everyone still \
agree? What are the reasons there is the biggest demand for change here? Should you \
compare to the second or third most important issue again? If someone would now \
rather choose the second position, why?",
source:    "<a href='http://www.agilesproduktmanagement.de/'>Tobias Baier</a>",
duration:  "long",
suitable:  "iteration, project, release"
};
// Values for duration: "<minMinutes>-<maxMinutes> perPerson"
// Values for suitable: "iteration, realease, project, introverts, max10People, rootCause, smoothSailing, immature, largeGroup"
