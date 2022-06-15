-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 15 2022 г., 03:14
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
  `year` int NOT NULL,
  `is_open` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `acceptance`
--

INSERT INTO `acceptance` (`id`, `year`, `is_open`) VALUES
(4, 2020, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `acceptance_class`
--

CREATE TABLE `acceptance_class` (
  `id` int NOT NULL,
  `acceptance_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `number_seats` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `acceptance_class`
--

INSERT INTO `acceptance_class` (`id`, `acceptance_id`, `name`, `description`, `number_seats`) VALUES
(6, 4, 'Программисты', 'Описание специальности - программисты', 75),
(7, 4, 'Монтажники', 'Описание специальности - монтажники', 25),
(8, 4, 'Системные администраторы', 'Описание специальности - администраторы', 25);

-- --------------------------------------------------------

--
-- Структура таблицы `file`
--

CREATE TABLE `file` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `file`
--

INSERT INTO `file` (`id`, `name`, `path`) VALUES
(1, 'jag.png', 'uploads/OHraPIQSpCl6iTaJtOL53EFy8CtpjKj0.png'),
(2, 'photo_2021-02-06_16-05-19.jpg', 'uploads/Ca5GSjafavaeee5Qvd1Cr8vC5hqWEV89.jpg'),
(3, 'myphoto (2).jpg', 'uploads/4qYlr2sI8PKr_T8zSAGrM5L7VMiB13hl.jpg'),
(4, 'pasp.jpg', 'uploads/hk5b8AYbZduNlsqX5APIkY6vxQBX9PfV.jpg'),
(5, 'ava3.png', 'uploads/ZhmgAQShHjdWGpoGxVfeSswAYO1c2lAx.png'),
(6, 'e9d1ea51c598a3d48f16e43707d9f974.jpg', 'uploads/bThsFbERT0R7VSek-PgcUsYq-HA20mQe.jpg'),
(7, 'horse_logo.jfif', 'uploads/W9QB3M_EbSCl7J30BI1L0gBogAuWGHUK.jfif'),
(8, '1637500046_3-papik-pro-p-pelmen-risunok-5.jpg', 'uploads/jP84iCDeVCRf-FF0CiNctYEAgObIKmTs.jpg'),
(9, 'e9d1ea51c598a3d48f16e43707d9f974.jpg', 'uploads/XUScfs1YVS173xti5eN8d4EMdPNoZVxK.jpg');

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
(1, 'user', 'simple user'),
(2, 'admin', 'administriruet vse');

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
  `access_token` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `class_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `role_id`, `email`, `public_status`, `phone`, `age`, `city`, `status_id`, `access_token`, `fio`, `password`, `class_id`) VALUES
(1, 2, 'admin@admin.admin', '-', '89110229765', 20, 'Санкт-Петербург', 1, 'j4ZT96C7UE8UhJuJsXeJ74KRM-G8fnMVQ3kzaV4S8NcJcmmYZu57IgQhbJyFMvkw', 'Корполевский Артем Кириллович', '$2y$13$gp0STN.a.wMarThBW06OhOkQo8l5O01KOreURl7IzzelE1h3Se7ku', NULL),
(2, 1, 'student@rtk.ru', '-', '89110229765', 12, 'Санкт-Петербург', 1, 'ph0yxwOE2Lm4Qr2MXnPEG7SR3JFZyJSKXxtRgRbweYjnV3GUSeVGsDK4ygH4hCt_', 'Студент Студентов Студентович', '$2y$13$GdQQtXq/k9rBR/hhrLReX.5WlSTs3zSza1s.u3tLI6brcuYZAZ9oe', 1),
(5, 1, 'student2@rtk.ru', '-', '89110229765', 18, 'Санкт-Петербург', 1, 'O3OarjrEMoKqJz5AggzRQrBYPS0pzDyUpdUPRLbhCuAd3KHr1ye7AE21LkVYXuga', 'Студент2 Студентов2 Студентович2', '$2y$13$QMAP9bN4CH6onagj7DTfJePHCl6Qf1i230fIzJ/HRLSxKReVVvKpC', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_acceptance_attachment`
--

CREATE TABLE `user_acceptance_attachment` (
  `user_request_id` int NOT NULL,
  `file_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_acceptance_attachment`
--

INSERT INTO `user_acceptance_attachment` (`user_request_id`, `file_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 4),
(2, 5),
(2, 6),
(3, 7),
(3, 8),
(3, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `user_acceptance_request`
--

CREATE TABLE `user_acceptance_request` (
  `id` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_original` tinyint(1) NOT NULL,
  `user_id` int NOT NULL,
  `atestat_mean` decimal(10,3) NOT NULL,
  `acceptance_class_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_acceptance_request`
--

INSERT INTO `user_acceptance_request` (`id`, `date`, `is_original`, `user_id`, `atestat_mean`, `acceptance_class_id`) VALUES
(1, '2022-06-14 22:18:36', 1, 2, '4.400', 6),
(2, '2022-06-14 22:22:02', 0, 5, '4.400', 6);

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
  ADD KEY `acceptance_id` (`acceptance_id`);

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
  ADD KEY `role_id` (`role_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Индексы таблицы `user_acceptance_request`
--
ALTER TABLE `user_acceptance_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `acceptance_class_id` (`acceptance_class_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `acceptance`
--
ALTER TABLE `acceptance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `acceptance_class`
--
ALTER TABLE `acceptance_class`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `file`
--
ALTER TABLE `file`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user_acceptance_request`
--
ALTER TABLE `user_acceptance_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `acceptance_class`
--
ALTER TABLE `acceptance_class`
  ADD CONSTRAINT `acceptance_class_ibfk_1` FOREIGN KEY (`acceptance_id`) REFERENCES `acceptance` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Ограничения внешнего ключа таблицы `user_acceptance_request`
--
ALTER TABLE `user_acceptance_request`
  ADD CONSTRAINT `user_acceptance_request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_acceptance_request_ibfk_2` FOREIGN KEY (`acceptance_class_id`) REFERENCES `acceptance_class` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
