-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 04 2025 г., 13:45
-- Версия сервера: 10.3.39-MariaDB-log-cll-lve
-- Версия PHP: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `agridigital_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_ip` varchar(255) DEFAULT NULL,
  `text_answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `option_id`, `user_ip`, `text_answer`, `created_at`, `updated_at`) VALUES
(3, 2, 4, '46.20.206.227', NULL, '2025-11-27 05:08:41', '2025-11-27 05:08:41'),
(4, 2, 5, '62.89.208.192', NULL, '2025-11-28 06:42:23', '2025-11-28 06:42:23');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `position` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title_ru`, `title_en`, `title_tj`, `category_slug`, `status`, `position`, `created_at`, `updated_at`) VALUES
(1, 'Новости', 'News', 'Ахбор', 'news', 1, 1, '2025-11-01 06:08:35', '2025-11-01 09:53:22');

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message_ru` text DEFAULT NULL,
  `message_tj` text DEFAULT NULL,
  `message_en` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `title_ru`, `title_tj`, `title_en`, `email`, `phone`, `message_ru`, `message_tj`, `message_en`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Fira', 'Обращение от Fira', 'Муроҷиат аз Fira', 'Message from Fira', 'user@user.com', '+992976785858', 'фывыфв', NULL, NULL, 1, '2025-12-01 06:26:33', '2025-12-01 06:26:33');

-- --------------------------------------------------------

--
-- Структура таблицы `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `description_tj` text DEFAULT NULL,
  `description_ru` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL COMMENT 'путь к загруженному файлу',
  `file_type` varchar(255) DEFAULT 'pdf' COMMENT 'pdf, docx, xlsx и т.д.',
  `published_at` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `documents`
--

