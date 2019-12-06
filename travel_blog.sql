-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 06 2019 г., 19:02
-- Версия сервера: 10.4.8-MariaDB
-- Версия PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `travel_blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `crud_log`
--

CREATE TABLE `crud_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `method` varchar(100) NOT NULL,
  `record_key_name` varchar(50) NOT NULL,
  `record_id` int(10) UNSIGNED NOT NULL,
  `params` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `entries`
--

CREATE TABLE `entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `place` varchar(15) NOT NULL,
  `comments` varchar(50) NOT NULL,
  `img_url` varchar(70) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `gcmtokens`
--

CREATE TABLE `gcmtokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `token` varchar(250) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(6, '2016_06_01_000004_create_oauth_clients_table', 2),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('07ed2349b0aaf7bd409884a3630db1f8ab746e3249e5abb1fcc6b7d2e5f25cb94d9ed9e24332dd5c', 6, 2, NULL, '[]', 0, '2017-02-18 23:53:45', '2017-02-18 23:53:45', '2018-02-19 06:53:45'),
('16c3b91909aea9ec84c1237698b262424d498c177a18a400685636b055e3469d593798342ddc331f', 10, 2, NULL, '[]', 0, '2017-02-20 15:01:54', '2017-02-20 15:01:54', '2018-02-20 22:01:54'),
('16f2b91b1154756b8c10b96a8eca605f9219fad5649c873a79dd79e28a97457e139f5a450de55e06', 5, 2, NULL, '[]', 0, '2017-02-18 21:50:35', '2017-02-18 21:50:35', '2018-02-19 04:50:35'),
('251eac95450978e0c308bdc9519e84f2ca77dc2bf7c62e08f1ac2f9cf73f412d7d49711877a1ea10', 5, 2, NULL, '[]', 0, '2017-02-18 21:49:15', '2017-02-18 21:49:15', '2018-02-19 04:49:15'),
('340171543dcd648f6b98a4b24f764813906dac5485bef986cb6d67d528b394a053ddf4ea8ba0ef32', 5, 2, NULL, '[]', 0, '2017-02-18 21:45:16', '2017-02-18 21:45:16', '2018-02-19 04:45:16'),
('3bdd3b6943fc9928c5a40fd90f05e4bd330c3c7d64dbbc34175e628fed04e866ea50253b30738e9a', 9, 2, NULL, '[]', 0, '2017-02-20 15:01:36', '2017-02-20 15:01:36', '2018-02-20 22:01:36'),
('4765d224c9034ee8b2f5719cdcf6113d5e483bad10d47891769dc58cd775d7ffd650bbe1e727ea68', 1, 2, NULL, '[]', 0, '2017-02-04 01:29:24', '2017-02-04 01:29:24', '2018-02-04 08:29:24'),
('88c648294432513b1916b95a1c60f97a43c24430217aa551e26b66b2714ee5a8be80530b7adeb452', 8, 2, NULL, '[]', 0, '2017-02-18 22:40:40', '2017-02-18 22:40:40', '2018-02-19 05:40:40'),
('8f2e80300685ebe589e67a2e5460810ef4dca2c914e1b00fc8862b67b3691e3479bf000f7af16470', 2, 2, NULL, '[]', 0, '2017-02-14 16:01:06', '2017-02-14 16:01:06', '2018-02-14 23:01:06'),
('9cba2a7f7748cff3d77f0fbcd6bce87e31548196a81aa315d1ec97471aa1e5f9e5e68c4b93d84593', 5, 2, NULL, '[]', 0, '2017-02-18 21:08:30', '2017-02-18 21:08:30', '2018-02-19 04:08:30'),
('b052a1d3a8b16b6de4e2a30225e35f1d665143692e2f7d26d964f16235a6ecd54ed0e2291dace678', 1, 2, NULL, '[]', 0, '2017-02-04 00:31:46', '2017-02-04 00:31:46', '2018-02-04 07:31:46'),
('bf95f177895f696b49bb1fb8aaf9c2a3243e95ab7d1087cbbb91f0aa4bfa6fe4b284995d1540e5ce', 5, 2, NULL, '[]', 0, '2017-02-18 21:39:42', '2017-02-18 21:39:42', '2018-02-19 04:39:42'),
('cec04f340a6748aa9939f71518adc52b7a6e5f2b72829a17271ff493f864295c9f000132b10660aa', 5, 2, NULL, '[]', 0, '2017-02-18 21:44:45', '2017-02-18 21:44:45', '2018-02-19 04:44:45'),
('d78a772688e15b695840c59313da15dfcfb2030fe633bd7a55269888ef23b8a9a57b7aca7ee08ed4', 1, 2, NULL, '[]', 0, '2017-02-06 23:08:13', '2017-02-06 23:08:13', '2018-02-07 06:08:13'),
('da6c9ceac052b49d0180f64cf34c5ebd82ff171dada2cfd7eb4289ecbaf7034b0210f33cc3788ac5', 6, 2, NULL, '[]', 0, '2017-02-19 00:11:28', '2017-02-19 00:11:28', '2018-02-19 07:11:28'),
('f3fd82c668ff4985f64428664428bdc65c288f92d3356f3d54b755625bfff3620cc6ae6c3e6d7c37', 1, 2, NULL, '[]', 0, '2017-02-06 18:20:58', '2017-02-06 18:20:58', '2018-02-07 01:20:58'),
('f6218a431d44f0554a2a8dce47f019e6be8ca46371622f11c22d922d0140a0341e6d127aca2e8a66', 5, 2, NULL, '[]', 0, '2017-02-18 23:52:17', '2017-02-18 23:52:17', '2018-02-19 06:52:17');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Travel Blog Personal Access Client', 'CZfYalWn6s4GuMnmoh8EN1DSdpvkoxHUm0SapZth', 'http://localhost', 1, 0, 0, '2017-02-04 00:25:30', '2017-02-04 00:25:30'),
(2, NULL, 'Travel Blog Password Grant Client', '9KHx3WW04RF0Gf2msS7dsKkPOpg6DNeH9uu7OvJh', 'http://localhost', 0, 1, 0, '2017-02-04 00:25:30', '2017-02-04 00:25:30');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-02-04 00:25:30', '2017-02-04 00:25:30');

