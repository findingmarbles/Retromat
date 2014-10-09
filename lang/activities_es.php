var phase_titles = ['Armar el escenario', 'Recolectar datos', 'Indagar', 'Decidir qu&eacute; hacer', 'Cerrar la retrospectiva', 'Algo completamente distinto'];

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
name:      "ECVP",
summary:   "&iquest;C&oacute;mo se sienten los participantes para la retrospectiva: Explorador, Comprador, Veraneante o Prisionero?",
desc:      "Preparar una pizarra con las &aacute;reas E, C, V y P. Explicar el concepto: <br>\
<ul>\
    <li>Explorador: Con ganas de sumergirse para investigar lo que funcion&oacute; y no funcion&oacute; y c&oacute;mo mejorar.</li>\
    <li>Comprador: Actitud positiva. Feliz si surge algo bueno.</li>\
    <li>Veraneante: Reacio a participar activamente pero consciente que la retrospectiva es mejor que el trabajo normal.</li>\
    <li>Prisionero: Est&aacute; presente &uacute;nicamente porque (siente que) debe estar.</li>\
</ul>\
Hacer una encuesta en forma an&oacute;nima con trozos de papel. Contar las respuestas y registrarlas en la pizarra para que todos puedan ver los resultados. Si la confianza es baja, destruir deliberadamente los votos luego para asegurar privacidad. <br>Preguntar a los participantes que opinan de los datos. Si hay una mayor&iacute;a de Veraneantes o Prisioneros, considerar utilizar la retrospectiva para debatir esta conclusi&oacute;n.",
duration:  "5-10 numberPeople",
source:  source_agileRetrospectives,
suitable:   "iteraci&oacute;n, entrega, proyecto, inmaduro"
};

all_activities[1] = {
phase:     0,
name:      "Informe Meteorol&oacute;gico",
summary:   "Los participantes indican su estado 'meteorol&oacute;gico' (estado de &aacute;nimo) en una pizarra.",
desc:      "Preparar una pizarra con dibujos de tormenta, lluvia, nubes y sol. <br>Cada participante indica en la pizarra el dibujo que mejor representa su estado de &aacute;nimo.",
source:  source_agileRetrospectives,
photo:    "<a href='static/images/activities/2_Weather-Report.jpg' rel='lightbox[activity2]' title='Contribuci&oacute;n de Philipp Flenker'>Ver Foto</a>",
};

all_activities[2] = {
phase:     0,
name:      "Check In - Pregunta R&aacute;pida", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Hacer una pregunta a contestar por cada participante.",
desc:      "En orden secuencial, cada participante contesta la misma pregunta (excepto si dice 'Paso'). \
Ejemplos: <br>\
<ul>\
    <li>En una palabra: &iquest;Qu&eacute; esperas de esta retrospectiva?</li>\
    <li>En una palabra: &iquest;Qu&eacute; te est&aacute; pasando por la cabeza?</li>\
        Dar lugar a las preocupaciones, por ejemplo escribi&eacute;ndolas en una pizarra para dejarlas luego -f&iacute;sica y mentalmente- de costado</li>\
    <li>Si fueras un auto, &iquest;de qu&eacute; tipo ser&iacute;a?</li>\
    <li>&iquest;En qu&eacute; estado emocional est&aacute;s (por ejemplo: 'contento', 'triste', 'enojado', 'con miedo')?</li>\
</ul><br>\
Evitar comentarios de evaluaci&oacute;n como 'Muy bueno'. Un simple 'Gracias' est&aacute; bien.",
source:  source_agileRetrospectives
};

all_activities[3] = {
phase:     1,
name:      "Linea de Tiempo",
summary:   "Los participantes registran los eventos significativos y los ordenan cronol&oacute;gicamente",
desc:      "Dividir los participantes en grupos de 5 o menos personas. Repartir tarjetas y marcadores. \
Dejar 10min a los participantes para escribir los eventos memorables y / o personalmente significativos. \
Se trata de recabar perspectivas m&uacute;ltiples. El consenso ser&iacute;a perjudicial. Todos los participantes \
presentan sus tarjetas y las ordenan. Est&aacute; bien agregar tarjeta sobre la marcha. Analizar.<br>\
El uso de colores puede ayudar a identificar tendencias, por ejemplo:<br>\
<ul>\
    <li>Emociones</li>\
    <li>Eventos (t&eacute;cnicos, organizaci&oacute;n, personas...)</li>\
    <li>Funci&oacute;n (tester, desarrollador, l&iacute;der...)</li>\
</ul>",
duration:  "60-90 timeframe",
source:  source_agileRetrospectives,
suitable: "iteraci&oacute;n, introvertidos"
};

all_activities[4] = {
phase:     1,
name:      "Analizar Historias de Usuario",
summary:   "Revisar cada una de las Historias de Usuario trabajada por el equipo para buscar posibles mejoras",
desc:      "Preparaci&oacute;n: Recolectar todas las Historias de Usuario trabajadas durante la iteraci&oacute;n y llevarlas a la retrospectiva.<br> \
En grupo (10 personas max), leer cada Historia de Usuario. Para cada una, debatir si sali&oacute; bien o no. \
Si sali&oacute; bien, entender y registrar porque. Sino, debatir lo que se podr&iacute;a hacer distinto en el futuro.<br>\
Variaciones: se puede utilizar para pedidos de soporte, incidentes o cualquier item trabajado por el equipo.",
source:    source_findingMarbles,
suitable: "iteraci&oacute;n, max10personas"
};

all_activities[5] = {
phase:     1,
name:      "Gustos con Gustos",
summary:   "Los participantes asignan cartas-calidad a sus propias propuestas Empezar-Parar-Continuar",
desc:      "Preparaci&oacute;n: 20 cartas-calidad, que son cartas de color con una &uacute;nica palabra escrita ('divertido', 'a tiempo', 'claro', 'con sentido', 'incre&iacute;ble', 'peligroso', 'malo', etc.).<br>\Cada participante debe escribir por lo menos 9 cartas-propuestas: 3 con cosas a empezar, 3 a parar y 3 a continuar. Elegir una persona que ser&aacute; el primer juez. El juez da vuelta la primera carta-calidad. Cada participante elige de sus propias cartas la que mejor corresponde a esta palabra y la ubica con el texto escondido sobre la mesa. El ultimo en elegir debe volver a poner su carta en su mano. El juez mezcla todas las cartas propuestas, las muestra una por una y elige la carta que mejor corresponde. La persona que la propus&oacute; se la queda y las otras cartas-propuestas son descartadas.<br>\
La persona a la izquierda del juez ser&aacute; el nuevo juez. Parar cuando todas las personas se quedan sin cartas (6 a 9 manos). El ganador es el que recuper&oacute; la mayor cantidad de cartas ganadoras.<br>\
Cerrar la actividad pidiendo conclusiones a los participantes.<br>\
Juego basado en 'Apples to Apples'",
source:    source_agileRetrospectives,
duration:  "30-40",
suitable: "iteraci&oacute;n, introvertidos"
};