INSERT INTO `documents` (`id`, `title_tj`, `title_ru`, `title_en`, `description_tj`, `description_ru`, `description_en`, `file_path`, `file_type`, `published_at`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Title TJ1', 'Title RU1', 'Title EN1', 'tj1', 'ru1', 'en1', 'upload/documents/20251201_144947_06122024.xlsx', 'xlsx', '2025-10-31', 1, '2025-11-11 04:22:55', '2025-12-01 09:49:47'),
(2, 'Қонуни Ҷумҳурии Тоҷикистон «Дар бораи таълими касбии миёна»', 'Закон РТ \"О среднем профессиональном образовании\"', 'Law of the Republic of Tajikistan ‘On Secondary Vocational Education’', 'Қонуни Ҷумҳурии Тоҷикистон «Дар бораи таълими касбии миёна»', 'Закон РТ \"О среднем профессиональном образовании\"', 'Law of the Republic of Tajikistan ‘On Secondary Vocational Education’', 'upload/documents/20251201_135853_17099101.12.2025_13_58_02.pdf', 'pdf', '2025-11-30', 1, '2025-12-01 08:58:53', '2025-12-01 08:58:53'),
(3, 'Қонуни Ҷумҳурии Тоҷикистон «Дар бораи захираҳои давлатии мавод»', 'Закон РТ «О государственном материальном резерве»', 'Law of the Republic of Tajikistan ‘On State Material Reserves’', 'Қонуни Ҷумҳурии Тоҷикистон «Дар бораи захираҳои давлатии мавод»', 'Закон РТ «О государственном материальном резерве»', 'Law of the Republic of Tajikistan ‘On State Material Reserves’', 'upload/documents/20251201_143737_On_State_Material_Reserves.pdf', 'pdf', '2025-12-01', 1, '2025-12-01 09:37:37', '2025-12-01 09:37:37'),
(4, 'Қонуни Ҷумҳурии Тоҷикистон «Дар бораи истеҳсоли органикӣ»', 'Закон Республики Таджикистан \"Об органическом производстве\"', 'Law of the Republic of Tajikistan ‘On Organic Production’', 'Қонуни Ҷумҳурии Тоҷикистон «Дар бораи истеҳсоли органикӣ»', 'Закон Республики Таджикистан \"Об органическом производстве\"', 'Law of the Republic of Tajikistan ‘On Organic Production’', 'upload/documents/20251201_144819_16758701.12.2025_14_47_32.pdf', 'pdf', '2025-11-06', 1, '2025-12-01 09:48:19', '2025-12-01 09:48:19');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `text_ru` text DEFAULT NULL,
  `text_tj` text NOT NULL,
  `text_en` text DEFAULT NULL,
  `cover` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `galleries`
--

INSERT INTO `galleries` (`id`, `title_ru`, `title_tj`, `title_en`, `text_ru`, `text_tj`, `text_en`, `cover`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Title RU', 'Title TJ', 'Title EN', 'ТЕКСТ [RU]', 'ТЕКСТ [TJ]', 'ТЕКСТ [EN]', '1764309436_2023-04-18.2023-04-17.12221.jpg', 1, '2025-11-04 07:40:42', '2025-11-28 05:57:16');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `gallery_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `image`, `gallery_id`, `created_at`, `updated_at`) VALUES
(6, '1762242042_img-1.jpg', 3, '2025-11-04 07:40:42', '2025-11-04 07:40:42'),
(7, '1762242042_img-2.jpg', 3, '2025-11-04 07:40:42', '2025-11-04 07:40:42'),
(8, '1762242042_img-7.jpg', 3, '2025-11-04 07:40:42', '2025-11-04 07:40:42');

-- --------------------------------------------------------

--
-- Структура таблицы `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description_ru` text DEFAULT NULL,
  `description_tj` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `requirements_ru` text DEFAULT NULL,
  `requirements_tj` text DEFAULT NULL,
  `requirements_en` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `jobs`
--

INSERT INTO `jobs` (`id`, `title_ru`, `title_tj`, `title_en`, `slug`, `image`, `description_ru`, `description_tj`, `description_en`, `requirements_ru`, `requirements_tj`, `requirements_en`, `location`, `salary`, `start_date`, `end_date`, `attachments`, `is_active`, `sort`, `created_at`, `updated_at`) VALUES
(4, 'Кассир', 'Хазинадор', 'Cashier', 'cashier', 'upload/jobs/20251110_173201_kassir.jpeg', 'ru', 'tj', 'en', NULL, NULL, NULL, 'г.Душанбе', '2500', '2025-11-06', '2026-02-03', '[\"upload/jobs/attachments/20251111_084740_6912b1dc2cedf_grammar-practice-7.pdf\"]', 1, 1, '2025-11-10 12:32:01', '2025-12-02 19:21:26');

-- --------------------------------------------------------

--
-- Структура таблицы `job_applications`
--

CREATE TABLE `job_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `cover_letter` text DEFAULT NULL,
  `resume` varchar(255) NOT NULL,
  `additional_files` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` enum('new','reviewed','accepted','rejected') NOT NULL DEFAULT 'new',
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `first_name`, `last_name`, `email`, `phone`, `cover_letter`, `resume`, `additional_files`, `status`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 4, 'Firuz', 'Firuz', 'user@user.com', '67587697809809', 'Substantial experience has been gained in carrying out the reforms in the Health, Education and Social sectors in the countries\r\nwith transition economies. Thorough knowledge, availability of\r\ninformation sources and contact resources in various countries\r\nenable ISM to implement successfully sub-regional as well as regional projects.', 'upload/applications/resumes/20251202_100411_692e734bcdd52_20251111_084740_6912b1dc2cedf_grammar-practice-7.pdf', '[\"upload\\/applications\\/attachments\\/20251202_100411_692e734bce8a1_ChatGPT_Image_13_\\u043d\\u043e\\u044f\\u0431._2025_\\u0433.,_11_18_59.png\",\"upload\\/applications\\/attachments\\/20251202_100412_692e734c2bd3d_\\u0421\\u043d\\u0438\\u043c\\u043e\\u043a_\\u044d\\u043a\\u0440\\u0430\\u043d\\u0430_2025-09-26_165934.jpg\",\"upload\\/applications\\/attachments\\/20251202_100412_692e734c4524d_IMG_20200525_191018.jpg\"]', 'rejected', 'OK', '2025-12-02 05:04:12', '2025-12-02 08:43:46');

-- --------------------------------------------------------

--
-- Структура таблицы `leaders`
--

CREATE TABLE `leaders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `position_ru` varchar(255) DEFAULT NULL,
  `position_tj` varchar(255) DEFAULT NULL,
  `position_en` varchar(255) DEFAULT NULL,
  `text_ru` text DEFAULT NULL,
  `text_tj` text NOT NULL,
  `text_en` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `working_days` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `leaders`
--

INSERT INTO `leaders` (`id`, `image`, `title_ru`, `title_tj`, `title_en`, `position_ru`, `position_tj`, `position_en`, `text_ru`, `text_tj`, `text_en`, `email`, `phone`, `working_days`, `slug`, `views`, `status`, `sort`, `created_at`, `updated_at`) VALUES
(2, 'upload/leaders/27-11-2025-08-23-23_smiling-businessman.png', 'Салимзода Алиджон Абдуджалол', 'Title TJ', 'Title EN', 'Председатель ГУП СБ РТ \"Амонатбанк\"', 'Должность [TJ]', 'Должность [EN]', 'Текст RU', 'Текст TJ', 'Текст EN', 'olimov.88@inbox.ru', '67587697809809', 'ПН-ПТ, 09:00 - 17:00', 'title-en', 0, 1, 1, '2025-11-05 04:12:04', '2025-11-27 03:23:24'),
(4, 'upload/leaders/25-11-2025-09-01-02_newpersonh.png', 'Худоёрзода Худоёр Бахтиёр', 'title_tj', 'Hudoyorzoda Hudoyor Bahtiyor', 'Первый заместитель Председателя ГУП СБ РТ \"Амонатбанк', 'Должность [TJ]', 'Должность [EN]', '<h4 class=\"my-4 animate__ animate__fadeIn wow  animated\" data-wow-offset=\"20\" data-wow-duration=\"1.3s\" style=\"outline: none; font-family: Roboto, Arial, sans-serif; transition: 0.2s linear; line-height: 1.2; font-size: 1.5rem; animation-name: fadeIn; color: rgb(0, 0, 0); visibility: visible; animation-duration: 1.3s; margin-top: 1.5rem !important; margin-bottom: 1.5rem !important;\">ХУДОЁРЗОДА ХУДОЁР БАХТИЁР</h4><br style=\"outline: none; font-family: &quot;Open Sans&quot;, Arial, sans-serif; transition: 0.2s linear;\"><p style=\"outline: none; font-family: &quot;Open Sans&quot;, Arial, sans-serif; transition: 0.2s linear;\">Первый заместитель председателя ГУП СБ РТ «Амонатбанк» Худоёрзода Худоёр Бахтиёр родился 1 июля 1987 года в Республике Таджикистан, гражданство – таджик.<br style=\"outline: none; transition: 0.2s linear;\"><br style=\"outline: none; transition: 0.2s linear;\">Образование:<br style=\"outline: none; transition: 0.2s linear;\">В 2010 году окончил Национальный университет Таджикистана (дневное отделение) по специальности «экономист».<br style=\"outline: none; transition: 0.2s linear;\"><br style=\"outline: none; transition: 0.2s linear;\">Трудовая деятельность:<br style=\"outline: none; transition: 0.2s linear;\"><br style=\"outline: none; transition: 0.2s linear;\">2010-2012 гг. - специалист 2-ой категории второго отдела инспекции Департамента банковского надзора Национального банка Таджикистана.<br style=\"outline: none; transition: 0.2s linear;\">2012-2015 гг. – специалист 1-ой категории второго отдела инспекции Управления банковского надзора Национального банка Таджикистана.<br style=\"outline: none; transition: 0.2s linear;\">2015-2016 гг. – ведущий специалист 2-ого отдела инспекции Управления банковского надзора Национального банка Таджикистана.<br style=\"outline: none; transition: 0.2s linear;\">В 2016-2018 гг. – главный инспектор Управления контроля микрофинансовых организаций Департамента банковского надзора Национального банка Таджикистана.<br style=\"outline: none; transition: 0.2s linear;\">В 2018-2019 гг. - главный специалист Управления финансов Исполнительного аппарата Президента Республики Таджикистан.<br style=\"outline: none; transition: 0.2s linear;\">2019-2021 гг. – заведующий сектором Управления финансов Исполнительного аппарата Президента Республики Таджикистан.<br style=\"outline: none; transition: 0.2s linear;\">2021-2022 гг. – заместитель начальника Управления финансов Исполнительного аппарата Президента Республики Таджикистан.<br style=\"outline: none; transition: 0.2s linear;\">2022-2025 гг. – Начальник Управления финансов Исполнительного аппарата Президента Республики Таджикистан.<br style=\"outline: none; transition: 0.2s linear;\">С 24 января 2025 года согласно Постановлению Правительства Республики Таджикистан назначен Первым заместителем Председателя ГУП СБ РТ «Амонатбанк».<br style=\"outline: none; transition: 0.2s linear;\"><br style=\"outline: none; transition: 0.2s linear;\">Член народно-демократической Партии Таджикистана.<br style=\"outline: none; transition: 0.2s linear;\">Знание языков: русский, английский со словарем.<br style=\"outline: none; transition: 0.2s linear;\">Женат, имеет 4 детей.</p>', 'Текст TJ', 'Текст EN', 'user@user.com', '67587697809809', 'ПН-ПТ, 09:00 - 17:00', 'hudoyorzoda-hudoyor-bahtiyor', 0, 1, 2, '2025-11-25 04:01:02', '2025-11-25 04:01:02'),
(5, 'upload/leaders/25-11-2025-09-02-08_2.png', 'Ризвонзода Фирдавс Зикр', 'title_tj', 'Rizvonzoda Firdavs Zikr', 'Заместитель Председателя ГУП СБ РТ \"Амонатбанк\"', 'Должность [TJ]', 'Deputy chairman of the board of the SSS of RT \"AMONATBONK\"', '<h4 class=\"my-4 animate__ animate__fadeIn wow  animated\" data-wow-offset=\"20\" data-wow-duration=\"1.3s\" style=\"outline: none; font-family: Roboto, Arial, sans-serif; transition: 0.2s linear; line-height: 1.2; font-size: 1.5rem; animation-name: fadeIn; color: rgb(0, 0, 0); visibility: visible; animation-duration: 1.3s; margin-top: 1.5rem !important; margin-bottom: 1.5rem !important;\">РИЗВОНЗОДА ФИРДАВС ЗИКР</h4><br style=\"outline: none; font-family: &quot;Open Sans&quot;, Arial, sans-serif; transition: 0.2s linear;\"><p style=\"outline: none; font-family: &quot;Open Sans&quot;, Arial, sans-serif; transition: 0.2s linear;\">Заместитель председателя Государственного унитарного предприятия \"Сберегательный банк Республики Таджикистан \"Амонатбанк”\" Родился 15 июня 1969 года в Республике Таджикистан, национальность - таджик.<br style=\"outline: none; transition: 0.2s linear;\"><br style=\"outline: none; transition: 0.2s linear;\">ОБРАЗОВАНИЕ:<br style=\"outline: none; transition: 0.2s linear;\">Окончил Таджикский государственный университет и Таджикский финансово-экономический институт по специальностям \"математика\" и \"банковское дело\".<br style=\"outline: none; transition: 0.2s linear;\">ОПЫТ РАБОТЫ:<br style=\"outline: none; transition: 0.2s linear;\">1986-1987 - рабочий в совхозе имени Федченко Ванчского района;<br style=\"outline: none; transition: 0.2s linear;\">1987-1989 - военная служба в вооруженных силах Советского Союза, г. Томск, Российская Федерация;<br style=\"outline: none; transition: 0.2s linear;\">1989-1990 - студент подготовительного отделения Таджикского государственного университета;<br style=\"outline: none; transition: 0.2s linear;\">1990-1995 - студент очного отделения механико-математического факультета Таджикского государственного университета;<br style=\"outline: none; transition: 0.2s linear;\">1997-2002 - инженер-программист отделения № 1341 Сберегательного банка Фрунзенского района (ныне район Сино) города Душанбе;<br style=\"outline: none; transition: 0.2s linear;\">2002-2009 - главный инженер, начальник информационного отдела управления расчетов, начальник отдела программного сопровождения управления расчетов;<br style=\"outline: none; transition: 0.2s linear;\">2009-2018 - начальник управления информационных технологий ГСБ РТ \"Амонатбанк\", г. Душанбе;<br style=\"outline: none; transition: 0.2s linear;\">2018 (06-11) - начальник отдела овердрафта Департамента пенсионных выплат и банковских карт ГСБ РТ \"Амонатбанк\";<br style=\"outline: none; transition: 0.2s linear;\">2018-2019 - заместитель директора-начальник управления карт и терминальной сети департамента пенсионных выплат и банковских карт ГСБ РТ \"Амонатбанк\";<br style=\"outline: none; transition: 0.2s linear;\">С 10 апреля 2019 года - постановлением Правительства Республики Таджикистан назначен заместителем председателя правления государственного унитарного предприятия Сберегательный банк Республики Таджикистан \"Амонатбонк\";<br style=\"outline: none; transition: 0.2s linear;\">Член Народно-демократической партии Таджикистана.<br style=\"outline: none; transition: 0.2s linear;\">Знание языков: Русский.<br style=\"outline: none; transition: 0.2s linear;\">Женат, имеет 4 детей.</p>', 'Текст TJ', 'Текст EN', 'kaka@mail.ru', '+992907400055', 'ПН-ПТ, 09:00 - 17:00', 'rizvonzoda-firdavs-zikr', 0, 1, 3, '2025-11-25 04:02:08', '2025-11-25 04:02:08'),
(6, 'upload/leaders/25-11-2025-09-03-27_rukmina.jpg', 'Сафарзода Рукмина Сафар', 'title_tj', 'Safarzoda Rukmina Safar', 'Заместитель Председателя ГУП СБ РТ \"Амонатбанк\"', 'Должность [TJ]', 'Deputy Chairman of the Board of the SSB of RT “Amonatbonk”', '<h4 class=\"my-4 animate__ animate__fadeIn wow  animated\" data-wow-offset=\"20\" data-wow-duration=\"1.3s\" style=\"outline: none; font-family: Roboto, Arial, sans-serif; transition: 0.2s linear; line-height: 1.2; font-size: 1.5rem; animation-name: fadeIn; color: rgb(0, 0, 0); visibility: visible; animation-duration: 1.3s; margin-top: 1.5rem !important; margin-bottom: 1.5rem !important;\">САФАРЗОДА РУКМИНА САФАР</h4><br style=\"outline: none; font-family: &quot;Open Sans&quot;, Arial, sans-serif; transition: 0.2s linear;\"><p style=\"outline: none; font-family: &quot;Open Sans&quot;, Arial, sans-serif; transition: 0.2s linear;\">Заместитель Председателя Государственного унитарного предприятия \"Сберегательный банк Республики Таджикистан \"Амонатбанк\"\" Родилась 27 апреля 1978 года в Республике Таджикистан, национальность - таджик.<br style=\"outline: none; transition: 0.2s linear;\"><br style=\"outline: none; transition: 0.2s linear;\">ОПЫТ РАБОТЫ:<br style=\"outline: none; transition: 0.2s linear;\"><br style=\"outline: none; transition: 0.2s linear;\">1999-2000, Специалист по международным расчетам международного отдела ЗАО \"Ист-кредит Банк\" г. Душанбе;<br style=\"outline: none; transition: 0.2s linear;\">2000, Начальник кредитного отдела инвестиционного ЗАО \"Ист-кредит Банк\";<br style=\"outline: none; transition: 0.2s linear;\">2000-2003 Заместитель начальника расчетно-бухгалтерского отдела ЗАО \"Ист-кредит Банк\";<br style=\"outline: none; transition: 0.2s linear;\">2003-2004 Заместитель главного бухгалтера отдела №4 ГСБ РТ \"Амонатбанк\";<br style=\"outline: none; transition: 0.2s linear;\">2004-2007 Экономист 2 категории отдела валютного контроля Управления валютного регулирования Национального банка Таджикистана;<br style=\"outline: none; transition: 0.2s linear;\">2007-2010 гг. экономист 1 категории отдела валютного контроля валютного регулирования управления международных финансовых отношений Национального банка Таджикистана;<br style=\"outline: none; transition: 0.2s linear;\">2010 год, ведущий экономист отдела анализа деятельности банков Управления банковского надзора и лицензирования Национального банка Таджикистана;<br style=\"outline: none; transition: 0.2s linear;\">2010-2015 гг. ведущий специалист аналитического отдела Департамента банковского контроля Национального банка Таджикистана;<br style=\"outline: none; transition: 0.2s linear;\">2015-2017 гг. начальник отдела защиты прав потребителей банковских услуг Национального банка Таджикистана;<br style=\"outline: none; transition: 0.2s linear;\">2017-2020 Начальник Управления по защите прав потребителей финансовых услуг Национального банка Таджикистана;<br style=\"outline: none; transition: 0.2s linear;\">С 4 декабря 2020 года по 29 января 2024 года Заместитель Министра финансов Республики Таджикистан;<br style=\"outline: none; transition: 0.2s linear;\">29 января 2024 года № 26 Постановлением Правительства Республики Таджикистан назначена заместителем Председателя Государственного унитарного предприятия \"Сберегательный банк Республики Таджикистан \"Амонатбанк\"\".<br style=\"outline: none; transition: 0.2s linear;\">Член Народно-демократической партии Таджикистана.<br style=\"outline: none; transition: 0.2s linear;\">Знание языков: Русский, Английский<br style=\"outline: none; transition: 0.2s linear;\">Семейное положение: замужем</p>', 'Текст TJ', 'Текст EN', 'user1@user.com', '+992 48 7020031', 'ПН-ПТ, 09:00 - 17:00', 'safarzoda-rukmina-safar', 0, 1, 4, '2025-11-25 04:03:27', '2025-11-25 04:03:27');

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE `links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `links`
--

INSERT INTO `links` (`id`, `title_ru`, `title_tj`, `title_en`, `img`, `url`, `status`, `sort`, `created_at`, `updated_at`) VALUES
(2, 'Президент Республики Таджикистан', 'Президенти Ҷумҳурии Тоҷикистон', 'President of the Republic of Tajikistan', 'upload/links/2025-11-01Backend2024-08-13.gerb.png', 'https://www.president.tj/', 1, 1, '2025-11-01 11:09:33', '2025-11-01 11:30:25'),
(3, 'Министерство иностранных дел Республики Таджикистан', 'Вазорати корҳои хориҷии Ҷумҳурии Тоҷикистон', 'Ministry of foreign affairs of the Republic of Tajikistan', 'upload/links/2025-12-02mfa_tajikistan-removebg-preview.png', 'https://mfa.tj/', 1, 2, '2025-12-02 03:52:00', '2025-12-02 03:52:00'),
(4, 'Государственный комитет по инвестициям и управлению государственным имуществом', 'Кумитаи давлатии сармоягузорӣ ва идораи амволи давлатии Ҷумҳурии Тоҷикистон', 'State Committee on Investments and State property management of the Republic of Tajikistan', 'upload/links/2025-12-02gerb_logo.png', 'https://investcom.tj/', 1, 3, '2025-12-02 03:53:55', '2025-12-02 03:53:55');

-- --------------------------------------------------------

--
-- Структура таблицы `management`
--

CREATE TABLE `management` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text_ru` text DEFAULT NULL,
  `text_tj` text NOT NULL,
  `text_en` text DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(17, '2023_05_02_142303_create_permission_tables', 10),
(26, '2023_04_13_110116_create_categories_table', 11),
(27, '2023_04_17_031628_create_news_table', 12),
(29, '2023_05_05_135908_create_pages_table', 14),
(30, '2023_10_20_141701_create_subpages_table', 15),
(37, '2023_04_24_091747_create_galleries_table', 16),
(38, '2023_04_24_092132_create_images_table', 16),
(39, '2023_04_25_140958_create_videos_table', 16),
(40, '2023_05_04_104828_create_notifications_table', 16),
(41, '2023_05_06_163421_create_settings_table', 16),
(42, '2025_10_30_153219_create_management_table', 16),
(43, '2025_10_31_140145_create_presidents_table', 16),
(44, '2025_10_31_140205_create_projects_table', 16),
(53, '2025_10_31_140317_create_services_table', 17),
(55, '2025_10_31_000000_create_surveys_table', 19),
(56, '2025_10_31_000001_create_questions_table', 19),
(57, '2025_10_31_000002_create_options_table', 19),
(58, '2023_05_06_123121_create_links_table', 20),
(59, '2025_10_31_140356_create_tasks_table', 21),
(60, '2025_11_03_161702_create_service_requests_table', 22),
(61, '2025_11_04_080358_create_task_items_table', 23),
(62, '2025_11_04_085217_create_news_tasks_table', 24),
(63, '2025_11_04_085250_create_news_images_table', 24),
(64, '2025_11_04_173627_create_leaders_table', 25),
(65, '2025_11_05_090334_create_contacts_table', 26),
(66, '2025_11_05_162703_create_answers_table', 27),
(67, '2025_11_10_143611_create_jobs_table', 28),
(68, '2025_11_11_090003_create_documents_table', 29);

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'no-image.jpg',
  `news_details_ru` text NOT NULL,
  `news_details_tj` text NOT NULL,
  `news_details_en` text NOT NULL,
  `top_slider` tinyint(1) NOT NULL DEFAULT 0,
  `publish_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `home_page` tinyint(1) NOT NULL DEFAULT 0,
  `views` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `category_id`, `user_id`, `title_ru`, `title_tj`, `title_en`, `slug`, `image`, `news_details_ru`, `news_details_tj`, `news_details_en`, `top_slider`, `publish_date`, `status`, `home_page`, `views`, `created_at`, `updated_at`) VALUES
