<div class="row">
	<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
	<dov class="col-md-10 col-md-offset-1 col-xs-12">
		<div class="box box-primary">
<?php  
/**
 * Open Form
 *
 * @return string
 **/
echo form_open(site_url('mahasiswa/account/save_data'), array('class' => 'form-horizontal', 'id' => 'form-setting-login'));
?>
			<div class="box-header with-border">
				<div class="col-md-6 col-md-offset-1">
					<h3 class="box-title">Bagian 1</h3> <span><i class="fa fa-angle-double-right"></i> Identitas Diri Anda</span>
				</div>
			</div>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group">
					<label for="email" class="control-label col-md-3 col-xs-12">Nama Lengkap</label>
					<div class="col-md-8">
						<input type="email" name="email" class="form-control" value="<?php echo $get->name; ?>" disabled="">
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="control-label col-md-3">Jenis Kelamin : <strong class="text-red">*</strong></label>
					<div class="col-md-6">
				       	<div class="radio radio-inline radio-info">
				           <input name="gender" type="radio" required="" value="pria" <?php if($get->gender=='pria') echo 'checked';  ?>> <label for="gender"> Pria</label>
				       	</div>
				       	<div class="radio radio-inline radio-info">
				           <input name="gender" type="radio" required="" value="wanita" <?php if($get->gender=='wanita') echo 'checked';  ?>> <label for="gender"> Wanita</label>
				       	</div>
					</div>
				</div>
				<div class="form-group">
					<label for="place_of_birts" class="control-label col-md-3">Tempat, Tanggal Lahir : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
						<input type="text" name="place_of_birts" class="form-control" value="<?php echo $get->place_of_birts; ?>" required="">
					</div>
					<div class="col-md-3">
						<div class="hidden-lg hidden-md" style="margin-top: 10px;"></div>
					  	<div class="input-group">
					    	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					    	<input type="text" class="form-control" name="birts" id="datepicker" value="<?php echo $get->birts; ?>" required="" placeholder="Ex : 1996-03-31">
					  	</div>
					</div>
				</div>
				<div class="form-group">
					<label for="name" class="control-label col-md-3">Agama : <strong class="text-red">*</strong></label>
					<div class="col-md-3">
				       	<?php  
				       	/**
				       	 * Form Dropdown Agama
				       	 *
				       	 * @var string
				       	 **/
				       	echo form_dropdown('religion', 
				       		array(
				       			'' => "-- PILIH --",
				       			'islam' => "Islam",
				       			'kristen' => "Kristen",
				       			'hindu' => "Hindu",
				       			'buddha' => "Buddha",
				       			'konghucu' => "Konghucu"
				       		), 
				       		$get->religion,
				       		array('class' => 'form-control', 'required' => 'required')
				       	);
				       	?>
					</div>
				</div>
				<div class="form-group">
					<label for="jobs" class="control-label col-md-3">Pekerjaan : </label>
					<div class="col-md-6">
						<input type="text" name="jobs" class="form-control" value="<?php echo $get->jobs; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="address" class="control-label col-md-3">Alamat : </label>
					<div class="col-md-6">
						<textarea name="address" class="form-control" cols="30" rows="3"><?php echo $get->address; ?></textarea>
					</div>
				</div>
			</div>
			<div class="box-header with-border">
				<div class="col-md-6 col-md-offset-1">
					<h3 class="box-title">Bagian 2</h3> <span><i class="fa fa-angle-double-right"></i> Informasi Sekolah Asal</span>
				</div>
			</div>
			<div class="box-body">
				<div class="form-group">
					<label for="school_name" class="control-label col-md-3">Nama Sekolah : <strong class="text-red">*</strong></label>
					<div class="col-md-7">
						<input type="text" name="school_name" class="form-control" value="<?php echo $get->school_name; ?>" required="">
					</div>
				</div>
				<div class="form-group">
					<label for="school_study" class="control-label col-md-3">Jurusan <small>(yang ditempuh)</small> : </label>
					<div class="col-md-6">
						<input type="text_study" name="school_study" class="form-control" value="<?php echo $get->school_study; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="school_address" class="control-label col-md-3">Alamat Sekolah  : </label>
					<div class="col-md-6">
						<textarea name="school_address" class="form-control" cols="30" rows="3"><?php echo $get->school_address; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="graduation_year" class="control-label col-md-3">Tahun Lulus  : </label>
					<div class="col-md-2">
				       	<?php  
				       	/**
				       	 * Form Dropdown Tahun Lulus
				       	 *
				       	 * @var string
				       	 **/
				       	$tahun = date('Y') - 7;
				       	$option_year[] = "-- PILIH --";
				       	for($tahun; $tahun <= date('Y'); $tahun++)
				       		$option_year[$tahun] = $tahun;

				       	echo form_dropdown('graduation_year', 
				       		$option_year, 
				       		$get->graduation_year,
				       		array('class' => 'form-control')
				       	);
				       	?>
					</div>
				</div>
				<div class="form-group">
					<label for="grade_value" class="control-label col-md-3">Nilai Kelulusan  : </label>
					<div class="col-md-2">
						<input type="text" name="grade_value" class="form-control" value="<?php echo $get->grade_value; ?>">
					</div>
					<div class="col-md-7">
						<small><i>Nilai Ujian Akhir atau IPK jika dari Perguruan Tinggi.</i></small>
					</div>
				</div>
				<div class="form-group">
					<label for="certificate_number" class="control-label col-md-3">Nomor Ijazah : </label>
					<div class="col-md-7">
						<input type="text" name="certificate_number" class="form-control" value="<?php echo $get->certificate_number; ?>">
					</div>
				</div>
			</div>
			<div class="box-header with-border">
				<div class="col-md-6 col-md-offset-1">
					<h3 class="box-title">Bagian 3</h3> <span><i class="fa fa-angle-double-right"></i> Identitas Orang Tua</span>
				</div>
			</div>
			<div class="box-body">
				<div class="form-group">
					<label for="father_name" class="control-label col-md-3">Nama Ayah :</label>
					<div class="col-md-7">
						<input type="text" name="father_name" class="form-control" value="<?php echo $get->father_name; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="father_jobs" class="control-label col-md-3">Pekerjaan : </label>
					<div class="col-md-6">
						<input type="text" name="father_jobs" class="form-control" value="<?php echo $get->father_jobs; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="mother_name" class="control-label col-md-3">Nama Ibu : 	</label>
					<div class="col-md-7">
						<input type="text" name="mother_name" class="form-control" value="<?php echo $get->mother_name; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="mother_jobs" class="control-label col-md-3">Pekerjaan : </label>
					<div class="col-md-6">
						<input type="text" name="mother_jobs" class="form-control" value="<?php echo $get->mother_jobs; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="parent_address" class="control-label col-md-3">Alamat Orang Tua  : </label>
					<div class="col-md-6">
						<textarea name="parent_address" class="form-control" cols="30" rows="3"><?php echo $get->parent_address; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="phone_number" class="control-label col-md-3">Nomor Telepon Orang Tua : </label>
					<div class="col-md-6">
						<input type="text" name="phone_number" class="form-control" value="<?php echo $get->phone_number; ?>">
					</div>
				</div>
				<div class="form-group">
					<label for="phone_number" class="control-label col-md-3">Kisaran Pendapatan : </label>
					<div class="col-md-8">
				       	<div class="radio radio-info">
				           <input name="revenue" type="radio" <?php if($get->revenue=='Rp. 500,000,00 - 1,000,000,00') echo 'checked'; ?> value="Rp. 500,000,00 - 1,000,000,00"> <label for="revenue"> Rp. 500,000,00 - 1,000,000,00</label>
				       	</div>
				       	<div class="radio radio-info">
				           <input name="revenue" type="radio" <?php if($get->revenue=='Rp. 1,000,000,00 - 2,000,000,00') echo 'checked'; ?> value="Rp. 1,000,000,00 - 2,000,000,00"> <label for="revenue"> Rp. 1,000,000,00 - 2,000,000,00</label>
				       	</div>
				       	<div class="radio radio-info">
				           <input name="revenue" type="radio" <?php if($get->revenue=='Rp. 2,000,000,00 - 3,500,000,00') echo 'checked'; ?> value="Rp. 2,000,000,00 - 3,500,000,00"> <label for="revenue"> Rp. 2,000,000,00 - 3,500,000,00</label>
				       	</div>
				       	<div class="radio radio-info">
				           <input name="revenue" type="radio" <?php if($get->revenue=='Rp. 3,500,000,00') echo 'checked'; ?> value="Rp. 3,500,000,00"> <label for="revenue"> > Rp. 3,500,000,00</label>
				       	</div>
					</div>
				</div>
			</div>
			<div class="box-footer with-border">
				<div class="hidden-md hidden-lg"><hr></div>
				<div class="col-md-8 col-xs-12 col-md-offset-2">
					<a href="<?php echo site_url('mahasiswa/account') ?>" class="btn btn-app pull-left">
						<i class="fa fa-undo"></i>
						Kembali
					</a>
					<button type="submit" class="btn btn-app pull-right">
						<i class="fa fa-save"></i>
						Simpan
					</button>
				</div>
				<div class="col-md-12">
					<small><strong class="text-red">*</strong>	Field wajib diisi!</small> <br>
					<small><strong class="text-blue">*</strong>	Field Optional (Bila ingin mengganti password)</small>
				</div>
			</div>
<?php  
// End Form
echo form_close();
?>
		</div>
	</dov>
</div>