<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * @package	CodeIgniter-Indonesia
 * @author	CodeIgniter Indonesia Team
 * @copyright	Copyright (c) 2014 - 2015, Codeigniter Indonesia (http://codeigniterindonesia.org/)
 * @since	Version 1.0.0
 * @filesource  email_lang.php
 */

defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = 'Metode validasi email harus melewati sebuah array.';
$lang['email_invalid_address'] = 'Alamat Email tidak valid: %s';
$lang['email_attachment_missing'] = 'Tidak dapat menemukan lampiran email berikut: %s';
$lang['email_attachment_unreadable'] = 'Tidak dapat membuka lampiran berikut: %s';
$lang['email_no_from'] = 'Tidak bisa mengirim email tanpa header "From".';
$lang['email_no_recipients'] = 'Anda harus menyertakan penerima: To, Cc, or Bcc';
$lang['email_send_failure_phpmail'] = 'Tidak dapat mengirim email menggunakan PHP email(). Server Anda mungkin tidak dikonfigurasi untuk mengirim email menggunakan metode ini.';
$lang['email_send_failure_sendmail'] = 'Tidak dapat mengirim email menggunakan PHP Sendmail. Server Anda mungkin tidak dikonfigurasi untuk mengirim email menggunakan metode ini.';
$lang['email_send_failure_smtp'] = 'Tidak dapat mengirim email menggunakan PHP SMTP. Server Anda mungkin tidak dikonfigurasi untuk mengirim email menggunakan metode ini.';
$lang['email_sent'] = 'Pesan Anda telah berhasil dikirim menggunakan protokol berikut: %s';
$lang['email_no_socket'] = 'Tidak dapat membuka soket ke Sendmail. Silakan periksa pengaturan.';
$lang['email_no_hostname'] = 'Anda tidak menentukan nama host SMTP.';
$lang['email_smtp_error'] = 'Berikut kesalahan SMTP yang ditemui: %s';
$lang['email_no_smtp_unpw'] = 'Error: Anda harus menetapkan nama pengguna dan password SMTP.';
$lang['email_failed_smtp_login'] = 'Gagal mengirim perintah AUTH LOGIN. Error: %s';
$lang['email_smtp_auth_un'] = 'Gagal untuk mengotentikasi nama pengguna (username). Error: %s';
$lang['email_smtp_auth_pw'] = 'Gagal mengotentikasi kata sandi (password). Error: %s';
$lang['email_smtp_data_failure'] = 'Tidak dapat mengirim data: %s';
$lang['email_exit_status'] = 'Kode status keluar: %s';