(7, 1, 1, 'Title RU', 'Title TJ', 'Title EN', 'title-en', 'upload/news/2025-11-28_1764306715_17320163330.png', 'Текст RU', 'Текст TJ', 'Текст EN', 0, '2025-11-04', 1, 0, 11, '2025-11-04 12:15:01', '2025-12-03 02:17:05'),
(8, 1, 1, '55 флагштоков в Таджикистане. Обзор по городам и районам страны', 'title_tj', 'en', 'en', 'upload/news/2025-11-24_1763990246_photo_2025-11-24_16-36-46.jpg', '<p data-end=\"354\" data-start=\"35\" style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Noto Sans&quot;, Georgia, &quot;Times New Roman&quot;, Times, serif; letter-spacing: -0.5px;\"><span style=\"font-weight: 700;\">Только за последние 5 лет президент Эмомали Рахмон&nbsp;в рамках своих поездок по городам и районам страны открыл более 20 флагштоков.</span></p><p data-end=\"354\" data-start=\"35\" style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Noto Sans&quot;, Georgia, &quot;Times New Roman&quot;, Times, serif; letter-spacing: -0.5px;\">Государственный флаг, как первый символ независимого Таджикистана, был принят и утвержден 24 ноября 1992 года, а в 2009 году именно этот день официально был учрежден как День флага.&nbsp;</p><p data-end=\"354\" data-start=\"35\" style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Noto Sans&quot;, Georgia, &quot;Times New Roman&quot;, Times, serif; letter-spacing: -0.5px;\">Сегодня в Душанбе в честь Дня государственного флага&nbsp;прошло праздничное шествие, в котором приняли участие более 20 тыс. человек, включая чиновников, активистов, спортсменов и студентов.</p><p data-end=\"354\" data-start=\"35\" style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Noto Sans&quot;, Georgia, &quot;Times New Roman&quot;, Times, serif; letter-spacing: -0.5px;\">30 августа 2011 года в преддверии 20-летия независимости в Душанбе был открыт самый высокий на тот момент флагшток в мире высотой 165 метров, который был внесён в Книгу рекордов Гиннеса<span style=\"text-indent: 0em;\">, побив рекорд Азербайджана, где высота флагштока составляла 162 метра.&nbsp;</span><span style=\"text-indent: 0em;\">Однако спустя 4 года этот рекорд тоже был побит: в 2014 году в Саудовской Аравии был возведён флагшток высотой 170 метров.</span></p><p data-end=\"807\" data-start=\"647\" style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Noto Sans&quot;, Georgia, &quot;Times New Roman&quot;, Times, serif; letter-spacing: -0.5px;\">После этого в регионах Таджикистана начался бум строительства флагштоков. Теперь они есть почти во всех городах и районах страны, даже в самых отдалённых сёлах.</p><p data-end=\"1044\" data-is-last-node=\"\" data-is-only-node=\"\" data-start=\"809\" style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Noto Sans&quot;, Georgia, &quot;Times New Roman&quot;, Times, serif; letter-spacing: -0.5px;\">В День государственного флага&nbsp;мы собрали в нашем фоторепортаже флаги городов и районов Таджикистана.</p><p data-end=\"1044\" data-is-last-node=\"\" data-is-only-node=\"\" data-start=\"809\" style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; color: rgb(51, 51, 51); font-family: &quot;Noto Sans&quot;, Georgia, &quot;Times New Roman&quot;, Times, serif; letter-spacing: -0.5px;\">Согласно нашим подсчётам, на сегодняшний день в сёлах, джамоатах, городах и районах страны установлено 55 флагштоков.</p><br>', 'Текст TJ', 'Текст EN', 1, '2025-11-24', 1, 0, 11, '2025-11-24 13:17:26', '2025-12-03 01:37:53'),
(9, 1, 1, 'Глава МИД Таджикистана обсудил с главой ЮНЕСКО сотрудничество в сфере образования и науки', 'title_tj', 'Title EN', 'title-en-1', 'upload/news/2025-11-25_1764040426_obrazovaniya.jpg', '<div>Министр иностранных дел Таджикистана Сироджиддин Мухриддин встретился с генеральным директором ЮНЕСКО Одри Азуле на полях 43-й сессии Генеральной конференции организации в Самарканде. Встреча состоялась 31 октября, сообщает МИД Таджикистана.</div><div><br></div><div>Стороны обсудили расширение сотрудничества в сферах образования, науки, охраны культурного наследия и управления водными ресурсами.</div><div><br></div><div>Министр подчеркнул, что Таджикистан придаёт особое значение партнёрству с ЮНЕСКО и готов активно участвовать в продвижении совместных инициатив на региональном и глобальном уровнях.</div><div><br></div><div><br></div><div>10:10 6 октября</div><div>Что даёт Ромиту статус ЮНЕСКО и зачем это людям?</div><div>Отмечается, что глава МИД также выступил на пленарном заседании 43-й сессии Генеральной конференции.</div><div><br></div><div>В своём выступлении Мухриддин подчеркнул богатое историко-культурное наследие таджикского народа и вклад предков страны в мировую науку и культуру, отметив, что это духовное достояние является неотъемлемой частью общечеловеческих ценностей.</div><div><br></div><div>Особое внимание министр уделил глобальным вопросам, включая изменение климата и таяние ледников, и отметил активную роль Таджикистана в решении этих проблем.&nbsp;</div><div><br></div>', 'Текст TJ', 'Текст EN', 1, '2025-11-25', 1, 0, 20, '2025-11-25 03:13:46', '2025-12-04 04:17:53'),
(10, 1, 1, 'Пенджикент признан «Всемирным городом ремёсел» за вышивку сюзане', 'title_tj', 'Title EN', 'title-en-2', 'upload/news/2025-11-25_1764040950_photo_2022-10-06_12-46-26.jpg', '<div>Город Пенджикент официально получил 21 октября статус «Всемирного города ремёсел» за вышивку сюзане, что стало важной вехой в сохранении культурного наследия Таджикистана, сообщает МИД страны.</div><div><br></div><div><br></div><div>19:04 18 декабря, 2022</div><div>Чакан – узор древности. Каково это вышивать платье с рисунками?</div><div>Это признание подчеркивает мастерство и многовековые традиции вышивки сюзане, которые глубоко укоренились в истории Пенджикента.</div><div><br></div><div>Этот вид рукоделия, являющийся неотъемлемой частью таджикской культуры, теперь получил международное признание, отмечается в сообщении внешнеполитического ведомства.</div><div><br></div><div>Всемирный совет ремёсел (WCC) - организация, связанная с ЮНЕСКО, которая содействует экономическому развитию через ремёсла, поддерживает ремесленников и поощряет международное сотрудничество.</div><div><br></div><div>Совет присваивает звание «Всемирного города ремёсел» тем городам, которые активно&nbsp; сохраняют и продвигают свои ремесленные традиции.</div><div><br></div>', 'Текст TJ', 'Текст EN', 1, '2025-11-25', 1, 0, 8, '2025-11-25 03:22:31', '2025-12-03 01:47:43'),
(11, 1, 1, 'Что такое Lorem Ipsum?', 'title_tj', 'Ipsum', 'ipsum', 'upload/news/2025-11-28_1764306776_2024-11-19.guncelveuygulamalibordro.jpg', '<strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;- это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</span>', 'Текст TJ', 'Текст EN', 0, '2025-11-26', 1, 0, 12, '2025-11-28 05:12:56', '2025-12-03 00:48:21'),
(12, 1, 1, 'Деятельность', 'Фаъолият', 'Activities', 'activities', 'upload/no-image.jpg', '<span style=\"font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).</span>', 'Текст TJ', 'Текст EN', 0, '2025-11-27', 1, 1, 16, '2025-11-28 07:33:07', '2025-12-04 04:16:56'),
(13, 1, 1, 'Основные обязанности', 'Масъулиятҳои асосӣ', 'Main responsibilities', 'main-responsibilities', 'upload/news/2025-12-02_1764695325_5294134018456620286.jpg', '<p style=\"text-align: justify;\"><span style=\"font-size: 14pt;\">  Государственное унитарное предприятие \"Центр цифровизации, инновации и повышения квалификации кадров сельского хозяйства\"- Министерство сельского хозяйства Республики Таджикистан имеет право координировать деятельность по развитию и формированию цифровизации сельскохозяйственной отрасли, повышению квалификации работников сельскохозяйственной отрасли в области использования цифровых технологий, обеспечению сельскохозяйственных хозяйств цифровыми технологиями, подготовке и повышению квалификации кадров, переподготовке, обмену опытом, распространению современных научных достижений, организации и проведению мероприятий, изучению опыта иностранных государств, проведению учебных курсов, а также оказанию платных услуг, и не только в народе, но и в народе.</span></p>', '<p class=\"MsoNormal\" style=\"margin-bottom:0cm;text-align:justify;text-indent:\r\n1.0cm;mso-line-height-alt:0pt;tab-stops:70.9pt\"><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\">Корхонаи воҳиди давлатии \"Маркази рақамикунонӣ, инноватсия ва такмили ихтисоси кадрҳои соҳаи кишоварзӣ\"- Вазорати кишоварзии Ҷумҳурии Тоҷикистон дорои </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;=\"\" mso-ansi-language:tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">у</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">қ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:=\"\" \"times=\"\" tj\";mso-ansi-language:tg\"=\"\">у</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">қ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">и</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">фаъолияти</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">амо</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">ангсоз</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> дар рушд ва ташаккули ра</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">қ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">амикунонии</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">со</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">аи</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> кишоварз</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ӣ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\">, баланд бардоштани малакаи кормандони со</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">аи</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">кишоварз</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ӣ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">дар</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">самти</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">истифодаи</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">технология</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">ои</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">ра</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">қ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">ам</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ӣ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\">, </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">таъмини</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">хо</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҷ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">аги</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">ои</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">кишоварз</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ӣ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">бо</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">технология</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">ои</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">ра</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">қ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">ам</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ӣ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\">, тайёр намудан ва баланд бардоштани тахасуси кадр</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">о</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\">, </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">бозомуз</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ӣ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\">, мубодилаи та</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ҷ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">риба</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\">, па</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">н</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">намудани</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">дастовард</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">ои</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">илмии</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">муосир</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\">, ташкил ва гузаронидани чорабини</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">о</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\">, омузиши та</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ҷ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">рибаи</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">давлат</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">ои</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">хори</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ҷӣ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\">, гузаронидани курс</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">ои</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">таълим</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ӣ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> ва </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">амчунин</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">амалисозии</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">хизматрасони</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">ои</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">пулакие</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">мебошад</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\">, </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">ки</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">қ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">онунгузории</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:tg\"=\"\">Ҷ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:=\"\" tg\"=\"\">ум</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;=\"\" mso-ansi-language:tg\"=\"\">ҳ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-bidi-font-family:\"times=\"\" tj\";=\"\" mso-ansi-language:tg\"=\"\">урии</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;mso-ansi-language:tg\"=\"\"> </span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">То</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman\",serif;mso-ansi-language:=\"\" tg\"=\"\">ҷ</span><span lang=\"TG\" style=\"font-size: 14pt; font-family: Arial;\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-bidi-font-family:\"times=\"\" tj\";mso-ansi-language:tg\"=\"\">икистон</span><span lang=\"TG\" style=\"font-size:14.0pt;font-family:\" times=\"\" new=\"\" roman=\"\" tj\",serif;=\"\" mso-ansi-language:tg\"=\"\"><span style=\"font-family: Arial;\"> манъ накардааст.</span><o:p></o:p></span></p>', '<div style=\"text-align: justify;\"><span style=\"font-size: 14pt;\">     State Unitary Enterprise \"Center for Digitalization, Innovation and Capacity building of Agricultural Employees\" under The Ministry of Agriculture of the Republic of Tajikistan has the right to coordinate activities for the development and formation of digitalization of the agricultural sector, advanced training of agricultural workers in the field of digital technologies, provision of agricultural enterprises with digital technologies, training and advanced training, retraining, exchange of experience, dissemination of modern scientific achievements, organization and holding events, studying the experience of foreign countries, conducting training courses, as well as providing paid services, and not only among the people, but also among the people.</span></div>', 0, '2025-11-28', 1, 1, 21, '2025-11-28 08:28:09', '2025-12-04 04:16:41');

