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
name:      "Открытый список дел",
summary:   "Участники предлагают и берут ответственность за действия",
desc:      "Подготовте флипчарт с 3 столбами 'Что', 'Кто' и 'Когда'. \
Спросите участников одного за другим, что они хотят сделать для улучшения \
команды. Запишите действие, договоритесь о том 'когда' оно должно быть сделано и  \
попросите участника вписать своё имя. <br>\
Если кто-то предлагает действие для всей команды, то он должен договориться \
со всеми, чтобы они сами вписали своё имя.",
source:    source_findingMarbles + ", инспирированно <a href='http://lwscologne.wordpress.com/2012/05/08/11-treffen-der-limited-wip-society-cologne/#Retrospektiven'>этим списком</a>",
durationDetail:  "10-15 groupSize",
duration:    "Средняя",
stage:    "All",
suitable: "итерация, релиз, малаягруппа"
};
all_activities[24] = {
phase:     2,
name:      "Причинно-Следственная Диаграмма",
summary:   "Найти источник проблемы, происхождение которой трудно определить и приводит к бесконечным дискуссиям",
desc:      "Напишите проблему, которую вы хотите исследовать на стикер и приклейте его в середину доски. \
Анализируйте в чем конкретно состоит проблема, постоянно спрашивая 'Что следует из этого?'. \
Выясняйте первопричины спрашиваю, 'почему' (это произошло)? Записывайте ваши выводы на стикерах. \
Визуализируйте причинно-следственные связи с помощью стрелок. Каждый стикер можете иметь несколько причин и несколько следствий.<br> \
Если вы найдёте причино-следственный круг, это как правило, представляют собой хорошую базу для действий. \
Если вы можете сломать этот негативный круг, вы можете улучшить сразу очень многое.",
source:    "<a href='http://blog.crisp.se/2009/09/29/henrikkniberg/1254176460000'>Henrik Kniberg</a>",
more:      "<a href='http://finding-marbles.com/2011/08/04/cause-effect-diagrams/'>Corinna's experiences</a>",
durationDetail:  "20-60 complexity",
duration:    "Длительная",
stage:    "Бурление, Нормирование",
suitable: "релиз, проект, малаягруппа, complex"


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
desc:      "Предложи команде пообедать вместе, лучше всего в китайском или азиатском кафе, чтобы оставаться &quot;в теме&quot;. \
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
name:      "Прогулка",
summary:   "Пойдите в ближайший парк, прогуляйтесь и просто поболтайте",
desc:      "На улице хорошая погода? Зачем оставаться в закрытом помещении, когда можно выйти на свежий воздух, наполнить свой мозг кислородом  \
и новыми оригинальными идеями, отличающимися от стандартных предложений. Выйдите и прогуляйтесь в ближайший парк. \
Разговор естественным  образом сведётся к темам, связанным с работой. Это хороший способ отвлечься от рутинных дел, когда рабочий процесс налажен и все работает относительно гладко. \
Чтобы поддержать дискуссию не требуется дополнительных средств, таких как визуализация или документирование. Зрелые команды могут легко выносить на обсуждение и  \
беседовать о важных темах, а так же достигать соглашений даже в такой неформальной обстановке",
source:    source_findingMarbles,
durationDetail:  "60-90",
duration:    "Длительная",
stage:    "Функционирование, Расформирование",
suitable: "итерация, релиз, небольшие группы, smoothSailing, mature"
};
all_activities[28] = {
phase:     3,
name:      "Circles &amp; Soup / Круги влияния",
summary:   "Create actions based on how much control the team has to carry them out",
desc:      "Приготовь флип чарт с 3 концентрическими кругами, каждый круг должен быть достаточно большим, чтобы вместить в себя несколько стикеров. Label them \
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
name:      "Поле для разговора",
summary:   "Структурированный подход к обсуждению",
desc:      "Поле для разговора выглядит как часть настольной игры. Вы можете найти тут \
<a href='http://www.softwarestrategy.co.uk/dialogue-sheets/'>несколько различных примеров(на английском языке)</a>. \
Выбирите подходящее поле, распечатайте его в максимально большом формате (желательно А1) и следуйте иструкциям.",
source:    "<a href='http://www.softwarestrategy.co.uk/dialogue-sheets/'> Allen Kelly at Software Strategy</a>",
durationDetail:  "90-120",
duration:    "Длительная",
stage:    "Любая",
suitable: "итерация, релиз, проект"
};
all_activities[30] = {
phase:     0,
name:      "Чек-ин - нарисуй итерацию",
summary:   "Участники рисуют определенный аспект итерации",
desc:      "Распределите карточки и маркеры. Задайте тему, например: \
<ul>\
<li>Как ты себя чувствовал(а) во время итерации?</li>\
<li>Твой самый приятный момент?</li>\
<li>Какова была самая большая проблема?</li>\
<li>Чего тебе не хватало?</li>\
</ul>\
Попросите участников нарисовать свой ответ и прикрепить рисунки на доску. \
Начните с того что участники угадывают, что означает картинки других. Потом создатели коротко объясняют свою картинку.<br> \
Метафоры открывают новые горизонты и помагают сформировать общее понимание вещей.",
source:    source_findingMarbles + ", адаптированно из идеи <a href='http://vinylbaustein.net/2011/03/24/draw-the-problem-draw-the-challenge/'>Thorsten Kalnin</a> and Olivier Gourment",
durationDetail:  "5 + 3 на человека",
duration:    "Средняя",
stage:    "Функционирование",
suitable: "итерация, релиз, проект"
};