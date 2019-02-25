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
 * @filesource  form_validation_lang.php
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['form_validation_required']		= '{field} ini diperlukan.';
$lang['form_validation_isset']			= '{field} harus mempunyai nilai.';
$lang['form_validation_valid_email']		= '{field} harus berisi alamat email yang valid.';
$lang['form_validation_valid_emails']		= '{field} harus berisi semua alamat email yang valid.';
$lang['form_validation_valid_url']		= '{field} harus berisi URL yang valid.';
$lang['form_validation_valid_ip']		= '{field} harus berisi IP yang valid.';
$lang['form_validation_min_length']		= '{field} harus minimal {param} karakter.';
$lang['form_validation_max_length']		= '{field} tidak dapat melebihi {param} karakter.';
$lang['form_validation_exact_length']		= '{field} harus berisi {param} karakter.';
$lang['form_validation_alpha']			= '{field} hanya berisi karakter abjad.';
$lang['form_validation_alpha_numeric']		= '{field} hanya berisi karakter alpha-numerik.';
$lang['form_validation_alpha_numeric_spaces']	= '{field} hanya berisi karakter alpha-numerik dan spasi.';
$lang['form_validation_alpha_dash']		= '{field} hanya mengandung alpha-numerik karakter, garis bawah, dan tanda hubung.';
$lang['form_validation_numeric']		= '{field} harus berisi angka.';
$lang['form_validation_is_numeric']		= '{field} harus berisi karakter numerik.';
$lang['form_validation_integer']		= '{field} harus berisi integer(angka).';
$lang['form_validation_regex_match']		= '{field} tidak dalam format yang benar.';
$lang['form_validation_matches']		= '{field} tidak cocok dengan {param}.';
$lang['form_validation_differs']		= '{field} harus berbeda dari {param}.';
$lang['form_validation_is_unique'] 		= '{field} harus berisi nilai yang unik.';
$lang['form_validation_is_natural']		= '{field} hanya mengandung angka.';
$lang['form_validation_is_natural_no_zero']	= '{field} hanya mengandung angka dan harus lebih besar dari nol.';
$lang['form_validation_decimal']		= '{field} harus berisi angka desimal.';
$lang['form_validation_less_than']		= '{field} harus berisi angka kurang dari {param}.';
$lang['form_validation_less_than_equal_to']	= '{field} harus berisi angka kurang dari atau sama dengan {param}.';
$lang['form_validation_greater_than']		= '{field} harus berisi angka lebih besar dari {param}.';
$lang['form_validation_greater_than_equal_to']	= '{field} harus berisi angka yang lebih besar dari atau sama dengan {param}.';
$lang['form_validation_error_message_not_set']	= 'Tidak dapat mengakses pesan kesalahan sesuai dengan nama Anda {field}.';
$lang['form_validation_in_list']		= '{field} harus menjadi salah satu: {param}.';


/* Custom */
$lang['form_validation_valid_date'] = 'Format {field} tidak valid.';