-- --------------------------------------------------------

--
-- Структура таблицы `news_images`
--

CREATE TABLE `news_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news_images`
--

INSERT INTO `news_images` (`id`, `news_id`, `image`, `sort`, `created_at`, `updated_at`) VALUES
(10, 7, 'upload/news/gallery/20251104_171501_6909ee4554e45.png', 0, '2025-11-04 12:15:01', '2025-11-04 12:15:01'),
(11, 7, 'upload/news/gallery/20251104_171501_6909ee456311a.png', 1, '2025-11-04 12:15:01', '2025-11-04 12:15:01'),
(12, 7, 'upload/news/gallery/20251104_171501_6909ee4572b9d.png', 2, '2025-11-04 12:15:01', '2025-11-04 12:15:01'),
(13, 7, 'upload/news/gallery/20251104_171501_6909ee458886c.png', 3, '2025-11-04 12:15:01', '2025-11-04 12:15:01'),
(14, 8, 'upload/news/gallery/20251124_181726_69245ae6bdba2.jpg', 0, '2025-11-24 13:17:26', '2025-11-24 13:17:26'),
(15, 8, 'upload/news/gallery/20251124_181726_69245ae6e37a7.jpg', 1, '2025-11-24 13:17:27', '2025-11-24 13:17:27'),
(16, 8, 'upload/news/gallery/20251124_181727_69245ae71997f.jpg', 2, '2025-11-24 13:17:27', '2025-11-24 13:17:27'),
(17, 9, 'upload/news/gallery/20251125_081346_69251eea989e5.jpg', 0, '2025-11-25 03:13:46', '2025-11-25 03:13:46'),
(18, 9, 'upload/news/gallery/20251125_081346_69251eeab994a.jpg', 1, '2025-11-25 03:13:46', '2025-11-25 03:13:46'),
(19, 9, 'upload/news/gallery/20251125_081346_69251eeadc363.jpg', 2, '2025-11-25 03:13:47', '2025-11-25 03:13:47'),
(20, 9, 'upload/news/gallery/20251125_081347_69251eeb07c30.jpg', 3, '2025-11-25 03:13:47', '2025-11-25 03:13:47'),
(21, 10, 'upload/news/gallery/20251125_082231_692520f70339b.jpg', 0, '2025-11-25 03:22:31', '2025-11-25 03:22:31'),
(22, 10, 'upload/news/gallery/20251125_082231_692520f72988a.jpg', 1, '2025-11-25 03:22:31', '2025-11-25 03:22:31'),
(23, 10, 'upload/news/gallery/20251125_082231_692520f73991e.jpg', 2, '2025-11-25 03:22:31', '2025-11-25 03:22:31'),
(24, 11, 'upload/news/gallery/20251128_101256_69292f5873c91.jpg', 0, '2025-11-28 05:12:56', '2025-11-28 05:12:56'),
(25, 11, 'upload/news/gallery/20251128_101256_69292f58a9145.jpg', 1, '2025-11-28 05:12:56', '2025-11-28 05:12:56'),
(26, 11, 'upload/news/gallery/20251128_101256_69292f58dcc56.png', 2, '2025-11-28 05:12:57', '2025-11-28 05:12:57'),
(27, 12, 'upload/news/gallery/20251128_123307_6929503359e39.jpg', 0, '2025-11-28 07:33:07', '2025-11-28 07:33:07'),
(28, 12, 'upload/news/gallery/20251128_123307_69295033747e4.jpg', 1, '2025-11-28 07:33:07', '2025-11-28 07:33:07'),
(29, 12, 'upload/news/gallery/20251128_123307_6929503389d8e.jpg', 2, '2025-11-28 07:33:07', '2025-11-28 07:33:07');

