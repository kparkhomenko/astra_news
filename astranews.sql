-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 06 2024 г., 23:53
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `astranews`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `news_id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(450) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `news_id`, `user_id`, `user_name`, `text`, `status`, `created_at`, `updated_at`) VALUES
(16, 4, 2, 'Темнов Сергей Владимирович', 'Очень большие ожидания касательно проекта. У нас ещё не было чего-то подобного в городе.', 'moderated', '2024-06-06 20:26:41', '2024-06-06 20:39:14'),
(17, 1, 2, 'Темнов Сергей Владимирович', 'Победил мой фаворит!', 'moderated', '2024-06-06 20:27:10', '2024-06-06 20:39:16'),
(18, 12, 2, 'Темнов Сергей Владимирович', 'Действительно стоящий внимания проект. Очень приятно понимать, что люди с ограниченными возможностями получают поддержку со стороны волонтёров, создающих подобные фонды.', 'moderated', '2024-06-06 20:29:06', '2024-06-06 20:39:19'),
(19, 8, 3, 'Артамонов Анатолий Маратович', 'Есть вероятность того, что джузгун у нас не приживётся, поскольку этот кустарник в последнее время довольно плохо переносит сильную жару практически во всём мире. Учёные полагают, что это связано с \"парниковым эффектом\".', 'moderated', '2024-06-06 20:34:35', '2024-06-06 20:39:33'),
(20, 8, 2, 'Темнов Сергей Владимирович', 'Анатолий, почему вы считаете, что он у нас не приживётся? У него большая популяция в Астрахани, причём большая часть которых вполне себе хорошо себя чувствует в очень жарких уголках нашего региона.', 'moderated', '2024-06-06 20:36:22', '2024-06-06 20:39:34'),
(21, 8, 3, 'Артамонов Анатолий Маратович', 'У меня тесное общение с ботаниками из АГУ, которые как раз и принимали участие в этом проекте. Они как раз и имеют такую точку зрения.', 'moderated', '2024-06-06 20:38:46', '2024-06-06 20:39:35'),
(22, 3, 3, 'Артамонов Анатолий Маратович', 'Какой-то нецензурный комментарий', 'unmoderated', '2024-06-06 20:40:53', '2024-06-06 20:40:53'),
(23, 3, 3, 'Артамонов Анатолий Маратович', 'Вообще, понятие \"центр\" зависит от определения. Что здесь понимается под центром водных видов спорта?', 'unmoderated', '2024-06-06 20:46:53', '2024-06-06 20:46:53');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2024_05_07_155405_create_news_table', 1),
(12, '2024_05_10_201538_create_views_table', 3),
(13, '2024_05_09_192053_create_comments_table', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(1255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `user_id`, `title`, `text`, `category`, `img`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'В Астрахани выбрали мистера и миссис Спорт', 'Спорт, по мнению наших читателей, стала Людмила Голованова. Снимок девушки набрал более 700 голосов! Такое количество лайков не оставило шансов на победу для других участниц. Но все же соперничество было у Людмилы с \"девушкой-бетмен\". Спортсменки шли ноздря в ноздрю, но в итоге Людмила вырвалась вперед, что и привело к победе. В детстве Людмила занималась гандболом и спортивными танцами. Сейчас девушке 23года, и себя она нашла именно в бодибилдинге. Тягает \"железо\" Людмила уже на протяжении трех лет. Участие в подобном конкурсе девушка принимала впервые и сразу же завоевала главный приз!   -  На участие в фотоконкурсе меня уговорил друг. А голосовали друзья, близкие. Наверное, и посторонние люди, - рассказала Людмила Голованова.   Мистером Спорт стал Владимир Левковский. Еще в детстве Владимир профессионально занимался футболом, борьбой и даже брейк-дансом. В  старших классах вкусы стали меняться, и молодой человек увлёкся баскетболом. Сейчас парню 25, и большую часть жизни он играет в Астраханской баскетбольной лиге за команду \"АХТУБА АГС\". Но не пропал интерес и к футболу - Владимир играет в Астраханской бизнес-лиге за команду \"Авиапром - Аэропорт\".', 'Спорт', 'vDST3SDDqK9p45Eaq66FnW2af1Q5EE1vxVPMBKKG.jpg', 'moderated', '2024-05-15 20:14:42', '2024-05-15 20:14:42'),
(2, 1, 'В Астрахани отметили День зимних видов спорта', 'Мероприятие, ставшее традиционным в Астраханской области, прошло в Центре зимних видов спорта. Спортсмены представили показательные номера по фигурному катанию, а также провели турнир по хоккею среди юношей 2013-2014 г.р.\r\n\r\nПо данным регионального министерства физической культуры и спорта, всего в Астраханской области хоккеем занимается порядка 1,5 тысяч спортсменов, фигурным катанием - около 800.\r\n\r\nБлагодаря поддержке губернатора Игоря Бабушкина регион не раз становился площадкой для проведения соревнований высокого уровня. Среди них - региональный этап ночной лиги, открытые турниры, а также мастер-классы с именитыми спортсменами.', 'Спорт', 'lzU0vB0bv1fPR5zaY2pTzvhAMOlaTfbQAhNdw9Rq.jpg', 'moderated', '2024-05-15 20:16:34', '2024-05-15 20:16:34'),
(3, 1, 'Работы по восстановлению Центра водных видов спорта возобновят', 'Как заявила на пресс-конференции министр спорта Астраханской области Нина Ивашкина, для большего привлечения к занятиям физкультурой, в регионе отстраиваются новые ФОКи. \r\n\r\nВ рамках национального проекта под перестройку попал и Центр водных и гребных видов спорта. Проект разработан и начнет реализовываться в 2024 году. \r\n\r\nПо завершению стройки центр будет включать в себя универсальный игровой зал, медицинский реабилитационный центр, футбольное поле с трибунами, легкоатлетические дорожки и тд.', 'Спорт', '6FEdH77aNccbqyCzNl28n24w1GcLTGRULDqbhqHe.jpg', 'moderated', '2024-05-15 20:19:27', '2024-05-15 20:19:27'),
(4, 1, 'В Астрахани появится дворец единоборств и центр массового спорта', 'В Астраханской области в 2020 году хотят приступить к строительству дворца единоборств и центра массового спорта. Об этом говорилось на заседании комитета региональной Думы по образованию, культуре, науке, молодежной политике, спорту и туризму. На нем депутаты и представители профильных министерств обсуждали проекта бюджета на следующий год.\r\nРуководитель министерства физической культуры и спорта области Максим Фидуров сообщил на заседании комитета, что на 2020 год на спортивные объекты запланирован бюджет в размере 900 млн рублей. Их них 199 млн рублей – на строительство капитальных объектов, в числе которых крытый футбольный манеж, дворец единоборств, центр массового спорта. Также планируется продолжить строительство физкультурно-оздоровительных комплексов (ФОКов) и школьных стадионов. «Объекты, которые по разным причинам не удалось завершить в этом году, не потеряют финансирование и будут продолжены в 2020 году», - заверил Максим Фидуров.Депутаты тему завершения строительства ФОКов взяли на особый контроль.', 'Спорт', 'xn8wbhN1HHyMWAXr6rWiqUFCdwrbXCr3TOdR18rP.jpg', 'moderated', '2024-05-15 20:22:12', '2024-05-15 20:22:12'),
(5, 1, 'Пески наступают. Астраханскую область выбрали пилотным регионом программы по борьбе с опустыниванием', 'Астраханская область станет пилотным регионом национальной программы по борьбе с опустыниванием. Об этом стало известно в ходе рабочей встречи главы региона Игоря Бабушкина и директора Федерального научного центра агроэкологии, комплексных мелиораций и защитного лесоразведения Российской академии наук Александра Беляева. Национальная программа действий по борьбе с опустыниванием будет создана до конца 2024 года. В неё войдут 14 субъектов РФ, в том числе Астраханская область. Реализовывать её будут поэтапно.\r\nНад теоретической частью программы работает Федеральный научный центр агроэкологии РАН, учитывая специфику каждого региона. Программа для Астраханской области будет включать комплекс мероприятий, связанных с мелиорацией земель сельхозназначения, а также обводнением зоны западных подстепных ильменей. Директор ФНЦ Агроэкологии РАН Александр Беляев сообщил, что Астраханская область выбрана пилотным регионом для реализации программы неслучайно: по его словам, с научной точки зрения область хорошо подготовлена к этой работе. Более того, астраханских учёных планируют привлечь к разработке программ по борьбе с опустыниванием и для других регионов ввиду высокого уровня подготовки специалистов.', 'Регион', '7TdwEPXeTe52CgGsj3g254omSxA4C4xgbPWLpBfd.jpg', 'moderated', '2024-05-15 20:25:02', '2024-05-15 20:25:02'),
(6, 1, 'Названы регионы — лидеры по уровню безработицы. А что с Астраханской областью?', 'Эксперты РИА Новости подготовили рейтинг российских регионов по уровню безработицы за четвертый квартал прошлого года. \r\n\r\nРейтинг составили по возрастающей -  от регионов с самых низким значением безработицы до регионов с самыми высокими показателями.  \r\nЛидером рейтинга (то есть субъектом с наименьшим числом безработных) стал Ямало-Ненецкий автономный округ, где уровень безработицы составил 1,6%. В лидирующую группу с уровнем безработицы менее 2,5% также вошли Камчатский край, Ханты-Мансийский автономный округ, Санкт-Петербург, Татарстан, Москва, Чукотский автономный округ, Владимирская область, Курская область, Хабаровский край и Самарская область.\r\n\r\nАстраханская область заняла в рейтинге 75 место из 85. По данным РИА Новости, уровень безработицы в регионе в четверотом квартале прошлого года составил 6,7% и снизился по сравнению с аналогичным периодом за 2021 год на 0,6 пункта.', 'Регион', 'YdgdEc22Gyma3JufXhUkdS5dnagZkY1rD6EOIZ8I.jpg', 'moderated', '2024-05-15 20:26:15', '2024-05-15 20:26:15'),
(7, 1, 'Министр строительства РФ прибыл в Астрахань. Как он оценил состояние отрасли в регионе', 'Сегодня с рабочей поездкой в Астраханскую область прибыл министр строительства и жилищно-коммунального хозяйства РФ Ирек Файзуллин Он провёл отраслевое совещание. Главной темой обсуждения стал вопрос развития строительного комплекса и ЖКХ в регионе. \r\nВо вступительном слове Ирек Файзуллин отметил, что сегодня перед правительством страны стоит серьёзная задача: на основе поручений, озвученных Владимиром Путиным в Послании Федеральному Собранию, сформировать новые национальные проекты на ближайшие шесть лет.', 'Регион', 'oD6999m6SMTy5DwZFq3WLnBbsZEIFkmazzbpZDMo.jpg', 'moderated', '2024-05-15 20:30:53', '2024-05-15 20:30:53'),
(8, 1, 'МТС против опустынивания региона', 'Опустынивание почв Астраханской области и как следствие — пыльные бури — актуальная проблема для региона. Внести свой вклад в решение этого вопроса решила компания МТС - ведущая российская компания по предоставлению цифровых, медийных и телекоммуникационных сервисов.\r\n\r\nВместе с журналистами, волонтерами, учеными из АГУ и администрацией Харабалинского района в степи было высажено четыре тысячи саженцев кустарника джузгун и других озимых растений, которые подходят для борьбы с опустыниванием. Эти растения способны закрепить почву в степи и уберечь ее от деградации.\r\n\r\nДиректор Астраханского филиала МТС Андрей Матвиенко перед высадкой кустарников сказал «КаспийИнфо: «Сегодня мы начинаем проект с традиционного инструмента борьбы с опустыниванием - высадки деревьев и кустарников. Мы видим огромный потенциал использования цифровых технологий для комплексной работы над проблемой.', 'Регион', 'Vm0Ti7HYP36RHFQK4glOX5h5rBkr3Lm5WypqwO1t.jpg', 'moderated', '2024-05-15 20:31:54', '2024-05-15 20:31:54'),
(9, 1, 'В Астраханской области открыли новый Дом культуры', 'В поселок Верхний Бузан Красноярского района пришел долгожданный праздник – открылся новый Дом культуры. Его построили в рамках нацпроекта «Культура». В торжественном мероприятии приняли участие губернатор Астраханской области Игорь Бабушкин и председатель комитета Совета Федерации по науке, образованию и культуре Лилия Гумерова.\r\n\r\nКак рассказали красноярцы, новый Дом культуры они ждали 25 лет. Его строительство началось благодаря поддержке Игоря Бабушкина и неравнодушных жителей.\r\nВ новом здании разместили зрительный зал на 100 мест, кабинеты кружков разного направления, библиотеку и методический кабинет. Здесь будут работать секции по декоративно-прикладному творчеству, хореографии и вокалу.\r\n\r\nНациональный проект «Культура» реализуется в Астраханской области с 2019 года. За это время в регионе возвели 11 Домов культуры в отдаленных сельских районах. Как отметила Лилия Гумерова, по инициативе Председателя Совета Федерации Валентины Матвиенко мероприятия по реализации национального проекта планируется продлить до 2030 года.', 'Культура', 'Lu71Kptfnid4sBzmqURab1uPVWeuxtfODWYJi0Kq.jpg', 'moderated', '2024-05-15 20:34:25', '2024-05-15 20:34:25'),
(10, 1, 'В Астрахани дан старт Дням культуры Республики Казахстан в Российской Федерации', 'Дни культуры проходят с 4 по 13 сентября в Москве, Казани и Астрахани. В октябре между городами Атырау и Астраханью планируется подписать меморандум об установлении побратимских отношений. Об этом рассказал заместитель акима Атырауской области Кайрат Нуртаев.\r\n\r\nДни культуры совпали с Международным фестивалем классического искусства «OPERA FIRST». В рамках фестиваля 10 сентября в Астрахани пройдет концерт «День Казахстана». \r\n\r\nВ Астраханском театре оперы и балета прошел большой праздничный концерт мастеров искусств Казахстана. Вице-губернатор Астраханской области Олег Князев поприветствовал участников: «Республика Казахстан – наш ближайший сосед. Нас связывают крепкие отношения, основанные на дружбе, взаимопонимании и доверии. Мы тесно сотрудничаем в разных областях: сфере торговли, промышленности, сельском хозяйстве. Уверен, что взаимодействие между нашими регионами будет только крепнуть».', 'Культура', 'cM2rFxxcgII8PLGzqKblX9zHkvRWBGAKX91avtCT.jpg', 'moderated', '2024-05-15 20:35:43', '2024-05-15 20:35:43'),
(11, 1, 'Астраханских школьников научили современной хореографии на образовательном проекте МТС', 'Своим опытом с юными танцорами поделилась Анастасия Сивочуб, астраханский хореограф и педагог танцевального центра «Leader Dance». Она не только познакомила астраханок со стилем Jazz Funk, но и рассказала о возможностях, которые открываются благодаря участию в проектах.\r\n\r\n«Очень рада, что сейчас перед подростками открыты все двери, у них есть много возможностей реализовывать свой потенциал и становиться танцорами международного уровня. Но тем не менее, для этого нужно трудиться, выходить за рамки любимых стилей и пробовать новое, а еще – участвовать в подобных проектах, как «Поколение М». При этом, совсем не важно, где ты находишься – в Астрахани или в столице, благодаря маленькому устройству, которое мы всегда носим с собой, и интернету в нем можно перенимать опыт своих кумиров, общаться с ними и наращивать скиллы», - отмечает Анастасия.', 'Проекты', 'uY5k9tttdonJJeqNllPjQbvjVNDZ4GkTWvaWHzpV.jpg', 'moderated', '2024-05-15 20:36:47', '2024-05-15 20:36:47'),
(12, 1, 'Проект «Помощь рядом» помогает подопечным благотворительных фондов', 'В Астрахани стартовал социальный проект Яндекса «Помощь рядом». Благодаря ему, благотворительные фонды, смогут бесплатно перевозить на такси людей с особенностями здоровья. В проекте участвуют водители из таксопарков, которые являются партнёрами сервиса Яндекс Go. Несмотря на высокие рейтинги, все они, перед тем, как начать сотрудничество с «Помощью рядом», пройдут специальное обучение.\r\n\r\nСоциальный проект «Помощь рядом» сотрудничает с такими фондами в Астрахани, как «Аутизм. Астрахань», «Подарок Ангелу» и «Guide dogs», которые патронируют людей с особыми потребностями. Так фонд «Подарок ангелу» помогает детям и взрослым с патологиями опорно-двигательного аппарата, а «Guide dogs» содействует социальной реабилитации людей с ограниченными возможностями при помощи собак-терапевтов и собак-поводырей.', 'Проекты', '4HBJEQJd2ezCuFxhOTq3m7BfmJ4WOGaqfvQbztOP.jpg', 'moderated', '2024-05-15 20:37:56', '2024-05-15 20:37:56');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `district`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Иванов Иван Иванович', 'admin@mail.ru', 'Советский район', NULL, '$2y$10$tfmBNwt0hGROLgNiWDI0YO3fKBgQpjM2Ms7lP1T24FaC6gnYz9oWu', 'admin', NULL, '2024-05-15 20:02:00', '2024-05-15 20:02:00'),
(2, 'Темнов Сергей Владимирович', 'temnov@mail.ru', 'Трусовский район', NULL, '$2y$10$G0mgXb5ScJvJ2LiF0wGQYO5v1EFDBbBzQN.4BuIg9WnFDJpgoQEgW', 'user', NULL, '2024-05-15 20:44:35', '2024-05-15 20:44:35'),
(3, 'Артамонов Анатолий Маратович', 'artamonovv@mail.ru', 'Ленинский район', NULL, '$2y$10$.0p4RHlvnaRHaRz8q/SGMuICfev73D5V0XmGf1HUz2BCJqW.7LAvK', 'user', NULL, '2024-05-15 20:47:25', '2024-05-15 20:47:25');

-- --------------------------------------------------------

--
-- Структура таблицы `views`
--

CREATE TABLE `views` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `news_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `views`
--