-- --------------------------------------------------------

--
-- Структура таблицы `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('033c1a5041a21d6dc8bae8865fbc06f02b6c6cede8773508db2bfed21491243417ce515ffd913d14', 'f3fd82c668ff4985f64428664428bdc65c288f92d3356f3d54b755625bfff3620cc6ae6c3e6d7c37', 0, '2018-02-07 01:20:58'),
('15de518d8894aecd73a19a947e4c5c9fb0c5c7993932e266ec89e1da2113651854c453872d47521c', 'f6218a431d44f0554a2a8dce47f019e6be8ca46371622f11c22d922d0140a0341e6d127aca2e8a66', 0, '2018-02-19 06:52:17'),
('1af276b4461404168f952a895d1ce3d2f261252bb435fb0ba7e4e41559a988c3013cdb1a957dfc47', '88c648294432513b1916b95a1c60f97a43c24430217aa551e26b66b2714ee5a8be80530b7adeb452', 0, '2018-02-19 05:40:40'),
('2816e8b3fa156668536e8d2822719e0465fc76d70c1be22e45d55ef31ffc672bd127362899f28546', '8f2e80300685ebe589e67a2e5460810ef4dca2c914e1b00fc8862b67b3691e3479bf000f7af16470', 0, '2018-02-14 23:01:06'),
('38796076671e9072eda1d80b9bcdccf046f08d29666d94da1d7be1079cae2c8539993931cac93446', '251eac95450978e0c308bdc9519e84f2ca77dc2bf7c62e08f1ac2f9cf73f412d7d49711877a1ea10', 0, '2018-02-19 04:49:16'),
('503ed588c784e0f747b54282bf29c604b1e8baddb8c6744c0e20278953feb9a3a6d6fe75182ea08e', '16c3b91909aea9ec84c1237698b262424d498c177a18a400685636b055e3469d593798342ddc331f', 0, '2018-02-20 22:01:54'),
('5f798f6fad28ec74578bd10c15db1c31ef26911a61770b9fe427a03e29aea0b4e7dbdca4bb44433d', '9cba2a7f7748cff3d77f0fbcd6bce87e31548196a81aa315d1ec97471aa1e5f9e5e68c4b93d84593', 0, '2018-02-19 04:08:30'),
('7e2a0af72f02eaba9d77d7791f2acbf16e112bc19849ab87f8143b6407c2f368f07ed0ecc4863c67', 'da6c9ceac052b49d0180f64cf34c5ebd82ff171dada2cfd7eb4289ecbaf7034b0210f33cc3788ac5', 0, '2018-02-19 07:11:28'),
('83b31f03a187bb1938e49c218e5651f785b4970d6f08d027ce33e365bfcf2f76fede01a17dae6503', 'cec04f340a6748aa9939f71518adc52b7a6e5f2b72829a17271ff493f864295c9f000132b10660aa', 0, '2018-02-19 04:44:45'),
('85ef18bec56b0e4c82f745239e6bbb62d32f8f95b617dfaafa8dd265b5137aea5e6fe1b883e7e40e', 'd78a772688e15b695840c59313da15dfcfb2030fe633bd7a55269888ef23b8a9a57b7aca7ee08ed4', 0, '2018-02-07 06:08:14'),
('88b00c7a3d56bb66e3b55fa825a759725c8bc7778ccce9caa3af0ad6fc4a9a9932e28b8c3e4631b0', '07ed2349b0aaf7bd409884a3630db1f8ab746e3249e5abb1fcc6b7d2e5f25cb94d9ed9e24332dd5c', 0, '2018-02-19 06:53:45'),
('9467779180e7c9257df4ca8ac0890fe7770dfe6149769a6e52020e7203827860a343281590d66de7', '16f2b91b1154756b8c10b96a8eca605f9219fad5649c873a79dd79e28a97457e139f5a450de55e06', 0, '2018-02-19 04:50:35'),
('94a68adf3a75a7ac11a44f86b766180b76e180f7eb6804ea9fb1f4e932ca506731627987b35a71c7', '340171543dcd648f6b98a4b24f764813906dac5485bef986cb6d67d528b394a053ddf4ea8ba0ef32', 0, '2018-02-19 04:45:16'),
('98ab657d6f573a542c4d72065fe4ab838c8f1ec652625405f01adb6d7938f04bad87195d342cf71a', 'bf95f177895f696b49bb1fb8aaf9c2a3243e95ab7d1087cbbb91f0aa4bfa6fe4b284995d1540e5ce', 0, '2018-02-19 04:39:42'),
('acef9d1430e0f0ddaa43dcc67b72c97f5b48ba4a90dc3141a920966d44ba97825917e20dafc04875', 'b052a1d3a8b16b6de4e2a30225e35f1d665143692e2f7d26d964f16235a6ecd54ed0e2291dace678', 0, '2018-02-04 07:31:46'),
('d4229ad4c560ecd511189c0ae93ae1d5d9b1c98f0ddae724e2db152f1625cf11691a6779ae5e8a54', '4765d224c9034ee8b2f5719cdcf6113d5e483bad10d47891769dc58cd775d7ffd650bbe1e727ea68', 0, '2018-02-04 08:29:24'),
('e076d8e73d6bb08cdc3a7fb3bc20a1e44cc5bea63ca34d796226bcec94aa125b4a263d1437e34ef0', '3bdd3b6943fc9928c5a40fd90f05e4bd330c3c7d64dbbc34175e628fed04e866ea50253b30738e9a', 0, '2018-02-20 22:01:37');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ruslan_aliyev_@hotmail.com', '$2y$10$0sLW/66oUYxsIi5kKH7pj.Pi3XZsy.rfjukChaZ4aExgXgFjp.qB6', '2017-02-18 17:15:26');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'normal',
  `social_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `type`, `social_id`) VALUES
(5, 'Ruslan', 'ruslan_aliyev_@hotmail.com', '$2y$10$vKPqDAcj/SodO44u6JYDkewI/z0ZykSrsvbJ8twUNH4PuRDXTO.MC', 'VWn61XrVrEyOBjXUZKS1wG0LPRkY0zuzAzc8OC8GOV2lIeXpxLCGh57MBKgY', '2017-02-18 15:14:27', '2017-02-18 15:14:27', 'normal', NULL),
(6, 'guest', 'guest@guest.com', '$2y$10$xZ.mZw18ALbg/BWdKfGIKO2HXObDpg4PPcq2TA6.B4xk9AgeGaDDm', NULL, '2017-05-20 21:58:45', '2017-05-20 21:58:45', 'normal', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `crud_log`
--
ALTER TABLE `crud_log`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `gcmtokens`
--
ALTER TABLE `gcmtokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created` (`created`),
  ADD KEY `token` (`token`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Индексы таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Индексы таблицы `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `crud_log`
--
ALTER TABLE `crud_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `gcmtokens`
--
ALTER TABLE `gcmtokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `entries`
--
ALTER TABLE `entries`
  ADD CONSTRAINT `user_entry` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
