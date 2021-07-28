-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 11 2021 г., 10:00
-- Версия сервера: 10.3.9-MariaDB
-- Версия PHP: 5.6.38

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
(5, 'Баги/Исправления', '<i class=\"fas fa-bug dop_icon\"></i>', 1, 'bugs', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `read_time` int(11) NOT NULL DEFAULT 0,
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
  `time` timestamp NOT NULL DEFAULT current_timestamp()
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
(3, 1, '2021-07-09 10:37:10'),
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
(8, 3, 3, 'private_pr', 1, 0, '2021-07-08 08:58:29', '-');

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
(1, 1, 'test', 'test_opis', 1, 'test,p[s', 1, '2021-07-08 18:28:00', 2),
(2, 2, 'test_sr', 'opis', 2, 'test,ttt', 1, '2021-07-08 08:37:00', 1),
(3, 1, 'test_m', 'test', 2, '', 1, '2021-07-08 08:56:00', 1),
(4, 1, 'test_1', 'twestsadsd', 2, 'tet,sdgsdg,test,tewsstt', 1, '2021-07-09 08:57:00', 1),
(5, 1, 'test22', 'trtasd', 2, '', 1, '2021-07-09 10:56:00', 1),
(6, 1, 'test', 'tet', 1, 'tet,sdgsdg,test', 1, '2021-07-09 12:06:00', 1),
(7, 2, 'test_zad', 'tet', 1, 'tet,sdgsdg,test,tewsstt', 1, '2021-07-10 12:06:00', 1),
(8, 2, 'test_zad_test', 'teaasd', 3, 'test,p[s', 1, '2021-07-08 11:08:00', 1),
(10, 5, 'test1_zad_publick', 'test', 1, 'test', 3, '2021-07-08 08:52:00', 1),
(11, 5, 'public_zadach', 'test', 3, 'test', 3, '2021-07-10 08:59:00', 1),
(12, 8, 'ttttthhhg', 'test', 3, 'test', 3, '2021-07-09 08:59:00', 1);

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
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `zadach`
--
ALTER TABLE `zadach`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
