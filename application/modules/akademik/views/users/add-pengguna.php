<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<dov class="col-md-8 col-md-offset-2 col-xs-12">
		<div class="box box-primary">
<?php  
/**
 * Open Form
 *
 * @var string
 **/
echo form_open(current_url(), array('class' => 'form-horizontal'));
?>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group">
					<label for="name" class="control-label col-md-3 col-xs-12">Nama Pengguna : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
						<p class="help-block"><?php echo form_error('name', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-3 col-xs-12">E-Mail : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>">
						<p class="help-block"><?php echo form_error('email', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="username" class="control-label col-md-3 col-xs-12">Username : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="username" class="form-control" value="<?php echo set_value('username'); ?>">
						<p class="help-block"><?php echo form_error('username', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="control-label col-md-3 col-xs-12">Password : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="password" name="password" class="form-control" value="<?php echo set_value('password'); ?>">
						<p class="help-block"><?php echo form_error('password', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="repeat_pass" class="control-label col-md-3 col-xs-12">Ulangi : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="password" name="repeat_pass" class="form-control" value="<?php echo set_value('repeat_pass'); ?>">
						<p class="help-block"><?php echo form_error('repeat_pass', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="control-label col-md-3 col-xs-12">Level Akses : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="role" class="form-control">
							<option value="">-- PILIH --</option>
			<?php  
			/**
			 * Start Loop roles
			 *
			 * @var string
			 **/
			foreach($roles as $row) :
			?>
							<option value="<?php echo $row->role_id; ?>"><?php echo $row->role_name; ?></option>
			<?php  
			// End Loop roles
			endforeach;
			?>
						</select>
						<p class="help-block"><?php echo form_error('role', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('akademik/user') ?>" class="btn btn-app pull-right">
						<i class="ion ion-reply"></i> Kembali
					</a>
				</div>
				<div class="col-md-6 col-xs-6">
					<button type="submit" class="btn btn-app pull-right">
						<i class="fa fa-save"></i> Simpan
					</button>
				</div>
			</div>
			<div class="box-footer with-border">
					<small><strong class="text-red">*</strong>	Field wajib diisi!</small> <br>
					<small><strong class="text-blue">*</strong>	Field Optional</small>
			</div>
<?php  
// End Form
echo form_close();
?>
		</div>
	</dov>
</div>