-- --------------------------------------------------------

--
-- Структура таблицы `news_tasks`
--

CREATE TABLE `news_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `news_id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `news_tasks`
--

INSERT INTO `news_tasks` (`id`, `news_id`, `task_id`, `created_at`, `updated_at`) VALUES
(1, 13, 5, '2025-11-28 08:28:09', '2025-11-28 08:28:09');

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `text_ru` varchar(255) NOT NULL,
  `text_tj` varchar(255) NOT NULL,
  `text_en` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `options`
--

INSERT INTO `options` (`id`, `question_id`, `text_ru`, `text_tj`, `text_en`, `created_at`, `updated_at`) VALUES
(4, 2, 'git commit –amend', '', '', '2025-11-10 09:14:37', '2025-11-10 09:14:37'),
(5, 2, 'git commit push', '', '', '2025-11-10 09:14:37', '2025-11-10 09:14:37'),
(6, 2, 'git status', '', '', '2025-11-10 09:14:37', '2025-11-10 09:14:37');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `text_ru` text DEFAULT NULL,
  `text_tj` text NOT NULL,
  `text_en` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `title_ru`, `title_tj`, `title_en`, `url`, `text_ru`, `text_tj`, `text_en`, `status`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'О нас', 'Дар бораи мо', 'About Us', 'about-us', 'О нас', 'Дар бораи мо', 'About Us', 1, 0, '2025-10-31 13:28:08', '2025-11-26 06:22:28'),
(2, 'Структура организации', 'Сохтори ташкилотӣ', 'Organisational structure', 'organisational-structure', 'Структура организации', 'Сохтори ташкилотӣ', '<p>Organisational structure</p>', 1, 0, '2025-11-26 06:23:53', '2025-11-26 06:23:53'),
(3, 'Деятельность', 'Фаъолиятҳо', 'Activities', 'activities', 'Деятельность', 'Фаъолиятҳо', 'Activities', 1, 0, '2025-11-26 06:24:29', '2025-11-26 06:24:29'),
(4, 'Наши проекты', 'Лоиҳаҳои мо', 'Our projects', 'our-projects', 'Наши проекты', 'Лоиҳаҳои мо', '<p>Our projects</p>', 1, 0, '2025-11-26 06:24:58', '2025-11-26 06:24:58'),
(5, 'Услуги', 'Хизматрасониҳо', 'Services', 'services', 'Услуги', '<p>Хизматрасониҳо</p>', '<p>Services</p>', 0, 0, '2025-11-26 06:25:28', '2025-11-26 06:25:28'),
(6, 'Вакансии', 'Вакансияҳо', 'Vacancies', 'vacancies', 'Вакансии', '<p>Вакансияҳо</p>', '<p>Vacancies</p>', 1, 0, '2025-11-26 06:26:08', '2025-11-26 06:26:08'),
(7, 'Документы', 'Ҳуҷҷатҳо', 'Documents', 'documents', 'Документы', '<p>Ҳуҷҷатҳо</p>', '<p>Documents</p>', 1, 0, '2025-11-26 06:26:33', '2025-11-26 06:26:33'),
(8, 'Новости', 'Ахбор', 'News', 'news', 'Новости', 'Ахбор', 'News', 1, 0, '2025-11-26 06:27:05', '2025-11-26 06:27:05');

-- --------------------------------------------------------

