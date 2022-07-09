/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.17-MariaDB : Database - test_skote
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test_skote` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `test_skote`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `failed_jobs` */

/*Table structure for table `mail_templates` */

DROP TABLE IF EXISTS `mail_templates`;

CREATE TABLE `mail_templates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template_code` varchar(255) DEFAULT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `mailable` varchar(255) NOT NULL,
  `subject` text DEFAULT NULL,
  `html_template` longtext NOT NULL,
  `text_template` longtext DEFAULT NULL,
  `template_type` enum('SMS','EMAIL') DEFAULT 'EMAIL',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mail_templates` */

insert  into `mail_templates`(`id`,`template_code`,`template_name`,`mailable`,`subject`,`html_template`,`text_template`,`template_type`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) values 
(19,'create_user_notification','Create user notification','App\\Mail\\UserCreateNotification','User Create Notification','<p>Hello {{NAME}}</p>\r\n\r\n<p>We have created your account in {{PRACTICE_NAME}} backen and below is the login details.</p>\r\n\r\n<p>Username: {{USER}}</p>\r\n\r\n<p>Password: {{PASSWORD}}</p>\r\n\r\n<p>{{LOGIN}}</p>\r\n\r\n<p>Regards,<br />\r\n{{PRACTICE_NAME}}</p>\r\n\r\n<p><span style=\"color:#e74c3c\"><strong>DO NOT REPLY TO THIS E-MAIL</strong></span><br />\r\nThis is an automated e-mail message sent from our support system.<br />\r\nDo not reply to this e-mail as we will not receive your reply!</p>','Hello \\n \\n I am inviting you to a video consultation session. Please click below to join the consultation (no account needed) \\n \\nVideo consultation time: {time} \\n \\nVideo consultation link: {URL} \\n \\nBest Regards,\\n{PRACTICE_NAME}','EMAIL',NULL,NULL,'2021-09-30 07:52:54',NULL,NULL,NULL),
(21,'reset_password_notification','Reset Password Notification','App\\Mail\\ResetPasswordMail','Reset Password Notification','<p>You are receiving this email because we received a password reset request for your account.</p>\r\n\r\n<p>{{RESET}}</p>\r\n\r\n<p>This password reset link will expire in 60 minutes.</p>\r\n\r\n<p>If you did not request a password reset, no further action is required.</p>\r\n\r\n<p>Regards,<br />\r\n{{PRACTICE_NAME}}</p>\r\n\r\n<p><span style=\"color:#e74c3c\"><strong>DO NOT REPLY TO THIS E-MAIL</strong></span><br />\r\nThis is an automated e-mail message sent from our support system.<br />\r\nDo not reply to this e-mail as we will not receive your reply!</p>','Hello \\n \\n I am inviting you to a video consultation session. Please click below to join the consultation (no account needed) \\n \\nVideo consultation time: {time} \\n \\nVideo consultation link: {URL} \\n \\nBest Regards,\\n{PRACTICE_NAME}','EMAIL',NULL,NULL,'2022-01-27 07:31:15',NULL,NULL,NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2021_09_30_053857_create_permission_tables',1),
(6,'2018_10_10_000000_create_mail_templates_table',2);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values 
(1,'App\\Models\\User',2),
(1,'App\\Models\\User',8),
(2,'App\\Models\\User',5),
(2,'App\\Models\\User',6),
(2,'App\\Models\\User',7),
(2,'App\\Models\\User',12),
(2,'App\\Models\\User',15),
(6,'App\\Models\\User',16);

/*Table structure for table `oauth_access_tokens` */

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_access_tokens` */

/*Table structure for table `oauth_auth_codes` */

DROP TABLE IF EXISTS `oauth_auth_codes`;

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_auth_codes` */

/*Table structure for table `oauth_clients` */

DROP TABLE IF EXISTS `oauth_clients`;

CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_clients` */

/*Table structure for table `oauth_personal_access_clients` */

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_personal_access_clients` */

/*Table structure for table `oauth_refresh_tokens` */

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_refresh_tokens` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `password_resets` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `permission_label` varchar(255) DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`title`,`name`,`permission_label`,`guard_name`,`is_active`,`created_at`,`updated_at`) values 
(1,'Dashboard','home','Dashboard','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(2,'Settings','setting.index','Site configuration show','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(3,'Settings','emailtemplate.index','Email template show','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(4,'Settings','emailtemplates.create','Email edit','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(5,'User and role management','usermanagement.index','User show','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(6,'User and role management','usermanagements.create','User create','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(7,'User and role management','usermanagements.edit','User edit','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(8,'User and role management','usermanagements.destroy','User delete','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(9,'User and role management','role.index','Role show','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(10,'User and role management','roles.create','Role create','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(11,'User and role management','roles.edit','Role edit','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57'),
(12,'User and role management','roles.destroy','Role delete','web','Y','2021-09-30 06:06:57','2021-09-30 06:06:57');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values 
(1,2),
(1,6),
(2,2),
(2,6),
(3,2),
(3,6),
(4,2),
(4,6),
(5,2),
(5,6),
(6,2),
(6,6),
(7,2),
(7,6),
(8,2),
(8,6),
(9,2),
(9,6),
(10,2),
(10,6),
(11,2),
(11,6),
(12,2),
(12,6);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `show_while_creating_user` enum('YES','NO') DEFAULT 'YES',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`show_while_creating_user`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) values 
(1,'Super Admin','web','YES','2021-09-30 06:02:37',NULL,'2021-09-30 06:02:37',NULL,NULL,NULL),
(2,'Admin','web','YES','2021-09-30 06:02:38',NULL,'2021-09-30 06:02:38',NULL,NULL,NULL),
(6,'Demo 1','web','YES','2022-01-27 07:16:05',NULL,'2022-01-27 07:16:36',NULL,NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) NOT NULL,
  `logins` int(11) DEFAULT NULL,
  `last_login_at` datetime DEFAULT NULL,
  `last_login_ip` varchar(50) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`profile`,`remember_token`,`logins`,`last_login_at`,`last_login_ip`,`is_active`,`created_at`,`created_by`,`updated_at`,`updated_by`,`deleted_at`,`deleted_by`) values 
(2,'Admin','itplanet99@gmail.com',NULL,'$2y$10$ToxxJm5ajt7mSRb2tYCM4O9OpH5W7FEEt0nXIUd.gkG6D4euXv2T2','6pf3xNrGHKPBeSa7gmyNXkGnf0cSRoICLnU9YnIy.png','TVFRdhErfEBjNySy9sVQN65POXA9iyoGdq8ZqTYcwvonpls64XVZ0N17Rh47',1,'2022-03-21 18:39:51','127.0.0.1',NULL,'2021-09-30 06:14:32',NULL,'2022-03-21 18:39:51',NULL,NULL,NULL),
(4,'Alea Ward','navyro@mailinator.com',NULL,'$2y$10$ToxxJm5ajt7mSRb2tYCM4O9OpH5W7FEEt0nXIUd.gkG6D4euXv2T2',NULL,'',NULL,NULL,NULL,'N','2021-09-30 07:28:54',NULL,'2022-03-21 18:34:00',NULL,NULL,NULL),
(6,'Macon Shelton','sanjay.makwana@tiez.nl',NULL,'$2y$10$g29cJMCKoycpOtteglAH7u0A2K3E7YyCBLnEJRsObmDe0SgpcTbO.',NULL,'1DOY2KaYBdCPLsbzDN7ZknAm2qD7equ4WhimO3Tv7E990udvhHAy8SrB0VD9',NULL,NULL,NULL,NULL,'2021-09-30 08:02:25',NULL,'2021-10-05 08:08:32',NULL,NULL,NULL),
(7,'Jasper Zimmerman','qiwemitoce@mailinator.com',NULL,'$2y$10$g29cJMCKoycpOtteglAH7u0A2K3E7YyCBLnEJRsObmDe0SgpcTbO.',NULL,'',NULL,NULL,NULL,NULL,'2021-09-30 08:12:04',NULL,'2021-10-05 08:08:46',NULL,NULL,NULL),
(8,'Flynn Tyson','tiwyco@mailinator.com',NULL,'$2y$10$g29cJMCKoycpOtteglAH7u0A2K3E7YyCBLnEJRsObmDe0SgpcTbO.',NULL,'',NULL,NULL,NULL,NULL,'2021-10-05 07:58:19',NULL,'2021-10-05 07:58:19',NULL,NULL,NULL),
(12,'Cameron Suarez','genawysusa@mailinator.com',NULL,'$2y$10$g29cJMCKoycpOtteglAH7u0A2K3E7YyCBLnEJRsObmDe0SgpcTbO.',NULL,'flFa40n8q75vc3vR3rioExOF7UEyubnI7i27rpQLvJvpcvuFiyjMpcDhwZae',NULL,NULL,NULL,NULL,'2021-10-28 10:40:08',NULL,'2021-11-01 07:00:51',NULL,NULL,NULL),
(15,'Octavius Sykes','sufib@mailinator.com',NULL,'$2y$10$Q.CCydgEHFx2TunhGn/iauKnLdziE/p76SHMIQhlLPdiqBV.AxQUi',NULL,'',NULL,NULL,NULL,'N','2022-01-27 07:26:36',NULL,'2022-03-21 17:01:38',NULL,NULL,NULL),
(16,'Hyatt Walls','byno@mailinator.com',NULL,'$2y$10$YP0e9BEZaNkr3U2q8i4kau.s9wFE0oml2zBlpx4213s4pAa3dwx7O',NULL,'',NULL,NULL,NULL,'Y','2022-03-21 18:41:05',NULL,'2022-03-21 18:41:05',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
