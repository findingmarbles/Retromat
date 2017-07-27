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
name:      "Abstimmung mit Klebepunkten - anfangen, aufh&ouml;ren, weitermachen",
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
name:      "Kreise &amp; die Ursuppe / Einflussbereiche",
summary:   "Entwickelt Ma&szlig;nahmen abh&auml;ngig davon, ob es in eurer Gewalt liegt, sie umzusetzen.",
desc:      "Bereite ein Flipchart mit drei konzentrischen Kreisen vor, die gro&szlig; genug sind, um Klebezettel hineinzuh&auml;ngen. Beschrifte die Kreise von innen nach au&szlig;en mit\
<ul>\
    <li>&quot;Volle Kontrolle - unmittelbar umsetzbare Ma&szlig;nahmen&quot;,</li>\
    <li>&quot;Unser Einflussbereich - &Uuml;berzeugungsarbeit&quot; und</li>\
    <li>&quot;Die Ursuppe - Wir k&ouml;nnen nur reagieren&quot;.</li>\
</ul>\
Die &quot;Ursuppe&quot; steht stellvertretend f&uuml;r das Umfeld des Teams und die Umst&auml;nde, auf die ihr keinen Einfluss habt.<br></br> \
Platziere eure Erkenntnisse aus der vorangegangenen Phase in den passenden Kreisen. Entwickelt anschlie&szlig;end in Zweiergruppen m&ouml;gliche Ma&szlig;nahmen. Konzentriert euch dabei auf Themen, die in eurer Gewalt liegen und die ihr direkt beeinflussen k&ouml;nnt.<br> \
Die Zweiergruppen stellen ihre Ma&szlig;nahmen vor und platzieren sie neben dem jeweiligen Thema.<br></br> \
Einigt euch darauf, welche Ma&szlig;nahmen ihr umsetzen wollt, z.B. in einer Diskussion, per Mehrheitsentscheid oder einer Abstimmung mit Klebepunkten.",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/07/26/circles-and-soup/'>Diana Larsen</a> in Anlehnung an &quot;Seven Habits of Highly Effective People&quot; von Stephen Covey und &quot;<a href='http://www.ayeconference.com/wiki/scribble.cgi?read=CirclesOfControlInfluenceAndConcern'>CircleofInfluenceAndConcern</a>&quot; von Jim Bullock",
suitable: "iteration, release, project, stuck, immature"
};
all_activities[29] = {
phase:     5,
name:      "Gespr&auml;chsb&ouml;gen",
summary:   "Ein strukturierter Ansatz f&uuml;r Diskussionen",
desc:      "Gespr&auml;chsb&ouml;gen (engl. dialogue sheet) sehen ein wenig so aus wie ein Spielbrett von einem Gesellschaftsspiel. Es sind schon <a href='http://allankelly.net/dlgsheets/'>einige Gespr&auml;chsb&ouml;gen online verf&uuml;gbar</a>. <br /> \
W&auml;hle einen aus, drucke ihn so gro&szlig; wie m&ouml;glich aus (am besten in DIN A1) und befolge anschlie&szlig;end die Anweisungen auf dem Gespr&auml;chsbogen.",
source:    "<a href='http://allankelly.net/dlgsheets/'>Allen Kelly at Software Strategy</a>",
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
all_activities[36] = {
phase:     2,
name:      "Zur&uuml;ck in die Zukunft",
summary:   "Stellt euch vor, der n&auml;chste Sprint w&auml;re perfekt gelaufen. Beschreibt ihn und besprecht, was ihr gemacht habt.",
desc:      "Stellt euch vor, ihr unternehmt eine Zeitreise ans Ende der n&auml;chsten Iteration oder zum n&auml;csten Release. Ihr findet heraus, dass es die bisher beste und produktivste Iteration &uuml;berhaupt war. Ihr lasst sie euch vom Team der Zukunft beschreiben. Was hat das Team gesehen, geh&ouml;rt und erlebt? <br></br> \
Gib dem Team ein wenig Zeit, um ihre Fantasie spielen zu lassen. Rate ihnen, sich ein paar Stichworte aufzuschreiben. Anschlie&szlig;end beschreiben alle nacheinander ihre Erinnerung / Vision an die perfekte Iteration.<br></br> \
Stellt euch gemeinsam die Frage, welche Ver&auml;nderungen das Team der Zukunft umgesetzt hat, die zu einer solch produktiven und perfekten Iteration gef&uuml;hrt haben. Schreibe die Antworten auf Karteikarten, um sie in der n&auml;chsten Phase zu nutzen.",
source:    source_innovationGames + ", gefunden in <a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
suitable: "iteration, release, project"
};
all_activities[37] = {
phase:     3,
name:      "Abstimmung mit Klebepunkten - anfangen, aufh&ouml;ren, weitermachen",
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
all_activities[38] = {
phase:     3,
name:      "Abstimmung mit Klebepunkten - Beibehalten, Ver&auml;ndern",
summary:   "Macht ein Brainstorming dazu, was gut funktioniert hat und was ver&auml;ndert werden soll. Entscheidet, welche Ver&auml;nderungen ihr umsetzen wollt.",
desc:      "&Uuml;berschreibe zwei Flipcharts jeweils mit &quot;Beibehalten&quot; und &quot;Ver&auml;ndern&quot;. Bitte die Teilnehmer konkrete Vorschl&auml;ge f&uuml;r beide Kategorien zu notieren, immer nur einer pro Karteikarte. <br> \
Lass sie ein paar Minuten allein dar&uuml;ber nachdenken. Anschlie&szlig;end liest jeder seine Vorschl&auml;ge vor und h&auml;ngt sie in die passende Kategorie.<br></br> \
F&uuml;hrt eine kurze Diskussion dar&uuml;ber, welche Vorschl&auml;ge die gr&ouml;&szlig;te Chance haben, umgesetzt zu werden oder von welchen der gr&ouml;&szlig;te Mehrwert ausgeht. Stimmt dar&uuml;ber ab, welche Vorschl&auml;ge ihr umsetzt, in dem jeder Teilnehmer eine feste Anzahl Klebepunkte (z.B. 2 oder 3) auf die Karteikarten verteilt. <br> </br> \
Die 2 oder 3 Vorschl&auml;ge mit den meisten Punkten setzt ihr um.",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[39] = {
phase:     4,
name:      "Plus & Delta",
summary:   "Lasst die Teilnehmer jeweils eine Sache aufschreiben, die ihnen an der Retrospektive gefallen hat, und eine, die sie &auml;ndern wollen",
desc:       "Bereite ein Flipchart vor mit zwei Spalten mit den Titeln 'Plus' and 'Delta'. \
Bitte die Teilnehmer, je einen Aspekt der Retrospektive aufzuschreiben, der ihnen gefallen hat \
und einen Aspekt, den sie &auml;ndern m&ouml;chten (auf unterschiedlichen Karten). Sammle die Karten auf dem Flipchart. \
Spreche die Karten einzeln durch, damit alle genau wissen, was jeweils gemeint ist. Bei Themen, f&uuml;r die sowohl \
'Plus' als auch 'Delta' Karten geschrieben wurden, kannst Du so auch feststellen, wohin die Mehrheit tendiert.",
source:    "<a href='http://agileretrospectivewiki.org/index.php?title=Weekly_Retrospective_Simple_%2B_delta'>Rob Bowley</a>",
durationDetail:  "5-10",
duration:    "Medium",
stage:    "All",
suitable: "release, project"
};
all_activities[40] = {
phase:     2,
name:      "Parkbank",
summary:   "Gruppendiskussion mit wechselnden Teilnehmern",
desc:      "Stelle mindestens 4 und h&ouml;chstens 6 St&uuml;hle vor der Gruppe auf (die 'Parkbank'). \
Erkl&auml;re die Regeln: \
        <ul>\
    <li>Setze Dich auf einen der freien St&uuml;hle, wenn Du Dich an der Diskussion beteiligen m&ouml;chtest.</li>\
    <li>Ein Platz auf der Bank muss immer frei sein.</li>\
    <li>Wenn der letzte freie Platz auf der Bank besetzt wurde, muss ein anderer von der Bank wieder ins Publikum zur&uuml;ckkehren.</li>\
</ul>\
Starte die Diskussion indem Du Dich auf die Bank setzt und spreche einen Punkt an, \
der in einer fr&uuml;heren Phase diskutiert wurde, bis jemand sich zu Dir setzt und die \
Diskussion weiterf&uuml;hrt. Beende das Ganze, wenn die Diskussion einschl&auml;ft. \
<br>Das ist eine Variante von 'Fish Bowl', die gut mit Gruppen von 10 bis 25 Leuten funktioniert.",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/08/24/park-bench/'>Diana Larsen</a>",
durationDetail:  "15-30",
duration:    "Medium",
stage:    "All",
suitable: "release, project, largeGroups"
};
all_activities[41] = {
phase:     0,
name:      "Postkarten",
summary:   "Teilnehmer w&auml;hlen Postkarten aus, die ihren Gedanken bzw. Gef&uuml;hle entsprechen",
desc:      "Bringe viele unterschiedliche Postkarten mit, mindestens viermal so viele wie \
Teilnehmer da sind. Verteile die Postkarten im Raum und sage den Teilnehmern, sie sollen \
die Postkarte ausw&auml;hlen, die am besten darstellt, was sie &uuml;ber die letzte Iteration denken. \
Bitte sie, dann drei Stichworte auf Karten zu schreiben, die die Postkarte bzw. die letzte \
Iteration beschreiben. Nacheinander h&auml;ngen die Teilnehmer ihre Postkarten und die Karten mit \
den Stichworten auf und erkl&auml;ren den anderen Teilnehmern ihre Wahl.",
source:    "<a href='http://finding-marbles.com/2012/03/19/retrospective-with-postcards/'>Corinna Baldauf</a>",
durationDetail:  "15-20",
duration:    "Medium",
stage:    "All",
suitable: "iteration, release, project",
};
all_activities[42] = {
phase:     0,
name:      "Steh zu deiner Meinung - Beginn",
summary:   "Teilnehmer zeigen ihre Zufriedenheit mit der letzten Iteration, indem sie sich \
an einer Skala aufstellen",
desc:      "Klebe aus Malerkrepp eine Skala auf den Boden (eine lange Linie). Markiere das \
eine Ende mit 'Großartig' und das andere mit 'Mies'. Bitte die Teilnehmer sich an die Stelle \
der Skale zu stellen, die ihrer Zufriedenheit mit der letzten Iteration entspricht. Sich im \
Raum zu Positionieren ist im Vergleich zu dem, was Teilnehmer 'nur' sagen, oft ein st&auml;rkeres 'Bekenntnis'.<br> \
Du kannst die Skala wiederverwenden, wenn Du mit mit Aktivit&auml;t #44 abschließt.",
source:    source_findingMarbles + ", inspiriert von <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
durationDetail:  "2-5",
duration:    "Short",
stage:    "All",
suitable: "iteration, release, project"
};
all_activities[43] = {
phase:     4,
name:      "Steh zu deiner Meinung - Abschluss",
summary:   "Teilnehmer zeigen ihre Zufriedenheit mit der Retrospektive, indem sie sich \
an einer Skala aufstellen",
desc:      "Klebe aus Malerkrepp eine Skala auf den Boden (eine lange Linie). Markiere das \
eine Ende mit 'Großartig' und das andere mit 'Mies'. Bitte die Teilnehmer sich an die Stelle \
der Skale zu stellen, die ihrer Zufriedenheit mit der Retrospektive entspricht. Sich im \
Raum zu Positionieren ist im Vergleich zu dem, was Teilnehmer 'nur' sagen, oft ein st&auml;rkeres 'Bekenntnis'.<br> \
Mit Aktivit&auml;t #43 kannst Du die Retrospektive mit derselben Skala auch er&ouml;ffnen.",
source:    source_findingMarbles + ", inspiriert von <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
durationDetail:  "2-5",
duration:    "Short",
stage:    "All",
suitable: "iteration, release, project"
};
all_activities[44] = {
phase:     4,
name:      "Gut & &uuml;berraschend",
summary:   "Was fanden die Teilnehmenden gut und was hat sie &uuml;berrascht in der Retrospektive",
desc:      "Lass jeden Teilnehmer in einer schnellen Runde eine Sache beschreiben, die sie bezogen auf die \
Retrospektive gut fanden oder die sie &uuml;berrascht hat (oder beides).",
source:    source_unknown,
durationDetail:  "5",
duration:    "Short",
stage:    "All",
suitable: "iteration, release, project"
};
all_activities[45] = {
phase:     0,
name:      "Warum Retrospektiven?",
summary:   "Frage 'Warum machen wir Retrospektiven?'",
desc:      "Gehe nochmal zur&uuml;ck zu den Grundlagen und beginne die Retrospektive mit der Frage: 'Warum machen \
wir das eigentlich?' Schreibe die Antworten f&uuml;r alle sichtbar auf. Das Ergebnis kann sehr &uuml;berraschend sein.",
source:    "<a href='http://proessler.wordpress.com/2012/07/20/check-in-activity-agile-retrospectives/'>Pete Roessler</a>",
durationDetail:  "5",
duration:    "Short",
stage:    "Forming, Performing, Stagnating",
suitable: "iteration, release, project"
};
all_activities[46] = {
phase:     1,
name:      "Briefkasten leeren",
summary:   "Seht Euch die Notizen an, die ihr w&auml;hrend der Iteration gesammelt habt",
desc:      "Stelle zu Beginn der Iteration einen 'Retrospektive-Briefkasten' an einer gut sichtbaren Stelle auf. Jedem, dem \
etwas wesentliches auff&auml;llt oder der eine Idee zur Verbesserung hat, schreibt es auf einen Zettel und wirft es \
in den Briefkasten. (Alternativ kann der Briefkasten auch ein Platz sein, an dem die Notizen f&uuml;r alle sichtbar \
befestigt werden, was schon w&auml;hrend der Iteration Gespr&auml;che ausl&ouml;sen kann.) <br>\
Nehme jede einzelne Notiz aus dem Briefkasten und diskutiere sie mit dem Team.<br>\
Der Briefkasten ist eine gute Sache bei langen Iterationen und vergesslichen Teams.",
source:    source_skycoach,
more:      "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Original article</a>",
durationDetail:  "15",
duration:    "Medium",
stage:    "All",
suitable: "release, project"
};
all_activities[47] = {
phase:     3,
name:      "Stellung beziehen - Line Dance",
summary:   "Bekomme ein Gef&uuml;hl f&uuml;r die Meinungen im Team und stelle einen Konsens her",
desc:      "Wenn ein Team sich zwischen zwei Optionen nicht entscheiden kann, klebe aus Malerkrepp eine Skala \
auf den Boden (also eine lange Linie). Markiere die eine Seite mit 'Option A' und die andere Seite mit 'Option B'. Die Teilnehmer stellen sich entsprechend ihrer Pr&auml;ferenzen f&uuml;r eine der beiden Optionen an der Linie auf. Diskutiere und modifiziere jetzt die Optionen, bis eine Option eine Mehrheit hat.",
source:    source_skycoach,
more:      "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Original article</a>",
durationDetail:  "5-10 per decision",
duration:    "Short",
stage:    "Storming, Norming",
suitable: "iteration, release, project"
};
all_activities[48] = {
phase:     3,
name:      "Dot Voting - Seestern",
summary:   "Schreibt auf, was begonnen, beendet, weitergef&uuml;hrt, h&auml;ufiger oder weniger h&auml;ufig gemacht werden soll",
desc:      "Male f&uuml;nf Speichen auf ein Flipchart, so dass Du f&uuml;nf Segmente hast. Beschrifte sie mit 'Start', 'Stop', 'Weiter', \
'H&auml;ufiger' and 'Seltener'. Die Teilnehmer schreiben ihre Vorschl&auml;ge auf Haftnotizen und kleben sie in das entsprechende \
Segment. Nachdem ihr die Notizen, die die gleiche Idee enthalten, zusammengefasst habt, lass das Team mit Punkten &uuml;ber die \
Vorschl&auml;ge abstimmen, die ihr ausprobiert wollt.",
source:    "<a href='http://www.thekua.com/rant/2006/03/the-retrospective-starfish/'>Pat Kua</a>",
durationDetail:  "15 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, release, project"
};
all_activities[49] = {
phase:     2,
name:      "W&uuml;nsch Dir was",
summary:   "Eine gute Fee will Dir einen Wunsch erf&uuml;llen - woran merkst Du, das er sich erf&uuml;llt hat?",
desc:      "Lass die Teilnehmer zwei Minuten &uuml;ber folgende Frage nachdenken: \
'Eine Fee gew&auml;hrt Dir einen Wunsch, der Dein gr&ouml;ßtes Problem in Deinem Job &uuml;ber Nacht beheben wird. Was w&uuml;nschst Du Dir?' \
Und weiter: 'Du kommst am n&auml;chsten Morgen zur Arbeit. Du sp&uuml;rst, dass die Fee Deinen Wunsch erf&uuml;llt hat. Woran merkst Du das? Was ist jetzt anders?' \
Wenn das gegenseitige Vertrauen in der Gruppe hoch ist, dann lasse jeden Teilnehmer seinen 'Wunsch-Arbeitsplatz' beschreiben. \
Wenn nicht, bitte die Teilnehmer, ihr Szenario im Kopf zu behalten und in der n&auml;chsten Phase Dinge vorzuschlagen, mit denen das \
Team dem Wunsch-Arbeitsplatz n&auml;her kommt.",
source:    "Lydia Grawunder &amp; Sebastian Nachtigall",
durationDetail:  "15 min",
duration:    "Medium",
stage:    "Storming, Norming",
suitable:  "iteration"
};
all_activities[50] = {
phase:     1,
name:      "Lean Coffee",
summary:   "Nutze das Lean Coffee-Format f&uuml;r eine fokussierte Diskussion der wichtigsten Themen",
desc:      "Sage dem Team, wieviel Zeit ihr f&uuml;r diese Phase verwenden wollt, erkl&auml;re dann die Regeln des Lean Coffee f&uuml;r Retrospektiven: \
        <ul> \
    <li>Die Teilnehmer schreiben die Themen, die sie besprechen m&ouml;chten, auf Haftnotizen - ein Thema pro Notiz</li>\
    <li>Klebe die Notizen auf ein Whiteboard oder ein Flipchart. Lasse jede Notiz von denen, die sie geschrieben haben, kurz in 1 oder 2 S&auml;tzen erkl&auml;ren</li>\
    <li>Wenn es mehrere Notizen zum selben Thema gibt, h&auml;nge sie zusammen</li>\
    <li>Lasse die Teilnehmer jetzt mit jeweils zwei Punkten abstimmen, &uuml;ber welche beiden Themen sie diskutieren m&ouml;chten</li>\
    <li>Sortiere die Themen nach Anzahl der Stimmen</li>\
    <li>Beginne mit dem Thema, das die meisten Stimmen bekommen hat. Stelle den Timer auf 5 Minuten ein. Wenn der Timer piept, lass schnell per Daumen hoch/Daumen runter abstimmen: Mehrheit f&uuml;r Daumen hoch - das Thema wird weitere 5 Minuten diskutiert. Mehrheit f&uuml;r Daumen runter - N&auml;chstes Thema auf der Liste</li>\
</ul> \
Beende die Diskussion, wenn die anfangs angesetzte Zeit vorbei ist.",
source:    "<a href='http://leancoffee.org/'>Original-Beschreibung</a> und <a href='http://finding-marbles.com/2013/01/12/lean-altbier-aka-lean-coffee/'>Erfahrungsbericht</a>",
durationDetail:  "20-40 min",
duration:    "Flexible",
stage:    "All",
suitable:  "iteration"
};
all_activities[51] = {
phase:     0,
name:      "Konstellationen - Eröffnung",
summary:   "Lasse die Teilnehmer Aussagen bestätigen oder ablehnen, indem Sie sich im Raum bewegen",
desc:      "Lege eine Scheibe oder eine Kugel in die Mitte eines freien Raumes und versammle das Team darum. \
Die Scheibe ist der Punkt der höchsten Zustimmung: Wenn sie einer Aussage zustimmen, sollten sie sich \
darauf zu bewegen, wenn sie es nicht tun, sollten sie sich - dem Ausmaß ihrer Ablehnung entsprechend - \
davon entfernen. Formuliere jetzt Aussagen, z.B. \
<ul>\
<li> Ich glaube, ich kann in dieser Retrospektive offen sprechen </li>\
<li> Ich bin mit der letzten Iteration zufrieden </li>\
<li> Die Qualität unseres Codes finde ich gut</li>\
<li> Unser kontinuierlicher Integrationsprozess ist ausgereift </li>\
</ul>\
Beobachte nun, welche Konstellationen sich ergeben. Frage das Team, welche Konstellationen sie am meisten überrascht hat. \
<br><br>\
Kann auch als Abschluss verwendet werden (#53).",
source:    "<a href='http://www.coachingagileteams.com/'>Lyssa Adkins</a> via <a href='https://luis-goncalves.com/agile-retrospective-set-the-stage/'>Luis Goncalves</a>",
durationDetail:  "10 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[52] = {
phase:     4,
name:      "Konstellationen - Abschluss",
summary:   "Lasse die Teilnehmer Aussagen bestätigen oder ablehnen, indem Sie sich im Raum bewegen",
desc:      "Lege eine Scheibe oder eine Kugel in die Mitte eines freien Raumes und versammle das Team darum. \
Die Scheibe ist der Punkt der höchsten Zustimmung: Wenn sie einer Aussage zustimmen, sollten sie sich darauf \
zu bewegen, wenn sie es nicht tun, sollten sie sich - dem Ausmaß ihrer Ablehnung entsprechend - davon entfernen. \
Formuliere jetzt Aussagen, z.B. \
<ul>\
<li>Wir haben über die wichtigsten Dinge gesprochen</li>\
<li> Ich habe heute offen gesprochen</li>\
<li> Die Zeit für die Retrospektive war gut investiert </li>\
<li> Ich bin zuversichtlich, dass wir die besprochenen Maßnahmen umsetzen werden </li>\
</ul>\
Beobachte nun, welche Konstellationen sich ergeben. Welche Konstellation überrascht dich?\
<br><br>\
Kann auch als Beginn verwendet werden (#52).",
source:    "<a href='http://www.coachingagileteams.com/'>Lyssa Adkins</a> via <a href='https://luis-goncalves.com/agile-retrospective-set-the-stage/'>Luis Goncalves</a>, <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
durationDetail:  "5 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[53] = {
phase:     1,
name:      "Oscar für Stories ",
summary:   "Das Team nominiert Stories für Kategorien und diskutiert die Gewinner ",
desc:      "Zeige alle in der letzten Iteration abgeschlossenen Stories auf dem Board.\
Schaffe drei Kategorien (d.h. Felder auf der Tafel): \
<ul>\
<li> Beste Story </li>\
<li> Die nervigste Story </li>\
<li> ... eine dritte Kategorie, die das Team definiert ... </li>\
</ul>\
Bitten Sie das Team, nun Stories in den drei Kategorien zu 'nominieren', indem sie sie \
in eine der drei Felder setzen. Lasse jetzt in jeder Kategorie per Klebepunkte abstimmen und verkünde die Gewinner. \
<br><br>\
Frage das Team, warum aus ihrer Sicht die Story in der jeweiligen Kategorie gewonnen hat \
und lasse das Team über die Arbeit bis zum Abschluss der Story diskutieren  - was lief gut \
und was lief schlecht.",
source:    "<a href='http://www.touch-code-magazine.com'>Marin Todorov</a>",
durationDetail:  "30-40 min",
duration:    "Short",
stage:    "Forming, Storming, Norming",
suitable:  "project, release",
};
all_activities[54] = {
phase:     2,
name:      "Die originalen Vier",
summary:   "Frage die vier Kernfragen von Norman Kerth",
desc:      "Für Norman Kerth, Erfinder der Retrospektiven, sind das die vier Kernfragen: \
<ul>\
    <li>Was müssen wir uns merken, was gut lief, damit wir es nicht vergessen?</li>\
    <li>Was haben wir gelernt?</li>\
    <li>Was sollten wir beim nächsten Mal anders machen?</li>\
    <li>Was überrascht uns immer noch? </li>\
</ul>\
Welche Antworten hat das Team?",
source:    "<a href='http://www.retrospectives.com/pages/RetrospectiveKeyQuestions.html'>Norman Kerth</a>",
durationDetail:  "15 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[55] = {
phase:     5,
name:      "Lade den Kunden ein",
summary:   "Stelle direkten Kontakt zwischen Team und Stakeholder her",
desc:      "Lade einen Kunden oder internen Stakeholder zur Retrospektive ein.\
Lasse das Team wirklich ALLE Fragen an den Gast stellen:\
<ul>\
    <li>Wie benutzt der Kunde das Produkt?</li>\
    <li>Was regt ihn am meisten auf? </li>\
    <li>Welche Funktion macht ihm das Leben leichter? </li>\
    <li>Lasse den Kunden auch seine typischen Arbeitsabläufe darstellen.</li>\
    <li>...</li>\
</ul>",
source:    "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Nick Oostvogels</a>",
durationDetail:  "45 min",
duration:    "Long",
stage:    "Forming, Norming, Performing, Stagnating",
suitable:  "iteration, project"
};
all_activities[56] = {
phase:     4,
name:      "Sag‘s mit Blumen",
summary:   "Jedes Teammitglied bedankt sich bei einem anderen Teammitglied mit einer Blume",
desc:      "Kaufe eine Blume für jedes Teammitglied und hole sie am Ende der Retrospektive hervor.\
Jedes Teammitglied überreicht einem anderen Teammitglied eine Blume als Zeichen der Wertschätzung.",
source:    "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Nick Oostvogels</a>",
durationDetail:  "5 min",
duration:    "Short",
stage:    "Norming, Performing",
suitable:  "iteration, project"
};
all_activities[57] = {
phase:     2,
name:      "Verdeckter Boss",
summary:   "Wenn Eure Chefin die letzte Iteration mit Euch erlebt hätte, was würde sie ändern wollen?",
desc:      "'Stellt Euch vor, Eure Chefin hätte  - unerkannt - in der letzten Iteration mit Euch gearbeitet. \
Was würde sie über Eure Zusammenarbeit und die Ergebnisse denken? Was würde sie Euch bitten zu ändern?' \
Das Team wird so ermutigt, sich aus einem anderen Blickwinkel zu betrachten.",
source:    "<a href='http://loveagile.com/retrospectives/undercover-boss'>Love Agile</a>",
durationDetail:  "10-15 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[58] = {
phase:     0,
name:      "Happiness Histogram",
summary:   "Erstelle ein Happiness Histogramm, um die Leute zum reden zu bringen",
desc:      "Bereite ein Flip-Chart mit einer horizontalen Skala von 1 (Unglücklich) bis 5 (Happy) vor. \
<ul>\
    <li>Die Teammitglieder platzieren der Reihe nach eine Haftnotiz entsprechend ihrer 'Happiness' über der Skala und kommentieren ihre Platzierung</li>\
    <li>Wenn in der Begründung etwa bemerkenswertes erwähnt wird, lass das Team entscheiden, ob es sofort oder zu einem späteren Zeitpunkt in der Retrospektive diskutiert werden soll</li>\
    <li>Wenn jemand den gleichen 'Happiness'-Wert wie ein Vorgänger hat, klebt die Haftnotiz über die schon platzierten Haftnotizen, so das ein Histogramm (Häufigkeitsverteilung) entsteht </li>\
</ul>",
source:    "<a href='http://nomad8.com/chart-your-happiness/'>Mike Lowery</a> via <a href='https://twitter.com/nfelger'>Niko Felger</a>",
durationDetail:  "2 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[59] = {
phase:     4,
name:      "AHA!",
summary:   "Lasse einen Ball werfen und entdecke neu Gelerntes",
desc:      "Lasse einen Ball (z.B. einen <a href='https://de.wikipedia.org/wiki/Koosh_Ball'>Koosh Ball</a>) \
im Team hin- und herwerfen und decke so positive Wahrnehmungen und Lernerfahrungen auf. Gebe zu Beginn eine \
Frage vor, die man beantwortet, wenn man den Ball fängt, zum Beispiel: \
<ul>\
    <li>Was habe ich in der letzten Iteration gelernt?</li>\
    <li>Welche nette Sache hat jemand aus dem Team für mich getan?</li>\
</ul>\
Je nach Frage könnten auch Dinge zur Sprache kommen, die die Leute stören oder ärgern. Wenn \
also irgendwelche Alarmglocken klingeln, frage nach und gehe darauf ein. Mit der 'eine nette \
Sache'-Frage findest du in der Regel einen positiven Abschluss.",
source:    "<a href='http://scrumfoundation.com/about/catherine-louis'>Catherine Louis</a> and <a href='http://blog.haaslab.net/'>Stefan Haas</a> via <a href='https://www.linkedin.com/in/misshaley'>Amber Haley</a>",
durationDetail:  "5-10 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project",
};
all_activities[60] = {
phase:     3,
name:      "Chaos Cocktail Party",
summary:   "Identifiziere, diskutiere, konkretisiere und priorisiere Aktivitäten",
desc:      "Alle schreiben eine Karteikarte mit einer Aktivität, die sie für wichtig halten \
umso spezifischer ((<a href='https://de.wikipedia.org/wiki/SMART_(Projektmanagement)'>SMART</a>) \
umso besser. \
<br><br> \
Dann beginnt die Cocktailparty: Die Teammitglieder sprechen paarweise über die Karten. Jedes \
Paar spricht nur über die beiden Aktivitäten auf ihren Karten. Beende die Diskussionen nach \
iner Minute. Jedes Paar teilt nun fünf Klebepunkte auf die beiden Karten auf - umso wichtiger \
die Aktivität, umso mehr Punkte. Nun kommen neue Paare zusammen und diskutieren ihre beiden \
Karten. Wiederhole dies, bis jeder alle Karten diskutieren konnte. Am Ende addiert jeder die \
Punkte auf seiner Karte. Die Karten werden dann nach Anzahl der Punkte absteigend sortiert. \
Das Team entscheidet, von der Aktivität mit der größten Punktzahl herunter, welche Aktivitäten \
in der nächsten Iteration angegangen werden sollen. \
<br><br> \
Addendum: Du kannst überlegen, ob Du die Karten am Anfang und zwischen den einzelnen \
Diskussionen zufällig im Team austauschen lässt. Auf diese Weise hat keiner bei der \
Punkteverteilung einen Anreiz, 'seiner' Aktivität mehr Punkte zu sichern. \
Diese Idee stammt von  \
<a href='http://www.thiagi.com/archived-games/2015/2/22/thirty-five-for-debriefing'>Dr. Sivasailam 'Thiagi' Thiagarajan</a> via \
<a href='https://twitter.com/ptevis'>Paul Tevis</a>",
source:    "Suzanne Garcia via <a href='http://www.wibas.com'>Malte Foegen</a>",
durationDetail:  "10-15 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release, largeGroup"
};
all_activities[61] = {
phase:     1,
name:      "Erwartungen",
summary:   "Was können andere von Dir erwarten?  Was kannst Du von den anderen erwarten?",
desc:      "Gib jedem Teammitglied ein Stück Papier. Die untere Hälfte ist leer. Die obere Hälfte ist in zwei \
Abschnitte unterteilt:\
<ul>\
    <li>Was meine Teamkollegen von mir erwarten können</li>\
    <li>Was ich von meinen Teamkollegen erwarte</li>\
</ul>\
Jeder füllt die obere Hälfte für sich selbst aus. Wenn alle fertig sind, geben alle die Seite an den Nachbarn zur \
linken weiter und lesen die Seite, die sie bekommen haben. Nun schreiben alle in der unteren Hälfte auf, was sie \
persönlich von der jeweiligen Person erwarten, unterschreiben und geben es an den Nachbarn weiter. Wenn die Papiere \
eine Runde gemacht haben, schauen sich alle die Erwartungen an, die die Teammitglieder an sie haben, und diskutieren \
ihre Beobachtungen.",
source:    "<a href='http://agileyammering.com/2013/01/25/expectations/'>Valerie Santillo</a>",
durationDetail:  "10-15 min",
duration:    "Medium",
stage:    "Forming, Storming, Norming",
suitable:  "iteration, project, release, start"
};
all_activities[62] = {
phase:     3,
name:      "Niedrig h&auml;ngende Fr&uuml;chte",
summary:   "Veranschauliche, was mögliche Aktionen bringen und wie schwer sie zu erreichen sind, um die Auswahl zu unterstützen",
desc:      "Zeige einen zuvor gezeichneten Baum. Verteile runde Karten und bitte die Teilnehmer \
die Aktionen aufzuschreiben, die Sie gerne angehen würden - eine Aktion pro Karte. Wenn \
alle fertig sind, sammle die Karten ein, mische sie und lese sie eine nach der anderen vor. Hänge \
nun die „Frucht“ an den Baum, und zwar entsprechend der folgenden Einschätzungen der Teilnehmer: \
<ul>\
    <li>Ist es einfach? Platziere die Karte niedriger. Ist es schwer? Dann höher auf den Baum.</li>\
    <li>Scheint es sehr vorteilhaft? Platziere die Karte auf der linken Seite des Baums. Aktion bringt eher weniger? Eher rechts.</li>\
</ul>\
Jetzt sind die Früchte links unten am Baum die erste Wahl als nächste Aktion. Wenn dies nicht Konsens ist, diskutiere kurz über \
mögliche Aktionen oder lasse mit Klebepunkten abstimmen.",
source:    "<a href='http://tobias.is'>Tobias Baldauf</a>",
durationDetail:  "10-15 min",
duration:    "Medium",
stage:    "Forming, Storming",
suitable:  "iteration, project, release"
};

all_activities[63] = {
phase:     1,
name:      "Vierteln - Langweilige Stories finden",
summary:   "Kategorisiere Stories in zwei Dimensionen, um die langweiligen zu identifizieren",
desc:      "Zeichne ein großes Quadrat und teile es in 2 Spalten. Beschrifte sie mit \
'Interessant' und 'Langweilig'. Lasse das Team alles auf Haftnotizen aufschreiben, was sie in \
der letzte Iteration gemacht haben, zusammen mit einer groben Schätzung, wie lange sie daran \
gearbeitet haben, und klebt es in die passende Spalte. \
<br><br> \
Füge jetzt eine waagerechte Linie hinzu, so dass vier Quadranten entstehen. Beschrifte die \
oberen Quadranten mit 'Schlank' (brauchte einige Stunden) und die untere Reihe 'Aufwändig' \
(brauchte Tage). Sortiere die Notizen nun in in den beiden Spalten um. Jetzt hast Du alle \
aufwändigen und langweiligen Stories zusammen, um sie in den folgenden Phasen anzugehen. \
<br><br> \
(Es verbessert den Fokus, wenn Bewertungen in mehrere Schritte durchgeführt werden. Du kannst \
<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>Vierteln auch für viele andere zwei-dimensionale Kategorisierungen anpassen</a>.)",
source:    "<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>Wayne D. Grant</a>",
durationDetail:  "10",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project",
};
all_activities[64] = {
phase:     1,
name:      "Wertschätzendes Nachfragen",
summary:   "Verbessere die Stimmung im Team durch positive Fragen",
desc:      "Gebe dem Team in mehreren Runden jeweils eine Frage, die Teilnehmer notieren ihre Antworten \
(gebe ihnen ausreichend Zeit zum Nachdenken) und lese sie dann den anderen vor. \
<br><br> \
Folgende Fragen k&ouml;nntest Du Softwareentwicklungs-Teams stellen: \
<ol>\
    <li>Wann warst Du das letzte Mal wirklich engagiert / motiviert / produktiv? Was hast Du gemacht? Was war passiert? Wie fühlte es sich an?</li>\
    <li>Aus einer Applikations- / Code-Perspektive: Was war der „heisseste Scheiss“, den Du zusammengebaut hast? Warum ist es so gut?</li>\
    <li>Was von den Dingen, die du für diese Firma gemacht hast, hat den höchsten Wert? Warum?</li>\
    <li>Wann hast Du am besten mit dem <Product Owner> zusammengearbeitet? Was war gut daran?</li>\
    <li>Wann war Deine Einbindung und die Zusammenarbeit mit dem Team am besten?</li>\
    <li>Was war Dein wichtigster Beitrag zur Entwickler-Community (dieser Firma)? Wie hast Du das gemacht?</li>\
    <li>Lasst Eure Bescheidenheit jetzt mal außen vor: Was ist Deine wertvollste Fachkenntnis / Charaktereigenschaften, die Du zum Team beiträgst? Beispiele?</li>\
    <li>Was ist das wichtigste Merkmal Deines Teams? Was zeichnet Dich dabei aus?</li>\
</ol>\
<br>\
('Zurück in die Zukunft' (# 37) funktioniert gut als nächster Schritt.)",
source:    "<a href='http://blog.8thlight.com/doug-bradbury/2011/09/19/apreciative_inquiry_retrospectives.html'>Doug Bradbury</a>, adapted for SW development by " + source_findingMarbles,
durationDetail:  "20-25 min groupsize",
duration:    "Medium",
stage:    "Storming",
suitable:  "iteration, project"
};
all_activities[65] = {
phase:     2,
name:      "Brainstorming in Schriftform",
summary:   "Durch schriftliches Brainstorming können Introvertierte mehr beitragen ",
desc:      "Stelle eine zentrale Frage, z.B. "Mit welchen Maßnahmen können wir uns in der nächsten Iteration \
verbessern?". Verteile Papier und Stifte. Jeder schreibt seine Ideen auf. Nach drei Minuten gibt jeder seine \
Seite an den Nachbarn weiter und schreibt weiter auf der, die er bekommen hat. Wenn Dir die eigenen Ideen \
ausgehen, lese die Ideen, die sich bereits auf dem Papier befinden und ergänze sie. Und es gibt Regeln: Keine \
negativen Kommentare, jeder schreibt seine Ideen nur einmal auf. (Wenn mehrere Leute die gleiche Idee notieren, \
ist das in Ordnung.)  Lasse die Seite alle drei Minuten weitergeben, bis jeder alle Seiten einmal gesehen hat. \
Wenn alle dann wieder die Seite haben, mit der sie begonnen haben, lasse sie die Top 3-Ideen auswählen. Sammle \
nun alle Top 3's auf einem Flipchart für die nächste Phase.",
source:    "Prof. Bernd Rohrbach",
durationDetail:  "20 min groupsize",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release, introverts"
};
all_activities[66] = {
phase:     4,
name:      "Was ich mitnehme",
summary:   "Sammeln, was die Teilnehmer während der Retro gelernt haben",
desc:      "Lasse alle auf eine Haftnotiz die bemerkenswerteste Sache schreiben, die sie während der Retro \
gelernt haben. Klebe die Notizen an die Tür. Lasse die Teilnehmer reihum ihre Notizen vorlesen.",
source:     source_judith,
durationDetail:  "5 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
// Values for duration: "<minMinutes>-<maxMinutes> perPerson"
// Values for suitable: "iteration, realease, project, introverts, max10People, rootCause, smoothSailing, immature, largeGroup"