--
-- Структура таблицы `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL DEFAULT 'web',
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'category.menu', 'web', 'category', '2023-05-02 13:18:17', '2023-05-04 05:42:40'),
(2, 'category.list', 'web', 'category', '2023-05-02 13:19:22', '2023-05-02 13:19:22'),
(3, 'category.add', 'web', 'category', '2023-05-02 13:19:32', '2023-05-02 13:19:32'),
(4, 'category.edit', 'web', 'category', '2023-05-02 13:19:41', '2023-05-02 13:19:41'),
(5, 'category.delete', 'web', 'category', '2023-05-02 13:19:50', '2023-05-02 13:19:50'),
(12, 'news.menu', 'web', 'newsPost', '2023-05-02 13:48:47', '2023-05-02 13:48:47'),
(13, 'news.list', 'web', 'newsPost', '2023-05-02 13:48:55', '2023-05-02 13:48:55'),
(14, 'news.add', 'web', 'newsPost', '2023-05-02 13:49:01', '2023-05-02 13:49:01'),
(15, 'news.edit', 'web', 'newsPost', '2023-05-02 13:49:07', '2023-05-02 13:49:07'),
(16, 'news.delete', 'web', 'newsPost', '2023-05-02 13:49:14', '2023-05-02 13:49:14'),
(18, 'photo.menu', 'web', 'gallery', '2023-05-02 13:49:44', '2023-05-02 13:49:44'),
(19, 'photo.list', 'web', 'gallery', '2023-05-02 13:49:51', '2023-05-02 13:49:51'),
(20, 'photo.add', 'web', 'gallery', '2023-05-02 13:49:57', '2023-05-02 13:49:57'),
(21, 'photo.edit', 'web', 'gallery', '2023-05-02 13:50:03', '2023-05-02 13:50:03'),
(22, 'photo.delete', 'web', 'gallery', '2023-05-02 13:50:11', '2023-05-02 13:50:11'),
(23, 'video.menu', 'web', 'video', '2023-05-02 13:52:23', '2023-05-02 13:52:23'),
(24, 'video.list', 'web', 'video', '2023-05-02 13:52:30', '2023-05-02 13:52:30'),
(25, 'video.add', 'web', 'video', '2023-05-02 13:53:06', '2023-05-02 13:53:06'),
(26, 'video.edit', 'web', 'video', '2023-05-02 13:53:12', '2023-05-02 13:53:12'),
(27, 'video.delete', 'web', 'video', '2023-05-02 13:53:19', '2023-05-03 12:21:23'),
(30, 'setting.menu', 'web', 'setting', '2023-05-02 13:56:45', '2023-05-02 13:56:45'),
(31, 'role.menu', 'web', 'role', '2023-05-02 13:57:01', '2023-05-02 13:57:01');

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `presidents`
--

CREATE TABLE `presidents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text_ru` text DEFAULT NULL,
  `text_tj` text NOT NULL,
  `text_en` text DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `presidents`
--

INSERT INTO `presidents` (`id`, `title_ru`, `title_tj`, `title_en`, `slug`, `image`, `text_ru`, `text_tj`, `text_en`, `views`, `status`, `sort`, `created_at`, `updated_at`) VALUES
(2, 'Президент Республики Таджикистан', 'Президенти Ҷумҳурии Тоҷикистон', 'President of the Republic of Tajikistan', 'title-en', 'upload/presidents/20251103_103729_prezident.jpg', '<p><span style=\"font-family: \"Open Sans\", Arial, sans-serif;\">Сегодня пришло время ценить один из символов государственности - национальную валюту, гордиться ею и уважать ее.</span></p>', '<p><span style=\"font-family: \"Open Sans\", Arial, sans-serif;\">Имрӯз фурсате расидааст, ки ба қадри яке аз рамзҳои давлатдорӣ – пули миллӣ бирасем, ифтихор намоем ва ба он эҳтиром гузорем.</span></p>', '<p><span style=\"font-family: \"Open Sans\", Arial, sans-serif;\">Today the time has come to value one of the symbols of statehood - the national currency, to be proud of it and respect it.</span></p>', 0, 1, 1, '2025-11-03 05:21:13', '2025-12-01 04:30:06');

-- --------------------------------------------------------

--
-- Структура таблицы `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `text_ru` text DEFAULT NULL,
  `text_tj` text NOT NULL,
  `text_en` text DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `projects`
--

INSERT INTO `projects` (`id`, `title_ru`, `title_tj`, `title_en`, `slug`, `image`, `start_date`, `end_date`, `gallery`, `text_ru`, `text_tj`, `text_en`, `views`, `status`, `sort`, `created_at`, `updated_at`) VALUES
(4, 'Казахстан запретил железнодорожные грузоперевозки в страны Центральной Азии', 'tj', 'Kazakhstan has banned rail freight transport to Central Asian countries', 'banned', 'upload/projects/20251125_083222_жб.jpg', '2025-02-07', '2025-11-30', '[\"upload/projects/gallery/20251110_133704_6911a43068643_p4.jpg\", \"upload/projects/gallery/20251125_083222_6925234631fa6_News_2019.03.27.jpg\", \"upload/projects/gallery/20251125_083222_6925234648816_0015-e1708444611381.jpg\", \"upload/projects/gallery/20251125_083222_6925234664751_жб.jpg\"]', '<p>Компания «Казахстанские железные дороги» запретила перевозку всех грузов на станции Узбекистана, Таджикистана, Туркменистана, Афганистана и Кыргызстана через пункт Сарыагаш с 22 по 24 ноября. Причиной является скопление более 8800 вагонов и несвоевременный прием поездов, сообщает Ulysmedia.</p><p><br></p><p>«В случае нормализации поездной ситуации и улучшение приема поездов по межгосударственному стыковому пункту Сарыагаш соседними ЖДА данный приказ будет отменен», - отметили в компании.</p><p>Ранее казахстанские СМИ сообщали, что с 12 по 20 ноября введен запрет на прием к перевозке всех грузов через МГСП Сарыагаш в направлении стран Центральной Азии, кроме зерновых грузов, продуктов перемола, скоропортящихся грузов.</p><p><br></p><p>По данным Bizmedia, ввести такую меру заставила сложная поездная обстановка, связанная с уменьшением приема поездов узбекскими железными дорогами, и как следствие — большим накоплением поездов на путях.</p><p><br></p><p>Между тем, Цифровая платформа для развития бизнеса на национальном и международном рынке Forkagro сегодня передает, что ситуация с железнодорожными перевозками грузов в направлении Центральной Азии через пункт Сарыагаш не улучшилась.</p><p><br></p>', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Noto Sans\", Georgia, \"Times New Roman\", Times, serif; letter-spacing: -0.5px;\">Тарҳи сулҳи Иёлоти Муттаҳидаи Амрико (ИМА дар робита ба ҷанг дар Украина, ки аз ҷониби Доналд Трамп, раисҷумҳури ин кишвар пешниҳод шуд, дар гуфтушуниди Женева ба таври қобили мулоҳиза бозбинӣ шудааст.</span></p><br>', '<p>Substantial experience has been gained in carrying out the reforms in the Health, Education and Social sectors in the countries\r\nwith transition economies. Thorough knowledge, availability of\r\ninformation sources and contact resources in various countries\r\nenable ISM to implement successfully sub-regional as well as regional projects.\r\nThe department has established close relations with the number</p>', 21, 1, 1, '2025-11-10 08:24:33', '2025-12-04 04:33:11'),
(5, 'В Согде открыли новые участки дороги Дехмой – Канибадам и комплекс ТО аэропорта Худжанда', 'title_tj', 'Title EN', 'title-en', 'upload/projects/20251125_083501_photo_2025-11-21_13-30-28_(2).jpg', '2025-07-05', '2025-11-28', '[\"upload/projects/gallery/20251125_083501_692523e5c1698_photo_2025-11-21_13-30-28.jpg\", \"upload/projects/gallery/20251125_083501_692523e5ea416_хи.jpg\", \"upload/projects/gallery/20251125_083502_692523e614b0b_photo_2025-11-21_13-30-28_(2).jpg\"]', '<p>В Согдийской области 20 ноября состоялось открытие трёх участков автомобильной дороги Дехмой – Канибадам: Дехмой – Бободжон Гафуров, Бободжон Гафуров – Хистеварз и Кучкак – Канибадам. В церемонии принял участие президент Таджикистана Эмомали Рахмон.</p><p><br></p><p>По данным пресс-службы главы государства, новые участки дороги общей протяжённостью 52 км построены в рамках программы «Улучшение региональных транспортных связей в Центральной Азии».</p><p><br></p><p>Проект реализуется в Согдийской, Хатлонской областях и ГБАО, его стоимость составляет 56 млн долларов.</p><p><br></p><p>В ходе строительства трассы Дехмой – Канибадам были возведены 11 автодорожных мостов, 17 остановок, железобетонные подпорные стены, установлены линии электроснабжения и связи, построены пешеходные тротуары и защитные ограждения.</p><p><br></p>', '<p>tj</p>', '<p>en</p>', 7, 1, 2, '2025-11-25 03:35:02', '2025-12-03 18:08:20'),
(6, 'Таджикистан презентовал инвестиционный потенциал в Нью-Йорке', 'Тоҷикистон дар Ню-Йорк потенсиали сармоягузории худро муаррифӣ кард.', 'Tajikistan presented its investment potential in New York', 'potential', 'upload/projects/20251125_084112_5.jpg', '2025-05-03', '2026-10-30', '[\"upload/projects/gallery/20251125_084112_69252558610e4_9.jpg\", \"upload/projects/gallery/20251125_084112_692525587a60e_1.jpg\", \"upload/projects/gallery/20251125_084112_6925255899a40_5.jpg\", \"upload/projects/gallery/20251125_084112_69252558b6e9d_6.jpg\"]', '<p>В Нью-Йорке состоялась презентация инвестиционного потенциала Таджикистана в рамках десятилетия платформы C5+1.</p><p><br></p><p>12 ноября в Vista LIC Hotel (Нью-Йорк) состоялось инвестиционное мероприятие  Presentation on Tajikistan’s Investment Opportunities, организованное ГУП «Таджинвест» при Государственном комитете по инвестициям и управлению государственным имуществом Республики Таджикистан при поддержке US-Tajikistan Business Council.</p><p><br></p><p>Мероприятие было организовано в рамках  визита  Эмомали Рахмона в Вашингтон и стало частью программы, посвящённой десятилетию платформы C5+1 — ключевого механизма экономического сотрудничества США и Центральной Азии.</p><p><br></p><p>С приветственными обращениями выступил Джонибек Исмоил Хикмат, постоянный представитель Таджикистана при ООН, который сформулировал видение и позиционирование Таджикистана на мировом инвестиционном рынке следующим выразительным тезисом:</p><p><br></p><p>«Сегодня мы создаём новый Шёлковый путь — не караванов и товаров, а идей, инноваций и инвестиций», - отметил он.</p><p>Соорганизатором данного инвестиционного мероприятия выступил Американо-Таджикский Деловой Совет (US-Tajikistan Business Council).</p><p><br></p>', '<p>tj</p>', '<p>en</p>', 5, 1, 3, '2025-11-25 03:41:12', '2025-12-03 03:06:03');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `survey_id` bigint(20) UNSIGNED NOT NULL,
  `text_ru` varchar(255) NOT NULL,
  `text_tj` varchar(255) NOT NULL,
  `text_en` varchar(255) NOT NULL,
  `type` enum('radio','checkbox','text') NOT NULL DEFAULT 'radio',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `survey_id`, `text_ru`, `text_tj`, `text_en`, `type`, `created_at`, `updated_at`) VALUES
