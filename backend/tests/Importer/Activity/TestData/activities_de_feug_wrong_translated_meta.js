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