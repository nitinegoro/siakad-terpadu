<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
   <aside class="main-sidebar">
      <section class="sidebar">
      <div class="user-panel">
         <div class="pull-left image">
            <img src="<?php echo base_url("assets/img/avatar.jpg"); ?>" class="img-circle" alt="User Image">
         </div>
         <div class="pull-left info">
            <p><?php echo $this->session->userdata('account')->name; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
         </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">MENU NAVIGASI</li>
        <li class="<?php echo active_link_controller('main'); ?>">
            <a href="<?php echo site_url('akademik/main') ?>">
               <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="<?php echo active_link_controller('verifikasi_krs'); ?>">
            <a href="<?php echo site_url('akademik/verifikasi_krs') ?>">
               <i class="fa fa-file-text-o"></i> <span>Verifikasi KRS </span> 
              <span class="pull-right-container">
          <?php  
          /**
           * Count Notiikasi Unread
           *
           * @return string
           **/
          if($this->krs_callback->getPlain('0')) :
          ?>
                <small class="label pull-right bg-red" data-toggle="tooltip" data-placement="top" title="Belum diverifikasi"><?php echo count($this->krs_callback->getPlain('0')); ?></small>
          <?php  
          // End Condition
          endif;
          ?>
              </span>
            </a>
        </li>
        <li class="treeview <?php echo active_link_multiple(array('entrypoint','transkrip')); ?>">
            <a href="#">
               <i class="fa fa-pencil"></i> <span>Master Nilai</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url('akademik/entrypoint') ?>" class="<?php echo active_link_method('index', 'entrypoint'); ?>"><i class="fa fa-minus"></i> Entry Nilai</a>
            </li>
            <li>
              <a href="<?php echo site_url("akademik/entrypoint/import") ?>" class="<?php echo active_link_method('import', 'entrypoint'); ?>"><i class="fa fa-minus"></i> Import Nilai</a>
            </li>
            <li>
              <a href="" class="<?php echo active_link_method('index', 'transkrip'); ?>" style="text-decoration: line-through;"><i class="fa fa-minus"></i> Data Nilai</a>
            </li>
            <li>
              <a href="" class="<?php echo active_link_method('index', 'transkrip'); ?>" style="text-decoration: line-through;"><i class="fa fa-minus"></i> Transkrip Nilai</a>
            </li>
          </ul>
        </li>
        <li class="treeview <?php echo active_link_multiple(array('course','lecturer')); ?>">
            <a href="#">
               <i class="fa fa-database"></i> <span>Master Data</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url("akademik/course") ?>" class="<?php echo active_link_controller('course'); ?>"><i class="fa fa-minus"></i> Mata Kuliah</a>
            </li>
            <li>
              <a href="<?php echo site_url("akademik/lecturer") ?>" class="<?php echo active_link_controller('lecturer'); ?>"><i class="fa fa-minus"></i> Dosen</a></li>
            <li>
              <a href="" class="" style="text-decoration: line-through;"><i class="fa fa-minus"></i> Ruang Kuliah</a></li>
          </ul>
        </li>
        <li class="treeview <?php echo active_link_multiple(array('schedule')); ?>">
            <a href="#">
               <i class="fa fa-calendar-o"></i> <span>Jadwal Kuliah</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url("akademik/schedule/create") ?>" class="<?php echo active_link_method('create','schedule'); ?>"><i class="fa fa-minus"></i> Buat Baru</a>
            </li>
            <li>
              <a href="<?php echo site_url("akademik/schedule") ?>" class="<?php echo active_link_method('index','schedule'); ?>"><i class="fa fa-minus"></i> Lihat Jadwal Kuliah</a>
            </li>
          </ul>
        </li>
        <li class="treeview <?php echo active_link_controller('student'); ?>">
            <a href="#">
               <i class="ion ion-ios-people"></i> <span>Mahasiswa</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url("akademik/student") ?>" class="<?php echo active_link_method('index', 'student'); ?>"><i class="fa fa-minus"></i> Data Mahasiswa</a>
            </li>
            <li>
              <a href="<?php echo site_url('akademik/student/add') ?>" class="<?php echo active_link_method('add', 'student'); ?>"><i class="fa fa-minus"></i> Tambah Baru</a>
            </li>
            <li>
              <a href="<?php echo site_url('akademik/student/add_pindahan') ?>" class="<?php echo active_link_method('add_pindahan', 'student'); ?>" style="text-decoration: line-through;"><i class="fa fa-minus"></i> Tambah Mahasiswa Pindahan</a>
            </li>
            <li>
              <a href="<?php echo site_url('akademik/student/import') ?>" class="<?php echo active_link_method('import', 'student'); ?>"><i class="fa fa-minus"></i> Import</a>
            </li>
          </ul>
        </li>
        <li class="treeview <?php echo active_link_multiple(array('user', 'setting')); ?>">
            <a href="#">
               <i class="fa fa-wrench"></i> <span>Pengaturan</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url("akademik/user") ?>" class="<?php echo active_link_controller('user') ?>"><i class="fa fa-minus"></i> Pengguna Sistem</a>
            </li>
            <li>
              <a href="" style="text-decoration: line-through;"><i class="fa fa-minus"></i> Hak Akses Pengguna</a>
            </li>
            <li>
              <a href="<?php echo site_url('akademik/setting') ?>" class="<?php echo active_link_controller('setting') ?>"><i class="fa fa-minus"></i> Fitur & Lain-lain</a>
            </li>
          </ul>
        </li>
      </ul>
      </section>
   </aside>
   <div class="content-wrapper">
      <section class="content-header">
        <?php 
        /**
         * Generated Page Title
         *
         * @return string
         **/
          echo $page_title;

        /**
         * Generate Breadcrumbs from library
         *
         * @var string
         **/
          echo $breadcrumb; 
        ?>
      </section>
      <section class="content">
<?php  
/* End of file left_sidebar.php */
/* Location: ./application/modules/Akademik/views/_template/left_sidebar.php */
?>