all_activities[6] = {
phase:     1,
name:      "Enojado Triste Contento",
summary:   "Recolectar eventos donde los miembros del equipo se sintieron enojados, tristes o contentos y buscar las razones",
desc:      "Colocar 3 rotafolios intitulados 'enojado', 'triste', y 'contento' (o como alternativas '>:), :(, :) ). Los miembros del equipo escriben en una carta de color un evento donde sintieron esta emoci&oacute;n. \
Cuando se acaba el tiempo todos pegan sus cartas en los respectivos rotafolios. \
Agrupar cartas relacionadas y pedir al grupo nombrar los grupos definidos. Cerrar preguntando: \
 <ul> \
    <li>&iquest;Qu&eacute; sobresale? &iquest;Qu&eacute; fue inesperado?</li> \
    <li>&iquest;Qu&eacute; fue dif&iacute;cil en esta tarea? &iquest;Qu&eacute; fue divertido?</li> \
    <li>&iquest;Qu&eacute; tendencias detectan?&iquest;Qu&eacute; significan para el equipo?</li> \
    <li>&iquest;Sugerencias sobre como seguir?</li> \
</ul>",
source:    source_agileRetrospectives,
duration:  "15-25",
photo:    "<a href='static/images/activities/7_Mad-Sad-Glad.jpg' rel='lightbox[activity6]' title='Contribuci&oacute;n por Chloe Gachet'>Ver Foto</a>",
suitable: "iteraci&oacute;n, entrega, proyecto, introvertidos"
};

all_activities[7] = {
phase:     2,
name:      "5 por qu&eacute;",
summary:   "Encontrar las causas ra&iacute;z de problemas preguntando '&iquest;Por qu&eacute;?' en forma repetida",
desc:      "Dividir los participantes en peque&ntilde;os grupos (<= 4 personas) y dar a cada grupo \
uno de los problemas identificados. Instrucciones para el grupo:\
<ul>\
    <li>Una persona pregunta a las otras:'&iquest;Por qu&eacute; pas&oacute;?' en forma repetida para encontrar \
	la causa ra&iacute;z de la cadena de eventos</li>\
    <li>Registrar las causas ra&iacute;z (en general es la respuesta al quinto '&iquest;Por qu&eacute;?')</li>\
</ul>\
Dejar que los grupos compartan sus conclusiones.",
source:    source_agileRetrospectives,
duration:  "15-20",
suitable: "iteraci&oacute;n, entrega, proyecto, causa ra&iacute;z"
};

all_activities[8] = {
phase:     2,
name:      "Matriz de Aprendizaje",
summary:   "El equipo hace una lluvia de ideas en 4 categor&iacute;as para enumerar r&aacute;pidamente asuntos",
desc:      "Despu&eacute;s de haber debatido los datos de la fase 2, mostrar un rotafolio con 4 cuadrantes: \
':)', ':(', 'Idea', y 'Apreciaci&oacute;n'. Repartir post-its. \
<ul>\
    <li>Los miembros del equipo pueden agregar sus entradas en cualquier cuadrante. Un tema por post-it. </li>\
    <li>Agrupar post-its relacionados.</li>\
    <li>Dar 6-10 puntos por persona para que voten los asuntos de mayor importancia.</li>\
</ul>\
Esta lista sirve de entrada para la fase 4.",
source:    source_agileRetrospectives,
photo:    "<a href='static/images/activities/9_Learning-Matrix.jpg' rel='lightbox[activity9]' title='Contribuci&oacute;n por Philipp Flenker'>Ver Foto</a>",
duration:  "20-25",
suitable: "iteraci&oacute;n"
};

all_activities[9] = {
phase:     2,
name:      "Lluvia de Ideas / Filtro",
summary:   "Generar muchas ideas y aplicarles filtros",
desc:      "Explicar las reglas de la lluvia de ideas y su objetivo: \
Generar muchas ideas, que luego ser&aacute;n filtradas.\
<ul>\
    <li>Pedir a los participantes que escriban sus ideas por 5-10 minutos</li>\
    <li>Recorrer repetidamente a los participantes en el sentido de reloj, pidiendo a cada uno que cuente una de sus ideas \
	y la escriba en la pizarra, hasta agotar todas las ideas.\
    <li>Preguntar ahora por filtros (por ejemplo costo, inversi&oacute;n de tiempo, concepto repetido, alineamiento con la visi&oacute;n, etc.).\
	Pedir al grupo que elija 4.</li>\
    <li>Aplicar cada filtro a todas las ideas y destacar las ideas que pasan los 4 filtros.</li>\
    <li>&iquest;Qu&eacute; ideas quiere llevar adelante el grupo? &iquest;Algui&eacute;n se siente fuertemente involucrado con una de las ideas?\
	Sino tomar una decisi&oacute;n por voto de la mayor&iacute;a.</li>\
</ul>\
Las ideas seleccionadas entran en la fase 4.",
source:    source_agileRetrospectives,
more:     "<a href='http://www.mpdailyfix.com/the-best-brainstorming-nine-ways-to-be-a-great-brainstorm-lead/'>\
    Nine Ways To Be A Great Brainstorm Lead</a>",
duration:  "40-60",
suitable: "iteraci&oacute;n, entrega, proyecto, introvertidos"
};

all_activities[10] = {
phase:     3,
name:      "Circulo de Preguntas",
summary:   "Preguntas y respuestas van y vienen en un circulo del equipo - una excelente forma de llegar al consenso",
desc:      "Todos se sientan en circulo. Explicar que van a hacer preguntas en el orden del circulo \
para averiguar lo que el grupo quiere hacer. Empezar haciendo la primera pregunta al vecino, \
por ejemplo '&iquest;Cu&aacute;l es la cosa m&aacute;s importante que deber&iacute;amos empezar \
en la pr&oacute;xima iteraci&oacute;n?' El vecino responde y hace una pregunta relacionada a su vecino. \
Terminar cuando emerge un consenso o si se agota el tiempo. Pasar por todo el circulo por lo menos una vez, \
para que todos puedan ser escuchados!",
source:    source_agileRetrospectives,
duration:  "30+ groupsize",
suitable: "iteraci&oacute;n, entrega, proyecto, introvertidos"
};

