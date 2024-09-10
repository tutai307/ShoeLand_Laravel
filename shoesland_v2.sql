-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2024 at 05:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoesland_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` char(36) NOT NULL,
  `user_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
('b709d140-c852-4d2c-9141-d3f55574bff7', '9cd0016d-81b9-4122-8d61-b532608d9c4c', '2024-08-26 19:24:04', '2024-09-08 19:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` char(36) NOT NULL,
  `cart_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `size_id` char(36) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` char(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `description`, `created_at`, `updated_at`, `image`) VALUES
('09c0f6f1-5243-46d8-8730-163e41db778b', 'ADIDAS', 'Adidas', 'Giày Adidas là một dòng sản phẩm giày thể thao và thời trang của thương hiệu Adidas, một trong những nhãn hiệu nổi tiếng hàng đầu trên thế giới. Adidas đã tạo ra nhiều mẫu giày khác nhau, phục vụ nhu cầu của người tiêu dùng từ các hoạt động thể thao đến thời trang hàng ngày.', '2024-08-06 07:05:34', '2024-08-06 07:05:34', 'categories/5KCNxodfWkJoW4aozWzCwylaAknCvuV6BH5xTGtg.png'),
('2c4acfcd-ebcb-4516-a84d-801a34fddd3d', 'NIKE', 'Nike', 'Nike là một trong những thương hiệu thể thao nổi tiếng toàn cầu, được biết đến với việc sản xuất và phân phối đa dạng sản phẩm thể thao và thời trang', '2024-08-06 06:45:35', '2024-08-06 06:45:35', 'categories/L6LOhyT57axmadbI5d9MDi9vhmKInn7vKkkqg2eI.jpg'),
('31d6942c-64dc-4bcf-b73b-5f1eb3ef99ec', 'PUMA', 'Puma', 'Puma là hãng giày nổi tiếng, với nhiều sản phẩm chất lượng cao phục vụ cho thể thao và thời trang.', '2024-08-15 20:11:16', '2024-08-15 20:11:16', 'categories/72wBCyjh4QjpY44EAKUk8D07B2P7MSakJyCphMbX.png'),
('40a51b61-7174-42ff-8cc6-4a015890ac68', 'NEW BALANCE', 'New Blance', 'Giày New Balance là sản phẩm của thương hiệu giày thể thao New Balance, một trong những nhãn hiệu nổi tiếng và đáng tin cậy trên thế giới.', '2024-08-06 07:04:22', '2024-08-06 07:04:22', 'categories/at27ISKapvbdOjNnQxsgWPrF8UFEnJVOqhbV1T9Q.png'),
('486dc563-f356-4442-ae99-264cdc433c1d', 'CONVERSE', 'Converse', 'Giày Converse là những đôi giày thể thao mang đậm phong cách retro và văn hóa đô thị. Dòng giày nổi tiếng nhất của Converse là Chuck Taylor All Star, một biểu tượng thời trang đã tồn tại từ những năm 1920 và trở thành một trong những mẫu giày phổ biến nhất trên thế giới.', '2024-08-05 01:32:17', '2024-08-06 01:15:57', 'categories/MnqbLSqQtKfGtDyixpPuRABGoH4Fy7yJlsK1B7HH.png'),
('560b6027-d8e8-45fa-aaa9-6a6ce2d5c640', 'VANS', 'VAN', 'Vans là một thương hiệu giày và thời trang đường phố nổi tiếng, xuất phát từ California, Hoa Kỳ. Đặc biệt là với dòng giày skate và lifestyle.', '2024-08-06 06:46:33', '2024-08-06 06:46:33', 'categories/HZA16bSEiFGgOY28Cv4btLZkSKbTXivtoTggoKyx.png'),
('b440ee26-5cbc-43c4-9d91-7c66fe4c6e22', 'MLB', 'Mlb', 'Mẫu giày được ưa chuộng trong giới baseball, được sử dụng trong các trận đấu Major League Baseball (MLB) hoặc được thiết kế với phong cách và ý tưởng liên quan đến bóng chày.', '2024-08-06 07:07:15', '2024-08-06 07:07:15', 'categories/r4zvN6jPiwJaO65UYfXyTPKnBHKpxy0OTRJbZlZq.png'),
('b69e4a88-b999-491a-926a-060254ecc0f3', 'JORDAN', 'Jordan', 'Giày Jordan là một dòng sản phẩm giày thể thao và thời trang của thương hiệu Jordan Brand, một phần của tập đoàn Nike. Dòng giày này được đặt tên theo huyền thoại bóng rổ Michael Jordan, người đã trở thành một trong những cầu thủ xuất sắc nhất trong lịch sử môn thể thao này.', '2024-08-06 01:17:10', '2024-08-06 01:19:05', 'categories/CeTRiIBEikxkftnmEzi1Ip1qT4G67tMkT79EBtEa.png');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` char(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `discount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `code`, `name`, `start_date`, `end_date`, `discount`, `created_at`, `updated_at`, `image`, `description`) VALUES
('1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f', 'EV5', 'Summer Sale', '2024-08-15 00:00:00', '2024-09-01 00:00:00', 25, '2024-08-08 01:08:11', '2024-08-08 01:19:36', 'events/fH9Vxp2lQiecLdzfd7gwf5Cf3b7LfkTforYw4CkD.png', 'Giảm giá mùa hè lên đến 25%, mua 1 tặng 1.'),
('2b3c4d5e-2b3c-2b3c-2b3c-2b3c4d5e6f7g', 'EV6', 'Back to School', '2024-08-10 00:00:00', '2024-09-10 00:00:00', 20, '2024-08-08 01:08:11', '2024-08-19 09:47:00', 'events/OZBmkBaRA1OcD2MrR5djkyPj2t9zip4yUHLIknde.jpg', 'Khuyến mãi mùa tựu trường, giảm đến 20%.'),
('2df4098f-cb49-4ecb-8590-deedfc671491', 'EV1', 'Ưu đãi tháng 10', '2024-08-08 00:00:00', '2024-09-07 00:00:00', 20, '2024-08-06 08:47:11', '2024-09-02 20:09:43', 'events/G64DXC1oCViFKsbWtMnTVeIuzdaAuuuB1zJUgQIe.png', 'Sự kiện giảm giá và khuyến mãi đặc biệt cho mùa đông đã tới.'),
('3c4d5e6f-3c4d-3c4d-3c4d-3c4d5e6f7g8h', 'EV7', 'Winter Sale', '2024-11-01 00:00:00', '2024-11-30 00:00:00', 35, '2024-08-08 01:08:11', '2024-08-08 01:19:01', 'events/HibDKX6znWK64HejvuUD39kKpfEuDXrRlu9FkZ7E.png', 'Giảm giá mùa đông, giảm đến 35%.'),
('4d5e6f7g-4d5e-4d5e-4d5e-4d5e6f7g8h9i', 'EV8', 'Black Friday', '2024-11-25 00:00:00', '2024-12-01 00:00:00', 50, '2024-08-08 01:08:11', '2024-08-08 01:19:50', 'events/iTUlkip3exMTkKam05pABO26vgRmsUlWMg1eiPqK.png', 'Siêu khuyến mãi Black Friday, giảm đến 50%.'),
('71616918-7c51-4734-a061-1e956823f553', 'EV2', 'Chương trình mua giày cặp đôi', '2024-08-08 00:00:00', '2024-10-04 00:00:00', 15, '2024-08-08 01:04:57', '2024-09-02 20:09:57', 'events/N8kNVDzNdovn5TJqMgUaWVlPo73oV43pxPoM0FH0.png', 'Khách hàng là cặp đôi sẽ nhận về ưu đãi, giảm giá và quà tặng giá trị.'),
('8bb81fcb-6c8d-4a61-8e50-5f096b9de88c', 'EV4', 'Flash Sale', '2024-08-08 00:00:00', '2024-08-31 00:00:00', 30, '2024-08-08 01:08:11', '2024-08-08 01:08:11', 'events/xI0g3dLEzjQtVPTpmL2nyseGoqvAemfSa9CEsPs6.png', 'Sale giá sốc-giảm đến 30%, freeship từ 2 đôi.'),
('c080d0d0-42d1-4198-ba81-83eaca22df39', 'EV3', 'Mua càng nhiều giảm càng nhiều', '2024-08-08 00:00:00', '2024-08-31 00:00:00', 15, '2024-08-08 01:06:23', '2024-08-08 01:06:23', 'events/zQeWsKGButvBgm6akLmc8U3BxcTfYoy1lz3GkvRA.png', 'Mua từ 3 đôi trở lên nhận giảm giá cực sốc.');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_01_021329_create_categories_table', 1),
(6, '2024_08_01_021625_create_events_table', 1),
(7, '2024_08_01_021716_create_products_table', 1),
(8, '2024_08_05_004844_add_image_to_categories_table', 2),
(9, '2024_08_05_005642_add_image_to_categories_table', 3),
(10, '2024_08_06_150014_add_image_to_events_table', 4),
(11, '2024_08_06_150312_update_events_table_set_uuid_primary_key', 5),
(12, '2024_08_06_152504_add_code_to_events_table', 6),
(13, '2024_08_06_152814_add_code_to_events_table', 7),
(14, '2024_08_08_083434_create_sizes_table', 8),
(15, '2024_08_09_031808_create_product_images_table', 9),
(16, '2024_08_19_135600_create_product_sizes_table', 10),
(18, '2024_08_20_084127_add_google_id_to_users_table', 11),
(20, '2024_08_26_075504_create_carts_table', 12),
(21, '2024_08_26_075558_create_cart_items_table', 12),
(23, '2024_09_01_134756_create_statuses_table', 13),
(24, '2024_09_01_145010_create_payments_table', 13),
(25, '2024_09_01_154825_add_role_to_users_table', 14),
(26, '2024_09_04_013140_create_orders_table', 15),
(27, '2024_09_04_014024_create_order_items_table', 16),
(28, '2024_09_07_064506_add_uuid_to_order_items_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` char(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `user_id` char(36) NOT NULL,
  `status_id` char(36) NOT NULL,
  `receive_phone` varchar(255) DEFAULT NULL,
  `receive_address` varchar(255) DEFAULT NULL,
  `delivery_cost` decimal(10,2) DEFAULT NULL,
  `payment_id` char(36) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `code`, `user_id`, `status_id`, `receive_phone`, `receive_address`, `delivery_cost`, `payment_id`, `description`, `created_at`, `updated_at`) VALUES
