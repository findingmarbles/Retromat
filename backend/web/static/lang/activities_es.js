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
source:  source_agileRetrospectives
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
summary:   "El equipo hace una tormenta de ideas en 4 categor&iacute;as para enumerar r&aacute;pidamente asuntos",
desc:      "Despu&eacute;s de haber debatido los datos de la fase 2, mostrar un rotafolio con 4 cuadrantes: \
':)', ':(', 'Idea', y 'Reconocimiento'. Repartir post-its. \
<ul>\
    <li>Los miembros del equipo pueden agregar sus entradas en cualquier cuadrante. Un tema por post-it. </li>\
    <li>Agrupar post-its relacionados.</li>\
    <li>Dar 6-10 puntos por persona para que voten los asuntos de mayor importancia.</li>\
</ul>\
Esta lista sirve de entrada para la fase 4.",
source:    source_agileRetrospectives,
duration:  "20-25",
suitable: "iteraci&oacute;n"
};

all_activities[9] = {
phase:     2,
name:      "Tormenta de Ideas / Filtro",
summary:   "Generar muchas ideas y aplicarles filtros",
desc:      "Explicar las reglas de la tormenta de ideas y su objetivo: \
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
summary:   "Tormenta de ideas sobre que empezar, parar & continuar, y luego elegir las mejores iniciativas", 
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
source:    source_innovationGames + ", encontrado a <a href='http://leadinganswers.typepad.com/leading_answers/2007/10/calgary-apln-pl.html'>Mike Griffiths</a>",
duration:  "10-15 groupSize",
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
suitable: "iteraci&oacute;n, entrega, proyecto y grupos grandes"
};

all_activities[21] = {
phase:     0,
name:      "Tomar la Temperatura",
summary:   "Los participantes registran su temperatura (estado de &aacute;nimo) en una pizarra",
desc:      "Preparar una pizarra con el dibujo de un term&oacute;metro con temperaturas desde congelado \
hasta muy caliente pasando por la temperatura del cuerpo. \
Cada participante va marcando su temperatura (estado de &aacute;nimo) en la pizarra.",
source:  "Desconocido"
};

all_activities[22] = {
phase:     4,
name:      "La puerta del feedback - Caritas",
summary:   "Medir r&aacute;pidamente la satisfacci&oacute;n de los participantes con la retrospectiva usando caritas.",
desc:      "Dibujar un ':)', ':|', y ':(' en una hoja y p&eacute;garla en la puerta. \
Cuando termine la retrospectiva, pedir que los participantes registren su satisfacci&oacute;n \
con la sesi&oacute;n con una 'x' debajo de la carita correspondiente.",
source:    "<a href='http://boeffi.net/tutorials/roti-return-on-time-invested-wie-funktionierts/'>Boeffi</a>",
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
Existen <a href='http://allankelly.net/dlgsheets/'> varias hojas de dialogo disponibles</a>. \
Eligir una, imprimirla lo m&aacute;s grande posible (tama&ntilde;o A1 si puede ser) y seguir las instrucciones.",
source:    "<a href='http://allankelly.net/dlgsheets/'>Allen Kelly at Software Strategy</a>",
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
source:    source_innovationGames + ", encontrado a <a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
suitable: "iteraci&oacute;n, entrega, proyecto"
};

