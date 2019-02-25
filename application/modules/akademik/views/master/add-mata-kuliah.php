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
					<label for="course_code" class="control-label col-md-3 col-xs-12">Kode MK : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="course_code" class="form-control" value="<?php echo set_value('course_code'); ?>">
						<p class="help-block"><?php echo form_error('course_code', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="course_name" class="control-label col-md-3 col-xs-12">Mata Kuliah : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="course_name" class="form-control" value="<?php echo set_value('course_name'); ?>">
						<p class="help-block"><?php echo form_error('course_name', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="course_name_english" class="control-label col-md-3 col-xs-12">Mata Kuliah <small><i>(Asing)</i></small> : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="course_name_english" class="form-control" value="<?php echo set_value('course_name_english'); ?>">
						<p class="help-block"><?php echo form_error('course_name_english', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="sks" class="control-label col-md-3 col-xs-12">Jumlah SKS : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="text" name="sks" class="form-control" value="<?php echo set_value('sks'); ?>">
						<p class="help-block"><?php echo form_error('sks', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="control-label col-md-3 col-xs-12">Semester : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
				       	<?php  
				       	/**
				       	 * Form Dropdown Tahun Lulus
				       	 *
				       	 * @var string
				       	 **/
				       	echo form_dropdown('semester', 
				       		array(
				       			'' => "-- PILIH --",
				       			'ganjil' => "Ganjil",
				       			'genap' => "Genap"
				       		), 
				       		set_value('semester'),
				       		array('class' => 'form-control')
				       	);
				       	?>
						<p class="help-block"><?php echo form_error('semester', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="control-label col-md-3 col-xs-12">Konsentrasi : <strong class="text-blue">*</strong></label>
					<div class="col-md-8">
				       	<?php  
				       	/**
				       	 * Form Dropdown Tahun Lulus
				       	 *
				       	 * @var string
				       	 **/
				       	echo form_dropdown('concentration', 
				       		array(
				       			'' => "-- PILIH --",
				       			1 => "Manajemen Pemasaran",
				       			2 => "Manajemen Keuangan"
				       		), 
				       		set_value('concentration'),
				       		array('class' => 'form-control')
				       	);
				       	?>
						<p class="help-block"><?php echo form_error('concentration', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url('akademik/course') ?>" class="btn btn-app pull-right">
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