all_activities[11] = {
phase:     3,
name:      "Voto por Puntos - Empezar, Parar, Continuar",
summary:   "Lluvia de ideas sobre que empezar, parar & continuar, y luego elegir las mejores iniciativas", 
desc:      "Dividir un rotafolio en secciones con los t&iacute;tulos 'Empezar', 'Parar', y 'Continuar'. \
Pedir a los participantes que escriban propuestas concretas para cada categor&iacute;a - 1 idea por carta. \
Dejarlos escribir en silencio durante unos minutos. \
Cada participante lee sus propuestas en voz alta y las ubica donde corresponde en la pizarra. \
Facilitar un peque&ntilde;o debate sobre cuales son las mejores 20&percnt; ideas. \
Votar las ideas repartiendo puntos a pegar o marcando 'X' en las cartas de ideas, \
por ejemplo 1, 2 o 3 puntos por persona a distribuir. \
Las primeras 2-3 ideas son las acciones elegidas. \
<br><br>\
(Ver <a href='http://www.funretrospectives.com/open-the-box/'>'Open The Box', de Paulo Caroli,</a> para \
una variante incre&iacute;ble de esta actividad)",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteraci&oacute;n"
};

all_activities[12] = {
phase:     3,
name:      "Objetivos SMART",
summary:   "Definir un plan de acci&oacute;n concreto y medible",
desc:      "Introducir los <a href='http://en.wikipedia.org/wiki/SMART_criteria'>objetivos SMART</a> \
(e<b>S</b>pecificos, <b>M</b>edibles, <b>A</b>lcanzables, <b>R</b>elevantes y <b>T</b>emporales) \
y ejemplos de objetivos SMART vs no tan SMART, por ejemplo: 'Vamos a estudiar las historias de usuarios \
antes de tomarlas, en una reuni&oacute;n con el Due&ntilde;o de Producto cada mi&eacute;rcoles a las 9 a.m.' vs 'Vamos a conocer las historias de usuario antes de que entren a nuestro backlog de sprint'.<br>\
Formar grupos alrededor de los temas en los cuales el equipo quiere trabajar. \
Cada grupo identifica 1-5 pasos concretos para alcanzar el objetivo. \
Cada grupo presenta sus resultados. \
Todos los participantes deber&iacute;an acordar que los objetivos son 'SMART'. \
Refinar y confirmar.",
source:    source_agileRetrospectives,
duration:  "20-60 groupsize",
suitable: "iteraci&oacute;n, entrega, proyecto"
};

all_activities[13] = {
phase:     4,
name:      "Puerta del Feedback - N&uacute;meros",
summary:   "Medir la satisfacci&oacute;n de los participantes con la retrospectiva en una escala de 1 a 5 en muy poco tiempo",
desc:      "Pegar post-its con los n&uacute;meros 1 a 5 en la puerta. 1 es el m&aacute;s alto y mejor, 5 el m&aacute;s bajo y peor. \
Cuando se termina la retrospectiva, pedir a los participantes que peguen un post-it en el numero que mejor represente a la sesi&oacute;n. \
El post-it puede estar vaci&oacute; o tener un comentario o sugerencia escrito.",
source:    "ALE 2011, " + source_findingMarbles,
duration:  "2-3",
suitable: "iteraci&oacute;n, largeGroups"
};

all_activities[14] = {
phase:     4,
name:      "Reconocimiento",
summary:   "Dejar que los miembros del equipo reconozcan algo positivo de otros para terminar la retrospectiva de una forma positiva",
desc:      "Comenzar dando un sincero agradecimiento a uno de los participantes. \
Puede ser cualquier cosa con la que haya contribuido: ayudarte a ti, a un miembro del equipo, resolver un problema,etc. \
Seguidamente invitar a otros a que hagan lo mismo y esperar a que alguien rompa el hielo. \
Cerrar la retrospectiva cuando nadie hable durante un minuto.",
source:    source_agileRetrospectives + " que lo tom&oacute; de: 'The Satir Model: Family Therapy and Beyond'",
duration:  "5-30 personas",
suitable: "iteraci&oacute;n, entrega, proyecto"
};

all_activities[15] = {
phase:     4,
name:      "Ayud&oacute;, entorpeci&oacute;, hip&oacute;tesis",
summary:   "Obten feedback concreto de c&oacute;mo facilitaste la retrospectiva",
desc:      "Preparar tres pizarras y tit&uacute;larlas 'Ayud&oacute;', 'Entorpeci&oacute;', e 'Hip&oacute;tesis' \
(son sugerencias de cosas que se podr&iacute;an probar). \
Pedir a los participantes que te ayuden a mejorar como facilitador escribiendo \
en post-its aspectos para cada uno de los temas y firm&aacute;ndolos con sus iniciales \
para que posteriormente les puedas preguntar sobre lo que escribieron.",
source:    source_agileRetrospectives,
duration:  "5-10",
suitable: "iteraci&oacute;n, entrega"
};

all_activities[16] = {
phase:     4, 
name:      "SaMoLo (M&aacute;s de, Lo mismo de, Menos de) ",
summary:   "Para mejorar el rumbo de lo que estas haciendo como facilitador",
desc:      "Dividir una pizarra en tres secciones tituladas 'M&aacute;s de','Lo mismo de' y 'Menos de'. \
Pedir a los participantes guiar tu actuaci&oacute;n en la direcci&oacute;n adecuada: escribiendo \
en post-its cosas que creen que deber&iacute;as hacer mas, menos o dejarlas como est&aacute;n. \
Leer brevemente en voz alta cada sugerencia y debatir sobre ellas junto con el equipo.",
more:      "<a href='http://www.scrumology.net/2010/05/11/samolo-retrospectives/'>David Bland's experiences</a>",
source:    "<a href='http://fairlygoodpractices.com/samolo.htm'>Fairly good practices</a>",
duration:  "5-10",
suitable: "iteraci&oacute;n, entrega, proyecto"
};

all_activities[17] = {
phase:     0,
name:      "Opina como en Amazon",
summary:   "Eval&uacute;ar la iteraci&oacute;n como en Amazon. &iexcl;No olvidar puntuar con estrellas!",
desc:      "Cada miembro del equipo escribe una breve cr&iacute;tica con: \
<ul>\
    <li>T&iacute;tulo</li>\
    <li>Contenido</li>\
    <li>Evaluaci&oacute;n con estrellas (Cinco estrellas es lo mejor) </li>\
	</ul>\
Cada uno lee en voz alta sus cr&iacute;ticas. Registrar las puntuaciones con estrellas en una pizarra. \
Se puede finalizar la retrospectiva preguntando qu&eacute; \
se recomienda sobre el sprint y qu&eacute; no.",
source:    "<a href='http://blog.codecentric.de/2012/02/unser-sprint-bei-amazon/'>Christian Hei&szlig;</a>",
duration:  "10",
suitable: "entrega, proyecto"
};

