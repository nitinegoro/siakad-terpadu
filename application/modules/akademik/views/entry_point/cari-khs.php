<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">

<?php  
// Open Form Search KRS
echo form_open(current_url(), array('method' => 'get'));
?>
	<div class="col-md-12">
		<div class="box pad box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cari KHS Mahasiswa</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                	<i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
			<div class="box-body with-border">
				<div class="col-md-3">
					<label for="npm">NPM :</label>
					<input type="text" name="npm" value="<?php echo set_value('npm'); ?>" class="form-control">
					<p class="help-block"><?php echo form_error('npm', '<small class="text-red">', '</small>'); ?></p>
				</div>
				<div class="col-md-3">
					<label for="thn_ajaran">Tahun Ajaran :</label>
					<select name="thn_ajaran" class="form-control">
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
						<option value="<?php echo $thn1.'/'.$thn2; ?>" <?php if(($thn1.'/'.$thn2)==$this->input->get('thn_ajaran')) echo "selected"; ?>><?php echo $thn1.'/'.$thn2; ?></option>
					<?php  
					$thn2++;
					// End Loop thn Ajaran
					endfor;
					?>
					</select>
					<p class="help-block"><?php echo form_error('thn_ajaran', '<small class="text-red">', '</small>'); ?></p>
				</div>
				<div class="col-md-3">
					<label for="semester">Semester:</label>
					<select name="semester" class="form-control">
						<option value="">-- PILIH --</option>
						<option value="ganjil" <?php echo ('ganjil' == set_value('semester')) ? 'selected' : ''; ?>>Ganjil</option>
						<option value="genap" <?php echo ('genap' == set_value('semester')) ? 'selected' : ''; ?>>Genap</option>
					</select>
					<p class="help-block"><?php echo form_error('semester', '<small class="text-red">', '</small>'); ?></p>
				</div>
				<div class="col-md-3">
					<button class="btn btn-app" type="submit" name="action" value="true">
						<i class="fa fa-search"></i> Cari
					</button>
					<a href="<?php echo site_url('akademik/entrypoint') ?>" class="btn btn-app">
						<i class="fa fa-times"></i> Reset
					</a>
				</div>
			</div>
		</div>		
	</div>
<?php 
// End Form KRS
echo form_close(); 

/**
 * If Condition Result Mahasiswa
 *
 * @var Result
 **/
if($get) :
	echo form_open(site_url("akademik/entrypoint/set/{$get->student_id}?{$this->input->server('QUERY_STRING')}"));
	echo form_hidden('semester', $this->input->get('semester'));
	echo form_hidden('years', $this->input->get('thn_ajaran'));
?>
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="box pad box-primary">
			<div class="box-body with-border">
				<div class="col-md-2">
					<img src="<?php echo ($get->photo != '') ? base_url("assets/img/account/{$get->photo}") : base_url("assets/img/avatar.jpg"); ?>" alt="">
				</div>
				<div class="col-md-4">
					<table>
						<tr>
							<th>NPM </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->npm; ?></td>
						</tr>
						<tr>
							<th>Nama Lengkap </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->name; ?></td>
						</tr>
						<tr>
							<th>Jurusan </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->study; ?></td>
						</tr>
						<tr>
							<th>Jenjang </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->ladder; ?></td>
						</tr>
						<tr>
							<th>Konsentrasi </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->concentration_name; ?></td>
						</tr>
						<tr>
							<th>Kelas </th><th width="30" class="text-center">:</th>
							<td><?php echo ucfirst($get->class) ?></td>
						</tr>
					</table>		
				</div>
				<div class="col-md-4">
					<table>
						<tr>
							<th>Tahun Ajaran </th><th width="30" class="text-center">:</th>
							<td><?php echo $this->input->get('thn_ajaran'); ?></td>
						</tr>
						<tr>
							<th>Semester </th><th width="30" class="text-center">:</th>
							<td><?php echo ucfirst($this->input->get('semester')); ?></td>
						</tr>
					</table>
				</div>
<?php 
	/**
	 * If Condition Result KRS
	 *
	 * @var string
	 **/
	if($daftar_nilai) :

