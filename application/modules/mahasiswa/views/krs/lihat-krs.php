<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">

<?php  
echo form_open(current_url(), array('id' => 'form-lihat-khs', 'method' => 'get'));
?>
	<div class="col-md-12">
		<div class="box pad box-primary">
			<div class="box-header">
				<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
			</div>
			<div class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-md-2 col-sm-3">Tahun Akademik :</label>
					<div class="col-md-2 col-sm-7">
						<select name="thn_ajaran" class="form-control" required="required">
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
						<div class="hidden-md hidden-lg hidden-xs" style="margin-bottom: 10px;"></div>
					</div>
					<div class="hidden-md hidden-lg hidden-sm" style="margin-bottom: 10px;"></div>
					<label class="control-label col-md-2 col-sm-3">Semester :</label>
					<div class="col-md-2 col-sm-7">
						<select name="semester" class="form-control" required="required">
							<option value="">-- PILIH --</option>
							<option value="ganjil" <?php echo ($this->input->get('semester') == 'ganjil') ? 'selected' : ''; ?>>Ganjil</option>
							<option value="genap" <?php echo ($this->input->get('semester') == 'genap') ? 'selected' : ''; ?>>Genap</option>
						</select>
						<div class="hidden-md hidden-lg hidden-xs" style="margin-bottom: 10px;"></div>
					</div>
					<div class="hidden-md hidden-lg" style="margin-bottom: 10px;"></div>
					<div class="col-md-2 col-sm-9 col-xs-12">
		              	<button class="btn btn-primary btn-flat bg-blue pull-right" id="btn-krs"><i class="fa fa-search"></i> Lihat KRS </button>
					</div>
				</div>
			</div>
<?php 
echo form_close(); 

/**
 * Checking KHS data
 *
 **/
if($daftar_krs) : 

	/**
	 * Update Notifikasi
	 **/
	if($this->input->get('read'))
		$this->moption->update_notifikasi();
?>
			<div class="form-horizontal">
				<div class="form-group">
					<hr>
			        <div class="col-xs-12 col-md-3 col-md-offset-1">
					<table>
						<tr>
							<th>Tahun Akademik </th><th width="30" class="text-center">:</th>
							<td><?php echo (!$this->input->get('thn_ajaran')) ? $this->option->get('default_thn_ajaran') : $this->input->get('thn_ajaran'); ?></td>
						</tr>
						<tr>
							<th>Semester </th><th width="30" class="text-center">:</th>
							<td><?php echo (!$this->input->get('semester')) ? ucfirst($this->option->get('default_semester')) : ucfirst($this->input->get('semester')); ?></td>
						</tr>
					</table>
			        </div>
			        <div class="col-xs-12 col-md-7" style="margin-bottom: 10px;">
						<a href="<?php echo site_url("mahasiswa/krs/get_print?{$this->input->server('QUERY_STRING')}") ?>" target="_blank" class="btn btn-default btn-flat pull-right btn-print"><i class="fa fa-print"></i> Cetak</a>
			        </div>
					<div class="col-xs-12 col-md-10 col-md-offset-1">
						<table class="table table-hover table-bordered table-responsive col-xs-12 mini-font table-black table-bordered-black">
							<thead class="bg-silver">
								<tr>
									<th width="30">No. </th>
									<th width="100" class="text-center">Kode MK</th>
									<th class="text-center">Mata Kuliah</th>
									<th class="text-center">SKS</th>
									<th class="text-center">Status</th>
								</tr>
							</thead>
							<tbody>
						<?php  
						/**
						 * undocumented class variable
						 *
						 * @var string
						 **/
						$total_sks = 0;
						 foreach($daftar_krs as $key => $value) :
						?>
								<tr>
									<td><?php echo ++$key; ?>.</td>
									<td><?php echo $value->course_code; ?></td>
									<td><?php echo $value->course_name; ?></td>
									<td class="text-center"><?php echo $value->sks; ?></td>
									<td class="text-center">
										<small class="<?php echo ($value->verification) ? '' : 'text-line'; ?>">Terverifikasi</small> / 
										<small class="<?php echo ($value->verification) ? 'text-line' : ''; ?>">Belum</small>
									</td>
								</tr>
						<?php  
						$total_sks += $value->sks;
						// End loop KRS
						endforeach;
						?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="3"><span class="pull-right">Jumlah SKS :</span></th>
									<th colspan="2" class="text-left"><?php echo $total_sks; ?></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
<?php  
else :

		if($this->input->get('semester') != '' && $this->input->get('thn_ajaran') != '') :
	?>
			<div class="box-body">
				<hr>
				<div class="col-md-6 col-md-offset-3">
					<div class="callout callout-warning alert-warning animated shake">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Maaf!</strong> <p>Data tidak tersedia pada database kami.</p>
					</div>
				</div>
			</div>
	<?php
		endif;
 
// End daftar KRS
endif;
?>
		</div>
	</div>


</div>