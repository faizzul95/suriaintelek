-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2022 at 09:06 AM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suriaintelek_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `general_content`
--

DROP TABLE IF EXISTS `general_content`;
CREATE TABLE IF NOT EXISTS `general_content` (
  `content_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `content_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content_type` tinyint DEFAULT NULL COMMENT '1-Term&Condition, 2-PrivacyPolicy, 3-Announcement, 4-Application, 5-Registration, 6-Enrolled, 8-Payment Invoice Reject, 9-Invoice, 10-Receipt, 11 - Payment Receive',
  `content_with_data` tinyint DEFAULT '0' COMMENT '0-No, 1-Yes',
  `content_status` tinyint DEFAULT NULL COMMENT '0-Draft, 1-Publish, 2-Unpublished',
  `publish_type` tinyint DEFAULT NULL COMMENT '1-Permanent, 2-By Date',
  `publish_start_date` datetime DEFAULT NULL,
  `publish_end_date` datetime DEFAULT NULL,
  `school_id` bigint UNSIGNED DEFAULT NULL COMMENT 'Refer table master_school',
  `user_id` bigint UNSIGNED DEFAULT NULL COMMENT 'Refer table user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`content_id`),
  KEY `school_id` (`school_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_content`
--

INSERT INTO `general_content` (`content_id`, `content_name`, `content_description`, `content_type`, `content_with_data`, `content_status`, `publish_type`, `publish_start_date`, `publish_end_date`, `school_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'TnC KWSP', '<div><span style=\"font-size: 22px;\"><b>PERAKUAN PEMOHON</b></span></div><div><br></div><div>1. Saya mengesahkan bahawa semua maklumat yang dikemukakan bagi permohonan ini adalah benar dan betul.</div><div><br></div><div>2. Saya mengesahkan bahawa permohonan ini dibuat oleh saya sendiri berdasarkan maklumat pengenalan diri saya yang telah didaftarkan di KWSP.</div><div><br></div><div>3. Saya memahami bahawa adalah menjadi suatu kesalahan sekiranya saya memberikan apa-apa maklumat yang tidak benar atau tidak betul atau mengemukakan apa-apa dokumen palsu dan saya boleh dikenakan denda atau dipenjara atau kedua-duanya.</div><div><br></div><div>4. Saya memahami bahawa kelayakan amaun pengeluaran adalah tertakluk kepada baki simpanan saya pada tarikh permohonan diterima dan amaun bayaran sebenar pengeluaran adalah berdasarkan jumlah simpanan dalam Akaun 2 dan/atau Akaun 1 saya pada tarikh bayaran diproses (mana yang lebih rendah).</div><div><br></div><div>5. Saya memahami bahawa apa-apa caruman atau wang yang diterima akan dikreditkan oleh KWSP ke dalam Akaun 1 saya bagi menggantikan amaun pengeluaran berserta tambahan sebanyak dua puluh peratus (20%) daripada amaun pengeluaran tersebut.</div><div><br></div><div>6. Saya memberi kebenaran kepada mana-mana pihak yang menyimpan maklumat saya untuk menzahirkan maklumat tersebut termasuklah data peribadi dan data peribadi sensitif saya kepada KWSP bagi tujuan permohonan ini dan apa-apa tujuan lain yang berkaitan.</div><div><br></div><div>7. Saya memberi kebenaran dan memberi kuasa kepada KWSP untuk memproses dan menzahirkan maklumat saya termasuklah tetapi tidak terhad kepada data peribadi dan data peribadi sensitif saya bagi tujuan permohonan ini dan apa-apa tujuan lain yang berkaitan berdasarkan peruntukan Akta Perlindungan Data Peribadi 2010 (APDP 2010) atau undang-undang lain yang terpakai berhubung perlindungan data peribadi.</div><div><br></div><div>8. Saya memahami bahawa kelulusan dan bayaran permohonan ini adalah tertakluk kepada terma dan syarat yang ditentukan oleh KWSP.</div><div><br></div><div>9. Saya memahami bahawa apa-apa pertikaian berhubung ketepatan amaun pengeluaran dan kesahihan pengeluaran hanya boleh dikemukakan kepada KWSP selaras dengan Seksyen 57A Akta KWSP 1991.</div><div><br></div><div>10. Pekerja dalam skim berpencen perkhidmatan awam:</div><div>Saya memahami dan menyedari bahawa bayaran pengeluaran ini berkemungkinan menggunakan amaun syer kerajaan yang perlu dikembalikan kepada kerajaan dan KWSP tidak akan bertanggungjawab ke atas amaun pengeluaran ini.</div>', 1, 0, 1, 1, '2022-04-01 04:00:00', '2022-04-01 04:00:00', 1, 1, NULL, NULL),
(2, 'Application', '<head>\n    <meta content=\"text/html; charset=utf-8\" http-equiv=\"Content-Type\" />\n    <title>Application Submitted</title>\n    <meta name=\"description\" content=\"Application\">\n    <style type=\"text/css\">\n        a:hover {text-decoration: underline !important;}\n    </style>\n</head>\n\n<body marginheight=\"0\" topmargin=\"0\" marginwidth=\"0\" style=\"margin: 0px; background-color: #f2f3f8;\" leftmargin=\"0\">\n    <!--100% body table-->\n    <table cellspacing=\"0\" border=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#f2f3f8\"\n        style=\"@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: \'Open Sans\', sans-serif;\">\n        <tr>\n            <td>\n                <table style=\"background-color: #f2f3f8; max-width:670px;  margin:0 auto;\" width=\"100%\" border=\"0\"\n                    align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n                    <tr>\n                        <td style=\"height:80px;\">&nbsp;</td>\n                    </tr>\n                    <tr>\n                        <td style=\"height:20px;\">&nbsp;</td>\n                    </tr>\n                    <tr>\n                        <td>\n                            <table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"\n                                style=\"max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);\">\n                                <tr>\n                                    <td style=\"height:40px;\">&nbsp;</td>\n                                </tr>\n                                <tr>\n                                    <td style=\"padding:0 35px;\">\n                                        <h1 style=\"color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:\'Rubik\',sans-serif;\">Thank you for your application</h1>\n                                        <span\n                                            style=\"display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;\"></span>                                     \n                                    </td>\n                                </tr>\n<tr>\n                                    <td style=\"padding:0 35px;\">\n                                        <h4 style=\"color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:\'Rubik\',sans-serif;\">Application No: %application_no%</h4> \n                                    </td>\n                                </tr>\n                                <tr>\n                                    <td style=\"height:40px;\">&nbsp;</td>\n                                </tr>\n                            </table>\n                        </td>\n                    <tr>\n                        <td style=\"height:20px;\">&nbsp;</td>\n                    </tr>\n                    <tr>\n                        <td style=\"text-align:center;\">\n                            <p style=\"font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;\">&copy; <strong>suria.canthinksolution.com/</strong></p>\n                        </td>\n                    </tr>\n                    <tr>\n                        <td style=\"height:80px;\">&nbsp;</td>\n                    </tr>\n                </table>\n            </td>\n        </tr>\n    </table>\n    <!--/100% body table-->\n</body>', 4, 1, 1, 1, '2022-04-03 17:31:07', '2022-04-03 17:31:07', 1, 1, NULL, NULL),
(3, 'Registration', '<div>Dear %user_salutation% %user_fullname%,</div>\r\n\r\n<br>\r\n\r\n<div>We would like to inform you that your application no <b>%application_no%</b> has been approved.</div>\r\n\r\n<div><br></div>\r\n\r\n<div>Kindly login to our system using this credentials:-</div>\r\n<div>Username : %user_email%</div>\r\n<div>Password : <i>(your NRIC number)</i> </div>\r\n\r\n<br>\r\n\r\n<div>Your invoice for registration fee (invoice no: %invoice_no%) can be found at&nbsp;<b><i>Billing &gt; (Choose Student Name) &gt; (Choose Current Year) </i></b>.</div><div> Please make payment within 30 days to proceed. </div>\r\n\r\n<br>\r\n\r\n<div>Thank you.</div>\r\n\r\n<br>\r\n\r\n<font color=\"#666666\" face=\"Open Sans, Helvetica Neue, Helvetica, Arial, sans-serif\"><span style=\"font-size: 12px; letter-spacing: normal;\">(This is an auto-generated email. Please do not reply this email as this is a computer-generated email which is not monitored)</span></font>\r\n\r\n<br>\r\n\r\n************************************************************************************************************************************************************************\r\n\r\n<br>\r\n\r\n<div> DISCLAIMER: </div>\r\n\r\n<br>\r\n\r\n<div> This message may contain confidential and privileged information for its intended recipient(s) only. If you are not an intended recipient, you are hereby notified that any review, dissemination, and distribution, printing or copying of this message or any part thereof is strictly prohibited. Please delete the entire message and inform the sender of the error. Any opinions, conclusions and other information in this message that are unrelated to official business of Tadika Suria Intelek are those of the individual sender and shall be understood as neither explicitly given nor endorsed by Tadika Suria. </div>', 5, 1, 1, 1, '2022-04-03 17:31:07', '2022-04-03 17:31:07', 1, 1, NULL, NULL),
(4, 'Enrollment', '<div>Dear %user_salutation% %user_fullname%,</div>\r\n\r\n<br>\r\n\r\n<div>\r\nWe would like to inform you that we have received your payment regarding application no <b>%application_no%</b>.\r\n</div>\r\n\r\n<br>\r\n\r\n<div> The student has successfully enrolled at our schools:- </div>\r\n\r\n<br>\r\n\r\n<div> Student Name: %stud_name% </div>\r\n<div> Matric No: %stud_matric_no% </div>\r\n<div> Academic: %academic_name% </div>\r\n<div> Level / Classroom : %level_name% / %class_name% </div>\r\n\r\n<br>\r\n\r\nThank you.<br>\r\n\r\n<font color=\"#666666\" face=\"Open Sans, Helvetica Neue, Helvetica, Arial, sans-serif\"><span style=\"font-size: 10px; letter-spacing: normal;\">(This is an auto-generated email. Please do not reply this email)</span></font>', 6, 1, 1, 1, '2022-04-03 17:31:07', '2022-04-03 17:31:07', 1, 1, NULL, NULL),
(5, 'Invoice Payment', '<div>Dear %user_salutation% %user_fullname%,</div>\r\n\r\n<br>\r\n\r\n<div>\r\nWe would like to inform you that your payment regarding application no <b>%application_no%</b> has been declined. <br><br> Please confirm your payment transaction details are correct. Any questions can contact our administrator.\r\n</div>\r\n\r\n<br>\r\n\r\nThank you.<br>\r\n\r\n<font color=\"#666666\" face=\"Open Sans, Helvetica Neue, Helvetica, Arial, sans-serif\"><span style=\"font-size: 10px; letter-spacing: normal;\">(This is an auto-generated email. Please do not reply this email)</span></font>', 8, 1, 1, 1, '2022-04-03 17:31:07', '2022-04-03 17:31:07', 1, 1, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