?>
				<div class="col-md-2">
					<a href="<?php echo site_url("akademik/entrypoint/getprint/{$get->student_id}?{$this->input->server('QUERY_STRING')}"); ?>" class="btn btn-app btn-print"><i class="fa fa-print"></i> Cetak</a>
					<button type="submit" class="btn btn-app"><i class="fa fa-save"></i> Simpan</button>
				</div>
				<div class="col-md-12">
					<hr>
					<table class="table table-bordered table-responsive table-nilai-input">
						<thead class="bg-silver">
							<tr>
								<th rowspan="2" width="30" class="text-center">No.</th>
								<th rowspan="2" width="100" class="text-center">Kode MK</th>
								<th rowspan="2" class="text-center">Mata Kuliah</th>
								<th rowspan="2" width="65" class="text-center">SKS</th>
								<th colspan="4" class="text-center">Nilai</th>
								<th rowspan="2" width="65" class="text-center">Nilai Akhir</th>
								<th rowspan="2" width="65" class="text-center">Grade</th>
								<th rowspan="2" width="65" class="text-center">Bobot</th>
							</tr>
							<tr>
								<th width="80" class="text-center">Kehadiran</th>
								<th width="65" class="text-center">Tugas</th>
								<th width="65" class="text-center">UTS</th>
								<th width="65" class="text-center">UAS</th>
							</tr>
						</thead>
						<tbody>
					<?php  
					/**
					 * Start Loop Daftar Nilai
					 *
					 * @var string
					 **/
					$sks = 0;
					$bobot = 0;
					foreach($daftar_nilai as $key => $value) :
					?>
							<tr>
								<td class="text-center"><?php echo ++$key; ?>.</td>
								<td class="text-center"><?php echo $value->course_code; ?></td>
								<td><?php echo $value->course_name; ?>	</td>
								<td class="text-center"><?php echo $value->sks; ?></td>
								<td class="td-nilai">
									<input type="text" value="<?php echo $value->absent; ?>" name="point[<?php echo $value->course_id ?>][absent]" class="input-nilai">
								</td>
								<td class="td-nilai">
									
									<input type="text" value="<?php echo $value->task; ?>" name="point[<?php echo $value->course_id ?>][task]" class="input-nilai">
								</td>
								<td class="td-nilai">
									
								<input type="text" value="<?php echo $value->midterms; ?>" name="point[<?php echo $value->course_id ?>][midterms]" class="input-nilai">
								</td>
								<td class="td-nilai">
										
									<input type="text" value="<?php echo $value->final; ?>" name="point[<?php echo $value->course_id ?>][final]" class="input-nilai">
								</td>
								<td class="text-center"><?php echo $value->point; ?></td>
								<td class="text-center"><?php echo $value->grade; ?></td>
								<td class="text-center"><?php echo $value->quality; ?></td>
							</tr>
					<?php  
					$sks += $value->sks;
					$bobot += $value->quality;
					// End Loop daftar Nilai
					endforeach;
					?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3"><span class="pull-right">Jumlah SKS :</span></th>
								<th class="text-center"><?php echo $sks; ?></th>
								<th colspan="6"><span class="pull-right">Jumlah Bobot :</span></th>
								<th colspan="2" class="text-center"><?php echo $bobot; ?></th>
							</tr>
							<tr>
								<th colspan="10"><span class="pull-right">Index Prestasi (IP) :</span></th>
								<th colspan="2" class="text-center"><span style="font-size: 15px;"><?php echo str_replace('.', ',', $this->nilai->getIp()); ?></span></th>
							</tr>
							<tr>
									
							</tr>
						</tfoot>
					</table>
				</div>
<?php  
	// End Form Entry Nilai
	echo form_close();
	// End Daftar Nilai
	else :
?>			
				<div class="col-md-12"><hr>
					<div class="col-md-8 col-md-offset-2 col-xs-12">
						<div class="alert alert-warning animated bounce">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong><i class="fa fa-warning"></i> Maaf!</strong> <p>Data daftar nilai tidak tersedia, atau belum dibuat	.</p>
						</div>
					</div>
				</div>
	<?php
	endif;
	?>
			</div>
		</div>
	</div>
<?php  
// TRUE end
else :
	if($this->input->get('action')) :
?>
	<div class="col-md-8 col-md-offset-2 col-xs-12">
		<div class="alert alert-warning animated bounce">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong><i class="fa fa-warning"></i> Maaf!</strong> <p>Mahasiswa dengan NPM <strong><?php echo $this->input->get('npm'); ?></strong> tidak tersedia.</p>
		</div>
	</div>
<?php
	endif;
// Ends Condition
endif;
?>
</div>
<?php  
/* End of file cari-krs.php */
/* Location: ./application/modules/Akademik/views/entry_point/cari-krs.php */
?>