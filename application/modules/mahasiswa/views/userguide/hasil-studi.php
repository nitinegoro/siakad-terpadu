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
              <h3 class="box-title">Melihat Hasil Studi</h3>
            </div>
            <div class="box-body" style="font-size: 16px;">
              <p class="text-center">Dalam menu <i>Kartu Hasil Studi ini</i> anda dapat melihat Mata Kuliah yang anda tempuh beserta nilai yang anda peroleh.</p>
  				    <p>1. Pilih Menu <i>Kartu Hasil Studi</i> yang terdapat pada sebalah kiri. (<small><i>lihat gambar dibawah</i></small>)</p>
              <p><img src="<?php echo base_url("assets/img/guide/lihat_khs.png"); ?>" alt="" class="img-responsive"></p>
              <p>2. Anda dapat mencetak Kartu Hasil Studi tersebut dan menyerahkan kepada Dosen Pembimbing Akademik, anda juga dapat mencetak Kartu Ujian dan menyerahkannya kepada Ketua Program Studi untuk ditanda tangani dan distempel.</p>
            </div>
            <div class="box-footer">

            </div>
          </div>
        </div>
</div>
<?php
/* End of file hasil-studi.php */
/* Location: ./application/modules/Mahasiswa/views/userguide/hasil-studi.php */
?>