-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 15 2025 г., 23:50
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pharmacy-online`
--

-- --------------------------------------------------------

--
-- Структура таблицы `access_rights`
--

CREATE TABLE `access_rights` (
  `ID_Access_rights` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `access_rights`
--

INSERT INTO `access_rights` (`ID_Access_rights`, `Name`) VALUES
(1, 'ADMIN'),
(2, 'USER');

-- --------------------------------------------------------

--
-- Структура таблицы `job_position`
--

CREATE TABLE `job_position` (
  `ID_Job_position` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `job_position`
--

INSERT INTO `job_position` (`ID_Job_position`, `Name`) VALUES
(1, 'Администратор'),
(2, 'Фармацевт'),
(3, 'Курьер');

-- --------------------------------------------------------

--
-- Структура таблицы `medication`
--

CREATE TABLE `medication` (
  `ID_med` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `medication`
--

INSERT INTO `medication` (`ID_med`, `Name`, `Price`, `Description`, `Image`) VALUES
(1, 'Цитрамон', 70.00, 'Без рецепта', 'cit.png'),
(2, 'Активированный уголь', 35.00, 'Без рецепта', 'ugol.png'),
(3, 'Лоратадин', 150.00, 'Без рецепта', 'lor.png'),
(4, 'Но-Шпа', 180.00, 'Без рецепта', 'nosh.png'),
(5, 'Парацетамол', 50.00, 'Без рецепта', 'par.png'),
(6, 'Супрастин', 180.00, 'Без рецепта', 'sup.png'),
(7, 'Фенистил гель', 420.00, 'Без рецепта', 'fen.png'),
(8, 'Зиртек', 380.00, 'Без рецепта', 'zir.png'),
(9, 'Ибупрофен', 110.00, 'Без рецепта', 'ibuprofen.png'),
(10, 'Мезим Форте', 320.00, 'Без рецепта', 'mezim.png'),
(11, 'Омепразол', 90.00, 'Без рецепта', 'omeprazol.png'),
(12, 'Мирамистин', 210.00, 'Без рецепта', 'miramistin.png'),
(13, 'Лирика, 300МГ', 543.00, 'По рецепту', 'lir300.png'),
(14, 'Лирика, 150МГ', 287.00, 'По рецепту', 'lir150.png'),
(15, 'Лирика, 75МГ', 202.00, 'По рецепту', 'lir75.png'),
(16, 'Венлафаксин, 75МГ', 636.00, 'По рецепту', 'venla75.png'),
(17, 'Венлафаксин, 37.5МГ', 330.00, 'По рецепту', 'venla375.png'),
(18, 'Велаксин, 150МГ', 2262.00, 'По рецепту', 'velax.png'),
(19, 'Габапентин, 300МГ', 839.00, 'По рецепту', 'gaba.png'),
(20, 'Тералиджен Валента, 5МГ', 775.00, 'По рецепту', 'teralid.png'),
(21, 'Триган-Д, 20МГ', 157.00, 'По рецепту', 'trigan-d.png'),
(22, 'Феназепам, 1МГ', 377.00, 'По рецепту', 'fenaz.png'),
(23, 'Клоназепам, 20МГ', 154.00, 'По рецепту', 'clonez.png'),
(24, 'Фенибут, 270МГ', 250.00, 'По рецепту', 'fenebut.png'),
(25, 'Детравенол', 840.00, 'Без рецепта', 'detravenol.png'),
(32, 'Нурофен(Тест)', 200.00, 'Без рецепта', 'nurofen.png'),
(33, 'Кадуэт', 1400.00, 'По рецепту', 'kaduet.png');

-- --------------------------------------------------------

--
-- Структура таблицы `ordertable`
--

CREATE TABLE `ordertable` (
  `ID_Order` int(11) NOT NULL,
  `ID_Users` int(11) DEFAULT NULL,
  `ID_Personal` int(11) DEFAULT NULL,
  `ID_Shopping_cart` int(11) DEFAULT NULL,
  `Order_status` varchar(100) DEFAULT NULL,
  `Overriden_address` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal`
--