('9cf39436-3b12-4f37-b4b1-c31a95d84a2b', '20240907C592', '9ccffe6a-c7a1-4392-9c93-b64757665078', '33c397a4-6523-4e4b-b011-b0a025b68f81', '0971923203', 'Phường Quang Trung, Thành phố Hà Giang, Tỉnh Hà Giang', 30000.00, 'ec6d2cc6-466d-4157-a9b7-2bd9af79fdb2', NULL, '2024-09-07 02:02:55', '2024-09-09 20:31:05'),
('9cf70cc7-0c18-4373-a8bc-9364d18ee2f4', '202409095C92', '9cd0016d-81b9-4122-8d61-b532608d9c4c', 'd122f2e1-0c43-4c9a-a490-853601297840', '0971923203', 'Xã Cần Yên, Huyện Hà Quảng, Tỉnh Cao Bằng', 30000.00, 'ec6d2cc6-466d-4157-a9b7-2bd9af79fdb2', NULL, '2024-09-08 19:27:32', '2024-09-08 20:17:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `size_id` char(36) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_id`, `product_id`, `size_id`, `quantity`, `unit_price`, `created_at`, `updated_at`, `id`) VALUES
('9cf70cc7-0c18-4373-a8bc-9364d18ee2f4', 'a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', '28012001-556a-11ef-acc5-f8da0c52c1d8', 1, 2900000.00, '2024-09-08 19:27:33', '2024-09-08 19:27:33', '0f7223b2-7005-4979-8378-7219b78a04f9'),
('9cf39436-3b12-4f37-b4b1-c31a95d84a2b', 'c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', '28012001-556a-11ef-acc5-f8da0c52c1d8', 1, 2600000.00, '2024-09-07 02:02:55', '2024-09-07 02:02:55', '26668010-cc5c-4a9b-b89e-7e99bd919171'),
('9cf70cc7-0c18-4373-a8bc-9364d18ee2f4', 'c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', '28012001-556a-11ef-acc5-f8da0c52c1d8', 1, 2600000.00, '2024-09-08 19:27:33', '2024-09-08 19:27:33', 'ff6e6090-0dc0-46d1-a106-973a0beae30f');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` char(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `code`, `name`, `description`, `created_at`, `updated_at`) VALUES
('3ccd33af-44a3-446e-9313-74ba0ea029ab', '#ATM', 'Thanh toán ATM MoMo', 'Người mua có thể chuyển tiền trực tiếp từ tài khoản ngân hàng của họ sang tài khoản của người bán. Phương thức này thường được sử dụng cho các giao dịch lớn và trực tuyến.', '2024-09-01 08:27:17', '2024-09-05 03:36:48'),
('ec6d2cc6-466d-4157-a9b7-2bd9af79fdb2', '#TM', 'Thanh toán khi nhận được hàng', 'Thanh toán trực tiếp bằng tiền mặt là một phương thức phổ biến, đặc biệt là trong các giao dịch hàng ngày, mua sắm tại cửa hàng truyền thống hoặc chợ.', '2024-09-01 08:20:19', '2024-09-08 19:25:16');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` char(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `category_id` char(36) NOT NULL,
  `event_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `description`, `price`, `category_id`, `event_id`, `created_at`, `updated_at`) VALUES
('a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', 'AD01', 'Adidas Ultraboost 21', 'Giày chạy bộ Adidas Ultraboost 21 với công nghệ Boost mang lại sự êm ái và đàn hồi cao.', 3500000, '09c0f6f1-5243-46d8-8730-163e41db778b', '2df4098f-cb49-4ecb-8590-deedfc671491', NULL, '2024-09-02 19:57:15'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', 'VN02', 'Vans Slip-On', 'Vans Slip-On với thiết kế đơn giản và dễ dàng mang vào, phù hợp cho phong cách thường ngày và sự tiện lợi.', 750000, '560b6027-d8e8-45fa-aaa9-6a6ce2d5c640', '2b3c4d5e-2b3c-2b3c-2b3c-2b3c4d5e6f7g', NULL, NULL),
('a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', 'AD02', 'Adidas NMD_R1', 'Giày thể thao Adidas NMD_R1 với thiết kế năng động và đế Boost êm ái.', 2900000, '09c0f6f1-5243-46d8-8730-163e41db778b', '2b3c4d5e-2b3c-2b3c-2b3c-2b3c4d5e6f7g', NULL, NULL),
('b3c4d5e6-f7g8-9h0i-1j2k-l345678m', 'VN03', 'Vans Authentic', 'Vans Authentic với thiết kế cổ điển và chất liệu vải bông, mang lại sự thoải mái và phong cách trẻ trung.', 700000, '560b6027-d8e8-45fa-aaa9-6a6ce2d5c640', '2df4098f-cb49-4ecb-8590-deedfc671491', NULL, NULL),
('b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', 'AD03', 'Adidas Yeezy Boost 350 V2', 'Adidas Yeezy Boost 350 V2, sản phẩm giới hạn với thiết kế tinh tế và đế Boost êm ái.', 5500000, '09c0f6f1-5243-46d8-8730-163e41db778b', '2df4098f-cb49-4ecb-8590-deedfc671491', NULL, NULL),
('c4d5e6f7-g8h9-0i1j-2k3l-m456789n', 'VN04', 'Vans Sk8-Hi', 'Vans Sk8-Hi với thiết kế cổ cao và chất liệu da lộn, mang lại sự bền bỉ và phong cách mạnh mẽ.', 950000, '560b6027-d8e8-45fa-aaa9-6a6ce2d5c640', '3c4d5e6f-3c4d-3c4d-3c4d-3c4d5e6f7g8h', NULL, NULL),
('c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', 'AD04', 'Adidas Stan Smith', 'Adidas Stan Smith, một đôi giày cổ điển với thiết kế đơn giản và sang trọng.', 2600000, '09c0f6f1-5243-46d8-8730-163e41db778b', '3c4d5e6f-3c4d-3c4d-3c4d-3c4d5e6f7g8h', NULL, NULL),
('d5e6f7g8-h9i0-1j2k-3l4m-n567890o', 'VN05', 'Vans Era', 'Vans Era với thiết kế thể thao và chất liệu vải bông, phù hợp cho phong cách thời trang và hoạt động hàng ngày.', 850000, '560b6027-d8e8-45fa-aaa9-6a6ce2d5c640', '4d5e6f7g-4d5e-4d5e-4d5e-4d5e6f7g8h9i', NULL, NULL),
('d5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', 'AD05', 'Adidas Supernova', 'Giày chạy bộ Adidas Supernova với đế Boost cải tiến và thiết kế hiện đại.', 3000000, '09c0f6f1-5243-46d8-8730-163e41db778b', '4d5e6f7g-4d5e-4d5e-4d5e-4d5e6f7g8h9i', NULL, NULL),
('e1f2g3h4-i5j6-7k8l-9m0n-o123456p', 'ML01', 'MLB Basic Sneakers', 'MLB Basic Sneakers với thiết kế đơn giản và hiện đại, chất liệu cao cấp đảm bảo sự thoải mái và độ bền.', 1200000, 'b440ee26-5cbc-43c4-9d91-7c66fe4c6e22', '1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f', NULL, NULL),
('f2g3h4i5-j6k7-8l9m-0n1o-p234567q', 'ML02', 'MLB Runner', 'MLB Runner với thiết kế thể thao và đế cao su bám tốt, lý tưởng cho các hoạt động thể thao và chạy bộ.', 1300000, 'b440ee26-5cbc-43c4-9d91-7c66fe4c6e22', '2b3c4d5e-2b3c-2b3c-2b3c-2b3c4d5e6f7g', NULL, NULL),
('g3h4i5j6-k7l8-9m0n-1o2p-3456789r', 'ML03', 'MLB High Top', 'MLB High Top với thiết kế cổ cao và chất liệu da cao cấp, mang lại sự hỗ trợ và phong cách mạnh mẽ.', 1400000, 'b440ee26-5cbc-43c4-9d91-7c66fe4c6e22', '2df4098f-cb49-4ecb-8590-deedfc671491', NULL, NULL),
('g8h9i0j1-k2l3-4m5n-6o7p-qrstuvw8', 'AD08', 'Adidas EQT Support ADV', 'Adidas EQT Support ADV với thiết kế thời trang và công nghệ hỗ trợ chân tuyệt vời.', 3100000, '09c0f6f1-5243-46d8-8730-163e41db778b', '71616918-7c51-4734-a061-1e956823f553', NULL, NULL),
('h4i5j6k7-l8m9-0n1o-2p3q-4567890s', 'ML04', 'MLB Classic', 'MLB Classic với thiết kế retro và chất liệu vải bông, phù hợp cho phong cách thời trang và sự tiện lợi hàng ngày.', 1000000, 'b440ee26-5cbc-43c4-9d91-7c66fe4c6e22', '3c4d5e6f-3c4d-3c4d-3c4d-3c4d5e6f7g8h', NULL, NULL),
('h9i0j1k2-l3m4-5n6o-7p8q-rstuvw9x0', 'AD09', 'Adidas Samba', 'Giày Adidas Samba với thiết kế retro, phù hợp cho cả phong cách thể thao và hàng ngày.', 2800000, '09c0f6f1-5243-46d8-8730-163e41db778b', '8bb81fcb-6c8d-4a61-8e50-5f096b9de88c', NULL, NULL),
('i0j1k2l3-m4n5-6o7p-8q9r-stuvw0xy1', 'AD10', 'Adidas ZX 2K Boost', 'Adidas ZX 2K Boost, đôi giày mang lại sự thoải mái tối đa với thiết kế retro.', 3300000, '09c0f6f1-5243-46d8-8730-163e41db778b', 'c080d0d0-42d1-4198-ba81-83eaca22df39', NULL, NULL),
('i5j6k7l8-m9n0-1o2p-3q4r-5678901t', 'ML05', 'MLB Sporty', 'MLB Sporty với thiết kế năng động và chất liệu đệm tốt, lý tưởng cho các hoạt động thể thao và phong cách trẻ trung.', 1100000, 'b440ee26-5cbc-43c4-9d91-7c66fe4c6e22', '4d5e6f7g-4d5e-4d5e-4d5e-4d5e6f7g8h9i', NULL, NULL),
('k1l2m3n4-o5p6-7q8r-9s0t-uvwxyz1234a', 'NI01', 'Nike Air Max 270', 'Nike Air Max 270 với đệm Air Max lớn nhất từ trước đến nay, mang lại cảm giác thoải mái và hỗ trợ tốt cho mỗi bước đi của bạn.', 1400000, '2c4acfcd-ebcb-4516-a84d-801a34fddd3d', '1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f', NULL, NULL),
('l2m3n4o5-p6q7-8r9s-0t1u-vwxyz2345b', 'NI02', 'Nike React Infinity Run', 'Nike React Infinity Run với công nghệ React Foam giúp giảm chấn và mang lại sự thoải mái tuyệt vời cho các buổi chạy dài.', 1300000, '2c4acfcd-ebcb-4516-a84d-801a34fddd3d', '2b3c4d5e-2b3c-2b3c-2b3c-2b3c4d5e6f7g', NULL, NULL),
('l3m4n5o6-p7q8-9r0s-1t2u-v345678w', 'JD03', 'Air Jordan 6', 'Air Jordan 6 với thiết kế thể thao nổi bật và công nghệ Air-Sole, lý tưởng cho các hoạt động thể thao và phong cách hàng ngày.', 1300000, 'b69e4a88-b999-491a-926a-060254ecc0f3', '71616918-7c51-4734-a061-1e956823f553', NULL, NULL),
('m3n4o5p6-q7r8-9s0t-1u2v-wxyz3456c', 'NI03', 'Nike SB Dunk Low', 'Nike SB Dunk Low với thiết kế cổ điển và màu sắc tươi mới, phù hợp cho cả nhu cầu thể thao và phong cách thời trang.', 1100000, '2c4acfcd-ebcb-4516-a84d-801a34fddd3d', '2df4098f-cb49-4ecb-8590-deedfc671491', NULL, NULL),
('m4n5o6p7-q8r9-0s1t-2u3v-w456789x', 'JD04', 'Air Jordan 11', 'Air Jordan 11 với thiết kế sang trọng và công nghệ đệm hiệu suất cao, mang lại sự thoải mái và phong cách cao cấp.', 1500000, 'b69e4a88-b999-491a-926a-060254ecc0f3', '8bb81fcb-6c8d-4a61-8e50-5f096b9de88c', NULL, NULL),
('n4o5p6q7-r8s9-0t1u-2v3w-xyz4567d', 'NI04', 'Nike Air Zoom Pegasus 38', 'Nike Air Zoom Pegasus 38 với công nghệ Air Zoom và đệm Cushlon, mang lại sự hỗ trợ và thoải mái cho mọi hoạt động chạy bộ.', 1200000, '2c4acfcd-ebcb-4516-a84d-801a34fddd3d', '3c4d5e6f-3c4d-3c4d-3c4d-3c4d5e6f7g8h', NULL, NULL),
('n5o6p7q8-r9s0-1t2u-3v4w-x567890y', 'JD05', 'Air Jordan 13', 'Air Jordan 13 với thiết kế thể thao và chất liệu da cao cấp, mang lại sự thoải mái và phong cách thể thao hiện đại.', 1400000, 'b69e4a88-b999-491a-926a-060254ecc0f3', 'c080d0d0-42d1-4198-ba81-83eaca22df39', NULL, NULL),
('o5p6q7r8-s9t0-1u2v-3w4x-yz123456e', 'NI05', 'Nike Free RN 5.0', 'Nike Free RN 5.0 với thiết kế linh hoạt và nhẹ nhàng, lý tưởng cho các buổi chạy ngắn hoặc tập luyện trong phòng gym.', 1000000, '2c4acfcd-ebcb-4516-a84d-801a34fddd3d', '4d5e6f7g-4d5e-4d5e-4d5e-4d5e6f7g8h9i', NULL, NULL),
('r3s4t5u6-v7w8-9x0y-1z2a-3456789h', 'NB03', 'New Balance 574', 'New Balance 574, mẫu giày thể thao với thiết kế retro và chất liệu da cao cấp, phù hợp cho phong cách hàng ngày.', 900000, '40a51b61-7174-42ff-8cc6-4a015890ac68', '71616918-7c51-4734-a061-1e956823f553', NULL, NULL),
('s4t5u6v7-w8x9-0y1z-2a3b-456789i0', 'NB04', 'New Balance 1080v10', 'New Balance 1080v10 với đệm Fresh Foam và thiết kế hiện đại, cung cấp sự thoải mái và hỗ trợ tốt nhất cho người dùng.', 1300000, '40a51b61-7174-42ff-8cc6-4a015890ac68', '8bb81fcb-6c8d-4a61-8e50-5f096b9de88c', NULL, NULL),
('t5u6v7w8-x9y0-1z2a-3b4c-567890j1', 'NB05', 'New Balance 860v11', 'New Balance 860v11 với thiết kế hỗ trợ và giảm chấn cao cấp, thích hợp cho các hoạt động chạy bộ và tập luyện cường độ cao.', 1200000, '40a51b61-7174-42ff-8cc6-4a015890ac68', 'c080d0d0-42d1-4198-ba81-83eaca22df39', NULL, NULL),
('u1v2w3x4-y5z6-7a8b-9c0d-ef123456g', 'CO01', 'Converse Chuck Taylor All Star', 'Converse Chuck Taylor All Star với thiết kế cổ điển và chất liệu vải bông thoáng khí, phù hợp với nhiều phong cách khác nhau.', 700000, '486dc563-f356-4442-ae99-264cdc433c1d', '1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f', NULL, NULL),
('v2w3x4y5-z6a7-8b9c-0d1e-f2345678h', 'CO02', 'Converse One Star Pro', 'Converse One Star Pro với thiết kế phong cách và đế cao su bám tốt, lý tưởng cho các hoạt động thể thao và phong cách thời trang.', 800000, '486dc563-f356-4442-ae99-264cdc433c1d', '2b3c4d5e-2b3c-2b3c-2b3c-2b3c4d5e6f7g', NULL, NULL),
('w3x4y5z6-a7b8-9c0d-1e2f-3456789i', 'CO03', 'Converse Jack Purcell', 'Converse Jack Purcell với thiết kế đơn giản và thanh lịch, chất liệu da và vải bền bỉ, phù hợp cho phong cách hàng ngày.', 750000, '486dc563-f356-4442-ae99-264cdc433c1d', '2df4098f-cb49-4ecb-8590-deedfc671491', NULL, NULL),
('x4y5z6a7-b8c9-0d1e-2f3g-456789j0', 'CO04', 'Converse Chuck 70', 'Converse Chuck 70 với đế cao su cổ điển và chất liệu vải bông dày, mang lại sự bền bỉ và phong cách thời trang retro.', 900000, '486dc563-f356-4442-ae99-264cdc433c1d', '3c4d5e6f-3c4d-3c4d-3c4d-3c4d5e6f7g8h', NULL, NULL),
('y5z6a7b8-c9d0-1e2f-3g4h-567890j1', 'CO05', 'Converse Pro Leather', 'Converse Pro Leather với thiết kế thể thao cổ điển và chất liệu da cao cấp, phù hợp cho cả hoạt động thể thao và phong cách hàng ngày.', 950000, '486dc563-f356-4442-ae99-264cdc433c1d', '4d5e6f7g-4d5e-4d5e-4d5e-4d5e6f7g8h9i', NULL, NULL),
('z1a2b3c4-d5e6-7f8g-9h0i-j123456k', 'VN01', 'Vans Old Skool', 'Vans Old Skool với thiết kế cổ điển và chất liệu da lộn, mang lại phong cách thời trang và sự thoải mái cho người dùng.', 800000, '560b6027-d8e8-45fa-aaa9-6a6ce2d5c640', '1a2b3c4d-1a2b-1a2b-1a2b-1a2b3c4d5e6f', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` char(36) NOT NULL,
  `product_id` char(36) NOT NULL,
  `content` varchar(255) NOT NULL,
  `mainImage` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `content`, `mainImage`, `created_at`, `updated_at`) VALUES
('0106f2b9-d6a1-41f4-907c-23378bbaac6e', 'h9i0j1k2-l3m4-5n6o-7p8q-rstuvw9x0', 'https://tyhisneaker.com/wp-content/uploads/2022/09/6ec6a3980ab6cfe896a7.jpeg', 0, '2024-08-12 22:39:52', '2024-08-12 22:39:52'),
('05457323-cd57-49b9-bc25-1c3a98174529', 'c4d5e6f7-g8h9-0i1j-2k3l-m456789n', 'https://tyhisneaker.com/wp-content/uploads/2022/10/z3792855521178_f252498eabb9232c57ea7b35cb782846.jpg', 0, '2024-08-12 22:55:52', '2024-08-12 22:55:52'),
('0603fee7-5637-4349-a15e-a9498b2167b7', 'u1v2w3x4-y5z6-7a8b-9c0d-ef123456g', 'https://tyhisneaker.com/wp-content/uploads/2023/05/giay-converse-unisex-chuck-70-plus-1.jpeg', 0, '2024-08-14 07:51:54', '2024-08-14 07:51:54'),
('06b713ff-a6de-45e0-9dcb-1963f04187bc', 'x4y5z6a7-b8c9-0d1e-2f3g-456789j0', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-converse-chuck-taylor-all-star-1970s-white-high-trang-co-cao-10.jpg', 0, '2024-08-14 07:55:16', '2024-08-14 07:55:16'),
('071000f7-ed62-4e17-8e49-cd5b55bdd225', 'e1f2g3h4-i5j6-7k8l-9m0n-o123456p', 'https://tyhisneaker.com/wp-content/uploads/2024/03/giay-mlb-chunky-liner-mid-monogram-ny-yankees-black-3asxcmm4n-50bks-2.jpeg', 0, '2024-08-12 23:13:40', '2024-08-12 23:13:40'),
('076e7c22-ef25-41a8-a0c9-159f00181991', 'a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-adidas-ultra-boost-20-dash-grey-rep-11-dep-chat-1.jpg', 1, '2024-08-12 22:21:37', '2024-08-12 22:21:37'),
('08bb97fb-0095-441e-93bc-19188b40d2bb', 'g3h4i5j6-k7l8-9m0n-1o2p-3456789r', 'https://tyhisneaker.com/wp-content/uploads/2022/11/mlb-bigball-chunky-mono-lt-new-york-yankees-ivory-3ashcm01n-50ivs-1-a75a15d1b4e84812be3d0309d20adf3b.webp', 1, '2024-08-12 23:15:17', '2024-08-12 23:15:21'),
('0955eb03-1356-49f5-bf16-c8e248da6bf8', 'd5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', 'https://tyhisneaker.com/wp-content/uploads/2023/02/Gia%CC%80y-Cha%CC%A3y-Bo%CC%A3%CC%82-Adidas-EQT-Bost-2023-LikeAuth--scaled.jpeg', 0, '2024-08-12 22:28:37', '2024-08-12 22:28:37'),
('0c8d3825-b147-4498-b336-7bf7e8565a7d', 'l2m3n4o5-p6q7-8r9s-0t1u-vwxyz2345b', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-air-jordan-1-low-se-reverse-ice-blue-w-like-auth-1.jpg', 1, '2024-08-12 22:44:54', '2024-08-12 22:44:54'),
('0e478b03-d6c5-4492-aacb-490166bb5c15', 'n5o6p7q8-r9s0-1t2u-3v4w-x567890y', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-jordan-1-retro-low-og-zion-williamson-voodoo-1.jpg', 0, '2024-08-12 23:03:18', '2024-08-12 23:03:18'),
('10427300-3bba-46b3-9bee-b4b78f6a3814', 'i0j1k2l3-m4n5-6o7p-8q9r-stuvw0xy1', 'https://tyhisneaker.com/wp-content/uploads/2022/08/f6bc1c787056b508ec47.jpg', 0, '2024-08-12 22:40:47', '2024-08-12 22:40:47'),
('109c0b2f-2c42-4351-93cc-5a700c7996f5', 'b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', 'https://tyhisneaker.com/wp-content/uploads/2023/11/giay-adidas-yeezy-boost-350-v2-tail-light-fx9017-like-auth.jpeg', 0, '2024-08-12 22:25:12', '2024-08-12 22:25:12'),
('10c94ef9-3943-4534-931d-ce6d5f8d14f8', 'u1v2w3x4-y5z6-7a8b-9c0d-ef123456g', 'https://tyhisneaker.com/wp-content/uploads/2023/05/converse-unisex-chuck-70-plus.jpg', 1, '2024-08-14 07:51:41', '2024-08-14 07:51:41'),
('11ac39b1-856b-47a8-8ae2-4fc5a0e2b904', 'e1f2g3h4-i5j6-7k8l-9m0n-o123456p', 'https://tyhisneaker.com/wp-content/uploads/2024/03/giay-mlb-chunky-liner-mid-monogram-ny-yankees-black-3asxcmm4n-50bks.webp', 1, '2024-08-12 23:13:08', '2024-08-12 23:13:08'),
('13dc4975-a13b-49cf-956d-95958004267d', 'x4y5z6a7-b8c9-0d1e-2f3g-456789j0', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-converse-chuck-taylor-all-star-1970s-white-high-trang-co-cao-6-1.jpg', 0, '2024-08-14 07:55:22', '2024-08-14 07:55:22'),
('16affee5-a37d-4aae-9f12-fc398885e4a2', 'a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', 'https://tyhisneaker.com/wp-content/uploads/2022/10/z3297154435177_4ee02bc3f8032aa17f4cb49c46094ed1-scaled-1.jpg', 0, '2024-08-12 22:22:09', '2024-08-12 22:22:09'),
('178ba950-0020-4035-9607-5f1de3e37d17', 'l3m4n5o6-p7q8-9r0s-1t2u-v345678w', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-nike-air-jordan-1-low-se-reverse-ice-blue-w-like-auth.jpeg', 0, '2024-08-12 23:01:23', '2024-08-12 23:01:23'),
('1ae6b719-2218-4cc0-ac31-bf94fca5b6a3', 'm4n5o6p7-q8r9-0s1t-2u3v-w456789x', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-nike-air-jordan-1-low-gs-shattered-backboard-like-auth.jpg', 1, '2024-08-12 23:01:56', '2024-08-12 23:01:56'),
('1c6a0719-357d-4ceb-a2f9-435e52b75be6', 'g8h9i0j1-k2l3-4m5n-6o7p-qrstuvw8', 'https://tyhisneaker.com/wp-content/uploads/2022/09/77ce50e410e1d5bf8cf0.jpg', 0, '2024-08-12 22:38:53', '2024-08-12 22:38:53'),
('1d3010b3-1801-4ddd-b7ca-b91b235deaf3', 'c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', 'https://tyhisneaker.com/wp-content/uploads/2023/02/Gia%CC%80y-Cha%CC%A3y-Bo%CC%A3%CC%82-Adidas-EQT-Bost-2023-Do%CC%89-Den-LikeAuth-2-scaled.jpeg', 0, '2024-08-12 22:26:35', '2024-08-12 22:26:35'),
('20ae4b0f-abe8-4dc4-bb97-0cdcdef4c8da', 'h9i0j1k2-l3m4-5n6o-7p8q-rstuvw9x0', 'https://tyhisneaker.com/wp-content/uploads/2022/09/adidas-superstar-cappuccino-so-chay-hong-kem.jpg', 1, '2024-08-12 22:39:34', '2024-08-12 22:39:34'),
('20e7997f-fec5-4056-962b-b3fcf3d01ad8', 'n4o5p6q7-r8s9-0t1u-2v3w-xyz4567d', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-air-jordan-1-high-zoom-racer-blue-like-auth-min.jpeg', 0, '2024-08-12 22:46:15', '2024-08-12 22:46:15'),
('217f76fa-ae93-470e-9a25-40af514de837', 'u1v2w3x4-y5z6-7a8b-9c0d-ef123456g', 'https://tyhisneaker.com/wp-content/uploads/2023/05/giay-converse-unisex-chuck-70-plus-3.jpeg', 0, '2024-08-14 07:52:01', '2024-08-14 07:52:01'),
('21a2a320-66bc-46c4-8772-e5cbf4b72165', 'h4i5j6k7-l8m9-0n1o-2p3q-4567890s', 'https://tyhisneaker.com/wp-content/uploads/2023/11/giay-mlb-chunky-liner-mid-ny-green-3asxlmb3n-50gns.jpg', 1, '2024-08-12 23:16:19', '2024-08-12 23:16:19'),
('251a8839-ca81-44d8-bfda-eb55621f2491', 'a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', 'https://tyhisneaker.com/wp-content/uploads/2022/11/giay-adidas-ultra-boost-60-triple-black-den-full-1.jpg', 1, '2024-08-12 19:28:42', '2024-08-12 22:10:20'),
('274850f7-f08c-4fb4-81de-007878e23ec3', 'g3h4i5j6-k7l8-9m0n-1o2p-3456789r', 'https://tyhisneaker.com/wp-content/uploads/2022/11/giay-mlb-kim-tuyen-cao-cap-rep-11-dep-chat-3.jpeg', 0, '2024-08-12 23:15:34', '2024-08-12 23:15:34'),
('28630596-ac1e-4718-9b0a-afbd131c83fa', 'd5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', 'https://tyhisneaker.com/wp-content/uploads/2023/02/Gia%CC%80y-Cha%CC%A3y-Bo%CC%A3%CC%82-Adidas-EQT-Bost-2023-LikeAuth-3-scaled.jpeg', 0, '2024-08-12 22:28:31', '2024-08-12 22:28:31'),
('2d50c5d9-87cd-419b-ba32-1ded4e2dafd7', 'm3n4o5p6-q7r8-9s0t-1u2v-wxyz3456c', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-air-jordan-1-retro-high-bred-toe-like-auth.jpeg', 0, '2024-08-12 22:45:43', '2024-08-12 22:45:43'),
('2db3efe3-c85c-4a4f-b565-43d926396a3f', 'd5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', 'https://tyhisneaker.com/wp-content/uploads/2023/02/giay-chay-bo-adidas-eqt-bost-2023-cam-trang-likeauth.jpg', 1, '2024-08-12 22:28:17', '2024-08-12 22:28:17'),
('2dfd4fea-579f-4b2a-b15b-fec1a99b9e3a', 'w3x4y5z6-a7b8-9c0d-1e2f-3456789i', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-converse-run-star-hike-high-white-trang-co-cao.jpg', 0, '2024-08-14 07:54:28', '2024-08-14 07:54:28'),
('34019bd7-d54c-4f64-b3f2-24c6f1d1851a', 'a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', 'https://tyhisneaker.com/wp-content/uploads/2022/11/z3625309018129_d993afc46c6270f3d3c1dbb6124eb2bc.jpeg', 0, '2024-08-12 19:22:22', '2024-08-12 22:10:20'),
('369b9a95-ed69-45d9-8ce2-84b1550f1b23', 's4t5u6v7-w8x9-0y1z-2a3b-456789i0', 'https://tyhisneaker.com/wp-content/uploads/2022/10/104.5.jpg', 0, '2024-08-14 08:00:36', '2024-08-14 08:00:36'),
('3754641e-6eaa-4ed7-adac-f80600dd4ac7', 's4t5u6v7-w8x9-0y1z-2a3b-456789i0', 'https://tyhisneaker.com/wp-content/uploads/2022/10/104.6.jpg', 0, '2024-08-14 08:00:43', '2024-08-14 08:00:43'),
('38251f8a-6853-4718-94ce-52d01357a4f4', 'm3n4o5p6-q7r8-9s0t-1u2v-wxyz3456c', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-air-jordan-1-retro-high-bred-toe-like-auth.jpg', 1, '2024-08-12 22:45:29', '2024-08-12 22:45:29'),
('3acfc6ca-e229-4665-90c5-5e0693c395aa', 'v2w3x4y5-z6a7-8b9c-0d1e-f2345678h', 'https://tyhisneaker.com/wp-content/uploads/2022/12/giay-converse-chuck-taylor-all-star-1970s-hi-top-sieu-cap.jpg', 1, '2024-08-14 07:52:44', '2024-08-14 07:52:44'),
('3d9fa4ba-edb4-42ff-bb7d-b861638572c2', 'f2g3h4i5-j6k7-8l9m-0n1o-p234567q', 'https://tyhisneaker.com/wp-content/uploads/2024/01/mlb-chunky-liner-mid-denim-boston-red-sox-dblue-chinh-hang.jpg', 1, '2024-08-12 23:14:14', '2024-08-12 23:14:14'),
('3e18cf65-062a-447d-954b-a6c1a3c5464b', 'o5p6q7r8-s9t0-1u2v-3w4x-yz123456e', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-wmns-dunk-low-orange-pearl-dd1503-102-2.jpg', 0, '2024-08-12 22:46:59', '2024-08-12 22:46:59'),
('40fce625-d4a3-497a-98b2-5dfb371804e4', 'd5e6f7g8-h9i0-1j2k-3l4m-n567890o', 'https://tyhisneaker.com/wp-content/uploads/2022/09/8ed3b47ef60832566b19.jpg', 0, '2024-08-12 22:56:38', '2024-08-12 22:56:38'),
('41b6210b-5b52-430b-9090-1da32df0a09c', 'd5e6f7g8-h9i0-1j2k-3l4m-n567890o', 'https://tyhisneaker.com/wp-content/uploads/2022/09/6573b3eff19935c76c88.jpg', 0, '2024-08-12 22:56:29', '2024-08-12 22:56:29'),
('459bc19b-4b8b-4cdc-826b-38ab0f81b173', 'h4i5j6k7-l8m9-0n1o-2p3q-4567890s', 'https://tyhisneaker.com/wp-content/uploads/2023/11/giay-mlb-chunky-liner-mid-ny-green-3asxlmb3n-50gns-4.jpeg', 0, '2024-08-12 23:16:40', '2024-08-12 23:16:40'),
('462af396-67d8-4ca6-a9ec-dcc3bf5935f2', 'x4y5z6a7-b8c9-0d1e-2f3g-456789j0', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-converse-chuck-taylor-all-star-1970s-white-high-trang-co-cao-1.jpg', 1, '2024-08-14 07:55:08', '2024-08-14 07:55:08'),
('4975ff3a-905d-4312-9191-aca5ed43d305', 'a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', 'https://tyhisneaker.com/wp-content/uploads/2022/10/z3297154834622_af06dc1dcf2ef4d4cb0960a931613ddd-scaled-1.jpg', 0, '2024-08-12 22:21:53', '2024-08-12 22:21:53'),
('4b57223a-201e-4f19-ac0c-886e7cec1544', 't5u6v7w8-x9y0-1z2a-3b4c-567890j1', 'https://tyhisneaker.com/wp-content/uploads/2022/10/100.6.jpg', 0, '2024-08-14 08:01:34', '2024-08-14 08:01:34'),
('4c40ffa3-2f3d-4fea-ac2e-14fd022c6d12', 'w3x4y5z6-a7b8-9c0d-1e2f-3456789i', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-converse-run-star-hike-high-white-trang-co-cao-3.jpg', 0, '2024-08-14 07:54:15', '2024-08-14 07:54:15'),
('4cde3ede-0dfc-4498-ad79-76b65a9c3386', 'i5j6k7l8-m9n0-1o2p-3q4r-5678901t', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-mlb-chunky-liner-mid-monogram-boston-7.jpeg', 0, '2024-08-12 23:18:30', '2024-08-12 23:18:30'),
('4cf42095-58c5-4c8e-aeb0-7d567ab576ee', 'g3h4i5j6-k7l8-9m0n-1o2p-3456789r', 'https://tyhisneaker.com/wp-content/uploads/2022/11/giay-mlb-kim-tuyen-cao-cap-rep-11-dep-chat.jpeg', 0, '2024-08-12 23:15:27', '2024-08-12 23:15:27'),
('4efd9c6f-5217-49dd-acbc-7c99826c8407', 'a2b3c4d5-e6f7-8g9h-0i1j-k234567l', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-vans-vault-knu-skool-vr3-lx-imran-potatop-like-auth-9.jpeg', 0, '2024-08-12 22:53:59', '2024-08-12 22:53:59'),
('4f3dcdfd-a6d3-4bb7-aafe-918274b44102', 'r3s4t5u6-v7w8-9x0y-1z2a-3456789h', 'https://tyhisneaker.com/wp-content/uploads/2022/12/z3956552977925_79e4f80559723b9bd4086b829e02ced7-scaled.jpg', 0, '2024-08-14 07:59:48', '2024-08-14 07:59:48'),
('509c1023-8f60-4a9c-800b-6c6290389192', 't5u6v7w8-x9y0-1z2a-3b4c-567890j1', 'https://tyhisneaker.com/wp-content/uploads/2022/10/new-balance-550-x-aime-leon-dore-silver-bb550ale.jpg', 1, '2024-08-14 08:01:22', '2024-08-14 08:01:26'),
('525e2e72-34cb-43de-980a-5dabe2f1d9b2', 'k1l2m3n4-o5p6-7q8r-9s0t-uvwxyz1234a', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-jordan-1-retro-low-dior-cn8608-002-like-auth-9999-7.jpeg', 0, '2024-08-12 22:44:25', '2024-08-12 22:44:25'),
('555ac28b-2ed9-4863-855c-0e4a5ba85ebb', 's4t5u6v7-w8x9-0y1z-2a3b-456789i0', 'https://tyhisneaker.com/wp-content/uploads/2022/10/104.jpg', 1, '2024-08-14 08:00:26', '2024-08-14 08:00:26'),
('593062e4-597e-438b-bc1b-2b268f85076a', 'c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', 'https://tyhisneaker.com/wp-content/uploads/2023/02/giay-chay-bo-adidas-eqt-bost-2023-do-den-likeauth.jpg', 1, '2024-08-12 22:26:28', '2024-08-12 22:26:28'),
('5957f379-8f38-4bd2-8c30-5d9e6b324337', 'd5e6f7g8-h9i0-1j2k-3l4m-n567890o', 'https://tyhisneaker.com/wp-content/uploads/2022/09/dbdcf463b615724b2b04-Copy.jpg', 0, '2024-08-12 22:56:19', '2024-08-12 22:56:19'),
('5d0a5e74-3efb-4705-9cd9-0affc8e06a29', 'a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', 'https://tyhisneaker.com/wp-content/uploads/2022/10/z3297154675216_bf5f8d39464237127af3294ed2179c1b-scaled-1.jpg', 0, '2024-08-12 22:22:01', '2024-08-12 22:22:01'),
('5e9eb100-8da8-4e0e-8ae2-7369400a5fc0', 'x4y5z6a7-b8c9-0d1e-2f3g-456789j0', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-converse-chuck-taylor-all-star-1970s-white-high-trang-co-cao-5-1.jpg', 0, '2024-08-14 07:55:28', '2024-08-14 07:55:28'),
('5f666c92-09dc-48a7-8c82-4632e2dada83', 'n4o5p6q7-r8s9-0t1u-2v3w-xyz4567d', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-air-jordan-1-high-zoom-racer-blue-like-auth-2-min.jpeg', 0, '2024-08-12 22:46:25', '2024-08-12 22:46:25'),
('649600da-a80b-4d6f-945f-20d88050032f', 'n4o5p6q7-r8s9-0t1u-2v3w-xyz4567d', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-air-jordan-1-high-zoom-racer-blue-like-auth.jpg', 1, '2024-08-12 22:46:08', '2024-08-12 22:46:08'),
('64c43af0-5c31-4380-8963-37f86d03999a', 'z1a2b3c4-d5e6-7f8g-9h0i-j123456k', 'https://tyhisneaker.com/wp-content/uploads/2022/11/z3921722415876_5cdce6d728c240303f0188a3b83ca3d0.jpg', 0, '2024-08-12 22:57:11', '2024-08-12 22:57:11'),
('690a2250-3afa-43f8-8b12-56350e6082ce', 'e1f2g3h4-i5j6-7k8l-9m0n-o123456p', 'https://tyhisneaker.com/wp-content/uploads/2024/03/giay-mlb-chunky-liner-mid-monogram-ny-yankees-black-3asxcmm4n-50bks-1.jpeg', 0, '2024-08-12 23:13:34', '2024-08-12 23:13:34'),
('69856c2a-50e5-4ce0-8800-8a1e6ee9aaa6', 'z1a2b3c4-d5e6-7f8g-9h0i-j123456k', 'https://tyhisneaker.com/wp-content/uploads/2022/11/vans-motif-mickey-minnie-mouse-white.jpg', 1, '2024-08-12 22:57:04', '2024-08-12 22:57:04'),
('6cca921e-9300-4fa1-8e9c-39efe6fb2af7', 'i5j6k7l8-m9n0-1o2p-3q4r-5678901t', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-mlb-chunky-liner-mid-monogram-boston-4.jpeg', 0, '2024-08-12 23:18:18', '2024-08-12 23:18:18'),
('7048586e-27e9-42fe-825f-1db5ff87155c', 't5u6v7w8-x9y0-1z2a-3b4c-567890j1', 'https://tyhisneaker.com/wp-content/uploads/2022/10/100.4.jpg', 0, '2024-08-14 08:01:47', '2024-08-14 08:01:47'),
('7343500b-4fbc-414e-bfa7-27a5deef9824', 'g8h9i0j1-k2l3-4m5n-6o7p-qrstuvw8', 'https://tyhisneaker.com/wp-content/uploads/2022/09/3701992ed92b1c75453a.jpg', 0, '2024-08-12 22:39:00', '2024-08-12 22:39:00'),
('73de4d91-19aa-4c40-84de-18f70c021521', 'm4n5o6p7-q8r9-0s1t-2u3v-w456789x', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-nike-air-jordan-1-low-gs-shattered-backboard-like-auth-2.jpeg', 0, '2024-08-12 23:02:03', '2024-08-12 23:02:03'),
('74017874-669f-4709-9cac-7d2334af11f3', 'k1l2m3n4-o5p6-7q8r-9s0t-uvwxyz1234a', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-jordan-1-retro-low-dior-cn8608-002-like-auth-9999-2.jpeg', 0, '2024-08-12 22:44:12', '2024-08-12 22:44:12'),
('754cfb03-dcd7-4f1a-a282-8bb3cb56c681', 'b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', 'https://tyhisneaker.com/wp-content/uploads/2023/11/giay-adidas-yeezy-boost-350-v2-tail-light-fx9017-like-auth-1.jpeg', 0, '2024-08-12 22:25:19', '2024-08-12 22:25:19'),
('77e08b3b-55bf-4c1c-8769-ee716d90eeac', 'y5z6a7b8-c9d0-1e2f-3g4h-567890j1', 'https://tyhisneaker.com/wp-content/uploads/2022/10/c4803a1a-ae9f-4919-89ab-109cd4cd55e6071758bd58416dfa7b61099da6f4ecd1.webp', 1, '2024-08-14 07:55:55', '2024-08-14 07:55:55'),
('7922f7f9-8f6b-4f01-95e9-e01cbe3c67ab', 'n4o5p6q7-r8s9-0t1u-2v3w-xyz4567d', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-air-jordan-1-high-zoom-racer-blue-like-auth-3-min.jpeg', 0, '2024-08-12 22:46:20', '2024-08-12 22:46:20'),
('7d8fe8d3-cdaf-4513-84d1-9094bb65b09a', 'd5e6f7g8-h9i0-1j2k-3l4m-n567890o', 'https://tyhisneaker.com/wp-content/uploads/2022/09/vans-ua-old-skool-lx-suede-canvas-blackt-vn0a4p3xoiu-2.webp', 1, '2024-08-12 22:56:11', '2024-08-12 22:56:11'),
('83c6e16d-a0dd-423d-b5e2-5ce63e8e6232', 'r3s4t5u6-v7w8-9x0y-1z2a-3456789h', 'https://tyhisneaker.com/wp-content/uploads/2022/12/new-balance-300.jpg', 1, '2024-08-14 07:59:34', '2024-08-14 07:59:34'),
('83fa1c3b-d5cd-4329-b5a8-400686228740', 'y5z6a7b8-c9d0-1e2f-3g4h-567890j1', 'https://tyhisneaker.com/wp-content/uploads/2022/10/z3792811147182_968ecc4140b47a228181e5018618995d.jpg', 0, '2024-08-14 07:56:03', '2024-08-14 07:56:03'),
('85b4a3c8-96aa-4b4c-a618-61174f27c6b7', 'a2b3c4d5-e6f7-8g9h-0i1j-k234567l', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-vans-vault-knu-skool-vr3-lx-imran-potatop-like-auth-17.jpeg', 0, '2024-08-12 22:53:48', '2024-08-12 22:53:48'),
('86707a82-e9bc-4631-b4f2-fa9f24a14175', 'b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', 'https://tyhisneaker.com/wp-content/uploads/2023/11/giay-adidas-yeezy-boost-350-v2-tail-light-fx9017-like-auth-2.jpeg', 0, '2024-08-12 22:25:35', '2024-08-12 22:25:35'),
('878ad357-acda-488c-9753-b1a084123fbf', 'c4d5e6f7-g8h9-0i1j-2k3l-m456789n', 'https://tyhisneaker.com/wp-content/uploads/2022/10/z3792855534122_e02b789c6ff2d7f7995d6d5dd57b90b0.jpg', 0, '2024-08-12 22:55:35', '2024-08-12 22:55:35'),
('88308aa3-e407-4e15-89e7-2bcaa85a2cfa', 't5u6v7w8-x9y0-1z2a-3b4c-567890j1', 'https://tyhisneaker.com/wp-content/uploads/2022/10/100.5.jpg', 0, '2024-08-14 08:01:41', '2024-08-14 08:01:41'),
('8abdbc0b-5534-430d-ace4-61f0a0ee0990', 'b3c4d5e6-f7g8-9h0i-1j2k-l345678m', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-vans-caro-slip-on-ban-cao-cap-replica-11-dep-chat-6-1.jpg', 0, '2024-08-12 22:54:47', '2024-08-12 22:54:47'),
('8ae8700c-6ddc-4363-9868-b6fa36ee7f18', 'h4i5j6k7-l8m9-0n1o-2p3q-4567890s', 'https://tyhisneaker.com/wp-content/uploads/2023/11/giay-mlb-chunky-liner-mid-ny-green-3asxlmb3n-50gns-3.jpeg', 0, '2024-08-12 23:16:34', '2024-08-12 23:16:34'),
('92692ba6-58be-4c4b-b9d6-0a4aac179b4c', 'z1a2b3c4-d5e6-7f8g-9h0i-j123456k', 'https://tyhisneaker.com/wp-content/uploads/2022/11/z3921722385787_d4b5a8426ad3e3a62d655f742f5460f2.jpg', 0, '2024-08-12 22:57:34', '2024-08-12 22:57:34'),
('94e12a7a-132d-46a0-82bb-febbf2f423e3', 'b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', 'https://tyhisneaker.com/wp-content/uploads/2023/11/giay-adidas-yeezy-boost-350-v2-tail-light-fx9017-like-auth.jpg', 1, '2024-08-12 22:24:02', '2024-08-12 22:24:02'),
('955c45bf-7e00-4b45-8a15-54af27ecf015', 'o5p6q7r8-s9t0-1u2v-3w4x-yz123456e', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-wmns-dunk-low-orange-pearl-dd1503-102-1.jpg', 0, '2024-08-12 22:47:07', '2024-08-12 22:47:07'),
('95b7254b-b34a-4748-a8e4-419a81643750', 'i0j1k2l3-m4n5-6o7p-8q9r-stuvw0xy1', 'https://tyhisneaker.com/wp-content/uploads/2022/08/e3a7e966854840161959.jpg', 0, '2024-08-12 22:41:00', '2024-08-12 22:41:00'),
('96d54af5-1c74-4d53-9758-7a2072016b5e', 'z1a2b3c4-d5e6-7f8g-9h0i-j123456k', 'https://tyhisneaker.com/wp-content/uploads/2022/11/z3921722397850_fcecc0e4ae18cb3e2e1c69097a6f4c0c.jpg', 0, '2024-08-12 22:57:18', '2024-08-12 22:57:18'),
('96df9619-7060-42fb-b010-14431f881ab9', 'v2w3x4y5-z6a7-8b9c-0d1e-f2345678h', 'https://tyhisneaker.com/wp-content/uploads/2022/12/7fab6235e5cd3c9365dc.jpg', 0, '2024-08-14 07:53:34', '2024-08-14 07:53:34'),
('981c1510-2b88-4027-b28a-569cb902702c', 'a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', 'https://tyhisneaker.com/wp-content/uploads/2022/11/z3625309025109_77b32ff4ef428b34e41499bbc0522d1d.jpeg', 0, '2024-08-12 19:21:49', '2024-08-12 22:10:20'),
('9b298434-6e83-4af6-b541-af31ea56a9c5', 'i0j1k2l3-m4n5-6o7p-8q9r-stuvw0xy1', 'https://tyhisneaker.com/wp-content/uploads/2022/08/46ed6a2d0603c35d9a12.jpg', 0, '2024-08-12 22:40:53', '2024-08-12 22:40:53'),
('9f39ea0e-af22-4da4-8788-531307d1f812', 'a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', 'https://tyhisneaker.com/wp-content/uploads/2022/11/z3625309032634_8b31aa372db48fb4e68b4fad18365cdf.jpeg', 0, '2024-08-12 22:10:12', '2024-08-12 22:10:20'),
('9f703018-18d2-4cdf-9d10-72cb4536871e', 'v2w3x4y5-z6a7-8b9c-0d1e-f2345678h', 'https://tyhisneaker.com/wp-content/uploads/2022/12/8a909a7e1d86c4d89d97.jpg', 0, '2024-08-14 07:52:43', '2024-08-14 07:53:15'),
('a0038889-b3b8-4d57-a404-dab5ec83ffaf', 'b3c4d5e6-f7g8-9h0i-1j2k-l345678m', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-vans-caro-slip-on-ban-cao-cap-replica-11-dep-chat-5-1.jpg', 0, '2024-08-12 22:54:54', '2024-08-12 22:54:54'),
('a59c48f8-4e59-4ac9-bede-007195a493f6', 'i5j6k7l8-m9n0-1o2p-3q4r-5678901t', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-mlb-chunky-liner-mid-monogram-boston.jpg', 1, '2024-08-12 23:17:59', '2024-08-12 23:17:59'),
('a95c4b7a-bb29-4a76-9f12-d1dffafc9be5', 'm3n4o5p6-q7r8-9s0t-1u2v-wxyz3456c', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-air-jordan-1-retro-high-bred-toe-like-auth-1.jpeg', 0, '2024-08-12 22:45:35', '2024-08-12 22:45:35'),
('b0922ea9-6a42-404a-bbba-7c7926d5d1da', 'c4d5e6f7-g8h9-0i1j-2k3l-m456789n', 'https://tyhisneaker.com/wp-content/uploads/2022/10/z3792855525225_c1f3ae2db9fb047ee965e622b4482402.jpg', 0, '2024-08-12 22:55:45', '2024-08-12 22:55:45'),
('b2d202a6-1a49-4e66-94bc-791c3e15434f', 'k1l2m3n4-o5p6-7q8r-9s0t-uvwxyz1234a', 'https://tyhisneaker.com/wp-content/uploads/2023/07/giay-nike-air-jordan-1-retro-low-dior-cn8608-002-like-auth.jpg', 1, '2024-08-12 22:44:06', '2024-08-12 22:44:06'),
('b902bd5b-8684-4f88-87cb-c7b332cc4308', 'l2m3n4o5-p6q7-8r9s-0t1u-vwxyz2345b', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-dunk-low-michigan-state-dd1391-101-1.jpg', 0, '2024-08-12 22:45:00', '2024-08-12 22:45:00'),
('bdac67bc-1108-4d05-9e86-4165e61b184c', 'r3s4t5u6-v7w8-9x0y-1z2a-3456789h', 'https://tyhisneaker.com/wp-content/uploads/2022/12/z3956552992705_1f2f1fd85db40d5daf1feea874731650-scaled.jpg', 0, '2024-08-14 07:59:59', '2024-08-14 07:59:59'),
('c01059ba-f447-4aa5-a83e-36f856ab5bc6', 'm3n4o5p6-q7r8-9s0t-1u2v-wxyz3456c', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-air-jordan-1-retro-high-bred-toe-like-auth-2.jpeg', 0, '2024-08-12 22:45:50', '2024-08-12 22:45:50'),
('c28a5741-0f18-4d2a-90f5-0e494d02b8d9', 'g3h4i5j6-k7l8-9m0n-1o2p-3456789r', 'https://tyhisneaker.com/wp-content/uploads/2022/11/giay-mlb-kim-tuyen-cao-cap-rep-11-dep-chat-2.jpeg', 0, '2024-08-12 23:15:39', '2024-08-12 23:15:39'),
('c3d8d2fb-037d-42ce-9ad4-5e4ad83a144f', 'v2w3x4y5-z6a7-8b9c-0d1e-f2345678h', 'https://tyhisneaker.com/wp-content/uploads/2022/12/6d9cea066dfeb4a0edef.jpg', 0, '2024-08-14 07:53:25', '2024-08-14 07:53:25'),
('c4d2d5da-a2fb-4c51-9c08-d39f7b573d5e', 'n5o6p7q8-r9s0-1t2u-3v4w-x567890y', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-jordan-1-retro-low-og-zion-williamson-voodoo.jpg', 1, '2024-08-12 23:03:10', '2024-08-12 23:03:10'),
('c54c8bb3-2c5a-43f4-9489-36688d3b3358', 'l3m4n5o6-p7q8-9r0s-1t2u-v345678w', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-nike-air-jordan-1-low-se-reverse-ice-blue-w-like-auth-1.jpeg', 0, '2024-08-12 23:01:30', '2024-08-12 23:01:30'),
('c7139ed8-1747-4a66-9ab1-4b4a6b7ad7fa', 'a2b3c4d5-e6f7-8g9h-0i1j-k234567l', 'https://tyhisneaker.com/wp-content/uploads/2023/09/ans-vault-knu-skool-vr3-lx-imran-potatop.jpg', 1, '2024-08-12 22:53:31', '2024-08-12 22:53:31'),
('c9c4393d-ab85-4faf-afc4-19221b236cf1', 'o5p6q7r8-s9t0-1u2v-3w4x-yz123456e', 'https://tyhisneaker.com/wp-content/uploads/2023/08/nike-wmns-dunk-low-orange-pearl-dd1503-102.jpg', 1, '2024-08-12 22:46:41', '2024-08-12 22:46:45'),
('ca7b9dd6-8462-449c-bd8e-d60d118358f6', 'h4i5j6k7-l8m9-0n1o-2p3q-4567890s', 'https://tyhisneaker.com/wp-content/uploads/2023/11/giay-mlb-chunky-liner-mid-ny-green-3asxlmb3n-50gns.jpeg', 0, '2024-08-12 23:16:25', '2024-08-12 23:16:25'),
('cbbacd3c-4651-427f-a155-a61de24b748e', 'f2g3h4i5-j6k7-8l9m-0n1o-p234567q', 'https://tyhisneaker.com/wp-content/uploads/2024/01/mlb-chunky-liner-mid-denim-boston-red-sox-dblue-chinh-hang-4.jpeg', 0, '2024-08-12 23:14:41', '2024-08-12 23:14:41'),
('ce060caa-99d7-4d42-8ab0-b589f68d0707', 'n5o6p7q8-r9s0-1t2u-3v4w-x567890y', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-jordan-1-retro-low-og-zion-williamson-voodoo-2.jpg', 0, '2024-08-12 23:03:26', '2024-08-12 23:03:26'),
('cfd945ce-5bc3-4478-97bb-4d76ce06559f', 'd5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', 'https://tyhisneaker.com/wp-content/uploads/2023/02/Gia%CC%80y-Cha%CC%A3y-Bo%CC%A3%CC%82-Adidas-EQT-Bost-2023-LikeAuth-2-scaled.jpeg', 0, '2024-08-12 22:28:24', '2024-08-12 22:28:24'),
('d028b8b7-5d53-45e9-b203-6b34ff15b8a6', 'e1f2g3h4-i5j6-7k8l-9m0n-o123456p', 'https://tyhisneaker.com/wp-content/uploads/2024/03/giay-mlb-chunky-liner-mid-monogram-ny-yankees-black-3asxcmm4n-50bks.jpeg', 0, '2024-08-12 23:13:27', '2024-08-12 23:13:27'),
('d2094dd3-1efb-4301-8a89-9cca3341ead1', 'l3m4n5o6-p7q8-9r0s-1t2u-v345678w', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-nike-air-jordan-1-low-se-reverse-ice-blue-w-like-auth-2.jpeg', 0, '2024-08-12 23:01:36', '2024-08-12 23:01:36'),
('d58e6e4a-97fa-4164-b256-9ebbc23efaf2', 'g8h9i0j1-k2l3-4m5n-6o7p-qrstuvw8', 'https://tyhisneaker.com/wp-content/uploads/2022/09/d5aa117d51789426cd69.jpg', 0, '2024-08-12 22:38:42', '2024-08-12 22:38:42'),
('d6374c76-8a92-43e8-9fc3-1e92a371ac85', 'c4d5e6f7-g8h9-0i1j-2k3l-m456789n', 'https://tyhisneaker.com/wp-content/uploads/2022/10/vans-era-comfycush-black-marshmallow-rep-1-1.jpg', 1, '2024-08-12 22:55:27', '2024-08-12 22:55:27'),
('d7f75670-ac50-4e67-a962-f7f6cb39924d', 'h9i0j1k2-l3m4-5n6o-7p8q-rstuvw9x0', 'https://tyhisneaker.com/wp-content/uploads/2022/09/d95ae5374c198947d008.jpeg', 0, '2024-08-12 22:39:40', '2024-08-12 22:39:40'),
('dad1117d-bea1-45c3-aa18-dd81344e1b89', 'a2b3c4d5-e6f7-8g9h-0i1j-k234567l', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-vans-vault-knu-skool-vr3-lx-imran-potatop-like-auth-6.jpeg', 0, '2024-08-12 22:53:40', '2024-08-12 22:53:40'),
('dc17cd9e-0ca7-4b96-bc63-c02e94013940', 's4t5u6v7-w8x9-0y1z-2a3b-456789i0', 'https://tyhisneaker.com/wp-content/uploads/2022/10/104.4.jpg', 0, '2024-08-14 08:00:51', '2024-08-14 08:00:51'),
('e0728b33-f099-49b8-9bc2-38f59fa4938f', 'i0j1k2l3-m4n5-6o7p-8q9r-stuvw0xy1', 'https://tyhisneaker.com/wp-content/uploads/2022/08/giay-the-thao-adidas-original-superstar-tem-vang-c77124-mau-trang-5f72a366e7e8a-29092020100054.jpg', 1, '2024-08-12 22:40:32', '2024-08-12 22:40:32'),
('e0cef55b-ad83-49d3-9a44-0cc1561cd94d', 'n5o6p7q8-r9s0-1t2u-3v4w-x567890y', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-jordan-1-retro-low-og-zion-williamson-voodoo-3.jpg', 0, '2024-08-12 23:03:33', '2024-08-12 23:03:33'),
('e186ba88-ac2e-4fc4-ba4d-1024ae02fc60', 'c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', 'https://tyhisneaker.com/wp-content/uploads/2023/02/Gia%CC%80y-Cha%CC%A3y-Bo%CC%A3%CC%82-Adidas-EQT-Bost-2023-Do%CC%89-Den-LikeAuth-9-scaled.jpeg', 0, '2024-08-12 22:26:49', '2024-08-12 22:26:49'),
('e202ea3b-3a1b-4424-ad62-7ab43673b7ef', 'f2g3h4i5-j6k7-8l9m-0n1o-p234567q', 'https://tyhisneaker.com/wp-content/uploads/2024/01/mlb-chunky-liner-mid-denim-boston-red-sox-dblue-chinh-hang.jpeg', 0, '2024-08-12 23:14:23', '2024-08-12 23:14:23'),
('e70c9cc8-d9e3-409e-af5a-c80f413d0aa2', 'l2m3n4o5-p6q7-8r9s-0t1u-vwxyz2345b', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-dunk-low-michigan-state-dd1391-101-4.jpg', 0, '2024-08-12 22:45:12', '2024-08-12 22:45:12'),
('e8060606-5677-4b5e-9489-a32d56236fe9', 'f2g3h4i5-j6k7-8l9m-0n1o-p234567q', 'https://tyhisneaker.com/wp-content/uploads/2024/01/mlb-chunky-liner-mid-denim-boston-red-sox-dblue-chinh-hang-3.jpeg', 0, '2024-08-12 23:14:31', '2024-08-12 23:14:31'),
('e9636d99-6dcb-40de-8e12-30529d2c340f', 'r3s4t5u6-v7w8-9x0y-1z2a-3456789h', 'https://tyhisneaker.com/wp-content/uploads/2022/12/z3956552970647_b52bf5d3d981f3e168d60adbb1c41ce8.jpg', 0, '2024-08-14 07:59:41', '2024-08-14 07:59:41'),
('e99d40a2-beca-4ef9-a675-20cb11504519', 'h9i0j1k2-l3m4-5n6o-7p8q-rstuvw9x0', 'https://tyhisneaker.com/wp-content/uploads/2022/09/d2ed288b81a544fb1db4.jpeg', 0, '2024-08-12 22:39:45', '2024-08-12 22:39:45'),
('ea1888f4-4c19-4cc8-9973-e21571bf77ba', 'l2m3n4o5-p6q7-8r9s-0t1u-vwxyz2345b', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-dunk-low-michigan-state-dd1391-101-3.jpg', 0, '2024-08-12 22:45:07', '2024-08-12 22:45:07'),
('ee5c85f7-5a69-4113-864e-c43461f9a7fb', 'o5p6q7r8-s9t0-1u2v-3w4x-yz123456e', 'https://tyhisneaker.com/wp-content/uploads/2023/08/giay-nike-wmns-dunk-low-orange-pearl-dd1503-102-3.jpg', 0, '2024-08-12 22:46:53', '2024-08-12 22:46:53'),
('ee9fce19-dfb2-4cf4-aa56-2e264bb25795', 'b3c4d5e6-f7g8-9h0i-1j2k-l345678m', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-vans-caro-slip-on-ban-cao-cap-replica-11-dep-chat-7-1.jpg', 0, '2024-08-12 22:54:40', '2024-08-12 22:54:40'),
('eeb41775-cac7-4b10-9c15-7884dbe1e6ca', 'w3x4y5z6-a7b8-9c0d-1e2f-3456789i', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-converse-run-star-hike-high-white-trang-co-cao-4.jpg', 1, '2024-08-14 07:54:02', '2024-08-14 07:54:02'),
('efba15dc-6614-433b-b796-5dbf8da6e542', 'g8h9i0j1-k2l3-4m5n-6o7p-qrstuvw8', 'https://tyhisneaker.com/wp-content/uploads/2022/09/giay-adidas-originals-superstar-cappuccino.jpg', 1, '2024-08-12 22:38:34', '2024-08-12 22:38:34'),
('f105b0ed-cfbf-4a41-995b-bd31b92a75c6', 'l3m4n5o6-p7q8-9r0s-1t2u-v345678w', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-nike-air-jordan-1-low-se-reverse-ice-blue-w-like-auth.jpg', 1, '2024-08-12 23:01:14', '2024-08-12 23:01:14'),
('f2b2e5cb-087a-4782-a08b-2e02dbbc016b', 'w3x4y5z6-a7b8-9c0d-1e2f-3456789i', 'https://tyhisneaker.com/wp-content/uploads/2022/10/giay-converse-run-star-hike-high-white-trang-co-cao-2.jpg', 0, '2024-08-14 07:54:22', '2024-08-14 07:54:22'),
('f3a51cdb-6cf3-4efe-ac07-d61e1e93a1e2', 'c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', 'https://tyhisneaker.com/wp-content/uploads/2023/02/Gia%CC%80y-Cha%CC%A3y-Bo%CC%A3%CC%82-Adidas-EQT-Bost-2023-Do%CC%89-Den-LikeAuth-scaled.jpeg', 0, '2024-08-12 22:26:42', '2024-08-12 22:26:42'),
('f490a759-ba2f-4968-8105-35aedadb87b1', 'u1v2w3x4-y5z6-7a8b-9c0d-ef123456g', 'https://tyhisneaker.com/wp-content/uploads/2023/05/giay-converse-unisex-chuck-70-plus.jpeg', 0, '2024-08-14 07:51:48', '2024-08-14 07:51:48'),
('f54ccfc7-2bd2-4d06-b405-7e8fe2b0c3a1', 'y5z6a7b8-c9d0-1e2f-3g4h-567890j1', 'https://tyhisneaker.com/wp-content/uploads/2022/10/z3792811138184_f42e959862e50506c1280afdc58d4509.jpg', 0, '2024-08-14 07:56:16', '2024-08-14 07:56:16'),
('f5ed6102-141a-4f5e-86ad-48b010d41f7a', 'k1l2m3n4-o5p6-7q8r-9s0t-uvwxyz1234a', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-jordan-1-retro-low-dior-cn8608-002-like-auth-9999-6.jpeg', 0, '2024-08-12 22:44:19', '2024-08-12 22:44:19'),
('f6c7a95b-b046-4ac1-bf26-244db5d5dc1a', 'y5z6a7b8-c9d0-1e2f-3g4h-567890j1', 'https://tyhisneaker.com/wp-content/uploads/2022/10/z3792811140537_551adacf3ab5c261a5c3503853b92930.jpg', 0, '2024-08-14 07:56:09', '2024-08-14 07:56:09'),
('fc814368-14cc-4c43-b863-f36b3f64d31c', 'm4n5o6p7-q8r9-0s1t-2u3v-w456789x', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-nike-air-jordan-1-low-gs-shattered-backboard-like-auth-3.jpeg', 0, '2024-08-12 23:02:10', '2024-08-12 23:02:10'),
('fd2f6cac-a1a3-44fb-add5-36368914aa7b', 'i5j6k7l8-m9n0-1o2p-3q4r-5678901t', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-mlb-chunky-liner-mid-monogram-boston.jpeg', 0, '2024-08-12 23:18:07', '2024-08-12 23:18:07'),
('fe4b5e9a-45ab-4915-a6fc-d5627400e885', 'b3c4d5e6-f7g8-9h0i-1j2k-l345678m', 'https://tyhisneaker.com/wp-content/uploads/2022/10/vans-caro-slip-on.jpg', 1, '2024-08-12 22:54:32', '2024-08-12 22:54:32'),
('ff805a1c-4045-4170-912b-dc3ac2cdb740', 'm4n5o6p7-q8r9-0s1t-2u3v-w456789x', 'https://tyhisneaker.com/wp-content/uploads/2023/09/giay-nike-air-jordan-1-low-gs-shattered-backboard-like-auth.jpeg', 0, '2024-08-12 23:02:21', '2024-08-12 23:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `product_id` char(36) NOT NULL,
  `size_id` char(36) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`product_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
('a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', '28012001-556a-11ef-acc5-f8da0c52c1d8', 90, '2024-08-19 07:35:03', '2024-08-19 07:35:03'),
('a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:47:24', '2024-08-19 08:29:20'),
('a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:48:31', '2024-08-19 08:30:17'),
('a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:48:50', '2024-08-19 07:48:50'),
('a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:32:16', '2024-08-19 08:32:16'),
('a1b2c3d4-e5f6-7g8h-9i0j-klmnopqrstu1', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:32:28', '2024-08-19 08:32:28'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '28012001-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:05:00', '2024-08-19 04:05:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:10:00', '2024-08-19 04:10:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:15:00', '2024-08-19 04:15:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:20:00', '2024-08-19 04:20:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:25:00', '2024-08-19 04:25:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:30:00', '2024-08-19 04:30:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:35:00', '2024-08-19 04:35:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:40:00', '2024-08-19 04:40:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:45:00', '2024-08-19 04:45:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '2805bc88-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:50:00', '2024-08-19 04:50:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-k234567l', '2805bd5c-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 04:55:00', '2024-08-19 04:55:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', '28012001-556a-11ef-acc5-f8da0c52c1d8', 99, '2024-08-19 05:00:00', '2024-08-19 05:00:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:05:00', '2024-08-19 05:05:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:10:00', '2024-08-19 05:10:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:15:00', '2024-08-19 05:15:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:20:00', '2024-08-19 05:20:00'),
('a2b3c4d5-e6f7-8g9h-0i1j-klmnopqrstu2', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:25:00', '2024-08-19 05:25:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-l345678m', '28012001-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:30:00', '2024-08-19 05:30:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-l345678m', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:35:00', '2024-08-19 05:35:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-l345678m', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:40:00', '2024-08-19 05:40:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-l345678m', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:45:00', '2024-08-19 05:45:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-l345678m', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:50:00', '2024-08-19 05:50:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-l345678m', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 05:55:00', '2024-08-19 05:55:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', '28012001-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:00:00', '2024-08-19 06:00:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:05:00', '2024-08-19 06:05:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:10:00', '2024-08-19 06:10:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:15:00', '2024-08-19 06:15:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:20:00', '2024-08-19 06:20:00'),
('b3c4d5e6-f7g8-9h0i-1j2k-lmnopqrstu3', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:25:00', '2024-08-19 06:25:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-m456789n', '28012001-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:30:00', '2024-08-19 06:30:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-m456789n', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:35:00', '2024-08-19 06:35:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-m456789n', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:40:00', '2024-08-19 06:40:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-m456789n', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:45:00', '2024-08-19 06:45:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-m456789n', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:50:00', '2024-08-19 06:50:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-m456789n', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 06:55:00', '2024-08-19 06:55:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', '28012001-556a-11ef-acc5-f8da0c52c1d8', 98, '2024-08-19 07:00:00', '2024-08-19 07:00:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:05:00', '2024-08-19 07:05:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:10:00', '2024-08-19 07:10:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:15:00', '2024-08-19 07:15:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:20:00', '2024-08-19 07:20:00'),
('c4d5e6f7-g8h9-0i1j-2k3l-mnopqrstu4', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:25:00', '2024-08-19 07:25:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-n567890o', '28012001-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:30:00', '2024-08-19 07:30:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-n567890o', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:35:00', '2024-08-19 07:35:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-n567890o', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:40:00', '2024-08-19 07:40:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-n567890o', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:45:00', '2024-08-19 07:45:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-n567890o', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:50:00', '2024-08-19 07:50:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-n567890o', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 07:55:00', '2024-08-19 07:55:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', '28012001-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:00:00', '2024-08-19 08:00:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:05:00', '2024-08-19 08:05:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:10:00', '2024-08-19 08:10:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:15:00', '2024-08-19 08:15:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:20:00', '2024-08-19 08:20:00'),
('d5e6f7g8-h9i0-1j2k-3l4m-nopqrstuvw5', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:25:00', '2024-08-19 08:25:00'),
('e1f2g3h4-i5j6-7k8l-9m0n-o123456p', '28012001-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:30:00', '2024-08-19 08:30:00'),
('e1f2g3h4-i5j6-7k8l-9m0n-o123456p', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:35:00', '2024-08-19 08:35:00'),
('e1f2g3h4-i5j6-7k8l-9m0n-o123456p', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:40:00', '2024-08-19 08:40:00'),
('e1f2g3h4-i5j6-7k8l-9m0n-o123456p', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:45:00', '2024-08-19 08:45:00'),
('e1f2g3h4-i5j6-7k8l-9m0n-o123456p', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:50:00', '2024-08-19 08:50:00'),
('e1f2g3h4-i5j6-7k8l-9m0n-o123456p', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, '2024-08-19 08:55:00', '2024-08-19 08:55:00'),
('f2g3h4i5-j6k7-8l9m-0n1o-p234567q', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('f2g3h4i5-j6k7-8l9m-0n1o-p234567q', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('f2g3h4i5-j6k7-8l9m-0n1o-p234567q', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('f2g3h4i5-j6k7-8l9m-0n1o-p234567q', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('f2g3h4i5-j6k7-8l9m-0n1o-p234567q', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('g3h4i5j6-k7l8-9m0n-1o2p-3456789r', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('g3h4i5j6-k7l8-9m0n-1o2p-3456789r', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('g3h4i5j6-k7l8-9m0n-1o2p-3456789r', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('g3h4i5j6-k7l8-9m0n-1o2p-3456789r', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('g3h4i5j6-k7l8-9m0n-1o2p-3456789r', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('g8h9i0j1-k2l3-4m5n-6o7p-qrstuvw8', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('g8h9i0j1-k2l3-4m5n-6o7p-qrstuvw8', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('g8h9i0j1-k2l3-4m5n-6o7p-qrstuvw8', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('g8h9i0j1-k2l3-4m5n-6o7p-qrstuvw8', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('g8h9i0j1-k2l3-4m5n-6o7p-qrstuvw8', '2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('h4i5j6k7-l8m9-0n1o-2p3q-4567890s', '28012001-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('h4i5j6k7-l8m9-0n1o-2p3q-4567890s', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('h4i5j6k7-l8m9-0n1o-2p3q-4567890s', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('h4i5j6k7-l8m9-0n1o-2p3q-4567890s', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('h4i5j6k7-l8m9-0n1o-2p3q-4567890s', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('h9i0j1k2-l3m4-5n6o-7p8q-rstuvw9x0', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('h9i0j1k2-l3m4-5n6o-7p8q-rstuvw9x0', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('h9i0j1k2-l3m4-5n6o-7p8q-rstuvw9x0', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('h9i0j1k2-l3m4-5n6o-7p8q-rstuvw9x0', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('h9i0j1k2-l3m4-5n6o-7p8q-rstuvw9x0', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('i0j1k2l3-m4n5-6o7p-8q9r-stuvw0xy1', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('i0j1k2l3-m4n5-6o7p-8q9r-stuvw0xy1', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('i0j1k2l3-m4n5-6o7p-8q9r-stuvw0xy1', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('i0j1k2l3-m4n5-6o7p-8q9r-stuvw0xy1', '2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('i0j1k2l3-m4n5-6o7p-8q9r-stuvw0xy1', '2805bc88-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('i5j6k7l8-m9n0-1o2p-3q4r-5678901t', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('i5j6k7l8-m9n0-1o2p-3q4r-5678901t', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('i5j6k7l8-m9n0-1o2p-3q4r-5678901t', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('i5j6k7l8-m9n0-1o2p-3q4r-5678901t', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('i5j6k7l8-m9n0-1o2p-3q4r-5678901t', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('k1l2m3n4-o5p6-7q8r-9s0t-uvwxyz1234a', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('k1l2m3n4-o5p6-7q8r-9s0t-uvwxyz1234a', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('k1l2m3n4-o5p6-7q8r-9s0t-uvwxyz1234a', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('k1l2m3n4-o5p6-7q8r-9s0t-uvwxyz1234a', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('k1l2m3n4-o5p6-7q8r-9s0t-uvwxyz1234a', '2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('l2m3n4o5-p6q7-8r9s-0t1u-vwxyz2345b', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('l2m3n4o5-p6q7-8r9s-0t1u-vwxyz2345b', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('l2m3n4o5-p6q7-8r9s-0t1u-vwxyz2345b', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('l2m3n4o5-p6q7-8r9s-0t1u-vwxyz2345b', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('l2m3n4o5-p6q7-8r9s-0t1u-vwxyz2345b', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('l3m4n5o6-p7q8-9r0s-1t2u-v345678w', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('l3m4n5o6-p7q8-9r0s-1t2u-v345678w', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('l3m4n5o6-p7q8-9r0s-1t2u-v345678w', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('l3m4n5o6-p7q8-9r0s-1t2u-v345678w', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('l3m4n5o6-p7q8-9r0s-1t2u-v345678w', '2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('m3n4o5p6-q7r8-9s0t-1u2v-wxyz3456c', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('m3n4o5p6-q7r8-9s0t-1u2v-wxyz3456c', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('m3n4o5p6-q7r8-9s0t-1u2v-wxyz3456c', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('m3n4o5p6-q7r8-9s0t-1u2v-wxyz3456c', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('m3n4o5p6-q7r8-9s0t-1u2v-wxyz3456c', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('m4n5o6p7-q8r9-0s1t-2u3v-w456789x', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('m4n5o6p7-q8r9-0s1t-2u3v-w456789x', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('m4n5o6p7-q8r9-0s1t-2u3v-w456789x', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('m4n5o6p7-q8r9-0s1t-2u3v-w456789x', '2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('m4n5o6p7-q8r9-0s1t-2u3v-w456789x', '2805bc88-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('n4o5p6q7-r8s9-0t1u-2v3w-xyz4567d', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('n4o5p6q7-r8s9-0t1u-2v3w-xyz4567d', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('n4o5p6q7-r8s9-0t1u-2v3w-xyz4567d', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('n4o5p6q7-r8s9-0t1u-2v3w-xyz4567d', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('n4o5p6q7-r8s9-0t1u-2v3w-xyz4567d', '2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('n5o6p7q8-r9s0-1t2u-3v4w-x567890y', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('n5o6p7q8-r9s0-1t2u-3v4w-x567890y', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('n5o6p7q8-r9s0-1t2u-3v4w-x567890y', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('n5o6p7q8-r9s0-1t2u-3v4w-x567890y', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('n5o6p7q8-r9s0-1t2u-3v4w-x567890y', '2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('o5p6q7r8-s9t0-1u2v-3w4x-yz123456e', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('o5p6q7r8-s9t0-1u2v-3w4x-yz123456e', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('o5p6q7r8-s9t0-1u2v-3w4x-yz123456e', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('o5p6q7r8-s9t0-1u2v-3w4x-yz123456e', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('o5p6q7r8-s9t0-1u2v-3w4x-yz123456e', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('r3s4t5u6-v7w8-9x0y-1z2a-3456789h', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('r3s4t5u6-v7w8-9x0y-1z2a-3456789h', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('r3s4t5u6-v7w8-9x0y-1z2a-3456789h', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('r3s4t5u6-v7w8-9x0y-1z2a-3456789h', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('r3s4t5u6-v7w8-9x0y-1z2a-3456789h', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('s4t5u6v7-w8x9-0y1z-2a3b-456789i0', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('s4t5u6v7-w8x9-0y1z-2a3b-456789i0', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('s4t5u6v7-w8x9-0y1z-2a3b-456789i0', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('s4t5u6v7-w8x9-0y1z-2a3b-456789i0', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('s4t5u6v7-w8x9-0y1z-2a3b-456789i0', '2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('t5u6v7w8-x9y0-1z2a-3b4c-567890j1', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('t5u6v7w8-x9y0-1z2a-3b4c-567890j1', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('t5u6v7w8-x9y0-1z2a-3b4c-567890j1', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('t5u6v7w8-x9y0-1z2a-3b4c-567890j1', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('t5u6v7w8-x9y0-1z2a-3b4c-567890j1', '2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('u1v2w3x4-y5z6-7a8b-9c0d-ef123456g', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('u1v2w3x4-y5z6-7a8b-9c0d-ef123456g', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('u1v2w3x4-y5z6-7a8b-9c0d-ef123456g', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('u1v2w3x4-y5z6-7a8b-9c0d-ef123456g', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('u1v2w3x4-y5z6-7a8b-9c0d-ef123456g', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('v2w3x4y5-z6a7-8b9c-0d1e-f2345678h', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('v2w3x4y5-z6a7-8b9c-0d1e-f2345678h', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('v2w3x4y5-z6a7-8b9c-0d1e-f2345678h', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('v2w3x4y5-z6a7-8b9c-0d1e-f2345678h', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('v2w3x4y5-z6a7-8b9c-0d1e-f2345678h', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('w3x4y5z6-a7b8-9c0d-1e2f-3456789i', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('w3x4y5z6-a7b8-9c0d-1e2f-3456789i', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('w3x4y5z6-a7b8-9c0d-1e2f-3456789i', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('w3x4y5z6-a7b8-9c0d-1e2f-3456789i', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('w3x4y5z6-a7b8-9c0d-1e2f-3456789i', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('x4y5z6a7-b8c9-0d1e-2f3g-456789j0', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('x4y5z6a7-b8c9-0d1e-2f3g-456789j0', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('x4y5z6a7-b8c9-0d1e-2f3g-456789j0', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('x4y5z6a7-b8c9-0d1e-2f3g-456789j0', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('x4y5z6a7-b8c9-0d1e-2f3g-456789j0', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('y5z6a7b8-c9d0-1e2f-3g4h-567890j1', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('y5z6a7b8-c9d0-1e2f-3g4h-567890j1', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('y5z6a7b8-c9d0-1e2f-3g4h-567890j1', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('y5z6a7b8-c9d0-1e2f-3g4h-567890j1', '2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('y5z6a7b8-c9d0-1e2f-3g4h-567890j1', '2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('z1a2b3c4-d5e6-7f8g-9h0i-j123456k', '2805b409-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('z1a2b3c4-d5e6-7f8g-9h0i-j123456k', '2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('z1a2b3c4-d5e6-7f8g-9h0i-j123456k', '2805b703-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('z1a2b3c4-d5e6-7f8g-9h0i-j123456k', '2805b833-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL),
('z1a2b3c4-d5e6-7f8g-9h0i-j123456k', '2805b925-556a-11ef-acc5-f8da0c52c1d8', 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` char(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `code`, `name`, `description`, `created_at`, `updated_at`) VALUES
('28012001-556a-11ef-acc5-f8da0c52c1d8', 'KC1', '35', 'Size suitable for foot length 22.5 - 23.0 cm', '2024-08-08 09:39:16', '2024-08-08 02:53:05'),
('2805b409-556a-11ef-acc5-f8da0c52c1d8', 'KC2', '36', 'Size suitable for foot length 23.0 - 23.5 cm', '2024-08-08 09:39:16', '2024-08-08 02:53:11'),
('2805b5c1-556a-11ef-acc5-f8da0c52c1d8', 'KC3', '37', 'Size suitable for foot length 23.5 - 24.0 cm', '2024-08-08 09:39:16', '2024-08-08 02:53:15'),
('2805b703-556a-11ef-acc5-f8da0c52c1d8', 'KC4', '38', 'Size suitable for foot length 24.0 - 24.5 cm', '2024-08-08 09:39:16', '2024-08-08 09:39:16'),
('2805b833-556a-11ef-acc5-f8da0c52c1d8', 'KC5', '39', 'Size suitable for foot length 24.5 - 25.0 cm', '2024-08-08 09:39:16', '2024-08-08 09:39:16'),
('2805b925-556a-11ef-acc5-f8da0c52c1d8', 'KC6', '40', 'Size suitable for foot length 25.0 - 25.5 cm', '2024-08-08 09:39:16', '2024-08-08 09:39:16'),
('2805b9dc-556a-11ef-acc5-f8da0c52c1d8', 'KC7', '41', 'Size suitable for foot length 25.5 - 26.0 cm', '2024-08-08 09:39:16', '2024-08-08 09:39:16'),
('2805ba8e-556a-11ef-acc5-f8da0c52c1d8', 'KC8', '42', 'Size suitable for foot length 26.0 - 26.5 cm', '2024-08-08 09:39:16', '2024-08-08 09:39:16'),
('2805bbc7-556a-11ef-acc5-f8da0c52c1d8', 'KC9', '43', 'Size suitable for foot length 26.5 - 27.0 cm', '2024-08-08 09:39:16', '2024-08-08 09:39:16'),
('2805bc88-556a-11ef-acc5-f8da0c52c1d8', 'KC10', '44', 'Size suitable for foot length 27.0 - 27.5 cm', '2024-08-08 09:39:16', '2024-08-08 09:39:16'),
('2805bd5c-556a-11ef-acc5-f8da0c52c1d8', 'KC11', '45', 'Size suitable for foot length 27.5 - 28.0 cm', '2024-08-08 09:39:16', '2024-08-08 09:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` char(36) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `code`, `name`, `description`, `created_at`, `updated_at`) VALUES
('172e536d-61f8-4ecb-8d97-83e1e9c5fb5e', 'S1', 'Chờ xác nhận', 'Trạng thái đầu tiên khi khách hàng đặt hàng thành công và hệ thống ghi nhận thông tin đơn hàng.', '2024-09-01 07:57:57', '2024-09-01 07:57:57'),
('33c397a4-6523-4e4b-b011-b0a025b68f81', 'S5', 'Đã hủy', NULL, '2024-09-01 07:58:41', '2024-09-01 07:58:41'),
('5a8ed144-0f68-4ffb-8b96-6863c9a0333e', 'S2', 'Chờ lấy hàng', 'Sản phẩm đã đóng gói xong và chờ đối tác vận chuyển đến lấy.', '2024-09-01 07:58:17', '2024-09-01 07:58:17'),
('6f1bc60b-0860-48b2-8566-b2a93434e7a1', 'S3', 'Đang giao hàng', NULL, '2024-09-01 07:58:32', '2024-09-01 07:58:32'),
('d122f2e1-0c43-4c9a-a490-853601297840', 'S4', 'Đã giao hàng', NULL, '2024-09-01 07:58:37', '2024-09-01 07:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `google_id`, `role`) VALUES
('9ccffe6a-c7a1-4392-9c93-b64757665078', 'Admin', 'tutai.dev@gmail.com', NULL, '$2y$10$wI0k6Hq1ZFMvd8J35CRmNueX0yZOup4rrPwAMnbon1PRCJCcP6Eja', NULL, '2024-08-20 09:30:05', '2024-09-09 18:14:27', 'admin', NULL, 'admin'),
('9cd0016d-81b9-4122-8d61-b532608d9c4c', 'Tú Tài', 'dtuandat2004@gmail.com', NULL, '$2y$10$LpfhxsITFAG7KCsgPJ3ozOMGmEudIKOThAUX/jvUy3IbN7dG7mFLK', NULL, '2024-08-20 09:38:30', '2024-09-09 18:14:11', 'root', NULL, 'client'),
('9cf72aa1-3070-4b07-9020-d40d5f05b5ba', 'Nguyễn Ngọc Tú Tài', 'tutaihocgioi@gmail.com', NULL, '$2y$10$vpS3iw9h9uxl0ok3c.hvaes1niSGFf9iXBNS/7GWo6R4ISZhdsclu', NULL, '2024-09-08 20:51:01', '2024-09-09 18:14:35', NULL, '114319876416698980495', 'client'),
('9cf8ff39-d7b2-4d78-a802-62eedf992827', 'NGUYEN VAN B', 'loptao@gmail.com', NULL, '$2y$10$xFrRSt56Sd.xvfEFaXcKyOjThCcUIMntptoG.6ciYOf.7tDGKgO5y', NULL, '2024-09-09 18:41:18', '2024-09-09 19:30:47', 'root1', NULL, 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`),
  ADD KEY `cart_items_size_id_foreign` (`size_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_code_unique` (`code`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_event` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_code_unique` (`code`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_status_id_foreign` (`status_id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_size_id_foreign` (`size_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_code_unique` (`code`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_event_id_foreign` (`event_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`product_id`,`size_id`),
  ADD KEY `product_sizes_size_id_foreign` (`size_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sizes_code_unique` (`code`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `statuses_code_unique` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_google_id_unique` (`google_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_sizes_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
