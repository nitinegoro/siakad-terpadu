<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * halaman Penyusunan KRS User Guide Mahasiswa
 *
 * @var string
 **/
?>
<div class="row">
	<?php  
	/**
	 * get Menu Tab Userguide
	 *
	 * @var string
	 **/
	$this->load->view('menu_guide');
	?>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Penyusunan KRS</h3>
            </div>
            <div class="box-body" style="font-size: 16px;">
  				    <p>1. Pastikan anda berada pada waktu penyusunan KRS yang telah ditentukan oleh bagian Akademik. Kemudian pilih Menu <i>Kartu Rencana Studi >> Penyusunan KRS</i> yang terdapat pada sebalah kiri. (<small><i>lihat gambar dibawah</i></small>)</p>
              <p><img src="<?php echo base_url("assets/img/guide/menu_krs.png"); ?>" alt="" class="img-responsive"></p>
              <p>2. Klik Menu tersebut, kemudian jika anda berada pada waktu penyusunan KRS akan terdapat Form untuk pengisian KRS jika tidak akan muncul pemberitahuan untuk tidak menyusun KRS.</p>
              <p><img src="<?php echo base_url("assets/img/guide/laman_krs.png"); ?>" alt="" class="img-responsive"></p>
              <p>3. Pilih Tahun Akademik dan Semester kemudian pilih Mata Kuliah yang akan diambil. maksimal SKS ditentukan Bag. Akademik berdasarkan IPK semester sebelumnya. Apabila mata kuliah yang diambil melebihi SKS yang telah ditentukan maka sistem akan mengabaikan Mata Kuliah yang dipilih. (<small><i>lihat gambar dibawah</i></small>)</p>
              <p><img src="<?php echo base_url("assets/img/guide/pilih_mk.png"); ?>" alt="" class="img-responsive"></p>
              <p>4. Pastikan Mata Kuliah yang anda inginkan sudah terpilih, kemudian Klik Tombol Simpan. Anda akan mendapatkan pemberitahuan berkala dari Bag. Akademik.</p>
            </div>
            <div class="box-footer">

            </div>
          </div>
        </div>
</div>
<?php
/* End of file susun-krs.php */
/* Location: ./application/modules/Mahasiswa/views/userguide/susun-krs.php */
?>