(2, 4, 'Как исправить ошибку в комментарии к коммиту?', '', '', 'radio', '2025-11-10 09:14:37', '2025-11-10 09:14:37');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2023-05-03 07:28:05', '2023-05-03 08:05:20'),
(2, 'admin', 'web', '2023-05-03 07:28:28', '2023-05-03 07:28:28'),
(3, 'Editor', 'web', '2023-05-03 07:28:38', '2023-05-03 07:28:38'),
(4, 'Reporter', 'web', '2023-05-03 07:28:55', '2023-05-03 07:28:55');

-- --------------------------------------------------------

--
-- Структура таблицы `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `text_ru` text DEFAULT NULL,
  `text_tj` text NOT NULL,
  `text_en` text DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `title_ru`, `title_tj`, `title_en`, `slug`, `icon`, `text_ru`, `text_tj`, `text_en`, `views`, `status`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'Title RU', 'Title TJ', 'Title EN', 'title-en', '<i class=\"fas fa-users\"></i>', 'Текст RU', 'Текст TJ', '<p>Текст EN</p>', 0, 1, 1, '2025-11-03 12:31:57', '2025-11-03 12:39:39');

-- --------------------------------------------------------

--
-- Структура таблицы `service_requests`
--

CREATE TABLE `service_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fio` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `street_ru` varchar(255) DEFAULT NULL,
  `street_tj` varchar(255) NOT NULL,
  `street_en` varchar(255) DEFAULT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `contact_title` varchar(255) DEFAULT NULL,
  `contact_detail` varchar(255) DEFAULT NULL,
  `contact_map` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `street_ru`, `street_tj`, `street_en`, `title_ru`, `title_en`, `title_tj`, `phone`, `email`, `logo`, `facebook`, `twitter`, `telegram`, `instagram`, `youtube`, `contact_title`, `contact_detail`, `contact_map`, `created_at`, `updated_at`) VALUES
(1, 'ул. Гипрозем, 16, 734067, р. Сино, Душанбе, Таджикистан', 'куч. Гипрозем, 16, 734067, н. Сино, Душанбе, Тоҷикистон', 'st. Giprozem, 16, 734067, d. Sino, Dushanbe, Tajikistan', 'Государственное унитарное предприятие \"Центр цифровизации, <br> инновации и повышения квалификации кадров сельского хозяйства\"', 'State Unitary Enterprise \"Center for Digitalization, Innovation <br> and Capacity Building of Agricultural Employees\"', 'Корхонаи воҳиди давлатии \"Маркази рақамикунонӣ, инноватсия <br> ва такмили ихтисоси кадрҳои соҳаи кишоварзӣ\"', '+992 37 231 90 90', 'info@agridigital.tj', 'upload/logo/logo_1764700677.png', 'https://www.facebook.com/centerfordigitalization/', 'https://twitter.com/', 'https://telegram.org/', 'https://www.instagram.com/', 'https://youtube.com/', 'Контакт', '+992 37 231 90 90', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2301.382669419986!2d32.02417099376721!3d54.77323999672319!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46ce580520d36a2d%3A0x9e70622a8865bd84!2z0KPQv9GA0LDQstC70LXQvdC40LUg0JzQtdC70LjQvtGA0LDRhtC40Lgg0JfQtdC80LXQu9GMINCYINCh0LXQu9GM0YHQutC-0YXQvtC30Y_QudGB0YLQstC10L3QvdC-0LPQviDQktC-0LTQvtGB0L3QsNCx0LbQtdC90LjRjw!5e0!3m2!1sru!2s!4v1762241795793!5m2!1sru!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', '2025-11-04 07:25:51', '2025-12-02 18:37:58');

-- --------------------------------------------------------

--
-- Структура таблицы `sub_pages`
--

CREATE TABLE `sub_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) DEFAULT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `text_ru` text DEFAULT NULL,
  `text_tj` text NOT NULL,
  `text_en` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sub_pages`
--

INSERT INTO `sub_pages` (`id`, `page_id`, `title_ru`, `title_tj`, `title_en`, `url`, `text_ru`, `text_tj`, `text_en`, `status`, `sort`, `created_at`, `updated_at`) VALUES
(1, 1, 'Руководство', 'Идоракунӣ', 'Management', 'management', '<h2 style=\"margin-top: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">Что такое Lorem Ipsum?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\"><strong style=\"margin: 0px; padding: 0px;\">Lorem Ipsum</strong> - это текст-\"рыба\", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной \"рыбой\" для текстов на латинице с начала XVI века. В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время, программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem Ipsum.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\"><br></p><h2 style=\"margin-top: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">Откуда он появился?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\">Многие думают, что Lorem Ipsum - взятый с потолка псевдо-латинский набор слов, но это не совсем так. Его корни уходят в один фрагмент классической латыни 45 года н.э., то есть более двух тысячелетий назад. Ричард МакКлинток, профессор латыни из колледжа Hampden-Sydney, штат Вирджиния, взял одно из самых странных слов в Lorem Ipsum, \"consectetur\", и занялся его поисками в классической латинской литературе. В результате он нашёл неоспоримый первоисточник Lorem Ipsum в разделах 1.10.32 и 1.10.33 книги \"de Finibus Bonorum et Malorum\" (\"О пределах добра и зла\"), написанной Цицероном в 45 году н.э. Этот трактат по теории этики был очень популярен в эпоху Возрождения. Первая строка Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", происходит от одной из строк в разделе 1.10.32</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\">Классический текст Lorem Ipsum, используемый с XVI века, приведён ниже. Также даны разделы 1.10.32 и 1.10.33 \"de Finibus Bonorum et Malorum\" Цицерона и их английский перевод, сделанный H. Rackham, 1914 год.<br><br><br></p><h2 style=\"margin-top: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">Почему он используется?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\">Давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона, а также реальное распределение букв и пробелов в абзацах, которое не получается при простой дубликации \"Здесь ваш текст.. Здесь ваш текст.. Здесь ваш текст..\" Многие программы электронной вёрстки и редакторы HTML используют Lorem Ipsum в качестве текста по умолчанию, так что поиск по ключевым словам \"lorem ipsum\" сразу показывает, как много веб-страниц всё ещё дожидаются своего настоящего рождения. За прошедшие годы текст Lorem Ipsum получил много версий. Некоторые версии появились по ошибке, некоторые - намеренно (например, юмористические варианты).<br><br></p><h2 style=\"margin-top: 0px; padding: 0px; font-family: DauphinPlain; font-size: 24px; line-height: 24px; color: rgb(0, 0, 0);\">Где его взять?</h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\">Есть много вариантов Lorem Ipsum, но большинство из них имеет не всегда приемлемые модификации, например, юмористические вставки или слова, которые даже отдалённо не напоминают латынь. Если вам нужен Lorem Ipsum для серьёзного проекта, вы наверняка не хотите какой-нибудь шутки, скрытой в середине абзаца. Также все другие известные генераторы Lorem Ipsum используют один и тот же текст, который они просто повторяют, пока не достигнут нужный объём. Это делает предлагаемый здесь генератор единственным настоящим Lorem Ipsum генератором. Он использует словарь из более чем 200 латинских слов, а также набор моделей предложений. В результате сгенерированный Lorem Ipsum выглядит правдоподобно, не имеет повторяющихся абзацей или \"невозможных\" слов.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: \"Open Sans\", Arial, sans-serif;\"><br><br></p>', 'ТЕКСТ TJ', 'ТЕКСТ EN', 1, 1, '2025-11-01 06:01:45', '2025-12-01 04:38:36');

-- --------------------------------------------------------

--
-- Структура таблицы `surveys`
--

CREATE TABLE `surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description_ru` text DEFAULT NULL,
  `description_tj` text DEFAULT NULL,
  `description_en` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `surveys`
--

INSERT INTO `surveys` (`id`, `title_ru`, `title_tj`, `title_en`, `start_date`, `end_date`, `description_ru`, `description_tj`, `description_en`, `is_active`, `created_at`, `updated_at`) VALUES
(4, 'GIT', 'Title TJ', 'Title EN', NULL, NULL, 'Можно использовать git reset, вот так:', 'Описание TJ', 'Описание EN', 1, '2025-11-10 09:14:37', '2025-11-10 09:14:37');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `text_ru` text DEFAULT NULL,
  `text_tj` text NOT NULL,
  `text_en` text DEFAULT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `title_ru`, `title_tj`, `title_en`, `slug`, `text_ru`, `text_tj`, `text_en`, `views`, `status`, `sort`, `created_at`, `updated_at`) VALUES
(5, 'Новости', 'Ахбор', 'News', 'news', 'Основные Обязанности<br><br>Цифровизация сельского хозяйства - важный шаг и развитии агропромышленного комплекса. Этот процесс включает в себя:', 'Текст TJ', '<p>en</p>', 0, 1, 1, '2025-11-04 05:34:09', '2025-11-25 03:47:36');

-- --------------------------------------------------------

--
-- Структура таблицы `task_items`
--

CREATE TABLE `task_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `text_ru` text DEFAULT NULL,
  `text_tj` text DEFAULT NULL,
  `text_en` text DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `task_items`
