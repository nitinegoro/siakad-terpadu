<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="theme-color" content="#3C8DBC">
  <title><?php echo $title; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/bootstrap.min.css"); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/AdminLTE.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/skins/_all-skins.min.css"); ?>">
  <link rel="stylesheet" href="<?php echo base_url("assets/dist/animate.css"); ?>">
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url("assets/img/logo.png"); ?>"/>
  <style>
    .logo-head { margin-left: 20px; }
    .box-login { padding-bottom: 20px; }
    .login-mahasiswa > blockquote { margin-top: 20px; border-color: #F2C903; }
    .form-login-mahasiswa { padding: 5px;}
    input[type="text"] { font-size: 20px; border-radius: 5px; } input[type="password"] { font-size: 20px; border-radius: 5px; }
    input[name="captcha"] { font-size: 15px; border-radius: 5px; }
   .top { background: #3C8DBC url('<?php echo base_url('assets/img/head.jpg') ?>') center no-repeat; height:100px; font-size:20px;
   font-weight:bold; color:#fff; }
   .titletop {  text-transform:uppercase; font-weight:300; font-size:1.3em; line-height:0.9em; text-shadow:1px 1px 4px #6e8cb2;  margin-top:25px;  margin-left:10px; }
   .titletop span { font-size:0.7em; }
   .captcha > p { font-size:30px; font-family: 'Arial Narrow'; font-weight: bold; text-align: center; letter-spacing: 30px; color: #222A7B;  }
  </style>
</head>
<body class="hold-transition skin-blue-light layout-top-nav" oncopy="return false" oncut="return false" onpaste="return false">
  <div class="content-wrapper">
    <div class="container">
      <section class="content" style="margin-top: 15%;">
           <div class="text-center">
             <img src="<?php echo base_url("assets/img/logo_dosen.png"); ?>" class="img" alt="logo siakad">
           </div>
        <div class="col-md-4 col-md-offset-4 col-sm-5 col-xs-12 box-login animated <?php echo ($this->session->flashdata('alert')) ? 'shake' : 'fadeIn'; ?>" style="background: white; border-radius: 10px; border-top:3px solid #F39C12; margin-top: 30px;">
<!--            <div class="login-mahasiswa">
   <blockquote>
     <p>Login Mahasiswa</p>
     <small>Silahkan masukkan NPM dan password Anda untuk masuk ke dalam sistem.</small>
   </blockquote>
</div> -->
<?php  
echo form_open(current_url(). '?from_url='.$this->input->get('from_url'));
?>
           <div class="form-login-mahasiswa">
              <div class="form-group col-md-12">
                <?php echo $this->session->flashdata('alert'); ?>
              </div>
              <div class="form-group col-md-12">
                 <label for="username">Kode Dosen :</label>
                 <input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>">
                 <?php echo form_error('username', '<small class="text-red">', '</small>'); ?>
              </div>
              <div class="form-group col-md-12">
                 <label for="password">Password :</label>
                 <input type="password" id="login-password" name="password" class="form-control" value="<?php echo set_value('password'); ?>">
                 <?php echo form_error('password', '<small class="text-red">', '</small>'); ?>
              </div>
              <div class="form-group col-md-12">
                  <label>
                     <input type="checkbox" class="minimal" onclick="showpassword()" />
                     <small class="lbl"> Tampilkan Password</small>
                  </label>
              </div>
              <div class="form-group col-md-12">
                <label for="password">Captcha :</label>
                <div class="captcha">
                  <p style="white-space: 30px;" id="text-captcha"><?php echo $captcha['word']; ?></p>
                  <a href="#" id="reload-captcha"><small><i>Reload captcha ...</i></small></a>
                </div>
                <input type="text" name="captcha" class="form-control" value="" placeholder="Masukkan kode diatas">
                <?php echo form_error('captcha', '<small class="text-red">', '</small>'); ?>
              </div>
              <div class="form-group col-md-12">
                  <a href="<?php echo site_url('welcome') ?>" class="btn btn-warning"><i class="fa fa-undo"></i> Kembali</a>
                  <button type="submit" class="btn btn-warning pull-right">Masuk</button><!-- 
                  <strong><a href="#" class="pull-right" data-toggle="modal" data-target='#modal-id'>Lupa password?</a></strong> -->
              </div>
           </div>
<?php 
echo form_close();
?>

        </div>
        <div class="col-md-4 col-md-offset-4 col-sm-5 col-xs-12">
          <div class="lockscreen-footer text-center">
              <small>Copyright &copy; 2016 - <?php echo date('Y'); ?> <a href="">IT Division</a> STIE Pertiba Pangkalpinang. All rights reserved.</small>
          </div>
        </div>
      </section>
  </div>
</div>
<script src="<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/bootstrap/bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/dist/app.min.js"); ?>"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("a#reload-captcha").click(function() {
      $.get("<?php echo base_url("akademik/login/captcha_refresh"); ?>", function( data ) 
      {
        $('#text-captcha').html(data);
      });
    });
  });
   function showpassword() {

      var key_attr = $('#login-password').attr('type');
      if(key_attr != 'text') {
         $('.checkbox').addClass('show');
         $('#login-password').attr('type', 'text');
      } else {
         $('.checkbox').removeClass('show');
         $('#login-password').attr('type', 'password');
      }
   };
</script>
</body>
</html>
<?php 
/* End of file login-mahasiswa.php */
/* Location: ./application/modules/Mahasiswa/views/login-mahasiswa.php */
?>