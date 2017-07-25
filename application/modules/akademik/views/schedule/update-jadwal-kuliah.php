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
					<label for="semester" class="control-label col-md-3 col-xs-12">Semester : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
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
				       		$get->semester,
				       		array('class' => 'form-control')
				       	);
				       	?>
						<p class="help-block"><?php echo form_error('semester', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="thn_akademik" class="control-label col-md-3 col-xs-12">Tahun Akademik : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
						<select name="thn_akademik" class="form-control">
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
							<option value="<?php echo $thn1.'/'.$thn2; ?>" <?php if(($thn1.'/'.$thn2)==$get->years) echo "selected"; ?>><?php echo $thn1.'/'.$thn2; ?></option>
						<?php  
						$thn2++;
						// End Loop thn Ajaran
						endfor;
						?>
						</select>
						<p class="help-block"><?php echo form_error('thn_akademik', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="mk" class="control-label col-md-3 col-xs-12">Mata Kuliah : <strong class="text-red">*</strong></label>
					<div class="col-md-9">
						<select name="mk" id="inputMk" class="select2" style="padding: 20px;">
							<option value="">-- PILIH --</option>
						<?php  
						/**
						 * Data From course
						 *
						 **/
						foreach($this->db->get('course')->result() as $row) :
						?>
							<option value="<?php echo $row->course_id; ?>" <?php if($get->course_id==$row->course_id) echo "selected"; ?>><?php echo $row->course_code." - ".$row->course_name; ?></option>
						<?php  
						endforeach;
						?>
						</select>
						<p class="help-block"><?php echo form_error('mk', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="lecturer" class="control-label col-md-3 col-xs-12">Dosen : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="lecturer" id="inputlecturer" class="select2-copy" style="padding: 20px;">
							<option value="">-- PILIH --</option>
						<?php  
						/**
						 * Data From lecturer
						 *
						 **/
						foreach($this->db->get('lecturer')->result() as $row) :
						?>
							<option value="<?php echo $row->lecturer_id; ?>" <?php if($get->lecturer_id==$row->lecturer_id) echo "selected"; ?>><?php echo $row->lecturer_code." - ".$row->name; ?></option>
						<?php  
						endforeach;
						?>
						</select>
						<p class="help-block"><?php echo form_error('lecturer', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="control-label col-md-3 col-xs-12">Hari : <strong class="text-red">*</strong></label>
					<div class="col-md-4">
				       	<?php  
				       	/**
				       	 * Form Dropdown Tahun Lulus
				       	 *
				       	 * @var string
				       	 **/
				       	echo form_dropdown('day', 
				       		array(
				       			'' => "-- PILIH --",
				       			'senin' => "Senin",
				       			'selasa' => "Selasa",
				       			'rabu' => "Rabu",
				       			'kamis' => "Kamis",
				       			'jumat' => "Jumat",
				       			'sabtu' => "Sabtu",
				       			'minggu' => "Minggu"
				       		), 
				       		$get->day,
				       		array('class' => 'form-control')
				       	);
				       	?>
						<p class="help-block"><?php echo form_error('day', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
				<div class="form-group">
					<label for="sks" class="control-label col-md-3 col-xs-12">Sesi Mulai : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
	                  	<div style="width: 70px; display: inline-block;">
	                    	<select name="session_start[]" id="input" class="form-control">
	                    		<option value="08" <?php if(substr($get->session_start, 0, 2)=="08") echo "selected"; ?>>08</option>
	                    		<option value="09" <?php if(substr($get->session_start, 0, 2)=="09") echo "selected"; ?>>09</option>
	                    		<option value="10" <?php if(substr($get->session_start, 0, 2)=="10") echo "selected"; ?>>10</option>
	                    		<option value="11" <?php if(substr($get->session_start, 0, 2)=="11") echo "selected"; ?>>11</option>
	                    		<option value="12" <?php if(substr($get->session_start, 0, 2)=="12") echo "selected"; ?>>12</option>
	                    		<option value="13" <?php if(substr($get->session_start, 0, 2)=="13") echo "selected"; ?>>13</option>
	                    		<option value="14" <?php if(substr($get->session_start, 0, 2)=="14") echo "selected"; ?>>14</option>
	                    		<option value="15" <?php if(substr($get->session_start, 0, 2)=="15") echo "selected"; ?>>15</option>
	                    		<option value="16" <?php if(substr($get->session_start, 0, 2)=="16") echo "selected"; ?>>16</option>
	                    		<option value="17" <?php if(substr($get->session_start, 0, 2)=="17") echo "selected"; ?>>17</option>
	                    		<option value="18" <?php if(substr($get->session_start, 0, 2)=="18") echo "selected"; ?>>18</option>
	                    		<option value="19" <?php if(substr($get->session_start, 0, 2)=="19") echo "selected"; ?>>19</option>
	                    		<option value="20" <?php if(substr($get->session_start, 0, 2)=="20") echo "selected"; ?>>20</option>
	                    		<option value="21" <?php if(substr($get->session_start, 0, 2)=="21") echo "selected"; ?>>21</option>
	                    		<option value="22" <?php if(substr($get->session_start, 0, 2)=="22") echo "selected"; ?>>22</option>
	                    	</select>
	                  	</div> <strong>:</strong>
	                  	<div style="width: 70px; display: inline-block;">
	                    	<select name="session_start[]" id="input" class="form-control">
	                    		<option value="00">00</option>
	                    	<?php 
	                    		for($detik = 1; $detik <= 60; $detik++) : 
	                    		$detik_nol = ($detik < 10) ? '0'.$detik : $detik;
	                    	?>
	                    		<option value="<?php echo $detik_nol ?>" <?php if(substr($get->session_start, 3, 2)==$detik_nol) echo "selected"; ?>><?php echo $detik_nol; ?></option>
	                    	<?php endfor; ?>
	                    	</select>
	                  	</div>
	                  	<div style="width: 70px; display: inline-block;">
	                    	<select name="session_start[]" id="input" class="form-control">
	                    		<option value="AM" <?php if(substr($get->session_start, 6, 2)=='AM') echo "selected"; ?>>AM</option>
	                    		<option value="PM" <?php if(substr($get->session_start, 6, 2)=='PM') echo "selected"; ?>>PM</option>
	                    	</select>
	                  	</div>
					</div>
				</div>
				<div class="form-group">
					<label for="role" class="control-label col-md-3 col-xs-12">Sesi Selesai : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
	                  	<div style="width: 70px; display: inline-block;">
	                    	<select name="session_end[]" id="input" class="form-control">
	                    		<option value="08" <?php if(substr($get->session_end, 0, 2)=="08") echo "selected"; ?>>08</option>
	                    		<option value="09" <?php if(substr($get->session_end, 0, 2)=="09") echo "selected"; ?>>09</option>
	                    		<option value="10" <?php if(substr($get->session_end, 0, 2)=="10") echo "selected"; ?>>10</option>
	                    		<option value="11" <?php if(substr($get->session_end, 0, 2)=="11") echo "selected"; ?>>11</option>
	                    		<option value="12" <?php if(substr($get->session_end, 0, 2)=="12") echo "selected"; ?>>12</option>
	                    		<option value="13" <?php if(substr($get->session_end, 0, 2)=="13") echo "selected"; ?>>13</option>
	                    		<option value="14" <?php if(substr($get->session_end, 0, 2)=="14") echo "selected"; ?>>14</option>
	                    		<option value="15" <?php if(substr($get->session_end, 0, 2)=="15") echo "selected"; ?>>15</option>
	                    		<option value="16" <?php if(substr($get->session_end, 0, 2)=="16") echo "selected"; ?>>16</option>
	                    		<option value="17" <?php if(substr($get->session_end, 0, 2)=="17") echo "selected"; ?>>17</option>
	                    		<option value="18" <?php if(substr($get->session_end, 0, 2)=="18") echo "selected"; ?>>18</option>
	                    		<option value="19" <?php if(substr($get->session_end, 0, 2)=="19") echo "selected"; ?>>19</option>
	                    		<option value="20" <?php if(substr($get->session_end, 0, 2)=="20") echo "selected"; ?>>20</option>
	                    		<option value="21" <?php if(substr($get->session_end, 0, 2)=="21") echo "selected"; ?>>21</option>
	                    		<option value="22" <?php if(substr($get->session_end, 0, 2)=="22") echo "selected"; ?>>22</option>
	                    	</select>
	                  	</div> <strong>:</strong>
	                  	<div style="width: 70px; display: inline-block;">
	                    	<select name="session_end[]" id="input" class="form-control">
	                    		<option value="00">00</option>
	                    	<?php 
	                    		for($detik = 1; $detik <= 60; $detik++) : 
	                    		$detik_nol = ($detik < 10) ? '0'.$detik : $detik;
	                    	?>
	                    		<option value="<?php echo $detik_nol ?>" <?php if(substr($get->session_start, 3, 2)==$detik_nol) echo "selected"; ?>><?php echo $detik_nol; ?></option>
	                    	<?php endfor; ?>
	                    	</select>
	                  	</div>
	                  	<div style="width: 70px; display: inline-block;">
	                    	<select name="session_end[]" id="input" class="form-control">
	                    		<option value="AM" <?php if(substr($get->session_end, 6, 2)=='AM') echo "selected"; ?>>AM</option>
	                    		<option value="PM" <?php if(substr($get->session_end, 6, 2)=='PM') echo "selected"; ?>>PM</option>
	                    	</select>
	                  	</div>
					</div>
				</div>
				<div class="form-group">
					<label for="classroom" class="control-label col-md-3 col-xs-12">Ruangan : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<select name="classroom" id="inputclassroom" class="select2-copy" style="padding: 20px;">
							<option value="">-- PILIH --</option>
						<?php  
						/**
						 * Data From classroom
						 *
						 **/
						foreach($this->db->get('classroom')->result() as $row) :
						?>
							<option value="<?php echo $row->classroom_id; ?>" <?php if($get->classroom_id==$row->classroom_id) echo "selected"; ?>><?php echo $row->class_name; ?></option>
						<?php  
						endforeach;
						?>
						</select>
						<p class="help-block"><?php echo form_error('classroom', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="<?php echo site_url("akademik/schedule?thn_akademik={$get->years}&semester={$get->semester}&action=true") ?>" class="btn btn-app pull-right">
						<i class="fa fa-undo"></i> Kembali
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