INSERT INTO `views` (`id`, `user_id`, `news_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2024-05-15 20:16:41', '2024-05-15 20:16:41'),
(2, 2, 4, '2024-05-15 20:44:39', '2024-05-15 20:44:39'),
(3, 2, 1, '2024-05-15 20:44:56', '2024-05-15 20:44:56'),
(4, 2, 7, '2024-05-15 20:45:39', '2024-05-15 20:45:39'),
(5, 2, 10, '2024-05-15 20:46:19', '2024-05-15 20:46:19'),
(6, 3, 10, '2024-05-15 20:47:35', '2024-05-15 20:47:35'),
(7, 3, 5, '2024-05-15 20:47:58', '2024-05-15 20:47:58'),
(8, 2, 8, '2024-05-30 16:58:34', '2024-05-30 16:58:34'),
(9, 2, 3, '2024-05-30 17:49:08', '2024-05-30 17:49:08'),
(10, 1, 3, '2024-05-30 18:19:15', '2024-05-30 18:19:15'),
(11, 1, 8, '2024-05-30 19:41:06', '2024-05-30 19:41:06'),
(12, 1, 4, '2024-05-30 20:25:46', '2024-05-30 20:25:46'),
(13, 1, 7, '2024-05-31 15:18:25', '2024-05-31 15:18:25'),
(14, 1, 12, '2024-05-31 15:31:27', '2024-05-31 15:31:27'),
(15, 1, 5, '2024-05-31 15:45:38', '2024-05-31 15:45:38'),
(16, 1, 13, '2024-06-02 16:14:18', '2024-06-02 16:14:18'),
(17, 2, 19, '2024-06-02 18:10:34', '2024-06-02 18:10:34'),
(18, 3, 4, '2024-06-02 18:16:08', '2024-06-02 18:16:08'),
(19, 3, 2, '2024-06-02 18:16:14', '2024-06-02 18:16:14'),
(26, 2, 12, '2024-06-06 20:27:27', '2024-06-06 20:27:27'),
(27, 3, 8, '2024-06-06 20:31:24', '2024-06-06 20:31:24'),
(28, 3, 3, '2024-06-06 20:40:39', '2024-06-06 20:40:39'),
(29, 3, 1, '2024-06-06 20:43:10', '2024-06-06 20:43:10'),
(30, 3, 12, '2024-06-06 20:48:49', '2024-06-06 20:48:49');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_news_id_foreign` (`news_id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`),
  ADD KEY `views_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `views`
--
ALTER TABLE `views`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`);

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
