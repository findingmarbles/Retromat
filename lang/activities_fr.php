var phase_titles = ['Ouvrir la rétrospective', 'Recueillir des données', 'Générer des idées', 'Décider des actions', 'Clore la rétrospective', 'Quelque chose de complètement différent'];

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
	phase: 0,
	name: "ECVP",
	summary: "Comment se sentent les participants de la rétro : Explorateur, Client, Vacancier, ou Prisonnier ?",
	desc: "Préparez un paper-board avec des zones pour E, C, V, et P. Expliquez les concepts : <br>\
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
	duration: "5-10 numberPeople",
	source: source_agileRetrospectives,
photo:    "<a href='static/images/activities/1_ESVP.jpg' rel='lightbox[activity1]' title='Contribuée par Reguel Wermelinger'>Voir la Photo</a>",
	suitable: "iteration, release, project, immature"
};
all_activities[1] = {
	phase: 0,
	name: "Bulletin météo",
	summary: "Les participants marquent leur 'météo' (humeur) sur un paper-board.",
	desc: "Préparez un paper-board avec un dessin d'orage, pluie, nuages ​​et soleil. \
Chaque participant marque son humeur sur le tableau.",
	source: source_agileRetrospectives,
    photo:    "<a href='static/images/activities/2_Weather-Report.jpg' rel='lightbox[activity2]' title='Contribuée par Philipp Flenker'>Voir la Photo</a>",
};
all_activities[2] = {
	phase: 0,
	name: "Lancement - Question rapide", // TODO This can be expanded to at least 10 different variants - how?
	summary: "Posez une question à laquelle chacun des participants répond à son tour.",
	desc: "À tour de rôle chaque participant répond à la même question (sauf s'ils disent «je passe»). \
Exemples de questions: <br>\
<ul>\
    <li>En un mot - Qu'attendez-vous de cette rétrospective ?</li>\
    <li>En un mot - Qu'avez vous en tête ?<br>\
        Traitez les préoccupations, par exemple en les écrivants et en les mettant - physiquement et mentalement - de côté</li>\
    <li>Dans cette rétrospective - Si vous étiez une voiture, quel genre serait-elle ?</li>\
    <li>Dans quel état émotionnel êtes-vous ? (par exemple, «heureux», «en colère», «triste», «effrayé»)</li>\
</ul><br>\
Évitez l'évaluation des commentaires, par exemple avec «Très Bien». «Merci» est suffisant.",
	source: source_agileRetrospectives
};
all_activities[3] = {
	phase: 1,
	name: "Frise chronologie",
	summary: "Les participants écrivent les événements marquants et les ordonnent chronologiquement.",
	desc: "Divisez en groupes de 5 personnes ou moins. Distribuez des cartes et des marqueurs. \
Donnez aux participants 10 minutes pour noter des événements mémorables et / ou personnellement significatifs. \
Il s'agit de recueillir plusieurs points de vue. Un consensus serait préjudiciable. Tous les participants \
affichent leurs cartes et les ordonnent. Il est normal d'ajouter des cartes à la volée. Analysez.<br>\
Des codes couleurs peuvent aider à faire ressortir des modèles, par exemple :<br>\
<ul>\
    <li>Émotions</li>\
    <li>Évènements (techniques, organisation, personnes, ...)</li>\
    <li>Fonctions (testeur, développeur, manager, ...)</li>\
</ul>",
	duration: "60-90 timeframe",
	source: source_agileRetrospectives,
	suitable: "iteration, introverts"
};
all_activities[4] = {
	phase: 1,
	name: "Analyse des histoires utilisateur",
	summary: "Passez sur chaque histoire utilisateur traitée par l'équipe et cherchez des améliorations possibles",
	desc: "Préparation : Rassemblez toutes les histoires utilisateur traitées lors de l'itération et les amener à \
la rétrospective. <br> \
En groupe (10 personnes max.) lire chaque histoire utilisateur. Pour chacune d'elles se demander si \
elle s'est bien passée ou non. Si tout s'est bien passé, saisir pourquoi. Sinon discuter de ce que vous pourriez \
faire différemment, à l'avenir. <br> \
Variantes : Vous pouvez effectuer cela pour les tickets de support, les bugs ou toute autre tâche \
effectuée par l'équipe.",
	source: source_findingMarbles,
	suitable: "iteration, max10people"
};
all_activities[5] = {
	phase: 1,
	name: "Aimer à aimer",
	summary: "Les participants font correspondre des cartes qualité à leurs propres propositions \"Commencer-Arrêter-Continuer\".",
	desc: "Préparation: 20 cartes qualité, càd des fiches cartonnées colorées avec un unique mot \
comme <i>drôle, claire, sérieuse, géniale, dangereuse, désagréable</i>.<br> \
Chaque membre de l'équipe doit écrire au moins 9 cartes : 3 de chaque pour les choses \
à commencer à faire, à continuer et à arrêter. Choisissez une personne qui sera le premier juge. \
Le juge retourne la première carte qualité. Chaque membre sélectionne alors parmi ses cartes \
celle qui correspond le mieux à ce mot et la pose face cachée sur la table. \
Le dernier à se décider doit remettre la carte dans son jeu. Le juge mélange toutes \
les cartes proposées, les retourne une par une et décide laquelle correspond le plus = la gagnante. \
Toutes les cartes sont jetées. La personne ayant proposé la carte gagnante reçoit \
la carte qualité. La personne à la gauche du juge devient alors le nouveau juge.<br> \
Arrêter lorsque tout le monde est à court de cartes (6-9 tours). Celui qui a le plus \
de cartes qualité gagne. Débriefez en demandant quelles sont les principales conclusions. \
<br>(Basé sur le jeu 'Apples to Apples')",
	source: source_agileRetrospectives,
	duration: "30-40",
	suitable: "iteration, introverts"
};
all_activities[6] = {
	phase: 1,
	name: "Mad Sad Glad",
	summary: "Collectez les évènements durant lesquels les membres de l'équipe se sont sentis en colère (mad), triste (sad), ou content (glad) et trouvez les raisons.",
	desc: "Affichez trois affiches intitulées 'en colère' (mad), 'triste' (sad), et 'content' (glad) ou '>:), :(, :)'. \
Les membres de l'equipe écrivent un évènement par carte lorsqu'ils on ressenti ce sentiment, avec un code couleur pour chaque type de sentiment. \
Lorsque le temps est écoulé demandez à chacun de placer ses cartes sur les affiches appropriées. Regroupez les cartes sur \
chaque affiche puis demandez au groupe de nommer chaque regroupement. <br>\
Terminez en demandant :\
<ul>\
    <li>Qu'en ressort-il ? Qu'est-ce qui est inattendu ?</li>\
    <li>Qu'est-ce qui a rendu cette tâche difficile ? Qu'est-ce qui a été amusant ?</li>\
    <li>Reconnaissez vous des motifs / modèles ? Que signifient-ils pour vous en tant qu'équipe ?</li>\
    <li>Des suggestions sur comment continuer ?</li>\
</ul>",
	source: source_agileRetrospectives,
	duration: "15-25",
	photo: "<a href='static/images/activities/7_Mad-Sad-Glad.jpg' rel='lightbox[activity6]' title='Contribuée par Chloe Gachet'>Voir la Photo</a>",
	suitable: "iteration, release, project, introverts"
};
all_activities[7] = {
	phase: 2,
	name: "5 Pourquoi",
	alternativeName: "Analyse de cause racine",
	summary: "Examinez de près la cause racine de problèmes en vous demandant à plusieurs reprises 'Pourquoi ?'",
	desc: "Divisez les participants en petits groupes (<= 4 personnes) et donnez à chaque groupe \
l'un des problèmes le plus identifié précédemment. Instructions pour le groupe :\
<ul>\
    <li>Une personne demande aux autres 'Pourquoi est-ce arrivé ?' à plusieurs reprises pour trouver la cause racine ou une suite d'évènements</li>\
    <li>Notez la cause racine trouvée (souvent la réponse au 5ème 'Pourquoi ?')</li>\
</ul>\
Laissez le groupe partager leurs conclusions.",
	source: source_agileRetrospectives,
	duration: "15-20",
	suitable: "iteration, release, project, root_cause"
};
all_activities[8] = {
	phase: 2,
	name: "Matrice d'apprentissage",
	summary: "Les membres de l'équipe 'brainstorment' sur 4 catégories afin de rapidement lister des problèmes.",
	desc: "Après avoir discuté des données de la Phase 2, affichez un tableau à 4 quadrants intitulés \
':)', ':(', 'Idée !', et 'Appréciation'. Distribuez des post-its. \
<ul>\
    <li>Les membres de l'équipe peuvent contribuer à chaque quadrant. Une idée par post-it.</li>\
    <li>Regroupez les notes.</li>\
    <li>Distribuez 6 à 10 points aux participants pour voter et élire les idées les plus importantes.</li>\
</ul>\
Cette liste sera celle utilisée pour la Phase 4.",
	source: source_agileRetrospectives,
    photo:    "<a href='static/images/activities/9_Learning-Matrix.jpg' rel='lightbox[activity9]' title='Contribuée par Philipp Flenker'>Voir la Photo</a>",
	duration: "20-25",
	suitable: "iteration"
};
all_activities[9] = {
	phase: 2,
	name: "Brainstorming / Filtrage",
	summary: "Générez de nombreuses idées et filtrez les suivant vos critères.",
	desc: "Exposez les règles du brainstorming, et le but : générer un maximum de nouvelles idées \
qui seront filtrées <em>après</em> le brainstorming.\
<ul>\
    <li>Laissez les participants écrire leurs idées pendant 5 à 10 minutes</li>\
    <li>Faites des tours de table en demandant de façon répétée une idée à chacun, jusqu'à ce que toutes les idées soient au tableau</li>\
    <li>Demandez ensuite des filtres (exemple : coût, temps demandé, unicité des concepts, pertinence par rapport à l'activité, ...). \
        Laissez le groupe en choisir 4.</li>\
    <li>Appliquez chaque filtre et marquez les idées qui passent les 4 filtres.</li>\
    <li>Quelles idées le groupe veut-il faire avancer ? Est-ce que quelqu'un se sent particulièrement concerné par une de ces idées ? \
        Autrement prenez une décision à la majorité.</li>\
</ul>\
Les idées sélectionnées rentrent en Phase 4.",
	source: source_agileRetrospectives,
	more: "<a href='http://www.mpdailyfix.com/the-best-brainstorming-nine-ways-to-be-a-great-brainstorm-lead/'>\
    Nine Ways To Be A Great Brainstorm Lead</a>",
	duration: "40-60",
	suitable: "iteration, release, project, introverts"
};
all_activities[10] = {
	phase: 3,
	name: "Le Cercle des Questions",
	summary: "Questions et r&eacute;ponses font le tour du cercle de l'&eacute;quipe - une excellente fa&ccedil;on de parvenir à un consensus.",
	desc: "Tout le monde s'asseoit en cercle. Commencez en annonçant que vous allez faire un tour de questions pour d&eacute;couvrir \
ce que vous voulez faire en tant que groupe. Vous commencez par poser la premi&egrave;re question &agrave; votre voisin, par exemple \
'Quelle est la chose la plus importante que nous devrions d&eacute;marrer lors de la prochaine it&eacute;ration ?' Votre \
voisin r&eacute;pond et pose une question li&eacute;e &agrave; son voisin. Arr&ecirc;tez-vous quand un consensus &eacute;merge ou \
que le temps est &eacute;coul&eacute;. Faites au moins un tour, qu'on puisse entendre tout le monde !",
	source: source_agileRetrospectives,
	duration: "30+ groupsize",
	suitable: "iteration, release, project, introverts"
};
all_activities[11] = {
	phase: 3,
	name: "D&eacute;marrer, Arr&ecirc;ter, Continuer",
	summary: "R&eacute;fl&eacute;chissez ensemble &agrave; ce que vous voulez d&eacute;marrer, arr&ecirc;ter ou continuer et gardez les propositions les mieux not&eacute;es.",
	desc: "Diviser le tableau en 3 colonnes nomm&eacute;es 'D&eacute;marrer', 'Continuer' and 'Arr&ecirc;ter'. \
Demander aux participants d'&eacute;crire des propositions concr&egrave;tes pour chaque cat&eacute;gorie - 1 \
id&eacute;e par carte. Laissez les &eacute;crire en silence pendant quelques minutes. \
Puis chacun lit ses propositions &agrave; voix haute et les place dans la cat&eacute;gorie appropri&eacute;e. \
Mener une courte discussion sur les 20% d'id&eacute;es qui vous semblent les plus b&eacute;n&eacute;fiques. Votez en distribuant des points \
ou des croix &agrave; l'aide d'un marqueur, par exemple 1, 2, et 3 points &agrave; distribuer par personne. \
Les 2 ou 3 meilleures seront vos actions &agrave; mener.\
<br><br>\
(Voir <a href='http://www.funretrospectives.com/open-the-box/'>Paulo Caroli's 'Open the Box'</a> pour une excellente alternative à cette activité)",
	source: source_agileRetrospectives,
	duration: "15-30",
photo:    "<a href='static/images/activities/12_Start-Stop-Continue.JPG' rel='lightbox[activity12]' title='Contribuée par Pedro Ángel Serrano'>Voir la Foto</a>",
	suitable: "iteration"
};
all_activities[12] = {
	phase: 3,
	name: "Objectifs SMART",
	summary: "Formulez un plan d'action spécifique et mesurable.",
	desc: "Présentez les <a href='http://en.wikipedia.org/wiki/SMART_criteria'>objectifs SMART</a> \
(Spécifique, Mesurable, Atteignable, Réaliste, défini dans le Temps) ainsi que des exemples d'objectifs \
plus ou moins SMART, par exemple 'Nous étudierons les stories avant des les accepter en en parlant avec le \
product owner tous les mercredi à 9h.' plutôt que 'Nous prendrons connaissance des stories avant qu'elles \
ne soit ajoutées au backlog du sprint'. <br>\
Créez des groupes par thématiques sur lesquelles l'équipe souhaite continuer à travailler. Chaque groupe identifie de 1 à 5 \
étapes concrètes pour atteindre l'objectif. Chaque groupe présente ses résultats. Tous les participants doivent \
s'accorder sur la compatibilité SMART des objectifs. Affiner et ratifier.",
	source: source_agileRetrospectives,
	duration: "20-60 groupsize",
	suitable: "iteration, release, project"
};
all_activities[13] = {
	phase: 4,
	name: "La porte des retours - les chiffres",
	summary: "Évaluez la satisfaction des participants à propos de la rétro sur une échelle de 1 à 5 en un minimum de temps.",
	desc: "Placez des posts-its sur la porte numérotés de 1 à 5. 1 étant le plus haut et le meilleur score, 5 le plus bas et le pire. \
A la fin de la rétrospective, demandez aux participants de placer un post-it sur le chiffre qui d'après eux \
correspond le mieux à la session. Le post-it peut être vide ou contenir un commentaire ou une suggestion.",
	source: "ALE 2011, " + source_findingMarbles,
	duration: "2-3",
	suitable: "iteration, largeGroups"
};
all_activities[14] = {
	phase: 4,
	name: "Appréciations",
	summary: "Les membres de l'équipe sont reconnaissants les uns envers les autres et concluent de manière positive.",
	desc: "Commencez en remerciant de manière sincère l'un des participants. \
Cela peut concerner n'importe laquelle de ses contributions : aider l'équipe ou vous-même à résoudre un problème, ...<br />\
Invitez alors les autres à faire de même et attendez que quelqu'un se jette à l'eau. Arrêtez quand personne n'a parlé pendant plus d'une minute.",
	source: source_agileRetrospectives + " qui l'a adapté de 'The Satir Model: Family Therapy and Beyond'",
	duration: "5-30 groupsize",
	suitable: "iteration, release, project"
};
all_activities[15] = {
	phase: 4,
	name: "Aide, Gêne, Hypothèse",
	summary: "Obtenez des retours concrets sur votre manière de faciliter.",
	desc: "Préparez 3 feuilles de papier intitulés 'Aide', 'Gêne', et 'Hypothèse' \
(des suggestions de choses à essayer). \
Demandez aux participants de vous aider à progresser et devenir un meilleur facilitateur en vous écrivant des post-its \
et en signant de leurs initiales pour que vous puissiez poser des questions par la suite.",
	source: source_agileRetrospectives,
	duration: "5-10",
	suitable: "iteration, release"
};
all_activities[16] = {
	phase: 4, // marche aussi pour 5
	name: "SaMoLo (Plus de, Autant de, Moins de)",
	summary: "Pour vous aider à redresser la barre dans votre rôle de facilitateur.",
	desc: "Dessinez au tableau trois parties intitulées 'Plus de', 'Autant de', et 'Moins de'. \
Demandez aux participants un coup de main pour vous aider à améliorer votre comportement : Écrivez sur des post-its \
ce que vous devriez faire, plus souvent, moins souvent et ce qui est très bien comme ça. Lisez et \
discutez un court moment des post-its collés dans chaque partie.",
	more: "<a href='http://www.scrumology.net/2010/05/11/samolo-retrospectives/'>Les expériences de David Bland</a>",
	source: "<a href='http://fairlygoodpractices.com/samolo.htm'>Fairly good practices</a>",
	duration: "5-10",
	suitable: "iteration, release, project"
};
all_activities[17] = {
phase:     0,
name:      "Lancement - Commentaires Amazon",
summary:   "Commentez l'itération sur Amazon. N'oublier pas l'évaluation !",
desc:      "Chaque membre écrit un rapide commentaire qui comporte : \
<ul>\
    <li>Un titre</li>\
    <li>Un commentaire</li>\
    <li>Une évaluation (5 étoiles pour le meilleur score) </li>\
</ul>\
Chacun lit son commentaire. Notez les évaluations sur un tableau.<br>\
Peut s'étendre à la rétrospective entière en demandant également ce qui est recommandé de faire et de ne pas faire pour l'itération.",
source:    "<a href='http://blog.codecentric.de/2012/02/unser-sprint-bei-amazon/'>Christian Hei&szlig;</a>",
duration:  "10",
suitable: "release, project"
};
all_activities[18] = {
phase:     1,
name:      "Hors-Bord / Voilier",
summary:   "Analysez les forces qui vous vont avancer et qui vous ralentissent.",
desc:      "Dessinez un bateau sur un tableau à feuilles. Dotez le d'un bon moteur \
ainsi que d'une ancre très lourde. Les membres de l'équipe écrivent en silence sur des post-its ce qui a propulsé l'équipe vers l'avant \
et ce qui lui a fait faire du surplace. Une idée par post-it. Collez les post-its respectivement sur le moteur et l'ancre. \
Lisez les tous et discutez de comment booster le 'moteur' et comment se passer de l’'ancre'.",
source:    "<a href='http://leadinganswers.typepad.com/leading_answers/2007/10/calgary-apln-pl.html'>Mike Griffiths</a>, qui l'a adapté pour " + source_innovationGames,
duration:  "10-15 par groupe",
photo:    "<a href='static/images/activities/19_Speedboat.jpg' rel='lightbox[activity18]' title='Contribution de Corinna Baldauf'>Voir la photo</a>",
suitable: "iteration, release"
};
all_activities[19] = {
phase:     2,
name:      "Le jeu de la perfection",
summary:   "Qu'est-ce qui pourrait faire que la prochaine itération obtiennent une note de 10 sur 10 ?",
desc:      "Dessinez deux colonnes sur une feuille du tableau, une petite pour 'Évaluation' et une grande pour 'Actions'. \
Tout le monde évalue la dernière itération sur une échelle de 1 à 10. Ensuite chacun suggère quelles action(s) \
feraient que la prochaine itération obtienne un score de 10 sur 10.",
source:    "<a href='http://www.benlinders.com/2011/getting-business-value-out-of-agile-retrospectives/'>Ben Linders</a>",
photo:    "<a href='static/images/activities/20_Perfection-Game.jpg' rel='lightbox[activity20]' title='Contribution de Pieter Versteijnen'>Voir la Photo</a> \
<a href='static/images/activities/20_Perfection-Game_2.jpg' rel='lightbox[activity20]' title='Contribution de Pedro Ángel Serrano'></a>",
suitable: "iteration, release"
};
all_activities[20] = {
phase:     3,
name:      "Fusion",
summary:   "Réduisez le nombre d'actions possibles à seulement deux qui seront expérimentées par l'équipe.",
desc:      "Distribuez des cartes et des marqueurs. Dites à tout le monde d'écrire les deux actions qu'ils \
veulent essayer à la prochaine itération - aussi précises que possible \
(<a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART</a>). Ensuite tout le monde paire \
avec son voisin et ensemble ils doivent fusionner leurs actions en une seule liste avec \
deux actions. Les paires forment des groupes de 4. Puis 8. Maitenant ramassez les deux actions de tous les groupes \
et votez pour les deux finales.",
source:    "Lydia Grawunder &amp; Sebastian Nachtigall",
duration:  "15-30 groupSize",
photo:    "<a href='http://1.bp.blogspot.com/-dLemopaMJ9o/UhKRRRBMFkI/AAAAAAAAC78/6hH5yQKucYA/s320/photo+4(1).JPG' rel='lightbox[activity20]' title='Prise par Paulo Caroli'>Voir la photo</a>",
suitable: "iteration, release, project, largeGroups"
};
all_activities[21] = {
    phase:     0,
    name:      "Prise de température",
    summary:   "Les participants marquent leur 'température' (humeur) sur un tableau",
    desc:      "Préparez un tableau avec un dessin de thermomètre allant de glacé à chaud \
    en passant par la température du corps. \
    Chaque participant marque son humeur au tableau.",
    source:  source_unknown
};
all_activities[22] = {
    phase:     4,
    name:      "La porte des retours - Smileys",
    summary:   "Mesurez la satisfaction des participants concernant la rétro en un minimum de temps en utilisant des smileys",
    desc:      "Dessinez un ':)', ':|', et ':(' sur une feuille de papier et accrochez la sur la porte. \
    À la fin de la rétrospective, demandez aux participants de marquer leur niveau \
    de satisfaction par rapport à la session par un 'x' sous le smiley correspondant.",
    source:    "<a href='http://boeffi.net/tutorials/roti-return-on-time-invested-wie-funktionierts/'>Boeffi</a>",
    photo:    "<a href='static/images/activities/23_Feedback-Door-Smilies.jpg' rel='lightbox[activity23]' title='Contribuée par Philipp Flenker'>Voir la Photo</a>",
    duration:  "2-3",
    suitable: "iteration, largeGroups"
};
all_activities[23] = {
    phase:     3,
    name:      "Liste des choses à faire",
    summary:   "Les participants proposent et s'engagent sur des actions",
    desc:      "Préparez un tableau avec 3 colonnes 'Quoi', 'Qui' et 'Échéance'. \
    Demandez à chaque participant à tour de rôle ce qu'ils souhaitent faire pour faire \
    avancer l'équipe. Écrivez la tâche, mettez vous d'accord sur une date d'échéance \
    et laissez les signer de leur nom. <br>\
    Si quelqu'un suggère une action pour l'équipe entière, cette personne doit obtenir \
    l'adhésion (et les signatures) des autres.",
    source:    source_findingMarbles + ", inspiré par <a href='http://lwscologne.wordpress.com/2012/05/08/11-treffen-der-limited-wip-society-cologne/#Retrospektiven'>cette liste</a>",
    duration:  "10-15 groupSize",
    suitable: "iteration, release, smallGroups"
};
all_activities[24] = {
    phase:     2,
    name:      "Diagramme-Causes-Effets",
    summary:   "Trouvez la source des problèmes dont les origines sont difficiles à localiser \
        et amènent à des discussions sans fin",
    desc:      "Écrivez le problème que vous souhaitez explorer sur un post-it et collez le au milieu d'un tableau blanc. \
        Découvrez en quoi c'est un problème en demandant continuellement 'Et alors ?'. \
        Découvrez les causes racines de ce problème en demandant continuellement 'Pourquoi (est-ce que cela se produit) ?'. \
        Documentez vos conclusions en ajoutant des post-its et en explicitant la relation \
        cause à effet avec des flèches. Chaque post-it peut avoir plus d'une raison et plus \
        d'une conséquence.<br>\
        Les cercles vicieux sont généralement de bons points de départ pour la prise d'actions. \
        Si vous parvenez à casser leur mauvaise influence, vous pouvez gagner énormément.",
    source:    "<a href='http://blog.crisp.se/2009/09/29/henrikkniberg/1254176460000'>Henrik Kniberg</a>",
    more:      "<a href='http://finding-marbles.com/2011/08/04/cause-effect-diagrams/'>Corinna's experiences</a>",
    duration:  "20-60 complexity",
    photo:    "<a href='http://www.plans-for-retrospectives.com/static/images/activities/25_Cause-Effect-Diagramm.jpg' rel='lightbox[activity25]' title='Contributed by Corinna Baldauf'>Voir la Photo</a>\
               <a href='static/images/activities/25_Cause-Effect-Diagram-2.jpg' rel='lightbox[activity25]' title='Contribuée par Philipp Flenker'></a>",
    suitable: "release, project, smallGroups, complex"
};
all_activities[25] = {
    phase:     2,
    name:      "Speed Dating",
    summary:   "Chaque membre de l'équipe explore un sujet en détail dans une série de discussions en tête à tête",
    desc:      "Chaque participant écrit un sujet qu'il souhaite approfondir, càd quelque chose \
    qu'il aimerait voir changer. Formez ensuite des paires et répartissez vous à travers la salle. \
    Chaque paire discute des deux sujets et réfléchit aux actions possibles - 5 minute par\
    participant (sujet) - l'un après l'autre. \
    Après 10 minutes les paires se séparent et forment de nouvelles paires. Continuez \
    jusqu'à ce que tout le monde ait discuté avec tout le monde. <br>\
    Si le groupe a un nombre impair de membres, le facilitateur devient membre d'une paire \
    mais son partenaire dispose de l'intégralité des 10 minutes sur son sujet.",
    source:    source_kalnin,
    duration:  "10 perPerson",
    suitable: "iteration, release, smallGroups"
};
all_activities[26] = {
    phase:     5,
    name:      "Biscuits Chinois de Rétrospective",
    summary:   "Amenez l'équipe manger à l'extérieur et suscitez des discussions avec des biscuits chinois de rétrospective ('retrospective cookies')",
    desc:      "Invitez l'équipe à manger à l'extérieur, de préférence Chinois si vous souhaitez \
    rester dans le thème ;)<br>\
    Distribuez des 'fortune cookies' (biscuits chinois renfermant un mot dans leur emballage) \
    et faites un tour de table en ouvrant les biscuits et en discutant leur contenu. \
    Quelques exemples de 'fortunes' :\
<ul>\
    <li>Quelle a été la chose la plus efficace que vous ayez fait durant le Sprint, et pourquoi \
    est-ce que cela a été si réussi ?</li>\
    <li>Est-ce que le burndown reflète la réalité ? Pourquoi ?</li>\
    <li>Que contribuez vous au sein de votre entreprise à la communauté de développeurs ? \
    Que pourriez vous contribuer ?</li>\
    <li>Quel a été le plus gros obstacle à l'équipe durant ce Sprint ?</li>\
</ul>\
Vous pouvez <a href='http://weisbart.com/cookies/'>commander des biscuits chinois de rétrospective chez Weisbart</a> \
ou cuisiner les vôtre, par exemple si l'Anglais n'est pas la langue natale de votre équipe.",
    source:    "<a href='http://weisbart.com/cookies/'>Adam Weisbart</a>",
    duration:  "90-120",
    suitable: "iteration, release, smallGroups"
};
all_activities[27] = {
phase:     5,
name:      "Allez prendre l'air !",
summary:   "Allez dans le parc le plus proche, posez-vous des questions et parlez.",
desc:      "Fait-il beau dehors ? Oui ? Alors pourquoi rester enfermés quand on peut s'aérer les poumons \
et voir les choses sous un autre angle.<br /> \
Allez dehors et faites un tour dans le parc le plus proche. \
Vous parlerez naturellement du travail. C'est une bonne façon de changer vos habitudes lorsque tout fonctionne \
et que vous n'avez pas besoin de projeter des documents pour échanger.<br /> \
Les équipes matures peuvent très bien partager des idées et trouver des consensus malgré le contexte bien plus informel.",
source:    source_findingMarbles,
duration:  "60-90",
suitable: "iteration, release, smallGroups, smoothSailing, mature"
};
all_activities[28] = {
phase:     3,
name:      "Cercles d'Influence",
summary:   "Identifier des actions selon le niveau de contrôle que l'équipe souhaite avoir.",
desc:      "Preparer un tableau avec 3 cercles concentriques, chacun étant assez grand pour y coller des post-its.<br /> \
Nommez les cercles de l'intérieur vers l'extérieur :<br /> \
<ul>\
  <li>L'équipe contrôle - Actions directes</li>\
  <li>L'équipe influence - Actions de recommandation</li>\
  <li>Le reste - Actions de réponse/réaction</li>\
</ul> \
(\"Le reste\" représente l'environnement dans lequel l'équipe est embarquée.)<br /> \
Reprenez la liste des idées identifiée à l'étape précédente et placez les dans le cercle approprié. <br /> \
Les participants rédigent en binôme les actions possibles. Encouragez les à se concentrer en priorité sur les éléments dans leur cercle d'influence.<br /> \
Les binômes collent ensuite leur plan d'actions à côté de chaque élément associé et le lise à voix haute. <br /> \
Mettez-vous d'accord sur le plan à essayer (via discussion, vote à la majorité, vote par gommette, etc).",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/07/26/circles-and-soup/'>Diana Larsen</a> \
qui l'a adapté de \"Seven Habits of Highly Effective People\" par Stephen Covey et \
'<a href='http://www.ayeconference.com/wiki/scribble.cgi?read=CirclesOfControlInfluenceAndConcern'>CircleofInfluenceAndConcern</a>' par Jim Bullock",
suitable: "iteration, release, project, stuck, immature"
};
all_activities[29] = {
phase:     5,
name:      "Plateau de discussion",
summary:   "Une approche structurée pour une discussion.",
desc:      "Un plateau de discussions ressemble un peu à un jeu de plateau. Il y a <a href='http://www.softwarestrategy.co.uk/dlgsheets/available.html'>plusieurs grilles disponibles (EN)</a>.<br />\
Choisissez en une, imprimez la dans le plus grand format que vous puissiez (idéalement en A1) et suivez ses instructions.",
source:    "<a href='http://www.softwarestrategy.co.uk/dlgsheets/available.html'>Allen Kelly chez Software Strategy</a>",
duration:  "90-120",
suitable: "iteration, release, project"
};
all_activities[30] = {
phase:     0,
name:      "Lancement - Dessinez l'itération",
summary:   "Les participants dessinent certains aspects de l'itération.",
desc:      "Distribuez des cartes et des marqueurs et choisissez le sujet. Exemples de sujet : \
<ul> \
  <li>Comment avez-vous vécu l'itération ?</li>\
  <li>Quel a été le moment le plus marquant ?</li>\
  <li>Quel a été le plus gros problème ?</li>\
  <li>Qu'auriez-vous désiré ?</li>\
</ul>\
Demandez à chaque membre de l'équipe de dessiner sa réponse. Collez tous les dessins sur un tableau. <br />\
Pour chaque dessin, laissez les gens deviner ce qu'il représente avant que son auteur ne l'explique.<br />\
Les métaphores apportent un nouvel éclairage et créent une compréhension partagée.",
source:    source_findingMarbles + ", adapté de \
<a href='http://vinylbaustein.net/2011/03/24/draw-the-problem-draw-the-challenge/'>Thorsten Kalnin</a> \
et Olivier Gourment",
photo:    "<a href='static/images/activities/31_Draw-Iteration.jpg' rel='lightbox[activity31]' title='Contribuée par Eric Lannemajou'>Voir la photo</a>",
duration:  "5 + 3 par personne",
suitable: "iteration, release, project"
};
all_activities[31] = {
phase:     0,
name:      "Gauge du projet par émoticônes",
summary:   "Aidez les membres de l'équipe à exprimer leur sentiment vis à vis du projet et en traiter les causes au plus tôt.",
desc:      "Preparez un tableau avec des visages exprimant diverses émotions telles que :\
<ul>\
  <li>choc / surprise</li>\
  <li>nervosité / stress</li>\
  <li>impuissance / contrainte</li>\
  <li>confusion</li>\
  <li>joie</li>\
  <li>colère</li>\
  <li>dépassement</li>\
</ul>\
Laissez chaque membre de l'équipe choisir comment il se sent à propos du projet, c'est un moyen fun et efficace de faire remonter plus tôt les problèmes. <br />\
Vous pourrez en trouver les solutions dans les étapes qui suivent.",
source:    "Andrew Ciccarelli",
duration:  "10 pour 5 personnes",
photo:    "<a href='static/images/activities/32_Emoticons.jpg' rel='lightbox[activity32]' title='Contribuée par Ruud Rietveld'>Voir la photo</a>",
suitable: "iteration, release"
};
all_activities[32] = {
phase:     1,
name:      "Fier(ère) & Désolé(e)",
summary:   "De quoi les membres de l'équipe sont ils fiers ou désolés ?",
desc:      "Affichez deux feuilles \"fier(e)\" et \"désolé(e)\".<br />\
Les membres de l'équipe listent un commentaire pour chaque feuille.<br />\
Lorsque le temps est écoulé, faites un tour de table pour que chacun lise ses notes et les colle sous le thème approprié. <br/>\
Démarrez une courte conversation en demandant :\
<ul>\
  <li>Est ce que quelque chose vous a surpris ?</li>\
  <li>Quels motifs peut-on constater ? Que cela signifie-t-il en tant qu'équipe ?</li>\
</ul>",
source:    source_agileRetrospectives,
duration:  "10-15",
suitable: "iteration, release"
};
all_activities[33] = {
phase:     4,
name:      "La douche de l'appréciation",
summary:   "Ecoutez les gens parler dans votre dos (et uniquement des bonnes choses) !",
desc:      "Par groupes de 3, chaque groupe déplace ses chaises pour que 2 chaises soient face à face et que la troisième leur tourne le dos.\
Quelque chose comme ça : >^<.<br />\
Les deux personnes dans les chaises qui se font face parler de la troisième personne pendant 2 minutes.<br />\
Elles ne peuvent dire que des choses positives et rien de ce qu'il s'est dit ne peut être minimisé en en reparlant par la suite.<br />\
Faites trois tours pour que chacun puisse se doucher une fois !",
source:    '<a href="http://www.miarka.com/de/2010/11/shower-of-appreciation-or-talking-behind-ones-back/">Ralph Miarka</a>',
duration:  "10-15",
suitable: "iteration, release, matureTeam"
};
all_activities[34] = {
phase:     1,
name:      "L'auto-évaluation Agile",
summary:   "Evaluez où vous en êtes avec via une checklist.",
desc:      "Imprimez une checklist qui vous convient, exemples :\
<ul>\
  <li><a href='http://www.crisp.se/gratis-material-och-guider/scrum-checklist'>L'excellente checklist Scrum de Henrik Kniberg</a></li>\
  <li><a href='http://finding-marbles.com/2011/09/30/assess-your-agile-engineering-practices/'>L'auto-évaluation des pratiques agiles d'ingénierie (EN)</a></li>\
  <li><a href='http://agileconsortium.blogspot.de/2007/12/nokia-test.html'>Test Nokia (EN)</a></li>\
</ul>\
Parcourez les avec l'équipe et échangez pour savoir là où vous en êtes et si vous vous êtes sur la bonne voie. <br />\
C'est une bonne activité à pratiquer lorsque qu'une itération s'est déroulée sans événement majeur.",
source:    source_findingMarbles,
photo:    "<a href='static/images/activities/35_Agile-Self-Assessment.jpg' rel='lightbox[activity35]' title='Contribuée par Philipp Flenker'>Voir la photo</a>",
duration:  "10-25 minutes selon la liste",
suitable: "smallTeams, iteration, release, project, smoothGoing"
};
all_activities[35] = {
phase:     0,
name:      "Objectif reconnaissance",
summary:   "Formuler un objectif positif pour la session.",
desc:      "Concentrez-vous sur les aspects positifs au lieu des problèmes en définissant un objectif positif. Exemples : \
<ul>\
  <li>Trouvons plusieurs façons de renforcer notre travail d'équipe et nos process</li>\
  <li>Trouvons comment étendre nos bonnes pratiques et méthodes d'ingénierie</li>\
  <li>Nous identifierons et tenterons de trouver plus de rapports dans le travail qui fonctionnent</li>\
  <li>Nous identifierons là où nous avons produit le plus de valeur ajoutée au cours de la dernière itération afin d'agumenter celle que nous fournirons lors du prochain</li>\
</ul>",
source:    "<a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
duration:  "3 minutes",
suitable: "iteration, release, project"
};
all_activities[36] = {
phase:     2,
name:      "Souvenons-nous de l'avenir",
summary:   "Imaginez que la prochaine itération est parfaite. A quoi ressemble-t-elle ? Qu'avez-vous fait ?",
desc:      "<p>Imaginez que vous puissez voyager à travers le temps jusqu'à la fin de la prochaine itération (ou release).<br />\
Vous y apprenez que ça a été la meilleure itération et la plus productive que vous ayez fait !<br />\
Comment vos futurs vous vous la décrivent ? Qu'y voyez-vous et entendez-vous ?</p>\
<p>Donnez un peu de temps à l'équipe pour imaginer cette situation et prendre quelques notes / mots clés pour aider leur mémoire.<br />\
  Ensuite, laissez chacun décrire sa vision de l'itération parfaite.<br />\
  Pousuivez ensuite avec la question \"Quels changements avons-nous réalisés pour atteindre un avenir si productif et satisfaisant ?\"<br />\
  Notez les réponses sur des cartes pour s'en servir dans la phase suivante.</p>",
source:    "<a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
suitable: "iteration, release, project"
};
all_activities[37] = {
phase:     3,
name:      "Vote par gommette - Garder, Abandonner, Démarrer",
summary:   "Phosphorez sur les comportements à garder, abandonner et démarrer et gardez en les principaux.",
desc:      "Séparez un tableau en trois ensembles intitulés :\
<ul><li>Garder</li>\
  <li>Abandonner</li>\
  <li>Démarrer</li>\
</ul>\
Demandez à vos participants d'écrire des propositions concrètes pour chaque catégorie avec une idée par thème.\
Laissez les écrire en silence pendant quelques minutes. <br />\
Chacun lis ensuite ses notes à voix haute et colle ses cartes dans la catégorie appropriée.<br />\
Menez la conversation pour identifiez 20% des idées qui seraient les plus bénéfiques. <br />\
Laissez chacun voter avec des gommettes ou avec un marqueur en pouvant distribuer 1, 2 ou 3 points aux idées (répartis comme bon lui semble).<br />\
Les 2 ou 3 principales idées seront votre plan d'actions.",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[38] = {
phase:     3,
name:      "Vote par gommette - Fonctionne bien, Faire différemment",
summary:   "Phosphorez sur ce qui a bien fonctionné et ce qu'il faudrait faire différemment et gardez les meilleurs idées.",
desc:      "Intitulez respectivement deux tableaux \"Fonctionne bien\" et \"Faire différemment\".<br /> \
Demandez à vos participants d'écrire des propositions concrètes pour chaque catégorie avec une idée par thème.\
Laissez les écrire en silence pendant quelques minutes.<br />\
Chacun lis ensuite ses notes à voix haute et colle ses cartes dans la catégorie appropriée.<br />\
Laissez chacun voter avec des gommettes ou avec un marqueur en pouvant distribuer 1, 2 ou 3 points aux idées (répartis comme bon lui semble).<br />\
Les 2 ou 3 principales idées seront votre plan d'actions.",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteration"
};
all_activities[39] = {
phase:     4,
name:      "Plus & Delta",
summary:   "Chaque participant note une chose qu'il aime et une qu'il voudrait changer à propos de la rétro.",
desc:      "Préparez une tableau avec deux colonnes \"Plus\" et \"Delta\". \
Demandez à chaque participant d'écrire un aspect de la rétrospective qu'il a aimé et un qu'il souhaiterait modifier sur des cartes différentes. <br />\
Affichez et passez rapidement en revue les cartes en clarifiant leur sens exact \
et en identifiant la tendance majoritaire lorsque des notes vont dans deux directions opposées pour un même point.",
source:    "<a href='http://agileretrospectivewiki.org/index.php?title=Weekly_Retrospective_Simple_%2B_delta'>Rob Bowley</a>",
duration:  "5-10",
suitable: "release, project"
};
all_activities[40] = {
phase:     2,
name:      "Le banc du parc",
summary:   "Discussion de groupe avec un nombre variable de sous-groupes de participants.",
desc:      "Placez au moins 4 et au maximum 6 chaises en ligne afin qu'elles fassent face au groupe. <br />\
Expliquez les règles :<ul>\
  <li>Asseyez-vous sur le banc lorsque vous voulez contribuer à la discussion</li>\
  <li>Le banc doit toujours avoir une place de libre</li>\
  <li>Lorsque la dernière place du banc est prise, quelqu'un doit obligatoirement partir et retourner dans le public</li>\
</ul>\
Démarrez en vous asseyant sur le \"banc\" et en vous demandant à voix haute \
ce que vous avez appris au cours de la phase précédente jusqu'à ce que quelqu'un vous rejoigne.<br />\
Arrêtez l'activité lorsque vous voyez que les discussions cessent.<br />\
C'est une variante du \"bocal à poisson\". C'est adapté pour les groupes de 10-25 personnes.",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/08/24/park-bench/'>Diana Larsen</a>",
duration:  "15-30",
suitable: "release, project, largeGroups"
};
