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
					<label for="lecturer_code" class="control-label col-md-3 col-xs-12">Kode Dosen : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="lecturer_code" class="form-control" value="<?php echo set_value('lecturer_code'); ?>">
						<p class="help-block"><?php echo form_error('lecturer_code', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="nidn" class="control-label col-md-3 col-xs-12">NIDN : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="nidn" class="form-control" value="<?php echo set_value('nidn'); ?>">
						<p class="help-block"><?php echo form_error('nidn', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="control-label col-md-3 col-xs-12">Nama Lengkap : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>">
						<p class="help-block"><?php echo form_error('name', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="address" class="control-label col-md-3 col-xs-12">Alamat  : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<textarea name="address" class="form-control" rows="3"><?php echo set_value('address'); ?></textarea>
						<p class="help-block"><?php echo form_error('address', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="control-label col-md-3 col-xs-12">Nomor Telepon : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="phone" class="form-control" value="<?php echo set_value('phone'); ?>">
						<p class="help-block"><?php echo form_error('phone', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="status" class="control-label col-md-3 col-xs-12">Status Dosen : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
				       	<div class="radio radio-inline radio-info">
				           <input name="status" type="radio" value="ds_tetap" <?php if(set_value('status')=='ds_tetap') echo "checked"; ?>> <label for="status"> Dosen Tetap</label>
				       	</div>
				       	<div class="radio radio-inline radio-info">
				           <input name="status" type="radio" value="ds_luar_biasa" <?php if(set_value('status')=='ds_luar_biasa') echo "checked"; ?>> <label for="status"> Dosen Luar Biasa</label>
				       	</div>
						<p class="help-block"><?php echo form_error('status', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('akademik/lecturer') ?>" class="btn btn-app pull-right">
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