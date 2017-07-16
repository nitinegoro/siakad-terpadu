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
              <h3 class="box-title">Ganti Password atau lupa Password</h3>
            </div>
            <div class="box-body" style="font-size: 16px;">
  				    <p>1. Pilih Menu <i>Pengaturan Login (Ikon Kunci)</i> pada pojok kanan atas. (<small><i>lihat gambar dibawah</i></small>)</p>
              <p><img src="<?php echo base_url("assets/img/guide/change_password.png"); ?>" alt="" class="img-responsive"></p>
              <p>2. Silahkan masukkan <i>Password Baru</i> bila ingin mengganti password. kemudian masukkan password lama anda untuk keamanan.</p>
              <p>3. Alamat E-Mail sangat diperlukan untuk memverifikasi jika anda lupa pada password anda fitur ini tidak akan berguna bila mana anda tidak memberikan alamat E-Mail anda kepada kami, berikut langkah-langkah <i>Lupa Password</i> :</p>
              <p>4. Klik link "<i><small>Lupa Password</small></i>" pada halaman login. (<small><i>lihat gambar dibawah</i></small>) </p>
              <p><img src="<?php echo base_url("assets/img/guide/dialog_pass.png"); ?>" alt="" class="img-responsive"></p>
              <p>5. Masukkan NPM dan alamat E-Mail anda kemudian klik tombol <i>Kirim Permintaan</i>, Tunggu beberapa saat anda akan mendapatkan "<i>Kiriman pesan yang berisi link untuk mengganti password baru anda</i>".</p>
              <p>6. Link tersebut akan kadaluarsa setelah satu jam dari anda mengirimkan permintaan.</p>
            </div>
            <div class="box-footer">

            </div>
          </div>
        </div>
</div>
<?php
/* End of file change-password.php */
/* Location: ./application/modules/Mahasiswa/views/userguide/change-password.php */
?>