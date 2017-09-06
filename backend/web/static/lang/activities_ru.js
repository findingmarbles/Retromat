var phase_titles = ['Создание атмосферы', 'Сбор информации', 'Формирование понимания', 'Выработка плана действий', 'Завершение ретроспективы', 'Что-то совсем другое'];

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
//  durationDetail:  "",
//  duration:    "Short | Medium | Long | Flexible", Короткая, Средняя, Длительная, Гибкая
//  stage:    "All" or one or more of "Forming, Norming, Storming, Performing, Stagnating, Adjourning" Формирование, Бурление, Нормирование, Функционирование
//  source:    "",
//  more:      "", // a link
//  suitable:  "",
//};
// Values for durationDetail: "<minMinutes>-<maxMinutes> perPerson"
// Values for suitable: "iteration, realease, project, introverts, max10People, rootCause, smoothSailing, immature, largeGroup" итерация, релиз, проект, интроверты, до10человек, кореннаяПричина, несформировавшийся

all_activities = [];

all_activities[0] = {
phase:     0,
name:      "ИПОЗ (англ. ESVP)",
summary:   "Как чувствуют себя учасники ретроспективы, как Исследователи, Покупатели, Отдыхающие или Заключённые?",
desc:      "Подготовьте флипчарт с зонами для И, П, О, З. Обьясните принцип активности:<br>\
<ul>\
    <li>Исследователи: стремятся полностью погрузиться и исследовать что произошло и улучшить работу команды.</li>\
    <li>Покупатель: Позитивно настроены, будут рады если вынесут хотя бы одну полезную для себя вещь.</li>\
    <li>Отдыхающие: Не хотят активно участвовать, но рады отвлечению от обычной работы.</li>\
    <li>Заключенный: Только тут потому, что чувствуют обязанность здесь быть.</li>\
</ul>\
Проведи опрос (анонимно, на листочках бумаги). Посчитай ответы и покажи результат на флипчарте,  \
так чтобы все видели.Если доверие в команде низкое, сознательно уничтожь бумажки с голосами,  \
чтобы обеспечить конфиденциальность. Спроси что участники думают о получинных данных. Если \
большинство Отдыхающие и Заключенные рассмотри возможность использовать всю ретроспективу для \
обсуждения этого познания.",
source:  source_agileRetrospectives,
durationDetail:  "5-10 numberPeople",
duration:    "Короткая",
stage:    "Формирование, Бурление"
};

all_activities[1] = {
phase:     0,
name:      "Прогноз Погоды",
summary:   "Участники отмечают свою 'погоду' (настроение) на флипчарте.",
desc:      "Подготовь флипчарт с символом шторма, дождя, облаков и солнца.\
Каждый участник отмечает свое настроение на флипчатре",
duration:    "Короткая",
stage:    "All",
source:  source_agileRetrospectives
};

all_activities[2] = {
phase:     0,
name:      "Check In - короткий вопрос", // TODO This can be expanded to at least 10 different variants - how?
summary:   "Задаётся один вопрос, на который участники поочереди отвечают",
desc:      "Поочереди каждый участник отвечает на заданный вопрос или пассует - пропускает очередь.\
Примеры вопросов: <br>\
<ul>\
    <li>Одним словом - чего ты ожидаешь от этой ретроспективы?</li>\
Учитывай проявлящиеся опасения, например напиши и отложи их - физически и ментально -  в сторону.</li>\
    <li>Во время этой ретроспективы - если бы вы были автомобилем, какой бы это был?</li>\
    <li>В каком эмоциональном состояние вы сейчас находитесь? (Например, 'радость', 'гнев', 'грусть', 'страх'?)</li>\
</ul><br>\
Избегай оценочных комментариев к ответам, как 'Отлично!'. Простого 'Спасибо'- достаточно.",
duration:    "Короткая",
stage:    "All",
source:  source_agileRetrospectives
};

all_activities[3] = {
phase:     1,
name:      "Таймлайн - Хронология",
summary:   "Участники записывают важные события в хронологическом порядке",
desc:      "Разделитесь на группы по 5 или меньше человек. Раздайте карточки и маркеры.\
Дайте участникам 10 минут, чтобы записать памятные и для них значимые события. Важно собрать \
много перспектив. Стремление к единогласию может этому помешать. Все участиники выкладывают или \
приклеиваютсвои карточки на хронологически подходящюю позицию. Можно и сейчас добавлять новые  \
карточки. Анализируйте сформировавшуюся картину.<br>\
Можно использовать карточки разных цветов чтобы распознать закономерности, например:<br>\
<ul>\
    <li>Чувства/Эмоции</li>\
    <li>События (технические, организационные, ..) </li>\
    <li>Функции (тестер, разработчик, менеджер, ...)</li>\
</ul>",
source:  source_agileRetrospectives,
durationDetail:  "60-90 минут",
duration:    "Средняя",
stage:    "All",
suitable: "итерация, релиз, интроверты"
};

all_activities[4] = {
phase:     1,
name:      "Анализ историй",
summary:   "Анализ всех историй обработанных командой и поиск возможных улучшений.",
desc:      "Подготовка: собрать все истории обработанные во время итерации и взять их с собой \
на ретроспективу.<бр> \
В группе (до 10 человек) прочитать каждую историю и обсудить, что было удачно, а что нет.\
Если история хорошо удалась, запишите почему. Если были сложности, обсудите, что можно сделать \
по-другому в слудующий раз.<br>\
Варианты: Вместо историй вы можете использовать обработанные дефекты, запросы или любую другую комбинацию\
заданий выполненных командой.",
duration:    "Длительная",
stage:    "Бурление, Нормирование",
source:    source_findingMarbles,
suitable: "итерация, max10people"
};

all_activities[5] = {
phase:     1,
name:      "Подобное к подобному",
summary:   "Участники сопоставляют свои идеи Прекратить-Продолжать-Начать с карточками характеристик", 
desc:      "Эта активность основана на настольной игре 'Яблоки к яблокам', для более подробного \
описания игрового процесса обратитесь к описанию игры в интернете.<br> \
Вам нужно подготовить 20 карточек с характеристиками, на которых написаны прилагательные: \
<i>'Самое время', 'Мило', 'Прекрасно', 'Это Агонь!', 'Опасно', 'Свежо', 'Рискованно', 'Креативно', \
'Весело', 'Отвратительно', 'Великолепно', 'Смелая идея',</i> и т.п. <br> \
Попросите каждого участника сделать как минимум 9 карточек идей: 3 идеи что следует прекратить делать, \
3 идеи что следует продолжать делать, 3 идеи что следует начать делать. Далее начинается игра. \
Выбирается первый судья. Судья берет из стопки первую карточку с характеристикой (например <i>'Самое время'</i>), \
показывает всем, а участники выкладывают на стол свою идею текстом вниз. Тот, кто выложил последним, \
забирает идею обратно и в текущем раунде не участвует. Судья перемешивает идеи, переворачивает текстом вверх, \
и выбирает ту, которая наиболее подходит под карточку характеристики. Автор победившей идеи получает карточку \
характеристики в качестве бонуса. Использованные идеи убираются со стола и далее в игре не участвуют. \
Далее роль судьи передается следующему участнику и начинается следующий раунд. Игра заканчивается когда \
у участников заканчиваются карточки идей. Побеждает участник собравший наибольшее количество карточек характеристик. \
После игры проведите дебрифинг.",
source:    source_agileRetrospectives,
durationDetail:  "30-40",
duration:    "Длительная",
stage:    "All",
suitable: "итерация, интроверты"
};

all_activities[6] = {
phase:     1,
name:      "Гнев, грусть и радость",
summary:   "Поиск и анализ событий, по поводу которых члены команды испытывали гнев, грусть или радость.",
desc:      "Повесте три флипчарта с названиями: 'Гнев', 'Грусть' и 'Радость' (или альтенативно '>:), :(, :) ). Подготовьте карточки \
определенного цвета для каждого чувства. Члены команды записывают события по одному на карточку цвета, подходящего к испытанному чувству. \
Когда время истекло, все прикрепляют свои карточки к соответствующим плакатам. Попросите сгруппировать карточки на каждом флипчарте и дать \
сформировавшимся группам названия. <br>\
Разберите спрашивая:\
<ul>\
    <li>Что выделяется? Что неожиданно?</li>\
    <li>Что было сложным? Что достовляло удовольствие?</li>\
    <li>Какие закономерности видны? Что они значат для команды?</li>\
    <li>Что теперь нужно сделать?</li>\
</ul>",
source:    source_agileRetrospectives,
durationDetail:  "15-25",
duration:    "Средняя",
stage:    "All",
suitable: "итерация, релиз, проект, интроверты"
};

all_activities[7] = {
phase:     2,
name:      "5 Почему",
summary:   "Докопаться до корневых причин проблемы постоянно задавая вопрос 'Почему?'",
desc:      "Объедините участников в малые группы (не более 4-х человек) и дайте каждой \
группе одну из выявленных проблем. Проинструктируйте группы:\
<ul>\
    <li>Кто-то один постоянно задает вопрос 'Почему это произошло?' чтобы прояснить цепочку событий и выявить корневую причину</li>\
    <li>Запишите корневую причину (обычно это ответ на пятый вопрос 'Почему?')</li>\
</ul>\
Попросите группы поделиться своими результатами друг с другом.",
source:    source_agileRetrospectives,
durationDetail:  "15-20",
duration:    "Короткая",
stage:    "All",
suitable: "итерация, релиз, проект, корневая_причина"
};

all_activities[8] = {
phase:     2,
name:      "Матрица обучения",
summary:   "Мозговой штурм по 4-м категориям для быстрого выявления проблем",
desc:      "После завершения этапа 'Сбор данных' нарисуйте 4 квадрата на белой доске или на \
листе флипчарта с заголовками  ':)', ':(', 'Идея!', и 'Благодарность'. Раздайте участникам стикеры. \
<ul>\
    <li>Участники могут писать свои мысли в любой квадрант. Каждая отдельная мысль на отдельном стикере.</li>\
    <li>Сгруппируйте стикеры.</li>\
    <li>Проведите голосование точками за наиболее важные мысли (6-9 точек на человека).</li>\
</ul>\
Получившийся список является отправной точкой для следующего этапа: 'Разработка плана действий'.",
source:    source_agileRetrospectives,
durationDetail:  "20-25",
duration:    "Средняя",
stage:    "All",
suitable: "итерация"
};

all_activities[9] = {
phase:     2,
name:      "Мозговой штурм / фильтрация",
summary:   "Сгенерируйте множество идей и отфильтруйте их согласно критериям",
desc:      "Изложите цель и правила проведения мозгового штурма: <em>Сперва</em> генерируем как \
можно больше новых идей, и <em>только потом</em> фильтруем.\
<ul>\
    <li>Дайте участникам 5-10 минут чтобы записать свои идеи.</li>\
    <li>Сбор идей организуйте по кругу по одной от человека. Повторяйте пока все идеи не окажутся на листе флипчарта.</li>\
    <li>Попросите участников составить список возможных критериев (например: стоимость, трудоемкость, \
сложность, инновационность и т.п.) и попросите выбрать 4.</li>\
    <li>Выберите идеи удовлетворяющие всем 4-м критериям.</li>\
    <li>Какие идеи команда возьмет в работу? Кто из участников испытывает уверенность относительно \
хотя бы одной идеи? Если нет - выберите идеи путем голосования большинством.</li>\
</ul>\
Выбранные идеи переходят на следующий этап ретроспективы: 'Разработка плана действий'.",
source:    source_agileRetrospectives,
more:     "<a href='http://www.mpdailyfix.com/the-best-brainstorming-nine-ways-to-be-a-great-brainstorm-lead/'>\
    Nine Ways To Be A Great Brainstorm Lead</a>",
durationDetail:  "40-60",
duration:    "Длительная",
stage:    "All",
suitable: "итерация, релиз, проект, интроверты"
};

all_activities[10] = {
phase:     3,
name:      "Круг вопросов",
summary:   "Участники по кругу отвечают и задают вопросы - отличный способ достичь консенсуса",
desc:      "Попросите группу сесть в круг. Первый участник задает вопрос соседу слева касательно \
плана действий. Например: 'Как ты считаешь, какое самое важное изменение нам следует попробовать на \
следующей итерации?'. Сосед отвечает на вопрос, а затем задает своему соседу слева вопрос, который \
либо расширяет предыдущий вопрос, либо начинает новый. И так далее по кругу, пока группа не достигнет \
взаимопонимания по вопросу, либо не закончится выделенное время. Следует пройти как минимум один круг, \
чтобы у каждого была возможность высказаться!",
source:    source_agileRetrospectives,
durationDetail:  "30+ groupsize",
duration:    "Средняя",
stage:    "Формирование, Нормирование",
suitable: "итерация, релиз, проект, интроверты"
};

all_activities[11] = {
phase:     3,
name:      "Голосование точками - Начать, Прекратить, Продолжать",
summary:   "Мозговой штурм в формате 'начать, прекратить, продолжать' и выбор лучших предложений",
desc:      "Разделите флипчарт на 3 колонки 'Начать', 'Прекратить' и 'Продолжать'. Попросите участников \
написать свои предложения в каждую из колонок - отдельное предложение на отдельном стикере. Дайте им на \
это 5 минут и попросите соблюдать тишину. Затем попросите зачитать свои предложения и повесить на флипчарт. \
Организуйте короткую дискуссию какие 20% предложений наиболее ценные. Затем попросите участников \
проголосовать точками (по 3 точки на человека). 2-3 предложения, набравшие наибольшее количество голосов, \
превращаются в план действий. \
<br><br>\
(Посмотрите интересную вариацию этого упражнения от Пауло Кароли: <a href='http://www.funretrospectives.com/open-the-box/'>'Open the Box'</a>.)",
source:    source_agileRetrospectives,
durationDetail:  "15-30",
duration:    "Средняя",
stage:    "All",
suitable: "итерация"
};

