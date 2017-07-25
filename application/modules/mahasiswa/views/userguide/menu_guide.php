<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <div class="col-md-3">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Daftar Panduan</h3>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li class="<?php echo active_link_method('index', 'user_guide'); ?>">
                    <a href="<?php echo site_url('mahasiswa/user_guide') ?>"> Pengantar</a>
                </li>
                <li class="<?php if($this->uri->segment(4)=='penyusunan-krs') echo 'active'; ?>">
                    <a href="<?php echo site_url('mahasiswa/user_guide/read/penyusunan-krs') ?>"> Penyusunan KRS</a>
                </li>
                <li class="<?php if($this->uri->segment(4)=='penyusunan-jadwal') echo 'active'; ?>">
                    <a href="<?php echo site_url('mahasiswa/user_guide/read/penyusunan-jadwal') ?>"> Jadwal Kuliah</a>
                </li>
                <li class="<?php if($this->uri->segment(4)=='hasil-studi') echo 'active'; ?>">
                    <a href="<?php echo site_url('mahasiswa/user_guide/read/hasil-studi') ?>"> Melihat Hasil Studi</a>
                </li>
                <li class="<?php if($this->uri->segment(4)=='change-password') echo 'active'; ?>">
                    <a href="<?php echo site_url('mahasiswa/user_guide/read/change-password') ?>"> Ganti Password / Lupa Password  </a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
<?php
/* End of file menu_guide.php */
/* Location: ./application/modules/Mahasiswa/views/userguide/menu_guide.php */
?>