--

INSERT INTO `task_items` (`id`, `task_id`, `text_ru`, `text_tj`, `text_en`, `sort`, `created_at`, `updated_at`) VALUES
(7, 5, 'Повышение эффективности и урожайности', 'Баланд бардоштани самаранокӣ ва ҳосилнокӣ', 'Increasing efficiency and productivity', 0, '2025-12-02 16:21:59', '2025-12-02 16:21:59'),
(8, 5, 'Контроль, прозрачность и своевременный доступ к информации', 'Назорат, шаффофият ва сари вақт дастрасии маълумотҳо', 'Monitoring, transparency, and timely access to information', 1, '2025-12-02 16:21:59', '2025-12-02 16:21:59'),
(9, 5, 'Обеспечение продовольственной безопасности Республики Таджикистан', 'Таъмини амнияти озуқавории Ҷумҳурии Тоҷикистон', 'Ensuring Food Security of the Republic of Tajikistan', 2, '2025-12-02 16:21:59', '2025-12-02 16:21:59');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` enum('admin','user','editor') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Fira', 'Олимов Фируз', 'olimov.88@inbox.ru', NULL, '$2y$10$joW3dbSqEGhIfGla5fPkbOdr5EKwGP8M7M5yvk8AON8RggE7sxfk.', '2025-11-032025-04-04admin.png', '900000000', 'admin', 'active', 'Ub7DT8NrkeQPxZ3YNoDZsqsbJHeVmLq0SIOLTTvvw9IqXRYNyh5gMj4I5QJI', '2023-03-07 07:09:39', '2025-11-03 12:58:55'),
(12, 'Контент менеджер', 'Менеджер', 'editor@mail.ru', NULL, '$2y$10$kJOYgUtPu4jkhPW2Jh15Nel5P25cqfFuF3.6/7Hg/m8JncRaoXnK.', NULL, '67587697809809', 'admin', 'active', NULL, '2025-11-12 04:49:01', '2025-11-12 04:55:06'),
(13, 'Бехруз', 'Behruz', 'aminov.heartzilla@gmail.com', NULL, '$2y$10$Iex5yZgjYLtHcPOlunZZ2erNQSCQCSMfuqexpcQGLObyQvMzAyDpy', '2025-12-01last version of logoWithNoBackk400pix.png', '502050511', 'admin', 'active', NULL, '2025-11-27 05:03:08', '2025-12-02 06:18:29');

-- --------------------------------------------------------

--
-- Структура таблицы `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `title_ru` varchar(255) DEFAULT NULL,
  `title_tj` varchar(255) NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `position` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `videos`
--

INSERT INTO `videos` (`id`, `video_url`, `caption`, `title_ru`, `title_tj`, `title_en`, `status`, `position`, `created_at`, `updated_at`) VALUES
(3, 'https://www.youtube.com/watch?v=hkIcxh_dQn8&pp=0gcJCRYKAYcqIYzv', 'upload/video/2025-11-27_video_beautiful_architecture.jpg', 'Title RU', 'Title TJ', 'Title EN', 1, 1, '2025-11-03 03:35:38', '2025-11-27 03:50:03'),
(4, 'https://www.youtube.com/watch?v=tDWstf6cTc0', 'upload/video/2025-11-256.jpg', 'Простая формула осознанного утра: привычки, которые дают силу, фокус и вдохновение на день', 'title_tj', 'Title EN', 1, 2, '2025-11-25 03:49:40', '2025-11-25 03:49:40'),
(5, 'https://www.youtube.com/watch?v=E5WzZM3mq2k', 'upload/video/2025-11-25photo_2025-11-24_16-36-46.jpg', 'Еда, которая защищает от тромбов и инсульта', 'title_tj', 'Title EN', 1, 3, '2025-11-25 03:51:32', '2025-11-25 03:51:32');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`),
  ADD KEY `answers_option_id_foreign` (`option_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_slug_unique` (`category_slug`),
  ADD KEY `categories_position_index` (`position`);

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_gallery_id_index` (`gallery_id`);

--
-- Индексы таблицы `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jobs_slug_unique` (`slug`);

--
-- Индексы таблицы `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_applications_job_id_foreign` (`job_id`);

--
-- Индексы таблицы `leaders`
--
ALTER TABLE `leaders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `leaders_slug_unique` (`slug`);

--
-- Индексы таблицы `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `links_sort_index` (`sort`);

--
-- Индексы таблицы `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `news_slug_unique` (`slug`),
  ADD KEY `news_category_id_foreign` (`category_id`),
  ADD KEY `news_user_id_foreign` (`user_id`),
  ADD KEY `news_publish_date_index` (`publish_date`),
  ADD KEY `news_status_index` (`status`),
  ADD KEY `news_top_slider_index` (`top_slider`);

--
-- Индексы таблицы `news_images`
--
ALTER TABLE `news_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_images_news_id_foreign` (`news_id`);

--
-- Индексы таблицы `news_tasks`
--
ALTER TABLE `news_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_tasks_news_id_foreign` (`news_id`),
  ADD KEY `news_tasks_task_id_foreign` (`task_id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Индексы таблицы `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_question_id_foreign` (`question_id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_url_unique` (`url`);

--
-- Индексы таблицы `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `presidents`
--
ALTER TABLE `presidents`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_survey_id_foreign` (`survey_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Индексы таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sub_pages`
--
ALTER TABLE `sub_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_pages_page_id_sort_index` (`page_id`,`sort`);

--
-- Индексы таблицы `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task_items`
--
ALTER TABLE `task_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_items_task_id_foreign` (`task_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `videos_position_index` (`position`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `leaders`
--
ALTER TABLE `leaders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `links`
--
ALTER TABLE `links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `management`
--
ALTER TABLE `management`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `news_images`
--
ALTER TABLE `news_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `news_tasks`
--
ALTER TABLE `news_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `presidents`
--
ALTER TABLE `presidents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `sub_pages`
--
ALTER TABLE `sub_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `task_items`
--
ALTER TABLE `task_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_gallery_id_foreign` FOREIGN KEY (`gallery_id`) REFERENCES `galleries` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news_images`
--
ALTER TABLE `news_images`
  ADD CONSTRAINT `news_images_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `news_tasks`
--
ALTER TABLE `news_tasks`
  ADD CONSTRAINT `news_tasks_news_id_foreign` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `news_tasks_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sub_pages`
--
ALTER TABLE `sub_pages`
  ADD CONSTRAINT `sub_pages_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `task_items`
--
ALTER TABLE `task_items`
  ADD CONSTRAINT `task_items_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
