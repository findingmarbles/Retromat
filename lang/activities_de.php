var phase_titles = ['Gespr&auml;chsklima schaffen', 'Themen sammeln', 'Erkenntnisse gewinnen', 'Entscheidungen treffen', 'Abschluss', 'Etwas v&ouml;llig Anderes'];

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
name:      "FEUG (engl. ESVP)",
summary:   "Welche Haltung haben die Teilnehmer zur Retrospektive? In welcher Rolle f&uuml;hlen sie sich? Forscher, Einkaufsbummler, Urlauber, Gefangener.",
desc:      "Vorbereitung: Ein Flipchart mit vier Bereichen f&uuml;r die vier Rollen. Erkl&auml;re den Teilnehmern die Rollen: <br>\
<ul>\
    <li>Forscher: Wissbegierig und neugierig. M&ouml;chte herausfinden, was gut und was nicht gut funktioniert und wie sich Verbesserungen erreichen lassen.</li>\
    <li>Einkaufsbummler: Positive Grundeinstellung. Freut sich, wenn auch nur eine gute Sache herauskommt.</li>\
    <li>Urlauber: Nimmt widerwillig teil. Immer noch besser als Arbeiten.</li>\
    <li>Gefangener: Nimmt nur teil, weil er das Gef&uuml;hl hat, dass er muss.</li>\
</ul>\
Starte eine anonyme Umfrage, bei der jeder die Rolle, in der er sich am ehesten wiederfindet, auf ein St&uuml;ck Papier schreibt. Sammle die Stimmzettel ein und z&auml;hle das Ergebnis f&uuml;r alle sichtbar auf dem vorbereiteten Flipchart. Falls im Team wenig Vertrauen herrscht, kannst Du die Stimmzettel nach ihrer Z&auml;hlung demonstrativ vernichten, um die Anonymit&auml;t sicherzustellen. <br>\
Um in die Diskussion einzusteigen, frage das Team, was sie von dem Ergebnis der Umfrage halten und wie sie es interpretieren. Falls Urlauber oder Gefangene in der &Uuml;berzahl sind, k&ouml;nntet ihr diese Erkenntnis in der Retrospektive besprechen.",
duration:  "5-10 numberPeople",
source:  source_agileRetrospectives,
suitable:   "iteration, release, project, immature"
};
all_activities[1] = {
phase:     0,
name:      "Wetterbericht",
summary:   "Die Teilnehmer markieren ihr Stimmungs-&quot;Wetter&quot; auf einem Flipchart.",
desc:      "Vorbereitung: Ein Flipchart mit Symbolen f&uuml;r Gewitter, Regen, Bew&ouml;lkung und Sonnenschein. Jeder Teilnehmer macht eine Markierung bei dem Wetterbericht, der am ehesten seiner Stimmung entspricht.",
source:  source_agileRetrospectives,
};
all_activities[2] = {
phase:     0,
name:      "Check In", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Stelle eine Frage oder Aufgabe, die nacheinander von allen Teilnehmern beantwortet wird.",
desc:      "Nach dem Round-Robin-Prinzip antwortet jeder Teilnehmer auf die gleiche Frage / Aufgabe (es sei denn, er m&ouml;chte &uuml;bersprungen werden). Beispiele: <br>\
<ul>\
    <li>Beschreibe in einem Wort, was Du von dieser Retrospektive als Ergebnis f&uuml;r Dich brauchst.</li>\
    <li>&Auml;u&szlig;ere eine Bef&uuml;rchtung oder eine Sorge, z.B. in dem Du sie aufschreibst und sie bewusst - auch physikalisch - zur Seite legst.</li>\
	<li>Wenn Du nur f&uuml;r dieses Treffen ein Auto w&auml;rst, was f&uuml;r eines w&auml;rst Du?</li>\
	<li>Welches Wort beschreibt Deinen Gef&uuml;hlszustand am besten? Fr&ouml;hlich, sauer, traurig, &auml;ngstlich?</li>\
</ul> <br>\
Vermeide es, auf Antworten wie &quot;gut&quot; weiter einzugehen oder eine Erkl&auml;rung zu verlangen.",
source:  source_agileRetrospectives
};
all_activities[3] = {
phase:     1,
name:      "Zeitstrahl",
summary:   "Die Teilnehmer schreiben wichtige Ereignisse auf und sortieren sie chronologisch.",
desc:      "Teile die Teilnehmer in Gruppen mit nicht mehr als f&uuml;nf Personen ein. Verteile Karteikarten und Stifte. Gib ihnen 10 Minuten Zeit, Ereignisse aufzuschreiben, an die sie sich spontant erinnern oder die f&uuml;r sie pers&ouml;nlich wichtig sind. <br>\
Ziel ist es, viele verschiedene Sichtweisen zu sammeln. Eine einheitliche Sichtweise w&auml;re f&uuml;r diese Methode kontraproduktiv.<br>\
Anschlie&szlig;end h&auml;ngen die Teilnehmer ihre Karten f&uuml;r alle gut sichtbar auf und ordnen sie chronologisch. Es ist ausdr&uuml;cklich erlaubt und erw&uuml;nscht, dass zwischendurch weitere Karten hinzugef&uuml;gt werden. Analysiert das Ergebnis gemeinsam.<br>\
Farbige Karteikarten k&ouml;nnen verwendet werden, um unterschiedliche Arten von Ergeignissen kenntlich zu machen. Beispiele:<br>\
<ul>\
    <li>Gef&uuml;hle</li>\
    <li>Ereignisse (bezogen auf die Technik, die Organisation, Menschen im Team, ...)</li>\
    <li>Funktion (Tester, Entwickler, Manager, ...)</li>\
</ul>",
duration:  "60-90 timeframe",
source:  source_agileRetrospectives,
suitable: "iteration, introverts"
};
all_activities[4] = {
phase:     1,
name:      "User Stories analysieren",
summary:   "Gehe die f&uuml;r den letzten Sprint geplanten User Stories durch und suche nach m&ouml;glichen Verbesserungen.",
desc:      "Vorbereitung: Sammle f&uuml;r die Retrospektive alle User Stories ein, die f&uuml;r den vergangenen Sprint geplant waren. Lies jede User Story in der Gruppe (max. 10 Teilnehmer) vor und stelle zur Diskussion, ob die Umsetzung der Story gut oder schlecht gelaufen ist.<br> \
<ul>\
<li>Falls die Gruppe der Meinung ist, dass die Story gut gelaufen ist, so sammelt gemeinsam Gr&uuml;nde daf&uuml;r.</li>\
<li>Falls die Story schlecht gelaufen ist, so sammelt Vorschl&auml;ge, was das Team in Zukunft anders machen kann.</li>\
</ul> <br>\
Abwandlung: Diese Methode kann ebenso auf Support-Tickets, Bugs oder andere Aufgaben in einem Team angewandt werden.",
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
name:      "W&uuml;tend Traurig Gl&uuml;cklich",
summary:   "Sammelt Anl&auml;sse, zu denen Teammitglieder sich w&uuml;tend, traurig oder gl&uuml;cklich gef&uuml;hlt haben und findet dazu die Ursachen.",
desc: "H&auml;nge drei Plakate auf mit den &Uuml;berschriften &quot;w&uuml;tend&quot;, &quot;traurig&quot;, &quot;gl&uuml;cklich&quot; oder einfach &gt;:), :(, :). Die Teammitglieder schreiben anschlie&szlig;end eine Situation / einen Anlass pro Plakat auf eine farbig passende Karteikarte. <br>\
Nach Ablauf der Zeit h&auml;ngt jeder seine Karten auf das jeweils passende Plakat und Du gruppierst Sie. Besprecht gemeinsam passende Bezeichnungen f&uuml;r die Gruppen. <br>\
Leite die Nachbesprechung mit Fragen ein: <br>\
<ul>\
    <li>Was f&auml;llt euch auf? Was hat euch &uuml;berrascht?</li>\
    <li>Fiel euch die Aufgabe schwer? Hat die Aufgabe Spa&szlig; gemacht?</li>\
    <li>Lassen sich Muster erkennen oder wiederholt sich etwas? Was bedeutet das f&uuml;r euch als Team?</li>\
    <li>Gibt es Vorschl&auml;ge dazu, wie ihr als Team weitermachen wollt?</li>\
</ul>",
source:    source_agileRetrospectives,
duration:  "15-25",
suitable: "iteration, release, project, introverts"
};
all_activities[7] = {
phase:     2,
name:      "5 mal &quot;Warum?&quot;",
summary:   "Grabt euch durch bis zur Wurzel des Problems indem ihr immer wieder fragt &quot;Warum?&quot;.",
desc:      "Teile die Teilnehmer in kleine Gruppen (&lt;= 4 Leute) auf und ordne jeder Gruppe eins der wichtigsten und zuvor identifizierten Themen zu.<br />\
Aufgabe in den Gruppen:\
<ul>\
    <li>Einer fragt die Anderen immer wieder: &quot;Warum?&quot; oder &quot;Wie kam es dazu?&quot;, um die urs&auml;chliche Kette von Ereignissen oder die Wurzel des Problems freizulegen.</li>\
    <li>Schreibe die Wurzel des Problems auf. Oft handelt es sich dabei um die Antwort auf das f&uuml;nfte &quot;Warum?&quot;.</li>\
</ul>\
Anschlie&szlig;end tauschen sich die Gruppen zu ihren Ergebnissen aus.",
source:    source_agileRetrospectives,
duration:  "15-20",
suitable: "iteration, release, project, root_cause"
};
all_activities[8] = {
phase:     2,
name:      "Lernmatrix",
summary:   "Macht ein Brainstorming in vier Kategorien, um schnell auf eine Liste von Themen zu kommen, die der Gruppe wichtig sind.",
desc:      "Nachdem die Themen aus Phase 2 besprochen wurden, zeige der Gruppe einen Flipchart mit vier Quadranten beschriftet mit :), :(, &quot;Idee!&quot; und &quot;Wertsch&auml;tzung&quot;. Verteile selbstklebende Notizzettel. \
<ul>\
    <li>Die Teilnehmer d&uuml;rfen in jedem Quadranten Zettel aufh&auml;ngen - mit immer nur einem Aspekt / Gedanken pro Zettel. </li>\
    <li>Gruppiere die Zettel.</li>\
    <li>Verteile 6-10 Klebepunkte und ermuntere die Gruppe, gemeinsam dar&uuml;ber abzustimmen, welches die wichtigsten Themen sind.</li>\
</ul>\
Diese Liste ist euer Auftakt f&uuml;r Phase 4.",
source:    source_agileRetrospectives,
duration:  "20-25",
suitable: "iteration"
};
all_activities[9] = {
phase:     2,
name:      "Brainstorming / Aussortieren",
summary:   "Erzeugt viele Ideen und sortiert sie anhand eurer Kriterien aus.",
desc:      "Erkl&auml;re die Regeln und das Ziel des Brainstormings: Es geht darum, m&ouml;glichst viele neue Ideen und Vorschl&auml;ge zu sammeln und sie <em>hinterher</em> auszusortieren.\
<ul>\
    <li>Lasse den Teilnehmern 5-10 Minuten Zeit, ihre Ideen und Vorschl&auml;ge aufzuschreiben.</li>\
    <li>Gehe reihum und lasse Dir jeweils eine Idee / einen Vorschlag nennen, bis Du alle auf einem Flipchart gesammelt hast.</li>\
    <li>Frage jetzt das Team, welche Auswahlkriterien es anwenden m&ouml;chte (z.B. Kosten, zeitlicher Aufwand, Einzigartigkeit der Idee, passt der Vorschlag zum Produkt, usw. ...). \
        Das Team w&auml;hlt vier Kriterien aus.</li>\
    <li>Wende alle Kriterien nacheinander auf die gesammelten Vorschl&auml;ge an und markiere, welche davon alle vier Kriterien erf&uuml;llen.</li>\
    <li>Welche Ideen und Vorschl&auml;ge sollen vom Team umgesetzt werden? Gibt es welche, die jemandem f&uuml;r besonders wichtig h&auml;lt?\
        Kl&auml;rt das im Zweifelsfall per Mehrheitsentscheid. </li>\
</ul>\
Die ausgew&auml;hlten Ideen und Vorschl&auml;ge sind die Grundlage f&uuml;r Phase 4.",
source:    source_agileRetrospectives,
more:     "<a href='http://www.mpdailyfix.com/the-best-brainstorming-nine-ways-to-be-a-great-brainstorm-lead/'>\
    Nine Ways To Be A Great Brainstorm Lead</a>",
duration:  "40-60",
suitable: "iteration, release, project, introverts"
};
all_activities[10] = {
phase:     3,
name:      "Fragen im Kreis",
summary:   "Im Kreis werden ringsherum Fragen gestellt und beantwortet, damit das Team sich einig dar&uuml;ber wird, was zu tun ist.",
desc:      "Das Team setzt sich in einen Kreis. K&uuml;ndige an, dass Du ringsherum jedem eine Frage stellen wirst, um herauszufinden, was das Team jetzt machen sollte. <br>\
Frage zuerst Deinen Nachbarn, was das Wichtigste ist, womit das Team in der n&auml;chsten Iteration auf jeden Fall anfangen sollte. Der Gefragte beantwortet die Frage und wendet sich mit einer &auml;hnlichen Frage an seinen Nachbarn. <br>\
Ihr k&ouml;nnt aufh&ouml;ren, sobald sich das Team einig ist oder die Zeit verstrichen ist. Jeder sollte mindestens einmal gefragt werden, damit alle sich einbringen k&ouml;nnen.",
source:    source_agileRetrospectives,
duration:  "30+ groupsize",
suitable: "iteration, release, project, introverts"
};
all_activities[11] = {
phase:     3,
name:      "Abstimmen mit Klebepunkten - anfangen, aufh&ouml;ren, weitermachen",
summary:   "Macht ein Brainstorming dazu, womit ihr anfangen, aufh&ouml;ren oder weitermachen wollt und w&auml;hlt den besten Vorschlag aus.",
desc:      "Teile einen Flipchart in drei Bereiche auf, die mit &quot;anfangen&quot;, &quot;weitermachen&quot; und &quot;aufh&ouml;ren&quot; beschriftet werden. <br>\
Bitte das Team, sich konkrete Vorschl&auml;ge f&uuml;r jeden Bereich einfallen zu lassen und in Ruhe aufzuschreiben - immer nur ein Vorschlag pro Karteikarte. Anschlie&szlig;end liest jeder seine Karten vor und h&auml;ngt sie in den passenden Bereich auf den Flipchart. <br>\
Diskutiere mit dem Team, welches die besten Ideen sind, &uuml;ber deren Umsetzung sich abstimmen l&auml;sst. Leite die Abstimmung ein, indem Du Klebepunkte verteilst, die frei verteilt werden d&uuml;rfen - einen, zwei oder drei pro Person. Alternativ zu Klebepunkten k&ouml;nnen die Teammitglieder auch gro&szlig;e &quot;X&quot; malen. <br>\
Die zwei oder drei Vorschl&auml;ge mit den meisten Punkten oder &quot;X&quot; sind zur Umsetzung ausgew&auml;hlt - sie sind eure Action Items. <br><br> \
(Die <a href='http://www.funretrospectives.com/open-the-box/'>&quot;Open the Box&quot;-Methode</a> von Paulo Caroli ist eine Variation dieser Aktivit&auml;t.)",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[12] = {
phase:     3,
name:      "SMARTe Ziele",
summary:   "Entwickelt genaue und &uuml;berpr&uuml;fbare Ziele.",
desc:      "Erkl&auml;re, was <a href='http://de.wikipedia.org/wiki/SMART_%28Projektmanagement%29'>SMARTe Ziele</a> sind (<b>s</b>pecific, <b>m</b>easurable, <b>a</b>ttainable, <b>r</b>elevant, <b>t</b>imely) und liefere zum Vergleich Gegenbeispiele, z.B. &quot;Wir schauen uns die Stories an bevor sie im Sprint-Backlog landen.&quot; (nicht SMART) im Gegensatz zu &quot;Wir untersuchen Stories vor dem Ausw&auml;hlen f&uuml;r das Sprint Backlog, indem wir sie mit dem Produkt Owner jeden Mittwoch um 9:00h gemeinsam diskutieren.&quot; (SMART). <br></br>\
Bildet Gruppen zu den Themen, an denen das Team arbeiten m&ouml;chte. Jede Gruppe entwickelt bis zu f&uuml;nf konkrete Schritte zum Erreichen des Ziels und pr&auml;sentiert seine Ergebnisse. Alle Teilnehmer stellen gemeinsam sicher, dass die Ziele SMART sind. &Uuml;berarbeitet die Ziele falls n&ouml;tig und lasst euch vom Team dann erneut best&auml;tigen, dass sie SMART genug sind.",
source:    source_agileRetrospectives,
duration:  "20-60 groupsize",
suitable: "iteration, release, project"
};
all_activities[13] = {
phase:     4,
name:      "Die Feedback-T&uuml;r - Zahlen",
summary:   "Miss die Zufriedenheit der Teilnehmer auf einer Skala von 1 bis 5 ohne viel Aufwand.",
desc:      "H&auml;nge Klebezettel beschriftet mit den Zahlen 1 bis 5 an die T&uuml;r. 1 bedeutet &quot;top / am besten&quot; und 5 &quot;schlecht&quot;. Am Ende der Retrospektive darf jeder Teilnehmer einen Klebezettel unter die Zahl h&auml;ngen, mit der er die Retrospektive bewerten m&ouml;chte. Der Klebezettel darf dabei leer bleiben oder aber auch mit einem Kommentar oder Vorschlag zur Retrospektive versehen werden.",
source:    "ALE 2011, " + source_findingMarbles,
duration:  "2-3",
suitable: "iteration, largeGroups"
};
all_activities[14] = {
phase:     4,
name:      "Wertsch&auml;tzung",
summary:   "Teammitglieder sch&auml;tzen sich gegenseitig wert und schlie&szlig;en mit einer positiven R&uuml;ckmeldung.",
desc:      "Beginne mit der aufrichtigen Wertsch&auml;tzung eines anderen Teammitglieds. Dabei kann es um alles gehen, was er oder sie zum Projekt beigetragen hat: Hilfestellung f&uuml;r jemanden aus dem Team oder dem Projekt, L&ouml;sung eines Problems, etc. Lade die anderen Teammitglieder dazu ein, reihum im selben Sinne ihre Teamkameraden zu loben und wertzusch&auml;tzen. Beende die Aktivit&auml;t, sobald eine etwas l&auml;ngere Pause entsteht und niemand mehr etwas zu sagen hat.",
source:    source_agileRetrospectives + ", die es aus 'The Satir Model: Family Therapy and Beyond' entnommen haben.",
duration:  "5-30 groupsize",
suitable: "iteration, release, project"
};
all_activities[15] = {
phase:     4,
name:      "hilfreich, hinderlich, hypothetisch",
summary:   "Hole Dir konkretes Feedback zu Deiner T&auml;tigkeit als Coach / Moderator",
desc:      "Bereite drei Flipcharts mit den &Uuml;berschriften &quot;hilfreich&quot;, &quot;hinderlich&quot; und &quot;hypothetisch&quot; (im Sinne von Vorschl&auml;gen) vor. Erl&auml;utere den Teilnehmern, dass es darum geht, Dir als Coach / Moderator Feedback zu geben, damit Du Dich in Deiner Rolle weiterentwickeln und verbessern kannst. Bitte die Teilnehmer, auf Klebezetteln ihre Ideen zu den Kategorien auf den FlipCharts <br> \
<ul> \
	<li>(was war) <b>hilfreich</b>,</li> \
	<li>(was war) <b>hinderlich</b> und </li> \
	<li><b>hypothetisch</b> (Vorschl&auml;ge)</li> \
</ul> \
zu schreiben und, sofern Sie einverstanden sind, mit ihren Initialen zu signieren, damit Du sie hinterher noch zu ihren Vorschl&auml;gen und Kommentaren befragen kannst.",
source:    source_agileRetrospectives,
duration:  "5-10",
suitable: "iteration, release"
};
all_activities[16] = {
phase:     4,
name:      "SaMoLo (Same of, More of, Less of)",
summary:   "Hole Dir Verbesserungsvorschl&auml;ge zu Deiner Rolle als Moderator",
desc:      "Unterteile ein Flipchart in drei Abschnitte mit den &Uuml;berschriften &quot;More of&quot; , &quot;Same of&quot; und &quot;Less of&quot;. Bitte die Teilnehmer, Dir einen Schubs in die richtige Richtung zu geben: Sammle Klebezettel dazu, wovon sie mehr (<b>More of</b>), gleichbleibend viel (<b>Same of</b>) oder weniger wollen (<b>Less of</b>). Lies die Klebezettel kategorieweise laut vor und besprich sie kurz.",
more:      "<a href='http://www.scrumology.net/2010/05/11/samolo-retrospectives/'>David Bland's experiences</a>",
source:    "<a href='http://fairlygoodpractices.com/samolo.htm'>Fairly good practices</a>",
duration:  "5-10",
suitable: "iteration, release, project"
};
// Values for duration: "<minMinutes>-<maxMinutes> perPerson"
// Values for suitable: "iteration, realease, project, introverts, max10People, rootCause, smoothSailing, immature, largeGroup"