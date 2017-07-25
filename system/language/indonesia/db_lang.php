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
 * @filesource db_lang.php
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['db_invalid_connection_str'] = 'Tidak dapat menentukan pengaturan database berdasarkan string koneksi yang Anda kirimkan.';
$lang['db_unable_to_connect'] = 'Tidak dapat terkoneksi dengan database dengan konfigurasi yang sudah ditentukan';
$lang['db_unable_to_select'] = 'Tidak dapat memilih database yang telah ditentukan: %s';
$lang['db_unable_to_create'] = 'Tidak dapat membuat database yang telah ditentukan: %s';
$lang['db_invalid_query'] = 'Query yang dikirimkan tidak valid.';
$lang['db_must_set_table'] = 'Anda harus mengatur tabel database yang akan digunakan dengan query Anda.';
$lang['db_must_use_set'] = 'Anda harus menggunakan metode "set" untuk memperbarui entri.';
$lang['db_must_use_index'] = 'Anda harus menentukan indeks untuk mencocokkan selama update batch.';
$lang['db_batch_missing_index'] = 'Satu baris atau lebih yang telah terkirim (submit) untuk mengupdate batch telah hilang dengan index tertentu.';
$lang['db_must_use_where'] = 'Update tidak diperbolehkan kecuali menggunakan klausa "where".';
$lang['db_del_must_use_where'] = 'Delete tidak diperbolehkan kecuali menggunakan klausa "where".';
$lang['db_field_param_missing'] = 'Untuk mengambil field, dibutuhkan nama tabel sebagai parameter.';
$lang['db_unsupported_function'] = 'Fitur ini tidak tersedia pada database yang anda gunakan.';
$lang['db_transaction_failure'] = 'Transaksi gagal: Pengembalian transaksi dilakukan.';
$lang['db_unable_to_drop'] = 'Tidak dapat menghapus database.';
$lang['db_unsupported_feature'] = 'Fitur tidak didukung terhadap database yang anda gunakan.';
$lang['db_unsupported_compression'] = 'Format kompresi file yang Anda pilih tidak didukung oleh server Anda.';
$lang['db_filepath_error'] = 'Tidak dapat menulis data ke path file yang telah Anda kirimkan.';
$lang['db_invalid_cache_path'] = 'Jalur Cache Anda diajukan tidak sah atau tidak dapat ditulis.';
$lang['db_table_name_required'] = 'Nama tabel diperlukan untuk melakukan operasi ini.';
$lang['db_column_name_required'] = 'Nama kolom diperlukan untuk melakukan operasi ini.';
$lang['db_column_definition_required'] = 'Definisi kolom diperlukan untuk melakukan operasi.';
$lang['db_unable_to_set_charset'] = 'Tidak dapat mengatur set karakter klien koneksi: %s';
$lang['db_error_heading'] = 'Terjadi kesalahan terhadap database';
