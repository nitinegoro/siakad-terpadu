<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
?>
<body class="hold-transition skin-pertiba sidebar-mini fixed">
   <div class="wrapper">
      <header class="main-header">
         <a href="<?php echo site_url('akademik/main') ?>" class="logo">
            <img src="<?php echo base_url("assets/img/brand.png"); ?>" class="logo-head logo-lg" alt="Logo STIE Pertiba">
            <img src="<?php echo base_url("assets/img/logo-xs.png"); ?>" class="logo-mini" alt="Logo STIE Pertiba">
         </a>
         <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
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
       * undocumented class variable
       *
       * @var string
       **/
      if($this->krs_callback->getPlain()) :
      ?>
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-file-text-o"></i>
                     <span class="label label-danger"><?php echo count($this->krs_callback->getPlain()); ?></span>
                  </a>
                  <ul class="dropdown-menu" style="width: 320px;">
                     <li class="header">KRS Belum diverifikasi</li>
                     <li>
                        <ul class="menu">
            <?php  
            /**
             * Loop Notifikasi KRS
             *
             * @return Reseult
             **/
            foreach($this->krs_callback->getPlain() as $row) :
               $query = http_build_query( array('npm' => $row->npm, 'thn_ajaran' => $row->years, 'semester' => $row->semester ) );
            ?>
                           <li>
                              <a href="<?php echo site_url("akademik/verifikasi_krs?{$query}"); ?>">
                                 <div class="pull-left">
                                    <img src="<?php echo (!$row->photo) ? base_url("assets/dist/img/user2-160x160.jpg") : base_url("assets/img/account/{$row->photo}"); ?>" class="img-circle" alt="User Image">
                                 </div>
                                 <h4>  
                                    <?php echo $row->name; ?>  <small><i class="fa fa-clock-o"></i> 
                                    <time class="timeago" datetime="<?php echo $row->datetime; ?>"><?php echo $row->datetime; ?></time></small>
                                 </h4> 
                                 <p>Menyusun KRS untuk semester <?php echo ucfirst($row->semester) . " " . $row->years; ?></p>
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
               <li class="dropdown user user-menu" data-toggle="tooltip" data-placement="bottom" title="Pengaturan Login">
                  <a href="<?php echo site_url('akademik/user/account'); ?>" style="font-size: 20px;">
                     <i class="fa fa-user"></i>
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