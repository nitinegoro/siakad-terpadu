<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
	echo form_hidden('users', $this->input->post('users'));
	echo form_hidden('set_update', TRUE);
	foreach ($users as $key => $value) :
?>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group">
					<label for="name" class="control-label col-md-3 col-xs-12">Nama Pengguna : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="name[<?php echo $key; ?>]" class="form-control" value="<?php echo $value->name; ?>">
						<p class="help-block"><?php echo form_error("name[{$key}]", '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-3 col-xs-12">E-Mail : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="email" name="email[<?php echo $key; ?>]" class="form-control" value="<?php echo $value->email; ?>">
						<p class="help-block"><?php echo form_error("email[{$key}]", '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="control-label col-md-3 col-xs-12">Level Akses : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="role[<?php echo $key; ?>]" class="form-control">
							<option value="">-- PILIH --</option>
			<?php  
			/**
			 * Start Loop roles
			 *
			 * @var string
			 **/
			foreach($roles as $row) :
			?>
							<option value="<?php echo $row->role_id; ?>" <?php echo ($row->role_id==$value->role_id) ? 'selected' : ''; ?>><?php echo $row->role_name; ?></option>
			<?php  
			// End Loop roles
			endforeach;
			?>
						</select>
						<p class="help-block"><?php echo form_error("role[{$key}]", '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="repeat_pass" class="control-label col-md-3 col-xs-12">Blokir Pengguna : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
	                    <div class="radio radio-inline radio-info">
	                        <input type="radio" name="active[<?php echo $key; ?>]" value="0" <?php echo ($value->active) ? '' : 'checked'; ?>> <label>Tidak</label>
	                    </div>
	                    <div class="radio radio-inline radio-info">
	                        <input type="radio" name="active[<?php echo $key; ?>]" value="1" <?php echo ($value->active) ? 'checked' : ''; ?>> <label>Iya</label>
	                    </div>
					</div>
				</div>
				<div class="form-group"><hr></div>
	<?php  
	endforeach;
	?>
			</div>
			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('akademik/user') ?>" class="btn btn-app pull-right">
						<i class="ion ion-reply"></i> Kembali
					</a>
				</div>
				<div class="col-md-6 col-xs-6">
					<button type="submit" name="action" value="update" class="btn btn-app pull-right">
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
<?php  
/* End of file multiple-edit-pengguna.php */
/* Location: ./application/modules/Akademik/views/users/multiple-edit-pengguna.php */
?>