all_activities[18] = {
phase:     1,
name:      "Lancha / Velero",
summary:   "Analizar qu&eacute; te impulsa o qu&eacute; te echa para atr&aacute;s",
desc:      "Dibujar un gran motor as&iacute; como un gran ancla. Los miembros \
del equipo en silencio escriben en post-its qu&eacute; impulsa al equipo y qu&eacute; lo \
deja frenado. Se escribe una idea por post-it. Poner las sugerencias del equipo en la zona \
del motor y del ancla respectivamente. Leer en voz alta cada una y discutir sobre \
c&oacute;mo se podr&iacute;a mejorar el motor y hacer m&aacute;s peque&ntilde;o el ancla.",
source:    "<a href='http://leadinganswers.typepad.com/leading_answers/2007/10/calgary-apln-pl.html'>Mike Griffiths</a>, \
quien lo adapt&oacute; de " + source_innovationGames,
duration:  "10-15 groupSize",
photo:    "<a href='static/images/activities/19_Speedboat.jpg' rel='lightbox[activity19]' title='Contribuci&oacute;n de Corinna Baldauf'>Ver Foto</a>",
suitable: "iteraci&oacute;n, entrega"
};

all_activities[19] = {
phase:     2,
name:      "El juego de la perfecci&oacute;n",
summary:   "&iquest;Qu&eacute; habr&iacute;a que hacer en el siguiente sprint para conseguir un 10 de 10?",
desc:      "Preparar una pizarra con dos columnas: una peque&ntilde;a para 'Nota' y otra ancha para 'Acciones'. \
Los participantes punt&uacute;an el &uacute;ltimo sprint en una escala de 1 a 10. \
Luego tienen que proponer acciones a hacer para que el siguiente sprint tenga una puntuaci&oacute;n de 10.",
source:    "<a href='http://www.benlinders.com/2011/getting-business-value-out-of-agile-retrospectives/'>Ben Linders</a>",
suitable: "iteraci&oacute;n, entrega"
};

all_activities[20] = {
phase:     3,
name:      "Fusi&oacute;n",
summary:   "Reducir un conjunto de posibles acciones de mejora a las &uacute;nicas dos que el equipo probar&aacute;",
desc:      "Repartir post-its y marcadores. Pedir a todo el equipo que escriba dos acciones \
que les gustar&iacute;a intentar el siguiente sprint, siendo lo m&aacute;s concreto posible \
(<a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART</a>). \
A continuaci&oacute;n pedir al grupo que trabaje en parejas y que fusionen sus acciones \
en una sola lista de dos acciones. Despu&eacute;s las parejas formar&aacute;n grupos \
de 4 y posteriormente de 8. Finalmente recopilar las acciones de cada grupo y pedir que \
la  gente vote por las dos finalistas. ",
source:    "Lydia Grawunder & Sebastian Nachtigall",
duration:  "15-30 personas",
photo:    "<a href='http://1.bp.blogspot.com/-dLemopaMJ9o/UhKRRRBMFkI/AAAAAAAAC78/6hH5yQKucYA/s320/photo+4(1).JPG' \
rel='lightbox[activity21]' title='Contribuci&oacute;n de Paulo Caroli'>ver Foto</a>",
suitable: "iteraci&oacute;n, entrega, proyecto y grupos grandes"
};

all_activities[21] = {
phase:     0,
name:      "Tomar la Temperatura",
summary:   "Los participantes registran su temperatura (estado de &aacute;nimo) en una pizarra",
desc:      "Preparar una pizarra con el dibujo de un term&oacute;metro con temperaturas desde congelado \
hasta muy caliente pasando por la temperatura del cuerpo. \
Cada participante va marcando su temperatura (estado de &aacute;nimo) en la pizarra.",
source:  "Desconocido",
photo: "<a href='static/images/activities/22_Temperature-Reading.jpg' rel='lightbox[activity22]' title='Contribuci&oacute;n por Weronika Kedzierska'>Ver Foto</a>"
};

all_activities[22] = {
phase:     4,
name:      "La puerta del feedback - Caritas",
summary:   "Medir r&aacute;pidamente la satisfacci&oacute;n de los participantes con la retrospectiva usando caritas.",
desc:      "Dibujar un ':)', ':|', y ':(' en una hoja y p&eacute;garla en la puerta. \
Cuando termine la retrospectiva, pedir que los participantes registren su satisfacci&oacute;n \
con la sesi&oacute;n con una 'x' debajo de la carita correspondiente.",
source:    "<a href='http://boeffi.net/tutorials/roti-return-on-time-invested-wie-funktionierts/'>Boeffi</a>",
photo:    "<a href='static/images/activities/23_Feedback-Door-Smilies.jpg' rel='lightbox[activity23]' title='Contribución de by Philipp Flenker'>Ver Foto</a>",
duration:  "2-3",
suitable: "iteraci&oacute;n y grupos grandes"
};

all_activities[23] = {
phase:     3,
name:      "Lista Abierta de Acciones",
summary:   "Los participantes proponen y se comprometen con acciones",
desc:      "Preparar una pizarra con tres columnas tituladas ‘Que’, ‘Quien’ y ‘Cuando’. \
Preguntar uno a uno a los participantes qu&eacute;  quieren hacer para mejorar al equipo. \
Escribir la tarea, acordar una fecha de finalizaci&oacute;n y dejar que el responsable firme con su nombre. <br>\
Si alguien propone una tarea para todo el equipo, tiene que conseguir el compromiso (y la firma) \
de todos los dem&aacute;s.",
source:    source_findingMarbles + ", inspirado por \
<a href='http://lwscologne.wordpress.com/2012/05/08/11-treffen-der-limited-wip-society-cologne/#Retrospektiven'>esta lista</a>",
duration:  "10-15 personas",
suitable: "iteraci&oacute;n, entrega, grupos peque&ntilde;os"
};

all_activities[24] = {
phase:     2,
name:      "Diagrama de Causa-Efecto",
summary:   "Encontrar el origen de los problemas cuya ra&iacute;z es dif&iacute;cil de localizar y fuente de eternos debates",
desc:      "Escribir el problema a abordar en un post-it y p&eacute;garlo en mitad de una pizarra. \
Investigar porqu&eacute; es un problema preguntando repetidamente ‘&iquest;Y qu&eacute;?’. \
Averiguar las causas ra&iacute;z del problema preguntando repetidamente ‘&iquest;Por qu&eacute; (pasa esto)?’. \
Documentar las conclusiones escribi&eacute;ndolas en m&aacute;s post-its y mostrando las relaciones de causa con flechas. \
Cada post-it puede tener m&aacute;s de una raz&oacute;n y m&aacute;s de una consecuencia.<br>\
Los c&iacute;rculos viciosos suelen ser buenos puntos de partida para proponer acciones. \
Romper su mala influencia permite mejorar mucho.",
source:    "<a href='http://blog.crisp.se/2009/09/29/henrikkniberg/1254176460000'>Henrik Kniberg</a>",
more:      "<a href='http://finding-marbles.com/2011/08/04/cause-effect-diagrams/'>Corinna's experiences</a>",
duration:  "20-60 complejidad",
photo:    "<a href='http://www.plans-for-retrospectives.com/static/images/activities/25_Cause-Effect-Diagramm.jpg' rel='lightbox[activity25]' title='Contribuci&oacute;n de Corinna Baldauf'>Ver Foto</a>\
           <a href='static/images/activities/25_Cause-Effect-Diagram-2.jpg' rel='lightbox[activity25]' title='Contribución de Philipp Flenker'></a>",
suitable: "entrega, proyecto, grupos peque&ntilde;os, complejo"
};

