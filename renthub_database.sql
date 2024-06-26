-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 05:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `renthub_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amenities_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `amenities_name`, `created_at`, `updated_at`) VALUES
(1, 'Air Conditioned', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'user_id',
  `receiver_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'owner_id',
  `msg` text NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`id`, `sender_id`, `receiver_id`, `msg`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 22, 23, 'asdawdasdwasdawdasd', 1, '2024-06-25 07:49:54', '2024-06-25 07:50:04'),
(2, 23, 22, 'awasdwasdads', 0, '2024-06-25 07:50:23', '2024-06-25 07:50:23');

-- --------------------------------------------------------

--
-- Table structure for table `compares`
--

CREATE TABLE `compares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_uploaded` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `sender_email`, `receiver_email`, `file_path`, `created_at`, `updated_at`, `is_uploaded`) VALUES
(34, 'djPadilla@gmail.com', 'login@gmail.com', 'contracts/667ae3e83d07c_Screenshot 2024-05-29 133008.png', '2024-06-25 07:36:08', '2024-06-25 07:36:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `district_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `district_name`, `district_image`, `created_at`, `updated_at`) VALUES
(1, 'Paco', 'upload/district/1801726325060437.jpg', NULL, '2024-06-12 22:28:43'),
(2, 'Pandacan', 'upload/district/1801726451143319.jpg', NULL, NULL),
(3, 'Quiapo', 'upload/district/1801726760753090.jpg', NULL, NULL),
(4, 'Manila', 'upload/district/1801726781708436.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `description`, `file`, `created_at`, `updated_at`) VALUES
(1, 'test1', 'asd', 'public/assets/1709554605.pdf', '2024-03-04 04:16:45', '2024-03-04 04:16:45');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `facility_name` varchar(255) DEFAULT NULL,
  `distance` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `property_id`, `facility_name`, `distance`, `created_at`, `updated_at`) VALUES
(1, 1, 'Technological Institute of Manila', '1 km', '2024-02-20 04:37:50', '2024-02-20 04:37:50');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_19_085357_create_property_types_table', 1),
(6, '2023_10_19_113415_create_amenities_table', 1),
(7, '2023_10_19_123032_create_properties_table', 1),
(8, '2023_10_19_135701_create_multi_images_table', 1),
(9, '2023_10_19_135921_create_facilities_table', 1),
(10, '2023_10_24_093053_create_risks_table', 1),
(11, '2023_11_01_083809_create_package_plans_table', 1),
(12, '2023_11_03_120910_create_wishlists_table', 1),
(13, '2023_11_04_123630_create_compares_table', 1),
(14, '2023_11_04_141235_create_property_messages_table', 1),
(15, '2023_11_12_081804_create_districts_table', 1),
(16, '2023_11_14_144816_create_testimonials_table', 1),
(17, '2023_11_14_154659_create_schedules_table', 1),
(18, '2023_11_14_180152_create_smtp_settings_table', 1),
(19, '2023_11_15_024833_create_chat_messages_table', 1),
(20, '2023_12_08_054234_add_is_read_to_chat_messages', 1),
(21, '2024_01_06_100439_update_tenants_table', 1),
(22, '2024_01_06_142438_create_tests_table', 1),
(23, '2024_01_07_060938_create_tenants_table', 1),
(24, '2024_01_07_065904_remove_unique_constraint_from_tenant_email_on_tenants_table', 1),
(25, '2024_01_07_071938_add_status_to_tenants_table', 1),
(26, '2024_01_07_125058_create_utilities_table', 1),
(27, '2024_01_07_125246_add_columns_to_utilities_table', 1),
(28, '2024_01_07_163929_create_rent_billings_table', 1),
(29, '2024_01_07_165707_create_electricity_billings_table', 1),
(30, '2024_01_07_165708_create_water_billings_table', 1),
(31, '2024_01_08_172425_add_balance_to_electricity_billings_table', 1),
(32, '2024_01_08_172425_add_balance_to_water_billings_table', 1),
(33, '2024_01_08_172426_add_balance_to_rent_billings_table', 1),
(34, '2024_01_08_172811_allow_null_in_previous_reading_for_electricity_billings', 1),
(35, '2024_01_08_195841_modify_rent_billings_table', 1),
(36, '2024_01_09_183133_create_payment_logs_table', 1),
(37, '2024_01_09_211914_add_sender_email_to_payment_logs_table', 1),
(38, '2024_02_20_145952_create_site_settings_table', 2),
(39, '2024_02_21_124923_create_permission_tables', 3),
(40, '2024_03_02_102426_create_or_update_rent_billings_table', 4),
(41, '2024_03_02_103417_create_rent_billings_table', 5),
(42, '2024_03_03_062617_create_agreements_table', 6),
(43, '2024_03_03_121024_create_rental_agreements_table', 7),
(44, '2024_03_03_122304_create_files_table', 8),
(45, '2024_03_04_113133_create_pdf_texts_table', 9),
(46, '2024_03_04_115853_create_documents_table', 10),
(47, '2024_03_04_145638_create_contracts_table', 11),
(48, '2024_03_05_133652_create_lease_agreements_table', 12),
(49, '2024_03_05_141031_add_signed_columns_to_lease_agreements_table', 13),
(50, '2024_03_14_123547_create_lease_agreements_table', 14),
(51, '2024_03_14_124010_create_lease_agreements_table', 15),
(52, '2024_03_14_132728_add_start_date_to_lease_agreements_table', 16),
(53, '2024_03_14_132945_add_breach_correction_period_to_lease_agreements_table', 17),
(54, '2024_03_14_133049_set_default_value_for_agreement_date_in_lease_agreements', 18),
(55, '2024_03_15_142707_create_receipts_table', 19),
(56, '2024_03_22_121048_update_unique_constraints_on_tenants_table', 20),
(57, '2024_03_22_121438_adjust_unique_constraints_for_tenants', 21),
(58, '2024_03_22_131135_add_renter_address_to_tenants_table', 22),
(62, '2024_03_22_132715_rename_renter_address_to_tenant_email_in_lease_agreements', 23),
(63, '2024_05_08_151432_create_contracts_table', 24),
(64, '2024_05_12_170134_add_is_uploaded_to_contracts_table', 25),
(65, '2024_06_17_150104_add_rental_duration_to_tenants_table', 26),
(66, '2024_06_17_150331_add_rental_duration_to_tenants_table', 27),
(67, '2024_06_17_151404_create_rent_bills_table', 28),
(68, '2024_06_17_153423_remove_tenant_name_from_rent_bills_table', 29),
(69, '2024_06_18_112918_add_payment_date_and_month_and_receipt_id_to_rent_bills_table', 30),
(70, '2024_06_18_121504_add_assigned_to_payment_logs_table', 31),
(71, '2024_06_18_171505_add_assigned_to_receipts_table', 32);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `multi_images`
--

CREATE TABLE `multi_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `photo_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `multi_images`
--

INSERT INTO `multi_images` (`id`, `property_id`, `photo_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'upload/property/multi-image/1791421495068677.jpg', '2024-02-20 04:37:49', NULL),
(2, 1, 'upload/property/multi-image/1791421495214042.jpg', '2024-02-20 04:37:50', NULL),
(3, 1, 'upload/property/multi-image/1791421495402651.jpg', '2024-02-20 04:37:50', NULL),
(4, 1, 'upload/property/multi-image/1791421495541143.jpg', '2024-02-20 04:37:50', NULL),
(5, 2, 'upload/property/multi-image/1793778409639645.jpg', '2024-03-17 04:59:59', NULL),
(6, 2, 'upload/property/multi-image/1793778410312320.jpg', '2024-03-17 05:00:01', NULL),
(7, 2, 'upload/property/multi-image/1793778412227622.jpg', '2024-03-17 05:00:02', NULL),
(8, 3, 'upload/property/multi-image/1793795471810335.jpg', '2024-03-17 09:31:10', NULL),
(9, 3, 'upload/property/multi-image/1801725307454971.jpg', NULL, '2024-06-12 22:12:31'),
(10, 3, 'upload/property/multi-image/1801725318280511.jpg', NULL, '2024-06-12 22:12:41');

-- --------------------------------------------------------

--
-- Table structure for table `package_plans`
--

CREATE TABLE `package_plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_name` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `package_credits` varchar(255) DEFAULT NULL,
  `package_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `receipt_image_path` varchar(255) DEFAULT NULL,
  `recipient_email` varchar(255) NOT NULL,
  `sender_email` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assigned` varchar(255) NOT NULL DEFAULT 'unassigned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pdf_texts`
--

CREATE TABLE `pdf_texts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'type.menu', 'web', 'type', '2024-02-21 05:28:48', '2024-02-21 05:28:48'),
(2, 'all.type', 'web', 'type', '2024-02-21 05:30:02', '2024-02-21 05:30:02'),
(3, 'add.type', 'web', 'type', '2024-02-21 05:30:19', '2024-02-21 05:30:19'),
(4, 'edit.type', 'web', 'type', '2024-02-21 05:30:31', '2024-02-21 05:30:31'),
(5, 'delete.type', 'web', 'type', '2024-02-21 05:30:41', '2024-02-21 05:30:41');

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
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ptype_id` varchar(255) NOT NULL,
  `amenities_id` varchar(255) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_slug` varchar(255) NOT NULL,
  `property_code` varchar(255) NOT NULL,
  `property_status` varchar(255) NOT NULL,
  `furnish_status` varchar(255) NOT NULL,
  `validid_type` varchar(255) NOT NULL,
  `validId_photo` varchar(255) NOT NULL,
  `rent_price` varchar(255) DEFAULT NULL,
  `rent_duration` varchar(255) DEFAULT NULL,
  `property_thumbnail` varchar(255) NOT NULL,
  `short_desc` text DEFAULT NULL,
  `long_desc` text DEFAULT NULL,
  `bedrooms` varchar(255) DEFAULT NULL,
  `bathrooms` varchar(255) DEFAULT NULL,
  `garage` varchar(255) DEFAULT NULL,
  `garage_size` varchar(255) DEFAULT NULL,
  `property_size` varchar(255) DEFAULT NULL,
  `property_video` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `featured` varchar(255) DEFAULT NULL,
  `hot` varchar(255) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `ptype_id`, `amenities_id`, `property_name`, `property_slug`, `property_code`, `property_status`, `furnish_status`, `validid_type`, `validId_photo`, `rent_price`, `rent_duration`, `property_thumbnail`, `short_desc`, `long_desc`, `bedrooms`, `bathrooms`, `garage`, `garage_size`, `property_size`, `property_video`, `address`, `city`, `province`, `postal_code`, `barangay`, `latitude`, `longitude`, `featured`, `hot`, `owner_id`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Air Conditioned', 'TIP Dorm', 'tip-dorm', 'PC001', 'rent', 'furnished', 'passport id', 'upload/property/valid-id/1791421494951277.jpg', '12,000', '12 months', 'upload/property/thumbnail/1791421494843042.jpg', 'Experience the ultimate in student living at our state-of-the-art dormitory, featuring fully furnished rooms, high-speed internet, and dedicated study areas. Located just steps from campus, enjoy a vibrant community atmosphere with access to a fitness center, communal kitchens, and 24-hour security.', '<p>Welcome to the pinnacle of student living at our premier dormitory, designed to meet all your academic and social needs. Each room comes fully furnished with comfortable beds, ample storage, and a well-lit desk, ensuring a productive study environment. High-speed internet access is available throughout the building, so you can stay connected and on top of your coursework.</p>\r\n<p>Our dormitory is more than just a place to sleep; it&rsquo;s a thriving community where students can grow and thrive. Communal kitchens on each floor offer the perfect space to cook meals and socialize with fellow residents. The dedicated study areas and quiet lounges provide the ideal setting for group projects or solitary study sessions, ensuring you have everything you need to succeed academically.</p>\r\n<p>Stay active and healthy with access to our state-of-the-art fitness center, equipped with the latest exercise machines and free weights. After a workout, relax and unwind in the student lounge, where you can catch up with friends, watch TV, or participate in dormitory-organized events and activities.</p>\r\n<p>Safety and security are top priorities, with 24-hour security personnel and secure entry systems in place to ensure peace of mind for all residents. Located just steps from campus, you&rsquo;ll enjoy the convenience of a short walk to classes, libraries, and campus events, allowing you to fully immerse yourself in college life.</p>\r\n<p>Our dormitory offers the perfect blend of comfort, convenience, and community, providing an exceptional living experience that supports both your academic and personal growth. Join us and discover a vibrant, supportive environment where you can create lasting memories and lifelong friendships.</p>', '1', '1', '1', '120', '12000', 'n/a', '1338 Arlegui St, Quiapo, Manila, 1005 Metro Manila', 'Manila', 'Metro Manila', '1005', 'Quiapo', '14.59973990829963', '120.98278433580431', '1', NULL, 23, '1', '2024-02-20 04:37:49', '2024-06-12 22:33:19'),
(2, '1', 'Air Conditioned', 'MLS Condo', 'mls-condo', 'PC002', 'rent', 'furnished', 'passport id', 'upload/property/valid-id/1793778409506720.png', '10000', '12 months', 'upload/property/thumbnail/1801724167173349.jpg', 'Nestled in a prime urban location, this modern 2-bedroom, 2-bathroom condo offers luxurious living with stunning city views. Boasting an open-concept design, the unit features high-end finishes, including granite countertops, stainless steel appliances, and hardwood floors.', '<p>Welcome to your dream home in the heart of the city! This exceptional 2-bedroom, 2-bathroom condo epitomizes luxury and contemporary living. From the moment you step inside, you are greeted by an open-concept layout designed to maximize space and natural light. The living area is adorned with floor-to-ceiling windows, offering breathtaking panoramic views of the city skyline.&nbsp;</p>\r\n<p>The gourmet kitchen is a chef\'s delight, featuring sleek granite countertops, state-of-the-art stainless steel appliances, and custom cabinetry. The expansive island provides ample space for meal preparation and casual dining, making it the perfect spot for entertaining guests. Adjacent to the kitchen, the living and dining areas flow seamlessly, creating a harmonious environment for relaxation and socializing.</p>\r\n<p>Retreat to the serene master suite, where you will find a generous walk-in closet and a luxurious en-suite bathroom complete with a double vanity, soaking tub, and a glass-enclosed shower. The second bedroom is equally inviting, offering ample closet space and easy access to the second full bathroom, which is tastefully designed with modern fixtures and finishes.</p>\r\n<p>This condo is not just about the interior; the building itself offers an array of premium amenities designed to enhance your lifestyle. Enjoy the convenience of a 24-hour concierge service, a state-of-the-art fitness center, and a stunning rooftop terrace where you can unwind and take in the cityscape. Additional amenities include a resident lounge, secure underground parking, and bike storage.</p>\r\n<p>Located in a vibrant neighborhood, this condo is just steps away from an eclectic mix of shops, gourmet restaurants, and entertainment options. Excellent public transportation links ensure easy access to all parts of the city, making your commute a breeze.</p>\r\n<p>Experience urban living at its finest in this sophisticated condo, where luxury, comfort, and convenience converge to create the perfect home. Don&rsquo;t miss the opportunity to make this exquisite property yours!</p>', '2', '1', '1', '124 sq', '100 sq', 'N/A', 'Building 3, Residencias De Manila, Paco, Manila, 1008 Metro Manila', 'San Pascual, Batangas', 'Batangas', '4204', 'Paco', '14.594532', '121.002933', '1', '1', 2, '1', '2024-03-17 04:59:58', '2024-06-12 22:31:31'),
(3, '2', 'Air Conditioned', 'JR Apartment', 'jr-apartment', 'PC003', 'rent', 'furnished', 'passport id', 'upload/property/valid-id/1793795471675140.png', '10000', '12 months', 'upload/property/thumbnail/1801725174758511.jpg', 'Discover urban elegance in this charming 1-bedroom, 1-bathroom apartment located in a vibrant city neighborhood. Featuring an open floor plan, this unit is enhanced with modern finishes including stainless steel appliances, granite countertops, and hardwood floors.', '<p>Welcome to your new home in one of the city\'s most sought-after neighborhoods! This stunning 1-bedroom, 1-bathroom apartment offers a perfect blend of modern sophistication and urban convenience. As you step inside, you&rsquo;ll be greeted by an open floor plan that seamlessly combines the living, dining, and kitchen areas, creating a bright and inviting space.</p>\r\n<p>The kitchen is a culinary enthusiast\'s dream, featuring sleek granite countertops, high-end stainless steel appliances, and contemporary cabinetry. The adjoining living area, with its rich hardwood floors and large windows, provides a warm and welcoming environment, ideal for both relaxing and entertaining.</p>\r\n<p>The spacious bedroom is a private retreat, boasting generous closet space and large windows that fill the room with natural light. The bathroom is elegantly designed with modern fixtures, a stylish vanity, and a luxurious shower/tub combination, offering a spa-like experience at home.</p>\r\n<p>This apartment doesn\'t just offer a beautiful living space; it also provides access to an array of premium amenities. Residents can enjoy a state-of-the-art fitness center, a stunning rooftop deck with panoramic city views, and a secure building with 24-hour security for peace of mind. Additionally, there is a resident lounge and convenient bike storage available.</p>\r\n<p>Perfectly positioned in a vibrant area, this apartment is just steps away from a diverse array of dining, shopping, and entertainment options. Excellent public transportation links are nearby, ensuring easy access to the entire city and beyond.</p>\r\n<p>Embrace the best of urban living in this exquisite apartment, where style, comfort, and convenience come together to create an exceptional home. Don\'t miss the chance to make this incredible property your own!</p>', '2', '1', '1', '124 sq', '100 sq', 'N/A', '#147 Malaking Pook', 'San Pascual, Batangas', 'Manila', '4204', 'Manila', '14.600263685734667', '120.98245925220267', '1', '1', 2, '1', '2024-03-17 09:31:10', '2024-06-12 22:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `property_messages`
--

CREATE TABLE `property_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `owner_id` varchar(255) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `msg_name` varchar(255) DEFAULT NULL,
  `msg_email` varchar(255) DEFAULT NULL,
  `msg_phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_messages`
--

INSERT INTO `property_messages` (`id`, `user_id`, `owner_id`, `property_id`, `msg_name`, `msg_email`, `msg_phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 12, '10', 1, 'final test', 'final@gmail.com', NULL, NULL, '2024-03-07 07:56:43', NULL),
(2, 12, '10', 1, 'final test', 'final@gmail.com', NULL, NULL, '2024-03-07 07:57:06', NULL),
(3, 12, '10', 1, 'final test', 'final@gmail.com', NULL, NULL, '2024-03-07 08:04:12', NULL),
(5, 22, '23', 1, 'login', 'login@gmail.com', '91324123', 'asdasdawas', '2024-06-25 07:49:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `type_name`, `type_icon`, `created_at`, `updated_at`) VALUES
(1, 'Condominium', 'icon-1', NULL, NULL),
(2, 'Apartment', 'icon-2', NULL, NULL),
(3, 'Dormitory', 'icon-3', NULL, NULL),
(4, 'Villa', 'icon-5', NULL, NULL),
(5, 'Residential', 'icon-4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

CREATE TABLE `receipts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_of_payment` date NOT NULL,
  `receipt_number` varchar(255) NOT NULL,
  `amount_paid` decimal(8,2) NOT NULL,
  `property_address` varchar(255) NOT NULL,
  `tenant_name` varchar(255) NOT NULL,
  `landlord_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assigned` varchar(255) NOT NULL DEFAULT 'unassigned'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rent_bills`
--

CREATE TABLE `rent_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `tenant_email` varchar(255) NOT NULL,
  `monthly_rent` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_month` varchar(255) DEFAULT NULL,
  `receipt_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risks`
--

CREATE TABLE `risks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `risk_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `risks`
--

INSERT INTO `risks` (`id`, `property_id`, `risk_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'N/A', '2024-02-20 04:37:50', '2024-02-20 04:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `owner_id` varchar(255) DEFAULT NULL,
  `tour_date` varchar(255) DEFAULT NULL,
  `tour_time` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `support_phone` varchar(255) DEFAULT NULL,
  `company_address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `logo`, `support_phone`, `company_address`, `email`, `facebook`, `twitter`, `copyright`, `created_at`, `updated_at`) VALUES
(1, 'upload/logo/1791436733646232.png', '+639173679314', 'Tip Arlegui Campus', 'Renthub@gmail.com', 'https://facebook.com/', 'https://twitter.com/', 'Copyright © 2023 RentHub.', NULL, '2024-02-20 08:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_settings`
--

CREATE TABLE `smtp_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mailer` varchar(255) DEFAULT NULL,
  `host` varchar(255) DEFAULT NULL,
  `post` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `encryption` varchar(255) DEFAULT NULL,
  `from_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_price` decimal(8,2) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `tenant_email` varchar(255) NOT NULL,
  `renter_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('accepted','rejected','pending') NOT NULL DEFAULT 'pending',
  `rental_duration` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `position`, `image`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Leigh Esclanda', 'Chief', 'upload/testimonial/1801727722969522.jpg', 'As the Chief Executive Officer of our real estate firm, I take immense pride in the properties we feature and the exceptional service we provide. Our dedicated team works tirelessly to curate a selection of properties that not only meet but exceed our clients\' expectations. Each featured listing is chosen for its unique qualities and potential to offer a truly outstanding living experience. We believe in the power of personal touch and professional expertise to help you find your dream home or investment opportunity. Thank you for trusting us with your real estate needs.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
  `address` text DEFAULT NULL,
  `role` enum('admin','owner','tenant','user') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT (case when `role` = 'owner' then 'inactive' else 'active' end),
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `phone`, `address`, `role`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$ycdRRZwxHDXKOdpR1/RasOCm1jGD0eFInTQEOBx4NiS...', NULL, NULL, NULL, 'admin', 'active', NULL, NULL, NULL),
(2, 'Owner', 'owner', 'owner@gmail.com', NULL, '$2y$10$TrXf3PO9hd.7W6vCIbupRe2Lfp.o6ayHvSq0jsgY46m...', '202406130637alexander-hipp-iEEBWgY_6lA-unsplash.jp...', NULL, NULL, 'owner', 'active', NULL, '2024-06-12 22:37:28', NULL),
(3, 'Tenant', 'tenant', 'tenant@gmail.com', NULL, '$2y$10$JSniiH6aFyiFsw9v9VQET.pLi6sUmueC/v6z9/qq4wu...', NULL, NULL, NULL, 'tenant', 'active', NULL, NULL, NULL),
(4, 'User', 'user', 'user@gmail.com', NULL, '$2y$10$qElsaEJ49ZRplQDIwt8Viekd1aAhoJ4jqaCfMBiRL14...', NULL, NULL, NULL, 'tenant', 'active', NULL, '2024-03-17 07:52:04', NULL),
(5, 'Clifton West', NULL, 'zhills@example.net', '2024-02-20 04:24:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2...', 'https://via.placeholder.com/60x60.png/0088ee?text=...', '517.326.6760', '3927 Weissnat Inlet Makaylaburgh, OH 00910', 'tenant', 'inactive', 'nJDmiFgmG3', '2024-02-20 04:24:38', '2024-02-20 04:24:38'),
(6, 'Constantin Price', NULL, 'jaylan.veum@example.net', '2024-02-20 04:24:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2...', 'https://via.placeholder.com/60x60.png/000022?text=...', '847-484-8587', '10970 Fisher Landing Jakubowskiside, NH 34355-1492', 'user', 'active', 'tUTpV9HFZI', '2024-02-20 04:24:38', '2024-02-20 04:24:38'),
(7, 'Tom Hackett', NULL, 'askiles@example.org', '2024-02-20 04:24:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2...', 'https://via.placeholder.com/60x60.png/00dd99?text=...', '+1-281-918-7103', '394 Emelie Corners Towneburgh, CO 60639', 'user', 'active', 'BvpQ1jbFWG', '2024-02-20 04:24:38', '2024-02-20 04:24:38'),
(8, 'Urban Hills', NULL, 'pagac.bruce@example.org', '2024-02-20 04:24:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2...', 'https://via.placeholder.com/60x60.png/005522?text=...', '601-438-6479', '6664 Treutel Plain Apt. 008 Lake Huntermouth, ND 4...', 'tenant', 'active', 'WrQwm31Vxg', '2024-02-20 04:24:38', '2024-02-20 04:24:38'),
(9, 'Dr. Irving Gorczany V', NULL, 'ernie25@example.net', '2024-02-20 04:24:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2...', '998f41fc4c63e69c06b99a6e03629815.jpg', '+1 (952) 888-9155', '5300 Upton Camp Vonville, ME 13218', 'owner', 'active', '8VyOgeUq36', '2024-02-20 04:24:38', '2024-06-12 04:13:15'),
(10, 'Daniel Padilla', NULL, 'djPadilla1@gmail.com', NULL, '$2y$10$kyJ4oMhqTSptMvebrFE./OPglScDL9kqQMo/WmZEfby...', 'Landlord-vs-Property-Manager.jpg', NULL, NULL, 'owner', 'active', NULL, '2024-02-20 04:24:55', '2024-02-20 04:31:45'),
(11, 'Gab Esclanda', NULL, 'gab@gmail.com', NULL, '$2y$10$a6xPxNZcJ99monzqq8JjGeuzMZ4kcHRF4pwLho20tAC...', NULL, NULL, NULL, 'owner', 'inactive', NULL, '2024-06-12 22:53:12', '2024-06-12 22:53:12'),
(12, 'final@gmail.com', NULL, 'final@gmail.com', NULL, '$2y$10$TqYlF2Gyr1pXwIPB637RueC7W73p68n67TedCSAE0Hb...', NULL, NULL, NULL, 'tenant', 'active', NULL, '2024-06-24 01:40:08', '2024-06-24 01:55:28'),
(22, 'login', NULL, 'login@gmail.com', NULL, '$2y$10$q3zc3CVhjCNihbLKQsUMzuzoDrcBsryQ7L/SeH441Tr3bvVq4qJHS', NULL, NULL, NULL, 'tenant', 'active', NULL, '2024-06-25 07:16:50', '2024-06-25 07:33:12'),
(23, 'Daniel Padilla', NULL, 'djPadilla@gmail.com', NULL, '$2y$10$pLCDfylqdWf/7iIDm3NUk.jMPf2lfj9i3UYXo3eaSFzQ1hwQXqiku', 'Landlord-vs-Property-Manager.jpg', NULL, NULL, 'owner', 'active', NULL, '2024-06-25 07:24:09', '2024-06-25 07:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `utilities`
--

CREATE TABLE `utilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `owner_email` varchar(255) NOT NULL,
  `tenant_email` varchar(255) NOT NULL,
  `rent` decimal(10,2) NOT NULL,
  `electricity` decimal(10,2) NOT NULL,
  `water` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compares`
--
ALTER TABLE `compares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contracts_sender_email_foreign` (`sender_email`),
  ADD KEY `contracts_receiver_email_foreign` (`receiver_email`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `multi_images`
--
ALTER TABLE `multi_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_plans`
--
ALTER TABLE `package_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `pdf_texts`
--
ALTER TABLE `pdf_texts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_messages`
--
ALTER TABLE `property_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipts`
--
ALTER TABLE `receipts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent_bills`
--
ALTER TABLE `rent_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rent_bills_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `risks`
--
ALTER TABLE `risks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tenant_email_property_name_unique` (`tenant_email`,`property_name`),
  ADD UNIQUE KEY `tenant_property_unique` (`tenant_email`,`property_name`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `utilities`
--
ALTER TABLE `utilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `compares`
--
ALTER TABLE `compares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `multi_images`
--
ALTER TABLE `multi_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `package_plans`
--
ALTER TABLE `package_plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `pdf_texts`
--
ALTER TABLE `pdf_texts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_messages`
--
ALTER TABLE `property_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `receipts`
--
ALTER TABLE `receipts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `rent_bills`
--
ALTER TABLE `rent_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `risks`
--
ALTER TABLE `risks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `smtp_settings`
--
ALTER TABLE `smtp_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `utilities`
--
ALTER TABLE `utilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_receiver_email_foreign` FOREIGN KEY (`receiver_email`) REFERENCES `users` (`email`),
  ADD CONSTRAINT `contracts_sender_email_foreign` FOREIGN KEY (`sender_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD CONSTRAINT `payment_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rent_bills`
--
ALTER TABLE `rent_bills`
  ADD CONSTRAINT `rent_bills_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
