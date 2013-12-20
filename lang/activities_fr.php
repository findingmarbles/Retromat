var phase_titles = ['Ouvrir la rétrospective', 'Recueillir des données', 'Générer des idées', 'Décider des actions', 'Fermer la rétrospective', 'Quelque chose complètement différent'];

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
name:      "ECVP",
summary:   "Comment se sentent les participants de la rétro : Explorateur, Client, Vacancier, ou Prisonnier ?",
desc:      "Préparez un paper-board avec des zones pour E, C, V, et P. Expliquez les concepts : <br>\
<ul>\
    <li>Explorateur : Désireux de se lancer, de rechercher ce qui a et n'a pas fonctionné et comment améliorer.</li>\
    <li>Client : Attitude positive. Content si de bonnes choses en ressortent.</li>\
    <li>Vacancier : Hésitant à participer activement mais la rétro vaut mieux que le travail habituel.</li>\
    <li>Prisonnier : Participe seulement car il (sent qu'il) le doit.</li>\
</ul>\
Faites un sondage (anonyme sur des bouts de papier). Comptez les réponses et assurez le suivi sur le tableau \
pour que tous voient. Si la confiance est faible, détruisez délibérément les votes pour assurer la confidentialité. \
Demandez ce que les participants pensent des résultats. Si il ya une majorité de Vacanciers ou Prisonniers \
envisagez d'utiliser la rétro pour discuter de cette constatation.",
duration:  "5-10 numberPeople",
source:  source_agileRetrospectives,
suitable:   "iteration, release, project, immature"
};
all_activities[1] = {
phase:     0,
name:      "Prévisions météo",
summary:   "Les participants marquent leur 'météo' (humeur) sur un paper-board",
desc:      "Préparez un paper-board avec un dessin d'orage, pluie, nuages ​​et soleil. \
Chaque participant marque son humeur sur le tableau.",
source:  source_agileRetrospectives
};
all_activities[2] = {
phase:     0,
name:      "Check In - Question rapide", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Posez une question à laquelle chacun des participants répond à son tour ?",
desc:      "À tour de rôle chaque participant répond à la même question (sauf si ils disent «je passe»). \
Exemples de questions: <br>\
<ul>\
    <li>En un mot - Qu'attendez-vous de cette rétrospective ?</li>\
    <li>En un mot - Qu'avez vous en tête ?<br>\
        Traitez les préoccupations, par exemple en les écrivants et en les mettant - physiquement et mentalement - de côté</li>\
    <li>Dans cette rétrospective - Si vous étiez une voiture, quel genre serait-elle ?</li>\
    <li>Dans quel état émotionnel êtes-vous ? (par exemple, «heureux», «en colère», «triste», «effrayé»)</li>\
</ul><br>\
Évitez l'évaluation des commentaires, par exemple avec «Très Bien». «Merci» est suffisant.",
source:  source_agileRetrospectives
};
all_activities[3] = {
phase:     1,
name:      "Frise chronologie",
summary:   "Les participants écrivent les événements marquants et les ordonnent chronologiquement",
desc:      "Divisez en groupes de 5 personnes ou moins. Distribuez des cartes et des marqueurs. \
Donnez aux participants 10 minutes pour noter des événements mémorables et / ou personnellement significatifs. \
Il s'agit de recueillir plusieurs points de vue. Un consensus serait préjudiciable. Tous les participants \
affichent leurs cartes et les ordonnent. Il est normal d'ajouter des cartes à la volée. Analysez.<br>\
Des codes couleurs peuvent aider à faire ressortir des modèles, par exemple :<br>\
<ul>\
    <li>Émotions</li>\
    <li>Évènements (techniques, organisation, personnes, ...)</li>\
    <li>Fonctions (testeur, développeur, manager, ...)</li>\
</ul>",
duration:  "60-90 timeframe",
source:  source_agileRetrospectives,
suitable: "iteration, introverts"
};
all_activities[4] = {
phase:     1,
name:      "Analyse des histoires utilisateur",
summary:   "Passez sur chaque histoire utilisateur traitée par l'équipe et cherchez des améliorations possibles",
desc:      "Préparation : Rassemblez toutes les histoires utilisateur traitées lors de l'itération et les amener à \
la rétrospective. <br> \
En groupe (10 personnes max.) lire chaque histoire utilisateur. Pour chacune d'elles se demander si \
elle s'est bien passée ou non. Si tout s'est bien passé, saisir pourquoi. Sinon discuter de ce que vous pourriez \
faire différemment, à l'avenir. <br> \
Variantes : Vous pouvez effectuer cela pour les tickets de support, les bugs ou toute autre tâche \
effectuée par l'équipe.",
source:    source_findingMarbles,
suitable: "iteration, max10people"
};