all_activities[12] = {
phase:     3,
name:      "SMART-задачи",
summary:   "Сформулируйте конкретный и измеримый план действий",
desc:      "Презентуйте группе концепцию <a href='http://ru.wikipedia.org/wiki/SMART'>SMART</a>-задач: \
Specific (конкретная), Measurable (измеримая), Attainable (достижимая), Relevant (актуальная), \
Timely (ограничена во времени). Приведите примеры SMART и НЕ-SMART задач. НЕ-SMART: 'Нужно прорабатывать \
истории перед взятием в спринт'. SMART: 'Перед взятием в спринт мы будем прорабатывать истории, обсуждая \
их вместе с Product Owner'ом каждую среду в 9:00 утра'.<br>\
Сформируйте малые группы вокруг рассматриваемых вопросов. Задача группы - определить 1-5 конкретных \
шагов для решения поставленной задачи. Попросите группы презентовать свои результаты. Все участники \
должны подтвердить, что предложенные шаги соответствуют концепции SMART. При необходимости доработайте \
и подтвердите.",
source:    source_agileRetrospectives,
durationDetail:  "20-60 groupsize",
duration:    "Средняя",
stage:    "All",
suitable: "итерация, релиз, проект"
};

all_activities[13] = {
phase:     4,
name:      "Дверь отзывов - Числа",
summary:   "Всего за несколько минут получи отзыв о том, насколько участники довольны ретроспективой", 
desc:      "Приклей на дверь стикеры с цифрами от 1 до 5. Объясни, что циФры представляют шкалу, \
где 1 означает прекрасно или отлично, а 5 - плохо.\
Когда ретроспектива подойдет к концу, попроси всех наклеить стикер около цифры, которая по их мнению \
наиболее точно отобржает, насколько участник доволен ретроспективой.\
Стикер может быть как пустым, так и содержать комментарии или предложения по улучшению ретроспективы.", 
source:    "ALE 2011, " + source_findingMarbles,
durationDetail:  "2-3",
duration:    "Короткая",
stage:    "Формирование, Функционирование",
suitable: "итерация, большие группы"
};

all_activities[14] = {
phase:     4,
name:      "Благодарность",
summary:   "Позволь участникам команды поблагодарить друг друга",
desc:	   "Начни выражать искренюю благодарность одному из участников.\
Похвала может оноситься к любому действию или событию, которое например внесло вклад или способствовало команде или тебе в решении проблемы, ... \
Затем пригласи участников присоединиться и высказать благодарность или похвалу друг другу. \
Молчи некоторое время, чтобы создать небольшое напряжение и побудить участников к действию.\
Закончи, когда молчание длиться больше 1 минуты и никто из участников больше не хочет высказаться.",
source:    source_agileRetrospectives + " who took it from 'The Satir Model: Family Therapy and Beyond'",
durationDetail:  "5-30 groupsize",
duration:    "Короткая",
stage:    "Любая",
suitable: "итерация, релиз, проект"
};

all_activities[15] = {
phase:     4,
name:      "Помагает, Мешает, Гипотеза",
summary:   "Получить конкретный отзыв о том, как ты содействуешь команде",
desc:      "Подготовь 3 флипчарта с названиями 'Помагает', 'Мешает', и 'Гипотеза' \
(предложения о том, что можно попробовать). \
Попроси участиков помочь тебе профессионально рости и улучшить свои навыки фасилитатора. Участники пишут\
на стикерах свои отзывы и имена, чтобы ты мог потом им задать уточняющие вопросы.",
source:    source_agileRetrospectives,
durationDetail:  "5-10",
duration:    "Средняя",
stage:    "Формирование, Бурление",
suitable: "итерация, релиз"
};