all_activities[25] = {
phase:     2,
name:      "Speed Dating",
summary:   "Cada miembro del equipo indaga en profundidad sobre un tema en una serie de charlas cara a cara",
desc:      "Cada participante escribe un tema que quiera explorar, o sea algo que le gustar&iacute;a cambiar. \
A continuaci&oacute;n formar parejas y distribuirlas en toda la sala. \
Cada pareja debate sobre ambos temas para establecer posibles acciones a tomar \
- 5 minutos por participante (tema) - uno detr&aacute;s de otro. \
Despu&eacute;s de 10 minutos las parejas se separan para crear nuevas parejas. \
Contin&uacute;ar hasta que todos hayan hablado con todos. <br>\
Si el grupo tiene un n&uacute;mero impar de miembros, el facilitador \
es parte de una de las parejas pero su compa&ntilde;ero tiene 10 minutos por tema.",
source:    source_kalnin,
duration:  "10 por persona",
suitable: "iteraci&oacute;n, entrega, grupos peque&ntilde;os"
};

all_activities[26] = {
phase:     5,
name:      "Las Galletas-Retrospectiva",
summary:   "Llevar al equipo afuera para comer y generar debate con las ‘Galletas-Retrospectiva’ (galletas de la fortuna)",
desc:      "Invitar al equipo a comer afuera, preferiblemente en restaurante chino si quieres mantener el tema ;) <br>\
Repartir las galletas de la fortuna (galletas chinas que contienen un mensaje escrito) \
y recorrer toda la mesa abri&eacute;ndolas y debatiendo sobre su contenido. \
Ejemplos de mensaje de las galletas de la fortuna: \
<ul>\
    <li>&iquest;Qu&eacute; fue la cosa m&aacute;s efectiva que hiciste en este sprint y por qu&eacute; fue tan positivo?</li>\
    <li>&iquest;Cumple el diagrama de burndown con la realidad? &iquest;Por qu&eacute; la cumple / no la cumple?</li>\
    <li>&iquest;Contribuyes a la comunidad de desarrolladores desde tu empresa? &iquest;C&oacute;mo podr&iacute;as contribuir?</li>\
    <li>&iquest;Cu&aacute;l fue el mayor impedimento del equipo en este sprint?</li>\
</ul>\
Puedes <a href='http://weisbart.com/cookies/'>Comprar las 'Galletas-Retrospectiva' en Weisbart</a> \
o cocinar las tuyas, por ejemplo si el ingl&eacute;s no es el idioma nativo del equipo.",
source:    "<a href='http://weisbart.com/cookies/'>Adam Weisbart</a>",
duration:  "90-120",
suitable: "iteraci&oacute;n, entrega, grupos peque&ntilde;os"
};

all_activities[27] = {
phase:     5,
name:      "Dar un paseo",
summary:   "Ir al parque m&aacute;s cercano, dar una vuelta y simplemente hablar",
desc:      "&iquest;Hace buen tiempo fuera? Entonces no hay por qu&eacute; quedar encerrado en la oficina, \
si al pasear el cerebro se llena con ox&iacute;geno y nuevas ideas. \
Salir y dar una vuelta al parque m&aacute;s cercano. \
La conversaci&oacute;n girar&aacute; naturalmente entorno al trabajo. <br>\
Es una buena forma de salir de la rutina cuando las cosas est&aacute;n yendo bien y \
no se necesita documentaci&oacute;n visual para apoyar el debate. \
Los equipos maduros pueden f&aacute;cilmente compartir ideas y llegar a consensos incluso en ambientes informales.",
source:    source_findingMarbles,
duration:  "60-90",
suitable: "iteraci&oacute;n, entrega, grupos peque&ntilde;os, viento en popa, maduros"
};

all_activities[28] = {
phase:     3,
name:      "C&iacute;rculo de Influencia",
summary:   "Generar acciones en función del nivel de control que el equipo tenga para ejecutarlas",
desc:      "Preparar una pizarra con tres c&iacute;rculos conc&eacute;ntricos, lo suficientemente \
grandes para poner post-its en ellos. \
Nombrar los c&iacute;rculos de adentro hacia afuera: \
<ul>\
    <li>El equipo controla - Acciones directas</li>\
    <li>El equipo influencia - Acciones sugeridas</li>\
    <li>El resto - Acciones reactivas</li>\
</ul>\
Recolectar la lista de ideas generadas en la anterior fase de la retrospectiva y ub&iacute;carlas en el c&iacute;rculo que corresponda. \
En pareja, los participantes redactan las posibles acciones para cada idea. \
Alentarlos a centrarse en acciones dentro de su c&iacute;rculo de influencia. \
Las parejas pegan luego sus acciones cerca de las ideas correspondientes y las leen al grupo. \
Acordar los planes de acciones a probar (a trav&eacute;s de debate, votaci&oacute;n por mayoría, votaci&oacute;n por punto, etc.)",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/07/26/circles-and-soup/'>Diana Larsen</a> \
lo adapt&oacute; del libro 'Seven Habits of Highly Effective People' de Stephen Covey y \
'<a href='http://www.ayeconference.com/wiki/scribble.cgi?read=CirclesOfControlInfluenceAndConcern'>Circle of Influence And Concern</a>' de Jim Bullock",
suitable: "iteraci&oacute;n, entrega, proyecto, estancado, inmaduro"
};

all_activities[29] = {
phase:     5,
name:      "Hojas de Di&aacute;logo",
summary:   "Un enfoque estructurado para el debate",
desc:      "Una hoja de di&aacute;logo se parece a un juego de mesa. \
Existen <a href='http://www.softwarestrategy.co.uk/dlgsheets/available.html'> varias hojas de dialogo disponibles</a>. \
Eligir una, imprimirla lo m&aacute;s grande posible (tama&ntilde;o A1 si puede ser) y seguir las instrucciones.",
source:    "<a href='http://www.softwarestrategy.co.uk/dlgsheets/available.html'>Allen Kelly at Software Strategy</a>",
duration:  "90-120",
suitable: "iteraci&iacute;n, entrega, proyecto"
};

