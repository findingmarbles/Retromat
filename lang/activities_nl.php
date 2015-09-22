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
Ieder teamlid moet ten minste 9 indexkaarten schrijven: 3 van ieder met dingen die het team moet gaan doen (Start), \
moet blijven doen (Volhouden), of niet meer moet doen (Stop). Kies een persoon die als eerte spelleider is. \
De spelleider draait het eerste kwaliteitenkaartje om. Uit zijn eigen indexkaarten kiest hij degeen die het \
beste bij deze kwaliteit past en legt deze omgekeerd op tafel.\
Alle anderen kiezen uit hun eigen kaarten ook een kaart die bij deze kwaliteit past en legen deze omgekeerd op \
tafel. Degene die als laatste kiest moet zijn indexkaart weer terugnemen in zijn hand. De spelleider schudt alle \
kaarten die op tafel liggen, draait ze een voor een om en kiest de best passende kaart. (Hij/zij moet dit ook beargumenteren.) \
Alle andere kaarten worden uit het spel verwijderd. De persoon die de winnende kaart heeft ingediend ontvangt de \
kaart met de kwaliteit. Vervolgens wordt de volgende persoon (met de klok mee) de spelleider.<br> \
Stop het spel zodra de kaarten op zijn (6-9 ronden). Degene met de meeste kwaliteitenkaartjes heeft gewonnen. Sluit \
het spel af met een rondvraag naar wat iedereen geleerd heeft.<br>\
(Dit spel is gebaseerd op het spel 'Appels en Peren')",
source:    source_agileRetrospectives,
duration:  "30-40",
suitable: "iteration, introverts"
};
all_activities[6] = {
phase:     1,
name:      "Boos Bedroefd Blij",
summary:   "Verzamel gebeurtenissen waarbij teamleden zich boos, bedroefd of blij voelden en vind de oorzaken",
desc:      "Hang drie posters op genaamd 'boos', 'bedroefd', en 'blij' (of '>:), :(, :) respectievelijk).  De teamleden \
schrijven een gebeurtenis op een kleurgecodeerd kaartje (1 gebeurtenis per kaartje) en hoe ze zich toen voelden. Als de \
tijd om is, hangt iedereen zijn post-its op de bijbehorende poster. Groepeer de kaartjes op iedere poster. Vraag de groep \
om iedere cluster een naam te geven. <br>\
Bespreek het resultaat met de volgende vragen: \
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
name:      "Leermatrix",
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
    <li>Pas vervolgens alle filters toe op de ideeen en markeer de ideeen die aan alle vier de filters voldoen.</li> \
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
name:      "Stemmen met stippen (dotvoting)- Start, Stop, Doorgaan",
summary:   "Brainstorm over welke dingen gestart, gestopt & voortgezet moeten worden en kies de hoogstscorende initiatieven",
desc:      "Verdeel een flipover in vakken met de titels 'Start', 'Doorgaan' en 'Stop'. \
Vraag de deelnemers om voor elke categorie concrete voorstellen op te schrijven - 1 idee per index kaart. Laat ze \
gedurende een paar minuten in stilte schrijven. \
Laat iedereen zijn notities voorlezen en in de gewenste categorie hangen. \
Leid een korte discussie over wat de 20% meest zinvolle ideeen zijn. \
Laat iedereen stemmen met stippen of streepjes met een marker op de kaartjes, waarbij iederen bijv. 1, 2 of 3 stippen \
per persoon te verdelen heeft over de kaartjes. De twee of drie kaartjes met de meeste stemmen worden je actie items. \
<br><br>\
(Kijk ook eens naar <a='http://agileretroactivities.blogspot.co.at/search/label/innovation'>Paulo Caroli's 'Open the Box'</a> \
voor een leuke variatie op deze activiteit.)",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[12] = {
phase:     3,
name:      "SMART Doelen",
summary:   "Formuleer een specifiek en meetbaar actieplan",
desc:      "Introduceer <a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART doelen</a>\
(specific-specifiek, measurable-meetbaar, attainable-haalbaar, relevant-relevant, timely-tijdig) en geef voorbeelden \
van SMART vs doelen die niet zo SMART zijn. bijv. 'We zullen elke woensdag om 9 uur stories bestuderen voordat we ze \
in de sprint opnemen door er over te praten met de product owner' vs. 'We zullen de stories beter leren kennen voor ze \
in de sprint backlog komen'.<br>\
Vorm groepen rondom de issues waaraan het team werken wil. Iedere groep identificeert 1-5 concrete stappen om het doel \
te bereike. Laat iedere groep rapporteren. Alle deelnemers moeten het eens zijn met de SMART-heid van de doelen. Verfijn en bevestig.",
source:    source_agileRetrospectives,
duration:  "20-60 groupsize",
suitable: "iteration, release, project"
};
all_activities[13] = {
phase:     4,
name:      "Feedback Deur - Getallen",
summary:   "Peil de deelnemers hun tevredenheid met de retro op een schaal van 1 tot 5 in zo min mogelijk tijd",
desc:      "Plak post-its op de deur met de getallen 1 tot 5 er op. 1 komt bovenaan en is het beste. 5 komt onderaan en is het slechtst. \
Vraag aan het eind van de retrospective aan de deelnemers om een post-it op te hangen bij het getal die het beste hun \
gevoel over de retrospective weergeeft. Het geeltje mag leeg zijn of een opmerking of suggestie bevatten.",
source:    "ALE 2011, " + source_findingMarbles,
duration:  "2-3",
suitable: "iteration, largeGroups"
};
all_activities[14] = {
phase:     4,
name:      "Waarderingen",
summary:   "Laat de teamleden elkaar waarderen en eindig positief",
desc:      "Begin met het geven van een oprechte waardering van een van de deelnemers. \
Het kan gaan over alles waar ze aan bijgedragen hebben: hulp aan het team of aan jou, het oplossen van een probleem, ... \
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
source:    source_innovationGames + ", vinden op <a href='http://leadinganswers.typepad.com/leading_answers/2007/10/calgary-apln-pl.html'>Leading Answers</a>",
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
name:      "Temperatuur uitlezen",
summary:   "Deelnemers zetten hun 'temperatuur' (stemming) op een flipchart",
desc:      "Bereid een flipchart voor met een tekening van een thermometer met temperaturen van vrieskou tot lichaamstemperatuur tot heet.\
Elke deelnemer geeft zijn stemming aan op het blad.",
source:  source_unknown
};
all_activities[22] = {
phase:     4,
name:      "Feedback Deur - Smilies",
summary:   "Peil de tevredenheid van de deelnemers over de retro in minimale tijd met gebruik van smilies",
desc:      "Teken een ':)', ':|', en ':(' op een vel papier en plak die aan de deur. \
Vraag aan het eind van de retrospective aan de deelnemers om hun tevredenheid aan te geven door \
een 'x' onder de toepasselijke smily te zetten.",
source:    "<a href='http://boeffi.net/tutorials/roti-return-on-time-invested-wie-funktionierts/'>Boeffi</a>",
duration:  "2-3",
suitable: "iteration, largeGroups"
};
all_activities[23] = {
phase:     3,
name:      "Open Items Lijst",
summary:   "Deelnemer stellen acties voor en schrijven zich er voor in",
desc:      "Bereid een flipchart voor met drie columns getiteld 'Wat', 'Wie', en 'Te doen voor'. \
Vraag de deelnemers een voor een wat zij willen doen om het team vooruit te helpen. \
Schrijf de taak op en spreek een einddatum af en laat die persoon zijn naam er achter zetten. <br>\
Als iemand een actie voor het hele team voorstelt, moet deze persoon de actie aan de rest van team zien te verkopen \
en de handtekeningen van de anderen zien te verzamelen.",
source:    source_findingMarbles + ", inspired by <a href='http://lwscologne.wordpress.com/2012/05/08/11-treffen-der-limited-wip-society-cologne/#Retrospektiven'>this list</a>",
duration:  "10-15 groupSize",
suitable: "iteration, release, smallGroups"
};
all_activities[24] = {
phase:     2,
name:      "Oorzaak-Gevolg-Diagram",
summary:   "Zoek de bron van problemen waarvan de oorzaak moeilijk vast te stellen is en die tot eindeloze discussie leiden",
desc:      "Schrijf het probleem dat je wilt onderzoeken op een stickie en plak die op het midden van het whiteboard. \
Zoek uit waarom het een probleem is door herhaaldelijk 'Dus?' en 'Ja en?' te vragen. Zoek de onderliggend oorzaak van het probleem \
door herhaaldelijk 'Waarom (doet zich dit voor)?' te vragen. Documenteer de bevindingen door \
meer stickies te schrijven en causale relaties te leggen met behulp van pijlen. Iedere stickie kan meer dan een \
reden hebben en meer dan een gevolg.<br> \
Vicieuze circels zijn meestal een goed aangrijppunt voor acties. Als je hun slechte invloed kunt verbreken, kun je al een hoop winnen.",
source:    "<a href='http://blog.crisp.se/2009/09/29/henrikkniberg/1254176460000'>Henrik Kniberg</a>",
more:      "<a href='http://finding-marbles.com/2011/08/04/cause-effect-diagrams/'>Corinna's experiences</a>",
duration:  "20-60 complexity",
photo:    "<a href='http://www.plans-for-retrospectives.com/static/images/activities/25_Cause-Effect-Diagramm.jpg' rel='lightbox[activity24]'>View Photo</a>",
suitable: "release, project, smallGroups, complex"
};
all_activities[25] = {
phase:     2,
name:      "Speeddaten",
summary:   "Ieder teamlid verkent een onderwerp tot in de uithoeken in een serie 1 op 1 gesprekken",
desc:      "Iedere deelnemer schrijft een onderwerp op dat ze willen uitdiepen, bijvoorbeeld iets dat ze willen veranderen. \
Daarna worden er tweetallen gevormd en over de ruimte verdeeld. Ieder tweetal bespreekt beide onderwerpen \
en denkt na over mogelijke acties - 5 minuten per deelnemer (onderwerp) - de een na de ander. \
Na 10 minutes worden er nieuwe tweetallen gevormd. Ga zo door totdat iedereen alle anderen gesproken heeft. <br>\
Als de groep een oneven aantal leden heeft, is de facilitator deel van een tweetal, maar krijgt het teamlid de volledige \
10 minuten voor hun onderwerp.",
source:    source_kalnin,
duration:  "10 perPerson",
suitable: "iteration, release, smallGroups"
};
all_activities[26] = {
phase:     5,
name:      "Retrospective Koekjes",
summary:   "Neem het team mee uit eten en zwengel de discussie aan met retrospective gelukskoekjes",
desc:      "Neem het team mee uit eten, bij voorkeur Chinees als je in thema wilt blijven. ;) \
Verdeel de gelukskoekjes en ga de tafel rond om de koekjes te openen en hun inhoud te bespreken. \
Voorbeeld 'spreuken': \
<ul>\
    <li>Wat was het meest effectieve dat je deze sprint deed, en waarom was het zo succesvol?</li>\
    <li>Reflecteerde de burndown de realiteit? Waarom?</li>\
    <li>Wat heb je bijgedragen aan de ontwikkelaars in het bedrijf? Wat zou je kunnen bijdragen?</li>\
    <li>Wat was het grootste struikelblok deze sprint?</li>\
</ul>\
Je kunt <a href='http://weisbart.com/cookies/'>retrospective koekjes bestellen van Weisbart</a> \
of je eigen koekjes bakken, bijvoorbeeld als niet iedereen in het team Engels spreekt.",
source:    "<a href='http://weisbart.com/cookies/'>Adam Weisbart</a>",
duration:  "90-120",
suitable: "iteration, release, smallGroups"
};
all_activities[27] = {
phase:     5,
name:      "Maak een Wandeling",
summary:   "Ga naar het dichtstbijzijnde park om een wandeling te maken en praat gewoon met elkaar",
desc:      "Is het buiten mooi weer? Waarom zou je dan binnen opgesloten blijven, terwijl een wandeling je hersenen vult met zuurstof \
en nieuwe ideeën 'buiten de gebaande paden'. Ga naar buiten en maak een wandeling in het dichtstbijzijnde park. Het gesprek zal \
natuurlijk ove rhet werk gaan. Dit is een mooie afwijking van de routine als alles relatief goed gaat en \
je geen visuele documentatie nodig hebt om de discussie te ondersteunen. Volwassen teams kunnen hun ideeën gemakkelijke verspreiden en \
consensus bereiken, zelfs in zo'n informele setting.",
source:    source_findingMarbles,
duration:  "60-90",
suitable: "iteration, release, smallGroups, smoothSailing, mature"
};
all_activities[28] = {
phase:     3,
name:      "Cirkels &amp; het soepie / Invloedscirkels",
summary:   "Creëer acties gebaseerd op hoeveel invloed het team heeft om ze uit te voeren",
desc:      "Bereid een flipchart voor met daarop 3 concentrische cirkels, die ieder groot genoeg zijn om er stickies in te plakken. Label ze met \
'Team beheerst - Directe actie', 'Team beïnvloedt - Overtuigende/aanbevelende actie' en 'Het soepie - Reactieve actie', \
respectievelijk van binnen naar buiten. ('Het soepie' geeft de bredere organisatie aan waarbinnen het team zich bevindt.) \
Neem de inzichten uit de vorige fase en hang ze in de toepasselijke cirkel.<br> \
De deelnemers schrijven in tweetallen mogelijke acties op. Druk hen op het hart om zich zoveel mogelijk te concentreren op zaken in hun \
invloedscirkel. De tweetallen hangen hun actieplan naast het bijbehorende inzicht en lezen het hardop voor. \
Bereik overeenstemming over welke acties uitgevoerd gaan worden (d.m.v. discussie, meerderheidsstemming, Stemmen met stippen (dotvoting), ...)",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/07/26/circles-and-soup/'>Diana Larsen</a> \
die het aanpaste vanuit 'Seven Habits of Highly Effective People' van Stephen Covey en \
'<a href='http://www.ayeconference.com/wiki/scribble.cgi?read=CirclesOfControlInfluenceAndConcern'>Circle of Influence And Concern</a>' van Jim Bullock",
suitable: "iteration, release, project, stuck, immature"
};
all_activities[29] = {
phase:     5,
name:      "Dialoogvellen",
summary:   "Een gestructureerde aanpak om te discussiëren",
desc:      "Een dialoogvel lijkt een beetje op een spelbord. Er zijn \
<a href='http://www.softwarestrategy.co.uk/dlgsheets/available.html'>verschillende vellen beschikbaar</a>. \
Kies er een, print het zo groot mogelijk uit (bij voorkeur op A1) en volg de instructies.",
source:    "<a href='http://www.softwarestrategy.co.uk/dlgsheets/available.html'>Allen Kelly at Software Strategy</a>",
duration:  "90-120",
suitable: "iteration, release, project"
};
all_activities[30] = {
phase:     0,
name:      "Inchecken - Teken de Iteratie",
summary:   "De deelnemers tekeken een aspect van de iteratie",
desc:      "Geef iedereen indexkaartjes en stiften. Stel een onderwerp vast, bijvoorbeeld een van de volgende: \
<ul>\
    <li>Hoe voelde je je tijdens de iteratie?</li>\
    <li>Wat was het meest opmerkelijke moment?</li>\
    <li>Wat was het grootste probleem?</li>\
    <li>Waar verlangde je naar?</li>\
</ul>\
Vraag de teamleden om het antwoord te tekenen. Hang alle tekeningen aan het whiteboard. Laat voor iedere tekening \
de overige deelnemers raden wat het betekent voor de tekenaar het uitlegt.<br> \
Metaforen openen nieuwe perspectieven en creëren een gedeelde begripsvorming.",
source:    source_findingMarbles + ", aangepast van \
           <a href='http://vinylbaustein.net/2011/03/24/draw-the-problem-draw-the-challenge/'>Thorsten Kalnin</a> \
           en Olivier Gourment",
duration:  "5 + 3 per person",
suitable: "iteration, release, project"
};
all_activities[31] = {
phase:     0,
name:      "Emoticon Project Meter",
summary:   "Help teamleden om hun gevoelens over het project te uiten om de onderliggende oorzaak vroeg aan te kunnen pakken",
desc:      "Bereid een flipchart voor met daarop gezichten die verschillende emoties uitdrukken zoals: \
<ul>\
    <li>geschokt / verbaasd</li>\
    <li>nerveus / gestressed</li>\
    <li>machteloos / beperkt</li>\
    <li>verward</li>\
    <li>blij</li>\
    <li>boos</li>\
    <li>overweldigd</li>\
</ul>\
Laat ieder teamlid kiezen hoe ze zich voelen over het project. Dit is een leuke en effectieve manier om problemen vroegtijdig op te sporen. \
Je kunt de problemen in de volgende fasen addresseren.",
source:    "Andrew Ciccarelli",
duration:  "10 for 5 people",
suitable: "iteration, release"
};
all_activities[32] = {
phase:     1,
name:      "Trots & beschaamd",
summary:   "Waar zijn de teamleden trots op of schamen ze zich voor?",
desc:      "Hang twee posters op genaamd 'trots' en 'beschaamd'. De teamleden schrijven items op stickies (1 item per sticky). \
Zodra de tijd voorbij is, leest iedereen zijn briefjes voor en hangen het op de toepasselijke poster. <br>\
Begin een korte conversatie. Bijvoorbeeld door te vragen::\
<ul>\
    <li>Was er iets dat je verraste?</li>\
    <li>Welke patronen zie je? Wat betekenen die voor het team?</li>\
</ul>",
source:    source_agileRetrospectives,
duration:  "10-15",
suitable: "iteration, release"
};
all_activities[33] = {
phase:     4,
name:      "Waarderingsregen",
summary:   "Luister hoe anderen achter je rug over je praten - maar dan alleen de goede dingen!",
desc:      "Vorm groepjes van 3. Iedere groep zet de stoelen zo neer dat er 2 stoelen tegenover elkaar staan \
en de derde met de rug er naar toe, als volgt: >^<. \
De twee mensen die op de stoelen zitten die naar elkaar kijken praten gedurende twee minuten over de derde persoon. \
Daarbij mogen ze alleen positieve dingen zeggen en niets dat gezegd wordt mag later door iets anders te zeggen in waarde verlaagd worden. <br>\
Hou drie rondes, waarbij iedereen een keer in de 'regenstoel' komt te zitten.",
source:    '<a href="http://www.miarka.com/de/2010/11/shower-of-appreciation-or-talking-behind-ones-back/">Ralph Miarka</a>',
duration:  "10-15",
suitable: "iteration, release, matureTeam"
};
all_activities[34] = {
phase:     1,
name:      "Agile zelfbeoordeling",
summary:   "Beoordeel waar je staat met een checklist",
desc:      "Print een checklist die je aanspreekt, bijvoorbeeld:\
<ul>\
    <li><a href='http://www.crisp.se/gratis-material-och-guider/scrum-checklist'>Henrik Kniberg's uitstekende Scrum Checklist</a></li>\
    <li><a href='http://finding-marbles.com/2011/09/30/assess-your-agile-engineering-practices/'>Self-assessment of agile engineering practices</a></li>\
    <li><a href='http://agileconsortium.blogspot.de/2007/12/nokia-test.html'>Nokia Test</a></li>\
</ul>\
Loop de lijst door met het team en bespreek waar je staat en of je op de goede weg bent.<br>\
Dit is een mooie activiteit na een iteratie zonder grote gebeurtenissen.",
source:    source_findingMarbles,
duration:  "10-25 minutes depending on the list",
suitable: "smallTeams, iteration, release, project, smoothGoing"
};
all_activities[35] = {
phase:     0,
name:      "Positief doel",
summary:   "Bepaal een positief doel voor de sessie",
desc:      "Concentreer je op de positive aspecten in plaats van op de problemen door een positief doel vast te stellen, bijv.\
<ul>\
    <li>Laten we manieren zoeken om de sterke punten van ons proces en ons team te versterken</a></li>\
    <li>Laten we uitzoeken hoe we de beste manieren om onze engineering practices en methoden te gebruiken kunnen uitbreiden</li>\
    <li>We gaan kijken naar onze best werkende relaties en manieren zoeken om meer van zulke relaties op te bouwen</li>\
    <li>We gaan ontdekken waar we de meeste waarde hebben toegevoegd in onze laatste iteratie om de toegevoegde waarde van onze volgende iteratie te vergroten</li>\
</ul>",
source:    "<a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
duration:  "3 minutes",
suitable: "iteration, release, project"
};
all_activities[36] = {
phase:     2,
name:      "Herinneringen uit de toekomst",
summary:   "Stel je voor dat de volgende iteratie perfect is. Hoe zou dat zijn? Wat heb je gedaan?",
desc:      "'Stel je voor dat je in de toekomst kunt reizen naar het eind van de volgende iteratie (of release). Daar leer je dat het de beste, \
meest productieve iteratie tot dusver was! Hoe zullen jullie toekomstige tegenhangers het beschrijven? Wat zie en hoor je?' \
Geef het team wat tijd om zich dit voor te stellen en schrijf wat steekwoorden op om hun geheugen op te frissen. \
Laat vervolgens iedereen zijn visie van de perfecte iteratie beschrijven.<br>\
Stel vervolgens de vraag 'Welke veranderingen hebben we doorgevoerd die resulteerden in zo'n productieve en bevredigende toekomst?'\
Schrijf de antwoorden op index kaarten om in de volgende fase te gebruiken.",
source:    source_innovationGames + ", found at <a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
suitable: "iteration, release, project"
};
all_activities[37] = {
phase:     3,
name:      "Stemmen met stippen (dotvoting) - Houden, Opgeven, Toevoegen",
summary:   "Hou een brainstormsessie over welke gedragingen gehouden, opgegeven en toegevoegd moeten worden en kies daaruit de favoriete initiatieven",
desc:      "Verdeel een flipchart in drie vakken getiteld 'Houden', 'Opgeven' en 'Toevoegen'. \
Vraag de deelnemers om concrete voorstellen voor iedere categorie op te schrijven - 1 idee per index kaart. \
Laat ze een paar minuten in stilte schrijven. \
Laat dan iedereen zijn aantekeningen voorlezen en in de juiste categorie hangen. \
Leid een korte discussie over wat de 20% meest waardevolle ideeën zijn. Stem er op door stippen, kruisjes of streepjes op de kaartjes te zetten met een stift. \
Bijvoorbeeld 1, 2, of 3 stippen die iedere persoon mag uitdelen. \
De top 2 of 3 worden de actie items voor de volgende iteratie.",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[38] = {
phase:     3,
name:      "Stemmen met stippen (dotvoting) - Werkte goed, Anders doen",
summary:   "Hou een brainstormsessie over wat goed werkte en wat er anders moet en kies daaruit de favoriete initiatieven",
desc:      "Neem twee flip charts met de titels 'Werkte goed' en 'Volgende keer anders doen'. \
Vraag de deelnemers om concrete voorstellen per categorie op te schrijven, 1 idee per sticky. \
Laat ze een paar minuten in stilte schrijven. \
Laat dan iedereen zijn aantekeningen voorlezen en in de juiste categorie hangen. \
Leid een korte discussie over wat de 20% meest waardevolle ideeën zijn. Stem er op door stippen, kruisjes of streepjes op de kaartjes te zetten met een stift. \
Bijvoorbeeld 1, 2, of 3 stippen die iedere persoon mag uitdelen. \
De top 2 of 3 worden de actie items voor de volgende iteratie.",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[39] = {
phase:     4,
name:      "Plus & Delta",
summary:   "Iedere deelnemer schrijft 1 ding op dat hen bevalt en 1 ding dat ze zouden willen veranderen aan de retro",
desc:      "Bereid een flip chart voor met 2 kolommen: Zet er 'Plus' en 'Delta' boven. \
Vraag iedere deelnemer om 1 aspect van de retrospective op te schrijven dat hen bevalt \
en 1 ding dat ze zouden willen veranderen (op verschillende indexkaartjes). Hang de indexkaartjes op de juiste flip chart \
en neem ze kort door om de exacte betekenis te verduidelijken en om de voorkeur van de meerderheid te peilen \
als kaartjes van verschillende mensen in verschillende richtingen wijzen.",
source:    "<a href='http://agileretrospectivewiki.org/index.php?title=Weekly_Retrospective_Simple_%2B_delta'>Rob Bowley</a>",
duration:  "5-10",
suitable: "release, project"
};
all_activities[40] = {
phase:     2,
name:      "Parkbank",
summary:   "Groepsdiscussie met varierende subsets van de deelnemers",
desc:      "Plaats tenminste 4 en maximaal 6 stoelen op een rij zodat ze naar de overige leden van de groep gericht zijn. \
Leg de regels uit: <ul>\
    <li>Neem plaats op de 'bank' als je wilt bijdragen aan de discussie</li>\
    <li>Er moet ten minste altijd 1 plek vrij zijn</li>\
    <li>Als de laatste plaats bezet wordt, dan moet iemand anders opstaan en naar het publiek terugkeren</li>\
</ul>\
Start de discussie door plaats te nemen op de 'bank' en hardop over iets na te denken \
dat je in de afgelopen iteratie geleerd hebt totdat er iemand bij komt zitten. \
Beëindig de activiteit als de discussie afsterft. \
<br>Dit is een variant op de zogenaamde 'Fish Bowl'. Het is geschikt voor groepen van 10-25 mensen.",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/08/24/park-bench/'>Diana Larsen</a>",
duration:  "15-30",
suitable: "release, project, largeGroups"
};