all_activities[37] = {
phase:     3,
name:      "Voto con Puntos - Mantener, Parar, Agregar",
summary:   "Hacer una tormenta de ideas para identificar los comportamientos a mantener, parar e iniciar y elegir los mejores",
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
summary:   "Tormenta de ideas de lo que funcion&oacute; bien y que se puede hacer distinto, eligiendo luego las mejores iniciativas",
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
suitable: "iteraci&oacute;n, entrega, proyecto"
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

all_activities[50] = {
phase:     1,
name:      "Caf&eacute; Lean",
summary:   "Usar el formato Caf&eacute; Lean para una discusi&oacute;n de los temas principales",
desc:      "Decidir cu&aacute;nto tiempo se va a invertir en esta actividad, explicar las reglas del caf&eacute; lean para retrospectivas: <ul>\
    <li>Cada participante escribe temas de los que desea discutir, un tema por post-it</li>\
    <li>Pegar los post-its en una pizarra. La persona que propuso el tema lo explica en una o dos oraciones. \
Agrupar los post-its que sean del mismo tema.</li>\
    <li>Cada participante vota por dos temas que le gustar&iacute;a discutir.</li>\
    <li>Ordenar los post-its de acuerdo a los votos.</li>\
    <li>Comenzar con el tema de mayor inter&eacute;s.</li>\
    <li>Poner una alarma a los 5 minutos. Cuando suena todos votan con pulgares arriba o abajo. \
Mayor&iacute;a de pulgares hacia arriba: se trabaja durante 5 minutos m&aacute;s en el tema. Mayor&iacute;a de pulgares hacia abajo: \
se pasa al siguiente tema. </li>\
</ul> Continuar hasta que se acabe el tiempo establecido.",
source:    "<a href='http://leancoffee.org/'>Descripci&oacute;n original</a> y \
<a href='http://finding-marbles.com/2013/01/12/lean-altbier-aka-lean-coffee/'>en acci&oacute;n</a>",
duration:  "20-40 min",
suitable:  "iteration"
};

all_activities[51] = {
phase:     0,
name:      "Constelaciones - Apertura",
summary:   "Dejar que los participantes apoyen o rechacen declaraciones movi&eacute;ndose",
desc:      "Armar un c&iacute;rculo o una esfera en el medio de un espacio libre. Pedir al equipo que se junte alrededor del c&iacute;rculo. \
Explicar que el c&iacute;rculo es el centro de la aprobaci&oacute;n: Si est&aacute;n de acuerdo con la declaraci&oacute;n se \
deber&iacute;a mover hacia &eacute;l, si no lo est&aacute;n, deber&iacute;a moverse tan lejos como su nivel de desacuerdo. \
Ahora leer las declaraciones, por ejemplo:\
<ul>\
    <li>Siento que puedo hablar abiertamente en esta retrospectiva</li>\
    <li>Estoy satisfecho con el &uacute;ltimo sprint</li>\
    <li>Estoy feliz con la calidad de nuestro c&oacutedigo</li>\
    <li>Creo que nuestro proceso de integraci&oacute;n continua est&aacute; maduro</li>\
	</ul>\
Observar las constelaciones que se forman. Luego preguntar qu&eacute constelaci&oacute;n sorprendi&oacute; m&aacute;s.<br>\
Esta puede ser tambi&eacute;n una actividad de cierre (#53).",
source:    "<a href='http://www.coachingagileteams.com/'>Lyssa Adkins</a> via \
<a href='https://luis-goncalves.com/agile-retrospective-set-the-stage/'>Luis Goncalves</a>",
duration:  "10 min",
suitable:  "iteration, project, release"
};

all_activities[52] = {
phase:     4,
name:      "Constelaciones - Cierre",
summary:   "Dejar que los participantes eval&uacute;en la retrospectiva movi&eacute;ndose",
desc:      "Armar un c&iacute;rculo o una esfera en el medio de un espacio libre. Pedir al equipo que se junte alrededor del c&iacute;rculo. \
Explicar que el c&iacute;rculo es el centro de la aprobaci&oacute;n: Si est&aacute;n de acuerdo con la declaraci&oacute;n se \
deber&iacute;a mover hacia &eacute;l, si no lo est&aacute;n, deber&iacute;a moverse tan lejos como su nivel de desacuerdo. \
Ahora leer las declaraciones, por ejemplo:\
<ul>\
    <li>Hablamos de lo m&aacute;s importante para mi</li>\
    <li>Hoy habl&eacute; abiertamente</li>\
    <li>Creo que el tiempo de la retrospectiva fue bien invertido</li>\
    <li>Conf&iacute;o que vamos a ejecutar las acciones acordadas</li>\
	</ul>\
Observar las constelaciones que se forman. Luego preguntar qu&eacute constelaci&oacute;n sorprendi&oacute; m&aacute;s.<br>\
Esta puede ser tambi&eacute;n una actividad de apertura (#52).",
source:    "<a href='http://www.coachingagileteams.com/'>Lyssa Adkins</a> via \
<a href='https://luis-goncalves.com/agile-retrospective-set-the-stage/'>Luis Goncalves</a>, \
<a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
duration:  "5 min",
suitable:  "iteration, project, release"
};

all_activities[53] = {
phase:     1,
name:      "Los Oscars de las Historias",
summary:   "El equipo nomina historias para los premios y reflexiona sobre las ganadoras",
desc:      "Mostrar todas las historias de usuarios completadas en los &uacute;ltimos sprints en una pizarra. \
Crear 3 categor&iacute;as de premio (por ejemplo con secciones en la pizarra):\
<ul>\
    <li>La mejor historia</li>\
    <li>La historia más aburrida</li>\
    <li>... otra categor&iacute;a inventada por el equipo ...</li>\
</ul>\
Pedir al equipo que 'nomine' historias ubic&aacute;ndolas en la secci&oacute;n de premio correspondiente. <br>\
Para cada categor&iacute;a: votar con puntos y anunciar la ganadora. \
Pedir al equipo por qu&eacute; la historia de usuario ganó en esta categor&iacute;a \
y dejar que el equipo reflexione sobre el proceso de completar las tareas: que sali&oacute; bien y/o mal.",
source:    "<a href='http://www.touch-code-magazine.com'>Marin Todorov</a>",
duration:  "30-40 min",
suitable:  "project, release"
};

all_activities[54] = {
phase:     2,
name:      "Las 4 Originales",
summary:   "Hacer las 4 preguntas claves de Norman Kerth",
desc:      "Norman Kerth, inventor  de las retrospectivas, identific&oacute; las siguientes 4 preguntas clave: \
<ul>\
    <li>&iquest;Qu&eacute; hicimos bien, que nos estar&iacute;amos olvidando de no discutirlo&quest;</li>\
    <li>&iquest;Qu&eacute; aprendimos&quest;</li>\
    <li>&iquest;Qu&eacute; podr&iacute;amos hacer distinto la pr&oacute;xima vez&quest;</li>\
    <li>&iquest;Qu&eacute; cosa nos sigue desconcertando&quest;</li>\
</ul>\
&iquest;Cu&aacute;les son las respuestas del equipo&quest;",
source:    "<a href='http://www.retrospectives.com/pages/RetrospectiveKeyQuestions.html'>Norman Kerth</a>",
duration:  "15 min",
suitable:  "iteration, project, release"
};

all_activities[55] = {
phase:     5,
name:      "Invitar al Cliente",
summary:   "Poner al equipo en contacto directo con un cliente o una de las partes interesadas (stakeholder)",
desc:      "Invitar a un cliente o stakeholder interno a la retrospectiva. \
Pedir al equipo que haga TODAS las preguntas:\
<ul>\
    <li>&iquest;C&oacute;mo usa el producto el cliente&quest;</li>\
    <li>&iquest;Qu&eacute; es lo que m&aacute;s le molesta&quest;</li>\
    <li>&iquest;Qu&eacute; funcionalidad le facilita m&aacute;s la vida&quest;</li>\
    <li>Pedir al cliente que muestre su típico flujo de trabajo.</li>\
    <li>...</li>\
</ul>",
source:    "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Nick Oostvogels</a>",
duration:  "45 min",
suitable:  "iteration, project"
};

all_activities[56] = {
phase:     4,
name:      "D&iacute;galo con Flores",
summary:   "Cada miembro del equipo demuestra su aprecio hacia otro con una flor.",
desc:      "Comprar una flor por cada miembro del equipo y repartirlas al final de la retrospectiva. \
Cada miembro debe entregar una flor a alguien como muestra de aprecio.",
source:    "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Nick Oostvogels</a>",
duration:  "5 min",
suitable:  "iteration, project"
};

all_activities[57] = {
phase:     2,
name:      "Jefe encubierto",
summary:   "&iquest;Si tu jefe hubiera sido testigo del &uacute;ltimo sprint, que le gustar&iacute;a cambiar&quest;",
desc:      "Imaginar que el jefe estuvo presente todo el sprint pasado en el equipo, de inc&oacute;gnito. &iquest;Qu&eacute; pensar&iacute;a \
de las interacciones y de los resultados&quest; &iquest;Qu&eacute; le gustar&iacute;a cambiar&quest; \
<br>Esta configuraci&oacute;n favorece que el equipo se vea a s&iacute; mismo desde un &aacute;ngulo diferente.",
source:    "<a href='http://loveagile.com/retrospectives/undercover-boss'>Love Agile</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release"
};

all_activities[58] = {
phase:     0,
name:      "Histograma de Felicidad",
summary:   "Crear un diagrama de felicidad para generar diálogo",
desc:      "Preparar un rotafolio con una escala horizontal del 1 (Infeliz) al 5 (Feliz).\
<ul>\
    <li>Cada participante de a uno coloca su post-it de acuerdo a su felicidad y lo comenta.</li>\
	<li>Si alguien más tiene el mismo puntaje, colocar su post-it arriba del que ya está colocado, formando un histograma</li>\
    <li>Si algo relevante sale de lo comentado, dejar que el equipo decida entre discutirlo en el momento o posponerlo para discutirlo \
	m&aacute;s tarde en la retrospectiva</li>\
</ul>",
source:    "<a href='http://nomad8.com/chart-your-happiness/'>Mike Lowery</a> via <a href='https://twitter.com/nfelger'>Niko Felger</a>",
duration:  "2 min",
suitable:  "iteration, project, release"
};

all_activities[59] = {
phase:     4,
name:      "&iexcl;AHA!",
summary:   "Tirarse una pelota para generar aprendizaje",
desc:      "Tirarse una pelota (por ejemplo una pelota anti-estr&eacute;s) entre los miembros del equipo para descubrir pensamientos positivos y experiencias de aprendizaje. \
Dar una pregunta que cada persona debe responder cuando atrapa la pelota, como por ejemplo: \
<ul>\
    <li>Una cosa que aprend&iacute; en el &uacute;ltimo sprint</li>\
    <li>Una cosa asombrosa que alguien hiz&oacute; por mi</li>\
</ul>\
De acuerdo a la pregunta pueden surgir temas que molestan a los participantes. \
Si detecta este tipo de alarma, indagar un poco m&aacute;s sobre el tema. \
Con la pregunta 'Una cosa linda' se puede cerrar con una nota positiva.",
source:    "<a href='http://scrumfoundation.com/about/catherine-louis'>Catherine Louis</a> y <a href='http://blog.haaslab.net/'>Stefan Haas</a> via <a href='https://www.linkedin.com/in/misshaley'>Amber Haley</a>",
duration:  "5-10 min",
suitable:  "iteration, project"
};

all_activities[60] = {
phase:     3,
name:      "Fiesta de Tragos",
summary:   "Identificar, discutir, clarificar y priorizar activamente un conjunto de acciones",
desc:      "Cada particiapente escribe en un post-it una acci&oacute;n que le parezca importante realizar - \
cuando m&aacute;s especifica (<a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART</a>) mejor. \
Luego los miembros del equipo pasean y discuten de a 2 sobre los post-its como si fuera una fiesta de tragos. \
Cada pareja discute de las acciones de sus dos post-its. Cerrar la discusi&oacute;n luego de 1 minuto. \
Cada pareja divide 5 puntos entre los dos post-its, poniendo m&aacute;s puntos al post-it m&aacute;s importante. \
Organizar entre 3 y 5 vueltas (seg&uacute;n el tama&ntilde;o del grupo). Al final todos suman los puntos de cada post-it. \
Se ordenan las acciones de acuerdo a sus puntos y el equipo decide cuantas de ellas se pueden hacer en la pr&oacute;xima iteraci&oacute;n, \
partiendo de la m&aacute;s votada.",
source:    "Suzanne Garcia via <a href='http://www.wibas.com'>Malte Foegen</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release, largeGroup"
};

all_activities[61] = {
phase:     1,
name:      "Expectativas",
summary:   "&iquest;Qu&eacute; esperan de ti? &iquest;Qu&eacute; puedes esperar de ellos?",
desc:      "Dar a cada participante una hoja de papel. La mitad inferior est&aacute; vacia. La mitad superior est&aacute; dividida en dos secciones:\
<ul>\
    <li>&iquest;Qu&eacute; pueden esperar de mi mis compa&ntilde;eros?</li>\
    <li>&iquest;Qu&eacute; espero yo de mis compa&ntilde;eros?</li>\
</ul>\
Cada uno llena la parte superior por su lado. Cuando todos terminaron, deben pasar su hoja \
a la izquierda y empezar a revisar la hoja que recibieron. \
En la parte inferior escriben lo que ellos esperan personalmente de esta persona, la firman y la pasan a la izquierda.<br>\
Cuando las hojas dieron toda la vuelta, tomar el tiempo de revisar y compartir las observaciones.",
source:    "<a href='http://agileyammering.com/2013/01/25/expectations/'>Valerie Santillo</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release, start"
};

all_activities[62] = {
phase:     3,
name:      "Frutas Colgando Bajo",
summary:   "Visualizar las promesas y facilidades de posibles acciones para ayudar a elegirlas",
desc:      "Presentar un &aacute;rbol dibujado previamente. Repartir post-its redondos y pedir a los participantes \
que escriban las acciones que les gustar&iacute;a ejecutar - una por post-it. \
Cuando todos terminaron, recuperar los post-its y leerlos de a uno. Ubicar cada 'fruta' en el &aacute;rbol \
de acuerdo a la evaluaci&oacute;n de los participantes:\
<ul>\
    <li>&iquest;Es facil de ejecutar? Ubicarlo abajo. &iquest;Dificil? Ubicarlo arriba.</li>\
    <li>&iquest;Parece muy beneficioso? Ubicarlo hacia la izquierda. &iquest;Hay dudas en cuanto a su valor? A la derecha.</li>\
</ul>\
La elecci&oacute;n logica es de seleccionar las acciones de las frutas de m&aacute;s abajo a la izquierda. \
Si no hay consenso, se puede discutir brevemente para acordar acciones o hacer un voto por puntos.",
source:    "<a href='http://tobias.is'>Tobias Baldauf</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release"
};

all_activities[63] = {
phase:     1,
name:      "Cuartos - Identificar Historias Aburridas",
summary:   "Categorizar las historias en dos dimensiones para identificar las aburridas",
desc:      "Dibujar un gran cuadrado y dividirlo en 2 columnas. \
Titularlas 'Interesante' y 'Aburrido'. Pedir al equipo que escriban todo lo que hicieron durante la &uacute;ltima iteraci&oacute;n en post-its \
y que los ubiquen en la columna correspondiente. \
Pedirle escribir en los post-its una estimaci&oacute;n aproximada de cuanto les llevo cada historia.<br> \
Agregar luego una l&iacute;nea horizontal para que el cuadro tenga 4 partes. \
Titular la parte de arriba 'Corto' (horas) y la parte de abajo 'Largo' (d&iacute;as). \
Acomodar los post-its con esa divisi&oacute;n.<br> \
Las historias largas y aburridas est&aacute;n ahora bien agrupadas y listas para ser 'atacadas' en otras fases de la retrospectiva.<br> \
<br>\
(Dividir la evaluaci&oacute;n en varios pasos mejora el foco. Se puede \
<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>\
    adaptar los cuartos para multiples otras categorizaciones en 2 dimensiones</a>.)",
source:    "<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>Wayne D. Grant</a>",
duration:  "10",
suitable:  "iteration, project"
};

all_activities[64] = {
phase:     1,
name:      "Consulta Apreciativa",
summary:   "Levantar el esp&iacute;ritu de todos con preguntas positivas",
desc:      "Esta es una actividad basada en rondas. En cada ronda se hace una pregunta al equipo, sus miembros escriben sus respuestas \
(darles a todos tiempo para pensar) y luego las leen en voz alta a los demás.<br>\
Preguntas propuestas para equipos de desarrollo de software:\
<ol>\
    <li>&iquest;Cu&aacute;ndo fue la &uacute;ltima vez que estuviste realmente comprometido / motivado / productivo? &iquest;Qu&eacute; hiciste? \
	&iquest;Qu&eacute; hab&iacute;a ocurrido? &iquest;C&oacute;mo te sentiste?</li>\
    <li>Desde la perspectiva del c&oacute;digo de la aplicaci&oacute;n: \
	&iquest;Qu&eacute; es lo m&aacute;s incre&iacute;ble que han construido juntos? &iquest;Qu&eacute; lo hace grandioso?</li>\
    <li>De las cosas que has construido para esta compa&ntilde;&iacute;a: &iquest;Cu&aacute;l ha sido la de m&aacute;s valor? &iquest;Por qu&eacute;?</li>\
    <li>&iquest;Cu&aacute;ndo fue tu mejor momento con el Due&ntilde;o de Producto? &iquest;Qu&eacute; fue lo bueno acerca de eso?</li>\
    <li>&iquest;Cu&aacute;ndo fue mejor tu colaboraci&oacute;n?</li>\
    <li>&iquest;Cu&aacute;l fue tu contribución m&aacute;s valiosa a la comunidad de desarrolladores (de esta compa&ntilde;&iacute;a)? \
	¿C&oacute;mo lo hiciste?</li>\
    <li>Deja tu modestia a un lado: &iquest;Cu&aacute;l es tu habilidad / rasgo de personalidad más valiosa con la que has contribuido al equipo?\
	&iquest;Ejemplos?</li>\
    <li>&iquest;Cu&aacute;l es la caracter&iacute;stica m&aacute;s importante de tu equipo? &iquest;Qu&eacute; te diferencia del resto?</li>\
</ol>\
<br>\
('Recuerda el Futuro' (#37) funciona bien como siguiente paso)",
source:    "<a href='http://blog.8thlight.com/doug-bradbury/2011/09/19/apreciative_inquiry_retrospectives.html'>Doug Bradbury</a>, adaptado para desarrollo de software por " + source_findingMarbles,
duration:  "20-25 min groupsize",
suitable:  "iteration, project"
};

all_activities[65] = {
phase:     2,
name:      "Escritura Cerebral",
summary:   "Las tormentas de ideas escritas nivelan la participaci&oacute;n de los introvertidos",
desc:      "Hacer una pregunta central, como por ejemplo \
'&iquest;Qu&eacute; acciones de mejoras deber&iacute;an ejecutarse en el pr&oacute;ximo sprint? \
Repartir hojas y marcadores. Todos escriben sus ideas. Luego de 3 minutos, todos pasan su hoja a su vecino \
y siguen escribiendo ideas en la nueva hoja. Si se quedan sin idea, pueden leer las ideas ya escritas en la hoja y extenderlas. \
Reglas: no se aceptan comentarios negativos y cada uno escribe sus ideas una sola vez (si varios escriben la misma idea no hay problema). <br>\
Rotar las hojas cada 3 minutos hasta que todos hayan tenido todas las hojas. Rotar una &uacute;ltima vez. \
Ahora todos leen su hoja y eligen las mejores 3 ideas. Escribir las 3 mejores ideas de cada hoja en una pizarra para la siguiente fase.",
source:    "Prof. Bernd Rohrbach",
duration:  "20 min groupsize",
suitable:  "iteration, project, release"
};

all_activities[66] = {
phase:     4,
name:      "Para Llevar",
summary:   "Registrar lo que los participantes descubrieron durante la retro",
desc:      "Cada participante escribe en un post-it la cosa m&aacute;s notable que descubri&oacute; durante la retro. \
Pegar los post-its contra la puerta. De a uno los participantes leen su post-it.",
source:     source_judith,
duration:  "5 min",
suitable:  "iteration, project, release"
};

all_activities[67] = {
phase:     2,
name:      "Mapa de la Compa&ntilde;&iacute;a",
summary:   "Dibujar un mapa de la compa&ntilde;&iacute;a como si fuera un pa&iacute;s",
desc:      "Repartir hojas y marcadores. Preguntar: '&iquest;Qu&eacute; pasar&iacute;a si la compa&ntilde;&iacute;a / sector / equipo \
fuera un territorio? &iquest;C&oacute;mo ser&iacute;a su mapa? &iquest;Qu&eacute; pistas agregar&iacute;as para viajar seguro?' \
Dejar que los participantes dibujen por 5-10 minutos. Mostrar los dibujos y revisarlos entre todos para aclarar y debatir las \
metaforas m&aacute;s interesantes.",
source:     source_judith,
duration:  "15 min groupsize",
suitable:  "iteration, project, release"
};

all_activities[68] = {
phase:     2,
name:      "Lo Peor Que Podr&iacute;amos Hacer",
summary:   "Explorar como arruinar con seguridad el pr&oacute;ximo sprint",
desc:      "Repartir post-its y marcadores. Pedir a todos ideas para transformar el pr&oacute;ximo sprint / entrega en un desastre asegurado \
- una idea por post-it. Cuando todos terminaron, mostrar todos los post-its y revisarlos entre todos. \
Identificar y discutir los temas emergentes. <br>\
En la fase siguiente revertir estas acciones negativas en sus opuestos.",
source:     source_findingMarbles,
duration:  "15 min groupsize",
suitable:  "iteration, project, release"
};

all_activities[69] = {
phase:     0,
name:      "3 por 1 - Apertura",
summary:   "Chequear satisfacci&oacute;n con los resultados del sprint, coordinaci&oacute;n &amp; estado de animo, todo a la vez",
desc:      "Preparar una pizarra con dos ejes. El eje Y es 'Satisfacci&oacute;n con el resultado del sprint', \
El eje X es 'Cantidad de veces que nos coordinamos'. Pedir a cada participante que dibuje, en la intersecci&oacute;n \
correspondiente a su satisfacci&oacute;n y nivel de coordinaci&oacute;n, un emoticono representando su estado de animo (no solo un punto). \
Debatir las variaciones soprendentes y los animos extremos.<br>\
(Variar el eje X para reflejar temas actuales del equipo, como por ejemplo 'Cantidad de veces que programamos de a pares'.)",
source:     source_judith,
duration:  "5 min groupsize",
suitable:  "iteration, project"
};

all_activities[70] = {
phase:     4,
name:      "3 por 1 - Cierre &iquest;Se ha escuchado a todo el mundo?",
summary:   "Chequear satisfacci&oacute;n con los resultados de la retro, distribuci&oacute;n equitativa del tiempo hablando &amp; estado de ánimo",
desc:      "Preparar una pizarra con dos ejes. El eje Y es 'Satisfacci&oacute;n con el resultado de la retro'. \
El eje X es 'Distribuci&oacute;n equitativa de tiempo hablando' (a m&aacute;s igualdad, m&aacute;s a la derecha). \
Pedir a cada participante que marque el punto intersecci&oacute;n entre su satisfacci&oacute;n y la percepci&oacute;n del balance en tiempo hablando - \
con un emoticono que indique su estado de &aacute;nimo (en vez de simplemente un punto). \
Discutir las desigualdades en tiempo hablando (y los estados de &aacute;nimo extremos).",
source:     source_judith,
duration:  "15 min groupsize",
suitable:  "iteration, project, release"
};

all_activities[71] = {
phase:     3,
name:      "Repartir los dolares",
summary:   "&iquest;Qu&eacute; tanto vale una acción para el equipo?",
desc:      "Enumerar la lista de posibles acciones. Dibujar una columna al lado, con el t&iacute;tulo 'Importancia (en $)'. \
El equipo tiene 100 d&oacute;lares (virtuales) para gastar en las acciones. Mientras m&aacute;s \
importante sea para ellos, m&aacute;s deber&iacute;an gastar. Hazlo m&aacute;s divertido usando \
dinero de papel como el del Monopolio.\
<br><br>Dejar que el equipo acuerde los precios. Identificar las 2 o 3 acciones con mayor cantidad de dinero como las elegidas.",
source:     "<a href='http://www.gogamestorm.com/?p=457'>Gamestorming</a>",
duration:  "10 min groupsize",
suitable:  "iteration, project, release"
};

all_activities[72] = {
phase:     3,
name:      "Competencia",
summary:   "Ideas de acción compiten para 2 lugares disponibles",
desc:      "Pedir a todos que piensen en dos cambios que les gusta&iacute;a implementar y escribirlos en dos post-its separados. \
Dibujar dos espacios para un post-it en la pizarra. El primer miembro del equipo pone su mejor idea de cambio en el primer espacio. \
Su vecino pone su mejor idea en el segundo espacio. El tercer miembro tiene que hacer competir su mejor idea contra la de las dos \
que ya est&aacute;n en la pizarra que menos le guste. Si el equipo prefiere su idea, la ubica en el espacio en lugar de la otra. \
Se continua hasta que todos hayan presentado sus dos ideas. \
<br><br>Tratar de no empezar el circulo con los miembros del equipo que m&aacute;s dominan.",
source:     source_judith,
duration:  "15 min groupsize",
suitable:  "iteration"
};

all_activities[73] = {
phase:     2,
name:      "Pesimismo",
summary:   "&iquest;Qu&eacute; podr&iacute;amos haber hecho para arruinar el &uacute;ltimo sprint?",
desc:      "Empezar la actividad preguntando: ‘&iquest;Qu&eacute; podr&iacute;amos haber hecho para arruinar completamente \
el &uacute;ltimo sprint?’. \
Registrar las respuestas en la pizarra. Siguiente pregunta: ‘‘&iquest;Qu&eacute; ser&iacute;a lo opuesto?’. \
Registrar las respuestas en la pizarra, en otra parte. \
Pedir ahora a los participantes que comenten los items en la parte de lo ‘Opuesto’ pegando post-its que contesten la pregunta: \
‘&iquest;Qu&eacute; nos impide hacer eso?’. \
Usar post-its de otro color para comentar sobre los comentarios, preguntando: ‘&iquest;Por qu&eacute; es as&iacute;?’.",
source:     source_judith,
duration:  "25 min groupsize",
suitable:  "iteration, project"
};

all_activities[74] = {
phase:     1,
name:      "Escribiendo lo que no se puede hablar",
summary:   "Escribir los temas que no se pueden hablar en voz alta",
desc:      "&iquest;Crees que hay ciertos temas que nunca se hablan dentro del equipo? \
Considera esta actividad silenciosa: remarca primero la confidencialidad \
('Lo que pasa en Las Vegas se queda en Las Vegas') \
y anuncia que todas las notas de la actividad se destruiran al final. \
Luego distribuir a cada participante un papel para que escriba el gran tabu de la compa&ntilde;&iacute;a. <br>\
Cuando todos terminaron, pasan su papel a su vecino izquierdo. \
El vecino lo lee (en silencio) y puede escribir comentarios. \
Luego se pasan de vuelta los papeles una y otra vez hasta que lleguen de vuelta a su autor. \
Cada uno lee los comentarios. Finalmente todos los papeles se despedazan o se queman.",
source:     "Desconocido, via Vanessa",
duration:  "10 min groupsize",
suitable:  "iteration, project, release"
};

all_activities[75] = {
phase:     0,
name:      "Ronda de Admiraci&oacute;n",
summary:   "Los participantes expresan lo que admiran unos de otros",
desc:      "Iniciar una ronda de admiraci&oacute;n dirigi&eacute;ndote a tu vecino y diciendo 'Lo que m&aacute;s admiro \
            de ti es...' Entonces tu vecino dice lo que admira de su vecino \
            y as&iacute; sucesivamente hasta que el &uacute;ltimo participante cuenta lo que admira de ti. Se siente genial, \
            &iquest;verdad&quest;",
source:     source_judith,
duration:  "5 min",
suitable:  "iteration, project, release"
};
all_activities[76] = {
phase:     4,
name:      "Seguir Adelante",
summary:   "&iquest;Cu&aacute;l es la probabilidad de que las acciones elegidas sean ejecutadas?",
desc:      "Pedir a cada uno que dibuje un emoticono de su estado de &aacute;nimo en ese momento en un post-it. \
            Dibujar una escala en una pizarra, etiquetando 'Probabilidad de que concretamos \
            las acciones elegidas'. Marcar un  '0%' a la izquierda y '100%' a la derecha. Pedir \
            a cada uno ubicar su post-it en la escala seg&uacute;n su confianza en que sea concretada por el equipo. \
            <br>Debatir los resultados interesantes como bajas probabilidades o estados de &aacute;nimo negativos.",
source:     source_judith,
duration:  "5-10 min",
suitable:  "iteration, project, release"
};

all_activities[77] = {
phase:     1,
name:      "Las 4 As - Amado, Aprendido, Ausente, Anhelado",
summary:   "Explorar individualmente qu&eacute; cosas se han Amado, se han Aprendido, fueron Ausentes o se han Anhelado",
desc:      "Cada persona piensa individualmente en los siguientes cuatro aspectos: \
<ul> \
    <li>&iquest;Qu&eacute; me gusto (Amado)?</li> \
    <li>&iquest;Qu&eacute; aprendi (Aprendido)?</li> \
    <li>&iquest;Qu&eacute; ha escaseado (Ausente)?</li> \
    <li>&iquest;Qu&eacute; se ha echado en falta (Anhelado)?</li> \
</ul> \
Recoger las respuestas, a trav&eacute;s de post-its en la pizarra o bien a trav&eacute;s de una herramienta digital si est&aacute;n distribuidos. \
Formar 4 grupos para cada A, leer todas las notas e identificar patrones y reportar las conclusiones al grupo. \
Utilizar estas conclusiones como entradas para la siguiente fase.",
source:     "<a href='http://ebgconsulting.com/blog/the-4l%E2%80%99s-a-retrospective-technique/'>Mary Gorman &amp; Ellen Gottesdiener</a> \
probablemente via <a href='http://www.groupmap.com/portfolio-posts/agile-retrospective/'>groupmap.com</a>",
duration:  "30 min",
suitable:  "iteration, project, release, distributed"
};

all_activities[78] = {
phase:     1,
name:      "Value Stream Mapping",
summary:   "Dibujar un ‘value stream map’ (mapa de flujo de valor) del proceso",
desc:      "Explicar un ejemplo de ‘Value Stream Mapping’. (Si no est&aacute;s familiarizado, mira \
<a href='http://www.youtube.com/watch?v=3mcMwlgUFjU'>este video</a> o \
<a href='http://wall-skills.com/2014/value-stream-mapping/'>esta hoja imprimible</a>.) \
Pedir al equipo que dibuje el ‘value stream map’ de su proceso desde el punto de vista de una historia de usuario. \
Si fuera necesario, dividirlos en peque&ntilde;os grupos, y/o facilitar el ejercicio. \
Mirar el mapa creado. &iquest;Donde est&aacute;n las demoras y los cuellos de botella?",
source:    "<a href='http://pragprog.com/book/ppmetr/metaprogramming-ruby'>Paolo &quot;Nusco&quot; Perrotta</a>, inspirado por <a href='http://www.amazon.com/exec/obidos/ASIN/0321150783/poppendieckco-20'>Mary &amp; Tom Poppendieck</a>",
duration:  "20-30 min",
more:      "http://leadinganswers.typepad.com/leading_answers/2011/09/pmi-acp-value-stream-mapping.html",
suitable:  "iteration, project, release, distributed"
};

all_activities[79] = {
phase:     1,
name:      "Repetir &amp; Evitar",
summary:   "Reflexionar sobre que repetir y que comportamientos evitar",
desc:      "Armar dos rotafolios titulados ‘Repetir’ y ‘Evitar’. \
Los participantes deben escribir temas para las 2 columnas sobre post-its - 1 por tema. \
Se pueden usar colores para los post-its: por ejemplos para las categor&iacute;as ‘Personas’, ‘Procesos’, ‘Tecnolog&iacute;a’, etc. \
Pedir a cada participante que lea sus post-its y los pegue en la columna correspondiente. \
&iquest;Todos los temas son unanimes?",
source:     "<a href='http://www.infoq.com/minibooks/agile-retrospectives-value'>Luis Goncalves</a>",
more:       "http://www.funretrospectives.com/repeat-avoid/",
duration:  "15-30",
suitable: "iteration, project, remote"
};

all_activities[80] = {
phase:     0,
name:      "Resultados Esperados",
summary:   "Todos expresan los resultados que esperan de la retrospectiva",
desc:      "Los miembros del equipo definen sus objetivos para la retrospectiva, o sea los resultados que esperan. Por ejemplo: \
<ul> \
    <li>Estar&eacute; feliz si definimos una buena acci&oacute;n</li> \
    <li>Quiero que hablemos sobre nuestra diferencia respecto a Tests de Unidad y acordar como los vamos a manejar en el futuro</li> \
    <li>Considerar&eacute; esta retrospectiva un exito si definimos un plan para ordenar el $ModuloOscuro</li> \
</ul> \
[Se pueden verificar estos objetivos cerrando la retro con la actividad #14.] \
<br><br> \
[El <a href='http://liveingreatness.com/additional-protocols/meet/'>Meet - Core Protocol</a>, que inspira esta actividad, \
describe tambi&eacute;n ‘Chequeos de Alineaci&oacute;n’: cuando algui&eacute;n piensa que la retrospectiva \
no est&aacute; cumpliendo con las necesidades de los participantes, pueden solicitar un ‘Chequeo de Alineaci&oacute;n’. \
Entonces cada uno dice un n&uacute;mero entre 0 y 10 que refleja que tanto est&aacute; consiguiendo de lo que espera. \
La persona con el n&uacute;mero m&aacute;s bajo toma el control para acercarse a lo que quiere.]",
source:     "Inspirado por <a href='http://liveingreatness.com/additional-protocols/meet/'>Jim &amp; Michele McCarthy</a>",
duration:  "5 min groupsize",
suitable:  "iteration, project, release"
};

all_activities[81] = {
phase:     0,
name:      "3 Palabras",
summary:   "Cada uno resume el &uacute;ltimo sprint en 3 palabras",
desc:      "Pedir a todos que describan la &uacute;ltima iteraci&oacute;n en solo 3 palabras. \
Esperar un minuto para que puedan prepararlo, luego escuchar las palabras de todos de a uno. \
Esta actividad ayuda a las persona a recordar el &uacute;ltimo sprint para tener un punto de partida.",
source:     "Yurii Liholat",
duration:  "5 min groupsize",
suitable:  "iteration, project"
};

all_activities[82] = {
phase:     4,
name:      "Retro Dardo",
summary:   "Verificar si se llega al blanco para los temas importantes",
desc:      "Dibujar uno o varios blancos en una pizarra. \
Escribir una pregunta cerca de cada blanco, por ejemplo: \
<ul> \
    <li>&iquest;Hablamos de lo que era importante para mi?</li> \
    <li>&iquest;Habl&eacute; en forma abierta?</li> \
    <li>&iquest;Tengo confianza de que vamos a mejorar en la pr&oacute;xima iteraci&oacute;n?</li> \
</ul> \
Los participantes ubican su opini&oacute;n con un post-it. Un acierto en el medio es un consenso al 100%. \
Afuera del blanco es un 0% consenso.",
source:   "<a href='http://www.philippflenker.de/'>Philipp Flenker</a>",
duration:  "2-5",
suitable: "iteration, release"
};

all_activities[83] = {
phase:     0,
name:      "Tabla de Acciones de la &Uacute;ltima Retro",
summary:   "Evaluar como seguir con las acciones de la &uacute;ltima retro",
desc:      "Crear una tabla con 5 columnas. En la primera columna enumerar las acciones definidas en la &uacute;ltima retro. \
Titular las otras columnas: ‘M&aacute;s de’, ‘Seguir’, ‘Menos de’ y ‘Parar’. Los participantes ubican un post-it por l&iacute;nea \
de acuerdo a lo que quieren respecto a la acci&oacute;n correspondiente. \
Luego facilitar un breve debate sobre cada acci&oacute;n, preguntando por ejemplo: \
<ul> \
    <li>&iquest;Por qu&eacute deber&iacute;amos para esto?</li> \
    <li>&iquest;Por qu&eacute; vale la pena seguir con esto?</li> \
    <li>&iquest;Sus expectativas est&aacute;n cumplidas?</li> \
    <li>&iquest;Por qu&eacute hay tanta variaci&oacute;n en las opiniones?</li> \
</ul>",
source:    "<a href='https://sven-winkler.squarespace.com/blog-en/2014/2/5/the-starfish'>Sven Winkler</a>",
duration:  "5-10",
suitable: "iteration, release"
};

all_activities[84] = {
phase: 0,
name: "Saludos desde la &Uacute;ltima Iteraci&oacute;n",
summary: "Cada participante escribe una tarjeta postal sobre la iteraci&oacute;n",
desc: "Hacer recordar los elementos de una tarjeta postal: \
<ul> \
    <li> Una imagen en el frente,</li> \
    <li> Un mensaje en una mitad de la parte posterior,</li> \
    <li> La direcci&oacute;n y el sello en la otra mitad.</li> \
</ul> \
Repartir tarjetas vac&iacute;as y darle 10 minutos al equipo para que cada uno escriba una tarjeta postal \
a una persona que todos conozcan (por ejemplo un ex-colega). \
Cuando se termina el tiempo, recuperar las tarjetas, mezclarlas y re-distribuirlas. \
De a uno, cada participante lee en voz alta la tarjeta que recibi&oacute;.",
source: '<a href="http://uk.linkedin.com/in/alberopomar">Filipe Albero Pomar</a>',
duration:  "15 min",
suitable:  "iteration, project"
};

all_activities[85] = {
phase:     1,
name:      "L&iacute;neas de Comunicaci&oacute;n",
summary:   "Visualice como fluye la informaci&oacute;n dentro, fuera y alrededor del equipo",
desc:      "&iquest;La informaci&oacute;n no fluye tan bien como lo necesita? &iquest;Sospecha \
que hay embotellamientos? Visualice el flujo de la informaci&oacute;n para encontrar \
puntos de partida para las mejoras. Si usted desea ver un flujo \
espec&iacute;fico (ej. requerimientos de producto, impedimentos, ...) consulte el \
Mapa de Flujo de Valor (#79). Para situaciones m&aacute;s desordenadas, intente algo parecido a \
Diagramas-Causa-Efecto (#25). <br>\
Observe el dibujo terminado. &iquest;D&oacute;nde est&aacute;n los retrasos o callejones sin salida?",
source:    "<a href='https://www.linkedin.com/in/bleadof'>Tarmo Aidantausta</a>",
duration:  "20-30 min",
suitable:  "iteration, project, release"
};

all_activities[86] = {
phase:     1,
name:      "Histograma de Satisfacci&oacute;n de Reuniones",
summary:   "Crear un histograma sobre c&oacute;mo fueron las reuniones durante el sprint",
desc:      "Preparar una pizarra para cada reuni&oacute;n que se repite en cada iteraci&oacute;n, \
(por ejemplo, cualquier ceremonia de Scrum) con una escala horizontal desde 1 ('No cumple con lo esperado') \
a 5 ('Sobrepasa las expectativas'). Cada miembro del equipo ubica un post-it basado en su valoraci&oacute;n \
para cada reuni&oacute;n. Facilitar un breve debate sobre por que algunas de las reuniones no tienen un 5. \
<br> \
Se puede discutir mejoras como parte de esta actividad o en actividades posteriores c&oacute;mo \
El juego de la Perfecci&oacute;n (#20) o M&aacutes & Delta (#40).",
source:    "<a href='https://www.linkedin.com/profile/view?id=6689187'>Fanny Santos</a>",
duration:  "10-20 min",
suitable:  "iteration, project, release"
};

all_activities[87] = {
phase:     3,
name:      "El Mundial de los Impedimentos",
summary:   "Los impedimentos compiten uno contra otro al estilo del Mundial",
desc:      "Preparar una pizarra con un fixture para cuartos de final, semi-final y final. \
Todos los participantes escriben acciones en un post-it hasta que tengan ocho. \
Mezclar y colocar de manera aleatoria las acciones en el fixture.<br>\
El equipo elige luego la mejor acci&oacute;n de cada partido de cuartos de final. Mover la acci&oacute;n \
ganadora a la siguiente ronda hasta tener un ganador del mundial de impedimentos. \
<br><br>\
Si quieren tomar m&aacutes de una o dos acciones se puede jugar el partido por el tercer puesto.",
source:    "<a href='http://obivandamme.wordpress.com'>Pascal Martin</a>, inspirado por <a href='http://borisgloger.com/'>Boris Gloger's 'Bubble Up'</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release"
};

all_activities[88] = {
phase:     1,
name:      "Retro Boda",
summary:   "Obtener muestras de algo viejo, nuevo, prestado y azul",
desc:      "Extrapolando una costumbre anglosajon para casamientos, pedir a los miembros del equipo muestras para las siguientes categorias: \
<ul> \
    <li>Algo viejo<br> \
        Feedback positivo o cr&iacute;tica constructiva de una pr&aacute;ctica establecida</li> \
    <li>Algo nuevo<br> \
        Feedback positivo o cr&iacute;tica constructiva de experimentos en curso</li> \
    <li>Algo prestado<br> \
        Herramienta/idea de otro equipo, de la web o suya para un posible experimento</li> \
    <li>Algo azul<br> \
        Alg&uacute;n bloqueante u origen de conflicto</li> \
</ul> \
Un ejemplo por post-it. S&oacute;lamente hay una regla: si alguien pone algo en la categoria azul, \
tiene que poner tambi&eacute;n algo positivo en al menos una de las otras categorias.<br><br> \
Cada participante pega sus post-its en las categorias correspondientes y describe la idea brevemente.",
source:    "<a href='http://scalablenotions.wordpress.com/2014/05/15/retrospective-technique-retro-wedding/'>Jordan Morris</a>, via Todd Galloway",
duration:  "5-10 min",
suitable:  "iteration, project, release"
};

all_activities[89] = {
phase:     0,
name:      "Celebrar los Valores &Aacute;giles",
summary:   "Recordar los valores &aacute;giles que han mostrado",
desc:      "Dibujar 4 grandes burbujas y escribir en cada una un valor &aacute;gil: \
<ol> \
    <li>Individuos e interacciones</li> \
    <li>Entregar sofware funcionando</li> \
    <li>Colaboraci&oacute;n con el cliente</li> \
    <li>Responder al cambio</li> \
</ol> \
Pedir a los participantes que escriban los momentos en donde sus colegas han mostrado \
alguno de los valores - 1 post-it por cada caso. En orden, \
dejar que todos coloquen su post-it en la burbuja correspondiente y lo lean en voz alta. \
Celebrar como todos tienen incorporados los valores &aacute;giles :)",
source:    "<a href='http://agileinpills.wordpress.com'>Jesus Mendez</a>",
duration:  "10-15 min",
suitable:  "iteration, project, release"
};

all_activities[90] = {
phase:     2,
name:      "Sesi&oacute;n de Rotafolios",
summary:   "Dividir un grupo grande en grupos m&aacute;s pequeños para crear rotafolios",
desc:      "Despu&eacute;s de haber identificado un tema importante en la fase anterior, \
es tiempo de entrar en detalles. Dividir el grupo en subgrupos de 2-4 \
personas que preparar&aacute;n cada uno un rotafolio para ser presentado a los otros grupos. \
Si ha identificado m&aacute;s de un tema principal, permita que los miembros del equipo seleccionen \
el t&oacute;pico que deseen profundizar.<br> \
Provea de una orientaci&oacute;n al equipo sobre el contenido de los rotafolios o respuestas a cubrir como: \
<ul> \
   <li>&iquest;Que ocurre exactamente&quest; &iquest;Por qu&eacute; es esto un problema&quest;</li> \
   <li>&iquest;Por qu&eacute; / Cuando / C&oacute;mo ocurre esta situaci&oacute;n&quest;</li> \
   <li>&iquest;Qui&eacute;n se beneficia de la situaci&oacute;n actual&quest; &iquest;Cu&aacutel es el beneficio&quest;</li> \
   <li>Soluciones posibles (con Pros y Contras)</li> \
   <li>&iquest;Qui&eacute;n podr&iacute;a ayudar a cambiar la situaci&oacute;n&quest;</li> \
   <li>... lo que se considere apropiado en esta situaci&oacute;n, etc.</li> \
</ul> \
Los grupos tienen de 15 a 20 minutos para discutir y crear sus rotafolios. Despu&eacute;s \
juntar a todos y cada grupo tiene 2 minutos para presentar sus resultados.",
source:    "Desconocido, adaptado por" + source_findingMarbles + ", inspirado por Michal Grzeskowiak",
duration:  "30 min",
suitable:  "iteration, project, release"
};

all_activities[91] = {
phase:     4,
name:      "Afiche Motivacional",
summary:   "Convertir acciones en afiches para mejorar su visibilidad y seguimiento",
desc:      "Tomar cada acción y crear su afiche divertido (ver fotos de ejemplo). \
<ol>\
    <li>Elegir una imagen</li>\
    <li>Acordar un t&iacute;tulo</li>\
    <li>Escribir una descripci&oacute;n par&oacute;dica</li>\
</ol>\
Imprimir la obra de arte lo m&aacute;s grande possible (A4 como minimo) y exponerla en un lugar clave.",
source:    "<a href='http://fr.slideshare.net/romaintrocherie/agitational-posters-english-romain-trocherie-20140911'>Romain Trocherie</a>",
duration:  "30 min per topic / poster",
suitable:  "release"
};

all_activities[92] = {
phase:     1,
name:      "Contar una Historia con Palabras Estructurantes",
summary:   "Cada participante cuenta una historia sobre la &uacute;ltima iteraci&oacute;n incluyendo ciertas palabras",
desc:      "Dar a todos algo en lo cual puedan escribir su historia. Introducir luego las palabras estructurantes, \
que influencian la historia a escribir: \
<ul> \
    <li>Si la iteraci&oacute;n podr&iacute;a haber sido mejor:<br> \
Puede fijar un par de palabras estructurantes, por ejemplo: ‘triste’, ‘enojado’, ‘feliz’ o ‘mantener’, ‘eliminar’, ‘agregar’. \
Adicionalmente se debe escribir la historia en primera persona. Eso permite evitar recriminar al resto. \
    </li> \
    <li>Si la iteraci&oacute;n fue un exito:<br> \
El equipo puede elegir sus propias palabras estructurantes o puede proveer palabras aleatorias para liberar la creatividad. \
    </li> \
</ul> \
Ahora cada participantes debe escribir una historia de no m&aacute;s de 100 palabras sobre la &uacute;ltima iteraci&oacute;n. \
Tienen que usar por lo menos una vez cada palabra estructurante. Limitar a 5-10 minutos. <br> \
Cuando todos terminaron, leen en voz alta su historia. Dejar luego un espacio de debate sobre las tem&aacute;ticas comunes a las distintas historias.",
source:    "<a href='https://medium.com/p/agile-retrospective-technique-1-7cac5cb4302a'>Philip Rogers</a>",
duration:  "20-30 minutes",
suitable:  "iteration, project, release"
};

all_activities[93] = {
phase:     2,
name:      "ATPSM - Arma Tu Propio Scrum Master",
summary:   "El equipo arma el SM perfecto \& escuchando distintos puntos de vista",
desc:      "Dibujar un Scrum Master en un rotafolio conteniendo tres secciones: cerebro, coraz&oacute;n y estomago. \
<ul>\
    <li>Paso 1: '&iquest;Qu&eacute; caracteristicas demuestra su Scrum Master perfecto?' <br>\
        Pedir a los participantes que escriban en silencio una caracter&iacute;stica por post-it. \
        Dejar que expliquen sus post-its y los ubiquen en el dibujo. \
    </li> \
    <li>Paso 2: '&iquest;Qu&eacute; deber&iacute;a saber el Scrum Master perfecto sobre el equipo para que pueda trabajar bien con ustedes?' \
    </li>\
    <li>Paso 3: '&iquest;C&oacute;mo pueden dar soporte al Scrum Master para que pueda hacer un trabajo brillante?' <br> \
    </li></ul>\
Se puede adaptar la actividad para otros roles, p.e. Arma Tu Propio Dueño De Producto.",
source:    "<a href='http://agile-fab.com/2014/10/07/die-byosm-retrospektive/'>Fabian Schiller</a>",
duration:  "30 minutes",
suitable:  "iteration, project, release"
};

all_activities[94] = {
phase:     2,
name:      "Si fuera tu",
summary:   "&iquest;Qu&eacute; pueden mejorar los sub-grupos en sus interacciones?",
desc:      "Identificar entre los participantes los distintos sub-grupos que interactuaron durante la iteraci&oacute;n, \
p.e. desarrolladores/testers, clientes/proveedores, dueño de producto/desarrolladores, etc. \
Dejar 3 minutos para que los participantes puedan escribir en silencio lo que piensan que su grupo hizo \
que pudo haber tenido un impacto negativo sobre otro grupo. Cada persona deber&iacute;a ser parte de un solo grupo \
y escribir post-its para todos los otros grupos - 1 tema por post-it. <br><br> \
Luego en orden cada participante lee sus post-its y los entregan al grupo correspondiente. \
El grupo afectado lo eval&uacute;a desde 0 ('No fue un problema') a 5 ('Fue un gran problema').\
De esta forma se recolectan percepciones y entendimiento compartido de los problemas. \
Se pueden seleccionar algunos para trabajarlo en otras actividades.",
source:    "<a href='http://www.elproximopaso.net/2011/10/dinamica-de-retrospectiva-si-fuera-vos.html'>Thomas Wallet</a>",
duration:  "25-40 minutes",
suitable:  "iteration, project, release"
};

// Values for duration: "<minMinutes>-<maxMinutes> perPerson"
// Values for suitable: "iteration, realease, project, introverts, max10People, rootCause, smoothSailing, immature, largeGroup"
