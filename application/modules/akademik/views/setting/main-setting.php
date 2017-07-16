<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<dov class="col-md-10 col-md-offset-1 col-xs-12">
		<div class="box box-primary">
<?php  
/**
 * Open Form
 *
 * @var string
 **/
echo form_open(site_url("akademik/setting/save_update"), array('class' => 'form-horizontal'));
?>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group">
					<label for="option[default_thn_ajaran]" class="control-label col-md-4 col-xs-12">Tahun Akademik (<small><i>Sekarang</i></small>) : <strong class="text-red">*</strong></label>
					<div class="col-md-3">
						<select name="option[default_thn_ajaran]" class="form-control">
							<option value="">-- PILIH --</option>
						<?php  
						/**
						 * Loop Tahun Ajaran
						 *
						 * @var Integer
						 **/
						$thn2 = 2011;
						for($thn1 = 2010; $thn1 <= (date('Y')); $thn1++) :
						?>
							<option value="<?php echo $thn1.'/'.$thn2; ?>" <?php if(($thn1.'/'.$thn2)==$this->option->get('default_thn_ajaran')) echo "selected"; ?>><?php echo $thn1.'/'.$thn2; ?></option>
						<?php  
						$thn2++;
						// End Loop thn Ajaran
						endfor;
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="option[default_semester]" class="control-label col-md-4 col-xs-12">Semester (<small><i>Sekarang</i></small>) : <strong class="text-red">*</strong></label>
					<div class="col-md-3">
						<select name="option[default_semester]" class="form-control">
							<option value="">-- PILIH --</option>
							<option value="ganjil" <?php echo ('ganjil' == $this->option->get('default_semester')) ? 'selected' : ''; ?>>Ganjil</option>
							<option value="genap" <?php echo ('genap' == $this->option->get('default_semester')) ? 'selected' : ''; ?>>Genap</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-4 col-xs-12">Fitur Penysunan KRS Online : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
						<select name="option[penyusunan_krs]" class="form-control">
							<option value="">-- PILIH --</option>
							<option value="yes" <?php echo ('yes' == $this->option->get('penyusunan_krs')) ? 'selected' : ''; ?>>Buka</option>
							<option value="no" <?php echo ('no' == $this->option->get('penyusunan_krs')) ? 'selected' : ''; ?>>Tutup</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-4 col-xs-12">Tanda Tangan (<small><i>pada KRS/KHS</i></small>) : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
					  	<input type="text" name="option[ttd_prodi]" class="form-control" value="<?php echo $this->option->get('ttd_prodi'); ?>" placeholder="Nama ketua Prodi">
					</div>
					<div class="col-md-3">
					  	<input type="text" name="option[ttd_prodi_nik]" class="form-control" value="<?php echo $this->option->get('ttd_prodi_nik'); ?>" placeholder="NIK ketua Prodi">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="control-label col-md-4 col-xs-12">Fitur Dosen Entry Nilai : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
						<select name="option[entry_nilai_dosen]" class="form-control">
							<option value="">-- PILIH --</option>
							<option value="yes" <?php echo ('yes' == $this->option->get('entry_nilai_dosen')) ? 'selected' : ''; ?>>Buka</option>
							<option value="no" <?php echo ('no' == $this->option->get('entry_nilai_dosen')) ? 'selected' : ''; ?>>Tutup</option>
						</select>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<small><strong class="text-red">*</strong>	Field wajib diisi!</small> <br>
					<small><strong class="text-blue">*</strong>	Field Optional</small>
				</div>
				<div class="col-md-6 col-xs-6">
					<button type="submit" class="btn btn-app pull-right">
						<i class="fa fa-save"></i> Simpan
					</button>
				</div>
			</div>
<?php  
// End Form
echo form_close();
?>
		</div>
	</dov>
</div>
<?php
/* End of file main-setting.php */
/* Location: ./application/modules/Akademik/views/setting/main-setting.php */
?>