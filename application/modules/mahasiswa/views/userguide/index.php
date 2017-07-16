<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<?php  
	/**
	 * halaman Pengantar User Guide Mahasiswa
	 *
	 * @var string
	 **/
	$this->load->view('menu_guide');
	?>
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pengantar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p>SIAKAD (Sistem Informasi Akademik) merupakan Program Aplikasi berbasis Web yang dikembangkan oleh IT Divisi STIE Pertiba guna memberikan pelayanan kepada Mahasiswa, Dosen dan Staf administrasi dan menjamin kelancaran dalam proses akademik.</p><hr>
              <h4>Fitur Akses :</h4>
                <ul>
                  <li>Biodata (Data Pribadi, Data Asal Sekolah, Data Orang Tua / Wali)</li>
                  <li>Kalender Akademik, Pemberitahuan terkait Akdemik</li>
                  <li>Data Akdemik (Lihat KHS, Cetak KHS, Cetak Kartu Ujian Rekapitulasi Nilai)</li>
                  <li>Penyusunan KRS (Kartu Rencana Studi) Online</li>
                  <li>Pemilihan Dosen dan Kelas perkuliahan </li>
                  <li>Cetak Jadwal Kuliah </li>
                  <li>Riwayat Pembayaran (<span class="text-yellow">Proses Pengembangan</span>)</li>
                </ul><hr>
              <h4>Versi : <small>(Sekarang <?php echo MODULE_MAHASISWA; ?>)</small></h4> 
                <ul>
                  <li><strong>1.0.1 <small>(Pre Release)</small> </strong> [Februari - Maret 2017]<br>
                  </li>
                  <li><strong>1.0.2 <small>(Pre Release)</small></strong>  [Maret 2017]<br>
                    <ul>
                      <li><small>Perubahan Warna Header atas.</small></li>
                      <li><small>Penambahan fitur Jadwal Kuliah.</small></li>
                      <li><small>Update fitur penyusunan KRS Online (pada mahasiswa semester awal).</small></li>
                    </ul>
                  </li>
                </ul><hr>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">

            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
</div>
<?php
/* End of file index.php */
/* Location: ./application/modules/Mahasiswa/views/userguide/index.php */
?>