CREATE TABLE `personal` (
  `ID_Personal` int(11) NOT NULL,
  `ID_Job_position` int(11) DEFAULT NULL,
  `Full_name` varchar(100) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Birth_date` datetime DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `personal`
--

INSERT INTO `personal` (`ID_Personal`, `ID_Job_position`, `Full_name`, `Address`, `Birth_date`, `Phone`) VALUES
(1, 1, 'Сидоров Аркадий Ильич', 'Красноармейская улица, 4', '1991-08-24 13:40:00', '+7 904 813-09-74'),
(2, 2, 'Зайцев Кирилл Андреевич', 'Московская улица, 32', '1999-02-10 22:20:00', '+7 916 502-38-47'),
(3, 3, 'Рябина Анна Олеговна', 'Молодёжная улица, 2', '2004-01-28 12:00:00', '+7 952 779-15-06'),
(4, 3, 'Филимонов Алексей Юрьевич', 'Нагатинская улица, 13к1', '2005-09-01 10:00:03', '+7 903 145-92-30');

-- --------------------------------------------------------

--
-- Структура таблицы `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `ID_Shopping_cart` int(11) NOT NULL,
  `ID_Users` int(11) DEFAULT NULL,
  `ID_Medication` int(11) DEFAULT NULL,
  `Count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `shopping_cart`
--

INSERT INTO `shopping_cart` (`ID_Shopping_cart`, `ID_Users`, `ID_Medication`, `Count`) VALUES
(6, 1, 14, 1),
(7, 1, 13, 1),
(9, 1, 2, 1),
(15, 2, 1, 1),
(16, 2, 5, 1),
(17, 2, 32, 2),
(18, 2, 17, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `ID_Users` int(11) NOT NULL,
  `ID_Access_rights` int(11) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`ID_Users`, `ID_Access_rights`, `Phone`, `Password`) VALUES
(0, 1, '+7 965 756-15-55', 'Test1234'),
(1, 2, '+7 921 345-67-89', '14062025MSKlev'),
(2, 2, '+7 985 220-14-52', '1452Apteka'),
(3, 2, '+7 921 021-14-52', 'qwerty12345');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `access_rights`
--
ALTER TABLE `access_rights`
  ADD PRIMARY KEY (`ID_Access_rights`);

--
-- Индексы таблицы `job_position`
--
ALTER TABLE `job_position`
  ADD PRIMARY KEY (`ID_Job_position`);

--
-- Индексы таблицы `medication`
--
ALTER TABLE `medication`
  ADD PRIMARY KEY (`ID_med`);

--
-- Индексы таблицы `ordertable`
--
ALTER TABLE `ordertable`
  ADD PRIMARY KEY (`ID_Order`),
  ADD KEY `ID_Users` (`ID_Users`),
  ADD KEY `ID_Personal` (`ID_Personal`),
  ADD KEY `ID_Shopping_cart` (`ID_Shopping_cart`);

--
-- Индексы таблицы `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`ID_Personal`),
  ADD KEY `ID_Job_position` (`ID_Job_position`);

--
-- Индексы таблицы `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`ID_Shopping_cart`),
  ADD KEY `ID_Users` (`ID_Users`),
  ADD KEY `shopping_cart_ibfk_2` (`ID_Medication`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_Users`),
  ADD KEY `ID_Access_rights` (`ID_Access_rights`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `medication`
--
ALTER TABLE `medication`
  MODIFY `ID_med` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `ID_Shopping_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `ordertable`
--
ALTER TABLE `ordertable`
  ADD CONSTRAINT `ordertable_ibfk_1` FOREIGN KEY (`ID_Users`) REFERENCES `users` (`ID_Users`),
  ADD CONSTRAINT `ordertable_ibfk_2` FOREIGN KEY (`ID_Personal`) REFERENCES `personal` (`ID_Personal`),
  ADD CONSTRAINT `ordertable_ibfk_3` FOREIGN KEY (`ID_Shopping_cart`) REFERENCES `shopping_cart` (`ID_Shopping_cart`);

--
-- Ограничения внешнего ключа таблицы `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`ID_Job_position`) REFERENCES `job_position` (`ID_Job_position`);

--
-- Ограничения внешнего ключа таблицы `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_1` FOREIGN KEY (`ID_Users`) REFERENCES `users` (`ID_Users`),
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`ID_Medication`) REFERENCES `medication` (`ID_med`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`ID_Access_rights`) REFERENCES `access_rights` (`ID_Access_rights`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
