var phase_titles = ['Voorbereiding', 'Data verzamelen', 'Inzicht verkrijgen', 'Beslissen wat te doen', 'Retrospective afsluiten', 'Iets totaal anders'];

// BIG ARRAY OF ALL ACTIVITIES
// Mandatory: id, phase, name, summary, desc
// Example:
//all_activities[i] = {
//  id:        i+1,
//  phase:     int in {1-5},
//  name:      "",
//  alternativeName: "",
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
name:      "OSVG",
summary:   "Hoe voelen de deelnemers zich tijdens de retrospective: Ontdekkingsreiziger, Shopper, Vakantieganger, or Gevangene?",
desc:      "Bereid een flipchart voor met gebieden voor O, S, V, en G. Leg het concept uit: <br>\
<ul>\
    <li>Ontdekkingsreiziger: Verlangt er naar om er eens in te duiken en uit te zoeken wat werkte en wat niet werkte en hoe het verbeterd kan worden.</li>\
    <li>Shopper: Wil graag de bescihkbare informatie bekijken, en zou het leuk vinden om terug te komen met een nuttig idee.</li>\
    <li>Vakantieganger: Terughoudend om actief deel te nemen, maar het bijwonen van de retrospective is beter dan te moeten werken.</li>\
    <li>Gevangene: Woont de retrospective alleen bij omdat ze het gevoel hebben dat dat moet.</li>\
</ul>\
Houdt een stemming (anoniem op een stukje papier). Tel de verschillende antwoorden en houdt het bij op de flipchart \
waar iedereen het zien kan. Als er geen vertrouwen is, vernietig dan doelbewust de papiertjes om privacy te garanderen. \
Vraag wat iedereen denkt van de data. Als er een meerderheid Vakantiegangers or Gevangenen is overweeg dan om de retro \
te gebruiken om deze uitkomst te bespreken.",
duration:  "5-10 numberPeople",
source:  source_agileRetrospectives,
suitable:   "iteration, release, project, immature"
};
all_activities[1] = {
phase:     0,
name:      "Weersvoorspelling",
summary:   "Deelnemers markeren hun lokale 'weer' (gemoedstoestand) op een flipchart",
desc:      "Bereid een flipchart voor met een tekening van een storm, regen, wolken en zonneschijn.\
Iedere deelnemer geeft zijn gemoedstoestand aan op het vel.",
source:  source_agileRetrospectives
};
all_activities[2] = {
phase:     0,
name:      "Check In - Korte vraag", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Stel aan ieder van de deelnemers een vraag die ze allemaal om de beurt moeten beantwoorden",
desc:      "Stel aan ieder van de deelnemers in round-robin-stijl dezelfde vraag (tenzij ze zeggen 'ik pas').\
Voorbeeld vragen: <br>\
<ul>\
    <li>Beschrijf in een woord wat je van deze retrospective nodig hebt</li>\
    <li>Beschrijf in een woord waar je mee zit<br>\
        Stel het aanpakken van de zorgen nog even uit, maar vergeet niet om er later op terug te komen, bijvoorbeeld door ze op te schrijven en ze dan zowel fysiek als mentaal opzij te zetten.</li>\
    <li>Als je in de afgelopen sprint een auto was, wat voor type zou het dan zijn?</li>\
    <li>Wat is je emotionele toestand? (bijv. 'opgelucht', 'boos', 'verdrietig', 'bang'?)</li>\
</ul><br>\
Vermijd het om antwoorden zoals 'Geweldig' te evalueren. Een kort 'Dank je wel' volstaat.",
source:  source_agileRetrospectives
};
all_activities[3] = {
phase:     1,
name:      "Tijdslijn",
summary:   "Deelnemers schrijven de belangrijke gebeurtenissen op en sorteren ze chronologisch",
desc:      "Verdeel het team in groepjes van 5 of minder. Verdeel kaartjes en markers. \
Geef de deelnemers 10 min om gedenkwaardig en/of persoonlijk significante gebeurtenissen op te schrijven. \
Het gaaat er om zo veel mogelijk perspectieven te verzamelen. Consensus zou afbreuk doen aan de oefening. \
Alle deelnemers tonen hun kaartjes en helpen bij het sorteren. Het is toegestaan om ter plekke nog meer kaartjes toe te voegen. Analiseer.<br>\
Kleurcodering kan helpen om patronen te vinden, bijvoorbeeld:<br>\
<ul>\
    <li>Emoties</li>\
    <li>Gebeurtenissen (technisch, organisatorisch, mensen, ...)</li>\
    <li>Functies (tester, ontwikkelaar, manager, ...)</li>\
</ul>",
duration:  "60-90 timeframe",
source:  source_agileRetrospectives,
suitable: "iteration, introverts"
};
all_activities[4] = {
phase:     1,
name:      "Analiseer de user stories",
summary:   "Loop door elk van de user stories heen die het team in de afgelopen sprint afgerond heeft en zoek naar mogelijke verbeteringen",
desc:      "Voorbereiding: Verzamel alle afgeronde user stories van de iteratie en neem ze mee naar de retrospective.<br> \
Lees in een groep (max. 10 mensen) ieder van de stories voor en bespreek dan per story of het goed ging of niet. Als het goed ging, probeer dan te achterhalen waarom. Zo niet, bespreek dan wat er in de toekomst anders gedaan kan worden.<br>\
Varianten: Je kunt dit ook doen voor support tickets, bugs of elke andere combinatie van werk gedaan door het team.",
source:    source_findingMarbles,
suitable: "iteration, max10people"
};
all_activities[5] = {
phase:     1,
name:      "Soort zoekt soort",
summary:   "Deelnemers zoeken kwaliteitenkaartjes bij hun eigen Start-Stop-Volhouden-voorstellen",
desc:      "Voorbereiding: ca. 20 kwaliteitenkaartjes, bijv. gekleurde indexkaarten met unieke woorden\
zoals <i>leuk, op tijd, duidelijk, belangrijk, geweldig, gevaarlijk, naar</i>.<br> \
Ieder teamlid moet ten minste 9 indexkaarten schrijven: 3 van ieder met dingen die het team moet gaan doen (Start), moet blijven doen (Volhouden), of niet meer moet doen (Stop). Kies een persoon die als eerte spelleider is. De spelleider draait het eerste kwaliteitenkaartje om. Uit zijn eigen indexkaarten kiest hij degeen die het beste bij deze kwaliteit past en legt deze omgekeerd op tafel.\
Alle anderen kiezen uit hun eigen kaarten ook een kaart die bij deze kwaliteit past en legen deze omgekeerd op tafel. Degene die als laatste kiest moet zijn indexkaart weer terugnemen in zijn hand. De spelleider schudt alle kaarten die op tafel liggen, draait ze een voor een om en kiest de best passende kaart. (Hij/zij moet dit ook beargumenteren.) \
Alle andere kaarten worden uit het spel verwijderd. De persoon die de winnende kaart heeft ingediend ontvangt de kaart met de kwaliteit. Vervolgens wordt de volgende persoon (met de klok mee) de spelleider.<br> \
Stop het spel zodra de kaarten op zijn (6-9 ronden). Degene met de meeste kwaliteitenkaartjes heeft gewonnen. Sluit het spel af met een rondvraag naar wat iedereen geleerd heeft.<br>\
(Dit spel is gebaseerd op het spel 'Appels en Peren')",
source:    source_agileRetrospectives,
duration:  "30-40",
suitable: "iteration, introverts"
};
all_activities[6] = {
phase:     1,
name:      "Boos Bedroefd Blij",
summary:   "Verzamel gebeurtenissen waarbij teamleden zich boos, bedroefd of blij voelden en vind de oorzaken",
desc:      "Hang drie posters op genaamd 'boos', 'bedroefd', en 'blij' (of '>:), :(, :) respectievelijk).  De teamleden schrijven een gebeurtenis op een kleurgecodeerd kaartje (1 gebeurtenis per kaartje) en hoe ze zich toen voelden. Als de tijd om is, hangt iedereen zijn post-its op de bijbehorende poster. Groepeer de kaartjes op iedere poster. Vraag de groep om iedere cluster een naam te geven. <br>\
Bespreek het resultaat met de volgende vragen:
<ul>\
    <li>Wat valt er op? Wat is er onverwacht?</li>\
    <li>Wat was er moeilijk aan deze opdracht? En wat was er leuk?</li>\
    <li>Welke patronen zie je? Wat betekent dat voor jullie als team?</li>\
    <li>Suggesties over hoe we nu verder moeten?</li>\
</ul>",
source:    source_agileRetrospectives,
duration:  "20-30",
suitable: "iteration, release, project, introverts"
};
all_activities[7] = {
phase:     2,
name:      "5 Waaroms",
alternativeName: "Root Cause Analysis",
summary:   "Graaf door naar de oorzaak van het probleem door alsmaar 'Waarom?' te vragen",
desc:      "Verdeel de deelnemers in kleine groepen (<= 4 mensen) en geef iedere groep een van de top van geidentificeerde issues. Instructies voor de groep:\
<ul>\
    <li>Een persoon vraagt de anderen 'Waarom gebeurde dit?' Net zo vaak totdat de onderliggende oorzaak gevonden is die aan de keten van gebeurtenissen ten grondslag ligt.</li>\
    <li>Leg de onderliggende oorzaak vast (vaak het antwoord op de vijfde keer 'Waarom?')</li>\
</ul>\
Laat de groepen hun bevindingen delen.",
source:    source_agileRetrospectives,
duration:  "15-20",
suitable: "iteration, release, project, root_cause"
};
all_activities[8] = {
phase:     2,
name:      "Learning Matrix",
summary:   "Teamleden brainstormen aan de hand van 4 categorieen om snel een lijst met issues boven tafel te krijgen",
desc:      "Bereid een flipchart voor met vier kwadranten met in ieder kwadrant een icoontje: linksboven een smilie voor de dingen die je goed vond gaan ':)', rechtsboven een frownie voor de dingen die je niet goed vond gaan ':(', linksonder een lampje voor de goede ideeen en rechtsonder een bosje bloemen voor de mensen die je waardeerde. Deel vervolgens post-its uit en geef de teamleden 5-10 minuten om hun ideeen over de sprint aan de hand van deze kwadranten op te schrijven. \
<ul>\
    <li>De teamleden kunnen hun input in ieder kwadrant hangen. Een gedachte per post-it. </li>\
    <li>Cluster de notities.</li>\
    <li>Deel 6-10 stip-stickers per persoon uit om te stemmen op de belangrijkste issues.</li>\
</ul>\
De resulterende lijst is de input voor fase 4.",
source:    source_agileRetrospectives,
duration:  "20-25",
suitable: "iteration"
};
all_activities[9] = {
phase:     2,
name:      "Brainstormen / Filteren",
summary:   "Genereer een berg ideeen en filter die tegen de criteria",
desc:      "Leg de regels van het brainstormen en het doel uit: zoveel mogelijk nieuwe ideeen generen, die <em>na</em> het brainstormen gefilterd zullen worden.\
<ul>\
    <li>Laat iedereen zijn/haar ideeen opschrijven in ca. 5-10 minuten</li>\
    <li>Ga net zolang de tafel rond, waarbij iedereen iedere keer 1 idee mag opnoemen, net zo lang tot alle ideeen op de flipchart staan</li>\
    <li>Vraag nu naar mogelijke filters (bijv. kosten, tijd investering, hoe uniek het concept is, toepasselijkheid voor het merk, ...). \
        Laat de groep er vervolgens 4 uitkiezen.</li>\
    <li>Pas vervolgens alle filters toe op de ideeen en markeer de ideeen die aan alle vier de filters voldoen.</li>\
    <li>Welke ideeen komen er door de test? En welke hiervan zal de groep gaan uitvoeren? Is er iemand die grote waarde hecht aan een van de ideeen? Gebruik anders een meerderheidsstemming. </li>\
</ul>\
De geselecteerde ideeen gaan door naar fase 4.",
source:    source_agileRetrospectives,
more:     "<a href='http://www.mpdailyfix.com/the-best-brainstorming-nine-ways-to-be-a-great-brainstorm-lead/'>\
    Nine Ways To Be A Great Brainstorm Lead</a>",
duration:  "40-60",
suitable: "iteration, release, project, introverts"
};
all_activities[10] = {
phase:     3,
name:      "Kring van Vragen",
summary:   "Vragen en antwoorden gaan de teamkring rond - een uitstekende manier om overeenstemming te bereiken",
desc:      "Iedereen zit in een kring. Begin met stellen dat je rond gaat om vragen te stellen om uit te vinden wat je als groep wilt. Je begint met het stellen van de eerste vraag aan je buurman/-vrouw, bijv. 'Wat is het belangrijkste waar we onze volgende iteratie mee zouden moeten starten?' Je buurman/-vrouw antwoord en stelt zijn/haar buur een gerelateerde vraag. Stop zodra er overeenstemming is bereikt of als de tijd om is. Zorg dat je ten minste een keer de kring rond gaat zodat iedereen aan het woord komt!",
source:    source_agileRetrospectives,
duration:  "30+ groupsize",
suitable: "iteration, release, project, introverts"
};
all_activities[11] = {
phase:     3,
name:      "Stemmen met stippen - Start, Stop, Doorgaan",
summary:   "Brainstorm over welke dingen gestart, gestopt & voortgezet moeten worden en kies de hoogstscorende initiatieven",
desc:      "Verdeel een flipover in vakken met de titels 'Start', 'Doorgaan' en 'Stop'. \
Vraag de deelnemers om voor elke categorie concrete voorstellen op te schrijven - 1 idee per index kaart. Laat ze gedurende een paar minuten in stilte schrijven. \
Laat iedereen zijn notities voorlezen en in de gewenste categorie hangen. \
Leid een korte discussie over wat de 20% meest zinvolle ideeen zijn.
Laat iedereen stemmen met stippen of streepjes met een marker op de kaartjes, waarbij iederen bijv. 1, 2 of 3 stippen per persoon te verdelen heeft over de kaartjes. De twee of drie kaartjes met de meeste stemmen worden je actie items.
<br><br>\
(Kijk ook eens naar <a='http://agileretroactivities.blogspot.co.at/search/label/innovation'>Paulo Caroli's 'Open the Box'</a> voor een leuke variatie op deze activiteit.)",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[12] = {
phase:     3,
name:      "SMART Doelen",
summary:   "Formuleer een specifiek en meetbaar actieplan",
desc:      "Introduceer <a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART doelen</a>\
(specific-specifiek, measurable-meetbaar, attainable-haalbaar, relevant-relevant, timely-tijdig) en geef voorbeelden van SMART vs doelen die niet zo SMART zijn. bijv. 'We zullen elke woensdag om 9 uur stories bestuderen voordat we ze in de sprint opnemen door er over te praten met de product owner' vs. 'We zullen de stories beter leren kennen voor ze in de sprint backlog komen'.<br>\
Vorm groepen rondom de issues waaraan het team werken wil. Iedere groep identificeert 1-5 concrete stappen om het doel te bereike. Laat iedere groep rapporteren. Alle deelnemers moeten het eens zijn met de SMART-heid van de doelen. Verfijn en bevestig.",
source:    source_agileRetrospectives,
duration:  "20-60 groupsize",
suitable: "iteration, release, project"
};
all_activities[13] = {
phase:     4,
name:      "Feedback Deur - Getallen",
summary:   "Peil de deelnemers hun tevredenheid met de retro op een schaal van 1 tot 5 in zo min mogelijk tijd",
desc:      "Plak post-its op de deur met de getallen 1 tot 5 er op. 1 komt bovenaan en is het beste. 5 komt onderaan en is het slechtst.\
Vraag aan het eind van de retrospective aan de deelnemers om een post-it op te hangen bij het getal die het beste hun gevoel over de retrospective weergeeft. Het geeltje mag leeg zijn of een opmerking of suggestie bevatten.",
source:    "ALE 2011, " + source_findingMarbles,
duration:  "2-3",
suitable: "iteration, largeGroups"
};
all_activities[14] = {
phase:     4,
name:      "Waarderingen",
summary:   "Laat de teamleden elkaar waarderen en eindig positief",
desc:      "Begin met het geven van een oprechte waardering van een van de deelnemers. \
Het kan gaan over alles waar ze aan bijgedragen hebben: hulp aan het team of aan jou, het oplossen van een probleem, ...\
Nodig dan de anderen uit om dat ook te doen en wacht tot iemand de moed verzamelt heeft. Sluit af als er gedurende een volle minuut niemand iets zegt.",
source:    source_agileRetrospectives + " die het overnamen uit 'The Satir Model: Family Therapy and Beyond'",
duration:  "5-30 groupsize",
suitable: "iteration, release, project"
};
all_activities[15] = {
phase:     4,
name:      "Hielp, Hinderde, Hypothese",
summary:   "Ontvang concrete feedback over je coaching",
desc:      "Bereid 3 flipchart vellen voor getiteld 'Hielp', 'Hinderde', en 'Hypothese' (suggesties om dingen uit te proberen). \
Vraag de deelenemers om je te helpen groeien als coach door op een post-it suggesties te schrijven met hun initialen, zodat je ze later om nadere toelichting kunt vragen.",
source:    source_agileRetrospectives,
duration:  "5-10",
suitable: "iteration, release"
};
all_activities[16] = {
phase:     4, // 5 gaat ook
name:      "MeEvMi (Meer, Evenveel, Minder)",
summary:   "Krijg koerscorrecties voor wat je doet als facilitator",
desc:      "Verdeel een flip chart in 3 secties getiteld 'Meer van', 'Evenveel als', en 'Minder van'. \
Vraag de deelnemers om je gedrag in de juiste richting te duwen: Laat hen op stickes beschrijven wat je meer moet doen, wat je minder moet doen en wat er precies goed is. Lees de resultaten hardop voor en bespreek de stickes per sectie.",
more:      "<a href='http://www.scrumology.net/2010/05/11/samolo-retrospectives/'>David Bland's ervaringen</a>",
source:    "<a href='http://fairlygoodpractices.com/samolo.htm'>Fairly good practices</a>",
duration:  "5-10",
suitable: "iteration, release, project"
};
all_activities[17] = {
phase:     0,
name:      "Check In - Amazon Review",
summary:   "Schrijf een review van de iteratie voor Amazon. En vergeet de sterbeoordeling niet!",
desc:      "Elk team lid schrijft een korte review met: \
<ul>\
    <li>Titel</li>\
    <li>Inhoud</li>\
    <li>Sterbeoordeling (5 sterren is het best) </li>\
</ul>\
Iedereen leest zijn review voor. Houdt de sterbeoordelingen bij op een flipchart.<br>\
Dit kan de hele retrospective in beslag nemen door ook te informeren naar wat er aan te bevelen was aan de sprint en wat niet.",
source:    "<a href='http://blog.codecentric.de/2012/02/unser-sprint-bei-amazon/'>Christian Hei&szlig;</a>",
duration:  "10",
suitable: "release, project"
};
all_activities[18] = {
phase:     1,
name:      "Speedboot / Zeilboot",
summary:   "Analyseer welke krachten je voortduwen en welke je terugduwen",
desc:      "Teken een speedboot op een flipchartvel. Geef het zowel een sterke motor als een zwaar anker. De teamleden schrijven zwijgend op stickies wat het team voortstuwde en wat het verankerde. Per postit 1 idee. Plak vervolgens de stickies op de motor en het anker al naar gelang waar ze thuishoren. Lees iedere notitie voor en bespreek hoe je de motoren kunt vermeerderen en de ankers los kan snijden.",
source:    "<a href='http://leadinganswers.typepad.com/leading_answers/2007/10/calgary-apln-pl.html'>Leading Answers</a>, die het aangepast hebben van " + source_innovationGames,
duration:  "10-15 groupSize",
suitable: "iteration, release"
};
all_activities[19] = {
phase:     2,
name:      "Perfectioneringsspel (Perfection Game)",
summary:   "Wat zou de volgende spring perfect maken?",
desc:      "Bereid een flip chart voor met twee kolommen, een smalle voor 'Beoordeling' en een brede voor 'Acties'. \
Iedereen beoordeelt de afgelopen sprint op een schaal van 1 (slecht) tot 10 (goed). Dan moeten ze voorstellen welke acties de volgende sprint beter zouden maken om een 10 te scoren.",
source:    "<a href='http://www.benlinders.com/2011/getting-business-value-out-of-agile-retrospectives/'>Ben Linders</a>",
suitable: "iteration, release"
};
all_activities[20] = {
phase:     3,
name:      "Samenvoegen",
summary:   "Verkort de lijst met heel veel mogelijke acties tot twee acties die het team wil uitproberen",
desc:      "Deel indexkaartjes en stiften uit. Geef iedereen de opdracht om de twee acties die zij volgende sprint uit willen proberen zo concreet mogelijk op te schrijven \
(<a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART</a>). Verdeel de groep vervolgens in paren en laat hen hun twee lisjtjes samenvoegen tot 1 lijst met twee acties. Maak vervolgens groepen van vier en daarna van acht. Verzamel ten slotte de lijstjes van ieder groepje en stem over wat de winnende acties worden.",
source:    "Lydia Grawunder & Sebastian Nachtigall",
duration:  "15-30 groupSize",
suitable: "iteration, release, project, largeGroups"
};
all_activities[21] = {
phase:     0,
name:      "Temperature Reading",
summary:   "Participants mark their 'temperature' (mood) on a flipchart",
desc:      "Prepare a flipchart with a drawing of a thermometer from freezing to body temperature to hot.\
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
photo:    "<a href='http://www.plans-for-retrospectives.com/static/images/activities/25_Cause-Effect-Diagramm.jpg' rel='lightbox[activity24]'>View Photo</a>",
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
If the group has an odd number of members, the facilitator is part of a pair but the partner gets \
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
name:      "Circles & Soup / Circle of Influence & Concern",
summary:   "Create actions based on how much control the team has to carry them out",
desc:      "Prepare a flip chart with 3 concentric circles, each big enough to put stickies in. Label them \
'Team controls - Direct action', 'Team influences - Persuasive/recommending action' and 'The soup - Response action', \
from innermost to outermost circle respectively. ('The soup' denotes the wider system the team is embedded into.)\
Take your insights from the last phase and put them in the appropriate circle.<br>\
The participants write down possible actions in pairs of two. Encourage them to concentrate on issues in their \
circle of influence. The pairs post their action plans next to the respective issue and read it out loud.\
Agree on which plans to try (via discussion, majority vote, dot voting, ...)",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/07/26/circles-and-soup/'>Futureworks Consulting</a> \
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
desc:      "Distribute index cards and markers. Set a topic, e.g. one of the following:\
<ul>\
    <li>How did you feel during the iteration?</li>\
    <li>What was the most remarkable moment?</li>\
    <li>What was the biggest problem?</li>\
    <li>What did you long for?</li>\
</ul>\
Ask the team members to draw their answer. Post all drawings on a whiteboard. For each drawing \
let people guess what it means, before the artist explains it.<br>\
Metaphors open new viewpoints and create a shared understanding.",
source:    source_findingMarbles + ", adapted from \
<a href='http://vinylbaustein.net/2011/03/24/draw-the-problem-draw-the-challenge/'>Thorsten Kalnin</a>\
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
it was the best, most productive iteration yet! How do your future selves describe it? What do you \
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
Lead a short discussion on what the top 20% beneficial ideas are. Vote on it by distributing dots\
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
source:    "<a href='http://agileretrospectivewiki.org/index.php?title=Weekly_Retrospective_Simple_%2B_delta'>Retrospective Wiki</a>",
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
phase:     1,
name:      "Postcards",
summary:   "Participants pick a postcard that represents their thoughts / feelings",
desc:      "Bring a stack of diverse postcards - at least 4 four times as many as participants. \
Scatter them around the room and instruct team members to pick the postcard that best \
represents their view of the last iteration. After choosing they write down three keywords \
describing the postcard, i.e. sprint, on index cards. In turn everyone hangs up their post- and \
index cards and describes their choice.",
source:    "<a href='http://finding-marbles.com/2012/03/19/retrospective-with-postcards/'>Corinna</a>",
duration:  "15-20",
suitable: "iteration, release, project",
photo:    "<a href='http://findingmarblesdotcom.files.wordpress.com/2012/03/retrospective-with-postcards3.jpg' rel='lightbox[activity41]'>View Photo</a>"
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
desc:      "Go back to the roots and start into the retrospectives by asking 'Why do we do this?'\
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
    <li>We talked about what was most important to me.</li>\
    <li>I spoke openly today.</li>\
    <li>I think the time of the retrospective was well invested.</li>\
    <li>I am confident we will carry out our action items.</li>\
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
photo:    "<a href='http://www.plans-for-retrospectives.com/static/images/activities/54_Story-Oscars.jpg' rel='lightbox[activity53]'>View Photo</a>"
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
    <li>One team member after the other places their sticky note and explains their placement</li>\
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
summary:   "Thow a ball around and uncover learning",
desc:      "Throw a ball (e.g. koosh ball) around the team and uncover positive thoughts and learning experiences. Give out a question at the beginning \
that people answer when they catch the ball, such as: \
<ul>\
    <li>One thing I learned in the last sprint</li>\
    <li>One awesome thing someone else did for me</li>\
</ul>\
Depending on the question it might uncover events that are bugging people. If any alarm bells go off, dig a little deeper. With the '1 nice thing'-question \
you usually close on a positive note.",
source:    "<a href='http://scrumfoundation.com/about/catherine-louis'>Catherine Louis</a> and <a href='http://blog.haaslab.net/'>Stefen Haas</a> via <a href='https://www.linkedin.com/in/misshaley'>Amber Haley</a>",
duration:  "5-10 min",
suitable:  "iteration, project",
photo:    "<a href='https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcTrZZvgbLqG_3Tr5TOZr4HAuy0f4JlKtpoF5uOTe9HCtC3IbzIf' rel='lightbox[activity59]'>View Photo</a>"
};
all_activities[60] = {
phase:     3,
name:      "Chaos Cocktail Party",
summary:   "Actively identify, discuss, clarify and prioritize a number of actions",
desc:      "Everyone writes one card with an action that is important to do. \
Then team members go around and chat about the cards \
like in a cocktail party. Every chat pair discusses the actions on their \
two cards. The moderator \
stops the chatting after 1 minute. Each chat pair splits \
5 points between the two cards. More points go to the more important action. The moderator facilitates \
3 to 5 rounds of chats (depending on group size). At the end everyone adds \
up the points on their card. In the end the cards are ranked by points \
and the team decides how much can be done in the next iteration, pulling from the top.",
source:    "Suzanne Garcia via <a href='http://www.wibas.com'>Malte Foegen</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release, largeGroup"
};
all_activities[61] = {
phase:     5,
name:      "Expectations",
summary:   "What can others expect of you? What can you expect of them?",
desc:      "Give each team member a piece of paper. The lower half is blank. The top half is divided into two sections:\
<ul>\
    <li>What my team mates can expect of me</li>\
    <li>What I expect of my team mates</li>\
</ul>\
Each person fills out the top half for themselves. When everyone is finished, they pass their \
paper to the left and start reviewing the sheet that was passed to them. In the lower half they \
write what they personally expect from that person, sign it and pass it on.<br>\
When the papers made it around the room, take some time to review and share observations.",
source:    "<a href='http://agileyammering.com/2013/01/25/expectations/'>Lily</a>",
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
desc:      "Draw a big square and divide it into 2 columns.\
Label them 'Interesting' and 'Dull'. Let the team write down everything they did last iteration on stickies and \
put it into the appropriate column. Have them add a rough estimate of how long it took on each of their own stickies.<br>\
Now add a horizontal line so that your square has 4 quadrants. Label the top row 'Short' (took hours)\
and the bottom row 'Long' (took days). Rearrange the stickies in each column.<br>\
The long and dull stories are now nicely grouped to 'attack' in subsequent phases.<br>\
<br>\
(Splitting the assessment into several steps, improves focus. You can \
<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>\
    adapt Quartering for lots of other 2-dimensional categorizations</a>.)",
source:    "<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>Wayne D. Grant</a>",
duration:  "10",
suitable:  "iteration, project",
photo:    "<a href='http://waynedgrant.files.wordpress.com/2012/08/quartering41.jpg?w=413&h=450' rel='lightbox[activity63]'>View Photo</a>"
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
source:     source_judith,
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
name:      "Divide the dollar",
summary:   "How much is an action item worth to the team?",
desc:      "Hang up the list of possible actions. Draw a column next to it, titled 'Importance (in $)'. \
Tell the team they get to spend 100 (virtual) dollars on the action items. The more \
important it is to them, the more they should spend. Make it more fun by bringing paper \
money from a board game such as Monopoly.\
<br><br>Let them agree on prices. Consider the 2 or 3 highest amount action items as chosen.",
source:     "<a href='http://www.gogamestorm.com/?p=457'>Gamestorming</a>",
duration:  "10 min groupsize",
suitable:  "iteration, project, release"
};