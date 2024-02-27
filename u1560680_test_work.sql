-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 27 2024 г., 22:39
-- Версия сервера: 5.7.27-30
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `u1560680_test_work`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `answer_id_comment` int(11) DEFAULT '0',
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id_comment`, `answer_id_comment`, `text`) VALUES
(1, 0, 'Очень интересная статья'),
(2, 1, 'Нет, статья была написана кем-то, кто не разбирается'),
(3, 1, 'Статья написана первоклассником'),
(4, 3, 'Второклассником'),
(5, 0, 'Тестовый комменатрий из формы'),
(6, 5, 'Тестовый комменатрий из формы2'),
(7, 6, 'Тестовый комменатрий из формы3'),
(8, 7, 'Тестовый комменатрий из формы4'),
(9, 7, 'Тестовый комменатрий из формы5'),
(10, 7, 'Тестовый редактированный комменатрий из формы6'),
(11, 3, 'Статья написана первоклассником2'),
(12, 3, 'Статья написана первоклассником редактировался 3'),
(13, 3, 'Статья написана первоклассником4'),
(14, 3, 'Статья написана первоклассником5'),
(15, 3, 'Статья написана первоклассником6'),
(16, 3, 'Статья написана первоклассником7'),
(17, 3, 'Статья написана первоклассником8'),
(18, 3, 'Статья написана первоклассником9'),
(19, 3, 'Статья написана первоклассником10'),
(23, 1, 'Согласен с автором'),
(24, 5, 'Считаю неверно'),
(25, 24, '-+'),
(26, 24, 'Все бывает');

--
-- Триггеры `comments`
--
DELIMITER $$
CREATE TRIGGER `check_max_answers_before_insert` BEFORE INSERT ON `comments` FOR EACH ROW BEGIN
    DECLARE answer_count INT;
    
    SELECT COUNT(*) INTO answer_count
    FROM comments
    WHERE answer_id_comment = NEW.answer_id_comment;
    
    IF answer_count >= 10 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'На этот комментарий слишком много ответов.';
    END IF;
END
$$
DELIMITER ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
