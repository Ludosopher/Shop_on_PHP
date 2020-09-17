-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 20 2020 г., 17:52
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL,
  `text` varchar(500) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `author`, `text`, `id_product`, `date`) VALUES
(1, 'Пётр', 'Отличный товар!', 1, '0000-00-00 00:00:00'),
(4, 'Василий', 'Хорошо', 1, '2020-04-06 17:46:00'),
(5, 'Нина', 'олдолдолд', 1, '2020-04-06 18:22:00'),
(6, 'Гена', 'сммитьить', 5, '2020-04-06 18:23:00'),
(7, 'Венера', 'Отличное платье для лета!', 5, '2020-04-06 19:14:00'),
(8, 'Катерина', 'Не очень!', 5, '2020-04-06 19:24:00'),
(9, 'Дана', 'Хороший подарок! Но не долговечная вещь.', 2, '2020-04-06 19:45:00'),
(10, 'Элла', 'Круть!', 0, '2020-04-08 15:49:00'),
(14, 'Динара', 'Я не куплю такое', 4, '2020-04-08 16:13:00'),
(15, 'Пётр', 'Хочу ,хочу, хочу', 3, '2020-04-08 16:21:00'),
(16, 'Колик', 'У моего брата такая ему нравится', 3, '2020-04-08 16:32:00'),
(17, 'Валентин', 'Купил жене. довольна.', 5, '2020-04-10 11:53:00'),
(18, 'Горан', 'Good!', 11, '2020-04-16 10:08:00'),
(19, 'Эдуард', 'Скучная, какая-то', 3, '2020-05-16 16:16:00'),
(20, 'Chery', 'Борода и хвостик :) гы, гы', 3, '2020-05-16 16:23:00'),
(21, 'Василий', 'Жидковатая', 3, '2020-05-16 17:06:00'),
(22, 'Вера', 'Красивая, выглядит свежо', 2, '2020-05-16 17:46:00'),
(23, 'Лианна21', 'Старомодная', 2, '2020-05-16 17:47:00'),
(24, 'Порки-U', 'Пойдёт для рабочего класса', 3, '2020-05-16 18:45:00'),
(25, 'Степан', 'Чё там написано', 1, '2020-05-18 11:39:00'),
(26, 'Лёха', 'Морской клуб какое то побережье', 1, '2020-05-18 11:40:00'),
(27, 'Соня', 'Напоминает тюремную робу :)', 5, '2020-05-18 11:52:00'),
(28, 'Ромул7', 'Рюкзак бы взял', 3, '2020-05-18 12:04:00'),
(29, 'Сеня', 'Пререливается. Это мне нравится.', 3, '2020-05-18 12:05:00'),
(30, 'Галина+++', 'Создаёт хорошее настроение', 2, '2020-05-18 12:11:00'),
(31, 'Вовчик', 'Красивая', 2, '2020-05-18 12:14:00'),
(32, 'Сисилия', 'Замечательное', 5, '2020-05-18 12:16:00'),
(33, 'Эдуард', 'Жизнь это полоса чёрная, потом полоса белая', 5, '2020-05-18 13:05:00'),
(34, 'Василий', 'Точно! Символическое платьеце', 5, '2020-05-18 13:06:00'),
(35, 'Зулейха', 'Не понравилось.', 5, '2020-05-18 13:19:00');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `width` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` int(11) NOT NULL,
  `views` int(200) DEFAULT NULL COMMENT 'Число просмотров'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `file_name`, `width`, `product_name`, `price`, `views`) VALUES
(1, 'Card-1.jpg', 252, 'T-shirt', 400, 87),
(2, 'Card-2.jpg', 252, 'Pink sleeveless blouse', 1000, 96),
(3, 'Card-3.jpg', 252, 'Jacket bolognese blue', 1200, 87),
(4, 'Card-4.jpg', 252, 'Flower dress', 1020, 83),
(5, 'Card-5.jpg', 252, 'Sleeveless blouse with black and white stripes', 900, 82);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(180) NOT NULL,
  `user_id` int(180) NOT NULL,
  `adress` varchar(300) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `adress`, `date`, `status`) VALUES
(17, 7, '234536, г. Москва, ул. Петрова, д. 12, кв. 9.', '2020-04-13 19:43:00', 'Сборка'),
(18, 9, '123498, г. Самара, ул. Коммунаров, д. 33.', '2020-04-13 19:48:00', 'Сборка'),
(21, 9, '123498, г. Самара, ул. Коммунаров, д. 33.', '2020-04-13 21:30:00', 'Сборка'),
(23, 7, '234536, г. Москва, ул. Петрова, д. 12, кв. 9.', '2020-04-13 21:45:00', 'Сборка'),
(24, 11, '342178, Орловская обл., г. Ливны, ул. Менделя, д. 22, кв. 9.', '2020-04-16 10:13:00', 'Предварительная обработка'),
(61, 22, '222222, г. Хабаровск, ул. Стеклянная, д. 2, кв. 2.', '2020-05-14 20:54:00', 'Предварительная обработка'),
(62, 27, '123456, г. Москва, ул. Панфиловцев, д. 45, кв. 10.', '2020-05-19 11:15:00', 'Предварительная обработка'),
(63, 26, '123498, г. Самара, ул. Коммунаров, д. 33.', '2020-05-19 11:54:00', 'Предварительная обработка'),
(64, 22, '222222, г. Хабаровск, ул. Стеклянная, д. 2, кв. 2.', '2020-05-19 11:59:00', 'Предварительная обработка'),
(65, 22, '123456, г. Москва, ул. Панфиловцев, д. 45, кв. 10.', '2020-05-19 12:03:00', 'Предварительная обработка'),
(66, 22, '222222, г. Хабаровск, ул. Стеклянная, д. 2, кв. 2.', '2020-05-19 12:11:00', 'Предварительная обработка'),
(67, 27, '123498, г. Самара, ул. Коммунаров, д. 33.', '2020-05-19 12:28:00', 'Предварительная обработка'),
(68, 22, '342178, Орловская обл., г. Ливны, ул. Менделя, д. 22, кв. 9.', '2020-05-19 12:31:00', 'Сборка'),
(69, 27, '234536, г. Москва, ул. Петрова, д. 12, кв. 9.', '2020-05-19 12:34:00', 'Ожидание оплаты'),
(70, 27, '222222, г. Хабаровск, ул. Стеклянная, д. 2, кв. 2.', '2020-05-19 12:35:00', 'Ожидание оплаты'),
(71, 27, '342178, Орловская обл., г. Ливны, ул. Менделя, д. 22, кв. 9.', '2020-05-19 12:36:00', 'Ожидание оплаты'),
(72, 22, '123498, г. Самара, ул. Коммунаров, д. 33.', '2020-05-20 16:53:00', 'Ожидание оплаты');

-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `good_id` int(20) NOT NULL,
  `count` int(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `good_id`, `count`, `price`) VALUES
(1, 17, 5, 1, 900),
(2, 17, 4, 2, 1020),
(3, 18, 3, 2, 1200),
(4, 18, 1, 2, 400),
(5, 21, 5, 2, 900),
(6, 21, 4, 1, 1020),
(7, 21, 1, 1, 400),
(8, 23, 1, 1, 400),
(9, 23, 3, 1, 1200),
(10, 23, 2, 3, 1000),
(11, 24, 11, 2, 700),
(12, 24, 4, 1, 1020),
(16, 61, 5, 2, 900),
(17, 61, 2, 1, 1000),
(18, 62, 3, 1, 1200),
(19, 63, 1, 1, 400),
(20, 64, 4, 2, 1020),
(21, 65, 2, 2, 1000),
(22, 66, 4, 1, 1020),
(23, 67, 1, 1, 400),
(24, 68, 1, 1, 400),
(25, 70, 1, 1, 400),
(26, 70, 5, 1, 900),
(27, 71, 3, 1, 1200),
(28, 71, 1, 1, 400),
(29, 72, 1, 2, 400),
(30, 72, 2, 1, 1000);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `is_admin` varchar(10) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `is_admin`, `name`, `login`, `password`, `date`) VALUES
(7, NULL, 'Валентин', 'Valik', '$2y$10$RMK4Q0NW8ew13VofN7f88ue62ox9XlIVukRobVM/P3sWxPKQ6FMCe', '1966-04-26 00:00:00'),
(9, NULL, 'Юлий', 'Yulik', '$2y$10$bywuG6Xs9zNWIrsUvcMbEuOHbxsS2xR9XZojI2GaEr20jrOjLG0Cu', '1999-07-23 00:00:00'),
(10, 'admin', 'Viktor Alikin', 'admin', '$2y$10$TOzEdE.9JbWx/G1PfgiueO94iGYGJcYjKxVb9N/HPQCZi8rMU7aSW', '2020-04-16 00:00:00'),
(22, NULL, 'Леонид', 'Leonid', '$2y$10$Pxc0i16DyxHkRty51roBu.oRubtPtMx9Yv6CbJ230SIscid1iFu0.', '1950-03-08 00:00:00'),
(23, NULL, 'Елена', 'Elena', '$2y$10$i64eUboSDQsIxboaTJkPHO3yGEDDDqSdM5mzfivKeNKVDPbPCXBWi', '1991-10-24 00:00:00'),
(24, NULL, 'Семён', 'Semeon', '$2y$10$2yZiuOdNegVrBtQ8Aubfjeh0PGDPfbHn1EUVAseBm0h5WNg6WxQCu', '1999-04-14 00:00:00'),
(27, NULL, 'Николай Басков', 'Buskov', '$2y$10$3LAkKS4EOkSqSZAeWdTql.FDrpdTTELgmrriFVwZLlQtLOQV5YvFO', '1993-02-20 00:00:00'),
(37, NULL, 'Софокл', 'Sofokl', '$2y$10$0JC8Kw9Pb88eYXcfXiTMHeL3EMKItoT8ag3cdlIe9W9Xfzw5X5J9O', '1845-07-17 00:00:00'),
(38, NULL, 'Элеонора', 'Ely', '$2y$10$TPJgO3bDuCQv16II7qVN7.hZTe2U9FxNHy.qEYHGwwrVKnl0CyzlK', '2020-05-15 00:00:00'),
(39, NULL, 'Бенджамин', 'Bendgy', '$2y$10$K.KXjJIxIzepHje9faHGVuIiZhSr9MPp.XqscJel8Rp.QtSiyycXy', '2020-05-06 00:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(180) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
