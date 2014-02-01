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
//  photo: "" // a link
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
duration:  "5-10 numberPeople",
source:  source_agileRetrospectives,
suitable:   "iteration, release, project, immature"
};
all_activities[1] = {
phase:     0,
name:      "Weather Forecast",
summary:   "Participants mark their 'weather' (mood) on a flipchart",
desc:      "Prepare a flipchart with a drawing of storm, rain, clouds and sunshine.\
Each participant marks their mood on the sheet.",
source:  source_agileRetrospectives
};
all_activities[2] = {
phase:     0,
name:      "Check In - Quick Question", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Ask one question that each participant answers in turn",
desc:      "In round-robin each participant answers the same question (unless they say 'I pass'). \
Sample questions: <br>\
<ul>\
    <li>In one word - What do you need from this retrospective?</li>\
        Address concerns, e.g. by writing it down and setting it - physically and mentally - aside</li>\
    <li>In this retrospective - If you were a car, what kind would it be?</li>\
    <li>What emotional state are you in (e.g. 'glad', 'mad', 'sad', 'scared'?)</li>\
</ul><br>\
Avoid evaluating comments such as 'Great'. 'Thanks' is okay.",
source:  source_agileRetrospectives
};
all_activities[3] = {
phase:     1,
name:      "Timeline",
summary:   "Participants write down significant events and order them chronologically",
desc:      "Divide into groups with 5 or less people each. Distribute cards and markers. \
Give participants 10min to note down memorable and / or personally significant events. \
It's about gathering many perspectives. Consensus would be detrimental. All participants \
post their cards and order them. It's okay to add cards on the fly. Analyze.<br>\
Color Coding can help to see patterns, e.g.:<br>\
<ul>\
    <li>Emotions</li>\
    <li>Events (technical, organization, people, ...)</li>\
    <li>Function (tester, developer, manager, ...)</li>\
</ul>",
duration:  "60-90 timeframe",
source:  source_agileRetrospectives,
suitable: "iteration, introverts"
};
all_activities[4] = {
phase:     1,
name:      "Analyze Stories",
summary:   "Walk through each story handled by the team and look for possible improvements",
desc:      "Preparation: Collect all stories handled during the iteration and bring them along to \
the retrospective.<br> \
In a group (10 people max.) read out each story. For each one discuss whether it went \
well or not. If it went well, capture why. If not discuss what you could do differently  \
in the future.<br>\
Variants: You can use this for support tickets, bugs or any combination of work \
done by the team.",
source:    source_findingMarbles,
suitable: "iteration, max10people"
};
all_activities[5] = {
phase:     1,
name:      "Like to like",
summary:   "Participants match quality cards to their own Start-Stop-Continue-proposals",
desc:      "Preparation: ca. 20 quality cards, i.e. colored index cards with unique words\
such as <i>fun, on time, clear, meaningful, awesome, dangerous, nasty</i><br> \
Each team member has to write at least 9 index cards: 3 each with things to \
start doing, keep doing and stop doing. Choose one person to be the first judge. \
The judge turns the first quality card. From their own cards each member \
chooses the best match for this word and places it face down on the table.\
The last one to choose has to take their card back on their hand. The judge shuffles all \
submitted cards, turns them one by one and rules the best fit = winning card. \
All submitted cards are discarded. The submitter of the winning card receives \
the quality card. The person left of the judge becomes the new judge.<br> \
Stop when everyone runs out of cards (6-9 rounds). Whoever has the most quality \
cards wins. Debrief by asking for takeaways. <br>\
(Game is based on 'Apples to Apples')",
source:    source_agileRetrospectives,
duration:  "30-40",
suitable: "iteration, introverts"
};
all_activities[6] = {
phase:     1,
name:      "Mad Sad Glad",
summary:   "Collect events when team members felt mad, sad, or glad and find the sources",
desc:      "Put up three posters labeled 'mad', 'sad', and 'glad' (or '>:), :(, :) alternatively). Team members write down \
one event per color coded card, when they've felt that way. When the time is up \
have everyone post their cards to the appropriate posters. Cluster the cards on \
each poster. Ask the group for cluster names. <br>\
Debrief by asking:\
<ul>\
    <li>What's standing out? What's unexpected?</li>\
    <li>What was difficult about this task? What was fun?</li>\
    <li>What patterns do you see? What do they mean for you as a team?</li>\
    <li>Suggestions on how to continue?</li>\
</ul>",
source:    source_agileRetrospectives,
duration:  "15-25",
photo:    "<a href='static/images/activities/7_Mad-Sad-Glad.jpg' rel='lightbox[activity6]' title='Contributed by Chloe Gachet'>View Photo</a>",
suitable: "iteration, release, project, introverts"
};
all_activities[7] = {
phase:     2,
name:      "5 Whys",
summary:   "Drill down to the root cause of problems by repeatedly asking 'Why?'",
desc:      "Divide the participants into small groups (<= 4 people) and give \
each group one of the top identified issues. Instructions for the group:\
<ul>\
    <li>One person asks the others 'Why did that happen?' repeatedly to find the root cause or a chain of events</li>\
    <li>Record the root causes (often the answer to the 5th 'Why?')</li>\
</ul>\
Let the groups share their findings.",
source:    source_agileRetrospectives,
duration:  "15-20",
suitable: "iteration, release, project, root_cause"
};
all_activities[8] = {
phase:     2,
name:      "Learning Matrix",
summary:   "Team members brainstorm in 4 categories to quickly list issues",
desc:      "After discussing the data from Phase 2 show a flip chart with 4 quadrants labeled \
':)', ':(', 'Idea!', and 'Appreciation'. Hand out sticky notes. \
<ul>\
    <li>The team members can add their input to any quadrant. One thought per sticky note. </li>\
    <li>Cluster the notes.</li>\
    <li>Hand out 6-10 dots for people to vote on the most important issues.</li>\
</ul>\
This list is your input for Phase 4.",
source:    source_agileRetrospectives,
duration:  "20-25",
suitable: "iteration"
};
all_activities[9] = {
phase:     2,
name:      "Brainstorming / Filtering",
summary:   "Generate lots of ideas and filter them against your criteria",
desc:      "Lay out the rules of brainstorming, and the goal: To generate lots of new ideas\
which will be filtered <em>after</em> the brainstorming.\
<ul>\
    <li>Let people write down their ideas for 5-10 minutes</li>\
    <li>Go around the table repeatedly always asking one idea each, until all ideas are on the flip chart</li>\
    <li>Now ask for filters (e.g. cost, time investment, uniqueness of concept, brand appropriateness, ...). \
        Let the group choose 4.</li>\
    <li>Apply each filter and mark ideas that pass all 4.</li>\
    <li>Which ideas will the group carry forward? Does someone feel strongly about one of the ideas?\
        Otherwise use majority vote. </li>\
</ul>\
The selected ideas enter Phase 4.",
source:    source_agileRetrospectives,
more:     "<a href='http://www.mpdailyfix.com/the-best-brainstorming-nine-ways-to-be-a-great-brainstorm-lead/'>\
    Nine Ways To Be A Great Brainstorm Lead</a>",
duration:  "40-60",
suitable: "iteration, release, project, introverts"
};
all_activities[10] = {
phase:     3,
name:      "Circle of Questions",
summary:   "Asking and answering go around the team circle - an excellent way to reach consensus",
desc:      "Everyone sits in a circle. Begin by stating that you'll go round asking questions to find out \
what you want to do as a group. You start by asking your neighbor the first question, e.g. \
'What is the most important thing we should start in the next iteration?' Your \
neighbor answers and asks her neighbor a related question. Stop when consensus emerges or \
the time is up. Go around at least once, so that everybody is heard!",
source:    source_agileRetrospectives,
duration:  "30+ groupsize",
suitable: "iteration, release, project, introverts"
};
all_activities[11] = {
phase:     3,
name:      "Dot Voting - Start, Stop, Continue",
summary:   "Brainstorm what to start, stop & continue and pick the top initiatives",
desc:      "Divide a flip chart into boxes headed with  'Start', 'Continue' and 'Stop'. \
Ask your participants to write concrete proposals for each category - 1 \
idea per index card. Let them write in silence for a few minutes. \
Let everyone read out their notes and post them to the appropriate category. \
Lead a short discussion on what the top 20% beneficial ideas are. Vote on it by distributing dots\
or X's with a marker, e.g. 1, 2, and 3 dots for each person to distribute. \
The top 2 or 3 become your action items.\
<br><br>\
(Check out <a href='http://agileretroactivities.blogspot.co.at/search/label/innovation'>Paulo Caroli's 'Open the Box'</a> for an awesome variation of this activity.)",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[12] = {
phase:     3,
name:      "SMART Goals",
summary:   "Formulate a specific and measurable plan of action",
desc:      "Introduce <a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART goals</a> \
(specific, measurable, attainable, relevant, timely) and examples for SMART vs not so \
smart goals, e.g.'We&apos;ll study stories before pulling them by talking about them with the \
product owner each Wednesday at 9am' vs. 'We'll get to know the stories before they \
are in our sprint backlog'.<br>\
Form groups around the issues the team wants to work on. Each group identifies 1-5 \
concrete steps to reach the goal. Let each group present their results. All participants should agree \
on the 'SMART-ness' of the goals. Refine and confirm.",
source:    source_agileRetrospectives,
duration:  "20-60 groupsize",
suitable: "iteration, release, project"
};
all_activities[13] = {
phase:     4,
name:      "Feedback Door - Numbers",
summary:   "Gauge participants' satisfaction with the retro on a scale from 1 to 5 in minimum time",
desc:      "Put sticky notes on the door with the numbers 1 through 5 on them. 1 is the topmost and best, \
5 the lowest and worst.\
When ending the retrospective, ask your participants to put a sticky to the number they feel \
reflects the session. The sticky can be empty or have a comment or suggestion on it.",
source:    "ALE 2011, " + source_findingMarbles,
duration:  "2-3",
suitable: "iteration, largeGroups"
};
all_activities[14] = {
phase:     4,
name:      "Appreciations",
summary:   "Let team members appreciate each others and end positively",
desc:      "Start by giving a sincere appreciation of one of the participants. \
It can be anything they contributed: help to the team or you, a solved problem, ...\
Then invite others and wait for someone to work up the nerve. Close, when no one \
talked for a minute.",
source:    source_agileRetrospectives + " who took it from 'The Satir Model: Family Therapy and Beyond'",
duration:  "5-30 groupsize",
suitable: "iteration, release, project"
};
all_activities[15] = {
phase:     4,
name:      "Helped, Hindered, Hypothesis",
summary:   "Get concrete feedback on how you facilitated",
desc:      "Prepare 3 flip chart papers titled 'Helped', 'Hindered', and 'Hypothesis' \
(suggestions for things to try out). \
Ask participants to help you grow and improve as a facilitator by writing \
you sticky notes and signing their initials so that you may ask questions later.",
source:    source_agileRetrospectives,
duration:  "5-10",
suitable: "iteration, release"
};
all_activities[16] = {
phase:     4, // 5 geht auch
name:      "SaMoLo (More of, Same of, Less of)",
summary:   "Get course corrections on what you do as a facilitator",
desc:      "Divide a flip chart in 3 sections titled 'More of', 'Same of', and 'Less of'. \
Ask participants to nudge your behaviour into the right direction: Write stickies \
with what you should do more, less and what is exactly right. Read out and briefly \
discuss the stickies section-wise.",
more:      "<a href='http://www.scrumology.net/2010/05/11/samolo-retrospectives/'>David Bland's experiences</a>",
source:    "<a href='http://fairlygoodpractices.com/samolo.htm'>Fairly good practices</a>",
duration:  "5-10",
suitable: "iteration, release, project"
};
all_activities[17] = {
phase:     0,
name:      "Check In - Amazon Review",
summary:   "Review the iteration on Amazon. Don't forget the star rating!",
desc:      "Each team member writes a short review with: \
<ul>\
    <li>Title</li>\
    <li>Content</li>\
    <li>Star rating (5 stars is the best) </li>\
</ul>\
Everyone reads out their review. Record the star ratings on a flip chart.<br>\
Can span whole retrospective by also asking what is recommended about the sprint and what not.",
source:    "<a href='http://blog.codecentric.de/2012/02/unser-sprint-bei-amazon/'>Christian Hei&szlig;</a>",
duration:  "10",
suitable: "release, project"
};
all_activities[18] = {
phase:     1,
name:      "Speedboat / Sailboat",
summary:   "Analyze what forces push you forward and what pulls you back",
desc:      "Draw a speedboat onto a flip chart paper. Give it a strong motor as well \
as a heavy anchor. Team members silently write on sticky notes what propelled the team forward \
and what kept it in place. One idea per note. Post the stickies motor and anchor respectively. \
Read out each one and discuss how you can increase 'motors' and cut 'anchors'.",
source:    "<a href='http://leadinganswers.typepad.com/leading_answers/2007/10/calgary-apln-pl.html'>Mike Griffiths</a>, who adapted it from " + source_innovationGames,
duration:  "10-15 groupSize",
photo:    "<a href='static/images/activities/19_Speedboat.jpg' rel='lightbox[activity18]' title='Contributed by Corinna Baldauf'>View Photo</a>",
suitable: "iteration, release"
};
all_activities[19] = {
phase:     2,
name:      "Perfection Game",
summary:   "What would make the next sprint a perfect 10 out of 10?",
desc:      "Prepare a flip chart with 2 columns, a slim one for 'Rating' and a wide one for 'Actions'. \
Everyone rates the last sprint on a scale from 1 to 10. Then they have to suggest what action(s) \
would make the next sprint a perfect 10.",
source:    "<a href='http://www.benlinders.com/2011/getting-business-value-out-of-agile-retrospectives/'>Ben Linders</a>",
suitable: "iteration, release"
};
all_activities[20] = {
phase:     3,
name:      "Merge",
summary:   "Condense many possible actions down to just two the team will try",
desc:      "Hand out index cards and markers. Tell everyone to write down the two actions they \
want to try next sprint - as concretely as possible \
(<a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART</a>). Then everyone pairs \
up with their neighbor and both together must merge their actions into a single list with \
two actions. The pairs form groups of 4. Then 8. Now collect every group's two action items \
and have a vote on the final two.",
source:    "Lydia Grawunder & Sebastian Nachtigall",
duration:  "15-30 groupSize",
photo:    "<a href='http://1.bp.blogspot.com/-dLemopaMJ9o/UhKRRRBMFkI/AAAAAAAAC78/6hH5yQKucYA/s320/photo+4(1).JPG' rel='lightbox[activity20]' title='Taken by Paulo Caroli'>View Photo</a>",
suitable: "iteration, release, project, largeGroups"
};
all_activities[21] = {
phase:     0,
name:      "Temperature Reading",
summary:   "Participants mark their 'temperature' (mood) on a flipchart",
desc:      "Prepare a flipchart with a drawing of a thermometer from freezing to body temperature to hot. \
Each participant marks their mood on the sheet.",
source:  source_unknown
};
all_activities[22] = {
phase:     4,
name:      "Feedback Door - Smilies",
summary:   "Gauge participants' satisfaction with the retro in minimum time using smilies",
desc:      "Draw a ':)', ':|', and ':(' on a sheet of paper and tape it against the door. \
When ending the retrospective, ask your participants to mark their satisfaction \
with the session with an 'x' below the applicable smily.",
source:    "<a href='http://boeffi.net/tutorials/roti-return-on-time-invested-wie-funktionierts/'>Boeffi</a>",
duration:  "2-3",
suitable: "iteration, largeGroups"
};
all_activities[23] = {
phase:     3,
name:      "Open Items List",
summary:   "Participants propose and sign up for actions",
desc:      "Prepare a flip chart with 3 columns titled 'What', 'Who', and 'Due'. \
Ask one participant after the other, what they want to do to advance \
the team. Write down the task, agree on a 'done by'-date and let them sign \
their name. <br>\
If someone suggests an action for the whole team, the proposer needs to get \
buy-in (and signatures) from the others.",
source:    source_findingMarbles + ", inspired by <a href='http://lwscologne.wordpress.com/2012/05/08/11-treffen-der-limited-wip-society-cologne/#Retrospektiven'>this list</a>",
duration:  "10-15 groupSize",
suitable: "iteration, release, smallGroups"
};
all_activities[24] = {
phase:     2,
name:      "Cause-Effect-Diagram",
summary:   "Find the source of problems whose origins are hard to pinpoint and lead to endless discussion",
desc:      "Write the problem you want to explore on a sticky note and put it in the middle of a whiteboard. \
Find out why that is a problem by repeatedly asking 'So what?'. Find out the root causes \
by repeatedly asking 'Why (does this happen)?' Document your findings by \
writing more stickies and showing causal relations with arrows. Each sticky can have more than \
one reason and more than one consequence<br> \
Vicious circles are usually good starting points for actions. If you can break their bad \
influence, you can gain a lot.",
source:    "<a href='http://blog.crisp.se/2009/09/29/henrikkniberg/1254176460000'>Henrik Kniberg</a>",
more:      "<a href='http://finding-marbles.com/2011/08/04/cause-effect-diagrams/'>Corinna's experiences</a>",
duration:  "20-60 complexity",
photo:    "<a href='http://www.plans-for-retrospectives.com/static/images/activities/25_Cause-Effect-Diagramm.jpg' rel='lightbox[activity24]' title='Contributed by Corinna Baldauf'>View Photo</a>",
suitable: "release, project, smallGroups, complex"


};
all_activities[25] = {
phase:     2,
name:      "Speed Dating",
summary:   "Each team member explores one topic in depth in a series of 1:1 talks",
desc:      "Each participant writes down one topic they want to explore, i.e. something they'd like to \
change. Then form pairs and spread across the room. Each pair discusses both topics \
and ponders possible actions - 5 minutes per participant (topic) - one after the other. \
After 10 minutes the pairs break up to form new pairs. Continue \
until everyone has talked to everyone else. <br>\
If the group has an odd number of members, the facilitator is part of a pair but the partner \
gets all 10 minutes for their topic.",
source:    source_kalnin,
duration:  "10 perPerson",
suitable: "iteration, release, smallGroups"
};
all_activities[26] = {
phase:     5,
name:      "Retrospective Cookies",
summary:   "Take the team out to eat and spark discussion with retrospective fortune cookies",
desc:      "Invite the team out to eat, preferably Chinese if you want to stay in theme ;) \
Distribute fortune cookies and go around the table opening the cookies and \
discussing their content. Example 'fortunes': \
<ul>\
    <li>What was the most effective thing you did this Sprint, and why was it so successful?</li>\
    <li>Did the burndown reflect reality? Why or why not?</li>\
    <li>What do you contribute to the development community in your company? What could you contribute?</li>\
    <li>What was our Team's biggest impediment this Sprint?</li>\
</ul>\
You can <a href='http://weisbart.com/cookies/'>order retrospective cookies from Weisbart</a> \
or bake your own, e.g. if English is not the team's native language.",
source:    "<a href='http://weisbart.com/cookies/'>Adam Weisbart</a>",
duration:  "90-120",
suitable: "iteration, release, smallGroups"
};
all_activities[27] = {
phase:     5,
name:      "Take a Walk",
summary:   "Go to the nearest park and wander about and just talking",
desc:      "Is there nice weather outside? Then why stay cooped up inside, when walking fills your brain with oxygen \
and new ideas 'off the trodden track'. Get outside and take a walk in the nearest park. Talk will \
naturally revolve around work. This is a nice break from routine when things run relatively smoothly and \
you don't need visual documentation to support discussion. Mature teams can easily spread ideas and reach \
consensus even in such an informal setting.",
source:    source_findingMarbles,
duration:  "60-90",
suitable: "iteration, release, smallGroups, smoothSailing, mature"
};
all_activities[28] = {
phase:     3,
name:      "Circles &amp; Soup / Circle of Influence",
summary:   "Create actions based on how much control the team has to carry them out",
desc:      "Prepare a flip chart with 3 concentric circles, each big enough to put stickies in. Label them \
'Team controls - Direct action', 'Team influences - Persuasive/recommending action' and 'The soup - Response action', \
from innermost to outermost circle respectively. ('The soup' denotes the wider system the team is embedded into.) \
Take your insights from the last phase and put them in the appropriate circle.<br> \
The participants write down possible actions in pairs of two. Encourage them to concentrate on issues in their \
circle of influence. The pairs post their action plans next to the respective issue and read it out loud. \
Agree on which plans to try (via discussion, majority vote, dot voting, ...)",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/07/26/circles-and-soup/'>Diana Larsen</a> \
who adapted it from 'Seven Habits of Highly Effective People' by Stephen Covey and \
'<a href='http://www.ayeconference.com/wiki/scribble.cgi?read=CirclesOfControlInfluenceAndConcern'>CircleofInfluenceAndConcern</a>' by Jim Bullock",
suitable: "iteration, release, project, stuck, immature"
};
all_activities[29] = {
phase:     5,
name:      "Dialogue Sheets",
summary:   "A structured approach to a discussion",
desc:      "A dialogue sheet looks a little like a board game board. There are \
<a href='http://www.softwarestrategy.co.uk/dlgsheets/available.html'>several different sheets available</a>. \
Choose one, print it as large as possible (preferably A1) and follow its instructions.",
source:    "<a href='http://www.softwarestrategy.co.uk/dlgsheets/available.html'>Allen Kelly at Software Strategy</a>",
duration:  "90-120",
suitable: "iteration, release, project"
};
all_activities[30] = {
phase:     0,
name:      "Check In - Draw the Iteration",
summary:   "Participants draw some aspect of the iteration",
desc:      "Distribute index cards and markers. Set a topic, e.g. one of the following: \
<ul>\
    <li>How did you feel during the iteration?</li>\
    <li>What was the most remarkable moment?</li>\
    <li>What was the biggest problem?</li>\
    <li>What did you long for?</li>\
</ul>\
Ask the team members to draw their answer. Post all drawings on a whiteboard. For each drawing \
let people guess what it means, before the artist explains it.<br> \
Metaphors open new viewpoints and create a shared understanding.",
source:    source_findingMarbles + ", adapted from \
<a href='http://vinylbaustein.net/2011/03/24/draw-the-problem-draw-the-challenge/'>Thorsten Kalnin</a> \
and Olivier Gourment",
duration:  "5 + 3 per person",
suitable: "iteration, release, project"
};
all_activities[31] = {
phase:     0,
name:      "Emoticon Project Gauge",
summary:   "Help team members express their feelings about a project and address root causes early",
desc:      "Prepare a flipchart with faces expressing various emotions such as: \
<ul>\
    <li>shocked / surprised</li>\
    <li>nervous / stressed</li>\
    <li>unempowered / constrained</li>\
    <li>confused</li>\
    <li>happy</li>\
    <li>mad</li>\
    <li>overwhelmed</li>\
</ul>\
Let each team member choose how they feel about the project. This is a fun and effective way to \
surface problems early. You can address them in the subsequent phases.",
source:    "Andrew Ciccarelli",
duration:  "10 for 5 people",
photo:    "<a href='static/images/activities/32_Emoticons.jpg' rel='lightbox[activity31]' title='Contributed by Ruud Rietveld'>View Photo</a>",
suitable: "iteration, release"
};
all_activities[32] = {
phase:     1,
name:      "Proud & Sorry",
summary:   "What are team members proud or sorry about?",
desc:      "Put up two posters labeled 'proud' and 'sorry'. Team members write down \
one instance per sticky note. When the time is up have everyone read \
out their note and post it to the appropriate poster.<br>\
Start a short conversation e.g. by asking:\
<ul>\
    <li>Did anything surprise you?</li>\
    <li>What patterns do you see? What do they mean for you as a team?</li>\
</ul>",
source:    source_agileRetrospectives,
duration:  "10-15",
suitable: "iteration, release"
};
all_activities[33] = {
phase:     4,
name:      "Shower of Appreciation",
summary:   "Listen to others talk behind your back - and only the good stuff!",
desc:      "Form groups of 3. Each group arranges their chairs so that 2 chairs \
face each other and the third one has its back turned, like this: >^<. \
The two people in the chairs that face each other talk about the third person for 2 minutes. \
They may only say positive things and nothing that was said may be reduced in meaning by \
anything said afterwards. <br>\
Hold 3 rounds so that everyone sits in the shower seat once.",
source:    '<a href="http://www.miarka.com/de/2010/11/shower-of-appreciation-or-talking-behind-ones-back/">Ralph Miarka</a>',
duration:  "10-15",
suitable: "iteration, release, matureTeam"
};
all_activities[34] = {
phase:     1,
name:      "Agile Self-Assessment",
summary:   "Assess where you are standing with a checklist",
desc:      "Print out a checklist that appeals to you, e.g.:\
<ul>\
    <li><a href='http://www.crisp.se/gratis-material-och-guider/scrum-checklist'>Henrik Kniberg's excellent Scrum Checklist</a></li>\
    <li><a href='http://finding-marbles.com/2011/09/30/assess-your-agile-engineering-practices/'>Self-assessment of agile engineering practices</a></li>\
    <li><a href='http://agileconsortium.blogspot.de/2007/12/nokia-test.html'>Nokia Test</a></li>\
</ul>\
Go through them in the team and discuss where you stand and if you're on the right track. <br>\
This is a good activity after an iteration without major events.",
source:    source_findingMarbles,
duration:  "10-25 minutes depending on the list",
suitable: "smallTeams, iteration, release, project, smoothGoing"
};
all_activities[35] = {
phase:     0,
name:      "Appreciative Goal",
summary:   "State an affirmative goal for the session",
desc:      "Concentrate on positive aspects instead of problems by setting an affirmative goal, e.g.\
<ul>\
    <li>Let's find ways to amplify our strengths in process and teamwork</a></li>\
    <li>Let's find out how to extend our best uses of engineering practices and methods</li>\
    <li>We'll look at our best working relationships and find ways to build more relationships like that</li>\
    <li>We'll discover where we added the most value during our last iteration to increase the value we'll add during the next</li>\
</ul>",
source:    "<a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
duration:  "3 minutes",
suitable: "iteration, release, project"
};
all_activities[36] = {
phase:     2,
name:      "Remember the Future",
summary:   "Imagine the next iteration is perfect. What is it like? What did you do?",
desc:      "'Imagine you could time travel to the end of the next iteration (or release). You learn that it was \
the best, most productive iteration yet! How do your future selves describe it? What do you \
see and hear?' Give the team a little time to imagine this state and jot down some keywords to aid their memory. \
Then let everyone describe their vision of a perfect iteration.<br>\
Follow up with 'What changes did we implement that resulted in such a productive and satisfying future?'\
Write down the answers on index cards to use in the next phase.",
source:    "<a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
suitable: "iteration, release, project"
};
all_activities[37] = {
phase:     3,
name:      "Dot Voting - Keep, Drop, Add",
summary:   "Brainstorm what behaviors to keep, drop & add and pick the top initiatives",
desc:      "Divide a flip chart into boxes headed with  'Keep', 'Drop' and 'Add'. \
Ask your participants to write concrete proposals for each category - 1 \
idea per index card. Let them write in silence for a few minutes. \
Let everyone read out their notes and post them to the appropriate category. \
Lead a short discussion on what the top 20% beneficial ideas are. Vote on it by distributing dots\
or X's with a marker, e.g. 1, 2, and 3 dots for each person to distribute. \
The top 2 or 3 become your action items.",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[38] = {
phase:     3,
name:      "Dot Voting - Worked well, Do differently",
summary:   "Brainstorm what worked well & what to do differently and pick the top initiatives",
desc:      "Head 2 flip charts with 'Worked well' and 'Do differently next time' respectively. \
Ask your participants to write concrete proposals for each category - 1 \
idea per index card. Let them write in silence for a few minutes. \
Let everyone read out their notes and post them to the appropriate category. \
Lead a short discussion on what the top 20% beneficial ideas are. Vote on it by distributing dots \
or X's with a marker, e.g. 1, 2, and 3 dots for each person to distribute. \
The top 2 or 3 become your action items.",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[39] = {
phase:     4,
name:      "Plus & Delta",
summary:   "Each participant notes 1 thing they like and 1 thing they'd change about the retro",
desc:      "Prepare a flip chart with 2 columns: Head them with 'Plus' and 'Delta'. \
Ask each participant to write down 1 aspect of the retrospective they liked \
and 1 thing they would change (on different index cards). Post the index \
cards and walk through them briefly to clarify the exact meaning and detect \
the majority's preference when notes from different people point into opposite directions.",
source:    "<a href='http://agileretrospectivewiki.org/index.php?title=Weekly_Retrospective_Simple_%2B_delta'>Rob Bowley</a>",
duration:  "5-10",
suitable: "release, project"
};
all_activities[40] = {
phase:     2,
name:      "Park Bench",
summary:   "Group discussion with varying subsets of participants",
desc:      "Place at least 4 and at most 6 chairs in a row so that they face the group. \
Explain the rules: <ul>\
    <li>Take a bench seat when you want to contribute to the discussion</li>\
    <li>One seat must always be empty</li>\
    <li>When the last seat is taken, someone else must leave and return to the audience</li>\
</ul>\
Get everything going by sitting on the 'bench' and wondering aloud about \
something you learned in the previous phase until someone joins. \
End the activity when discussion dies down. \
<br>This is a variant of 'Fish Bowl'. It's suited for groups of 10-25 people.",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/08/24/park-bench/'>Diana Larsen</a>",
duration:  "15-30",
suitable: "release, project, largeGroups"
};
all_activities[41] = {
phase:     0,
name:      "Postcards",
summary:   "Participants pick a postcard that represents their thoughts / feelings",
desc:      "Bring a stack of diverse postcards - at least 4 four times as many as participants. \
Scatter them around the room and instruct team members to pick the postcard that best \
represents their view of the last iteration. After choosing they write down three keywords \
describing the postcard, i.e. sprint, on index cards. In turn everyone hangs up their post- and \
index cards and describes their choice.",
source:    "<a href='http://finding-marbles.com/2012/03/19/retrospective-with-postcards/'>Corinna Baldauf</a>",
duration:  "15-20",
suitable: "iteration, release, project",
photo:    "<a href='http://findingmarblesdotcom.files.wordpress.com/2012/03/retrospective-with-postcards3.jpg' rel='lightbox[activity41]' title='Contributed by Corinna Baldauf'>View Photo</a>"
};
all_activities[42] = {
phase:     0,
name:      "Take a Stand - Opening",
summary:   "Participants take a stand, indicating their satisfaction with the iteration",
desc:      "Create a big scale (i.e. a long line) on the floor with masking tape. Mark one \
end as 'Great' and the other as 'Bad'. Let participants stand on the scale \
according to their satisfaction with the last iteration. Psychologically, \
taking a stand physically is different from just saying something. It's more 'real'.<br> \
You can reuse the scale if you close with activity #44.",
source:    source_findingMarbles + ", inspired by <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
duration:  "2-5",
suitable: "iteration, release, project"
};
all_activities[43] = {
phase:     4,
name:      "Take a Stand - Closing",
summary:   "Participants take a stand, indicating their satisfaction with the retrospective",
desc:      "Create a big scale (i.e. a long line) on the floor with masking tape. Mark one \
end as 'Great' and the other as 'Bad'. Let participants stand on the scale \
according to their satisfaction with the retrospective. Psychologically, \
taking a stand physically is different from just saying something. It's more 'real'.<br> \
See activity #43 on how to begin the retrospective with the same scale.",
source:    source_findingMarbles + ", inspired by <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
duration:  "2-5",
suitable: "iteration, release, project"
};
all_activities[44] = {
phase:     4,
name:      "Pleased & Surprised",
summary:   "What pleased and / or surprised participants in the retrospective",
desc:      "Just make a quick round around the group and let each participant point out one \
finding of the retrospective that either surprised or pleased them (or both).",
source:    source_unknown,
duration:  "5",
suitable: "iteration, release, project"
};
all_activities[45] = {
phase:     0,
name:      "Why Retrospectives?",
summary:   "Ask 'Why do we do retrospectives?'",
desc:      "Go back to the roots and start into the retrospectives by asking 'Why do we do this?' \
Write down all answers for everyone to see. You might be surprised.",
source:    "<a href='http://proessler.wordpress.com/2012/07/20/check-in-activity-agile-retrospectives/'>Pete Roessler</a>",
duration:  "5",
suitable: "iteration, release, project"
};
all_activities[46] = {
phase:     1,
name:      "Empty the Mailbox",
summary:   "Look at notes collected during the sprint",
desc:      "Set up a 'retrospective mailbox' at the beginning of the iteration. Whenever something \
significant happens or someone has an idea for improvement, they write it \
down and 'post' it. (Alternatively the 'mailbox' can be a visible place. This can spark \
discussion during the iteration.) <br>\
Go through the notes and discuss them.<br>\
A mailbox is great for long iterations and forgetful teams.",
source:    source_skycoach,
more:      "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Original article</a>",
duration:  "15",
suitable: "release, project"
};
all_activities[47] = {
phase:     3,
name:      "Take a Stand - Line Dance",
summary:   "Get a sense of everyone's position and reach consensus",
desc:      "When the team can't decide between two options, create a big scale (i.e. a long line) \
on the floor with masking tape. Mark one end as option A) and the other as option B). \
Team members position themselves on the scale according to their preference for either option. \
Now tweak the options until one option has a clear majority.",
source:    source_skycoach,
more:      "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Original article</a>",
duration:  "5-10 per decision",
suitable: "iteration, release, project"
};
all_activities[48] = {
phase:     3,
name:      "Dot Voting - Starfish",
summary:   "Collect what to start, stop, continue, do more and less of",
desc:      "Draw 5 spokes on a flip chart paper, dividing it into 5 segments. \
Label them 'Start', 'Stop', 'Continue', 'Do More' and 'Do less'. \
Participants write their proposals on sticky notes and put \
them in the appropriate segment. After clustering stickies that capture the \
same idea, dot vote on which suggestions to try.",
source:    "<a href='http://www.thekua.com/rant/2006/03/the-retrospective-starfish/'>Pat Kua</a>",
duration:  "15 min",
suitable:  "iteration, release, project"
};
all_activities[49] = {
phase:     2,
name:      "Wish granted",
summary:   "A fairy grants you a wish - how do you know it came true?",
desc:      "Give participants 2 minutes to silently ponder the following question: \
'A fairy grants you a wish that will fix your biggest problem \
at work overnight. What do you wish for?' Follow up with: 'You come to work the next \
morning. You can tell, that the fairy has granted your wish. How do you know? \
What is different now?' If trust within the group is high, let everyone describe \
their 'Wish granted'-workplace. If not, just tell the participants to keep their \
scenario in mind during the next phase and suggest actions that work towards making it real.",
source:    "Lydia Grawunder &amp; Sebastian Nachtigall",
duration:  "15 min",
suitable:  "iteration"
};
all_activities[50] = {
phase:     1,
name:      "Lean Coffee",
summary:   "Use the Lean Coffee format for a focused discussion of the top topics",
desc:      "Say how much time you set aside for this phase, then explain the rules of Lean Coffee for retrospectives: <ul>\
    <li>Everyone writes down topics they’d like to discuss - 1 topic per sticky</li>\
    <li>Put the stickies up on a whiteboard or flipchart. The person who wrote it describes the topic in 1 or 2 sentences. \
        Group stickies that are about the same topic</li>\
    <li>Everyone dot-votes for the 2 topics they want to discuss</li>\
    <li>Order the stickies according to votes</li>\
    <li>Start with the topic of highest interest</li>\
    <li>Set a timer for 5 minutes. When the timer beeps, everyone gives a quick thumbs up or down. \
        Majority of thumbs up: The topic gets another 5 minutes. Majority of thumbs down: Start the next topic. </li>\
</ul> Stop when the allotted time is over.",
source:    "<a href='http://leancoffee.org/'>Original description</a> and \
<a href='http://finding-marbles.com/2013/01/12/lean-altbier-aka-lean-coffee/'>in action</a>",
duration:  "20-40 min",
suitable:  "iteration"
};
all_activities[51] = {
phase:     0,
name:      "Constellation - Opening",
summary:   "Let the participants affirm or reject statements without speaking",
desc:      "Place a circle or sphere in the middle of a free space. Let the team gather around it. \
Explain that the circle is the center of approval: If they agree to a statement they should move towards it, \
if they don't, they should move as far outwards as their degree of disagreement. Now read out statements, e.g.\
<ul>\
    <li>I feel I can talk openly in this retrospective</li>\
    <li>I am satisfied with the last sprint</li>\
    <li>I am happy with the quality of our code</li>\
    <li>I think our continuous integration process is mature</li>\
</ul>\
Watch the constellations unfold. Afterwards ask which constellations were surprising.<br>\
This can also be a closing activity (#53).",
source:    "<a href='http://www.coachingagileteams.com/'>Lyssa Adkins</a> via \
<a href='http://lmsgoncalves.com/2013/01/23/constellation-a-good-exercise-to-set-the-stage-in-the-retrospective/'>Luis Goncalves</a>",
duration:  "10 min",
suitable:  "iteration, project, release"
};
all_activities[52] = {
phase:     4,
name:      "Constellation - Closing",
summary:   "Let the participants rate the retrospective without speaking",
desc:      "Place a circle or sphere in the middle of a free space. Let the team gather around it. \
Explain that the circle is the center of approval: If they agree to a statement they should move towards it, \
if they don't, they should move as far outwards as their degree of disagreement. Now read out statements, e.g.\
<ul>\
    <li>We talked about what was most important to me</li>\
    <li>I spoke openly today</li>\
    <li>I think the time of the retrospective was well invested</li>\
    <li>I am confident we will carry out our action items</li>\
</ul>\
Watch the constellations unfold. Any surprising constellations?<br>\
This can also be an opening activity (#52).",
source:    "<a href='http://www.coachingagileteams.com/'>Lyssa Adkins</a> via \
<a href='http://lmsgoncalves.com/2013/01/23/constellation-a-good-exercise-to-set-the-stage-in-the-retrospective/'>Luis Goncalves</a>, \
<a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
duration:  "5 min",
suitable:  "iteration, project, release"
};
all_activities[53] = {
phase:     1,
name:      "Story Oscars",
summary:   "The team nominates stories for awards and reflects on the winners",
desc:      "Display all stories completed in the last sprints on a board. \
Create 3 award categories (i.e. boxes on the board):\
<ul>\
    <li>Best story</li>\
    <li>Most annoying story</li>\
    <li>... 3rd category invented by the team ...</li>\
</ul>\
Ask the team to 'nominate' stories by putting them in one of the award boxes. <br>\
For each category: Dot-vote and announce the winner. \
Ask the team why they think the user story won in this category \
and let the team reflect on the process of completing the tasks - what went good or wrong.",
source:    "<a href='http://www.touch-code-magazine.com'>Marin Todorov</a>",
duration:  "30-40 min",
suitable:  "project, release",
photo:    "<a href='http://www.plans-for-retrospectives.com/static/images/activities/54_Story-Oscars.jpg' rel='lightbox[activity53]' title='Contributed by Wolfgang Fassbender'>View Photo</a>"
};
all_activities[54] = {
phase:     2,
name:      "Original 4",
summary:   "Ask Norman Kerth's 4 key questions",
desc:      "Norman Kerth, inventor of retrospectives, identified the following 4 questions as key: \
<ul>\
    <li>What did we do well, that if we didn’t discuss we might forget?</li>\
    <li>What did we learn?</li>\
    <li>What should we do differently next time?</li>\
    <li>What still puzzles us?</li>\
</ul>\
What are the team's answers?",
source:    "<a href='http://www.retrospectives.com/pages/RetrospectiveKeyQuestions.html'>Norman Kerth</a>",
duration:  "15 min",
suitable:  "iteration, project, release"
};
all_activities[55] = {
phase:     5,
name:      "Invite a Customer",
summary:   "Bring the team into direct contact with a customer or stakeholder",
desc:      "Invite a customer or internal stakeholder to your retrospective.\
Let the team ask ALL the questions:\
<ul>\
    <li>How does the client use your product?</li>\
    <li>What makes them curse the most?</li>\
    <li>Which function makes their life easier?</li>\
    <li>Let the client demonstrate their typical workflow</li>\
    <li>...</li>\
</ul>",
source:    "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Nick Oostvogels</a>",
duration:  "45 min",
suitable:  "iteration, project"
};
all_activities[56] = {
phase:     4,
name:      "Say it with Flowers",
summary:   "Each team member appreciates someone else with a flower",
desc:      "Buy one flower for each team member and reveal them at the end of the retrospective. \
Everyone gets to give someone else a flower as a token of their appreciation.",
source:    "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Nick Oostvogels</a>",
duration:  "5 min",
suitable:  "iteration, project"
};
all_activities[57] = {
phase:     2,
name:      "Undercover Boss",
summary:   "If your boss had witnessed the last sprint, what would she want you to change?",
desc:      "Imagine your boss had spent the last sprint - unrecognized - among you. What would she \
think about your interactions and results? What would she want you to change? \
<br>This setting encourages the team to see themselves from a different angle.",
source:    "<a href='http://loveagile.com/retrospectives/undercover-boss'>Love Agile</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release"
};
all_activities[58] = {
phase:     0,
name:      "Happiness Histogram",
summary:   "Create a happiness histogram to get people talking",
desc:      "Prepare a flip chart with a horizontal scale from 1 (Unhappy) \
to 5 (Happy).\
<ul>\
    <li>One team member after the other places their sticky note according to their happiness and comment on their placement</li>\
    <li>If anything noteworthy comes from the reason, let the team choose to either discuss it there and then or postpone it for later in the retrospective</li>\
    <li>If someone else has the same score, they place their sticky above the placed one, effectively forming a histogram</li>\
</ul>",
source:    "<a href='http://nomad8.com/chart-your-happiness/'>Mike Lowery</a> via <a href='https://twitter.com/nfelger'>Niko Felger</a>",
duration:  "2 min",
suitable:  "iteration, project, release"
};
all_activities[59] = {
phase:     4,
name:      "AHA!",
summary:   "Throw a ball around and uncover learning",
desc:      "Throw a ball (e.g. koosh ball) around the team and uncover positive thoughts and learning experiences. Give out a question at the beginning \
that people answer when they catch the ball, such as: \
<ul>\
    <li>One thing I learned in the last sprint</li>\
    <li>One awesome thing someone else did for me</li>\
</ul>\
Depending on the question it might uncover events that are bugging people. If any alarm bells go off, dig a little deeper. With the '1 nice thing'-question \
you usually close on a positive note.",
source:    "<a href='http://scrumfoundation.com/about/catherine-louis'>Catherine Louis</a> and <a href='http://blog.haaslab.net/'>Stefan Haas</a> via <a href='https://www.linkedin.com/in/misshaley'>Amber Haley</a>",
duration:  "5-10 min",
suitable:  "iteration, project",
photo:    "<a href='https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTrZZvgbLqG_3Tr5TOZr4HAuy0f4JlKtpoF5uOTe9HCtC3IbzIf' rel='lightbox[activity59]' title='Contributed by Amber Haley'>View Photo</a>"
};
all_activities[60] = {
phase:     3,
name:      "Chaos Cocktail Party",
summary:   "Actively identify, discuss, clarify and prioritize a number of actions",
desc:      "Everyone writes one card with an action that they think is important to do. \
Then team members go around and chat about the cards \
like in a cocktail party. Every chat pair discusses the actions on their \
two cards. Stop the chatting after 1 minute. Each chat pair splits \
5 points between the two cards. More points go to the more important action. Organize \
3 to 5 rounds of chats (depending on group size). At the end everyone adds \
up the points on their card. In the end the cards are ranked by points \
and the team decides how much can be done in the next iteration, pulling from the top.",
source:    "Suzanne Garcia via <a href='http://www.wibas.com'>Malte Foegen</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release, largeGroup"
};
all_activities[61] = {
phase:     1,
name:      "Expectations",
summary:   "What can others expect of you? What can you expect of them?",
desc:      "Give each team member a piece of paper. The lower half is blank. The top half is divided into two sections:\
<ul>\
    <li>What my team mates can expect from me</li>\
    <li>What I expect from my team mates</li>\
</ul>\
Each person fills out the top half for themselves. When everyone is finished, they pass their \
paper to the left and start reviewing the sheet that was passed to them. In the lower half they \
write what they personally expect from that person, sign it and pass it on.<br>\
When the papers made it around the room, take some time to review and share observations.",
source:    "<a href='http://agileyammering.com/2013/01/25/expectations/'>Valerie Santillo</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release, start"
};
all_activities[62] = {
phase:     3,
name:      "Low Hanging Fruit",
summary:   "Visualize promise and ease of possible courses of actions to help pick",
desc:      "Reveal a previously drawn tree. Hand out round index cards and instruct participants to \
write down the actions they would like to take - one per card. When everyone's finished, \
collect the cards, shuffle and read them out one by one. Place each 'fruit' according to the \
participants' assessment:\
<ul>\
    <li>Is it easy to do? Place it lower. Hard? More to the top.</li>\
    <li>Does it seem very beneficial? Place it more to the left. Value is dubious at best? To the right.</li>\
</ul>\
The straightforward choice is to pick the bottom left fruit as action items. If this is not \
consensus, you can either have a short discussion to agree on some actions or dot vote.",
source:    "<a href='http://tobias.is'>Tobias Baldauf</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release"
};
all_activities[63] = {
phase:     1,
name:      "Quartering - Identify boring stories",
summary:   "Categorize stories in 2 dimensions to identify boring ones",
desc:      "Draw a big square and divide it into 2 columns. \
Label them 'Interesting' and 'Dull'. Let the team write down everything they did last iteration on stickies and \
put it into the appropriate column. Have them add a rough estimate of how long it took on each of their own stickies.<br> \
Now add a horizontal line so that your square has 4 quadrants. Label the top row 'Short' (took hours) \
and the bottom row 'Long' (took days). Rearrange the stickies in each column.<br> \
The long and dull stories are now nicely grouped to 'attack' in subsequent phases.<br> \
<br>\
(Splitting the assessment into several steps, improves focus. You can \
<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>\
    adapt Quartering for lots of other 2-dimensional categorizations</a>.)",
source:    "<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>Wayne D. Grant</a>",
duration:  "10",
suitable:  "iteration, project",
photo:    "<a href='http://waynedgrant.files.wordpress.com/2012/08/quartering41.jpg?w=413&h=450' rel='lightbox[activity63]' title='Contributed by Wayne D. Grant'>View Photo</a>"
};
all_activities[64] = {
phase:     1,
name:      "Appreciative Inquiry",
summary:   "Lift everyone's spirit with positive questions",
desc:      "This is a round-based activity. In each round you ask the team a question, they write down their answers \
(gives everyone time to think) and then read them out to the others.<br>\
Questions proposed for Software Development teams:\
<ol>\
    <li>When was the last time you were really engaged / animated / productive? What did you do? What had \
        happened? How did it feel?</li>\
    <li>From an application-/code-perspective: What is the awesomest stuff you've built together? What makes it great?</li>\
    <li>Of the things you built for this company, which has the most value? Why?</li>\
    <li>When did you work best with the Product Owner? What was good about it?</li>\
    <li>When was your collaboration best?</li>\
    <li>What was your most valuable contribution to the developer community (of this company)? How did you do it?</li>\
    <li>Leave your modesty at the door: What is the most valuable skill / character trait you contribute to the team?\
        Examples?</li>\
    <li>What is your team's most important trait? What sets you apart?</li>\
</ol>\
<br>\
('Remember the Future' (#37) works well as the next step.)",
source:    "<a href='http://blog.8thlight.com/doug-bradbury/2011/09/19/apreciative_inquiry_retrospectives.html'>Doug Bradbury</a>, adapted for SW development by " + source_findingMarbles,
duration:  "20-25 min groupsize",
suitable:  "iteration, project"
};
all_activities[65] = {
phase:     2,
name:      "Brainwriting",
summary:   "Written brainstorming levels the playing field for introverts",
desc:      "Pose a central question, such as 'What actions should we take in the next sprint to improve?'. \
Hand out paper and pens. Everybody writes down their ideas. After 3 minutes everyone passes their \
paper to their neighbour and continues to write on the one they've gotten. As soon as they run out of \
ideas, they can read the ideas that are already on the paper and extend them. Rules: No negative \
comments and everyone writes their ideas down only once. (If several people write down the same idea, \
that's okay.) <br>\
Pass the papers every 3 minutes until everyone had every paper. Pass one last time. Now everyone \
reads their paper and picks the top 3 ideas. Collect all top 3's on a flip chart for the next phase.",
source:    "Prof. Bernd Rohrbach",
duration:  "20 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[66] = {
phase:     4,
name:      "Take Aways",
summary:   "Capture what participants learned during the retro",
desc:      "Everyone writes a sticky note with the most remarkable thing they learned during the retro. Put \
the notes against the door. In turn each participant reads out their own note.",
source:     source_judith,
duration:  "5 min",
suitable:  "iteration, project, release"
};
all_activities[67] = {
phase:     2,
name:      "Company Map",
summary:   "Draw a map of the company as if it was a country",
desc:      "Hand out pens and paper. Pose the question 'What if the company / department / team was territory? \
What would a map for it look like? What hints would you add for save travelling?' Let participants draw \
for 5-10 minutes. Hang up the drawings. Walk through each one to clarify and discuss interesting metaphors.",
source:     source_judith,
duration:  "15 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[68] = {
phase:     2,
name:      "The Worst We Could Do",
summary:   "Explore how to ruin the next sprint for sure",
desc:      "Hand out pens and sticky notes. Ask everyone for ideas on how to turn the next sprint / release \
into a certain desaster - one idea per note. When everyone's finished writing, hang up all stickies \
and walk through them. Identify and discuss themes. <br>\
In the next phase turn these negative actions into their opposite.",
source:     source_findingMarbles,
duration:  "15 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[69] = {
phase:     0,
name:      "3 for 1 - Opening",
summary:   "Check satisfaction with sprint results, communication &amp; mood all at once",
desc:      "Prepare a flip chart with a co-ordinate plane on it. The Y-axis is 'Satisfaction with sprint result'. \
The X-axis is 'Number of times we coordinated'. Ask each participant to mark where their satisfaction \
and perceived touch points intersect - with an emoticon showing their mood (not just a dot).\
Discuss surprising variances and extreme moods.<br>\
(Vary the X-axis to reflect current team topics, e.g. 'Number of times we pair programmed'.)",
source:     source_judith,
duration:  "5 min groupsize",
suitable:  "iteration, project"
};
all_activities[70] = {
phase:     4,
name:      "3 for 1 - Closing: Was everyone heard?",
summary:   "Check satisfaction with retro results, fair distribution of talk time &amp; mood",
desc:      "Prepare a flip chart with a co-ordinate plane on it. The Y-axis is 'Satisfaction with retro result'. \
The X-axis is 'Equal distribution of talking time' (the more equal, the farther to the right). \
Ask each participant to mark where their satisfaction and perceived talking time balance intersect - \
with an emoticon showing their mood (not just a dot). Discuss talking time inequalities (and extreme moods).",
source:     source_judith,
duration:  "15 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[71] = {
phase:     3,
name:      "Divide the Dollar",
summary:   "How much is an action item worth to the team?",
desc:      "Hang up the list of possible actions. Draw a column next to it, titled 'Importance (in $)'. \
The team gets to spend 100 (virtual) dollars on the action items. The more \
important it is to them, the more they should spend. Make it more fun by bringing paper \
money from a board game such as Monopoly.\
<br><br>Let them agree on prices. Consider the 2 or 3 highest amount action items as chosen.",
source:     "<a href='http://www.gogamestorm.com/?p=457'>Gamestorming</a>",
duration:  "10 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[72] = {
phase:     3,
name:      "Pitch",
summary:   "Ideas for actions compete for 2 available 'Will do'-slots",
desc:      "Ask everyone to think of 2 changes they'd like to implement and write them down on separate \
index cards. Draw 2 slots on the board. The first team member puts their favorite change idea \
into the first slot. His neighbor puts their favorite into the second slot. The third member has \
to pitch her favorite idea against the one already hanging that she favors less. If the team \
prefers her idea, it's swapped against the hanging one. This continues until everyone has presented \
both their cards. \
<br><br>Try not to start the circle with dominant team members.",
source:     source_judith,
duration:  "15 min groupsize",
suitable:  "iteration"
};
all_activities[73] = {
phase:     2,
name:      "Pessimize",
summary:   "If we had ruined the last sprint what would we have done?",
desc:      "You start the activity by asking: 'If we had completely ruined last sprint what would we have done?' \
Record the answers on a flip chart. Next question: 'What would be the opposite of that?' \
Record it on another flip chart. Now ask participants to comment the items on the 'Opposite'-chart \
by posting sticky notes answering 'What keeps us from doing this?'. Hand out different colored \
sticky notes to comment on the comments, asking 'Why is it like this?'.",
source:     source_judith,
duration:  "25 min groupsize",
suitable:  "iteration, project"
};
all_activities[74] = {
phase:     1,
name:      "Writing the Unspeakable",
summary:   "Write down what you can never ever say out loud",
desc:      "Do you suspect that unspoken taboos are holding back the team? \
Consider this silent activity: Stress confidentiality ('What happens in Vegas stays in Vegas') \
and announce that all \
notes of the following activities will be destroyed in the end. Only afterwards hand out a piece \
of paper to each participant to write down the biggest unspoken taboo in the company. <br>\
When everyone's done, they pass their paper to their left-hand neighbors. The neighbors read \
and may add comments. Papers are passed on and on until they return to their authors. One last \
read. Then all pages are ceremoniously shredded or (if you're outside) burned.",
source:     "Unknown, via Vanessa",
duration:  "10 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[75] = {
phase:     0,
name:      "Round of Admiration",
summary:   "Participants express what they admire about one another",
desc:      "Start a round of admiration by facing your neighbour and stating 'What I admire \
            most about you is ...' Then your neighbour says what she admires about \
            her neighbour and so on until the last participants admires you. Feels great, \
            doesn't it?",
source:     source_judith,
duration:  "5 min",
suitable:  "iteration, project, release"
};
all_activities[76] = {
phase:     4,
name:      "Follow Through",
summary:   "What's the probability of action items getting implemented?",
desc:      "Let everyone draw an emoticon of their current mood on a sticky note. \
            Then draw a scale on a flip chart, labeled 'Probability we'll implement \
            our action items'. Mark '0%' on the left and '100%' on the right. Ask \
            everyone to place their sticky according to their confidence in their \
            follow through as a team. <br>Discuss interesting results such as low probability \
            or bad mood.",
source:     source_judith,
duration:  "5-10 min",
suitable:  "iteration, project, release"
};
all_activities[77] = {
phase:     1,
name:      "4 Ls - Loved, Learned, Lacked, Longed for",
summary:   "Explore what people loved, learned, lacked and longed for individually",
desc:      "Each person brainstorms individually for each of these 4 questions: \
<ul> \
    <li>What I Loved</li> \
    <li>What I Learned</li> \
    <li>What I Lacked</li> \
    <li>What I Longed For</li> \
</ul> \
Collect the answers, either stickies on flip charts or in a digital tool if you're distributed. \
Form 4 subgroups, on for each L, read all notes, identify patterns and report their findings to the group. \
Use this as input for the next phase.",
source:     "<a href='http://ebgconsulting.com/blog/the-4l%E2%80%99s-a-retrospective-technique/'>Mary Gorman &amp; Ellen Gottesdiener</a> probably via <a href='http://www.groupmap.com/portfolio-posts/agile-retrospective/'>groupmap.com</a>",
duration:  "30 min",
photo:    "<a href='http://ebgconsulting.com/blog/wp-content/uploads/2010/06/4-Ls-poster-verticle-layout2.jpg' rel='lightbox[activity77]' title='Taken by Ellen Gottesdiener'>View Photo</a>",
suitable:  "iteration, project, release, distributed"
};
all_activities[78] = {
phase:     1,
name:      "Value Stream Mapping",
summary:   "Draw a value stream map of your iteration process",
desc:      "Explain an example of Value Stream Mapping. (If you're unfamiliar with it, check out \
<a href='http://www.youtube.com/watch?v=3mcMwlgUFjU'>this video</a> or \
<a href='http://wall-skills.com/2014/value-stream-mapping/'>this printable 1-pager</a>.) \
Ask the team to draw a value stream map of their process from the point of \
view of a single user story. If necessary, ask them to break into small groups, and \
facilitate the process if they need it. Look at the finished map. Where are long delays, \
choke points and bottlenecks?",
source:    "<a href='http://pragprog.com/book/ppmetr/metaprogramming-ruby'>Paolo &quot;Nusco&quot; Perrotta</a>, inspired by <a href='http://www.amazon.com/exec/obidos/ASIN/0321150783/poppendieckco-20'>Mary &amp; Tom Poppendieck</a>",
duration:  "20-30 min",
more:      "http://leadinganswers.typepad.com/leading_answers/2011/09/pmi-acp-value-stream-mapping.html",
suitable:  "iteration, project, release, distributed"
};
all_activities[79] = {
phase:     1,
name:      "Repeat &amp; Avoid",
summary:   "Brainstorm what to repeat and what behaviours to avoid",
desc:      "Head 2 flip charts with 'Repeat' and 'Avoid' respectively. \
The participants write issues for the columns on sticky notes - 1 per issue. \
You can also color code the stickies. Example categories are 'People', 'Process', 'Technology', ... \
Let everyone read out their notes and post them to the appropriate column. \
Are all issues unanimous?",
source:     "<a href='http://www.infoq.com/minibooks/agile-retrospectives-value'>Luis Goncalves</a>",
more:       "http://www.funretrospectives.com/repeat-avoid/",
duration:  "15-30",
photo:    "<a href='http://4.bp.blogspot.com/-LLJU-U0lLFg/UR6j7F6mMnI/AAAAAAAACmU/P1NUW-KUraA/s1600/repeat-avoid.JPG' rel='lightbox[activity80]' title='Photo by Luis Goncalves'>View Photo</a>",
suitable: "iteration, project, remote"
};
all_activities[80] = {
phase:     0,
name:      "Outcome Expectations",
summary:   "Everyone states what they want out of the retrospective",
desc:      "Everyone in the team states their goal for the retrospective, i.e. what they \
want out of the meeting. Examples of what participants might say: \
<ul> \
    <li>I'm happy if we get 1 good action item</li> \
    <li>I want to talk about our argument about unit tests and agree on how we'll do it in the future</li> \
    <li>I'll consider this retro a success, if we come up with a plan to tidy up $obscureModule</li> \
</ul> \
[You can check if these goals were met if you close with activity #14.] \
<br><br> \
[The <a href='http://liveingreatness.com/additional-protocols/meet/'>Meet - Core Protocol</a>, which inspired \
this activity, also describes 'Alignment Checks': Whenever someone thinks the retrospective is not meeting \
people's needs they can ask for an Alignment Check. Then everyone says a number from 0 to 10 which reflects \
how much they are getting what they want. The person with the lowest number takes over to get nearer to \
what they want.]",
source:     "Inspired by <a href='http://liveingreatness.com/additional-protocols/meet/'>Jim &amp; Michele McCarthy</a>",
duration:  "5 min groupsize",
suitable:  "iteration, project, release"
};

all_activities[81] = {
phase:     0,
name:      "Three Words",
summary:   "Everybody sums up the last sprint in 3 words",
desc:      "Ask everyone to describe the last iteration with just 3 words. \
            Give them a minute to come up with something, then go around the team. \
            This helps people recall the last sprint so that they have some ground to \
            start from.",
source:     "Yurii Liholat",
duration:  "5 min groupsize",
suitable:  "iteration, project"
};