all_activities[30] = {
phase:     0,
name:      "Check In - Dibujar la Iteraci&oacute;n",
summary:   "Los participantes dibujan alg&uacute;n aspecto de la iteraci&oacute;n",
desc:      "Repartir post-its y marcadores. Definir un tema, por ejemplo: \
<ul>\
    <li>&iquest;C&oacute;mo te sentiste durante la iteraci&oacute;n?</li>\
    <li>&iquest;Cu&aacute;l fue el momento m&aacute;s destacable?</li>\
    <li>&iquest;Cu&aacute;l fue el problema m&aacute;s importante?</li>\
    <li>&iquest;Qu&eacute hubieras esperado?</li>\
</ul>\
Pedir a los miembros del equipo dibujar su respuesta. \
Pegar todos los dibujos en la pizarra. \
Para cada dibujo, dejar que los participantes adivinen lo que significa antes \
de que el artista lo explique.<br> \
Las met&aacute;foras abren nuevos puntos de vista y crean un entendimiento compartido.",
source:    source_findingMarbles + ", adaptado de \
           <a href='http://vinylbaustein.net/2011/03/24/draw-the-problem-draw-the-challenge/'>Thorsten Kalnin</a> \
           y Olivier Gourment",
photo:    "<a href='static/images/activities/31_Draw-Iteration.jpg' rel='lightbox[activity31]' title='Contribuci&oacute;n de Eric Lannemajou'>Ver Foto</a>",
duration:  "5 + 3 per person",
suitable: "iteraci&oacute;ion, entrega, proyecto"
};

all_activities[31] = {
phase:     0,
name:      "Medidor de Proyecto con Caritas",
summary:   "Ayudar a los miembros del equipo a expresar sus sentimientos respecto al proyecto y tratar sus causas ra&iacute;z tempranamente",
desc:      "Preparar una pizarra con caritas expresando distintas emociones como por ejemplo: \
<ul>\
    <li>sorprendido</li> \
    <li>nervioso / estresado</li> \
    <li>limitado / restringido</li> \
    <li>confundido</li> \
    <li>contento</li> \
    <li>enojado</li> \
    <li>sobrepasado</li> \
</ul>\
Dejar que cada miembro del equipo elija c&oacute;mo se siente respecto al proyecto. \
Es una manera divertida y eficaz para hacer emerger los problemas tempranamente. \
Se pueden trabajar en las fases siguientes de la retrospectiva.",
source:    "Andrew Ciccarelli",
duration:  "10 for 5 people",
photo:    "<a href='static/images/activities/32_Emoticons.jpg' rel='lightbox[activity32]' \
title='Contribuci&oacute;n de Ruud Rietveld'>Ver Foto</a>",
suitable: "iteraci&oacute;n, entrega"
};

all_activities[32] = {
phase:     1,
name:      "Orgulloso & Arrepentido",
summary:   "&iquest;De qu&eacute; se sienten orgullosos o arrepentidos los miembros del equipo?",
desc:      "Preparar dos rotafolios con los titulos ‘orgulloso’ y ‘arrepentido’. \
Los participantes escriben un tema por post-it. \
Cuando se termina el tiempo cada uno lee sus post-its y los ubica en los rotafolios. <br>\
Disparar un peque&ntilde;o debate preguntando por ejemplo: \
<ul>\
    <li>&iquest;Hay algo que te sorprendió?</li> \
    <li>&iquest;Qu&eacute; tendencias aparecen? &iquest;Qu&eacute; significan para el equipo?</li>\
</ul>",
source:    source_agileRetrospectives,
duration:  "10-15",
suitable: "iteraci&oacute;n, entrega"
};

all_activities[33] = {
phase:     4,
name:      "La Ducha de Agradecimientos",
summary:   "Escucha lo que dicen otros a tus espaldas (y solo lo bueno)",
desc:      "Formar grupos de 3. Cada grupo ubica sus sillas para que 2 sillas se enfrenten \
y que la tercera le de la espalda, algo como: >^<. <br>\
Las dos personas en sillas enfrentadas hablan de la tercera durante 2 minutos. \
Deben decir &uacute;nicamente cosas positivas y nada de lo que dicen puede \
minimizarse diciendo otras cosas posteriormente. <br>\
Hacer 3 vueltas para que todos pasen por la ducha una vez.",
source:    '<a href="http://www.miarka.com/de/2010/11/shower-of-appreciation-or-talking-behind-ones-back/">Ralph Miarka</a>',
duration:  "10-15",
suitable: "iteraci&oacute;n, entrega, equipoMaduro"
};

all_activities[34] = {
phase:     1,
name:      "Auto-Evaluaci&oacute;n &Aacute;gil",
summary:   "Evaluen c&oacute;mo est&aacute;n con un checklist",
desc:      "Imprimir el checklist que m&aacute;s le guste, por ejemplo:\
<ul>\
    <li><a href='http://www.crisp.se/gratis-material-och-guider/scrum-checklist'>El excelente Checklist de Scrum de Henrik Kniberg</a></li>\
    <li><a href='http://finding-marbles.com/2011/09/30/assess-your-agile-engineering-practices/'>Auto-Evaluaci&oacute;n de pr&aacute;cticas &aacute;giles t&eacute;cnicas</a></li>\
    <li><a href='http://agileconsortium.blogspot.de/2007/12/nokia-test.html'>Nokia Test</a></li>\
</ul>\
Revisar cada punto en equipo para debatir c&oacute;mo est&aacute;n al respecto y si est&aacute;n avanzando \
en la buena direcci&oacute;n. <br>\
Es una buena actividad luego de una iteraci&oacute;n sin eventos importantes.",
source:    source_findingMarbles,
photo:    "<a href='static/images/activities/35_Agile-Self-Assessment.jpg' rel='lightbox[activity35]' title='Contribuci&oacute;n de Philipp Flenker'>Ver Foto</a>",
duration:  "10-25 minutos de acuerdo al checklist",
suitable: "equiposPeque&ntilde;os, iteraci&oacute;n, entrega, proyecto, vamosBien"
};

all_activities[35] = {
phase:     0,
name:      "Objetivo Positivo",
summary:   "Definir un objetivo positivo para la sesión",
desc:      "Concentrarse en aspectos positivos y no en problemas definiendo \
un objetivo afirmativo, por ejemplo: \
<ul>\
    <li>Busquemos caminos para consolidar nuestras fortalezas en procesos y \
trabajo en equipo</a></li>\
    <li>Busquemos como ampliar nuestros mejores usos \
de pr&aacute;ctica t&eacute;cnicas</li>\
    <li>Miremos nuestras mejores relaciones de trabajo y encontremos \
formas de extenderlas</li>\
    <li>Descubramos donde aportamos m&aacute;s valor en nuestra &uacute;ltima \
iteraci&oacute;n para incrementar el valor que aportaremos en la pr&oacute;xima </li>\
</ul>",
source:    "<a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
duration:  "3 minutos",
suitable: "iteraci&oacute;n, entrega, proyecto"
};

