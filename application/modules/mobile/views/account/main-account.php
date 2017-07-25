<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('header', $this->data);

$account = $this->account->get();
?>
    <header class="navbar-fixed">
        <div class="indigo darken-3">
            <nav>
                <div class="nav-wrapper indigo darken-4" style="margin-bottom: 0px;">
                    <a href="#" onclick="return history.back()"><i class="fa fa-angle-double-left"></i></a>
                    <a href="#" class="heading-text"><?php echo $title; ?></a>
                    <a href="#logoff" class="right"><i class="fa fa-sign-out"></i></a>
                </div>
            </nav>
        </div>
    </header>
    <section>
        <div class="white top-fixed" style="padding-bottom: 1px;">
            <div class="container" style="padding-top: 20px;">
				<form name="account" action="<?php echo current_url() ?>" method="post">
      			<div class="row">
        			<div class="input-field col s12">
          				<input type="email" class="validate" name="email" value="<?php echo $account->email; ?>">
          				<label class="black-text">Email</label>
        			</div>
                    <?php echo form_error('email', '<div class="col s12 red-text">', '</div>'); ?>
      			</div>
      			<div class="row">
        			<div class="input-field col s12">
          				<input id="pbaru" type="password" name="pbaru" class="validate" value="<?php echo set_value('pbaru'); ?>">
          				<label class="black-text" for="pbaru">Password Baru</label>
        			</div>
                    <?php echo form_error('pbaru', '<div class="col s12 red-text">', '</div>'); ?>
      			</div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="repeat" type="password" name="repeat" class="validate" value="<?php echo set_value('repeat'); ?>">
                        <label class="black-text" for="repeat">Ulangi Password Baru</label>
                    </div>
                    <?php echo form_error('repeat', '<div class="col s12 red-text">', '</div>'); ?>
                </div>
      			<div class="row">
        			<div class="input-field col s12">
          				<input id="plama" type="password" class="validate" name="plama" value="<?php echo set_value('plama'); ?>">
          				<label class="black-text" for="plama">Password Lama</label>
        			</div>
                    <?php echo form_error('plama', '<div class="col s12 red-text">', '</div>'); ?>
      			</div>
      			<div class="row">
                    <div class="input-field col s12 center">
                        <button type="submit" class="waves-effect btn indigo darken-2 white-text">Simpan Perubahan</button>
                    </div>
                </div>
				</form>
            </div>
        </div>
    </section>

<?php  

$this->load->view('footer', $this->data);

/* End of file main-account.php */
/* Location: ./application/modules/mobile/views/account/main-account.php */