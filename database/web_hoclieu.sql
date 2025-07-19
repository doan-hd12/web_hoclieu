-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th7 19, 2025 lúc 02:56 AM
-- Phiên bản máy phục vụ: 9.1.0
-- Phiên bản PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web_hoclieu`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `parent_id` bigint NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `document_id` bigint DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_comments_user` (`user_id`),
  KEY `fk_comments_document` (`document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `user_id`, `document_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 3, 'kj', '2025-05-11 07:03:45', '2025-05-11 07:03:45'),
(3, 0, 1, 3, 'kj', '2025-05-11 07:06:38', '2025-05-11 07:06:38'),
(6, 0, 1, 3, 'cx dc', '2025-05-11 07:10:19', '2025-05-11 07:10:19'),
(7, 6, 1, 3, 'zị hả', '2025-05-15 20:10:58', '2025-05-15 20:10:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint DEFAULT NULL,
  `subject_id` bigint DEFAULT NULL,
  `major_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_documents_user` (`user_id`),
  KEY `fk_documents_subject` (`subject_id`),
  KEY `fk_documents_major` (`major_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `documents`
--

INSERT INTO `documents` (`id`, `title`, `description`, `file_path`, `user_id`, `subject_id`, `major_id`, `created_at`, `updated_at`) VALUES
(1, 'fd', 'fd', 'documents/WFJL0A73l5MCsAtQe9lNg91fXLCayohq0AqHUcnd.txt', NULL, NULL, NULL, '2025-05-08 21:11:37', '2025-05-08 21:11:37'),
(2, 'df', 'df', 'documents/UjRCrrVahJSkYXc2CCyF3QxJGQlLFetxeaQBGOCl.txt', NULL, NULL, 1, '2025-05-08 21:35:03', '2025-05-16 02:11:02'),
(3, 'trí tuệ nhân tạo', 'Chủ đề TF-IDF', 'documents/IaqHm6Cnnejtf8D44et9YOVkutESXOekIcCS9UPQ.pdf', 2, NULL, 2, '2025-05-10 01:38:46', '2025-05-10 01:38:46'),
(4, 'file tính điểm cho hub', NULL, 'documents/2W6pMeR1QdwyYUStd1EHhcWLNGhT5daoZUgn602T.xlsx', 2, NULL, 1, '2025-05-10 02:04:05', '2025-05-10 02:04:05'),
(5, 'jk', NULL, 'documents/H7tW2ZNPyHhJ4hwBXyfiiUwof8pDo5Vai0fc3wMk.txt', NULL, NULL, 1, '2025-05-15 16:51:05', '2025-05-16 02:11:15'),
(6, 'TMDT', NULL, 'documents/GVv0aEbTYGJgr22JWwQcIYa6gpjYKurujqD05WxN.pdf', NULL, NULL, 2, '2025-05-15 16:53:38', '2025-05-16 02:11:28'),
(7, ' blockchain java', NULL, 'documents/5zDvBo3YxAPKwoMoSYHHULqwe9nPpnSCxoymvk1Q.pdf', 1, NULL, 2, '2025-05-15 17:13:20', '2025-05-16 01:22:00'),
(8, 'tin học ứng dụng', NULL, 'documents/F5bkuVFB7P0kKSv2W073hn4vHf6c2aSFAjbX1jjv.pdf', 1, NULL, 1, '2025-05-15 17:15:38', '2025-05-15 17:15:38'),
(9, 'mẫu báo cáo', NULL, 'documents/8JwR9vbmh2DYHAggismpky0EX5pSEoyYgal3yscF.docx', 1, NULL, 1, '2025-05-16 01:22:27', '2025-05-16 01:22:27'),
(10, 'vstep', NULL, 'documents/oZGiuywWyaALwZxzPVCiGY5FcUrFkpimRjBWQ6NA.pdf', 1, NULL, 6, '2025-05-18 18:12:40', '2025-05-18 18:12:40'),
(11, 'vstep- đề 07.12.2024', NULL, 'documents/hU85kXcK56cMF9WIjSyAx9weKINFfSHP7ljBmTG3.pdf', 1, NULL, 6, '2025-05-18 18:13:38', '2025-05-18 18:13:38'),
(12, 'vstep- đề 09.11.2024', NULL, 'documents/FMKcdQ6BFV4Py4cN5N2mSTguXCtJP9XymKnLfQRb.pdf', 1, NULL, 6, '2025-05-18 18:14:06', '2025-05-18 18:14:06'),
(14, 'hình nền yên tĩnh', NULL, 'documents/QGFudiX5QLbcnjsWzx94ywoHyZ6gxjpEesTv1p2h.jpg', 1, NULL, 1, '2025-05-20 01:16:11', '2025-05-20 01:16:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `downloads`
--

DROP TABLE IF EXISTS `downloads`;
CREATE TABLE IF NOT EXISTS `downloads` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint DEFAULT NULL,
  `document_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_downloads_user` (`user_id`),
  KEY `fk_downloads_document` (`document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `downloads`
--

INSERT INTO `downloads` (`id`, `user_id`, `document_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 3, '2025-05-11 06:16:24', '2025-05-11 06:16:24'),
(2, NULL, 3, '2025-05-11 06:17:47', '2025-05-11 06:17:47'),
(3, 1, 8, '2025-05-15 18:45:50', '2025-05-15 18:45:50'),
(4, 1, 7, '2025-05-15 22:37:22', '2025-05-15 22:37:22'),
(5, 1, 9, '2025-05-16 01:22:41', '2025-05-16 01:22:41'),
(6, 1, 2, '2025-05-18 18:10:28', '2025-05-18 18:10:28'),
(7, 1, 12, '2025-05-18 18:16:08', '2025-05-18 18:16:08'),
(8, 1, 14, '2025-05-20 01:16:23', '2025-05-20 01:16:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `majors`
--

DROP TABLE IF EXISTS `majors`;
CREATE TABLE IF NOT EXISTS `majors` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_anh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `majors`
--

INSERT INTO `majors` (`id`, `name`, `file_anh`, `created_at`, `updated_at`) VALUES
(1, 'khác', 'khac-biet.jpg', '2025-05-09 04:09:29', '2025-05-09 14:10:20'),
(2, 'Công nghệ thông tin', 'cong-nghe-thong-tin.jpg', '2025-05-09 04:09:29', '2025-05-09 14:08:58'),
(3, 'Tài chính – Ngân hàng', 'nganh-tai-chinh-ngan-hang-bao-hiem.jpg', '2025-05-09 04:09:29', '2025-05-09 14:09:21'),
(4, 'Kế toán – Kiểm toán', 'ke-toan-kiem-toan1.jpg', '2025-05-09 04:09:29', '2025-05-09 14:09:36'),
(5, 'Y đa khoa', 'Ngành-y-đa-khoa.jpg', '2025-05-09 04:09:29', '2025-05-09 14:06:52'),
(6, 'Ngôn ngữ', 'nganh-ngon-ngu-anh-1.jpg', '2025-05-09 04:09:29', '2025-05-09 14:14:50'),
(7, 'Kỹ thuật điện – điện tử', 'Ky-thuat-dien-tu-vien-thong-ptit-2-min.jpg', '2025-05-09 04:09:29', '2025-05-09 14:09:58'),
(8, 'Marketing', 'marketing.jpg', '2025-05-09 04:09:29', '2025-05-09 14:07:48'),
(9, 'Sư phạm', 'su_pham.jpg', '2025-05-09 04:09:29', '2025-05-09 14:06:02'),
(10, 'Luật ', 'luat.jpg', '2025-05-09 04:09:29', '2025-05-09 14:14:38'),
(11, 'Quản trị kinh doanh', 'quan_tri_kinh_doanh.jpg', '2025-05-09 14:10:57', '2025-05-09 14:13:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('doan.hd1210@gmail.com', '$2y$12$tJbUIIQ8cAa8qCCinM/v4uw2DbrOlGcna3W924r1dlDOXHWktKBJy', '2025-05-16 07:31:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `document_id` bigint NOT NULL,
  `rating` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_document_unique` (`user_id`,`document_id`),
  KEY `fk_ratings_document` (`document_id`)
) ;

--
-- Đang đổ dữ liệu cho bảng `ratings`
--

INSERT INTO `ratings` (`id`, `user_id`, `document_id`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 2, '2025-05-11 07:06:38', '2025-05-11 07:10:19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subjects`
--

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE IF NOT EXISTS `subjects` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `major_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_subjects_major` (`major_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `phone` bigint DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_blocked` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `full_name`, `email`, `password`, `role`, `phone`, `photo`, `is_blocked`, `created_at`, `updated_at`) VALUES
(1, 'doan', 'đoàn điên', 'doan.hd1210@gmail.com', '$2y$12$CACRJET3Ew1rCK.gZDZbYexFxTDmlqI0/FnLk1c7RT1ev5zZ5lRaW', 'admin', 123456789, '1.jpg', 0, '2025-05-06 22:34:59', '2025-05-28 11:37:54'),
(2, 'Đoàn Hoàng', NULL, 'doanhoang0304@gmail.com', '$2y$12$D3iFX.2o2OFVMaewDHR2rujnPZq/9cf1TnwonWuLrvieV/IcuiAzC', 'user', 0, '2.jpg', 0, '2025-05-07 01:35:55', '2025-05-20 08:29:57');

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_document` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comments_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `fk_documents_major` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_documents_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_documents_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Các ràng buộc cho bảng `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `fk_downloads_document` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_downloads_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_ratings_document` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ratings_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `fk_subjects_major` FOREIGN KEY (`major_id`) REFERENCES `majors` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