all_activities[36] = {
phase:     2,
name:      "Acuerdate del Futuro",
summary:   "Imagina que la pr&oacute;xima iteraci&oacute;n sali&oacute; perfecta. &iquest;C&oacute;mo fue? &iquest;Qu&eacute; hicieron?",
desc:      "'Imaginen que pudieran viajar al final de la pr&oacute;xima iteraci&oacute;n (o entrega). \
Aprenden que fue la mejor y m&aacute;s productiva iteraci&oacute;n hasta el momento. \
&iquest;C&oacute;mo sus futuros seres se la describir&iacute;an? \
&iquest;Qu&eacute; ver&iacute;an y escuchar&iacute;an?'<br>\
Dar al equipo un tiempo para imaginar esta situaci&oacute;n y anotar algunas palabras claves para ayudar su memoria. \
Luego pedir a todos que describan su visi&oacute;n de la iteraci&oacute;n perfecta.<br>\
Seguir con '&iquest;Cu&aacute;les fueron los cambios que implementamos que resultaron en un futuro tan productivo y satisfactorio?' \
Escribir las respuestas en post-its para usarlas en la pr&oacute;xima fase de la retrospectiva.",
source:    "<a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
suitable: "iteraci&oacute;n, entrega, proyecto"
};

all_activities[37] = {
phase:     3,
name:      "Voto con Puntos - Mantener, Parar, Agregar",
summary:   "Hacer una lluvia de ideas para identificar los comportamientos a mantener, parar e iniciar y elegir los mejores", 
desc:      "Dividir una pizarra en columnas intituladas ‘Mantener’, Parar’ e ‘Iniciar. \
Pedir a los participantes escribir propuestas concretas para cada categor&iacute;a \
- 1 idea por post-it. Dejar unos minutos para que escriban en silencio. \
Pedir a todos que lean sus ideas y las ubiquen en la categor&iacute;a correspondiente. \
Facilitar un peque&ntilde;o debate sobre cuales son el 20% de las ideas m&aacute;s beneficiosas. \
Los participantes votan las ideas con puntos, por ejemplo cada persona tiene 1,2 o 3 puntos a distribuir entre las ideas. \
Las top 2 o 3 ideas ser&aacute;n las acciones elegidas.",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteraci&oacute;n,"
};

all_activities[38] = {
phase:     3,
name:      "Votos con Puntos - Funcion&oacute; bien, Hacer distinto",
summary:   "Lluvia de ideas de lo que funcion&oacute; bien y que se puede hacer distinto, eligiendo luego las mejores iniciativas", 
desc:      "Armar dos rotafolios con ‘Funcion&oacute; bien’ y ‘Hacer distinto la pr&oacute;xima vez'. \
Pedir a los participantes escribir propuestas concretas para cada categor&iacute;a \
(1 idea por post-it). Dejar unos minutos para que escriban en silencio. \
Pedir a todos que lean sus ideas y las ubiquen en la categor&iacute;a correspondiente. \
Facilitar un peque&ntilde;o debate sobre cuales son el 20% de las ideas m&aacute;s beneficiosas. \
Los participantes votan las ideas con puntos, por ejemplo cada persona tiene 1,2 o 3 puntos a distribuir entre las ideas. \
Las top 2 o 3 ideas ser&aacute;n las acciones elegidas.",
source:    source_agileRetrospectives,
duration:  "15-30",
suitable: "iteraci&oacute;n,"
};

all_activities[39] = {
phase:     4,
name:      "M&aacute;s & Delta",
summary:   "Cada participante escribe una cosa que le gust&oacute; y una que cambiar&iacute;a de la retro",
desc:      "Preparar una pizarra con 2 columnas: 'M&aacute;s' y 'Delta'. \
Pedir a cada participante que escriba 1 aspecto de la retrospectiva que le gust&oacute; \
y una cosa que cambiar&iacute;a (en post-its separados). \
Ubicar los post-its donde corresponde y repasarlos brevemente para clarificar \
lo necesario y detectar la preferencia de la mayor&iacute;a cuando se presentan \
puntos de vista muy opuestos.",
source:    "<a href='http://agileretrospectivewiki.org/index.php?title=Weekly_Retrospective_Simple_%2B_delta'>Rob Bowley</a>",
duration:  "5-10",
suitable: "iteraci&oacute;n, proyecto"
};

all_activities[40] = {
phase:     2,
name:      "El Banco de la Plaza",
summary:   "Debate grupal variando los participantes",
desc:      "Ubicar entre 4 y 6 sillas en l&iacute;nea frente al grupo. \
Explicar las reglas: <ul>\
    <li>Sentarse en una silla cuando se quiere contribuir con el debate</li>\
    <li>Una de las sillas siempre debe estar vac&iacute;a</li>\
    <li>Cuando se ocupa la &uacute;ltima silla, alguien debe liberar una de las otras sillas inmediatamente</li>\
</ul>\
Sentarse en una de las sillas para lanzar el debate, preguntando en voz alta sobre \
una cosa que aprendi&oacute; en la iteraci&oacute;n hasta que alguien se sume. \
Cerrar la actividad cuando el debate se est&eacute cayendo. \
<br>Es una variante de 'Fish Bowl'. Funciona bien con grupos de 10 a 25 personas.",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/08/24/park-bench/'>Diana Larsen</a>",
duration:  "15-30",
suitable: "iteraci&oacute;n, proyecto, gruposGrandes"
};

all_activities[41] = {
phase:     0,
name:      "Cartas Postales",
summary:   "Los participantes eligen una carta postal que represente sus pensamientos / sentimientos",
desc:      "Tener una pila de cartas postales variadas, por lo menos 4 veces la cantidad de participantes. \
Esparcirlas en toda la sala y pedir a cada persona que elija la que mejor represente \
su opin&oacute;n de la &uacute;ltima iterac&oacute;n. \
Luego deben escribir en un post-it 3 palabras clave describiendo la carta postal, o sea la iteraci&oacute;n. \
De a uno muestran su carta postal y su post-it, explicando su elecci&oacute;n.",
source:    "<a href='http://finding-marbles.com/2012/03/19/retrospective-with-postcards/'>Corinna Baldauf</a>",
duration:  "15-20",
suitable: "iteraci&oacute;n, entrega, proyecto",
photo:    "<a href='http://findingmarblesdotcom.files.wordpress.com/2012/03/retrospective-with-postcards3.jpg' rel='lightbox[activity41]' title='Contribuci&oacute;n de Corinna Baldauf'>Ver Photo</a>"
};

