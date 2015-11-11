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
name:      "P&auml;rchen suchen",
summary:   "Die Teilnehmer suchen passende Eigenschaftskarten zu ihren Vorschl&auml;gen zu &quot;anfangen, aufh&ouml;ren, weitermachen&quot;",
desc:      "Vorbereitung: ca. 20 Eigenschaftskarten, z.B. farbige Karteikarten mit eindeutigen Eigenschaften wie <i>lustig</i>, <i>p&uuml;nktlich</i>, <i>klar</i>, <i>wichtig</i>, <i>beeindruckend</i>, <i>gef&auml;hrlich</i>, <i>scheu&szlig;lich</i>.<br> \
Jedes Teammitglied muss vor dem Spiel mindestens neun Karteikarten schreiben: jeweils drei f&uuml;r Dinge, die es anzufangen, aufzuh&ouml;ren oder weiterzumachen gilt. <br></br> \
Ein Teammitglied wird als Richter ausgew&auml;hlt und beginnt:<br> \
<ul>\
<li>Vom Stapel der vorbereiteten Eigenschaftskarten deckt sie / er die erste Karte auf.</li> \
<li>Daraufhin suchen alle anderen Teammitglieder aus ihren selbst geschriebenen Karteikarten die eine aus, die am besten dazu passt und legen sie verdeckt auf den Tisch.</li> \
<li>Wer seine Auswahl als letztes getroffen hat, muss seine Karteikarte wieder aufnehmen und darf in der n&auml;chsten Runde wieder mitmachen. </li> \
<li>Nun sammelt der Richter alle verdeckten Karteikarten auf und mischt sie.</li> \
<li>Anschlie&szlig;end deckt er alle Karteikarten auf und entscheidet, welche am besten zu der aufgedeckten Eigenschaftskarte passt - diese Karteikarte hat die Runde gewonnen. Ihr Autor bekommt die Eigenschaftskarte als Belohnung und alle &uuml;brigen Karteikarten der Runde sind verbraucht und werden zur Seite gelegt.</li> \
<li>Der linke Nachbar vom aktuellen Richter wird der n&auml;chste Richter und eine neue Spielrunde kann beginnen.</li> \
</ul> \
Das Spiel ist zu Ende, sobald keiner mehr Karteikarten hat. Wer die meisten Eigenschaftskarten sammeln konnte, gewinnt.<br></br> \
Schlie&szlig;t die Aktivit&auml;t, indem ihr den Verlauf des Spiels besprecht und welche P&auml;rchen entstanden sind.<br></br> \
(Das Spiel basiert auf &quot;Apples to Apples&quot;)",
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
desc:      "Erkl&auml;re, was <a href='http://de.wikipedia.org/wiki/SMART_%28Projektmanagement%29'>SMARTe Ziele</a> sind (<b>s</b>pezifisch, <b>m</b>essbar, <b>a</b>usf&uuml;hrbar, <b>r</b>elevant, mit <b>T</b>ermin) und liefere zum Vergleich Gegenbeispiele, z.B. &quot;Wir schauen uns die Stories an bevor sie im Sprint-Backlog landen.&quot; (nicht SMART) im Gegensatz zu &quot;Wir untersuchen Stories vor dem Ausw&auml;hlen f&uuml;r das Sprint Backlog, indem wir sie mit dem Produkt Owner jeden Mittwoch um 9:00h gemeinsam diskutieren.&quot; (SMART). <br></br>\
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
all_activities[17] = {
phase:     0,
name:      "Amazon Kundenrezensionen",
summary:   "Bewertet die zur&uuml;ckliegende Iteration wie eine Amazon Kundenrezension. Vergesst die Sterne nicht!",
desc:      "Jedes Teammitglied verfasst eine kurze Rezension mit: \
<ul>\
    <li>Titel</li>\
    <li>Inhalt</li>\
    <li>Sterne-Wertung (von 1 &quot;Gef&auml;llt mir gar nicht&quot; bis 5 &quot;Gef&auml;llt mir sehr&quot;) </li>\
</ul>\
Jeder liest seine Rezension laut vor. Sammle die Sterne-Wertungen auf einem Flipchart.<br>\
Diese Aktivit&auml;t kann auf die gesamte Retrospektive ausgedehnt werden, indem zus&auml;tzlich die Frage beantwortet wird, welche Empfehlungen es f&uuml;r den n&auml;chsten Sprint gibt.",
source:    "<a href='http://blog.codecentric.de/2012/02/unser-sprint-bei-amazon/'>Christian Hei&szlig;</a>",
duration:  "10",
suitable: "release, project"
};
all_activities[18] = {
phase:     1,
name:      "Motoryacht",
summary:   "Findet heraus, was euch antreibt und was euch zur&uuml;ckh&auml;lt.",
desc:      "Male eine einfach Motoryacht oder ein Schiff auf ein Flipchart. Es sollte sichtbar einen gro&szlig;en Motor und einen schweren Anker haben. <br></br> \
Die Teammitglieder schreiben nun f&uuml;r sich auf Klebezettel, was das Team / das Projekt angetrieben oder vorangebracht hat und was es zur&uuml;ckgehalten oder behindert hat. Ein Aspekt geh&ouml;rt auf einen Klebezettel.<br></br> \
H&auml;nge die Klebezettel am Motor und am Anker nacheinander auf und lese sie laut vor. Besprecht, wie sich die treibenden Kr&auml;fte / die Aspekte am Motor verst&auml;rken lassen und sich Anker lichten oder kappen lassen.",
source:    source_innovationGames + ", gefunden bei <a href='http://leadinganswers.typepad.com/leading_answers/2007/10/calgary-apln-pl.html'>Mike Griffiths</a>",
duration: "10-15 groupSize",
suitable: "iteration, release"
};
all_activities[19] = {
phase:     2,
name:      "Der perfekte Sprint",
summary:   "Wie m&uuml;sste der n&auml;chste Sprint sein, damit er perfekt ist?",
desc:      "Bereite ein Flipchart mit zwei Spalten vor, eine f&uuml;r &quot;Bewertung&quot; und eine f&uuml;r &quot;Ma&szlig;nahme&quot;. \
Jeder einzelne aus dem Team bewertet jetzt den vergangenen Sprint von &quot;1&quot; f&uuml;r &quot;mies&quot; bis &quot;10&quot; f&uuml;r &quot;perfekt&quot;. In der Spalte daneben werden Vorschl&auml;ge f&uuml;r Ma&szlig;nahmen gesammelt, mit denen der n&auml;chste Sprint perfekt wird.",
source:    "<a href='http://www.benlinders.com/2011/getting-business-value-out-of-agile-retrospectives/'>Ben Linders</a>",
suitable: "iteration, release",
};
all_activities[20] = {
phase:     3,
name:      "Ma&szlig;nahmen zusammenf&uuml;hren",
summary:   "F&uuml;hrt verschiedene m&ouml;gliche Ma&szlig;nahmen zusammen und entscheidet, welche zwei als n&auml;chstes umgesetzt werden.",
desc:      "Verteile Karteikarten und Stifte. Jeder einzelne im Team schreibt jetzt zwei Ma&szlig;nahmen auf, die er gern im n&auml;chsten Sprint ausprobieren oder umsetzen w&uuml;rde. Achtet wenn m&ouml;glich darauf, dass die Ziele <a href='https://de.wikipedia.org/wiki/SMART_%28Projektmanagement%29'>SMART</a> sind. <br></br> \
Anschlie&szlig;end bilden sich Zweiergruppen, in denen die vier Vorschl&auml;ge diskutiert und zu zwei Vorschl&auml;gen zusammenge&uuml;hrt werden. Dieser Prozess wiederholt sich, indem sich Vierergruppen bilden und aus ihren vier Vorschl&auml;gen wiederum zwei ausw&auml;hlen. Wiederholt den Prozess bei Bedarf erneut mit Achtergruppen. <br></br> \
Sammelt zum Schluss die vier verbleibenden Ma&szlig;nahmen ein und stimmt dar&uuml;ber ab, welche das Team im n&auml;chsten Sprint ausprobieren und umsetzen wird.",
source:    "Lydia Grawunder & Sebastian Nachtigall",
duration:  "15-30 groupSize",
suitable: "iteration, release, project, largeGroups",
};
all_activities[21] = {
phase:     0,
name:      "Stimmungsthermometer",
summary:   "Die Teilnehmer notieren ihre &quot;Temperatur&quot; (Stimmung) auf einem Flipchart.",
desc:      "Bereite ein Flipchart vor, auf das Du ein einfaches Thermometer aufmalst. Es sollte in der Lage sein, Temperaturen vom Gefrierpunkt &uuml;ber K&ouml;rpertemeperatur bis hin zum Siedepunkt anzuzeigen. <br></br> \
Jeder einzelne im Team markiert jetzt ein Stelle auf der Temperaturskala, die seiner aktuellen Stimmung entspricht.",
source:  source_unknown,
};
all_activities[22] = {
phase:     4,
name:      "Die Feedback-T&uuml;r",
summary:   "Stelle mit einfachsten Mitteln fest, ob die Teilnehmer mit der Retrospektive zufrieden waren.",
desc:      "Male ein &quot;:)&quot;, ein &quot;:|&quot;, und ein &quot;:(&quot; auf ein Flipchart oder ein Blatt Papier und h&auml;nge es an die T&uuml;r. Am Ende der Retrospektive bittest Du die Teilnehmer ihre Zufriedenheit mit einem Kreuz am passenden Smiley auszudr&uuml;cken.",
source:    "<a href='http://boeffi.net/tutorials/roti-return-on-time-invested-wie-funktionierts/'>Boeffi</a>",
duration:  "2-3",
suitable: "iteration, largeGroups"
};
all_activities[23] = {
phase:     3,
name:      "Offene Punkte Liste",
summary:   "Die Teilnehmer schlagen Ma&szlig;nahmen vor und &uuml;bernehmen sie anschlie&szlig;end selbst.",
desc:      "Bereite ein Flipchart mit drei Spalten vor, die mit &quot;Was&quot;, &quot;Wer&quot; und &quot;Bis wann&quot; beschriftet sind. Frage einen Teilnehmer nach dem anderen, was er gerne unternehmen w&uuml;rde, um das jeweilige Team voran zu bringen. Schreibe die vorgeschlagene Ma&szlig;nahme auf, einigt euch auf ein F&auml;lligkeitsdatum und lasse den Teilnehmer daneben unterschreiben. <br></br> \
Falls jemand eine Ma&szlig;nahme vorschl&auml;gt, die vom gesamten Team umgesetzt werden muss, braucht der Vorschlagende Unterschriften anderer Teammitglieder zur Unterst&uuml;tzung.",
source:    source_findingMarbles + ", in Anlehnung an <a href='http://lwscologne.wordpress.com/2012/05/08/11-treffen-der-limited-wip-society-cologne/#Retrospektiven'>diese Liste</a>",
duration:  "10-15 groupSize",
suitable: "iteration, release, smallGroups"
};
all_activities[24] = {
phase:     2,
name:      "Diagramm zu Ursache und Wirkung",
summary:   "Findet die Ursachen von Problemen, die sich schwer fassen lassen und zu endlosen Diskussionen f&uuml;hren.",
desc:      "Schreibe auf einen Klebezettel das Problem auf, welches untersucht werden soll und klebe es in die Mitte eines Whiteboards. Finde heraus, warum es sich dabei &uuml;berhaupt um ein Problem handelt, in dem Du immer wieder fragst: &quot;Na und?&quot; <br></br> \
Finde anschlie&szlig;end heraus, was die Ursache f&uuml;r das Problem ist, in dem Du immer wieder fragst &quot;Wieso (kommt es dazu)?&quot;<br></br> \
Dokumentiere eure Erkenntnisse auf Klebezetteln und stelle kausale Zusammenh&auml;nge zwischen ihnen mit Pfeilen her. Jeder Zettel kann mehrere Ursachen haben und mehr als eine Konsequenz. <br></br> \
Diese Methode sollte es euch erm&ouml;glichen, Teufelskreise zu entdecken und etwas gegen sie zu unternehmen.",
source:    "<a href='http://blog.crisp.se/2009/09/29/henrikkniberg/1254176460000'>Henrik Kniberg</a>",
more:      "<a href='http://finding-marbles.com/2011/08/04/cause-effect-diagrams/'>Corinna's experiences</a>",
duration:  "20-60 complexity",
suitable: "release, project, smallGroups, complex"


};
all_activities[25] = {
phase:     2,
name:      "Speed Dating",
summary:   "Geht einer Sache in Zweiergruppen auf den Grund.",
desc:      "Jeder Teilnehmer schreibt ein Thema auf, dem er auf den Grund gehen m&ouml;chte, z.B. etwas, was er ver&auml;ndern m&ouml;chte. Anschlie&szlig;end werden Zweiergruppen gebildet, die sich im Raum verteilt hinsetzen. Jede Zweiergruppe bespricht beide Themen und sammelt m&ouml;gliche Ma&szlig;nahmen - f&uuml;nf Minuten pro Thema und Teilnehmer, einer nach dem anderen.<br>\
Nach zehn Minuten l&ouml;sen sich die Gruppen auf und es bilden sich neue Zweiergruppen. Fahrt damit fort, bis jeder mit jedem gesprochen hat.<br></br> \
Bei Gruppen mit einer ungeraden Anzahl an Teilnehmern setzt sich der Moderator mit in ein Team. Sein Partner bekommt in diesem Fall die gesamte Redezeit von zehn Minuten.",
source:    source_kalnin,
duration:  "10 pro Person",
suitable: "iteration, release, smallGroups"
};
all_activities[26] = {
phase:     5,
name:      "Retrospektive Gl&uuml;ckskekse",
summary:   "Lade das Team zum Essen ein und rege mit retrospektiven Gl&uuml;ckskeksen zum Gespr&auml;ch an.",
desc:      "Lade das Team zum Essen ein, am besten zum Chinesen, dann passen die Gl&uuml;ckskekse besser. Du kannst die <a href='http://weisbart.com/cookies/'>retrospektiven Gl&uuml;ckskekse bei Adam Weisbart bestellen</a> oder eigene backen, denn die Spr&uuml;che gibt es bei Adam nur auf Englisch.<br></br> \
Verteile die Gl&uuml;ckskekse und lasse sie der Reihe nach &ouml;ffnen. Besprecht Spr&uuml;che wie zum Beispiel: \
<ul>\
    <li> What was the most effective thing you did this Sprint, and why was it so successful?</li>\
    <li>Did the burndown reflect reality? Why or why not?</li>\
    <li>What do you contribute to the development community in your company? What could you contribute?</li>\
    <li>What was our Team's biggest impediment this Sprint?</li>\
</ul>",
source:    "<a href='http://weisbart.com/cookies/'>Adam Weisbart</a>",
duration:  "90-120",
suitable: "iteration, release, smallGroups"
};
all_activities[27] = {
phase:     5,
name:      "Spazieren gehen",
summary:   "Geht in den n&auml;chstgelegenen Park, schlendert umher und unterhaltet euch.",
desc:      "Ist gerade sch&ouml;nes Wetter drau&szlig;en? Dann lasst euch nicht im B&uuml;ro einsperren, sondern nutzt einen Spaziergang, um frischen Sauerstoff zu tanken und auf neue Ideen zu kommen. Geht raus und macht einen Spaziergang im n&auml;chstgelegenen Park. Eure Unterhaltungen werden sich nach einiger Zeit von ganz alleine um die Arbeit drehen. <br></br> \
Ziel ist es, in einer informellen Umgebung aus Gewohnheiten auszubrechen. Geeignet ist das in Phasen, in denen eigentlich alles ganz gut l&auml;uft und ihr keine visuelle Dokumentation braucht, um Diskussionen und Gespr&auml;che anzuregen. Ge&uuml;bte Teams k&ouml;nnen auch so Ideen austauschen und gemeinsam Entscheidungen treffen.",
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
name:      "Gespr&auml;chsb&ouml;gen",
summary:   "Ein strukturierter Ansatz f&uuml;r Diskussionen",
desc:      "Gespr&auml;chsb&ouml;gen (engl. dialogue sheet) sehen ein wenig so aus wie ein Spielbrett von einem Gesellschaftsspiel. Es sind schon <a href='http://www.softwarestrategy.co.uk/dlgsheets/available.html'>einige Gespr&auml;chsb&ouml;gen online verf&uuml;gbar</a>. <br /> \
W&auml;hle einen aus, drucke ihn so gro&szlig; wie m&ouml;glich aus (am besten in DIN A1) und befolge anschlie&szlig;end die Anweisungen auf dem Gespr&auml;chsbogen.",
source:    "<a href='http://www.softwarestrategy.co.uk/dlgsheets/available.html'>Allen Kelly at Software Strategy</a>",
duration:  "90-120",
suitable: "iteration, release, project"
};
all_activities[30] = {
phase:     0,
name:      "Die Iteration malen",
summary:   "Die Teilnehmer malen ein Bild zur zur&uuml;ckliegenden Iteration",
desc:      "Verteile Karteikarten und Stifte. Gebe ein Thema vor, z.B.:\
<ul>\
    <li>Wie hast Du Dich w&auml;hrend der Iteration gef&uuml;hlt?</li>\
    <li>Gab es einen Aha!-Moment? Welcher war das?</li>\
    <li>Was war das gr&ouml;&szlig;te Problem?</li>\
    <li>Was hast Du vermisst?</li>\
</ul>\
Bitte die Teilnehmer, ihre Antwort als ein kleines Bild zu malen. H&auml;nge alle Zeichnungen an ein Whiteboard. Sprecht die Zeichnungen gemeinsam durch und lasse die Teilnehmer zun&auml;chst raten, was dargestellt ist und was es zu bedeuten hat. Anschlie&szlig;end erkl&auml;rt der jeweilige K&uuml;nstler sein Bild. <br></br> \
Metaphern erm&ouml;glichen den Perspektivwechsel und neue Sichtweisen. Gemeinsam entwickelt das Team so ein Verst&auml;ndnis f&uuml;r die Geschehnisse in der letzten Interation.",
source:    source_findingMarbles + ", &uuml;bernommen und angepasst von <a href='http://vinylbaustein.net/2011/03/24/draw-the-problem-draw-the-challenge/'>Thorsten Kalnin</a> und Olivier Gourment",
duration:  "5 + 3 per person",
suitable: "iteration, release, project"
};
all_activities[31] = {
phase:     0,
name:      "Projekt-Gef&uuml;hlsmesser",
summary:   "Hilf Deinen Teammitgliedern dabei, ihre Gef&uuml;hle zum Projekt auszudr&uuml;cken und sprecht schon fr&uuml;hzeitig &uuml;ber die Ursachen",
desc:      "Bereite einen Flipchart vor mit Gesichtern, die Emotionen ausdr&uuml;cken, z.B.:\
<ul>\
    <li>schockiert / &uuml;berrascht</li>\
    <li>nerv&ouml;s / gestresst</li>\
    <li>machtlos / eingeschr&auml;nkt</li>\
    <li>verwirrt</li>\
    <li>gl&uuml;cklich</li>\
    <li>wahnsinnig</li>\
    <li>&uuml;berw&auml;ltigt</li>\
</ul>\
Alle Teammitglieder w&auml;hlen ein Gesicht, das am besten ausdr&uuml;ckt, wie sie sich im Projekt f&uuml;hlen. So lassen sich auf unterhaltsame Weise Probleme schon fr&uuml;h zu Tage f&ouml;rdern. Ihr k&ouml;nnt Sie in den Folgephasen der Retrospektive besprechen.",
source:    "Andrew Ciccarelli",
duration:  "10 for 5 people",
suitable: "iteration, release"
};
all_activities[32] = {
phase:     1,
name:      "Stolz & Bedauern",
summary:   "Worauf sind die Teammitglieder stolz, was bedauern sie?",
desc:      "H&auml;nge zwei Flipcharts auf mit den &Uuml;berschriften &quot;Stolz&quot; und &quot;Bedauern&quot;. Die Teammitglieder schreiben pro Klebezettel eine Situation auf, die auf eines der Poster passt. Sobald die Zeit um ist, liest jeder seine Zettel kurz vor und h&auml;ngt sie auf das passende Poster.<br></br>\
Er&ouml;ffne eine kurze Diskussion z.B. mit einer der folgenden Fragen an das Team:\
<ul>\
    <li>Gibt es auf den Postern etwas, was euch &uuml;berrascht hat?</li>\
    <li>Sind Gemeinsamkeiten erkennbar? Was bedeuten sie f&uuml;r das Team?</li>\
</ul>",
source:    source_agileRetrospectives,
duration:  "10-15",
suitable: "iteration, release"
};
all_activities[33] = {
phase:     4,
name:      "In Anerkennung baden",
summary:   "H&ouml;re anderen dabei zu, wie sie sich hinter Deinem R&uuml;cken &uuml;ber Dich unterhalten - und ihnen nur Gutes einf&auml;llt!",
desc:      "Bilde Gruppen mit jeweils drei Personen. Jede Gruppe stellt drei St&uuml;hle so auf, dass zwei sich gegen&uuml;ber stehen und der dritte ihnen den R&uuml;cken zudreht. <br></br> \
Zwei Teammitglieder, die sich gegen&uuml;ber sitzen, unterhalten sich f&uuml;r zwei Minuten &uuml;ber die dritte Person. Dabei d&uuml;rfen sie nur anerkennende und positive Dinge erw&auml;hnen und nichts von dem Gesagten im Nachhinein entkr&auml;ften.<br></br>\
Haltet drei Runden ab, so dass jeder die Gelegenheit bekommt, in Anerkennung zu baden.",
source:    '<a href="http://www.miarka.com/de/2010/11/shower-of-appreciation-or-talking-behind-ones-back/">Ralph Miarka</a>',
duration:  "10-15",
suitable: "iteration, release, matureTeam"
};
all_activities[34] = {
phase:     1,
name:      "Agile Selbsteinsch&auml;tzung",
summary:   "Sch&auml;tzt anhand einer Checkliste ein, wie agil ihr seid.",
desc:      "Drucke eine der folgenden Checklisten aus, die zu euch passt: \
<ul>\
    <li>Die <a href='http://www.crisp.se/gratis-material-och-guider/scrum-checklist'>Scrum Checklist</a> von Henrik Kniberg</li>\
    <li><a href='http://finding-marbles.com/2011/09/30/assess-your-agile-engineering-practices/'>Self-assessment of agile engineering practices</a> von Corinna Baldauf</li>\
    <li>Der <a href='http://agileconsortium.blogspot.de/2007/12/nokia-test.html'>Nokia Test</a>, beschrieben von Joe Little</li>\
</ul>\
Geht die Checkliste im Team durch und diskutiert, wie agil ihr seid und ob ihr auf dem richtigen Weg seid.<br></br>\
Diese Aktivit&auml;t eignet sich gut f&uuml;r eine Retrospektive nach einer Iteration, in der nicht viel passiert ist.",
source:    source_findingMarbles,
duration:  "10-25 minutes depending on the list",
suitable: "smallTeams, iteration, release, project, smoothGoing"
};
all_activities[35] = {
phase:     0,
name:      "Wertsch&auml;tzendes Ziel",
summary:   "W&auml;hle ein positives Motto f&uuml;r die Retrospektive.",
desc:      "Konzentriert euch auf positive Aspekte eurer Arbeit statt auf Probleme. Gib der Retrospektive ein positives Motto, wie z.B.:\
<ul>\
    <li>Lasst uns einen Weg finden, unsere St&auml;rken beim Vorgehen und in der Zusammenarbeit weiter auszubauen.</li>\
    <li>Lasst uns herausfinden, wie wir die Verwendung von etablierten Entwicklungspraktiken und -methoden steigern k&ouml;nnen.</li>\
    <li>Wir finden heraus, wo oder zwischen wem die Zusammenarbeit bereits besonders gut funktioniert und wie wir gezielt eine solche hoch produktive Atmosph&auml;re schaffen k&ouml;nnen.</li>\
    <li>Wir finden heraus, wie und wo wir in der letzten Iteration den h&ouml;chsten Mehrwert f&uuml;r unseren Kunden geschaffen haben, um den erzeugten Mehrwert in der n&auml;chsten Iteration noch zu steigern.</li>\
</ul>",
source:    "<a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
duration:  "3 minutes",
suitable: "iteration, release, project"
};
// Values for duration: "<minMinutes>-<maxMinutes> perPerson"
// Values for suitable: "iteration, realease, project, introverts, max10People, rootCause, smoothSailing, immature, largeGroup"