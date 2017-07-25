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
               <li class="dropdown user user-menu" data-toggle="tooltip" data-placement="bottom" title="Pengaturan Login">
                  <a href="<?php echo site_url('dosen/user/account'); ?>" style="font-size: 20px;">
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