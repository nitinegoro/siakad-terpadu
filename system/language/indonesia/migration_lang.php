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
 * @filesource  migration_lang.php
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['migration_none_found'] = 'Tidak ada migrasi yang ditemukan.';
$lang['migration_not_found'] = 'Tidak ada migrasi dapat ditemukan dengan nomor versi: %s.';
$lang['migration_sequence_gap'] = 'Ada kesenjangan dalam urutan migrasi dekat nomor versi: %s.';
$lang['migration_multiple_version'] = 'Ada beberapa migrasi dengan nomor versi yang sama: %s.';
$lang['migration_class_doesnt_exist'] = 'Kelas migrasi "%s" tidak dapat ditemukan.';
$lang['migration_missing_up_method'] = 'Kelas migrasi "%s" kehilangan metode "up".';
$lang['migration_missing_down_method'] = 'Kelas migrasi "%s" kehilangan metode "down".';
$lang['migration_invalid_filename'] = 'Migrasi "%s" memiliki nama file yang tidak valid.';