all_activities[16] = {
phase:     4, // 5 geht auch
name:      "SaMoLo (More of, Same of, Less of)",
summary:   "Get course corrections on what you do as a facilitator",
desc:      "Divide a flip chart in 3 sections titled 'More of', 'Same of', and 'Less of'. \
Ask participants to nudge your behaviour into the right direction: Write stickies \
with what you should do more, less and what is exactly right. Read out and briefly \
discuss the stickies section-wise.",
source:    "<a href='http://fairlygoodpractices.com/samolo.htm'>Fairly good practices</a>",
more:      "<a href='http://www.scrumology.net/2010/05/11/samolo-retrospectives/'>David Bland's experiences</a>",
durationDetail:  "5-10",
duration:    "Medium",
stage:    "Forming, Storming",
suitable: "iteration, release, project"
};
all_activities[17] = {
phase:     0,
name:      "Check In - Amazon Review",
summary:   "Review the iteration on Amazon. Don't forget the star rating!",
desc:      "Each team member writes a short review with: \
<ul>\
    <li>Title</li>\
    <li>Content</li>\
    <li>Star rating (5 stars is the best) </li>\
</ul>\
Everyone reads out their review. Record the star ratings on a flip chart.<br>\
Can span whole retrospective by also asking what is recommended about the iteration and what not.",
source:    "<a href='http://blog.codecentric.de/2012/02/unser-sprint-bei-amazon/'>Christian Hei&szlig;</a>",
durationDetail:  "10",
duration:    "Long",
stage:    "All",
suitable: "release, project"
};
all_activities[18] = {
phase:     1,
name:      "Speedboat / Sailboat",
summary:   "Analyze what forces push you forward and what pulls you back",
desc:      "Draw a speedboat onto a flip chart paper. Give it a strong motor as well \
as a heavy anchor. Team members silently write on sticky notes what propelled the team forward \
and what kept it in place. One idea per note. Post the stickies motor and anchor respectively. \
Read out each one and discuss how you can increase 'motors' and cut 'anchors'. \
<br><br> \
Variation: Some people add an iceberg in the back of the image. The iceberg represents obstacles \
they already see coming.",
source:    source_innovationGames + ", found at <a href='http://leadinganswers.typepad.com/leading_answers/2007/10/calgary-apln-pl.html'>Mike Griffiths</a>",
durationDetail:  "10-15 groupSize",
duration:    "Medium",
stage:    "All",
suitable: "iteration, release"
};
all_activities[19] = {
phase:     2,
name:      "Perfection Game",
summary:   "What would make the next iteration a perfect 10 out of 10?",
desc:      "Prepare a flip chart with 2 columns, a slim one for 'Rating' and a wide one for 'Actions'. \
Everyone rates the last iteration on a scale from 1 to 10. Then they have to suggest what action(s) \
would make the next iteration a perfect 10.",
source:    "<a href='http://www.benlinders.com/2011/getting-business-value-out-of-agile-retrospectives/'>Ben Linders</a>",
duration:    "Medium",
stage:    "All",
suitable: "iteration, release"
};
all_activities[20] = {
phase:     3,
name:      "Merge",
summary:   "Condense many possible actions down to just two the team will try",
desc:      "Hand out index cards and markers. Tell everyone to write down the two actions they \
want to try next iteration - as concretely as possible \
(<a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART</a>). Then everyone pairs \
up with their neighbor and both together must merge their actions into a single list with \
two actions. The pairs form groups of 4. Then 8. Now collect every group's two action items \
and have a vote on the final two.",
source:    "Lydia Grawunder & Sebastian Nachtigall",
durationDetail:  "15-30 groupSize",
duration:    "Medium",
stage:    "All",
suitable: "iteration, release, project, largeGroups"
};
all_activities[21] = {
phase:     0,
name:      "Измерение температуры",
summary:   "Участники отмечают свою 'температуру' (настроение) на флипчарте",
desc:      "Подготовьте флипчарт с чертежом термометра от замерзания до температуры тела к кипятку. \
Каждый участник отмечает свое настроение",
duration:    "Короткая",
stage:    "All",
source:  source_unknown,
};
all_activities[22] = {
phase:     4,
name:      "Дверь отзывов - со смайликами",
summary:   "Узнай уровень удовлетворенности с ретроспективой за минимальный срок, используя смайлики",
desc:      "Нарисуйте ':)', ':|', и ':(' на листе бумаги и прикрепите его на дверь. \
Когда заканчится ретроспектива, попросите участников, дать отзыв буквой 'X' под подходящим смайликом.",
source:    "<a href='http://boeffi.net/tutorials/roti-return-on-time-invested-wie-funktionierts/'>Boeffi</a>",
durationDetail:  "2-3",
duration:    "Короткая",
stage:    "All",
suitable: "итерация, большаяГруппа"
};
all_activities[23] = {
phase:     3,
name:      "Open Items List",
summary:   "Participants propose and sign up for actions",
desc:      "Prepare a flip chart with 3 columns titled 'What', 'Who', and 'Due'. \
Ask one participant after the other, what they want to do to advance \
the team. Write down the task, agree on a 'done by'-date and let them sign \
their name. <br>\
If someone suggests an action for the whole team, the proposer needs to get \
buy-in (and signatures) from the others.",
source:    source_findingMarbles + ", inspired by <a href='http://lwscologne.wordpress.com/2012/05/08/11-treffen-der-limited-wip-society-cologne/#Retrospektiven'>this list</a>",
durationDetail:  "10-15 groupSize",
duration:    "Medium",
stage:    "All",
suitable: "iteration, release, smallGroups"
};
all_activities[24] = {
phase:     2,
name:      "Cause-Effect-Diagram",
summary:   "Find the source of problems whose origins are hard to pinpoint and lead to endless discussion",
desc:      "Write the problem you want to explore on a sticky note and put it in the middle of a whiteboard. \
Find out why that is a problem by repeatedly asking 'So what?'. Find out the root causes \
by repeatedly asking 'Why (does this happen)?' Document your findings by \
writing more stickies and showing causal relations with arrows. Each sticky can have more than \
one reason and more than one consequence<br> \
Vicious circles are usually good starting points for actions. If you can break their bad \
influence, you can gain a lot.",
source:    "<a href='http://blog.crisp.se/2009/09/29/henrikkniberg/1254176460000'>Henrik Kniberg</a>",
more:      "<a href='http://finding-marbles.com/2011/08/04/cause-effect-diagrams/'>Corinna's experiences</a>",
durationDetail:  "20-60 complexity",
duration:    "Long",
stage:    "Storming, Norming",
suitable: "release, project, smallGroups, complex"


};
all_activities[25] = {
phase:     2,
name:      "Быстрое свидание",
summary:   "Каждый участник команды подробно обсуждает одну тему с помощью серий разговоров 1 на 1",
desc:      "Каждый участник записывает одну тему, которую он хочет обсудить, например что-то, что он хочет \
изменить. Затем участники формируют пары и распределяются по комнате. Каждыя пара обсуждает две темы (по одной от каждого из участников)\
и обдумывает возможные действия - на каждую тему дается по 5 минут и темы обсуджаются по очереди. \
Через 10 минут пары расфорируются и участники создают новые пары. Так продолжаем, \
пока каждый участник не переговорит со всеми другими участниками команды. <br>\
Если количество участников в группе нечетное, то фасилитатор составляет пару, но не предлагает свою тему. \
Участник получает на обсуждеие своей темы все 10 минут.",
source:    "<a href='http://vinylbaustein.net/tag/retrospective/'>Торстен Калнин (Thorsten Kalnin)</a>",
durationDetail:  "10 perPerson",
duration:    "Длительная",
stage:    "Бурление, Нормирование",
suitable: "итерация, релиз, небольшие группы"
};
all_activities[26] = {
phase:     5,
name:      "Печенье для ретроспективы",
summary:   "Организуй обед для команды и инициируй обсуждение предсказаний из печенья для ретроспективы.",
desc:      "Предложи команде пообедать вместе, лучше всего в китайском или азиатском кафе, чтобы оставаться "в теме". \
Распределите печенье с предсказаниями. Каждый участник открывает свое печенье и все обсуждают предсказание.  \
Примеры предсказаний: \
<ul>\
    <li>Что было наиболее эффективно в этой итерации и почему это было настолько успешно?</li>\
    <li>Отображает ли реальность наша диаграмма сгорания? Почему да или почему нет?</li>\
    <li>Чем ты способствуешь обществу разрботчиков в нашей компании?  Какой вклад ты еще можешь внести?</li>\
    <li>Что было в этой итерации наибольшим препятствием для команды?</li>\
</ul>\
Такое печенье можно  <a href='http://weisbart.com/cookies/'> заказать в Weisbart</a> \
либо испечь самостоятельно, если английский не родной язык для команды.",
source:    "<a href='http://weisbart.com/cookies/'>Adam Weisbart</a>",
durationDetail:  "90-120",
duration:    "Длительная",
stage:    "Функционирование, Стагнация, Расформирование",
suitable: "итерация, релиз, небольшие группы"
};
all_activities[27] = {
phase:     5,
name:      "Take a Walk",
summary:   "Go to the nearest park and wander about and just talk",
desc:      "Is there nice weather outside? Then why stay cooped up inside, when walking fills your brain with oxygen \
and new ideas 'off the trodden track'. Get outside and take a walk in the nearest park. Talk will \
naturally revolve around work. This is a nice break from routine when things run relatively smoothly and \
you don't need visual documentation to support discussion. Mature teams can easily spread ideas and reach \
consensus even in such an informal setting.",
source:    source_findingMarbles,
durationDetail:  "60-90",
duration:    "Длительная",
stage:    "Функционирование, Расформирование",
suitable: "итерация, релиз, небольшие группы, smoothSailing, mature"
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
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/07/26/circles-and-soup/'>Diana Larsen</a> who adapted it from 'Seven Habits of Highly Effective People' by Stephen Covey and <a href='http://www.ayeconference.com/wiki/scribble.cgi?read=CirclesOfControlInfluenceAndConcern'>Circle of Influence and Concern</a>' by Jim Bullock",
duration:    "Средняя",
stage:    "Формирование, Бурление, Нормирование",
suitable: "итерация, релиз, проект, stuck, immature"
};
all_activities[29] = {
phase:     5,
name:      "Dialogue Sheets",
summary:   "A structured approach to a discussion",
desc:      "A dialogue sheet looks a little like a board game board. There are \
<a href='http://www.softwarestrategy.co.uk/dialogue-sheets/'>several different sheets available</a>. \
Choose one, print it as large as possible (preferably A1) and follow its instructions.",
source:    "<a href='http://www.softwarestrategy.co.uk/dialogue-sheets/'>Allen Kelly at Software Strategy</a>",
durationDetail:  "90-120",
duration:    "Длительная",
stage:    "Любая",
suitable: "итерация, релиз, проект"
};
all_activities[30] = {
phase:     0,
name:      "Check In - Draw the Iteration",
summary:   "Participants draw some aspect of the iteration",
desc:      "Distribute index cards and markers. Set a topic, e.g. one of the following: \
<ul>\
    <li>How did you feel during the iteration?</li>\
    <li>What was the most remarkable moment?</li>\
    <li>What was the biggest problem?</li>\
    <li>What did you long for?</li>\
</ul>\
Ask the team members to draw their answer. Post all drawings on a whiteboard. For each drawing \
let people guess what it means, before the artist explains it.<br> \
Metaphors open new viewpoints and create a shared understanding.",
source:    source_findingMarbles + ", adapted from <a href='http://vinylbaustein.net/2011/03/24/draw-the-problem-draw-the-challenge/'>Thorsten Kalnin</a> and Olivier Gourment",
durationDetail:  "5 + 3 на человека",
duration:    "Средняя",
stage:    "Функционирование",
suitable: "итерация, релиз, проект"
};
all_activities[31] = {
phase:     0,
name:      "Emoticon Project Gauge",
summary:   "Help team members express their feelings about a project and address root causes early",
desc:      "Prepare a flipchart with faces expressing various emotions such as: \
<ul>\
    <li>shocked / surprised</li>\
    <li>nervous / stressed</li>\
    <li>unempowered / constrained</li>\
    <li>confused</li>\
    <li>happy</li>\
    <li>mad</li>\
    <li>overwhelmed</li>\
</ul>\
Let each team member choose how they feel about the project. This is a fun and effective way to \
surface problems early. You can address them in the subsequent phases.",
source:    "Andrew Ciccarelli",
durationDetail:  "10 for 5 people",
duration:    "Short",
stage:    "All",
suitable: "iteration, release"
};
all_activities[32] = {
phase:     1,
name:      "Proud & Sorry",
summary:   "What are team members proud or sorry about?",
desc:      "Put up two posters labeled 'proud' and 'sorry'. Team members write down \
one instance per sticky note. When the time is up have everyone read \
out their note and post it to the appropriate poster.<br>\
Start a short conversation e.g. by asking:\
<ul>\
    <li>Did anything surprise you?</li>\
    <li>What patterns do you see? What do they mean for you as a team?</li>\
</ul>",
source:    source_agileRetrospectives,
durationDetail:  "10-15",
duration:    "Medium",
stage:    "All",
suitable: "iteration, release"
};
all_activities[33] = {
phase:     4,
name:      "Shower of Appreciation",
summary:   "Listen to others talk behind your back - and only the good stuff!",
desc:      "Form groups of 3. Each group arranges their chairs so that 2 chairs \
face each other and the third one has its back turned, like this: >^<. \
The two people in the chairs that face each other talk about the third person for 2 minutes. \
They may only say positive things and nothing that was said may be reduced in meaning by \
anything said afterwards. <br>\
Hold 3 rounds so that everyone sits in the shower seat once.",
source:    "<a href='http://www.miarka.com/de/2010/11/shower-of-appreciation-or-talking-behind-ones-back/'>Ralph Miarka</a>",
durationDetail:  "10-15",
duration:    "Short",
stage:    "Norming, Performing",
suitable: "iteration, release, matureTeam"
};
all_activities[34] = {
phase:     1,
name:      "Agile Self-Assessment",
summary:   "Assess where you are standing with a checklist",
desc:      "Print out a checklist that appeals to you, e.g.:\
<ul>\
    <li><a href='http://www.crisp.se/gratis-material-och-guider/scrum-checklist'>Henrik Kniberg's excellent Scrum Checklist</a></li>\
    <li><a href='http://finding-marbles.com/2011/09/30/assess-your-agile-engineering-practices/'>Self-assessment of agile engineering practices</a></li>\
    <li><a href='http://agileconsortium.blogspot.de/2007/12/nokia-test.html'>Nokia Test</a></li>\
</ul>\
Go through them in the team and discuss where you stand and if you're on the right track. <br>\
This is a good activity after an iteration without major events.",
source:    source_findingMarbles,
durationDetail:  "10-25 minutes depending on the list",
duration:    "Medium",
stage:    "All",
suitable: "smallTeams, iteration, release, project, smoothGoing"
};
all_activities[35] = {
phase:     0,
name:      "Appreciative Goal",
summary:   "State an affirmative goal for the session",
desc:      "Concentrate on positive aspects instead of problems by setting an affirmative goal, e.g.\
<ul>\
    <li>Let's find ways to amplify our strengths in process and teamwork</li>\
    <li>Let's find out how to extend our best uses of engineering practices and methods</li>\
    <li>We'll look at our best working relationships and find ways to build more relationships like that</li>\
    <li>We'll discover where we added the most value during our last iteration to increase the value we'll add during the next</li>\
</ul>",
source:    "<a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
durationDetail:  "3 minutes",
duration:    "Short",
stage:    "All",
suitable: "iteration, release, project"
};
all_activities[36] = {
phase:     2,
name:      "Remember the Future",
summary:   "Imagine the next iteration is perfect. What is it like? What did you do?",
desc:      "'Imagine you could time travel to the end of the next iteration (or release). You learn that it was \
the best, most productive iteration yet! How do your future selves describe it? What do you \
see and hear?' Give the team a little time to imagine this state and jot down some keywords to aid their memory. \
Then let everyone describe their vision of a perfect iteration.<br>\
Follow up with 'What changes did we implement that resulted in such a productive and satisfying future?'\
Write down the answers on index cards to use in the next phase.",
source:    source_innovationGames + ", found at <a href='http://www.ayeconference.com/appreciativeretrospective/'>Diana Larsen</a>",
duration:    "Medium",
stage:    "Storming",
suitable: "iteration, release, project"
};
all_activities[37] = {
phase:     3,
name:      "Dot Voting - Keep, Drop, Add",
summary:   "Brainstorm what behaviors to keep, drop & add and pick the top initiatives",
desc:      "Divide a flip chart into boxes headed with  'Keep', 'Drop' and 'Add'. \
Ask your participants to write concrete proposals for each category - 1 \
idea per index card. Let them write in silence for a few minutes. \
Let everyone read out their notes and post them to the appropriate category. \
Lead a short discussion on what the top 20% beneficial ideas are. Vote on it by distributing dots \
or X's with a marker, e.g. 1, 2, and 3 dots for each person to distribute. \
The top 2 or 3 become your action items.",
source:    source_agileRetrospectives,
durationDetail:  "15-30",
duration:    "Medium",
stage:    "All",
suitable: "iteration"
};
all_activities[38] = {
phase:     3,
name:      "Dot Voting - Worked well, Do differently",
summary:   "Brainstorm what worked well & what to do differently and pick the top initiatives",
desc:      "Head 2 flip charts with 'Worked well' and 'Do differently next time' respectively. \
Ask your participants to write concrete proposals for each category - 1 \
idea per index card. Let them write in silence for a few minutes. \
Let everyone read out their notes and post them to the appropriate category. \
Lead a short discussion on what the top 20% beneficial ideas are. Vote on it by distributing dots \
or X's with a marker, e.g. 1, 2, and 3 dots for each person to distribute. \
The top 2 or 3 become your action items.",
source:    source_agileRetrospectives,
durationDetail:  "15-30",
duration:    "Medium",
stage:    "All",
suitable: "iteration"
};
all_activities[39] = {
phase:     4,
name:      "Plus & Delta",
summary:   "Each participant notes 1 thing they like and 1 thing they'd change about the retro",
desc:      "Prepare a flip chart with 2 columns: Head them with 'Plus' and 'Delta'. \
Ask each participant to write down 1 aspect of the retrospective they liked \
and 1 thing they would change (on different index cards). Post the index \
cards and walk through them briefly to clarify the exact meaning and detect \
the majority's preference when notes from different people point into opposite directions.",
source:    "<a href='http://agileretrospectivewiki.org/index.php?title=Weekly_Retrospective_Simple_%2B_delta'>Rob Bowley</a>",
durationDetail:  "5-10",
duration:    "Medium",
stage:    "All",
suitable: "release, project"
};
all_activities[40] = {
phase:     2,
name:      "Park Bench",
summary:   "Group discussion with varying subsets of participants",
desc:      "Place at least 4 and at most 6 chairs in a row so that they face the group. \
Explain the rules: \
		<ul>\
    <li>Take a bench seat when you want to contribute to the discussion</li>\
    <li>One seat must always be empty</li>\
    <li>When the last seat is taken, someone else must leave and return to the audience</li>\
</ul>\
Get everything going by sitting on the 'bench' and wondering aloud about \
something you learned in the previous phase until someone joins. \
End the activity when discussion dies down. \
<br>This is a variant of 'Fish Bowl'. It's suited for groups of 10-25 people.",
source:    "<a href='http://www.futureworksconsulting.com/blog/2010/08/24/park-bench/'>Diana Larsen</a>",
durationDetail:  "15-30",
duration:    "Medium",
stage:    "All",
suitable: "release, project, largeGroups"
};
all_activities[41] = {
phase:     0,
name:      "Postcards",
summary:   "Participants pick a postcard that represents their thoughts / feelings",
desc:      "Bring a stack of diverse postcards - at least 4 four times as many as participants. \
Scatter them around the room and instruct team members to pick the postcard that best \
represents their view of the last iteration. After choosing they write down three keywords \
describing the postcard, i.e. iteration, on index cards. In turn everyone hangs up their post- and \
index cards and describes their choice.",
source:    "<a href='http://finding-marbles.com/2012/03/19/retrospective-with-postcards/'>Corinna Baldauf</a>",
durationDetail:  "15-20",
duration:    "Medium",
stage:    "All",
suitable: "iteration, release, project",
};
all_activities[42] = {
phase:     0,
name:      "Take a Stand - Opening",
summary:   "Participants take a stand, indicating their satisfaction with the iteration",
desc:      "Create a big scale (i.e. a long line) on the floor with masking tape. Mark one \
end as 'Great' and the other as 'Bad'. Let participants stand on the scale \
according to their satisfaction with the last iteration. Psychologically, \
taking a stand physically is different from just saying something. It's more 'real'.<br> \
You can reuse the scale if you close with activity #44.",
source:    source_findingMarbles + ", inspired by <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
durationDetail:  "2-5",
duration:    "Short",
stage:    "All",
suitable: "iteration, release, project"
};
all_activities[43] = {
phase:     4,
name:      "Take a Stand - Closing",
summary:   "Participants take a stand, indicating their satisfaction with the retrospective",
desc:      "Create a big scale (i.e. a long line) on the floor with masking tape. Mark one \
end as 'Great' and the other as 'Bad'. Let participants stand on the scale \
according to their satisfaction with the retrospective. Psychologically, \
taking a stand physically is different from just saying something. It's more 'real'.<br> \
See activity #43 on how to begin the retrospective with the same scale.",
source:    source_findingMarbles + ", inspired by <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
durationDetail:  "2-5",
duration:    "Short",
stage:    "All",
suitable: "iteration, release, project"
};
all_activities[44] = {
phase:     4,
name:      "Pleased & Surprised",
summary:   "What pleased and / or surprised participants in the retrospective",
desc:      "Just make a quick round around the group and let each participant point out one \
finding of the retrospective that either surprised or pleased them (or both).",
source:    source_unknown,
durationDetail:  "5",
duration:    "Short",
stage:    "All",
suitable: "iteration, release, project"
};
all_activities[45] = {
phase:     0,
name:      "Why Retrospectives?",
summary:   "Ask 'Why do we do retrospectives?'",
desc:      "Go back to the roots and start into the retrospective by asking 'Why do we do this?' \
Write down all answers for everyone to see. You might be surprised.",
source:    "<a href='http://proessler.wordpress.com/2012/07/20/check-in-activity-agile-retrospectives/'>Pete Roessler</a>",
durationDetail:  "5",
duration:    "Short",
stage:    "Forming, Performing, Stagnating",
suitable: "iteration, release, project"
};
all_activities[46] = {
phase:     1,
name:      "Empty the Mailbox",
summary:   "Look at notes collected during the iteration",
desc:      "Set up a 'retrospective mailbox' at the beginning of the iteration. Whenever something \
significant happens or someone has an idea for improvement, they write it \
down and 'post' it. (Alternatively the 'mailbox' can be a visible place. This can spark \
discussion during the iteration.) <br>\
Go through the notes and discuss them.<br>\
A mailbox is great for long iterations and forgetful teams.",
source:    source_skycoach,
more:      "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Original article</a>",
durationDetail:  "15",
duration:    "Medium",
stage:    "All",
suitable: "release, project"
};
all_activities[47] = {
phase:     3,
name:      "Take a Stand - Line Dance",
summary:   "Get a sense of everyone's position and reach consensus",
desc:      "When the team can't decide between two options, create a big scale (i.e. a long line) \
on the floor with masking tape. Mark one end as option A) and the other as option B). \
Team members position themselves on the scale according to their preference for either option. \
Now tweak the options until one option has a clear majority.",
source:    source_skycoach,
more:      "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Original article</a>",
durationDetail:  "5-10 per decision",
duration:    "Short",
stage:    "Storming, Norming",
suitable: "iteration, release, project"
};
all_activities[48] = {
phase:     3,
name:      "Dot Voting - Starfish",
summary:   "Collect what to start, stop, continue, do more and less of",
desc:      "Draw 5 spokes on a flip chart paper, dividing it into 5 segments. \
Label them 'Start', 'Stop', 'Continue', 'Do More' and 'Do less'. \
Participants write their proposals on sticky notes and put \
them in the appropriate segment. After clustering stickies that capture the \
same idea, dot vote on which suggestions to try.",
source:    "<a href='http://www.thekua.com/rant/2006/03/the-retrospective-starfish/'>Pat Kua</a>",
durationDetail:  "15 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, release, project"
};
all_activities[49] = {
phase:     2,
name:      "Wish granted",
summary:   "A fairy grants you a wish - how do you know it came true?",
desc:      "Give participants 2 minutes to silently ponder the following question: \
'A fairy grants you a wish that will fix your biggest problem \
at work overnight. What do you wish for?' Follow up with: 'You come to work the next \
morning. You can tell, that the fairy has granted your wish. How do you know? \
What is different now?' If trust within the group is high, let everyone describe \
their 'Wish granted'-workplace. If not, just tell the participants to keep their \
scenario in mind during the next phase and suggest actions that work towards making it real.",
source:    "Lydia Grawunder &amp; Sebastian Nachtigall",
durationDetail:  "15 min",
duration:    "Medium",
stage:    "Storming, Norming",
suitable:  "iteration"
};
all_activities[50] = {
phase:     1,
name:      "Lean Coffee",
summary:   "Use the Lean Coffee format for a focused discussion of the top topics",
desc:      "Say how much time you set aside for this phase, then explain the rules of Lean Coffee for retrospectives: \
		<ul> \
    <li>Everyone writes down topics they’d like to discuss - 1 topic per sticky</li>\
    <li>Put the stickies up on a whiteboard or flipchart. The person who wrote it describes the topic in 1 or 2 sentences. Group stickies that are about the same topic</li>\
    <li>Everyone dot-votes for the 2 topics they want to discuss</li>\
    <li>Order the stickies according to votes</li>\
    <li>Start with the topic of highest interest</li>\
    <li>Set a timer for 5 minutes. When the timer beeps, everyone gives a quick thumbs up or down. Majority of thumbs up: The topic gets another 5 minutes. Majority of thumbs down: Start the next topic. </li>\
</ul> \
Stop when the allotted time is over.",
source:    "<a href='http://leancoffee.org/'>Original description</a> and <a href='http://finding-marbles.com/2013/01/12/lean-altbier-aka-lean-coffee/'>in action</a>",
durationDetail:  "20-40 min",
duration:    "Flexible",
stage:    "All",
suitable:  "iteration"
};
all_activities[51] = {
phase:     0,
name:      "Constellation - Opening",
summary:   "Let the participants affirm or reject statements by moving around",
desc:      "Place a circle or sphere in the middle of a free space. Let the team gather around it. \
Explain that the circle is the center of approval: If they agree to a statement they should move towards it, \
if they don't, they should move as far outwards as their degree of disagreement. Now read out statements, e.g.\
<ul>\
    <li>I feel I can talk openly in this retrospective</li>\
    <li>I am satisfied with the last iteration</li>\
    <li>I am happy with the quality of our code</li>\
    <li>I think our continuous integration process is mature</li>\
</ul>\
Watch the constellations unfold. Afterwards ask which constellations were surprising.<br>\
This can also be a closing activity (#53).",
source:    "<a href='http://www.coachingagileteams.com/'>Lyssa Adkins</a> via <a href='http://lmsgoncalves.com/2013/01/23/constellation-a-good-exercise-to-set-the-stage-in-the-retrospective/'>Luis Goncalves</a>",
durationDetail:  "10 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[52] = {
phase:     4,
name:      "Constellation - Closing",
summary:   "Let the participants rate the retrospective by moving around",
desc:      "Place a circle or sphere in the middle of a free space. Let the team gather around it. \
Explain that the circle is the center of approval: If they agree to a statement they should move towards it, \
if they don't, they should move as far outwards as their degree of disagreement. Now read out statements, e.g.\
<ul>\
    <li>We talked about what was most important to me</li>\
    <li>I spoke openly today</li>\
    <li>I think the time of the retrospective was well invested</li>\
    <li>I am confident we will carry out our action items</li>\
</ul>\
Watch the constellations unfold. Any surprising constellations?<br>\
This can also be an opening activity (#52).",
source:    "<a href='http://www.coachingagileteams.com/'>Lyssa Adkins</a> via <a href='http://lmsgoncalves.com/2013/01/23/constellation-a-good-exercise-to-set-the-stage-in-the-retrospective/'>Luis Goncalves</a>, <a href='http://www.softwareleid.de/2012/06/eine-retro-im-kreis.html'>Christoph Pater</a>",
durationDetail:  "5 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[53] = {
phase:     1,
name:      "Story Oscars",
summary:   "The team nominates stories for awards and reflects on the winners",
desc:      "Display all stories completed in the last iterations on a board. \
Create 3 award categories (i.e. boxes on the board):\
<ul>\
    <li>Best story</li>\
    <li>Most annoying story</li>\
    <li>... 3rd category invented by the team ...</li>\
</ul>\
Ask the team to 'nominate' stories by putting them in one of the award boxes. <br>\
For each category: Dot-vote and announce the winner. \
Ask the team why they think the user story won in this category \
and let the team reflect on the process of completing the tasks - what went good or wrong.",
source:    "<a href='http://www.touch-code-magazine.com'>Marin Todorov</a>",
durationDetail:  "30-40 min",
duration:    "Short",
stage:    "Forming, Storming, Norming",
suitable:  "project, release",
};
all_activities[54] = {
phase:     2,
name:      "Original 4",
summary:   "Ask Norman Kerth's 4 key questions",
desc:      "Norman Kerth, inventor of retrospectives, identified the following 4 questions as key: \
<ul>\
    <li>What did we do well, that if we didn’t discuss we might forget?</li>\
    <li>What did we learn?</li>\
    <li>What should we do differently next time?</li>\
    <li>What still puzzles us?</li>\
</ul>\
What are the team's answers?",
source:    "<a href='http://www.retrospectives.com/pages/RetrospectiveKeyQuestions.html'>Norman Kerth</a>",
durationDetail:  "15 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[55] = {
phase:     5,
name:      "Invite a Customer",
summary:   "Bring the team into direct contact with a customer or stakeholder",
desc:      "Invite a customer or internal stakeholder to your retrospective.\
Let the team ask ALL the questions:\
<ul>\
    <li>How does the client use your product?</li>\
    <li>What makes them curse the most?</li>\
    <li>Which function makes their life easier?</li>\
    <li>Let the client demonstrate their typical workflow</li>\
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
name:      "Say it with Flowers",
summary:   "Each team member appreciates someone else with a flower",
desc:      "Buy one flower for each team member and reveal them at the end of the retrospective. \
Everyone gets to give someone else a flower as a token of their appreciation.",
source:    "<a href='http://skycoach.be/2010/06/17/12-retrospective-exercises/'>Nick Oostvogels</a>",
durationDetail:  "5 min",
duration:    "Short",
stage:    "Norming, Performing",
suitable:  "iteration, project"
};
all_activities[57] = {
phase:     2,
name:      "Undercover Boss",
summary:   "If your boss had witnessed the last iteration, what would she want you to change?",
desc:      "Imagine your boss had spent the last iteration - unrecognized - among you. What would she \
think about your interactions and results? What would she want you to change? \
<br>This setting encourages the team to see themselves from a different angle.",
source:    "<a href='http://loveagile.com/retrospectives/undercover-boss'>Love Agile</a>",
durationDetail:  "10-15 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[58] = {
phase:     0,
name:      "Happiness Histogram",
summary:   "Create a happiness histogram to get people talking",
desc:      "Prepare a flip chart with a horizontal scale from 1 (Unhappy) \
to 5 (Happy).\
<ul>\
    <li>One team member after the other places their sticky note according to their happiness and comment on their placement</li>\
    <li>If anything noteworthy comes from the reason, let the team choose to either discuss it there and then or postpone it for later in the retrospective</li>\
    <li>If someone else has the same score, they place their sticky above the placed one, effectively forming a histogram</li>\
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
summary:   "Throw a ball around and uncover learning",
desc:      "Throw a ball (e.g. koosh ball) around the team and uncover positive thoughts and learning experiences. Give out a question at the beginning \
that people answer when they catch the ball, such as: \
<ul>\
    <li>One thing I learned in the last iteration</li>\
    <li>One awesome thing someone else did for me</li>\
</ul>\
Depending on the question it might uncover events that are bugging people. If any alarm bells go off, dig a little deeper. With the '1 nice thing'-question \
you usually close on a positive note.",
source:    "<a href='http://scrumfoundation.com/about/catherine-louis'>Catherine Louis</a> and <a href='http://blog.haaslab.net/'>Stefan Haas</a> via <a href='https://www.linkedin.com/in/misshaley'>Amber Haley</a>",
durationDetail:  "5-10 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project",
};
all_activities[60] = {
phase:     3,
name:      "Chaos Cocktail Party",
summary:   "Actively identify, discuss, clarify and prioritize a number of actions",
desc:      "Everyone writes one card with an action that they think is important to do - \
the more specific (<a href='http://en.wikipedia.org/wiki/SMART_criteria'>SMART</a>), \
the better. Then team members go around and chat about the cards \
like in a cocktail party. Every chat pair discusses the actions on their \
two cards. Stop the chatting after 1 minute. Each chat pair splits \
5 points between the two cards. More points go to the more important action. Organize \
3 to 5 rounds of chats (depending on group size). At the end everyone adds \
up the points on their card. In the end the cards are ranked by points \
and the team decides how much can be done in the next iteration, pulling from the top.\
<br><br>\
Addendum: In many settings you might want to randomly switch the cards in the beginning \
and between discussions. In this way, neither of the point splitting parties has a stake in \
which of the cards gets more points. This is an idea by \
<a href='http://www.thiagi.com/archived-games/2015/2/22/thirty-five-for-debriefing'>Dr. Sivasailam “Thiagi” Thiagarajan</a> via \
<a href='https://twitter.com/ptevis'>Paul Tevis</a>",
source:    "Suzanne Garcia via <a href='http://www.wibas.com'>Malte Foegen</a>",
durationDetail:  "10-15 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release, largeGroup"
};
all_activities[61] = {
phase:     1,
name:      "Expectations",
summary:   "What can others expect of you? What can you expect of them?",
desc:      "Give each team member a piece of paper. The lower half is blank. The top half is divided into two sections:\
<ul>\
    <li>What my team mates can expect from me</li>\
    <li>What I expect from my team mates</li>\
</ul>\
Each person fills out the top half for themselves. When everyone is finished, they pass their \
paper to the left and start reviewing the sheet that was passed to them. In the lower half they \
write what they personally expect from that person, sign it and pass it on.<br>\
When the papers made it around the room, take some time to review and share observations.",
source:    "<a href='http://agileyammering.com/2013/01/25/expectations/'>Valerie Santillo</a>",
durationDetail:  "10-15 min",
duration:    "Medium",
stage:    "Forming, Storming, Norming",
suitable:  "iteration, project, release, start"
};
all_activities[62] = {
phase:     3,
name:      "Low Hanging Fruit",
summary:   "Visualize promise and ease of possible courses of actions to help pick",
desc:      "Reveal a previously drawn tree. Hand out round index cards and instruct participants to \
write down the actions they would like to take - one per card. When everyone's finished, \
collect the cards, shuffle and read them out one by one. Place each 'fruit' according to the \
participants' assessment:\
<ul>\
    <li>Is it easy to do? Place it lower. Hard? More to the top.</li>\
    <li>Does it seem very beneficial? Place it more to the left. Value is dubious at best? To the right.</li>\
</ul>\
The straightforward choice is to pick the bottom left fruit as action items. If this is not \
consensus, you can either have a short discussion to agree on some actions or dot vote.",
source:    "<a href='http://tobias.is'>Tobias Baldauf</a>",
durationDetail:  "10-15 min",
duration:    "Medium",
stage:    "Forming, Storming",
suitable:  "iteration, project, release"
};
all_activities[63] = {
phase:     1,
name:      "Quartering - Identify boring stories",
summary:   "Categorize stories in 2 dimensions to identify boring ones",
desc:      "Draw a big square and divide it into 2 columns. \
Label them 'Interesting' and 'Dull'. Let the team write down everything they did last iteration on stickies and \
put it into the appropriate column. Have them add a rough estimate of how long it took on each of their own stickies.<br> \
Now add a horizontal line so that your square has 4 quadrants. Label the top row 'Short' (took hours) \
and the bottom row 'Long' (took days). Rearrange the stickies in each column.<br> \
The long and dull stories are now nicely grouped to 'attack' in subsequent phases.<br> \
<br>\
(Splitting the assessment into several steps, improves focus. You can \
<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>\
    adapt Quartering for lots of other 2-dimensional categorizations</a>.)",
source:    "<a href='http://waynedgrant.wordpress.com/2012/08/12/diy-sprint-retrospective-techniques/'>Wayne D. Grant</a>",
durationDetail:  "10",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project",
};
all_activities[64] = {
phase:     1,
name:      "Appreciative Inquiry",
summary:   "Lift everyone's spirit with positive questions",
desc:      "This is a round-based activity. In each round you ask the team a question, they write down their answers \
(gives everyone time to think) and then read them out to the others.<br>\
Questions proposed for Software Development teams:\
<ol>\
    <li>When was the last time you were really engaged / animated / productive? What did you do? What had happened? How did it feel?</li>\
    <li>From an application-/code-perspective: What is the awesomest stuff you've built together? What makes it great?</li>\
    <li>Of the things you built for this company, which has the most value? Why?</li>\
    <li>When did you work best with the Product Owner? What was good about it?</li>\
    <li>When was your collaboration best?</li>\
    <li>What was your most valuable contribution to the developer community (of this company)? How did you do it?</li>\
    <li>Leave your modesty at the door: What is the most valuable skill / character trait you contribute to the team? Examples?</li>\
    <li>What is your team's most important trait? What sets you apart?</li>\
</ol>\
<br>\
('Remember the Future' (#37) works well as the next step.)",
source:    "<a href='http://blog.8thlight.com/doug-bradbury/2011/09/19/apreciative_inquiry_retrospectives.html'>Doug Bradbury</a>, adapted for SW development by " + source_findingMarbles,
durationDetail:  "20-25 min groupsize",
duration:    "Medium",
stage:    "Storming",
suitable:  "iteration, project"
};
all_activities[65] = {
phase:     2,
name:      "Brainwriting",
summary:   "Written brainstorming levels the playing field for introverts",
desc:      "Pose a central question, such as 'What actions should we take in the next iteration to improve?'. \
Hand out paper and pens. Everybody writes down their ideas. After 3 minutes everyone passes their \
paper to their neighbour and continues to write on the one they've gotten. As soon as they run out of \
ideas, they can read the ideas that are already on the paper and extend them. Rules: No negative \
comments and everyone writes their ideas down only once. (If several people write down the same idea, \
that's okay.) <br>\
Pass the papers every 3 minutes until everyone had every paper. Pass one last time. Now everyone \
reads their paper and picks the top 3 ideas. Collect all top 3's on a flip chart for the next phase.",
source:    "Prof. Bernd Rohrbach",
durationDetail:  "20 min groupsize",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release, introverts"
};
all_activities[66] = {
phase:     4,
name:      "Take Aways",
summary:   "Capture what participants learned during the retro",
desc:      "Everyone writes a sticky note with the most remarkable thing they learned during the retro. Put \
the notes against the door. In turn each participant reads out their own note.",
source:     source_judith,
durationDetail:  "5 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[67] = {
phase:     2,
name:      "Company Map",
summary:   "Draw a map of the company as if it was a country",
desc:      "Hand out pens and paper. Pose the question 'What if the company / department / team was territory? \
What would a map for it look like? What hints would you add for save travelling?' Let participants draw \
for 5-10 minutes. Hang up the drawings. Walk through each one to clarify and discuss interesting metaphors.",
source:     source_judith,
durationDetail:  "15 min groupsize",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[68] = {
phase:     2,
name:      "The Worst We Could Do",
summary:   "Explore how to ruin the next iteration for sure",
desc:      "Hand out pens and sticky notes. Ask everyone for ideas on how to turn the next iteration / release \
into a certain desaster - one idea per note. When everyone's finished writing, hang up all stickies \
and walk through them. Identify and discuss themes. <br>\
In the next phase turn these negative actions into their opposite.",
source:     source_findingMarbles,
durationDetail:  "15 min groupsize",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[69] = {
phase:     0,
name:      "3 for 1 - Opening",
summary:   "Check satisfaction with iteration results, communication &amp; mood all at once",
desc:      "Prepare a flip chart with a co-ordinate plane on it. The Y-axis is 'Satisfaction with iteration result'. \
The X-axis is 'Number of times we coordinated'. Ask each participant to mark where their satisfaction \
and perceived touch points intersect - with an emoticon showing their mood (not just a dot).\
Discuss surprising variances and extreme moods.<br>\
(Vary the X-axis to reflect current team topics, e.g. 'Number of times we pair programmed'.)",
source:     source_judith,
durationDetail:  "5 min groupsize",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[70] = {
phase:     4,
name:      "3 for 1 - Closing: Was everyone heard?",
summary:   "Check satisfaction with retro results, fair distribution of talk time &amp; mood",
desc:      "Prepare a flip chart with a co-ordinate plane on it. The Y-axis is 'Satisfaction with retro result'. \
The X-axis is 'Equal distribution of talking time' (the more equal, the farther to the right). \
Ask each participant to mark where their satisfaction and perceived talking time balance intersect - \
with an emoticon showing their mood (not just a dot). Discuss talking time inequalities (and extreme moods).",
source:     source_judith,
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[71] = {
phase:     3,
name:      "Divide the Dollar",
summary:   "How much is an action item worth to the team?",
desc:      "Hang up the list of possible actions. Draw a column next to it, titled 'Importance (in $)'. \
The team gets to spend 100 (virtual) dollars on the action items. The more \
important it is to them, the more they should spend. Make it more fun by bringing paper \
money from a board game such as Monopoly.\
<br><br>Let them agree on prices. Consider the 2 or 3 highest amount action items as chosen.",
source:     "<a href='http://www.gogamestorm.com/?p=457'>Gamestorming</a>",
durationDetail:  "10 min groupsize",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[72] = {
phase:     3,
name:      "Pitch",
summary:   "Ideas for actions compete for 2 available 'Will do'-slots",
desc:      "[Caution: This game creates 'winners' and 'losers'. Don't use it if the team has power imbalances.]\
<br><br> \
Ask everyone to think of 2 changes they'd like to implement and write them down on separate \
index cards. Draw 2 slots on the board. The first team member puts their favorite change idea \
into the first slot. His neighbor puts their favorite into the second slot. The third member has \
to pitch her favorite idea against the one already hanging that she favors less. If the team \
prefers her idea, it's swapped against the hanging one. This continues until everyone has presented \
both their cards. \
<br><br>Try not to start the circle with dominant team members.",
source:     source_judith,
durationDetail:  "15 min groupsize",
duration:    "Medium",
stage:    "Performing",
suitable:  "iteration"
};
all_activities[73] = {
phase:     2,
name:      "Pessimize",
summary:   "If we had ruined the last iteration what would we have done?",
desc:      "You start the activity by asking: 'If we had completely ruined last iteration what would we have done?' \
Record the answers on a flip chart. Next question: 'What would be the opposite of that?' \
Record it on another flip chart. Now ask participants to comment the items on the 'Opposite'-chart \
by posting sticky notes answering 'What keeps us from doing this?'. Hand out different colored \
sticky notes to comment on the comments, asking 'Why is it like this?'.",
source:     source_judith,
durationDetail:  "25 min groupsize",
duration:    "Long",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[74] = {
phase:     1,
name:      "Writing the Unspeakable",
summary:   "Write down what you can never ever say out loud",
desc:      "Do you suspect that unspoken taboos are holding back the team? \
Consider this silent activity: Stress confidentiality ('What happens in Vegas stays in Vegas') \
and announce that all \
notes of this activity will be destroyed in the end. Only afterwards hand out a piece \
of paper to each participant to write down the biggest unspoken taboo in the company. <br>\
When everyone's done, they pass their paper to their left-hand neighbors. The neighbors read \
and may add comments. Papers are passed on and on until they return to their authors. One last \
read. Then all pages are ceremoniously shredded or (if you're outside) burned.",
source:     "Unknown, via Vanessa",
durationDetail:  "10 min groupsize",
duration:    "Short",
stage:    "Storming, Stagnating",
suitable:  "iteration, project, release"
};
all_activities[75] = {
phase:     0,
name:      "Round of Admiration",
summary:   "Participants express what they admire about one another",
desc:      "Start a round of admiration by facing your neighbour and stating 'What I admire \
most about you is ...' Then your neighbour says what she admires about \
her neighbour and so on until the last participants admires you. Feels great, \
doesn't it?",
source:     source_judith,
durationDetail:  "5 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[76] = {
phase:     4,
name:      "Follow Through",
summary:   "What's the probability of action items getting implemented?",
desc:      "Let everyone draw an emoticon of their current mood on a sticky note. \
Then draw a scale on a flip chart, labeled 'Probability we'll implement \
our action items'. Mark '0%' on the left and '100%' on the right. Ask \
everyone to place their sticky according to their confidence in their \
follow through as a team. <br>Discuss interesting results such as low probability \
or bad mood.",
source:     source_judith,
durationDetail:  "5-10 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[77] = {
phase:     1,
name:      "4 Ls - Loved, Learned, Lacked, Longed for",
summary:   "Explore what people loved, learned, lacked and longed for individually",
desc:      "Each person brainstorms individually for each of these 4 questions: \
<ul> \
    <li>What I Loved</li> \
    <li>What I Learned</li> \
    <li>What I Lacked</li> \
    <li>What I Longed For</li> \
</ul> \
Collect the answers, either stickies on flip charts or in a digital tool if you're distributed. \
Form 4 subgroups, on for each L, read all notes, identify patterns and report their findings to the group. \
Use this as input for the next phase.",
source:     "<a href='http://ebgconsulting.com/blog/the-4l%E2%80%99s-a-retrospective-technique/'>Mary Gorman &amp; Ellen Gottesdiener</a> probably via <a href='http://www.groupmap.com/portfolio-posts/agile-retrospective/'>groupmap.com</a>",
durationDetail:  "30 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release, distributed"
};
all_activities[78] = {
phase:     1,
name:      "Value Stream Mapping",
summary:   "Draw a value stream map of your iteration process",
desc:      "Explain an example of Value Stream Mapping. (If you're unfamiliar with it, check out \
<a href='http://www.youtube.com/watch?v=3mcMwlgUFjU'>this video</a> or \
<a href='http://wall-skills.com/2014/value-stream-mapping/'>this printable 1-pager</a>.) \
Ask the team to draw a value stream map of their process from the point of \
view of a single user story. If necessary, ask them to break into small groups, and \
facilitate the process if they need it. Look at the finished map. Where are long delays, \
choke points and bottlenecks?",
source:    "<a href='http://pragprog.com/book/ppmetr/metaprogramming-ruby'>Paolo 'Nusco' Perrotta</a>, inspired by <a href='http://www.amazon.com/exec/obidos/ASIN/0321150783/poppendieckco-20'>Mary &amp; Tom Poppendieck</a>",
durationDetail:  "20-30 min",
duration:    "Medium",
stage:    "Forming, Storming, Norming",
more:      "http://leadinganswers.typepad.com/leading_answers/2011/09/pmi-acp-value-stream-mapping.html",
suitable:  "iteration, project, release, distributed"
};
all_activities[79] = {
phase:     1,
name:      "Repeat &amp; Avoid",
summary:   "Brainstorm what to repeat and what behaviours to avoid",
desc:      "Head 2 flip charts with 'Repeat' and 'Avoid' respectively. \
The participants write issues for the columns on sticky notes - 1 per issue. \
You can also color code the stickies. Example categories are 'People', 'Process', 'Technology', ... \
Let everyone read out their notes and post them to the appropriate column. \
Are all issues unanimous?",
source:     "<a href='http://www.infoq.com/minibooks/agile-retrospectives-value'>Luis Goncalves</a>",
more:       "http://www.funretrospectives.com/repeat-avoid/",
durationDetail:  "15-30",
duration:    "Medium",
stage:    "All",
suitable: "iteration, project, remote"
};
all_activities[80] = {
phase:     0,
name:      "Outcome Expectations",
summary:   "Everyone states what they want out of the retrospective",
desc:      "Everyone in the team states their goal for the retrospective, i.e. what they \
want out of the meeting. Examples of what participants might say: \
<ul> \
    <li>I'm happy if we get 1 good action item</li> \
    <li>I want to talk about our argument about unit tests and agree on how we'll do it in the future</li> \
    <li>I'll consider this retro a success, if we come up with a plan to tidy up $obscureModule</li> \
</ul> \
[You can check if these goals were met if you close with activity #14.] \
<br><br> \
[The <a href='http://liveingreatness.com/additional-protocols/meet/'>Meet - Core Protocol</a>, which inspired \
this activity, also describes 'Alignment Checks': Whenever someone thinks the retrospective is not meeting \
people's needs they can ask for an Alignment Check. Then everyone says a number from 0 to 10 which reflects \
how much they are getting what they want. The person with the lowest number takes over to get nearer to \
what they want.]",
source:     "Inspired by <a href='http://liveingreatness.com/additional-protocols/meet/'>Jim &amp; Michele McCarthy</a>",
durationDetail:  "5 min groupsize",
duration:    "Forming, Storming, Norming",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[81] = {
phase:     0,
name:      "Three Words",
summary:   "Everybody sums up the last iteration in 3 words",
desc:      "Ask everyone to describe the last iteration with just 3 words. \
Give them a minute to come up with something, then go around the team. \
This helps people recall the last iteration so that they have some ground to \
start from.",
source:     "Yurii Liholat",
durationDetail:  "5 min groupsize",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[82] = {
phase:     4,
name:      "Retro Dart",
summary:   "Check if you hit bull's eye on important issues",
desc:      "Draw one or several dartboards on a flip chart. \
Write a question next to each dartboard, e.g. \
<ul> \
    <li>We talked about what's important to me</li> \
    <li>I spoke openly</li> \
    <li>I'm confident we'll improve next iteration</li> \
</ul> \
Participants mark their opinion with a sticky. Smack in the middle is 100% \
agreement. Outside the disc is 0% agreement.",
source:   "<a href='http://www.philippflenker.de/'>Philipp Flenker</a>",
durationDetail:  "2-5",
duration:    "Short",
stage:    "All",
suitable: "iteration, release"
};
all_activities[83] = {
phase:     0,
name:      "Last Retro's Actions Table",
summary:   "Assess how to continue with last retro's actions",
desc:      "Create a table with 5 columns. The first column lists last retro's \
action items. The other columns are headed 'More of', 'Keep doing', \
'Less of' and 'Stop doing'. Participants place 1 sticky note per row into the \
column that states how they want to proceed with that action. Afterwards \
facilitate a short discussion for each action, e.g. asking: \
<ul> \
    <li>Why should we stop doing this?</li> \
    <li>Why is it worth to go further?</li> \
    <li>Are our expectations satisfied?</li> \
    <li>Why do opinions vary that much?</li> \
</ul>",
source:    "<a href='https://sven-winkler.squarespace.com/blog-en/2014/2/5/the-starfish'>Sven Winkler</a>",
durationDetail:  "5-10",
duration:    "Short",
stage:    "All",
suitable: "iteration, release"
};
all_activities[84] = {
phase: 0,
name: "Greetings from the Iteration",
summary: "Each team member writes a postcard about last iteration",
desc: "Remind the team what a postcard looks like: \
<ul> \
    <li> An image on the front,</li> \
    <li> a message on one half of the back,</li> \
    <li> the address and stamp on the other half.</li> \
</ul> \
Distribute blank index cards and tell the team they have 10 minutes to write \
a postcard to a person the whole team knows (i.e. an ex-colleague). \
When the time is up, collect and shuffle the cards before re-distributing them. \
Team members take turns to read out loud the postcards they got.",
source: "<a href='http://uk.linkedin.com/in/alberopomar'>Filipe Albero Pomar</a>",
durationDetail:  "15 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[85] = {
phase:     1,
name:      "Lines of Communication",
summary:   "Visualize how information flows in, out and around the team",
desc:      "Is information not flowing as well as it needs to? Do you \
suspect bottlenecks? Visualize the ways information flows to find \
starting points for improvements. If you want to look at one specific \
flow (e.g. product requirements, impediments, ...) check out \
Value Stream Mapping (#79). For messier situations try something akin to \
Cause-Effect-Diagrams (#25). <br>\
Look at the finished drawing. Where are delays or dead ends?",
source:    "<a href='https://www.linkedin.com/in/bleadof'>Tarmo Aidantausta</a>",
durationDetail:  "20-30 min",
duration:    "Medium",
stage:    "Forming, Storming, Norming",
suitable:  "iteration, project, release"
};
all_activities[86] = {
phase:     1,
name:      "Meeting Satisfaction Histogram",
summary:   "Create a histogram on how well ritual meetings went during the iteration",
desc:      "Prepare a flip chart for each meeting that recurs every iteration, \
(e.g. the Scrum ceremonies) with a horizontal scale from 1 ('Did not meet expectations') \
to 5 ('Exceeds Expectations'). Each team member adds a sticky note based on their rating \
for each of these meetings. Let the team discuss why some meetings do not have a rating of 5. \
<br> \
You can discuss improvements as part of this activity or in a later activity such as \
Perfection Game (#20) or Plus \& Delta (#40).",
source:    "<a href='https://www.linkedin.com/profile/view?id=6689187'>Fanny Santos</a>",
durationDetail:  "10-20 min",
duration:    "Medium",
stage:    "Storming, Norming, Stagnating",
suitable:  "iteration, project, release"
};
all_activities[87] = {
phase:     3,
name:      "Impediments Cup",
summary:   "Impediments compete against each other in a World Cup style",
desc:      "Prepare a flip chart with a playing schedule for quarter-final, semi-final and final. \
All participants write down actions on a post-it until you have eight actions. \
Shuffle them and randomly place them on the playing schedule.<br>\
The team now has to vote for one of the two actions in each pair. Move the winning \
action to the next round until you have a winner of the impediments cup. \
<br><br>\
If you want to take on more than one or two actions you can play the match for third place.",
source:    "<a href='http://obivandamme.wordpress.com'>Pascal Martin</a>, inspired by <a href='http://borisgloger.com/'>Boris Gloger's 'Bubble Up'</a>",
durationDetail:  "10-15 min",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[88] = {
phase:     1,
name:      "Retro Wedding",
summary:   "Collect examples for something old, new, borrowed and blue",
desc:      "Analogue to an anglo-american wedding custom ask the team to give examples for the following categories: \
<ul> \
    <li>Something Old<br> \
Positive feedback or constructive criticism on established practice</li> \
	\
    <li>Something New<br> \
Positive feedback or constructive criticism on experiments in progress</li> \
	\
    <li>Something Borrowed<br> \
Tool/idea from another team, the Web or yourself for a potential experiment</li> \
	\
    <li>Something Blue<br> \
Any blocker or source of sadness</li> \
</ul> \
One example per sticky note. There's only one rule: If someone contributes to the 'Something Blue' column, \
s/he must also have a positive comment in at least 1 other column.<br><br> \
Everyone posts their stickies in the appropriate column on the board and describes it briefly.",
source:    "<a href='http://scalablenotions.wordpress.com/2014/05/15/retrospective-technique-retro-wedding/'>Jordan Morris</a>, via Todd Galloway",
durationDetail:  "5-10 min",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[89] = {
phase:     0,
name:      "Agile Values Cheer Up",
summary:   "Remind each other of agile values you displayed",
desc:      "Draw 4 large bubbles and write one of the agile core values into each: \
<ol> \
    <li>Individuals and their interactions</li> \
    <li>Delivering working software</li> \
    <li>Customer collaboration</li> \
    <li>Responding to change</li> \
</ol> \
Ask participants to write down instances when their colleagues have displayed \
one of the values - 1 cheerful sticky note per example. In turn, let \
everyone post their note in the corresponding bubble and read them out loud. \
Rejoice in how you embody agile core values :)",
source:    "<a href='http://agileinpills.wordpress.com'>Jesus Mendez</a>",
durationDetail:  "10-15 min",
duration:    "Medium",
stage:    "Storming, Norming, Stagnating",
suitable:  "iteration, project, release"
};
all_activities[90] = {
phase:     2,
name:      "Poster Session",
summary:   "Split a large group into smaller ones that create posters",
desc:      "After you've identified an important topic in the previous phase \
you can now go into detail. Have the larger group split up into groups of 2-4 \
people that will each prepare a poster (flip chart) to present to the other groups. \
If you have identified more than one main topic, let the team members select \
on which they want to work further.<br> \
Give the teams guidelines about what the posters should cover / answer, such as: \
<ul> \
    <li>What exactly happens? Why is that a problem?</li> \
    <li>Why / when / how does this situation happen?</li> \
    <li>Who benefits from the current situation? What is the benefit?</li> \
    <li>Possible solutions (with Pros and Cons)</li> \
    <li>Who could help change the situation?</li> \
    <li>... whatever is appropriate in your setting ...</li> \
</ul> \
The groups have 15-20 minutes to discuss and create their posters. Afterwards \
gather and each group gets 2 minutes to present their results.",
source:    "Unknown, adapted by " + source_findingMarbles + ", inspired by Michal Grzeskowiak",
durationDetail:  "30 min",
duration:    "Long",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[91] = {
phase:     4,
name:      "Motivational Poster",
summary:   "Turn action items into posters to improve visibility \& follow-through",
desc:      "Take each of your action items and create a funny poster for it (see the photos for examples). \
<ol>\
    <li>Pick an image</li>\
    <li>Agree on a title</li>\
    <li>Write a self-mocking description</li>\
</ol>\
Print your master piece as big as possible (A4 at the very least) and display it prominently.",
source:    "<a href='http://fr.slideshare.net/romaintrocherie/agitational-posters-english-romain-trocherie-20140911'>Romain Trocherie</a>",
durationDetail:  "30 min per topic / poster",
duration:    "Long",
stage:    "Performing",
suitable:  "release"
};
all_activities[92] = {
phase:     1,
name:      "Tell a Story with Shaping Words",
summary:   "Each participant tells a story about the last iteration that contains certain words",
desc:      "Provide everyone with something to write down their story. Then introduce the shaping words, \
which influence the story to be written: \
<ul> \
    <li>If the last iteration could have been better:<br> \
You set a couple of shaping words, e.g. such as 'mad, sad, glad' or 'keep, drop, add'. Additionally they have \
to write their story in first person. This avoids blaming others. \
</li> \
    <li>If the last iteration was successful:<br> \
The team can either choose their own set of words or you can provide random words to unleash the team's creativity. \
</li> \
</ul> \
Now each participant writes a story of no more than 100 words about last iteration. They have to use each shaping \
word at least once. Timebox this to 5-10 minutes. <br> \
When everyone's finished, they read out their stories. Afterwards lead a discussion about common themes of the stories.",
source:    "<a href='https://medium.com/p/agile-retrospective-technique-1-7cac5cb4302a'>Philip Rogers</a>",
durationDetail:  "20-30 minutes",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[93] = {
phase:     2,
name:      "BYOSM - Build your own Scrum Master",
summary:   "The team assembles the perfect SM \& takes different points of view",
desc:      "Draw a Scrum Master on a flipchart with three sections on him/her: brain, heart, stomach. \
<ul>\
    <li>Round 1: 'What properties does your perfect SM display?' <br>\
Ask them to silently write down one trait per note. Let participants explain their notes and put them on the drawing. \
</li> \
    <li>Round 2: 'What does the perfect SM have to know about you as a team so that he/she can work with you well?' \
</li>\
    <li>Round 3: 'How can you support your SM to do a brilliant job?' <br> \
</li></ul>\
You can adapt this activity for other roles, e.g. BYOProductOwner.",
source:    "<a href='http://agile-fab.com/2014/10/07/die-byosm-retrospektive/'>Fabian Schiller</a>",
durationDetail:  "30 minutes",
duration:    "Long",
stage:    "Forming, Storming, Norming",
suitable:  "iteration, project, release"
};
all_activities[94] = {
phase:     2,
name:      "If I were you",
summary:   "What could sub-groups improve when interacting with others?",
desc:      "Identify sub-groups within the participants that interacted during the iteration, \
e.g. developers/testers, clients/providers, PO/developers, etc. \
Give participants 3 minutes to silently write down what they think \
their group did that negatively impacted another group. One person should be part of one group only and write stickies \
for all groups they don't belong to - 1 sticky per issue. <br><br> \
Then in turn all participants read their stickies and give them to the corresponding group. \
The affected group rates it from 0 ('It was not a problem') to 5 ('It was a big problem'). \
Thus you get insights and shared understanding about problems and can select some of them to work on.",
source:    "<a href='http://www.elproximopaso.net/2011/10/dinamica-de-retrospectiva-si-fuera-vos.html'>Thomas Wallet</a>",
durationDetail:  "25-40 minutes",
duration:    "Long",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[95] = {
phase:     3,
name:      "Problem Solving Tree",
summary:   "Got a big goal? Find the steps that lead to it",
desc:      "Hand out sticky notes and markers. Write the big problem you \
want to solve onto a note and stick it to the top of a wall or big board. \
Ask the participants to write down ideas of what they can do to solve the problem. \
Post them one level below the original problem. Repeat this for each note on the new level. \
For every idea ask whether it can be done in a single iteration and if everyone understands what \
they need to do. If the answer is no, break it down and create another level in the \
problem solving tree.<br><br> \
Once you have lower levels that are well understood and easy to implement in a single iteration, \
dot vote to decide which to tackle in the next iteration. ",
source:    "<a href='https://www.scrumalliance.org/community/profile/bsarni'>Bob Sarni</a>, described by <a href='http://growingagile.co.za/2012/01/the-problem-solving-tree-a-free-exercise/'>Karen Greaves</a>",
durationDetail:  "30 minutes",
duration:    "Long",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[96] = {
phase:     1,
name:      "#tweetmysprint",
summary:   "Produce the team's twitter timeline for the iteration",
desc:      "Ask participants to write 3 or more tweets on sticky notes about the iteration they've just \
completed. Tweets could be on the iteration as a whole, on individual stories, a rant, or shameless self-promotion \
- as long as they are brief. Hash tags, emoticons, attached pictures, @usernames are all welcome. Allow ten minutes to \
write the tweets, then arrange them in a timeline and discuss themes, trends etc. Now invite participants to favorite, \
retweet and write replies to the tweets, again following up with discussion.",
source:    "<a href='http://wordaligned.org'>Thomas Guest</a>",
durationDetail:  "40 minutes for 2 week iteration with team of 6",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[97] = {
phase:     1,
name:      "Laundry Day",
summary:   "Which things are clear and feel good and which feel vague and implicit?",
desc:      "Use this activity if you suspect the team to make lots of unconscious decisions hardly ever \
questioning anything. You can figure out what things need to be talked about to get an explicit grasp of them. \
<br><br> \
You need: \
<ul> \
    <li> about 3 metres of string as the clothesline</li> \
    <li> about 20 clothes pins</li> \
    <li> a white shirt (cut from paper)</li> \
    <li> a pair of dirty pants (cut from paper)</li> \
</ul> \
Hang up the clothesline and mark the middle, e.g. with a ribbon. \
Hang up the clean shirt on one side and the dirty pants on the other. \
Ask the team now to write items onto index cards for each of the categories. \
Hang up the notes with clothespins and re-arrange them into clusters. \
Now the team picks 2 'dirty' and 2 'clean' topics they want to talk about, e.g. by dot voting.",
source:    "<a href='https://www.xing.com/profile/KatrinElise_Dreyer'>Katrin Dreyer</a>",
durationDetail:  "10 minutes",
duration:    "Short",
stage:    "Forming, Storming, Norming",
suitable:  "iteration, project, release"
};
all_activities[98] = {
phase:     3,
name:      "Planning Poker Voting",
summary:   "Use your Planning Poker cards for un-influenced voting",
desc:      "If you've got very influential and / or shy team members you can re-use Planning Poker cards \
to vote simultaneously: \
<br><br> \
Write all suggested actions on sticky notes and put them onto a wall. Hand out an ordered deck of Planning Poker \
cards to each participant. Count the proposals and remove that many cards from the back of the card decks. \
If you've got 5 suggestions you might have cards '1', '2', '3', '5', and '8'. This depends on your deck \
(some have a '1/2' card). It doesn't matter, as long as all participants have the same set of values. \
<br><br> \
Explain the rules: Choose a card for each suggestion. Choose a low value if the action is not worth doing \
in your opinion. Choose a high value if the action is worth starting next iteration. \
<br><br> \
Give them a minute to sort out their internal ranking and then present the first suggested action. \
Everybody chooses a card and they reveal them at the same time. \
Add the numbers from all cards and write the sum onto the action. \
Remove the used poker cards. Repeat this for all actions. \
If you have more actions than poker values the players can show 'no card' (counting 0) for the appropriate number of times. \
<br><br> \
Implement the action with the highest sum in the next iteration. Add more actions only if there's team consensus to do so.",
source:    "<a href='https://www.xing.com/profile/Andreas_Ratsch'>Andreas Ratsch</a>",
durationDetail:  "15 minutes",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[99] = {
phase:     3,
name:      "Landscape Diagram",
summary:   "Assess action items based on how clear they are and take your pick",
desc:      "This activity is helpful when a team is facing an ambiguous, volatile, uncertain or complex set of problems \
and has many suggested action items to choose from. \
<br><br> \
Draw a <a href='http://wiki.hsdinstitute.org/landscape_diagram'>Landscape Diagram</a>, i.e. an x-axis labeled 'Certainty about approach' \
and a y-axis labeled 'Agreement on issue'. Both go from low certainty / agreement in their mutual origin to high towards the top / right. \
For each action item ask 'How much agreement do we have that solving this problem would have a great beneficial impact? \
How certain are we about the first steps toward a solution?' Place the note on the diagram accordingly. \
<br> \
When all actions are placed, shortly discuss the 'map' you created. Which actions will give the greatest benefit in the next iteration? \
Which are more long term? \
<br><br> \
Choose 2 actions from the simple / ordered area of the map or 1 action from the complex area.",
source:    "<a href='http://www.futureworksconsulting.com/who-we-are/diana-larsen'>Diana Larsen</a> adapted it from <a href='http://wiki.hsdinstitute.org'>Human Systems Dynamics Institute</a>",
durationDetail:  "25 minutes",
duration:    "Medium",
stage:    "Forming, Storming, Norming",
suitable:  "iteration, project, release"
};
all_activities[100] = {
phase:     4,
name:      "Endless Blessings",
summary:   "Bless the upcoming iteration with all your good wishes",
desc:      "Stand in a circle. Explain that you will collect good wishes for the next iteration, building on each other's blessings. \
If you do it for the first time, start the activity by giving the first blessing. Then go around the circle to add to your blessing. \
Skip over people who can't think of anything. When your losing steam, ask for another blessing and start another round. Continue until \
no one can think of blessings anymore. <br><br>\
Example:<br>\
You start with 'May we finish all stories next iteration'. Your neighbor continues with 'And may they delight our customers'. \
Their neighbor wishes 'And may we be able to automatically test all new features'. And so on until ideas for additions to this \
blessing run out.<br> \
Then someone else can start a new round, e.g. with 'May we write beautiful code next iteration'.",
source:    "<a href='http://www.deepfun.com/bernie/'>Bernie DeKoven</a> via <a href='http://www.futureworksconsulting.com/who-we-are/diana-larsen'>Diana Larsen</a>",
duration:    "Short",
stage:    "Norming, Performing, Adjourning",
suitable:  "iteration, project, release"
};
all_activities[101] = {
phase:     4,
name:      "You and Me",
summary:   "Recognize the efforts of teammates and self-improve a little",
desc:      "Put up 2 columns on a white board: 'Thank you!' and 'My action'.\
Ask everybody to write one sticky per column: Something they want to thank \
another teammate for doing; and something they want to change about their own \
behavior in the next iteration. It can be something really small. \
Once everyone is finisihed, do a round for each person to present their \
stickies and post them to the board.",
source:    "Mike B.",
durationDetail:  "10 minutes",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[102] = {
phase:     3,
name:      "Systemic Consensus",
summary:   "Check for resistance instead of approval",
desc:      "Do you have a hotly debated matter with several possible ways to go and the team \
can't agree on any of them? Instead of trying to find a majority for a way that \
will create winners and losers, try what happens if you turn the decision inside out: <br>\
Draw a table with the voters in the left-most column and proposals on top. Now everybody has to \
fill in their resistance towards each proposal. 0 means 'no resistance - this is what I want', \
up to 10, meaning 'shoot me now'. Give the least hated solution a try.",
source:    "Georg Paulus, Siegfried Schrotta \& Erich Visotschnig via <a href='http://finding-marbles.com/2012/01/12/systemic-consensus/'>Corinna Baldauf</a>",
durationDetail:  "10 minutes",
duration:    "Short",
stage:    "Storming",
suitable:  "iteration, project"
};
all_activities[103] = {
phase:     4,
name:      "Note to Self",
summary:   "Remind yourself of your good intentions",
desc:      "Thinking back about the discussions, everybody writes a reminder for her- or himself about \
a change in their own behaviour they want to try \
during the next iteration. It's for quiet self reflection and is not shared with the group. \
They take their respective sticky notes with them to their desktop and put it in a place they \
will look at often.",
source:    "<a href='http://www.funretrospectives.com/note-to-self/'>Fun Retrospectives</a>",
durationDetail:  "3 minutes",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[104] = {
phase:     2,
name:      "Election Manifesto",
summary:   "Different parties present manifestos for change. Who will get your vote?",
desc:      "Is there an election coming up in your country? Use it as a back drop \
for your team to convince each other of their change initiatives. \
<br><br> \
Ask the participants to split into political parties with 2 or 3 members. \
For 20 minutes, each party will work on a manifesto for change. What isn't working? How would they improve things? <br>\
Afterwards the parties meet again and their leaders present their manifestos. Be prepared for tough questions and heckling!<br> \
Now plan for a better world! Summarise the manifestos with sticky notes, one color per party. What do the parties agree on? \
Which promises are unrealistic and which can you achieve?",
source:    "<a href='http://wordaligned.org/'>Thomas Guest</a>",
durationDetail:  "45 minutes",
duration:    "Long",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[105] = {
phase:     0,
name:      "Who said it?",
summary:   "Attribute quotes to team members and situations",
desc:      "Before the retro, spend some time looking through email threads, chat logs, ticket discussions, and the like. \
Collect quotes from the last iteration: Funny quotes, or quotes which without context sound a little odd. \
Write them down with the name of the person who said them. \
<br><br> \
Read out the quotes at the beginning of the retro, and ask the team to guess who said it - the source may not self-identify! \
Often the team will not only know who said it, but also talk about what was going on at the time.",
source:    "Beccy Stafford",
durationDetail:  "5-10 minutes",
duration:    "Short",
stage:    "Norming, Performing",
suitable:  "iteration, project, release, familiarTeam"
};
all_activities[106] = {
phase:     0,
name:      "Unlikely Superheros",
summary:   "Imagine yourself as a superhero! What is your superpower?",
desc:      "Each participant creates a superhero version of themselves based on how they see themselves in the team / project - \
Complete with appropriate superpowers, weaknesses and possibly an arch-nemesis.",
source:    "<a href='http://pietrotull.com/2015/01/26/a-retro-in-practise/'>Pietari Kettunen</a>",
durationDetail:  "10 minutes",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[107] = {
phase:     0,
name:      "Know your neighbour - Opening",
summary:   "How did your right neighbour feel during the iteration",
desc:      "Ask each team member to try to briefly describe how their neighbour to the right felt during the iteration. \
Their neighbour confirms or corrects their guess. \
<br> \
Once all participants said what they think about how their teammates felt, you get an idea of how connected they are, \
how the communication is flowing in your team and if people are aware of the feelings expressed, in some way, by others. \
<br><br> \
Consider closing with activity #109.",
source:    "<a href='https://www.linkedin.com/in/fabilewk'>Fabián Lewkowicz</a>",
durationDetail:  "5-10 minutes",
duration:    "Short",
stage:    "All",
suitable:  "iteration"
};
all_activities[108] = {
phase:     4,
name:      "Know your neighbour - Closing",
summary:   "How does your left neighbour feel about the retrospective",
desc:      "Ask each team member to guess if their left neighbour thinks this retrospective was a good use \
of their time and why. Their neighbour confirms or corrects their guess. \
<br><br> \
If you have set the stage with activity #108, make sure to go around the other direction this time.",
source:    "Inspired by <a href='https://www.linkedin.com/in/fabilewk'>Fabián Lewkowicz</a>",
durationDetail:  "5-10 minutes",
duration:    "Short",
stage:    "All",
suitable:  "iteration"
};
all_activities[109] = {
phase:     1,
name:      "Movie Critic",
summary:   "Imagine your last iteration was a movie and write a review about it",
desc:      "Introduce the activity by asking: \
Imagine your last iteration was a movie and you had to write a review: \
            <ul> \
    <li>            What was the genre of the movie (e.g. horror, drama, ...)?</li> \
    <li>            What was the (central) theme? Describe in 2-3 words.</li> \
    <li>            Was there a big twist (e.g. a bad guy)?</li> \
    <li>            What was the ending like (e.g. happy-end, cliffhanger) and did you expect it?</li> \
    <li>            What was your personal highlight?</li> \
    <li>            Would you recommend it to a colleague?</li> \
</ul> \
Give each team member a piece of paper and 5 minutes to silently ponder the questions. \
In the meantime (or before the session) divide a flip chart in 7 columns headed with 'Genre', 'Theme', 'Twist', 'Ending', 'Expected?', 'Highlight', 'Recommend?'. \
When everyone has finished writing, fill out the flip chart while each participant reads out their notes. \
<br> \
Afterwards look at the finished table and lead a discussion about \
<ul> \
    <li>What's standing out?</li> \
    <li>What patterns do you see? What do they mean for you as a team?</li> \
    <li>Suggestions on how to continue?</li> \
</ul>",
source:    "<a href='https://twitter.com/tuedelu'>Isabel Corniche</a>",
durationDetail:  "20-25 minutes",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[110] = {
phase:     5,
name:      "Feedback Sandwich",
summary:   "Learn how to raise constructive criticism with your team mates in a trusting and positive way",
desc:      "Try this activity to help teams that are only ever saying nice things to each other and seem reluctant to raise \
concerns about each other. If they are always keeping the peace, they miss growth opportunities \
and issues may fester. Feedback Sandwich is a way to learn how to give and receive potentially critical feedback. It goes like this: \
<br><br> \
Team members sit in a circle and take turns receiving the feedback. The team member who's turn it is is not allowed to say \
anything until each person finishes their 3 points. Once finished, the person receiving the feedback can only say 'Thank You'. \
Each takes turns receiving the feedback until all team members have participated. \
<br><br> \
Several days before the retro, you send out the following information to team members so that they can prepare: <br> \
'Think about the below questions for each of your team mates and prepare an answer before the session: \
<ol> \
   <li>What is something you really admire/respect about this person or something you think they do really well in a professional capacity?</li> \
    <li>What is something you think is a weakness for this person? (Perhaps something they don't do so well, need to work on etc.)</li> \
    <li>What is something you feel this person shows promise in, but could perhaps work on a little more to truly shine at it?</li> \
</ol> \
These questions are quite open in that you can draw on both technical and soft skills for each team member. \
So it might be that you choose to highlight a specific technical strength/weakness, or you might comment on \
someone's professional conduct, approachability, teaching skills, communication skills, etc. \
<br><br> \
<b>Disclaimer</b>: This activity is not about being nasty, or mean. It's intended to help the team get to know each \
other better and to improve on how we work individually and as a group. \
The idea is not to cause offence, but rather to understand how your team sees you and perhaps take something \
away to work on. It is up to you what you take away from it, you are free to ignore people's suggestions if \
you do not agree with them. Please deliver your feedback kindly and remember to thank your team for their \
feedback about you.'",
source:    "<a href='http://www.silverstripe.com/who-we-are/our-team/diana-hennessy'>Diana Hennessy</a>",
durationDetail:  "60 minutes",
duration:    "Long",
stage:    "Performing, Stagnating",
suitable:  "iteration, project, release, intervention, liftoff"
};
all_activities[111] = {
phase:     4,
name:      "Appreciation Postcards",
summary:   "Team members write appreciative postcards for later delivery",
desc:      "Hand out blank postcards. Each team member silently writes a postcard to another team member, thanking them \
for something they did. They can write as many postcards as they like, and they can address them either to \
individuals or to multiple people. \
Collect all postcards. Consider using envelopes with the name on for privacy. Deliver the cards \
throughout the next iteration to make someone's day. \
<br><br> \
Variation: Use normal paper and let participants fold the paper into little <a href='http://www.origami-fun.com/origami-crane.html'>cranes</a> for some origami fun. \
(Suggestion by Virginia Brassesco)",
source:    "<a href='https://medium.com/agile-outside-the-box/retrospective-technique-appreciation-post-cards-e53ef3d67425'>Philip Rogers</a>",
durationDetail:  "5-10 minutes",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[112] = {
phase:     2,
name:      "Set Course",
summary:   "Imagine you're on a voyage - Cliffs and treasures await",
desc:      "Imagine you're navigating a boat instead of a product or service. \
Ask the crew the following questions: \
<ol> \
    <li>            Where is a treasure to be found? (New things worth trying) </li> \
    <li>            Where is a cliff to be safe from? (What makes the team worry)</li> \
    <li>            Keep course for ...  (What existing processes go well?)</li> \
    <li>            Change course for... (What existing processes go badly)</li> \
</ol>",
source:    "<a href='https://www.xing.com/profile/KatrinElise_Dreyer'>Katrin Dreyer</a>",
durationDetail:  "30 minutes",
duration:    "Long",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[113] = {
phase:     0,
name:      "Give me a face",
summary:   "Participants show how they feel by drawing a face on a tangerine",
desc:      "Each team member gets a sharpie and a tangerine with a sticky note asking: \
'How do you feel? Please give me a face'. After all are done drawing you go around and \
compare the works of art and emotions. It's a light-hearted way to set the stage.",
source:    "<a href='http://se-co.de/index.php/das-sind-wir/'>Afagh Zadeh</a>",
durationDetail:  "5 minutes",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[114] = {
phase:     2,
name:      "Force Field Analysis",
summary:   "Analyse the factors that support and hinder a particular initiative",
desc:      "State the topic that the team will explore in depth (deployment \
processes, peer-programming, Definition of Done, ...). Break the room into groups \
of 3-4 people each. Give them 5-7 minutes to list all contributing factors, drivers \
and actions that make up the topic. Go around the room. Each group reads 1 of their \
sticky notes and puts it up inside the force field until no group has any items left. \
Cluster or discard duplicates. Repeat the last 2 steps for factors that inhibit or \
restrain the topic from being successful or being as effective as it could be. Review \
all posted items. Add any that are missing. \
<br><br> \
To identify the most influential factors, everybody gets to 4 votes - 2 for contributing \
factors, 2 for inhibitors. Tally the votes and mark the top 2x2 factors with big arrows. \
Spend the last 15-20 mins of the session brainstorming ways to increase the top driving factors \
and decrease the top restraining factors.",
source:    "<a href='http://derekneighbors.com/2009/02/agile-retrospective-using-force-field-analysis/'>Derek Neighbors</a>, via <a href='http://www.silverstripe.com/about-us/team/project-management/joel-edwards/'>Joel Edwards</a>",
durationDetail:  "60 minutes",
duration:    "Long",
stage:    "Storming, Stagnating",
suitable:  "iteration, project"
};
all_activities[115] = {
phase:     1,
name:      "Genie in a Bottle",
summary:   "Playfully explore unmet needs",
desc:      "Present the following scenario to the participants: You have freed a genie from its bottle \
and you're granted the customary 3 wishes. What do you wish for? Please make \
<ul> \
    <li>one wish for yourself</li> \
    <li>one wish for your team</li> \
    <li>one wish for all the people in the world</li> \
</ul> \
Cheating (i.e. wishing for more wishes or more genies) is not allowed! \
<br><br> \
Let everybody present their wishes. Optionally you can then dot-vote on the best or most appreciated wishes.",
source:    "&Ouml;zer &Ouml;zker &amp; Anke Bartels",
durationDetail:  "10-15 minutes",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[116] = {
phase:     3,
name:      "Maximize Follow Through",
summary:   "Think about how the team will follow up and set yourselves up for success",
desc:      "Prepare a flip chart with 4 columns titled 'Action', 'Motivation', 'Ease' and 'Reminder'. \
Write down the list of actions the team wants to take in the first column. \
Read out each action and fill in the other columns by asking: \
<ul> \
    <li>Motivation - How can we motivate ourselves to do this? \
	<br>Examples: \'Jane will own this and feedback at the next retrospective', or 'We'll reward ourselves with cake on Friday if we do this every day'</li><br> \
    <li>Ease - How can we make it easy to do? \
	<br>Example: For an action 'Start involving Simon in the stand up' a possibility could be 'Move the task board next to Simon's desk'</li><br> \
    <li>Reminder - How will we remember to do this? \
	<br>Examples: 'Richard will put a reminder in Google Calendar' or 'We'll do this after the stand up each day' \
</ul> \
Actions do not require all of the above. But if there are no suggestions for any of the columns, ask the team if they really think they will do it.",
source:    "<a href='https://twitter.com/nespera'>Chris Rimmer</a>",
durationDetail:  "15 minutes",
duration:    "Medium",
stage:    "Storming",
suitable:  "iteration"
};
all_activities[117] = {
phase:     2,
name:      "Snow Mountain",
summary:   "Address problematic burndowns and scope creep",
desc:      "This activity is helpful when a team is constantly dealing with additional requests and scope creep. \
Use the burndown chart of problematic sprints to draw snowy mountains with the same outline. Add a few trees here and there. \
Print drawings of kids in various sledging situations such as kid sledging down fast, kid sledging and being scared, \
kid with a sledge looking bored, etc. (You can use Google image search with 'kid sledging drawing'). \
<br><br> \
In teams of 2 or 3, ask the team members to identify which kid's reaction goes with which part of the mountain. <br> \
Example: If the mountain is flat, the kid might be bored. If you're facing a wall, the kid might be scared. \
<br><br> \
You can then discuss the team's reaction facing their own burndowns.",
source:    "Olivier Fortier",
durationDetail:  "30 minutes",
duration:    "Long",
stage:    "All",
suitable:  "iteration"
};
all_activities[118] = {
phase:     1,
name:      "Hit the Headlines",
summary:   "Which sprint events were newsworthy?",
desc:      "Collecting some news headlines in advance and take them to the retrospective to \
serve as examples. Try to gather a mixture of headlines: factual, opinion, review. \
Place the headlines where everyone can see them. Hand out sticky notes. Give team members 10 \
minutes to come up with their own headlines describing newsworthy aspects of the sprint. \
Encourage short, punchy headlines. \
<br> \
Stick the completed headlines to a whiteboard. If any cover the same news item, combine them. \
If any are unclear, ask the reporter for details. Vote on which news items to discuss and analyse in more depth.",
source:    "<a href='http://wordaligned.org'>Thomas Guest</a>",
durationDetail:  "15-20 minutes",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[119] = {
phase:     4,
name:      "My Team is Awesome",
summary:   "Acknowledge what's awesome about your team",
desc:      "Give each team member a piece of paper and ask them to write down the following text: \
<br> \
'My team is awesome because _______________ <br> \
and that makes me feel __________________' \
<br><br> \
Everyone fills out the blanks for themselves and signs below. When everyone is finished, \
put up the sheets on a wall. A volunteer reads out the sheets and the team celebrates by \
cheering or applausing. Take some time to review and share observations. \
Take a picture to remind the team how awesome it feels to be part of the team.",
source:    "<a href='http://agileinpills.wordpress.com'>Jesus Mendez</a>",
duration:    "Short",
stage:    "Norming, Performing, Adjourning",
suitable:  "iteration, project, release"
};
all_activities[120] = {
phase:     1,
name:      "The Good, the Bad, and the Ugly",
summary:   "Collect what team members perceived as good, bad and non-optimal",
desc:      "Put up three sections labeled ‘The Good’, ‘The Bad’ and ‘The Ugly’. Give everyone \
5 minutes to note down one or more things per category from the last sprint. One aspect per post-it. \
When the time is up, have everyone stick their post-its to the appropriate labels. Cluster as you collect, if possible.",
source:    "<a href='http://qualityswdev.com/2016/02/04/wild-wild-west-retrospective/'>Manuel Küblböck</a>",
durationDetail:  "10 minutes",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project"
};
all_activities[121] = {
phase:     0,
name:      "Positive and True",
summary:   "Boost everyones energy with tailored questions",
desc:      "Ask your neighbor a question that is tailored to get a response that \
is positive, true and about their own experiences, e.g. \
<ul> \
    <li>What have you done really well in the last iteration?</li> \
    <li>What is something that makes you really happy?</li> \
    <li>What were you most happy about yesterday?</li> \
</ul> \
Then your neighbor asks their neighbor on the other side the same question and \
so on until everyone has answered and asked. \
<br><br> \
This will give everyone a boost and lead to better results.",
source:    "<a href='http://www.twitter.com/sinnvollFUEHREN'>Veronika Kotrba and Ralph Miarka</a>, adapted from <a href='http://www.timetothink.com/meet-us/nancy-kline/'>Nancy Kline</a>",
duration:    "Short",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[122] = {
phase:     1,
name:      "Find your Focus Principle",
summary:   "Discuss the 12 agile principles and pick one to work on",
desc:      "Print the <a href='http://www.agilemanifesto.org/principles.html'>principles of the Agile Manifesto</a> \
onto cards, one principle \
per card. If the group is large, split it and provide each smaller group with \
their own set of the principles. \
<br><br> \
Explain that you want to order the principles according to the following question: \
'How much do we need to improve regarding this principle?'. In the end the \
principle that is the team's weakest spot should be on top of the list. \
<br><br> \
Start with a random principle, discuss what it means and how much need for \
improvement you see, then place it in the middle. \
Pick the next principle, discuss what it means and sort it relatively to the other \
principles. You can propose a position depending on the previous discussion and \
move from there by comparison. \
Repeat this until all cards are sorted. \
<br><br> \
Now consider the card on top: This is presumeably the most needed and most urgent \
principle you should work on. How does the team feel about it? Does everyone still \
agree? What are the reasons there is the biggest demand for change here? Should you \
compare to the second or third most important issue again? If someone would now \
rather choose the second position, why?",
source:    "<a href='http://www.agilesproduktmanagement.de/'>Tobias Baier</a>",
duration:    "Long",
stage:    "Forming, Storming, Stagnating",
suitable:  "iteration, project, release"
};
all_activities[123] = {
phase:     3,
name:      "Outside In",
summary:   "Turn blaming others into actions owned by the team",
desc:      "If your team has a tendency to see obstacles outside of their team and \
influence and primarily wants others to change, you can try this activity: \
<br><br> \
Draw a big rectangle on the board and another rectangle inside of it, like a picture frame. \
Hang all complaints and grievances that surfaced in previous phases into the frame. \
<br><br> \
Now comes the interesting twist: Explain that if they want anything in the outside frame \
to change, they will have to do something themselves to affect that change. Ask the team to \
come up with actions they can do. Put these actions into the inner rectangle (near the \
outer sticky they are addressing).",
source:    "<a href='http://www.twitter.com/sinnvollFUEHREN'>Ralph Miarka and Veronika Kotrba</a>",
duration:    "Medium",
stage:    "Forming, Storming, Norming",
suitable:  "iteration"
};
all_activities[124] = {
phase:     3,
name:      "Three by Three",
summary:   "Build on each other's ideas to create a great action item",
desc:      "This silent brainstorming technique helps the team come up with truly \
creative solutions and gives quiet people equal footing: \
<br><br> \
<ul> \
    <li>Everyone writes 3 sticky notes with 1 action idea each</li> \
    <li>Go around the room and pitch each idea in 15 seconds</li> \
    <li>Gather all stickies so that everyone can see them</li> \
    <li>Each team member adds their name to the sticky note that inspires them the most</li> \
    <li>Take off all ideas without a name on them</li> \
</ul> \
Repeat this process 2 more times. Afterwards, everyone can dot vote to determine which \
action(s) the team is going to implement.",
source:    "<a href='https://www.qeek.co/blog/collaborative-idea-exploration-and-the-end-of-the-loudest-voice'>Simon Tomes</a>",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[125] = {
phase:     1,
name:      "I like, I wish",
summary:   "Give positive, as well as non-threatening, constructive feedback",
desc:      "Hang up two flip charts, one headed 'I like' and the other 'I wish'. \
Give the participants 5-10 minutes to silently write down what they liked about the \
past iteration and the team and what they wish was different (and how it should be \
different) – one point per sticky note. \
When everyone is finished, go around the circle and everybody reads out their 'I like' \
items and hangs them up. Repeat the same for the 'I wish' stickies. Either debrief or use the stickies \
as input for the next phase.",
source:    "Inspired by <a href='http://ilikeiwish.org/'>Satu Rekonen</a>",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[126] = {
phase:     1,
name:      "Delay Display",
summary:   "What's the current delay? And where are we going again?",
desc:      "Draw a table with 3 columns. Head the first one 'Destination', \
the second one 'Delay' and the last one 'Announcement'. \
<br><br> \
Introduce the scenario: 'You are at a train station. Where is your train going?. \
(It can be anything, a fictional or a real 'place'.) How much of a delay does the \
train currently have? And what is the announcement? Why is there a delay? (This can \
be the 'real' reason or modeled after the typical announcements.)' \
Each team member fills out 3 sticky notes, 1 for each column. \
Going around the circle, each team member posts their notes and explains briefly, why \
they're going to destination X and why there's a delay (or not). \
<br><br> \
Trains and train delays are very familiar in Germany. Depending on your country and culture \
you might want to pick a different mode of transportation.",
source:    "<a href='https://www.slacktime.org'>Christian Schafmeister</a>",
duration:    "Medium",
stage:    "Storming, Performing",
suitable:  "iteration, project, release"
};
all_activities[127] = {
phase:     1,
name:      "Learning Wish List",
summary:   "Create a list of learning objectives for the team",
desc:      "Hand out pens and paper. Each participant writes down what they \
wish their coworkers would learn (as a team - no need to name individual \
people). When everyone is done, collect all items on a board and count how \
often each one appears. Pick the top three things as learning objectives, \
unless the team's discussion leads somewhere else.",
source:    "<a href='https://twitter.com/tottinge'>Tim Ottinger</a>",
duration:    "Medium",
stage:    "All",
suitable:  "iteration, project, release"
};
all_activities[128] = {
phase:     0,
name:      "String Theory",
summary:   "Surface shared traits and mutual interests among team members",
desc:      "This is an excellent activity for newly formed teams of 6 to 15 \
members. It speeds up team building by sharing traits and interests \
so that team members can build closer bonds than possible with just \
work-related stuff. \
<br><br> \
Have the team form a circle with everyone looking inwards. Leave about a \
foot of space between people. Depending on what you want to stress with this activity, you can ask colleagues that usually \
work remotely to stand about 5 feet away from the circle. \
<br><br> \
Hand a ball of yarn to a random player and tell them to hold on tight to the end \
of the yarn with their non-dominant hand and the ball in the dominant one. The \
yarn holder starts the game by saying something about themselves that is not \
work-related such as 'I have a daughter' or 'I play the guitar'. If this statement \
is true for any other team member they raise their hand and say 'Yes, that's me'. \
The yarn holder passes the ball to the person who raised their hand. If there's \
more than one, the yarn holder can choose one. If no one shares the statement the \
yarn holder has to make another statement. \
<br><br> \
The person who received the ball of yarn holds on to the thread and tautens it. \
This is the first connection in a network of shared traits. The new yarn holder \
now makes a statement about themselves, passes the ball while holding on to their \
part of the yarn and so on. \
<br><br> \
The game ends when time is up OR everybody has at least two connections OR the \
yarn runs out. \
<br><br> \
You can debrief with some of these questions: \
<ul> \
    <li>What did you notice?</li> \
    <li>If you've got remote people: How does it feel to stand apart? How does it feel to have someone stand apart?</li> \
    <li>How do you feel about few (or no) connections?</li> \
    <li>What is it like to see this web of connections?</li> \
    <li>Can you be a team without this web?</li> \
    <li>What would happen if someone let go of their threads? \
How would it affect the team?</li> \
    <li>Is there anything you will do differently at work now?</li> \
</ul> \
<br> \
This activity is only the first part of a \
<a href='https://dl.dropboxusercontent.com/u/440419/Stringtheory%20-%20Hidden%20Connections%20-%20Exercise.pdf'>longer game</a>.",
source:    "<a href='https://twitter.com/ebstar'>Eben Halford</a>",
duration:    "Medium",
stage:    "Forming",
suitable:  "iteration, project, release"
};
// Values for duration: "<minMinutes>-<maxMinutes> perPerson"
// Values for suitable: "iteration, realease, project, introverts, max10People, rootCause, smoothSailing, immature, largeGroup"
