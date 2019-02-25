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
              <h3 class="box-title">Cari KRS Mahasiswa</h3>
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
	echo form_open(site_url("dosen/pembimbing/setkrs/{$get->student_id}?{$this->input->server('QUERY_STRING')}"));
	echo form_hidden('npm', $this->input->get('npm'));
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
							<th>Tahun Masuk </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->register_year ?></td>
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
						<tr>
							<th>IPS Semester Lalu </th><th width="30" class="text-center">:</th>
							<td><?php echo ($daftar_krs) ? str_replace('.', ',', $this->nilai->getIp()) : ''; ?></td>
						</tr>
						<tr>
							<th>Maksimum kredit SKS </th><th width="30" class="text-center">:</th>
							<td><?php echo ($daftar_krs) ? $this->nilai->credit_sks() . ' SKS': ''; ?></td>
						</tr>
					</table>
				</div>
<?php 
	/**
	 * If Condition Result KRS
	 *
	 * @var string
	 **/
	if($daftar_krs) :

?>
				<div class="col-md-2">
					<button type="submit" name="action" value="simpan" class="btn btn-app"><i class="fa fa-save"></i> Simpan KRS</button>
				</div>
				<div class="col-md-12"><hr>
					<table class="table table-hover table-bordered table-responsive table-black table-bordered-black">
						<thead class="bg-silver">
							<tr>
								<th width="40">
				                    <div class="checkbox checkbox-inline">
				                        <input id="checkbox1" type="checkbox"> <label for="checkbox1"></label>
				                    </div>
								</th>
								<th width="30">No.</th>
								<th width="100">Kode MK</th>
								<th class="text-center">Mata Kuliah</th>
								<th width="50">SKS</th>
								<th width="150" class="text-center">Status</th>
							</tr>
						</thead>
						<tbody>
				<?php  
				/**
				 * Loop Data KRS
				 *
				 * @return string
				 **/
				$total_sks = 0;
				foreach($daftar_krs as $key => $value) :
				?>
							<tr>
								<td>
				                    <div class="checkbox checkbox-inline">
				                        <input id="checkbox1" type="checkbox" name="plain[]" value="<?php echo $value->plain_id; ?>"> <label for="checkbox1"></label>
				                    </div>
								</td>
								<td><?php echo ++$key; ?>.</td>
								<td><?php echo $value->course_code; ?></td>
								<td><?php echo $value->course_name; ?></td>
								<td><?php echo $value->sks; ?></td>
								<td class="text-center">
									<small class="<?php echo ($value->verification) ? '' : 'text-line'; ?>">Terverifikasi</small> / 
									<small class="<?php echo ($value->verification) ? 'text-line' : ''; ?>">Belum</small>
								</td>
							</tr>
				<?php 
					$total_sks += $value->sks; 
				// End Loop 
				endforeach;
				?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="4">
									<span class="pull-right">Jumlah SKS  :</span>
								</th>
								<th colspan="2"><?php echo $total_sks; ?></th>
							</tr>
							<tr>
								<th colspan="6">
									<label style="font-size: 11px; margin-right: 10px;">Yang terpilih :</label>
									<button type="submit" name="action" value="approve" class="btn btn-xs btn-round btn-primary"><i class="fa fa-check"></i> Setujui</button>
									<button type="submit" name="action" value="unapprove" class="btn btn-xs btn-round btn-warning"><i class="fa fa-times"></i> Tolak</button>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="modal animated fadeIn" id="jadikan-khs" tabindex="-1" data-backdrop="static" data-keyboard="false">
		          	<div class="modal-dialog modal-sm">
		            	<div class="modal-content">
		              		<div class="modal-header">
		                		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                		<h4 class="modal-title"><i class="fa fa-question-circle"></i> Question!</h4>
		                		<span id="message-krs"></span>
		              		</div>
		              		<div class="modal-footer">
		                		<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
		                		<span id="btn-set-khs"></span>
		              		</div>
		            	</div>
		          	</div>
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