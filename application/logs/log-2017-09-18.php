<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-09-18 04:10:54 --> Query error: Table 'i5.student' doesn't exist - Invalid query: SELECT *
FROM `student`
WHERE `student_id` = '2'
ERROR - 2017-09-18 04:10:55 --> Query error: Unknown column 'student_id' in 'where clause' - Invalid query: UPDATE `ci_sessions` SET `timestamp` = 1505700655
WHERE `student_id` = '2'
AND `id` = '224a00443a350e91eee41b3f363541ff5c1cd4cb'
ERROR - 2017-09-18 04:39:49 --> Query error: Unknown column 'is_visible' in 'field list' - Invalid query: UPDATE `email_template` SET `email_type` = 'reference_receive', `email_title` = '1', `email_subject` = '1', `email_body_text` = '1', `email_body_html` = '1', `is_visible` = '0'
WHERE `email_template_id` = '2'
ERROR - 2017-09-18 04:40:43 --> Query error: Unknown column 'is_visible' in 'field list' - Invalid query: UPDATE `email_template` SET `email_type` = 'reference_receive', `email_title` = '1', `email_subject` = '1', `email_body_text` = '1', `email_body_html` = '1', `is_visible` = NULL
WHERE `email_template_id` = '2'
ERROR - 2017-09-18 04:47:43 --> 404 Page Not Found: Admin/pages
ERROR - 2017-09-18 04:47:49 --> 404 Page Not Found: Admin/seo
ERROR - 2017-09-18 06:12:12 --> 404 Page Not Found: Admin/invoice
ERROR - 2017-09-18 06:12:24 --> 404 Page Not Found: Admin/voucher
ERROR - 2017-09-18 06:19:20 --> 404 Page Not Found: Admin/invoice
ERROR - 2017-09-18 06:20:47 --> Query error: Table 'i5.student' doesn't exist - Invalid query: SELECT COUNT(*) AS `numrows` FROM `student`
ERROR - 2017-09-18 06:20:53 --> Severity: error --> Exception: syntax error, unexpected '?>' D:\XAMPP\htdocs\i5\application\views\backend\admin\dashboard.php 31
ERROR - 2017-09-18 06:25:54 --> 404 Page Not Found: Admin/voucher