-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 12 2024 г., 07:29
-- Версия сервера: 5.7.39-log
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `z576`
--

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `favorites`
--

INSERT INTO `favorites` (`id`, `product_id`, `user_id`, `created_at`) VALUES
(11, 26, 17, '2024-05-26 13:43:00'),
(17, 9, 17, '2024-05-27 16:25:52'),
(18, 1, 17, '2024-05-28 10:55:35');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `total` int(11) NOT NULL,
  `address` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status_id`, `created_at`, `total`, `address`) VALUES
(14, 17, 3, '2024-05-26 13:54:19', 5798, 'Адана'),
(15, 17, 3, '2024-05-26 13:59:00', 19395, 'Almaty'),
(16, 17, 4, '2024-05-27 07:05:58', 9399, 'Fargʻona'),
(17, 17, 5, '2024-05-28 11:08:54', 5298, 'Республика Татарстан, Казань, улица Бари Галеева, 3'),
(18, 17, 1, '2024-06-03 20:57:59', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `order_products`
--

CREATE TABLE `order_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `order_products`
--

INSERT INTO `order_products` (`id`, `product_id`, `order_id`) VALUES
(173, 1, 17),
(112, 4, 15),
(113, 4, 15),
(114, 4, 15),
(111, 8, 14),
(110, 9, 14),
(171, 9, 17),
(172, 9, 17),
(115, 25, 15),
(116, 25, 15),
(119, 27, 16);

-- --------------------------------------------------------

--
-- Структура таблицы `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `color`) VALUES
(1, 'В корзине', ''),
(2, 'Отклонён', '#FF5959'),
(3, 'В ожидании', '#FF9900'),
(4, 'В сборке', '#003BAE'),
(5, 'В пути', '#7000FF'),
(6, 'Ожидает получения', '#4B4B4B'),
(7, 'Получен', '#469421');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Photo` varchar(250) DEFAULT NULL,
  `Price` int(11) NOT NULL,
  `Description` varchar(2000) NOT NULL,
  `IdProduct` int(11) NOT NULL,
  `color_id` int(11) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`Id`, `Name`, `Photo`, `Price`, `Description`, `IdProduct`, `color_id`, `material_id`, `size_id`) VALUES
