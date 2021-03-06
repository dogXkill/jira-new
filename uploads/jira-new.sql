-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 28 2021 г., 14:55
-- Версия сервера: 5.6.41
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `jira-new`
--

-- --------------------------------------------------------

--
-- Структура таблицы `abuse`
--

CREATE TABLE `abuse` (
  `id` int(13) NOT NULL,
  `user_id_from` int(13) NOT NULL COMMENT 'Потерпевший',
  `user_id_to` int(13) NOT NULL COMMENT 'Обвиняемый',
  `time` int(13) NOT NULL COMMENT 'Время поступления жалобы'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `account`
--

CREATE TABLE `account` (
  `id` int(99) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pas` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `status` int(99) NOT NULL,
  `rol` int(99) NOT NULL COMMENT '0-гл.админ,1-админ,2-пользователь'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `account`
--

INSERT INTO `account` (`id`, `name`, `login`, `pas`, `salt`, `status`, `rol`) VALUES
(1, 'Слава', 'slava', '76a277fd5b01e1bb39d0dd8fdb040c46', 'O1h`icF]', 1, 0),
(3, 'Майкл', 'Mike', 'd1d623c2df6e8d4f84068d45edc99f40', '^wqHMo9!', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(99) NOT NULL,
  `id_ac_av` int(99) NOT NULL COMMENT 'id аккаунта который добавил в систему',
  `name_client` varchar(255) NOT NULL,
  `status` int(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `id_ac_av`, `name_client`, `status`) VALUES
(1, 1, 'China-Sale', 1),
(2, 1, 'Gipmar', 1),
(3, 3, 'test_client', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `cooment_zad`
--

CREATE TABLE `cooment_zad` (
  `id` int(99) NOT NULL,
  `id_zad` int(99) NOT NULL,
  `id_user` int(99) NOT NULL,
  `text` text NOT NULL,
  `dat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cooment_zad`
--

INSERT INTO `cooment_zad` (`id`, `id_zad`, `id_user`, `text`, `dat`) VALUES
(1, 1, 1, 'test', '2021-07-07 04:12:50'),
(2, 1, 1, 'test1', '2021-07-07 04:21:48'),
(3, 4, 1, 'test_proe', '2021-07-07 04:22:04'),
(4, 8, 1, 'test', '2021-07-07 04:39:00'),
(5, 4, 1, 'test', '2021-07-07 06:27:17'),
(6, 3, 1, 'test_m', '2021-07-07 06:27:25'),
(7, 3, 1, 'test_,1', '2021-07-07 06:27:37');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(99) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `vid_ic` int(99) NOT NULL COMMENT '1-своя,0-встроенная',
  `url` varchar(255) NOT NULL,
  `status` int(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `icon`, `vid_ic`, `url`, `status`) VALUES
(1, 'Главная', 'home', 0, 'home', 1),
(2, 'Проекты', 'box', 0, 'proects', 1),
(3, 'Аккаунты', 'user', 0, 'users', 1),
(4, 'Клиенты', 'users', 0, 'clients', 1),
(5, 'Баги/Исправления', '<i class=\"fas fa-bug dop_icon\"></i>', 1, 'bugs', 1),
(6, 'Выгрузка', '<i class=\"fas fa-upload dop_icon\"></i>', 1, 'upload', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `read_time` int(11) NOT NULL DEFAULT '0',
  `message` text CHARACTER SET utf8 NOT NULL COMMENT 'Текст сообщения',
  `userAgent` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'Содержит информацию из какого браузера сообщение отправлено'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `messages_translate`
--

CREATE TABLE `messages_translate` (
  `id` int(9) NOT NULL,
  `message_id` int(8) NOT NULL,
  `language` varchar(2) NOT NULL,
  `text` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `online`
--

CREATE TABLE `online` (
  `id` int(99) NOT NULL,
  `id_ac` int(99) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `online`
--

INSERT INTO `online` (`id`, `id_ac`, `date_time`) VALUES
(3, 1, '2021-07-28 14:54:39'),
(4, 3, '2021-07-08 22:03:07');

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int(99) NOT NULL,
  `id_avtor` int(99) NOT NULL,
  `id_client` int(99) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(99) NOT NULL COMMENT '1-активный,0-выкл',
  `visible` int(99) NOT NULL COMMENT '1-публичный,0-приватный',
  `date_start` datetime NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id`, `id_avtor`, `id_client`, `name`, `status`, `visible`, `date_start`, `img`) VALUES
(1, 1, 0, 'Основной проект', 1, 1, '2021-07-01 01:12:16', ''),
(2, 1, 0, 'Второй проект', 1, 0, '2021-07-02 05:17:21', ''),
(5, 1, 0, 'test', 1, 1, '2021-07-07 10:15:20', '-'),
(6, 1, 1, 'test_pr', 1, 0, '2021-07-08 06:29:18', '-'),
(7, 1, 2, 'test_pr', 1, 0, '2021-07-08 06:29:40', '-'),
(8, 3, 3, 'private_pr', 1, 0, '2021-07-08 08:58:29', '-'),
(9, 1, 2, 'gipmar', 1, 0, '2021-07-16 23:45:15', '-');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `avatar_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `error` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users_relations`
--

CREATE TABLE `users_relations` (
  `user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT 'Избран, Заблокирован, В контактах'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Отношения (чёрный список, избранное, список контактов)';

-- --------------------------------------------------------

--
-- Структура таблицы `zadach`
--

CREATE TABLE `zadach` (
  `id` int(99) NOT NULL,
  `id_pr` int(99) NOT NULL,
  `name` varchar(255) NOT NULL,
  `opis` longtext NOT NULL,
  `prior` int(99) NOT NULL COMMENT '1-срочно,2-средне,3-несрочно',
  `tag` varchar(255) NOT NULL,
  `avtor_id` int(99) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(99) NOT NULL COMMENT '1-В работе,2-Выполнено,3-Невыполнено,4-отмена'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `zadach`
--

INSERT INTO `zadach` (`id`, `id_pr`, `name`, `opis`, `prior`, `tag`, `avtor_id`, `date`, `status`) VALUES
(1, 9, 'Отцентровать ', 'Отцентровать изображение раздела каталога по ширине: http://joxi.ru/8AngPyDCyX8Y8r', 0, '-', 1, '2021-07-28 14:03:39', 1),
(2, 9, 'Буквы в кнопк', 'Буквы в кнопке \'вход\' сделать заглавными. При наведении курсора на кнопку \'ВХОД\' нужно выделение цветом чтобы пользователю было понятно что он на нее навел, можно например сделать замену на желтый цвет по (цвет из логотипа): http://joxi.ru/J2bOpLETVBv3xA', 0, '-', 1, '2021-07-28 14:03:39', 1),
(3, 9, 'Панель ввода ', 'Панель ввода пароля и регистрации по центру экрана: http://joxi.ru/Vm6DJWeUv1XBPA', 0, '-', 1, '2021-07-28 14:03:39', 1),
(4, 9, 'Шрифт наимено', 'Шрифт наименованиея столбцов в заголовке сделать церным цветом как у слова \'Выбор\' или', 0, '-', 1, '2021-07-28 14:03:39', 1),
(5, 9, 'Ширину столбц', 'Ширину столбцов списка заказов сделать как у оригинала, они выверены по количеству текста: http://joxi.ru/v295MKeFp9Lz02', 0, '-', 1, '2021-07-28 14:03:39', 1),
(6, 9, 'Уменьшить шри', 'Уменьшить шрифт и высоту (в основном высоту) статусов, чтобы не били по глазам. Можно сделать либо как в оригинале, либо меньше: http://joxi.ru/vAWQ7w1hOa63Zm', 0, '-', 1, '2021-07-28 14:03:39', 1),
(7, 9, 'Первая строка', 'Первая строка заказа должна быть темной чтобы не сливаться с заголовком как в оригинале: http://joxi.ru/823D7QeU8M54nA Черную полосу надо убрать: http://joxi.ru/Q2K8KMdUv3WpPA', 0, '-', 1, '2021-07-28 14:03:39', 1),
(8, 9, 'Увеличить нем', 'Увеличить немного размер логотипа: http://joxi.ru/5mdXbZpU8P6pDm', 0, '-', 1, '2021-07-28 14:03:39', 1),
(9, 9, 'В указании ко', 'В указании кол-ва строк в списке заказов нет необходимости, удаляем: http://joxi.ru/Grq0PN6tGV663A', 0, '-', 1, '2021-07-28 14:03:39', 1),
(10, 9, 'Левый края кн', 'Левый края кнопки \' + добавить заказ\' должен быть в одну линию по вертикали с левым краем списка заказов: http://joxi.ru/5mdXbZpU8P6PLm', 0, '-', 1, '2021-07-28 14:03:39', 1),
(11, 9, 'Переключение ', 'Переключение между станицами списка заказов ненужно, список просто будет прокручиваться вниз-вверх без страниц, а размер и место нахождение нам будет подсказывать полоса прокрутки: http://joxi.ru/Dr8QgLehMjyYzm', 0, '-', 1, '2021-07-28 14:03:39', 1),
(12, 9, 'По правому кр', 'По правому краю: http://joxi.ru/bmoMP7QUykQEWA', 0, '-', 1, '2021-07-28 14:03:39', 1),
(13, 9, 'Строка поиска', 'Строка поиска для каталога и списка заказа у нас должна быть в одном месте после вкладки \'каталог\': http://joxi.ru/RmzdPlOTMQOlkA Если мы во вкладке каталог, то поиск работает по каталогу, если в списке заказов, то по списку заказов, тоесть ищет на той странице, на которой находится пользователь.', 0, '-', 1, '2021-07-28 14:03:39', 1),
(14, 9, 'Эту строку мо', 'Эту строку можно чуть увеличить по высоте как у оригинала, чтобы кнопки и вкладки так не прижимались к верху: http://joxi.ru/4AkNPxwHkbR7J2', 0, '-', 1, '2021-07-28 14:03:39', 1),
(15, 9, 'При наведении', 'При наведении курсора на кнопку \'+ добавить заказ\' сделать выделение цветом как у оригинала:', 0, '-', 1, '2021-07-28 14:03:39', 1),
(16, 9, 'Нет столбцов \'', 'Нет столбцов \'сумма\' и \'сообщ./почта\': http://joxi.ru/BA0BkDeTp94Yvm', 3, '-', 1, '2021-07-28 14:03:39', 1),
(17, 9, 'Три черточки ', 'Три черточки сделать больше по размеру и отчентровать по высоте по отношению к номеру Пользователя: http://joxi.ru/LmGk6NQclKnOLmэ', 0, '-', 1, '2021-07-28 14:03:39', 1),
(18, 9, '\'пн-сб\' сделат', '\'пн-сб\' сделать серым как в оригинале: http://joxi.ru/Dr8QgLehMjygwm', 0, '-', 1, '2021-07-28 14:03:39', 1),
(19, 9, 'Посмотреть ба', 'Посмотреть баг, иногда возникает - заголовок сжимается по отношению к столбцам: http://joxi.ru/Dr8QgLehMjyawm', 3, '-', 1, '2021-07-28 14:03:39', 1),
(20, 9, 'Значек ввода ', 'Значек ввода меню надо отцентрировать по высоте и сделать больше по размеру: http://joxi.ru/Dr8QgLehMl8Kpm', 3, '-', 1, '2021-07-28 14:03:39', 1),
(21, 9, 'При клике на \'', 'При клике на \'выбор\' всплывает окошко \'test\' :http://joxi.ru/YmEXQ7eUM6yLxr\nНужно чтобы можно было отсортировать по выбранному статусу из выпадающего списка.', 0, '-', 1, '2021-07-28 14:03:39', 1),
(22, 9, 'Когда меняешь', 'Когда меняешь размеры окна браузера (тестировал в 3-х браузерах) то заголовок отрезается и возвращается в нормальное положение после обновления страницы: http://joxi.ru/L21D1YeU0yqN9m', 3, '-', 1, '2021-07-28 14:03:39', 1),
(23, 9, 'выбор города ', 'выбор города при вводе адреса(создания заказа и в карточке заказа)', 3, '-', 1, '2021-07-28 14:03:39', 1),
(24, 9, 'Шрифт первой ', 'Шрифт первой почты и телефона клиента синим жирным шрифтом как кнопки \'посмотреть на карте\' и \'добавить адрес\'. Поля подписать (фоновая подпись) как \'основная почта\' и \'основной телефон\'', 0, '-', 1, '2021-07-28 14:03:39', 1),
(25, 9, 'Одинакового т', 'Одинакового темного цвета поля: http://joxi.ru/KAg1l39UKJppNm', 3, '-', 1, '2021-07-28 14:03:39', 1),
(26, 9, 'на уровне стр', 'на уровне строк с номером заказа и статусом нам нужно в 2-ве строки разместить наименование ресурса, данные Менеджера и данные Поставщика. Надо попробовать \'поджать\' строки по высоте\' чтобы это нормально смотрелось.', 3, '-', 1, '2021-07-28 14:03:39', 1),
(27, 9, 'Почта клиента', 'Почта клиента (вся строка) не видна Поставщику.', 0, '-', 1, '2021-07-28 14:03:39', 1),
(28, 9, 'Поле \'Стоимос', 'Поле \'Стоимость по прайсу\' переименовать в \'Стоимость услуг\'.', 3, '-', 1, '2021-07-28 14:03:39', 1),
(29, 9, 'Номер телефон', 'Номер телефона должен по умолчанию начинаться с +7, а далее неограниченное кол-во цифр, так как у регионов их кол-во отличается. ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(30, 9, 'при выборе да', 'при выборе даты доставки всплывает календарь: http://joxi.ru/DmB3okei4QVwY2', 0, '-', 1, '2021-07-28 14:03:39', 1),
(31, 9, 'поменять в за', 'поменять в задачах \'дата выполнения\' на \'дата создания\'', 3, '-', 1, '2021-07-28 14:03:39', 1),
(32, 9, 'добавить форм', 'добавить форму создания заметки(текст+дата выполнения)', 0, '-', 1, '2021-07-28 14:03:39', 1),
(33, 9, 'поменять диза', 'поменять дизайн кнопки \'отказ\' (чёрный текст без фона)', 3, '-', 1, '2021-07-28 14:03:39', 1),
(34, 9, 'выполненые па', 'выполненые падают вниз', 0, '-', 1, '2021-07-28 14:03:39', 1),
(35, 9, 'в мобильной в', 'в мобильной версии открывать таблицу с заказами и карточку заказа как на пк', 0, '-', 1, '2021-07-28 14:03:39', 1),
(36, 9, 'в моббильной ', 'в моббильной версии отображать меню как на пк', 0, '-', 1, '2021-07-28 14:03:39', 1),
(37, 9, 'меню категори', 'меню категорий по умолчанию открыто при просмотре на компьютере', 3, '-', 1, '2021-07-28 14:03:39', 1),
(38, 9, 'Последнее соо', 'Последнее сообщение в чате и в сообщения в КАРТОЧКЕ ЗАКАЗ красным фоном вместо зеленого. Строку \'новые сообщения\' удалить. http://joxi.ru/V2VzyVkCkzRwe2', 3, '-', 1, '2021-07-28 14:03:39', 1),
(39, 9, 'На некоторых ', 'На некоторых мониторах (например 11 и 13) в карточке заказа сообщения в КАРТОЧКЕ ЗАКАЗА налазят друг на друга: http://joxi.ru/n2Y6N47HeQ9GxA', 3, '-', 1, '2021-07-28 14:03:39', 1),
(40, 9, 'Черный фон в в', 'Черный фон в вертикальной полосе прокрутки карточки товра должен быть одной ширины с кусочком такой же полосы выше него в шапке. Тоесть полоску в шапке расширить до ширины черной прокрутки http://joxi.ru/4AkNPxwHk7Zky2', 3, '-', 1, '2021-07-28 14:03:39', 1),
(41, 9, 'В заказа долж', 'В заказа должна быть кнопка сохранить. Кнопка нужна чтобы сохранить новый добавленный заказ и внесенные изменения в уже имеющейся заказ. Изменения в заазе можт делать только Менеджер. Если вносятся изменения в уже ранее заведенный заказ то статус автоматически у этого заказа меняется на \'ИЗМЕНЕН\' чтобы Поставщик видел что в заказе появились изменения. http://joxi.ru/bmoMP7QUy5JLPA', 3, '-', 1, '2021-07-28 14:03:39', 1),
(42, 9, 'Добавить кноп', 'Добавить кнопку \'печать\' в заказе при нажатии на которую информация по заказу переносится в WORD, либо сразу идет на печать.', 3, '-', 1, '2021-07-28 14:03:39', 1),
(43, 9, 'Посмотри в фа', 'Посмотри в фаерфоксе массовые действия перекрываются прокруткой каталога, сдвинь немного вправо на ширину 2-х букв: http://joxi.ru/nAyWPj3Iwdq7ym', 1, '-', 1, '2021-07-28 14:03:39', 1),
(44, 9, 'В Карточке за', 'В Карточке заказа во вкладке \'задачи\' кнопку \'добавить задачу нужно разместить по центру, сделать ее размер по  высоте и ширине  как у кнопки \'добавить заказ\'. http://joxi.ru/l2ZWJD8I7GJkPA После знака \'+\' поставить пробел.', 3, '-', 1, '2021-07-28 14:03:39', 0),
(45, 9, 'Настроить пои', 'Настроить поиск на GipMar. Для этого ключевые слова (Keywords) из Карточки раздела каталога и Карточки товара учитываются с прямым вхождением запроса. Например раздел каталога называется \'ОГНЕСТОЙКИЕ СЕЙФЫ\' и мы указали ключевые слова \'Сейфы от огня\', \'Огнеупорные сейфы\', \'Сейфы для огня\'. И если пользователь задает запрос в поиске \'сейфы от огня\', то ему погазываются все товары из категории \'ОГНЕСТОЙКИЕ СЕЙФЫ\'.', 3, '-', 1, '2021-07-28 14:03:39', 0),
(46, 9, 'В карточке за', 'В карточке заказа поле прикрепленных файлов в блоке сообщений/почты должен быть на одном уровне с полем \'заполняется поставщиком http://joxi.ru/nAyWPj3IwPE0km  ', 2, '-', 1, '2021-07-28 14:03:39', 1),
(47, 9, 'Устранить баг', 'Устранить баг http://joxi.ru/a2X58PyF4B3wBA который иногда возникает при разворачивании каталога в следствии перехода из одной вкладки в другую (например перешли из \'списов заказов\' в \'настройка каталога\'. Приходится обновлять страницу чтобы баг пропал. Пробывал в разных браузерах, он возникает вне зависимости от браузера.', 3, '-', 1, '2021-07-28 14:03:39', 1),
(48, 9, 'Размер поля \'с', 'Размер поля \'список заказов\' у нас является эталонным и нужно такого же размера делать все поля (поле \'настройка каталога\' и прочие разделы). Нужно нижний край разворачивающегося кататалога сделать в один уровень с нижнем краем \'списка заказов\' ', 2, '-', 1, '2021-07-28 14:03:39', 1),
(49, 9, 'Плохо читаемы', 'Плохо читаемые значения \'посмотреть все\' и \'топ 10 продаж\'. http://joxi.ru/brR0XbOtOPDn82  Нужно поиграть с цветом шрифта, вот например: http://joxi.ru/eAOg3jaCkPgBQA , но только так, чтобы было в дизайн сайта.', 3, '-', 1, '2021-07-28 14:03:39', 1),
(50, 9, 'Вначале вложе', 'Вначале вложенности каталога первая вкладка должна быть \'Каталог\' http://joxi.ru/p27DqdeUN4k9DA чтобы можно было перейти в главный раздел каталога из вложенности', 3, '-', 1, '2021-07-28 14:03:39', 1),
(51, 9, 'При нажатии н', 'При нажатии на соответствующий уровень вложенности должны показываться все товары из этого уровня вложенности, а не раздел каталога http://joxi.ru/12MJa0KUkP9GOA При наведении курсора уровень вложенности должен выделяться зеленым цветом (в цвет дизайна сайта)  чтобы пользователю можно было вернуться на требуемый уровень не переходя во вкладку \'Каталог\' http://joxi.ru/5mdXbZpU8WgVgm', 3, '-', 1, '2021-07-28 14:03:39', 1),
(52, 9, 'Во вклвдке \'бр', 'Во вклвдке \'бреды\' поле \'Описание\' http://joxi.ru/n2Y6N47HePaQpA служит для отображения текста описания при просмотре бренда в развернутом каталоге http://joxi.ru/KAg1l39UKWDGVm ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(53, 9, 'Во вкладке \'бр', 'Во вкладке \'бренды\' поле \'прикрепить поле для описания\' http://joxi.ru/V2VzyVkCkPRXR2 служит для прикрепления большого фото (не логотипа) для описания бренда в развернутом каталоге http://joxi.ru/zANqRlZijPndL2', 3, '-', 1, '2021-07-28 14:03:39', 1),
(54, 9, 'Сделать пункт', 'Сделать пункт \'подобрать по бренду\'  http://joxi.ru/KAg1l39UKWqMym в 4-м уровне вложенности.', 3, '-', 1, '2021-07-28 14:03:39', 1),
(55, 9, 'Вставить лого', 'Вставить логотип Бренда перед названием http://joxi.ru/82QGnz3h9oM9Dr ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(56, 9, 'Отцентровать ', 'Отцентровать ярлыки при свернутом каталоге: http://joxi.ru/KAx6PERHKlgnym ', 2, '-', 1, '2021-07-28 14:03:39', 1),
(57, 9, 'Улучшить диза', 'Улучшить дизайнерское решение по островкам каталога добавив внизу отсечные полоски по цветам букв логотипа снизу как например здесь: http://joxi.ru/n2Y6N47HeP8vWA (ссылка сайта на котором нашел оформление островков:  ) А буквы сделать белыми на цветном фоне, будут смотреться так же как в разворачивающемся каталоге:  http://joxi.ru/Vm6DJWeUvlPLaA   ', 2, '-', 1, '2021-07-28 14:03:39', 1),
(58, 9, 'Последний раз', 'Последний раздел каталога не должен быть в футоре: http://joxi.ru/823D7QeU8Low4A ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(59, 9, 'Когда главных', 'Когда главных разделов много, то внизу должна появлятся стрелка как сейчас реализовано в 2-5 уровнях вложенности) чтобы можно было понять о наличии еще разделов и перекрутить колесиком мыши.', 0, '-', 1, '2021-07-28 14:03:39', 1),
(60, 9, 'Утранить баг. ', 'Утранить баг. При нажатии на вкладку \'разделы каталога\' появляются и исчезают два слова \'\'ЧУД\'.', 2, '-', 1, '2021-07-28 14:03:39', 1),
(61, 9, 'Устранить баг', 'Устранить баг. Когда двигаешь колесиком мыши список брендов, то двигается 2-я вложеность каталога. Друй 3,4 возможно тоже, надо проверить http://joxi.ru/Q2K8KMdUvlwQwA ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(62, 9, 'Кнопку \'добав', 'Кнопку \'добавить заказ\' сделать в одну лини. по вертикали со списком закзов http://joxi.ru/krDnVyeT4e6el2 ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(63, 9, 'Как вариант м', 'Как вариант можно сделать левый каталог с закреплением чтобы после клика на раздел выпадал следующий уровень и закреплялся. Тогда не будет отваливаться если курсор мыши выйдет из поля. Так например реализовано у ИКЕИ https://www.ikea.com/ru/ru/cat/nabory-mebeli-55036/ ', 2, '-', 1, '2021-07-28 14:03:39', 1),
(64, 9, 'При просмотре', 'При просмотре товара плиткой клиентом не должно быть пустой строки (строка где кнопка \'добавить заказ\' и вкладки). http://joxi.ru/ZrJ7LgWTnjk64m ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(65, 9, 'Уменьшить по ', 'Уменьшить по высоте подразделы каталога при просмотре плиткой и отцентровать текст по горизонтали. Сделай их по высоте как кнопка \'добавить заказ\' Иначе когда сного подразделов, то на небольших мониторах они занимаю много места. http://joxi.ru/Y2LNZGLHEjLgLr ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(66, 9, 'При просмотре', 'При просмотре плиткой сделать горизонтальные отступы по высоте такими же как вертикальные, они должны быть одинаковыми http://joxi.ru/82QGnz3h954NBr При этом ширину плитки товара можно немного уменьшить чтобы расстояние между ними немного увеличилось.', 3, '-', 1, '2021-07-28 14:03:39', 1),
(67, 9, 'Цвет закрашен', 'Цвет закрашенных звезд зделать тикими же как на шаблоне в пойнте http://joxi.ru/n2Y6N47Hev0BZA чтобы он перекликался либо  с цветом букв \'p\' и \'r\' в логотипе, либо с номереом телефона, то что будет лучьше смотреться. http://joxi.ru/J2bOpLETVKM1MA ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(68, 9, 'Когда уменьша', 'Когда уменьшаешь размер экрана или браузера плитка не должна уменьшаться по размеру при котором ее данные переносятся на следующие строки. А должно сократиться кол-во товара в строке (например вместо 6 должно быть 3) http://joxi.ru/5mdXbZpU8yJWLm ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(69, 9, 'Поправить зна', 'Поправить значек \'сравнение\' http://joxi.ru/bmoMP7QUyPl4WA ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(70, 9, 'При просмотре', 'При просмотре товара плиткой убираем описание товара и добавляем название бренда и артикул. Под фото получиться попорядку: бренд + артикул в одну строку, а под ними название товара. Артикул делаем шрифтом поменьше и серым цветом. Название товара прищимаем к правому краю. ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(71, 9, 'Края квардрат', 'Края квардрата плитки делаем округлыми и убираем границу http://joxi.ru/D2PMOpRUJV168A Тоесть деаем как в утвержденном шаблоне (слайд 1 пойнта)', 1, '-', 1, '2021-07-28 14:03:39', 1),
(72, 9, 'Список товаро', 'Список товаров при просмотре списком сделать наподобии как здесь https://www.holodilnik.ru/gas-stoves/gas_cookers/?tile=0#s добавив параметры товара в середиу. Элементы расположить так, чтобы небыло высоко и небыло пусто по ширине.', 2, '-', 1, '2021-07-28 14:03:39', 1),
(73, 9, 'При просмотре', 'При просмотре товара плиткой сделать чтобы звезда рейтинга и слово \'дн.\'  не переносилась на вторую стрчку, а оставалось на первой, там есть достаточно места чтобы небыло переноса. http://joxi.ru/Vrw5P0aF4PXDx2 ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(74, 9, 'Блок фотограф', 'Блок фотографии в карточке товара опустить ниже чтобы поле фото было одинаковое сверху и снизу. http://joxi.ru/KAx6PERHKP871m ', 2, '-', 1, '2021-07-28 14:03:39', 1),
(75, 9, 'Растащить сто', 'Растащить стоимости http://joxi.ru/p27DqdeUN1xeZA ', 2, '-', 1, '2021-07-28 14:03:39', 1),
(76, 9, 'Кнопку купить', 'Кнопку купить сделать квадратной со значьком корзины как в шоблоне при просмотре плиткой http://joxi.ru/v295MKeFpoYeK2 ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(77, 9, 'Сделать значе', 'Сделать значек серый значек лупы на фото товара чтобы было понятно что при клике можно увеличить фото. http://joxi.ru/DmB3okei4MxeM2 При клике фото увеличивается, а снизу показваются остальные фото со стрелочками прокрутки как напрммер здесь: https://www.techport.ru/katalog/products/vstraivaemaja-bytovaja-tehnika/stiralnye-mashiny/vstraivaemaja-stiralnaja-mashina-candy-cbwm ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(78, 9, 'Убрать пустое', 'Убрать пустое место http://joxi.ru/8AngPyDCyPRDjr ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(79, 9, 'При перемещен', 'При перемещении товара колесиком мыши верхние подразделы каталога должны оставаться а месте: http://joxi.ru/bmoMP7QUyzQwJA ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(80, 9, 'Поправить зна', 'Поправить значек сравнение 7http://joxi.ru/RmzdPlOTMPqW5A                                                                                                                                                                ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(81, 9, 'Полоса прокру', 'Полоса прокрутки http://joxi.ru/D2PMOpRUJVQqPA должна быть отцентрована как в шаблоне: http://joxi.ru/Q2K8KMdUvxnw0A ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(82, 9, 'Данные товара', 'Данные товара надо не центровать по середине целиком блоком чтобы не было пустых мест по побокам http://joxi.ru/D2PMOpRUJVQwYA \nНужно вернуть как было о этого и отцентровать содержимое карточки в поле: http://joxi.ru/p27DqdeUN1MxnA   ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(83, 9, 'Немного умень', 'Немного уменьшаем размер значка: http://joxi.ru/vAWQ7w1hO8ax5m', 3, '-', 1, '2021-07-28 14:03:39', 1),
(84, 9, 'Центруем по г', 'Центруем по горизонтали и ширине название товара: http://joxi.ru/MAj8PXVUkpEBOm', 2, '-', 1, '2021-07-28 14:03:39', 1),
(85, 9, 'Вместь сроков', 'Вместь сроков поставки указать кол-во раз которое купили товар (\'куплен 155 раз\'): http://joxi.ru/KAg1l39UKMjlvm ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(86, 9, 'Когда пользов', 'Когда пользователь переходит в корзину, то первым действием у него всплывает окно в котором он должен ввести номер телефона либо адрес электронной почты чтобы авторизироваться как сделано например у озона: https://www.ozon.ru/gocheckout/login?hideEmail=1 На телефон ему приходит смс с проверочным кодом, который он должен ввести в поле. оответственно к этому тел. номеру и почте автоматически формируется его карточка клиента. Если пользователь уже зарегистрирован на указанный тел. номер или почту, то соответственнно на него уже есть карточка клиента.', 2, '-', 1, '2021-07-28 14:03:39', 1),
(87, 9, 'Увеличить шри', 'Увеличить шрифт и зармеры квадратиков соответственно всех варианов выбора галочками: http://joxi.ru/DmBYGqkT4XkWxr ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(88, 9, 'Отцентровать ', 'Отцентровать по высоте название галочки по отношению к самой галочке: http://joxi.ru/EA4YOj5Tpd6Zxr ', 3, '-', 1, '2021-07-28 14:03:39', 1),
(89, 9, 'Увеличить отс', 'Увеличить отступы: http://joxi.ru/EA4YOj5Tpd6xxr ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(90, 9, 'Убрать все че', 'Убрать все черточки между блоками и сделать белые островки по варианту который ты мне показал, а также поработать над всеми отступами: http://joxi.ru/4Ak6Yaxikx7RN2 ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(91, 9, 'Перенести про', 'Перенести промокод, итоговое кол-во и итоговую цену в первый блок вниз: http://joxi.ru/vAW8xvwCOYo0qr ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(92, 9, 'Удалить и пер', 'Удалить и перенести блоки: http://joxi.ru/Q2KZ6GMcvz6dRm ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(93, 9, 'Сделать так, ч', 'Сделать так, чтобы в период сессии (и куки) при сворачивании каталога он не развочивался при переходе из зазделов в раздел (например если свернуть каталог в разделе товаров и перейти в заказы, то он снова разворачивается).', 1, '-', 1, '2021-07-28 14:03:39', 1),
(94, 9, 'Поправить опр', 'Поправить определение города. Например я нахожусь в Сочи, а определяет как г. Санкт-Петербкрг: http://joxi.ru/l2ZqyEDc76q6bm ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(95, 9, 'Раскидать инф', 'Раскидать информацию в карточке товара при просмотре чтобы было удобно просматривать, нечего не вылазило, не перескакивало: http://joxi.ru/Dr8YkjLTMV7o7m ', 1, '-', 1, '2021-07-28 14:03:39', 1),
(96, 9, 'При просмотре', 'При просмотре товара http://joxi.ru/J2bzGYLCV89GX2 должна быть вот эта строка: http://joxi.ru/YmE5jG7hMnRwgm ', 2, '-', 1, '2021-07-28 14:03:39', 1),
(97, 9, 'Кнопки каранд', 'Кнопки карандаша и сравнения http://joxi.ru/a2XNkEPi4x6Der должны быть прозрачными без черного цвета как у кнопки \'избранное\'. При добавлении товара в \'избранное\' и \' сравнение\' эти кнопки становятся цветными. Цвета как у логотипа.', 1, '-', 1, '2021-07-28 14:03:39', 1),
(98, 9, 'Допилить функ', 'Допилить функцию обьединения товаров в административной части Карточки товара: http://joxi.ru/Y2LaWBGsE3BEDA', 3, '-', 1, '2021-07-28 14:03:39', 1),
(99, 9, 'Убрать перено', 'Убрать перенос, сделав в одну строку: http://joxi.ru/Q2KZ6GMcvzBvBm ', 2, '-', 1, '2021-07-28 14:03:39', 1),
(100, 9, 'поправить пол', 'поправить полосу (с желтого на серый) http://joxi.ru/KAxkwNEUv45LP2', 2, '-', 1, '2021-07-28 14:03:39', 1),
(101, 9, 'добавить желт', 'добавить желтый заголовок в каталог', 1, '-', 1, '2021-07-28 14:03:39', 1),
(102, 9, 'сделать отсуп', 'сделать отсуп в редакторе товара http://joxi.ru/BA0YZNDTvBDKlr', 2, '-', 1, '2021-07-28 14:03:39', 1),
(103, 9, 'сделать с заг', 'сделать с заглавной http://joxi.ru/EA4YOj5TvDEGKr', 2, '-', 1, '2021-07-28 14:03:39', 1),
(104, 9, 'сделать отсуп', 'сделать отсуп поменьше http://joxi.ru/BA0YZNDTvBDzlr', 2, '-', 1, '2021-07-28 14:03:39', 1),
(105, 9, 'поправить вер', 'поправить вертикальные отсупы http://joxi.ru/n2YJ1v4i7jzO4A', 2, '-', 1, '2021-07-28 14:03:39', 1),
(106, 9, 'артикул под л', 'артикул под логотипом по центру http://joxi.ru/Vm6YXlWTRxpk8r', 2, '-', 1, '2021-07-28 14:03:39', 1),
(107, 9, 'убрать из кор', 'убрать из корзины http://joxi.ru/DrlWeRkHG4gOoA (также поправить смещение в колонках)', 2, '-', 1, '2021-07-28 14:03:39', 1),
(108, 9, 'убрать перено', 'убрать перенос полей http://joxi.ru/DrlWeRkHG4gjoA , также поправить поле для юр.лица', 2, '-', 1, '2021-07-28 14:03:39', 1),
(109, 9, 'поправить отс', 'поправить отсупы http://joxi.ru/l2ZqyEDcR8vQgm', 1, '-', 1, '2021-07-28 14:03:39', 1),
(110, 9, 'убрать кнопку', 'убрать кнопку чата с шапки', 1, '-', 1, '2021-07-28 14:03:39', 1),
(111, 9, 'добавить сбок', 'добавить сбоку кнопку чата', 1, '-', 1, '2021-07-28 14:03:39', 1),
(112, 9, 'доделать блок', 'доделать блок добавления \'Новый заказ\'', 1, '-', 1, '2021-07-28 14:03:39', 1),
(113, 9, 'Чат должен от', 'Чат должен открываться только когда пользователь вошел в свой аккаунт.', 1, '-', 1, '2021-07-28 14:03:39', 1),
(114, 9, 'Поехал столбе', 'Поехал столбец, иконки сообщений и почты должны быть четко по центру названия столбца: http://joxi.ru/DmB3okeigdg9R2', 1, '-', 1, '2021-07-28 14:03:39', 1),
(115, 9, 'При нажатии н', 'При нажатии на кнопку \'ВЫХОД\' не должно быть белое поле. Кнопка должна заменится на \'ВОЙТИ\' и пользователь должен выйти из аккаунта вернувшись на главную страницу.', 1, '-', 1, '2021-07-28 14:03:39', 1),
(116, 9, 'Крестик закры', 'Крестик закрытия чата ты поместил в верхний угол сдвинув вниз строку поиска вниз тем самым сократив кол-во видимых пользователей. Нужно сделать боле аккуратно немного увеличив серый крестик в размере, при этом крестик не должен иметь рамок, а справа от него разместить строку поиска. Будет выглядить  вот так схематично: http://joxi.ru/RmzdPlOTjXvZpA', 1, '-', 1, '2021-07-28 14:03:39', 1),
(117, 9, 'При наведении', 'При наведении на кнопку \'Чат 349\' курсор должен менятся не на \'I\' а на изображение руки как во всех других местах.', 1, '-', 1, '2021-07-28 14:03:39', 1),
(118, 9, 'Нужно устрани', 'Нужно устранить баг: http://joxi.ru/V2VzyVkC8EB652', 1, '-', 1, '2021-07-28 14:03:39', 1),
(119, 9, 'Корзина: http://jo', 'Корзина: http://joxi.ru/p27DqdeUn3ZKBA', 1, '-', 1, '2021-07-28 14:03:39', 1),
(120, 9, 'Сделать одина', 'Сделать одинаковые отступы: http://joxi.ru/L21D1YeUzGDgKm', 1, '-', 1, '2021-07-28 14:03:39', 1),
(121, 9, 'Поле должно б', 'Поле должно быть вровень с фильтром: http://joxi.ru/D2PMOpRUBjRv7A', 1, '-', 1, '2021-07-28 14:03:39', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `abuse`
--
ALTER TABLE `abuse`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `cooment_zad`
--
ALTER TABLE `cooment_zad`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_user_id` (`from_user_id`),
  ADD KEY `to_user_id` (`to_user_id`),
  ADD KEY `time` (`time`);

--
-- Индексы таблицы `messages_translate`
--
ALTER TABLE `messages_translate`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `message_id` (`message_id`,`language`);

--
-- Индексы таблицы `online`
--
ALTER TABLE `online`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `users_relations`
--
ALTER TABLE `users_relations`
  ADD PRIMARY KEY (`user_id`,`to_user_id`);

--
-- Индексы таблицы `zadach`
--
ALTER TABLE `zadach`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `abuse`
--
ALTER TABLE `abuse`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `account`
--
ALTER TABLE `account`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `cooment_zad`
--
ALTER TABLE `cooment_zad`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `messages_translate`
--
ALTER TABLE `messages_translate`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `online`
--
ALTER TABLE `online`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `zadach`
--
ALTER TABLE `zadach`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
