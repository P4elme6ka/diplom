-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 06 2022 г., 12:48
-- Версия сервера: 8.0.29
-- Версия PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diplom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `acceptance`
--

CREATE TABLE `acceptance` (
  `id` int NOT NULL,
  `year` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `acceptance`
--

INSERT INTO `acceptance` (`id`, `year`) VALUES
(1, 2020);

-- --------------------------------------------------------

--
-- Структура таблицы `acceptance_class`
--

CREATE TABLE `acceptance_class` (
  `id` int NOT NULL,
  `class_id` int NOT NULL,
  `acceptance_id` int NOT NULL,
  `document_set_id` int DEFAULT NULL,
  `acceptance_start` timestamp NOT NULL,
  `acceptance_stop` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `acceptance_class`
--

INSERT INTO `acceptance_class` (`id`, `class_id`, `acceptance_id`, `document_set_id`, `acceptance_start`, `acceptance_stop`) VALUES
(1, 4, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 5, 1, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `class_group`
--

CREATE TABLE `class_group` (
  `id` int NOT NULL,
  `name` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `class_group`
--

INSERT INTO `class_group` (`id`, `name`) VALUES
(1, 486),
(4, 486),
(5, 123);

-- --------------------------------------------------------

--
-- Структура таблицы `document_preset`
--

CREATE TABLE `document_preset` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `file_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `document_set`
--

CREATE TABLE `document_set` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `document_set_to_preset`
--

CREATE TABLE `document_set_to_preset` (
  `document_preset_id` int NOT NULL,
  `document_set_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `file`
--

CREATE TABLE `file` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'user', 'simple user');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'default');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `role_id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `public_status` text NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status_id` int NOT NULL,
  `acceptance_id` int DEFAULT NULL,
  `access_token` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `role_id`, `email`, `public_status`, `phone`, `age`, `city`, `status_id`, `acceptance_id`, `access_token`, `fio`, `password`) VALUES
(1, 1, '006gta1@gmail.com', '-', '89110229765', 20, 'Санкт-Петербург', 1, 1, 'j4ZT96C7UE8UhJuJsXeJ74KRM-G8fnMVQ3kzaV4S8NcJcmmYZu57IgQhbJyFMvkw', 'Корполевский Артем Кириллович', '$2y$13$gp0STN.a.wMarThBW06OhOkQo8l5O01KOreURl7IzzelE1h3Se7ku');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `acceptance`
--
ALTER TABLE `acceptance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `acceptance_class`
--
ALTER TABLE `acceptance_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `acceptance_id` (`acceptance_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `document_set_id` (`document_set_id`);

--
-- Индексы таблицы `class_group`
--
ALTER TABLE `class_group`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `document_preset`
--
ALTER TABLE `document_preset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`);

--
-- Индексы таблицы `document_set`
--
ALTER TABLE `document_set`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `document_set_to_preset`
--
ALTER TABLE `document_set_to_preset`
  ADD KEY `document_set_to_preset_ibfk_1` (`document_preset_id`),
  ADD KEY `document_set_id` (`document_set_id`);

--
-- Индексы таблицы `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `acceptance_id` (`acceptance_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `acceptance`
--
ALTER TABLE `acceptance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `acceptance_class`
--
ALTER TABLE `acceptance_class`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `class_group`
--
ALTER TABLE `class_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `document_preset`
--
ALTER TABLE `document_preset`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `document_set`
--
ALTER TABLE `document_set`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `file`
--
ALTER TABLE `file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `acceptance_class`
--
ALTER TABLE `acceptance_class`
  ADD CONSTRAINT `acceptance_class_ibfk_1` FOREIGN KEY (`acceptance_id`) REFERENCES `acceptance` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `acceptance_class_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class_group` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `acceptance_class_ibfk_3` FOREIGN KEY (`document_set_id`) REFERENCES `document_set` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `document_preset`
--
ALTER TABLE `document_preset`
  ADD CONSTRAINT `document_preset_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `document_set_to_preset`
--
ALTER TABLE `document_set_to_preset`
  ADD CONSTRAINT `document_set_to_preset_ibfk_1` FOREIGN KEY (`document_preset_id`) REFERENCES `document_preset` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `document_set_to_preset_ibfk_2` FOREIGN KEY (`document_set_id`) REFERENCES `document_set` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`acceptance_id`) REFERENCES `acceptance` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