(1, 'Платье вечернее нарядное больших размеров', '6654340c03f3f.jpg', 3700, 'Шикарное платье с открытым плечом станет Вашим любимым! На это праздничное платье при пошиве использовано ткани более четырех метров. Юбка двойное солнце создает к низу красивый клеш , ассиметричный крой низа юбки - новый тренд этого сезона! \r\nКарманы в швах создают дополнительное удобство, можно положить ключи или телефон, для работы это очень важно. Рукава фонарики создают красивый образ в стиле бохо. У этого классического платья крой верха мышка подойдет на любую грудь. \r\nВ талию мы вшили широкую резинку на кулиске, она плотно прилегает. Резинка плотно прилегает и немного утягивает талию и зрительно худит, за счет этого нарядное платье подойдет как для высоких так и для не высоких женщин.', 6, 3, 1, 5),
(2, 'Платье праздничное весеннее', '66501b954536c.webp', 3600, 'Стильное праздничное платье макси свободного силуэта с акцентными рукавами, создано для женщин с выразительной талией! Красивое платье в пол с простым кроем лифа с длинным рукавом ¾ и открытыми плечами с вырезом. Разноуровневая шикарная свободная юбка на запах с высоким соблазнительным разрезом ноги, визуально удлиняет и вытягивает силуэт. Платье вечернее длинное без застёжки, легко надевать и снимать. ', 6, NULL, NULL, NULL),
(3, 'Свитер оверсайз вязаный теплый', '66501c525bd6e.jpg', 2999, 'Устройте зиму в своем гардеробе с теплым вязаным свитером от бренда L.JAS! Этот женский теплый свитер станет отличным выбором в холодные дни. Он выполнен из качественных турецких материалов, благодаря чему не боится стирок и обеспечивает комфорт и приятное ощущение на теле. Сочетание белого цвета и вязаного черного узора создает неповторимый и стильный образ.', 3, NULL, NULL, NULL),
(4, 'Свитер оверсайз однотонный вязаный', '66501c91c3577.jpg', 1799, 'Устройте зиму в своем гардеробе с теплым вязаным свитером от бренда L.JAS! Этот женский свитер оверсайз станет отличным выбором в холодные дни. Он выполнен из качественных турецких материалов, благодаря чему не боится стирок и обеспечивает комфорт и приятное ощущение на теле.', 3, NULL, NULL, NULL),
(8, 'Пиджак оверсайз удлиненный', '66501dbdad1b2.jpg', 4999, 'Базовый пиджак - незаменимая вещь в гардеробе любительниц разного стиля, классического и кэжуал - подчеркнет элегантность и женственность девушек. Свободный жакет идеален для повседневной носки, отлично дополнит офисный стиль. \r\nКлассический пиджак будет легко сочетается с любой одеждой из вашего гардероба.', 7, 1, NULL, NULL),
(9, 'Рубашка офисная приталенная для офиса', '66501e237ab39.jpg', 799, 'Наши рубашки созданы специально для ежедневного использования на работе или учебе. Приталенный силуэт придает рубашкам классический базовый стиль, который всегда в моде. Блузки уже несколько лет покупают по всей России и странам СНГ. Их качество подтверждается высоким рейтингом нашего магазина и многочисленными отзывами благодарных клиентов.', 4, NULL, NULL, NULL),
(10, 'Куртка женская демисезонная ', '66501ebad27b2.jpg', 8999, 'Эта стильная курточка выполнена в классическом стиле и подходит для осени и весны. Еврозима. Модель непродуваемая, удлиненная, для молодежи. Она также доступна в больших размерах, подходящих для девушек, женщин и подростков. Уеплитель делает ее теплой даже в холодную погоду. Выполнена из непромокаемой и ветрозащитной ткани, идеальна для осенних прогулок. Она также легкая и комфортная.', 2, NULL, NULL, 3),
(23, 'Куртка женская демисезонная ', '66501ef7348f1.jpeg', 6999, 'Эта стильная курточка станет для Вас открытием этого сезона! Легкая и теплая, она идеально подойдет для прогулок в прохладные весенние и осенние дни. Благодаря своему укороченному силуэту, она подчеркивает женскую фигуру и добвляет нотку элегантности девушки к любому образу. Демисезонная куртка имеет удобный прямой крой, который дарит максимум свободы движения.', 2, NULL, NULL, NULL),
(25, 'Сумка через плечо средняя', '6650206723ad9.jpg', 6999, 'Вы ищете удобную и стильную сумку премиум класса? Обратите внимание на классическую женскую летнюю сумочку от бренда FLY MILLON. Она выполненна из качественной экокожи под натуральную! Это универсальный аксессуар, который с легкостью впишется в ваш гардероб. Функциональная, красивая и при этом практичная даже при повседневном ношении, о такой сумке мечтает каждая женщина. Эта элегантная сумочка -', 5, NULL, NULL, NULL),
(26, 'Кожаные ботинки берцы демисезонные на высокой подошве', '665032eb383ea.jpg', 3999, 'Внимание! модель маломерит на 1 размер! Стильные черные женские ботинки – базовый элемент гардероба для подростков и взрослых женщин на осень, а также на демисезон, межсезонье и весну. Мягкая подкладка и съемная стелька из байки утеплит ноги в осенние холода. Непромокаемый водонепроницаемый верх из кожи защитит от влаги в демисезонный и весенний период. Толстая тракторная подошва PVC (ПВХ) обеспечит максимальный комфорт и не позволит обуви скользить.', 1, NULL, NULL, NULL),
(27, 'Полусапожки демисезонные. Ботильоны', '6654519047d9f.png', 1999, 'Модные ботильоны женские демисезонные Arseko из мягкой натуральной замши представлены для женщин и девушек в большом цветовом ассортименте. Незаменимая обувь для такого времени года как осень, весна. Такая обувь выглядит очень красиво и обеспечивает непревзойденный комфорт при носке.', 1, NULL, NULL, NULL),
(33, 'Рубашка Серая', '66544f2739f9a.png', 4980, 'Серая рубашка', 4, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `producttype`
--

CREATE TABLE `producttype` (
  `Id` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `producttype`
--

INSERT INTO `producttype` (`Id`, `Name`) VALUES
(1, 'Обувь'),
(2, 'Куртка'),
(3, 'Свитер'),
(4, 'Рубашка'),
(5, 'Сумка'),
(6, 'Платье'),
(7, 'Пиджак');

-- --------------------------------------------------------

--
-- Структура таблицы `product_colors`
--

CREATE TABLE `product_colors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `product_colors`
--

INSERT INTO `product_colors` (`id`, `name`) VALUES
(1, 'Чёрный'),
(2, 'Белый'),
(3, 'Красный'),
(4, 'Бежевый');

-- --------------------------------------------------------

--
-- Структура таблицы `product_materials`
--

CREATE TABLE `product_materials` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `product_materials`
--

INSERT INTO `product_materials` (`id`, `name`) VALUES
(1, 'Кожа'),
(2, 'Иск. кожа'),
(3, 'Текстиль'),
(4, 'Шёлк'),
(5, 'Хлопок');

-- --------------------------------------------------------

--
-- Структура таблицы `product_sizes`
--

CREATE TABLE `product_sizes` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `product_sizes`
--

INSERT INTO `product_sizes` (`id`, `name`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL');

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `Id` int(11) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `isAccepted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`Id`, `Email`, `isAccepted`) VALUES
(1, 'reilly_whitley69@hotmail.com', 1),
(2, 'marcia_jenkins67@outlook.com', 1),
(3, 'jacobs-albert70@mail.com', 1),
(4, 'colten-gray43@mail.com', 1),
(5, 'sparks-cyril88@hotmail.com', 1),
(6, 'bunch-maleah55@hotmail.com', 1),
(7, 'frank-ball27@mail.com', 1),
(8, 'india-rowland18@aol.com', 0),
(9, 'carrillo-zane94@aol.com', 1),
(10, 'lucian-houston8@aol.com', 0),
(11, 'elmore-wills70@aol.com', 1),
(12, 'tetetetete@mail.ru', 1),
(13, '', 1),
(14, '324324@34234.234', 1),
(15, 'user@mail.ru', 1),
(16, 'test@test.test', 1),
(17, '', 1),
(18, 'ximik.tut@mail.ru', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `Id` int(11) NOT NULL,
  `Name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`Id`, `Name`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `Photo` varchar(250) DEFAULT NULL,
  `Login` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `IdRole` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`Id`, `Photo`, `Login`, `Email`, `Password`, `IdRole`) VALUES
(16, '66544f00b6696.png', 'www', 'www@www.www', '$2y$12$/6pInFNgkJy.VVyX8CrXOuonBCQAb8SBZlbr6UGQDCyEZzLd40atS', 2),
(17, '66533bfd0dc65.jpg', 'qwe', 'qwe@qwe.qwe', '$2y$12$roLxFzT6lmh/DJDayxwUUekUZv2.jOWflnSR/x7obhP2ZoPb/E99e', 1),
(18, NULL, 'admin', 'admin@mail.com', '$2y$12$3q.4veNX8XrX1ju0GF6r.ub48HTKBi45llN2bP1xVyAJFFYhwQFn2', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`status_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Индексы таблицы `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`,`order_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Индексы таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdProduct` (`IdProduct`),
  ADD KEY `color_id` (`color_id`),
  ADD KEY `material_id` (`material_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Индексы таблицы `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `product_colors`
--
ALTER TABLE `product_colors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_materials`
--
ALTER TABLE `product_materials`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`Id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdRole` (`IdRole`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT для таблицы `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `producttype`
--
ALTER TABLE `producttype`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `product_colors`
--
ALTER TABLE `product_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `product_materials`
--
ALTER TABLE `product_materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `order_statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`IdProduct`) REFERENCES `producttype` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `product_colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`material_id`) REFERENCES `product_materials` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_4` FOREIGN KEY (`size_id`) REFERENCES `product_sizes` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`IdRole`) REFERENCES `role` (`Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
