<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$get = $this->account->getAll($this->session->userdata('account_id'));
?>
   <aside class="main-sidebar">
      <section class="sidebar">
      <div class="user-panel">
         <div class="pull-left image">
            <img src="<?php echo base_url("assets/img/avatar.jpg"); ?>" class="img-circle" alt="User Image">
         </div>
         <div class="pull-left info">
            <p><?php echo $get->name; ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
         </div>
      </div>
      <ul class="sidebar-menu">
        <li class="header">MENU NAVIGASI</li>
        <li class="<?php echo active_link_controller('main'); ?>">
            <a href="<?php echo site_url('mahasiswa/main') ?>">
               <i class="fa fa-home"></i> <span>Home</span>
            </a>
        </li>
        <li class="treeview <?php echo active_link_multiple(array('krs')); ?>">
            <a href="#">
               <i class="fa fa-pencil"></i> <span>Kartu Rencana Studi</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
          <ul class="treeview-menu">
            <li>
              <a href="<?php echo site_url("mahasiswa/krs") ?>" class="<?php echo active_link_method('index', 'krs'); ?>"><i class="fa fa-minus"></i> Penyusunan KRS</a>
            </li>
            <li>
              <a href="<?php echo site_url('mahasiswa/krs/view') ?>" class="<?php echo active_link_method('view', 'krs'); ?>"><i class="fa fa-minus"></i> Lihat KRS</a>
            </li>
          </ul>
        </li>
        <li class="<?php echo active_link_controller('jadwal'); ?>">
            <a href="<?php echo site_url('mahasiswa/jadwal/create') ?>">
               <i class="fa fa-calendar"></i> <span>Jadwal Kuliah</span>
            </a>
        </li>
        <li class="<?php echo active_link_controller('khs'); ?>">
            <a href="<?php echo site_url('mahasiswa/khs') ?>">
               <i class="fa fa-file-text-o"></i> <span>Kartu Hasil Studi</span>
            </a>
        </li>
        <li class="<?php echo active_link_controller('point'); ?>">
            <a href="<?php echo site_url('mahasiswa/point') ?>">
               <i class="fa fa-files-o"></i> <span>Transkrip Nilai</span>
            </a>
        </li>
        <li class="<?php echo active_link_controller('user_guide'); ?>">
            <a href="<?php echo site_url('mahasiswa/user_guide') ?>">
               <i class="fa fa-book"></i> <span>Panduan Sistem</span>
            </a>
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
/* Location: ./application/modules/Mahasiswa/views/_template/left_sidebar.php */
?>