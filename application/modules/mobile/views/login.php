<!DOCTYPE html>
<html lang="id_ID">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="theme-color" content="#1A237E">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo base_url("assets/mobile/css/login-mobile.css") ?>">
	<link rel="stylesheet" href="<?php echo base_url("assets/mobile/materialize/css/materialize.min.css"); ?>">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 	<link rel="stylesheet" href="<?php echo base_url("assets/font-awesome/css/font-awesome.min.css"); ?>">
 	<link rel="stylesheet" href="<?php echo base_url("assets/ionicons/css/ionicons.min.css"); ?>">
 	<link rel="stylesheet" href="<?php echo base_url("assets/dist/animate.min.css"); ?>">
 	<link rel="stylesheet" href="<?php echo base_url("assets/mobile/css/normalize.css") ?>">
</head>
<body ng-app="app">
    <section class="content">
 	<div class="row">
    <form class="col s12" action="<?php echo current_url() ?>" style="margin-top: 15%;" method="post">
    	<div class="row center-align">
			 <img src="<?php echo base_url("assets/img/logo_apps.png"); ?>" alt="logo siakad">
    	</div>
        <?php if($this->session->flashdata('callback')) : 
            $callback = $this->session->flashdata('callback');
        ?>
        <div class="row">
            <div class="col s12">
                <div class="card-panel <?php echo $callback['color'] ?>">
                    <span class="white-text">
                        <i class="fa fa-<?php echo $callback['icon'] ?> "></i> <?php echo $callback['message'] ?>
                    </span>
                </div>
            </div>
        </div>
        <?php endif; ?>
      	<div class="row">
        	<div class="input-field col s12">
          		<i class="material-icons prefix grey-text text-lighten-5">account_circle</i>
          		<input name="usernpm" id="icon_prefix" type="text" class="grey-text text-lighten-5">
                <label for="icon_prefix">NPM</label>
        	</div>
            <div class="col s12"><?php echo form_error('usernpm', '<small class="white-text">', '</small>'); ?></div>
        	<div class="input-field col s12">
          		<i class="material-icons prefix grey-text text-lighten-5">vpn_key</i>
          		<input name="pass" id="icon_telephone" type="password" class="grey-text text-lighten-5">
          		<label for="icon_telephone">Password</label>
        	</div>
            <div class="col s12"><?php echo form_error('pass', '<small class="white-text">', '</small>'); ?></div>
        	<div class="input-field col s12">
		  		<button id="cek-login" class="btn waves-effect btn-large blue waves-light" type="submit">
		  			MASUK
		  		</button>
        	</div>
      	</div>
    	</form>
    	<div class="col s12 box-footer">
    		<p>&copy; 2016 STIE Pertiba Pangkalpinang</p>
    		<p>Versi 1.0 Beta</p>
    	</div>
  	</div>
    </section>
	<script src="<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script>
	<script src="<?php echo base_url("assets/mobile/materialize/js/materialize.min.js"); ?>"></script>
</body>
</html>