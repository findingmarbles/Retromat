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
all_activities[41] = {
phase:     0,
name:      "Ansichtkaarten",
summary:   "De deelnemers kiezen een ansichtkaart die hun gedachten/gevoelens weerspiegelt",
desc:      "Neem een stapel met diverse ansichtkaarten mee - ten minste 4 keer zo veel kaarten als er deelnemers zijn. \
Verspreid ze over de ruimte en instrueer alle teamleden om de kaart te kiezen die het beste \
hun mening over de laatste iteratie weergeeft. Nadat ze gekozen hebben, schrijft iedereen drie steekwoorden \
op die hun kaart, ofwel de sprint, beschrijven op een indexkaart. Bij toerbeurt hangt iedereen zijn ansicht- en indexkaart op \
waarbij ze hun keuze beschrijven.",
source:    "<a href='http://finding-marbles.com/2012/03/19/retrospective-with-postcards/'>Corinna Baldauf</a>",
duration:  "15-20",
suitable: "iteration, release, project",
};
all_activities[42] = {
phase:     0,
name:      "Neem een standpunt in - Opening",
summary:   "Deelnemers nemen een standpunt en en geven daarmee hun tevredenheid met de iteratie aan",
desc:      "Creëer een grote schaal (ofwel een lange lijn) op de vloer met afplaktape. Markeer het ene  \
uiteinde als 'Geweldig' en het andere uiteinde als 'Dramatisch'. Laat de deelnemers plaatsnemen op de schaal \
afhankelijk van hun tevredenheid met de laatste iteratie. Psychologisch is het fysiek \
innemen van een standpunt anders dan van alleen maar iets zeggen. Het is 'echter'.<br> \
Je kunt de schaal hergebruiken als je afsluit met activiteit #44.",
source:    source_findingMarbles + ", inspired by <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
duration:  "2-5",
suitable: "iteration, release, project"
};
all_activities[43] = {
phase:     4,
name:      "Neem een standpunt in - Sluiting",
summary:   "Deelnemers nemen een standpunt en en geven daarmee hun tevredenheid met de retrospective aan",
desc:      "Creëer een grote schaal (ofwel een lange lijn) op de vloer met afplaktape. Markeer het ene  \
uiteinde als 'Geweldig' en het andere uiteinde als 'Dramatisch'. Laat de deelnemers plaatsnemen op de schaal \
afhankelijk van hun tevredenheid met de retrospective. Psychologisch is het fysiek \
innemen van een standpunt anders dan van alleen maar iets zeggen. Het is 'echter'.<br> \
Zie activiteit #43 om te zien hoe je de retrospective kunt beginnen met dezelfde schaal",
source:    source_findingMarbles + ", inspired by <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
duration:  "2-5",
suitable: "iteration, release, project"
};
all_activities[44] = {
phase:     4,
name:      "Blij & Verrast",
summary:   "Waar werden de deelnemers blij van en/of door verrast tijdens de retrospective",
desc:      "Doe een snel rondje langs de groep en laat de deelnemers een uitkomst \
van de retrospective aanwijzen waar ze blij van werden of door verrast werden (of beide).",
source:    source_unknown,
duration:  "5",
suitable: "iteration, release, project"
};
all_activities[45] = {
phase:     0,
name:      "Waarom Retrospectives?",
summary:   "Vraag 'Waarom doen we retrospectives?'",
desc:      "Ga terug naar de basics en start de retrospective met de vraag 'Waarom doen we dit?' \
Schrijf alle antwoorden op zodat iedereen ze zien kan. Laat je verrassen door de uitkomst.",
source:    "<a href='http://proessler.wordpress.com/2012/07/20/check-in-activity-agile-retrospectives/'>Pete Roessler</a>",
duration:  "5",
suitable: "iteration, release, project"
};
all_activities[46] = {
phase:     1,
name:      "De brievenbus legen",
summary:   "Bekijk de aantekeningen die tijdens de sprint verzameld zijn",
desc:      "Maak een retrospective brievenbus aan het begin van de iteratie. Iedere keer dat er iets Whenever something \
significants gebeurd of als iemand een idee voor een verbetering heeft, schrijven ze het op en posten het in de brievenbus. \
(Als alternatief kan de 'brievenbus' ook een zichtbare plek zijn. Dit kan de discussie al tijdens de iteratie \
aanzwengelen.) <br>\
Loop de brieven door en bespreek ze.<br>\
Een brievenbus is geweldig voor lange iteraties en vergeetachtige teams.",
source:    source_skycoach,
more:      "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Originele artikel</a>",
duration:  "15",
suitable: "release, project"
};
all_activities[47] = {
phase:     3,
name:      "Neem een standpunt in - Line Dance",
summary:   "Krijg een idee van waar iedereen staat en probeer consensus te bereiken",
desc:      "Als het team niet tussen twee opties kan kiezen, maak dan een grote schaal (bijv. een lange lijn) \
op de vloer met afplaktape. Markeer het ene uiteinde als optie A en het andere als optie B. \
Teamleden positioneren zich op de schaal al naar gelang hun voorkeur voor een van beide opties. \
Stel nu de opties bij tot een van de twee een duidelijke meerderheid heeft.",
source:    source_skycoach,
more:      "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Originele artikel</a>",
duration:  "5-10 per decision",
suitable: "iteration, release, project"
};
all_activities[48] = {
phase:     3,
name:      "Stemmen met stippen (dotvoting) - Zeester",
summary:   "Verzamel wat er gestart, gestopt, voortgezet, minder gedaan of meer gedaan moet worden",
desc:      "Teken vijf spaken op een flipchartvel, waardoor het vel in vijf segmenten verdeeld is. \
Label ze 'Start', 'Stop', 'Voortzetten', 'Meer doen' en 'Minder doen'. \
De deelnemers schrijven hun voorstellen op sticky notes en hangen die in het \
toepasselijke segment. Laat na het clusteren van de stickies die hetzelfde idee bevatten, \
iedereen stemmen op de suggesties die ze uit willen proberen.",
source:    "<a href='http://www.thekua.com/rant/2006/03/the-retrospective-starfish/'>Pat Kua</a>",
duration:  "15 min",
suitable:  "iteration, release, project"
};
all_activities[49] = {
phase:     2,
name:      "Wens vervuld",
summary:   "Een fee wil een van je wensen in vervulling laten gaan - hoe weet je dan dat je wens uit kwam?",
desc:      "Geef de deelnemers 2 minuten om in stilte de volgende vraag te overdenken: \
'Een fee vervult een wens die je grootste probleem op het werk 's nachts oplost. Wat zou je dan wensen?' \
Volg dit daarna op met: 'Je komt de volgende dag op het werk. Je kunt zien dat je wens uitgekomen is. \
Hoe weet je dat zo zeker? Wat is er nu anders?' Als het vertrouwen in de groep hoog is, laat iedereen \
dan zijn 'Vervulde wens'-werkplek beschrijven. Zo niet, vertel de deelnemers dan om hun scenario \
gedurende de volgende fase van de retrospective in hun achterhoofd te houden en acties voor te stellen die \
tot doel hebben om in de richting van die gewenste situatie te gaan.",
source:    "Lydia Grawunder &amp; Sebastian Nachtigall",
duration:  "15 min",
suitable:  "iteration"
};
all_activities[50] = {
phase:     1,
name:      "Lean Coffee",
summary:   "Gebruik het Lean Coffee format om de belangrijkste onderwerpen te bespreken",
desc:      "Vertel hoeveel tijd er beschikbaar is voor deze fase en leg dan de regels van Lean Coffee voor retrospectives uit: <ul>\
    <li>Iedereen schrijft de onderwerpen op die ze willen bespreken - 1 onderwerp per sticky</li>\
    <li>Hang de stickies op een whiteboard of flipchart. De persoon die het opschreef beschrijft het onderwerp in 1-2 zinnen. \
        Groepeer de stickies die over hetzelfde onderwerp gaan</li>\
    <li>Stem nu met stippen (dotvoting) voor de twee onderwerpen die je wilt bespreken</li>\
    <li>Sorteer de stickies aan de hand van de stemmen</li>\
    <li>Start met het onderwerp met de meeste interesse</li>\
    <li>Zet een wekker op vijf minuten. Als de wekker afgaat, steekt iedereen zijn duim op, omhoog of omlaag. \
        Als de meerderheid van de duimen omhoog is: Het onderwerp krijgt nog vijf minuten. \
		Als de meerderheid van de duimen omlaag is: Start het volgende onderwerp. </li>\
</ul> Stop als de beschikbare tijd op is.",
source:    "<a href='http://leancoffee.org/'>Originele beschrijving</a> en \
<a href='http://finding-marbles.com/2013/01/12/lean-altbier-aka-lean-coffee/'>in actie</a>",
duration:  "20-40 min",
suitable:  "iteration"
};
all_activities[51] = {
phase:     0,
name:      "Sterrenbeeld - Opening",
summary:   "Laat de deelnemers stellingen bevestigen of tegenspreken door rond te bewegen",
desc:      "Plaats een cirkel in het midden van de ruimte. Laat het team er omheen verzamelen. \
Leg uit dat de cirkel het centrum van instemming is: Als ze het met een stelling eens zijn moeten ze er naartoe bewegen, \
zo niet moeten ze er zo ver vandaan bewegen als ze het er mee oneens zijn. Lees nu stellingen voor, bijv.\
<ul>\
    <li>Ik kan openlijk spreken tijdens deze retrospective</li>\
    <li>Ik ben tevreden met de laatste sprint</li>\
    <li>Ik ben tevreden met de kwaliteit van onze code</li>\
    <li>Ik vind ons continuous integration proces volwassen</li>\
</ul>\
Zie hoe de sterrenbeelden zich ontplooien. Vraag na afloop welke sterrenbeelden verrassend waren.<br>\
Dit kan ook een afsluitende activiteit zijn (#53).",
source:    "<a href='http://www.coachingagileteams.com/'>Lyssa Adkins</a> via \
<a href='http://lmsgoncalves.com/2013/01/23/constellation-a-good-exercise-to-set-the-stage-in-the-retrospective/'>Luis Goncalves</a>",
duration:  "10 min",
suitable:  "iteration, project, release"
};
all_activities[52] = {
phase:     4,
name:      "Sterrenbeeld - Sluiting",
summary:   "Laat de deelnemers de retrospective beoordelen door rond te bewegen",
desc:      "Plaats een cirkel in het midden van de ruimte. Laat het team er omheen verzamelen. \
Leg uit dat de cirkel het centrum van instemming is: Als ze het met een stelling eens zijn moeten ze er naartoe bewegen, \
zo niet moeten ze er zo ver vandaan bewegen als ze het er mee oneens zijn. Lees nu stellingen voor, bijv.\
<ul>\
    <li>We hebben besproken wat voor mij het meest belangrijk was</li>\
    <li>Ik heb vandaag openlijk mijn mening geuit</li>\
    <li>Ik denk dat de retrospective de tijd waard was</li>\
    <li>Ik heb er alle vertrouwen in dat we onze actiepunten uitvoeren</li>\
</ul>\
Zie hoe de sterrenbeelden zich ontplooien. Vraag na afloop welke sterrenbeelden verrassend waren.<br>\
Dit kan ook een openingsactiviteit zijn (#52).",
source:    "<a href='http://www.coachingagileteams.com/'>Lyssa Adkins</a> via \
<a href='http://lmsgoncalves.com/2013/01/23/constellation-a-good-exercise-to-set-the-stage-in-the-retrospective/'>Luis Goncalves</a>, \
<a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
duration:  "5 min",
suitable:  "iteration, project, release"
};
all_activities[53] = {
phase:     1,
name:      "Story Oscars",
summary:   "Het team nomineert stories voor prijzen en bespreekt de winnaars",
desc:      "Toon alle stories die de laatste sprint(s) afgerond zijn op een bord. \
Creëer drie prijzencategorieën (bijvoorbeeld als vlakken op het bord):\
<ul>\
    <li>Beste story</li>\
    <li>Irritantste story</li>\
    <li>... 3de categorie bedacht door het team ...</li>\
</ul>\
Vraag het team om stories te nomineren door ze in een van de categorieën te plaatsen. <br>\
Laat het team voor iedere categorie stemmen met stippen (dotvoting) om de winnaar te bepalen. \
Vraag het team waarom ze denken dat deze story gewonnen heeft in deze categorie \
en laat het team reflecteren op het proces van het afmkane van taken - wat ging er goed en/of fout.",
source:    "<a href='http://www.touch-code-magazine.com'>Marin Todorov</a>",
duration:  "30-40 min",
suitable:  "project, release",
};
all_activities[54] = {
phase:     2,
name:      "Originele 4",
summary:   "Stel Norman Kerth's 4 sleutelvragen",
desc:      "Norman Kerth, bedenker van retrospectives, identificeerde de volgende 4 vragen als essentieel: \
<ul>\
    <li>Wat deden we goed, dat we mogelijk vergeten als we het niet benoemen?</li>\
    <li>Wat hebben we geleerd?</li>\
    <li>Wat zouden we de volgende keer anders moeten doen?</li>\
    <li>Waar breken we ons nog steeds het hoofd over?</li>\
</ul>\
Wat zijn de antwoorden van het team?",
source:    "<a href='http://www.retrospectives.com/pages/RetrospectiveKeyQuestions.html'>Norman Kerth</a>",
duration:  "15 min",
suitable:  "iteration, project, release"
};
all_activities[55] = {
phase:     5,
name:      "Nodig een klant uit",
summary:   "Breng het team in direct contact met een klant of belanghebbende",
desc:      "Nodig een klant of interne belanghebbende uit bij je retrospective.\
Laat het team ALLE vragen stellen:\
<ul>\
    <li>Hoe gebruikt de klant het product?</li>\
    <li>Wat vervloeken ze het meest?</li>\
    <li>Welke functie maakt hun leven gemakkelijker?</li>\
    <li>Laat de klant een demonstratie geven van hun typische workflow</li>\
    <li>...</li>\
</ul>",
source:    "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Nick Oostvogels</a>",
duration:  "45 min",
suitable:  "iteration, project"
};
all_activities[56] = {
phase:     4,
name:      "Zeg het met bloemen",
summary:   "Ieder teamlid waardeert iemand anders met een bloem",
desc:      "Koop voor elk teamlid een bloem en onthul die bij de retrospective. \
Iedereen krijgt een bloem om aan iemand anders te geven als blijk van hun waardering.",
source:    "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Nick Oostvogels</a>",
duration:  "5 min",
suitable:  "iteration, project"
};
all_activities[57] = {
phase:     2,
name:      "Undercover Baas",
summary:   "Als je baas ooggetuige was geweest van de laatste sprint, wat zou hij of zij dan willen veranderen?",
desc:      "Stel je voor dat je baas de laatste sprint - onherkend - tussen het team gezeten had. Wat zou hij of zij dan denken \
over de interacties tussen de teamleden en de behaalde resultaten? Wat zou hij of zij willen veranderen? \
<br>Deze instelling daagt het team uit om zichzelf vanuit een ander perspectief te bekijken.",
source:    "<a href='http://loveagile.com/retrospectives/undercover-boss'>Love Agile</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release"
};
all_activities[58] = {
phase:     0,
name:      "Blijkheidshistogram",
summary:   "Teken een blijheidshistogram om mensen aan de praat te krijgen",
desc:      "Bereid een flipchartvel voor met daarop een horizontale schaal van 1 (Ongelukkig) tot 5 (Blij).\
<ul>\
    <li>Het ene na het andere teamlid plaatst een stickie bij aan de hand van hun gevoelens en plaatst daar commentaar bij</li>\
    <li>Als er iets noemenswaardigs voorbijkomt in de reden, laat het team dat dan ofwel meteen bespreken of stel het uit tot later in de retrospective</li>\
    <li>Als er iemand anders dezelfde score kiest, dan plaatst hij of zij zijn stickie boven de stickie die er al hangt, om zo effectief een histogram te vormen</li>\
</ul>",
source:    "<a href='http://nomad8.com/chart-your-happiness/'>Mike Lowery</a> via <a href='https://twitter.com/nfelger'>Niko Felger</a>",
duration:  "2 min",
suitable:  "iteration, project, release"
};
all_activities[59] = {
phase:     4,
name:      "AHA!",
summary:   "Gooi een bal in de rondte en ontdek wat er geleerd is",
desc:      "Gooi een bal (bijvoorbeeld een koosh ball) rond het team en haal positieve gedachten en leermomenten boven water. Geef aan het begin van de sessie een vraag \
die beantwoord moet worden als de bal gevangen wordt, bijvoorbeeld: \
<ul>\
    <li>Een ding dat ik in de afgelopen sprint geleerd heb</li>\
    <li>Een geweldig ding dat iemand anders voor me deed</li>\
</ul>\
Afhankelijk van de vraag kan deze oefening gebeurtenissen naar boven halen die mensen dwars zaten. Als er alarmbellen afgaan, graaf dan wat dieper. Middels de '1 geweldig ding'-vraag \
kun je meestal afsluiten op een positieve noot.",
source:    "<a href='http://scrumfoundation.com/about/catherine-louis'>Catherine Louis</a> en <a href='http://blog.haaslab.net/'>Stefan Haas</a> via <a href='https://www.linkedin.com/in/misshaley'>Amber Haley</a>",
duration:  "5-10 min",
suitable:  "iteration, project",
};
all_activities[60] = {
phase:     3,
name:      "Chaos Coctailfeest",
summary:   "Identificeer, bespreek, verhelder en prioriteer actief een aantal acties",
desc:      "Iedereen beschrijft een kaartje met een actie waarvan zij denken dat het belangrijk is om die uit te voeren - \
hoe specifieker (<a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART</a>), \
hoe beter. Daarna gaan de teamleden rond en praten over de kaarten als op een coctailfeest. \
Ieder conversatiepaar bespreekt de acties op hun twee kaarten. \
Beëindig het gesprek na 1 minuut. Ieder paar verdeelt 5 punten over de twee kaarten. \
De meeste punten gaan naar de belangrijkste actie. Organiseer 3 tot 5 gespreksrondes (afhankelijk van de grootte van de groep). \
Aan het einde telt iedereen de punten op hun kaart bij elkaar op. \
Ten slotte worden de kaarten gerangschikt op puntentotaal en beslist het team hoeveel er in de volgende iteratie gedaan kan worden, \
bovenaan te beginnen.\
<br><br>\
Addendum: In veel gevallen kan het nuttig zijn om de kaarten aan het begin van de sessie en tussen de gesprekken door
random te ruilen. Op deze manier heeft geen van de partijen een belang in welke kaart de meeste punten krijgt. \
Dit is een idee van \
<a href='http://www.thiagi.com/archived-games/2015/2/22/thirty-five-for-debriefing'>Dr. Sivasailam “Thiagi” Thiagarajan</a> via \
<a href='https://twitter.com/ptevis'>Paul Tevis</a>",
source:    "Suzanne Garcia via <a href='http://www.wibas.com'>Malte Foegen</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release, largeGroup"
};
all_activities[61] = {
phase:     1,
name:      "Verwachtingen",
summary:   "Wat kunnen anderen van jou verwachten? Wat kun jij van hen verwachten?",
desc:      "Geef ieder teamlid een stuk papier. De onderste helft is leeg. De bovenste helft is in twee secties verdeeld:\
<ul>\
    <li>Wat kunnen mijn teamleden van mij verwachten</li>\
    <li>Wat ik verwacht van mijn teamleden</li>\
</ul>\
Iedere persoon vult de bovenste helft voor zichzelf in. Zodra iedereen klaar is, geven ze hun vel papier \
naar hun linkerbuur door en reviewen dan het vel wat aan hun gegeven werd. Op de onderste helft schrijven ze \
wat zij persoonlijk verwachten van die persoon, ondertekenen het en geven het door.<br>\
Neem, als de vellen papier het hele team rond gegaan zijn, wat tijd om het vel te reviewen en om observaties te delen.",
source:    "<a href='http://agileyammering.com/2013/01/25/expectations/'>Valerie Santillo</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release, start"
};
all_activities[62] = {
phase:     3,
name:      "Laaghangend fruit",
summary:   "Visualiseer de belofte en het gemak van mogelijke werkwijzen die gekozen kunnen worden",
desc:      "Onthul een vooraf getekende boom. Deel indexkaartjes (of stickies) uit en instrueer de deelnemers \
gewenste acties op te schrijven - een per kaart. Zodra iedereen klaar is, verzamel dan de kaartjes, schud ze, \
en lees ze een voor een voor. Hang iedere 'vrucht' in de boom aan de hand van de inschatting van de deelnemers: \
<ul>\
    <li>Is het makkelijk om te doen? Hang het dan laag in de boom. Moeilijk? Hang het dan hoger.</li>\
    <li>Lijkt het zinvol? Plaats het dan aan de linkerkant. Is de waarde hooguit dubieus? Hang het dan meer naar rechts.</li>\
</ul>\
De eenvoudige keuze is nu om de acties te kiezen die linksonder in de boom hangen. Als hier geen eensgezindheid over is, \
kun je ofewel een korte discussie houden om te beslissen of om te stemmen met stippen (dotvoting) over de acties in kwestie.",
source:    "<a href='http://tobias.is'>Tobias Baldauf</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release"
};
all_activities[63] = {
phase:     1,
name:      "Vierendeling - Identificeer saaie stories",
summary:   "Categoriseer alle stories in 2 dimensies om de saaie stories te identificeren",
desc:      "Teken een groot vierkant en verdeel dat in 2 kolommen. \
Label de kolommen 'Interessant' en 'Saai'. Laat het team alles wat ze in de afgelopen iteratie gedaan hebben op stickies opschrijven en \
hang ze in de toepasselijke kolom. Laat hen ook een ruwe schatting geven van hoe lang het duurde.<br> \
Voeg nu een horizontale lijn toe, zo dat je vierkant 4 kwadranten heeft. Label de bovenste rij 'Kort' (kostte een aantal uur) \
en de onderste rij 'Lang' (kostte dagen). Rangschik de stickies in iedere kolom.<br> \
De lange en saaie stories zijn nu handig gegroepeerd om 'aan te vallen' in komende fasen.<br> \
<br>\
(Het opsplitsen van de beoordeling in fasen bevordert de focus. Je kunt de \
<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>\
    vierendelingstechniek ook aanpassen voor andere 2-dimensionale categorizeringen</a>.)",
source:    "<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>Wayne D. Grant</a>",
duration:  "10",
suitable:  "iteration, project",
};
all_activities[64] = {
phase:     1,
name:      "Waarderende navraag",
summary:   "Ieders humeur opfleuren met positieve vragen",
desc:      "Dit is een activiteit in rondes. In iedere ronde stel je het team een vraag. De teamleden schrijven hun antwoorden op \
(zodat iedereen de tijd heeft om na te denken) en lezen die dan voor aan de anderen.<br>\
Vragen die voorgesteld zijn voor software ontwikkelteams:\
<ol>\
    <li>Wanneer was de laatste keer dat je echt geëngageerd / geanimeerd / productief was? Wat deed je toen? Wat was er gebeurd? \
        Hoe voelde dat?</li>\
    <li>Vanuit een applicatie-/code-perspectief: wat is het meeste geweldige dat je samen gebouwd hebt? Waarom is dat zo geweldig?</li>\
    <li>Wat vind je van alle dingen die je voor dit bedrijf gebouwd hebt het meest waardevol? Waarom?</li>\
    <li>Wanneer werkte je het beste met de Product Owner? Wat was er goed aan?</li>\
    <li>Wanneer was de samenwerking het beste?</li>\
    <li>Wat was je meest waardevolle bijdrage aan de ontwikkelcommunity (van dit bedrijf)? Hoe deed je dat?</li>\
    <li>Laat je bescheidenheid thuis: Wat is de meest waardevolle vaardigheid/karaktertrek die je aan het team bijdraagt?\
        Geef een voorbeelden?</li>\
    <li>Wat is het belangrijkste kenmerk van het team? Wat maakt jullie anders?</li>\
</ol>\
<br>\
('Herinneringen uit de toekomst' (#37) werkt goed als volgende stap.)",
source:    "<a href='http://blog.8thlight.com/doug-bradbury/2011/09/19/apreciative_inquiry_retrospectives.html'>Doug Bradbury</a>, aangepast voor SW ontwikkeling door " + source_findingMarbles,
duration:  "20-25 min groupsize",
suitable:  "iteration, project"
};
all_activities[65] = {
phase:     2,
name:      "'Brainwriting'",
summary:   "Geschreven brainstormsessies vereffenen het veld voor de introverte teamleden",
desc:      "Stel een centrale vraag, zoals 'Welke acties moeten we in de volgende sprint uitvoeren om te verbeteren?'. \
Deel pennen en papier uit. Iedereen schrijft hun ideeën op. Na drie minuten geeft iedereen het vel papier door aan hun linkerbuur en schrijft verder \
op het vel dat ze gekregen hebben. Zodra ze geen ideeën meer hebben, kunnen ze de ideeën van anderen lezen. \
Regels: Geen negatief commentaar en iedereen schrijft zijn ideeën slechts een keer op. (Als verschillende mensen hetzelfde idee opschrijven,\
is dat natuurlijk prima.) <br>\
Geef de vellen iedere drie minuten door totdat iedereen alle vellen gehad heeft. Geef ze nu nog een laatste keer door. \
Nu leest iedereen het vel door en kiest de drie beste ideeën die er op staan. Verzamel alle top 3's op een flipchartvel voor de volgende fase.",
source:    "Prof. Bernd Rohrbach",
duration:  "20 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[66] = {
phase:     4,
name:      "Meegenomen inzichten",
summary:   "Leg vast wat de deelnemers geleerd hebben tijdens de retro",
desc:      "Iedereen schrijft op een stickie het meest opvallend wat ze geleerd hebben tijdens de retro. \
Hang de stickies op de deur. Ieder van de deelnemers leest zijn eigen notitie voor.",
source:     source_judith,
duration:  "5 min",
suitable:  "iteration, project, release"
};
all_activities[67] = {
phase:     2,
name:      "Bedrijfskaart",
summary:   "Teken een kaart van het bedrijf alsof het een land was",
desc:      "Deel pennen en papier uit. Stel de vraag 'Wat als het bedrijf / de afdeling / het team een terrein was? \
Hoe zou de kaart er dan uit zien? Welke tips zou je toevoegen voor een veilige reis?' Laat de deelnemers 5-10 minuten \
tekenen. Hang vervolgens de tekeningen op. Loop alle tekeningen langs om te interessante metaforen te verduidelijken en bespreken.",
source:     source_judith,
duration:  "15 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[68] = {
phase:     2,
name:      "Het ergste dat we kunnen doen",
summary:   "Ontdek hoe je de volgende sprint zeker kunt verknallen",
desc:      "Deel pennen en stickies uit. Vraag iedereen om ideeën hoe de volgende sprint/release tot een \
gegarandeerde ramp gemaakt kan worden - een idee per stickie. Zodra iedereen klaar is met schrijven, hang je alle stickies \
op en loop je ze door. Identificeer en bespreek de thema's. <br>\
Verander deze negatieve acties in de volgende fase in hun tegenpool. ",
source:     source_findingMarbles,
duration:  "15 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[69] = {
phase:     0,
name:      "3 voor de prijs van 1 - Opening",
summary:   "Check in een keer de tevredenheid met de resultaten van de sprint, de communicatie en de stemming",
desc:      "Bereid een flipchartvel voor met een coördinatenstelsel. De y-as is 'tevredenheid met de sprintresultaten'. \
De x-as is 'Aantal keren dat we afgestemd hebben'. Vraag iedere deelnemer om aan te geven waar hun tevredenheid \
en idee van benodigd aantal afstemmingen kruisen - met een emoticon om hun stemming aan te geven (dus niet gewoon een stip).\
Bespreek verrassende varianties en extreme stemmingen.<br>\
(Varieer de x-as om de huidige team-onderwerpen te reflecteren, bijv. 'Aantal keer dat we samen gecodeerd hebben'.)",
source:     source_judith,
duration:  "5 min groupsize",
suitable:  "iteration, project"
};
all_activities[70] = {
phase:     4,
name:      "3 voor de prijs van 1 - Sluiting: Werd iedereen gehoord?",
summary:   "Check in een keer de tevredenheid met de resultaten van de retro, een eerlijke verdeling van spreektijd en de stemming",
desc:      "Bereid een flipchartvel voor met een coördinatenstelsel. De y-as is 'tevredenheid met de retroresultaten'. \
De x-as is 'Eerlijke verdeling van spreektijd' (hoe meer het gelijk was, des te verder naar rechts). \
Vraag iedere deelnemer om aan te geven waar hun tevredenheid en idee van spreektijdbalans elkaar kruisen - \
met een emoticon om hun stemming aan te geven (dus niet gewoon een stip). Bespreek ongelijkheden in spreektijd en extreme stemmingen.",
source:     source_judith,
duration:  "15 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[71] = {
phase:     3,
name:      "Verdeel de Euro",
summary:   "Hoeveel is een actie het team waard?",
desc:      "Hang de lijst met mogelijke acties op. Teken er een kolom naast genaamd 'Belang (in Euro)'. \
Het team krijgt 100 (virtuele) Euros om te verdelen over de acties. Hoe belangrijker ze een actie vinden, \
hoe meer ze er aan zouden moeten besteden. Maak het leuker door papieren geld uit een bordspel als Monopoly  \
mee te nemen.\
<br><br>Laat iedereen het eens worden over de prijzen. Beschouw de 2 of 3 acties met de hoogste bedragen als gekozen.",
source:     "<a href='http://www.gogamestorm.com/?p=457'>Gamestorming</a>",
duration:  "10 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[72] = {
phase:     3,
name:      "Verkooppraatje",
summary:   "Actie-ideeën strijden om 2 beschikbare 'Gaan we doen'-sloten",
desc:      "[Opgelet: Deze oefening creëert 'winnaars' en 'verliezers'. Gebruik het niet als er machtsonbalansen in het team zijn.]\
<br><br> \
Vraag iedereen om twee veranderingen te bedenken die ze door zouden willen voeren en laat hen die op schrijven \
op verschillende index kaartjes. Teken 2 sloten op het bord. Het eerste teamlid stop zijn favoriete idee in het \
eerste slot. Zijn buurman stopt zijn favoriete idee in het tweede slot. Het derde teamlid moet dan zijn favoriete idee \
verkopen ten opzichte van een van de al aanwezige ideeën die hij minder interessant vindt. Als het team het er mee eens is, \
worden de kaartjes geruild. Dit gaat door totdat iedereen zijn kaartjes gepresenteerd heeft. \
<br><br>Probeer de oefening niet te beginnen met de ideeën van dominante teamleden.",
source:     source_judith,
duration:  "15 min groupsize",
suitable:  "iteration"
};
all_activities[73] = {
phase:     2,
name:      "Pessimeren",
summary:   "Als we de laatste sprint verknald hadden, wat zouden we dan gedaan hebben?",
desc:      "Begin de activiteit door te vragen: 'You start the activity by asking: \
'Als we de laatste sprint verknald hadden, wat zouden we dan gedaan hebben?' \
Leg de antwoorden vast op een flipchart. De volgende vraag is dan: 'Wat zou het tegenovergestelde daarvan zijn?' \
Leg dit vast op een andere flipchart. Vraag nu de deelnemers om commentaar te leveren op deze 'tegengestelden'-lijst \
door stickies te schrijven met het antwoord op 'Wat weerhoudt ons er van om dit te doen?'. Deel vervolgens stickies uit \
in een andere kleur om daar weer commentaar op te geven door te vragen 'Waarom is dat zo?'",
source:     source_judith,
duration:  "25 min groupsize",
suitable:  "iteration, project"
};
all_activities[74] = {
phase:     1,
name:      "Schrijf het onuitspreekbare",
summary:   "Schrijf op wat je nooit hardop zou kunnen zeggen",
desc:      "Heb je het idee dat er onuitgesproken taboes zijn die het team tegenhouden? \
Beschouw dan deze stille activiteit: Benadruk de vertrouwelijkheid ('Wat in Vegas gebeurt, blijft in Vegas') \
en kondig van te voren aan dat alle aantekeningen van dez activiteit aan het eind vernietigd worden. \
Deel pas na deze uitleg aan iedere deelnemer een vel papier uit om het grootste ongesproken taboe in het bedrijf \
op te schrijven. <br> \
Zodra iedereen klaar is, geven ze hun vel aan hun linkerbuur. De buren lezen wat er staat \
en mogen dan commentaar toevoegen. De vellen worden weer doorgegeven en gaan zo de kring rond tot ze bij de auteur \
terugkomen. Deze leest het vel ook nog een keer door. Daarna worden alle vellen ceremonieel versnipperd of \
(als je buiten bent) verbrand.",
source:     "Onbekend, via Vanessa",
duration:  "10 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[75] = {
phase:     0,
name:      "Bewonderingsronde",
summary:   "De deelnemers drukken uit wat ze in elkaar bewonderen",
desc:      "Start een bewonderingsronde door je linkerbuur aan te kijken en te vertellen 'Wat ik aan jou het meest bewonder is ...' \
			Daarna kijkt deze persoon zijn/haar linkerbuur aan en herhaalt de oefening. Net zo lang tot de laatste deelnemer \
			vertelt wat hij/zij in jou bewondert. Voelt geweldig, niet waar?",
source:     source_judith,
duration:  "5 min",
suitable:  "iteration, project, release"
};
all_activities[76] = {
phase:     4,
name:      "Opvolgen",
summary:   "Hoe waarschijnlijk is het dat de acties uitgevoerd worden?",
desc:      "Laat iedereen een emoticon tekenen op een stickie die hun huidige stemming weergeeft. \
            Teken vervolgens een schaal op een flipchartvel, genaamd 'Waarschijnlijkheid dat we onze acties uitvoeren'.  \
            Zet '0%' aan de linkerkant van de schaal en '100%' aan de rechterkant. Vraag iedereen om hun stickie \
            op de schaal te plaatsen, afhankelijk van hun zekerheid in het opvolgen van de acties door het team.<br> \
            Bespreek interessante resultaten zoals een lage waarschijnlijkheid of slechte stemming.",
source:     source_judith,
duration:  "5-10 min",
suitable:  "iteration, project, release"
};
all_activities[77] = {
phase:     1,
name:      "4 Ls - Loved (geweldig vond), Learned (geleerd heb), Lacked (miste), Longed for (naar verlangde)",
summary:   "Onderzoek wat iedereen afzonderlijk geweldig vond, van geleerd heeft, miste, of waar ze naar verlangden",
desc:      "Iedere persoon brainstormt afzonderlijk over het antwoord op de volgende 4 vragen: \
<ul> \
    <li>Wat ik geweldig vond</li> \
    <li>Wat ik geleerd heb</li> \
    <li>Wat ik miste</li> \
    <li>Waar ik naar verlangde</li> \
</ul> \
Verzamel de antwoorden met stickies op een flipchart of in een digitale tool als je team gedistribueerd is. \
Vorm 4 subgroepen, voor ieder van de L's, lees alle notities, identificeer de patronen en rapporteer de bevindingen aan de gehele groep. \
Gebruik de uitkomsten als input voor de volgende fase.",
source:     "<a href='http://ebgconsulting.com/blog/the-4l%E2%80%99s-a-retrospective-technique/'>Mary Gorman &amp; Ellen Gottesdiener</a> waarschijnlijk via <a href='http://www.groupmap.com/portfolio-posts/agile-retrospective/'>groupmap.com</a>",
duration:  "30 min",
suitable:  "iteration, project, release, distributed"
};
all_activities[78] = {
phase:     1,
name:      "Value Stream Mapping",
summary:   "Breng de waardestromen van je iteratieproces in kaart",
desc:      "Leg een voorbeeld van Value Stream Mapping uit. (Als je er onbekend mee bent, check dan \
<a href='http://www.youtube.com/watch?v=3mcMwlgUFjU'>deze video</a> of \
<a href='http://wall-skills.com/2014/value-stream-mapping/'>deze poster</a>.) \
Vraag het team om een waardestromingskaart van hun proces te tekenen vanuit het perspectief van \
een enkele user story. Indien nodig kun je de groep in meerdere subgroepjes verdelen en het proces \
faciliteren waar nodig. Bekijk de voltooide kaarten. Waar zitten de grote vertragingen, knelpunten, \
en bottlenecks?",
source:    "<a href='http://pragprog.com/book/ppmetr/metaprogramming-ruby'>Paolo &quot;Nusco&quot; Perrotta</a>, geïnspireerd door <a href='http://www.amazon.com/exec/obidos/ASIN/0321150783/poppendieckco-20'>Mary &amp; Tom Poppendieck</a>",
duration:  "20-30 min",
more:      "http://leadinganswers.typepad.com/leading_answers/2011/09/pmi-acp-value-stream-mapping.html",
suitable:  "iteration, project, release, distributed"
};
all_activities[79] = {
phase:     1,
name:      "Herhalen &amp; Vermijden",
summary:   "Brainstorm wat er herhaald moet worden en welke soorten gedrag vermeden moeten worden",
desc:      "Gebruik 2 flipchartvellen, respectievelijk getiteld 'Herhalen' en 'Vermijden'. \
De deelnemers schrijven zaken voor de kolommen op stickies - 1 idee per stickie. \
Je kunt de stickies ook nog kleurcoderen. Bijvoorbeeld 'Mensen', 'Proces', 'Techniek', ... \
Laat iedereen hun stickies voorlezen en in de juiste kolom hangen. \
Worden de ideeën gedeeld door alle deelnemers?",
source:     "<a href='http://www.infoq.com/minibooks/agile-retrospectives-value'>Luis Goncalves</a>",
more:       "http://www.funretrospectives.com/repeat-avoid/",
duration:  "15-30",
suitable: "iteration, project, remote"
};
all_activities[80] = {
phase:     0,
name:      "Uitkomstverwachtingen",
summary:   "Iedereen geeft aan wat zijn verwachtingen van de retrospective",
desc:      "Iedereen in het team stelt een doel van de retrospective vast, met andere woorden wat ze \
met deze bijeenkomst willen bereiken. Voorbeelden van de deelnemers zouden kunnen zeggen: \
<ul> \
    <li>Ik ben al blij als we 1 goede actie formuleren</li> \
    <li>Ik wil praten over onze discussie over unit tests en overeenkomen hoe we dat in de toekomst gaan doen</li> \
    <li>Ik beschouw deze retro als een succes als we een plan bedenken om $obscureModule op te schonen</li> \
</ul> \
[Je kunt checken of deze doelen gehaald zijn door af te sluiten met activiteit #14.] \
<br><br> \
[Het <a href='http://liveingreatness.com/additional-protocols/meet/'>Meet - Core Protocol</a>, dat deze activiteit inspireerde \
beschrijft ook 'Alignment Checks': Wanneer iemand denkt dat de retrospective niet aan iemands behoefte voldoet, \
kunnen ze om een Alignment Check vragen. Dan kan iedereen een getal van 0 tot 10 noemen om aan te geven in hoeverre ze \
krijgen wat ze willen. De persoon met het laagste getal mag het dan overnemen om dichter bij hun doel te komen.]",
source:     "Geïnspireerd door <a href='http://liveingreatness.com/additional-protocols/meet/'>Jim &amp; Michele McCarthy</a>",
duration:  "5 min groupsize",
suitable:  "iteration, project, release"
};
all_activities[81] = {
phase:     0,
name:      "Drie Woorden",
summary:   "Iedereen vat de afgelopen sprint samen in 3 woorden",
desc:      "Vraag iedereen om de afgelopen iteratie in 3 woorden te beschrijven. \
            Geef ze een minuut om iets te bedenken en ga dan het team rond. \
            Dit helpt mensen om de laatste sprint te herinneren, zodat ze een basis hebben om mee te starten.",
source:     "Yurii Liholat",
duration:  "5 min groupsize",
suitable:  "iteration, project"
};
all_activities[82] = {
phase:     4,
name:      "Retro Darten",
summary:   "Check of je de roos van belangrijke zaken kunt raken",
desc:      "Teken een of meerdere dartborden op een flipchart. \
Schrijf naast ieder dartbord een vraag, bijvoorbeeld \
<ul> \
    <li>We hebben gesproken over de zaken die belangrijk voor mij zijn</li> \
    <li>Ik heb openlijk gesproken</li> \
    <li>Ik ben er zeker van dat we de volgende sprint beter zal gaan</li> \
</ul> \
De deelnemers markeren hun mening met een stickie. In de roos is 100% overeenstemming. \
Buiten de rand van het dartbord is absoluut geen overeenstemming.",
source:   "<a href='http://www.philippflenker.de/'>Philipp Flenker</a>",
duration:  "2-5",
suitable: "iteration, release"
};
all_activities[83] = {
phase:     0,
name:      "Actietabel van de vorige retro",
summary:   "Bekijk hoe verder te gaan met de acties uit de vorige retro",
desc:      "Teken een tabel met 5 kolommen. De eerste kolom bevat de acties uit de vorige retro. \
De overige kolommen zijn getiteld 'Meer doen', 'Blijven doen', 'Minder doen' en 'Ophouden met'. \
Deelnemers plaatsen 1 stickie per rij in de kolom die hun mening over de actie weergeeft. \
Faciliteer naderhand een korte discussie per actie, bijvoorbeeld door te vragen: \
<ul> \
    <li>Waarom moeten we hier mee ophouden?</li> \
    <li>Waarom is het zinvol om hier mee door te gaan?</li> \
    <li>Werd aan de verwachtingen voldaan?</li> \
    <li>Waarom lopen de meningen zo ver uit elkaar?</li> \
</ul>",
source:    "<a href='https://sven-winkler.squarespace.com/blog-en/2014/2/5/the-starfish'>Sven Winkler</a>",
duration:  "5-10",
suitable: "iteration, release"
};
all_activities[84] = {
phase: 0,
name: "Groeten uit de sprint",
summary: "Ieder teamlid schrijft een ansichtkaart over de laatste iteratie",
desc: "Herinner het team aan hoe een ansichtkaart er uit ziet: \
<ul> \
    <li> Een plaatje op de voorkant,</li> \
    <li> een berichtje op de halve achterkant,</li> \
    <li> het adres en de postzegel op de andere helft.</li> \
</ul> \
Deel blanco indexkaarten uit en vertel het team dat ze 10 minuten hebben om een ansichtkaart \
te schrijven aan iemand die het hele team kent (bijvoorbeeld een ex-collega). \
Als de tijd om is, verzamel en schud de kaarten, alvorens ze te herverdelen. \
De teamleden lezen om beurt de kaart die ze gekregen hebben voor.",
source: '<a href="http://uk.linkedin.com/in/alberopomar">Filipe Albero Pomar</a>',
duration:  "15 min",
suitable:  "iteration, project"
};
all_activities[85] = {
phase:     1,
name:      "Communicatielijnen",
summary:   "Visualizeer hoe de informatie in-, uit- en door het team stroomt",
desc:      "Verlopen de informatiestromen niet zo soepel als ze zouden moeten? Vermoed je dat er bottlenecks zijn? \
Visualizeer dan de manieren waarop de informatie stroomt om startpunten voor verbetering te vinden. \
Als je een specifieke stroom wilt bekijken (bijvoorbeeld producteisen, blokkeringen, ...) check dan \
Value Stream Mapping (#79). Voor problematische situaties kun je iets als \
Oorzaak-Gevolg-Diagrammen (#25) proberen. <br>\
Bekijk de voltooide tekening. Waar zitten de vertragingen en doodlopende wegen?",
source:    "<a href='https://www.linkedin.com/in/bleadof'>Tarmo Aidantausta</a>",
duration:  "20-30 min",
suitable:  "iteration, project, release"
};
all_activities[86] = {
phase:     1,
name:      "Vergaderingstevredenheidhistogram",
summary:   "Maak een histogram met hoe goed de rituele vergaderingen gingen tijdens de sprint",
desc:      "Bereid een flipchart voor voor elke vergadering die iedere iteratie voorkomt, \
(bijvoorbeeld de Scrum ceremonies) met een horizontale schaal van 1 ('Voldeed niet aan de verwachtingen') \
tot 5 ('Boven verwachting'). Ieder teamlid voegt een stickie toe op basis van hun inschatting \
van ieder van deze vergaderingen. Laat het team bespreken waarom sommige vergaderingen geen 5 scoorden. \
<br> \
Je kunt verbeteringen bespreken als onderdeel van deze activiteit of in een latere activiteit zoals \
het perfectioneringsspel (#20) or Plus \& Delta (#40).",
source:    "<a href='https://www.linkedin.com/profile/view?id=6689187'>Fanny Santos</a>",
duration:  "10-20 min",
suitable:  "iteration, project, release"
};
all_activities[87] = {
phase:     3,
name:      "Blokkeringencup",
summary:   "Blokkeringen ('Impediments') strijden tegen elkaar in wereldbeker stijl",
desc:      "Bereid een flipchart voor met een speelschema voor de kwartfinale, halve finale en finale. \
Alle deelnemers schrijven acties op stickies, totdat je acht acties hebt. \
Schud ze en plaats ze op willekeurige volgorde op het schema.<br>\
Het team moet nu stemmen voor een van de twee acties in ieder paar. Verplaats de winnende actie \
naar de volgende ronde, totdat er een winnaar van de blokkeringencup bekend is. \
<br><br>\
Als je meer dan een of twee acties over wilt houden, dan kun je ook nog strijden om de derde plaats.",
source:    "<a href='http://obivandamme.wordpress.com'>Pascal Martin</a>, geïnspireerd door <a href='http://borisgloger.com/'>Boris Gloger's 'Bubble Up'</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release"
};
all_activities[88] = {
phase:     1,
name:      "Retrobruiloft",
summary:   "Verzamel voorbeelden van iets ouds, iets nieuws, iets dat geleend is en iets dat blauw is",
desc:      "Vraag het team, analoog aan het anglo-saksische huwelijksgebruik om voorbeelden te geven in de volgende categorieën: \
<ul> \
    <li>Iets ouds<br> \
        Positieve feedback of constructieve kritiek op bestaande processen</li> \
    <li>Iets nieuws<br> \
        Positieve feedback of constructieve kritiek op lopende experimenten</li> \
    <li>Iets dat geleend is<br> \
        Gereedschap/idee van een ander team, het web of jezelf voor een potentieel experiment</li> \
    <li>Iets blauws<br> \
        Iedere blokkering of bron van verdriet</li> \
</ul> \
Een voorbeeld per stickie. Er is maar 1 regel: Als iemand iets in de 'Iets blauws' kolom hangt, \
dan moet hij/zij ook een positieve opmerking in ten minste 1 andere kolom plaatsen.<br><br> \
Iedereen hangt hun stickies in de juiste kolom op het bord en beschrijft het voorbeeld in het kort.",
source:    "<a href='http://scalablenotions.wordpress.com/2014/05/15/retrospective-technique-retro-wedding/'>Jordan Morris</a>, via Todd Galloway",
duration:  "5-10 min",
suitable:  "iteration, project, release"
};
all_activities[89] = {
phase:     0,
name:      "Opvrolijken met Agile Waarden",
summary:   "Herinner elkaar aan de Agile waarden die je hebt laten zien",
desc:      "Teken vier grote balonnen en schrijf in ieder ervan een agile kernwaarde: \
<ol> \
    <li>Individuen en hun interacties</li> \
    <li>Werkende software opleveren</li> \
    <li>Samenwerking met de klant</li> \
    <li>Reageren op verandering</li> \
</ol> \
Vraag deelnemers om voorbeelden op te schrijven van momenten waarop hun collega's een van de waarden vertoonden \
- 1 opbeurend voorbeeld per stickie. Laat iedereen om de beurt hun stickies in de bijbehorende ballon hangen \
en hardop voorlezen. Verheug je over hoe jullie de agile kernwaarden belichamen. :)",
source:    "<a href='http://agileinpills.wordpress.com'>Jesus Mendez</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release"
};
all_activities[90] = {
phase:     2,
name:      "Postersessie",
summary:   "Verdeel een grote groep in kleinere groepen die posters maken",
desc:      "Nadat je belangrijke onderwerpen hebt geïdentificeerd in de vorige fase, \
kun je nu in detail treden. Verdeel de groep in kleinere groepen van 2-4 personen, \
waarbij ieder subgroepje een poster voorbereiden en die presenteren aan de andere groepen. \
Als er meerdere belangrijke onderwerpen geïdentificeerd zijn, laat de teamleden dan het onderwerp \
selecteren dat ze verder uit willen werken.<br> \
Geef het team richtlijnen over wat de posters moeten behandelen/beantwoorden, zoals: \
<ul> \
    <li>Wat gebeurt er precies? Waarom is dat een probleem?</li> \
    <li>Waarom / wanneer / hoe treedt deze situatie op?</li> \
    <li>Wie heeft er voordeel van de huidige situatie? En welk voordeel is dat?</li> \
    <li>Mogelijke oplossingen (met voor- en nadelen)</li> \
    <li>Wat zou kunnen helpen om de situatie te veranderen?</li> \
    <li>... wat er verder nog van toepassing is ...</li> \
</ul> \
De groepen krijgen 15-20 minuten om hun posters te bespreken en maken. Naderhand \
komen alle groepen weer bij elkaar en krijgt elke groep 2 minuten om hun resultaten te presenteren.",
source:    "Onbekend, aangepast door " + source_findingMarbles + ", geïnspireerd door Michal Grzeskowiak",
duration:  "30 min",
suitable:  "iteration, project, release"
};
all_activities[91] = {
phase:     4,
name:      "Motivatie Poster",
summary:   "Verander acties in posters om de zichtbaarheid \& opvolging te verbeteren",
desc:      "Neem de lijst van alle actie items en verander ieder punt in een grappige poster (zie de foto's voor voorbeelden). \
<ol>\
    <li>Kies een beeld</li>\
    <li>Kies een titel</li>\
    <li>Schrijf een beschrijving vol zelfspot</li>\
</ol>\
Print je meesterwerk zo groot mogelijk (A4 is het absolute minimum) en hang de poster op een prominente plaats.",
source:    "<a href='http://fr.slideshare.net/romaintrocherie/agitational-posters-english-romain-trocherie-20140911'>Romain Trocherie</a>",
duration:  "30 min per topic / poster",
suitable:  "release"
};
all_activities[92] = {
phase:     1,
name:      "Vertel een verhaal met vormende woorden",
summary:   "Iedere deelnemer vertelt een verhaal over de laatste iteratie dat bepaalde woorden bevat",
desc:      "Geef iedereen iets om hun verhaal op te schrijven. Introduceer daarna de vormende woorden, \
die het te schrijven verhaal beïnvloeden: \
<ul> \
    <li>Als de laatste iteratie beter geweest kon zijn:<br> \
    Geef een aantal vormende woorden, zoals 'boos, verdrietig, blij' of 'houden, laten vallen, toevoegen'. \
    Daarnaast moet het verhaal in de eerste persoon geschreven worden. Dit voorkomt dat er met vingers gewezen wordt. \
    </li> \
    <li>Als de laatste iteratie succesvol was:<br> \
    Het team mag ofwel hun eigen set woorden uitkiezen, of je kunt een aantal random woorden voorstellen \
	om de creativiteit van het team te ontketenen. \
    </li> \
</ul> \
Iedere deelnemer schrijft nu een verhaal van niet meer dan 100 woorden over de laatste iteratie. Ze moeten de vormende \
woorden ten minste een keer gebruiken. Zet een timebox van 5-10 minuten. <br> \
Zodra iedereen klaar is, worden de verhalen voorgelezen. Bespreek naderhand de gemeenschappelijke thema's van de verhalen.",
source:    "<a href='https://medium.com/p/agile-retrospective-technique-1-7cac5cb4302a'>Philip Rogers</a>",
duration:  "20-30 minutes",
suitable:  "iteration, project, release"
};
all_activities[93] = {
phase:     2,
name:      "BJESM - Bouw je eigen Scrum Master",
summary:   "Het team stelt de ideale SM samen \& neemt verschilende standpunten in",
desc:      "Teken een Scrum Master op een flipchart met drie secties: hersenen, hart, buik. \
<ul>\
<li>Ronde 1: 'Welke eigenschappen vertoont de perfecte SM?' <br>\
Vraag iedereen om elk van de eigenschappen op een stickie te schrijven. Laat de deelnemers de eigenschappen uitleggen en op de tekening plakken. \
</li> \
<li>Ronde 2: 'Wat moet de perfecte SM weten over jullie als team zodat hij goed met jullie kan werken?' \
</li>\
<li>Ronde 3: 'Hoe kunnen jullie de SM ondersteunen om zijn werk uitmuntend te verrichten?' <br> \
</li></ul>\
Je kunt dit ook aanpassen voor andere rollen zoals de ProductOwner.",
source:    "<a href='http://agile-fab.com/2014/10/07/die-byosm-retrospektive/'>Fabian Schiller</a>",
duration:  "30 minutes",
suitable:  "iteration, project, release"
};
all_activities[94] = {
phase:     2,
name:      "Als ik jou was",
summary:   "Wat kunnen subgroepen verbeteren in hun interacties met anderen?",
desc:      "Identificeer subgroepen onder de deelnemers die tijdens de iteratie interacties met elkaar hadden, \
bijvoorbeeld ontwikkelaars/testers, klanten/leveranciers, PO/ontwikkelaars, etc. \
Geef de deelnemers drie minuten om in stilte op te schrijven wat hun groep deed dat een negatieve impact \
op een andere groep had. Iedere persoon mag maar deelnemer van 1 groep zijn, en stickies schrijven voor alle groepen 
waar ze geen deel van uitmaken - 1 stickie per onderwerp. <br><br> \
Vervolgens lezen alle deelnemers hun stickies een voor een voor en geven die aan de juiste groep. \
De groep in kwestie beoordeelt het onderwerp van 0 ('Geen probleem') tot 5 ('Groot probleem'). \
Op deze manier krijg je inzicht en gedeeld begrip over de problemen en kun je er een aantal uitzoeken om aan te werken.",
source:    "<a href='http://www.elproximopaso.net/2011/10/dinamica-de-retrospectiva-si-fuera-vos.html'>Thomas Wallet</a>",
duration:  "25-40 minutes",
suitable:  "iteration, project, release"
};
all_activities[95] = {
phase:     3,
name:      "Probleemoplossingboom",
summary:   "Heb je een groot doel? Zoek de stappen die er naar toe leiden",
desc:      "Deel stickies en stiften uit. Schrijf het grote probleem dat je \
op wilt lossen op een notitie en hang het boven aan de muur of een groot bord. \
Vraag de deelnemers ideeën op te schrijven waarmee zij denken het probleem op te kunnen lossen. \
Hang deze op een niveau onder het originele probleem. Herhaal dit voor iedere notitie op het nieuwe niveau. \
Vraag voor ieder idee of het in een enkele iteratie uitgevoerd kan worden en of iedereen begrijpt wat \
er gebeuren moet. Als het antwoord nee is, breek het probleem dan op op het volgende niveau van de \
probleemoplossingboom.<br><br> \
Zodra de lagere niveaus goed begrepen en simpel te implementeren zijn in een enkele sprint, \
ga je stemmen met stippen (dotvoting) om te beslissen welke acties de volgende sprint aangepakt gaan worden. ",
source:    "<a href='https://www.scrumalliance.org/community/profile/bsarni'>Bob Sarni</a>, beschreven door <a href='http://growingagile.co.za/2012/01/the-problem-solving-tree-a-free-exercise/'>Karen Greaves</a>",
duration:  "30 minutes",
suitable:  "iteration, project, release"
};