all_activities[42] = {
phase:     0,
name:      "Tomar Posici&oacute;n - Apertura",
summary:   "Los participantes toman una posici&oacute;n, indicando su satisfacci&oacute;n con respecto a la iteraci&oacute;n",
desc:      "Crear una gran regla (p. e. una l&iacute;nea larga) sobre el piso con cinta adhesiva. \
Marcar un extremo como 'Genial' y el otro como 'Malo'. Pedir que los participantes se paren en la l&iacute;nea de acuerdo \
a su satisfacci&oacute;n con respecto a la &uacute;ltima iteraci&oacute;n. \
Psicol&oacute;gicamente, tomar una posici&oacute;n de forma f&iacute;sica es diferente a solo expresarse. \
Es m&aacute;s 'real'. <br>\
Se puede reutilizar la misma l&iacute;nea de cinta, en caso de cerrar la retro con la actividad #44.",
source:    source_findingMarbles + ", inspirado por <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
duration:  "2-5",
suitable: "iteration, release, project"
};

all_activities[43] = {
phase:     4,
name:      "Tomar Posici&oacute;n - Clausura",
summary:   "Los participantes toman una posici&oacute;n, indicando su satisfacci&oacute;n con respecto a la retrospectiva",
desc:      "Crear una gran regla (p. e. una l&iacute;nea larga) sobre el piso con cinta adhesiva. \
Marcar un extremo como 'Genial' y el otro como 'Malo'. Pedir que los participantes se paren en la l&iacute;nea de acuerdo \
a su satisfacci&oacute;n con respecto a la &uacute;ltima retrospectiva. \
Psicol&oacute;gicamente, tomar una posici&oacute;n de forma f&iacute;sica es diferente a solo expresarse. \
Es m&aacute;s 'real'. <br>\
Mirar la actividad #43 para comenzar la retrospectiva utilizando la misma l&iacute;nea.",
source:    source_findingMarbles + ", inspirado por <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
duration:  "2-5",
suitable: "iteration, release, project"
};

all_activities[44] = {
phase:     4,
name:      "Satisfecho y Sorprendido",
summary:   "&iquest;Qu&eacute; dej&oacute; satifechos y/o sorprendidos a los participantes de la retrospectiva?",
desc:      "Armar una ronda con los miembros del equipo y pedir que cada participante se&ntilde;ale algo que le haya gustado \
o sorprendido (o ambos).",
source:    source_unknown,
duration:  "5",
suitable: "iteration, release, project"
};

all_activities[45] = {
phase:     0,
name:      "&iquest;Por qu&eacute; las retrospectivas&quest;",
summary:   "Preguntar '&iquest;Por qu&eacute; hacemos retrospectivas&quest;'",
desc:      "Volver a las ra&iacute;ces y comenzar la retrospectiva preguntado '&iquest;Por qu&eacute; hacemos esto&quest;' Anotar las respuestas para que las vean todos. Podr&iacute;a ser sorprendente.",
source:    "<a href='http://proessler.wordpress.com/2012/07/20/check-in-activity-agile-retrospectives/'>Pete Roessler</a>",
duration:  "5",
suitable: "iteration, release, project"
};

all_activities[46] = {
phase:     1,
name:      "Vaciar el Buz&oacute;n",
summary:   "Mirar las notas recolectadas durante el sprint",
desc:      "Armar el 'buz&oacute;n de retrospectiva' al inicio de la iteraci&oacute;n. \
Cuando algo significante ocurre o alguien tiene una idea de mejora, se escribe y se deposita en el buz&oacute;n. \
(Como alternativa, el 'buz&oacute;n' puede ser un lugar visible. Esto puede provocar debates durante la iteraci&oacute;n)<br>\
Repasar todas las notas y discutirlas.<br>\
El buz&oacute;n es ideal para iteraciones largas o equipos con mala memoria.",
source:    source_skycoach,
more:      "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Art&iacute;culo original</a>",
duration:  "15",
suitable: "release, project"
};

all_activities[47] = {
phase:     3,
name:      "Tomar Posici&oacute;n - El Baile de la L&iacute;nea",
summary:   "Sondear la opini&oacute;n de cada persona y lograr consenso",
desc:      "Cuando un equipo no puede decidirse entre dos opciones, crear una larga l&iacute;nea \
en el suelo con cinta adhesiva. Marcar un extremo con la opci&oacute;n A) y el otro con la opci&oacute;n B). \
Los miembros del equipo se posicionan en la l&iacute;nea de acuerdo a sus preferencias por alguna de las opciones. \
Refinar las opciones hasta que una de las dos obtenga una clara mayor&iacutea.",
source:    source_skycoach,
more:      "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Art&iacute;culo original</a>",
duration:  "5-10 por desici&oacute;n",
suitable: "iteration, release, project"
};

all_activities[48] = {
phase:     3,
name:      "Votar con Puntos - Estrella de Mar",
summary:   "Recolectar que se quiere empezar a hacer, dejar de hacer, mantener, hacer m&aacute;s o hacer menos",
desc:      "Dibujar cinco rayos en un rotafolio, dividi&eacute;ndolo en cinco segmentos. \
Etiquetarlos con 'Comenzar', 'Dejar de hacer', 'Mantener', 'Hacer m&aacute;s' y 'Hacer menos'. \
Los participantes escriben sus propuestas en post-its y las colocan \
en el segmento que corresponda. Despu&eacute;s de agrupar las que apunten \
a la misma idea, votar con puntos las sugerencias a probar.",
source:    "<a href='http://www.thekua.com/rant/2006/03/the-retrospective-starfish/'>Pat Kua</a>",
duration:  "15 min",
suitable:  "iteration, release, project"
};

all_activities[49] = {
phase:     2,
name:      "Deseo Concedido",
summary:   "Un hada te concede un deseo - &iquest;C&oacute;mo sabes que se volvi&oacute; realidad?",
desc:      "Dar a los participantes 2 minutos para que en silencio reflexionen sobre la siguiente cuesti&oacute;n: \
'Una hada te concede el deseo de arreglar durante la noche tu problema m&aacutes grande en el trabajo. \
&iquest;Cu&aacute;l es tu deseo?' <br>\
Continuar con: 'Llegas al trabajo la ma&ntilde;ana siguiente. Se nota que el hada te ha concedido el deseo. \
&iquest;C&oacutemo te das cuenta? &iquest;Qu&eacute ves diferente ahora?' <br>\
Si la confianza con el grupo es elevada, dejar que cada uno describa \
su 'Deseo concedido/Lugar de Trabajo'. Si no, simplemente decirles a los participantes que mantengan su \
escenario en mente durante la siguiente fase y sugieran acciones que permitan hacerlo real.",
source:    "Lydia Grawunder &amp; Sebastian Nachtigall",
duration:  "15 min",
suitable:  "iteration"
};
