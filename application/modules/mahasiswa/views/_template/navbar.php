<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 

$get = $this->account->getAll($this->session->userdata('account_id'));
?>
<body class="hold-transition skin-pertiba sidebar-mini fixed">
   <div class="wrapper">
      <header class="main-header">
         <a href="<?php echo site_url('akademik/main') ?>" class="logo" style="border-bottom: 0.5px solid white;">
            <img src="<?php echo base_url("assets/img/brand.png"); ?>" align="center" alt="Logo STIE Pertiba">
         </a>
         <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle hidden-md hidden-lg" data-toggle="offcanvas" role="button">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </a>
         <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               <li class="dropdown messages-menu">
      <?php  
      /**
       * Data Natifikasi
       *
       * @var string
       **/
      $this->load->model('moption');
      if( $this->moption->notifikasi() ) :
      ?>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-globe" style="font-size: 18px;"></i>
                     <span class="label label-danger"><?php echo count($this->moption->notifikasi()); ?></span>
                  </a>
                  <ul class="dropdown-menu" style="width: 300px;">
                     <li class="header">KRS Belum diverifikasi</li>
                     <li>
                        <ul class="menu">
            <?php  
            /**
             * Loop Notifikasi KRS
             *
             * @return Reseult
             **/
            foreach($this->moption->notifikasi() as $row) :
               $query = http_build_query( array('thn_ajaran' => $row->years, 'semester' => $row->semester, 'read' => 1 ) );
            ?>
                           <li>
                              <a href="<?php echo site_url("mahasiswa/krs/view?{$query}"); ?>" class="get-update-notifikasi">
                                 <div class="pull-left">
                                    <img src="<?php echo (!$get->photo) ? base_url("assets/img/avatar.jpg") : base_url("assets/img/account/{$row->photo}"); ?>" class="img-circle" alt="User Image">
                                 </div>
                                 <h4>  
                                    <?php echo $row->name; ?>  <small><i class="fa fa-clock-o"></i> 
                                    <time class="timeago" datetime="<?php echo $row->datetime; ?>"><?php echo $row->datetime; ?></time></small>
                                 </h4> 
                                 <p>Telah memverifikasi KRS anda, <br>untuk Semester <?php echo ucfirst($row->semester). '&nbsp;'.$row->years; ?>. </p>
                              </a>
                           </li>
            <?php 
            // End Loop
            endforeach;
            ?>
                        </ul>
                     </li>
                  </ul>
      <?php  
      //  End Condition
      endif;
      ?>
               </li>
               <li class="dropdown user user-menu" data-toggle="tooltip" data-placement="bottom" title="Akun">
                  <a href="<?php echo site_url('mahasiswa/account'); ?>" style="font-size: 20px;">
                     <i class="fa fa-user"></i>
                  </a>
               </li>
               <li class="dropdown user user-menu" data-toggle="tooltip" data-placement="bottom" title="Pengaturan Login">
                  <a href="<?php echo site_url('mahasiswa/account/setting'); ?>" style="font-size: 20px;">
                     <i class="fa fa-key"></i>
                  </a>
               </li>
               <li>
                  <a href="#" style="font-size: 20px;" data-toggle="modal" data-target="#logout" data-placement="bottom" title="Keluar dari Sistem">
                     <i class="fa fa-power-off"></i>
                  </a>
               </li>
            </ul>
         </div>
       </nav>
      </header>
<?php  
/* End of file navbar.php */
/* Location: ./application/modules/Akademik/views/_template/navbar.php */
?>