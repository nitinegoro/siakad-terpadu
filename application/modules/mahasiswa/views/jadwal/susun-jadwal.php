<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
<?php  
echo form_open(current_url(), array('id' => 'form-susun-jadwal', 'method' => 'get'));
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
								<option value="<?php echo $thn1.'/'.$thn2; ?>" <?php if(($thn1.'/'.$thn2)==set_value('thn_akademik')) echo "selected"; ?>><?php echo $thn1.'/'.$thn2; ?></option>
							<?php  
							$thn2++;
							// End Loop thn Ajaran
							endfor;
							?>
						</select>
						<p class="help-block"><?php echo form_error('thn_akademik', '<small class="text-red">', '</small>'); ?></p>
						<div class="hidden-md hidden-lg hidden-xs" style="margin-bottom: 10px;"></div>
					</div>
					<div class="hidden-md hidden-lg hidden-sm" style="margin-bottom: 10px;"></div>
					<label class="control-label col-md-2 col-sm-3">Semester :</label>
					<div class="col-md-2 col-sm-7">
						<select name="semester" class="form-control">
							<option value="">-- PILIH --</option>
							<option value="ganjil" <?php echo (set_value('semester') == 'ganjil') ? 'selected' : ''; ?>>Ganjil</option>
							<option value="genap" <?php echo (set_value('semester') == 'genap') ? 'selected' : ''; ?>>Genap</option>
						</select>
						<p class="help-block"><?php echo form_error('semester', '<small class="text-red">', '</small>'); ?></p>
						<div class="hidden-md hidden-lg hidden-xs" style="margin-bottom: 10px;"></div>
					</div>
					<div class="hidden-md hidden-lg" style="margin-bottom: 10px;"></div>
					<div class="col-md-2 col-sm-9 col-xs-12">
		              	<button class="btn btn-primary btn-flat bg-blue pull-right" name="action" value="true" id="btn-krs"><i class="fa fa-search"></i> Susun Jadwal </button>
					</div>
				</div>
			</div>
<?php 
echo form_close(); 
	if($this->jadwal->get_mk() != FALSE) :
?>
			<div class="form-horizontal">
				<div class="form-group">
					<hr>
			        <div class="col-xs-12 col-md-3">
					<table>
						<tr>
							<th>Tahun Akademik </th><th width="30" class="text-center">:</th>
							<td><?php echo $this->input->get('thn_akademik'); ?></td>
						</tr>
						<tr>
							<th>Semester </th><th width="30" class="text-center">:</th>
							<td><?php echo ucfirst($this->input->get('semester')); ?></td>
						</tr>
					</table>
			        </div>
			        <div class="col-xs-12 col-md-7" style="margin-bottom: 10px;">
						<a href="<?php echo site_url("mahasiswa/jadwal/print_out?{$this->input->server('QUERY_STRING')}") ?>" target="_blank" class="btn btn-default btn-flat pull-right btn-print"><i class="fa fa-print"></i> Cetak</a>
			        </div>
					<div class="col-xs-12 col-md-12">
						<table class="table table-hover table-bordered table-responsive col-xs-12 mini-font table-black table-bordered-black">
							<thead class="bg-silver">
								<tr>
									<th width="40">No.</th>
									<th width="100" class="text-center">Kode MK</th>
									<th class="text-center">Mata Kuliah</th>
									<th class="text-center">SKS</th>
									<th class="text-center">Hari</th>
									<th class="text-center">Sesi</th>
									<th class="text-center">Ruang</th>
									<th class="text-center">Kode Dosen</th>
									<th class="text-center">Nama Dosen</th>
									<th width="90"></th>
								</tr>
							</thead>
							<tbody>
						<?php  
						/**
						 * undocumented class variable
						 *
						 * @var string
						 **/
						foreach($this->jadwal->get_mk() as $key => $value) :
						?>
								<tr>
									<td class="text-center"><?php echo ++$key; ?>.</td>
									<td class="text-center"><?php echo $value->course_code; ?></td>
									<td><?php echo $value->course_name; ?> <br><i><?php echo $value->course_name_english; ?></i></td>
									<td class="text-center"><?php echo $value->sks; ?></td>
									<td class="text-center"><?php echo ucfirst($value->day); ?></td>
									<td class="text-center"><?php echo $value->session_start." - ".$value->session_end; ?></td>
									<td class="text-center"><?php echo $value->class_name; ?></td>
									<td class="text-center"><?php echo $value->lecturer_code; ?></td>
									<td><?php echo $value->name; ?></td>
									<td class="text-center">
										<a class="icon-button text-green get_schedule" data-id="<?php echo $value->course_id; ?>" data-query="?<?php echo $this->input->server('QUERY_STRING'); ?>" data-toggle="tooltip" data-placement="top" title="Pilih Dosen dan Waktu Kuliah" style="padding-right:10px;">
											<i class="fa fa-calendar-check-o"></i>
										</a>
										<a class="icon-button text-red delete_schedule" data-id="<?php echo $value->result_id; ?>" data-query="?<?php echo $this->input->server('QUERY_STRING'); ?>" data-toggle="tooltip" data-placement="top" title="Hapus Dosen dan Waktu Kuliah">
											<i class="fa fa-calendar-times-o"></i>
										</a>
									</td>
								</tr>
						<?php  
						endforeach;
						?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
	<?php  
	// End IF;
	endif;
	?>
		</div>
	</div>
</div>

<div class="modal animated fadeIn" id="modal-jadwal" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		       <h4 class="modal-title"><i class="fa fa-calendar-check-o"></i> Pilih jadwal Dosen</h4>
		       <span>Silahkan pilih salah satu jadwal dosen kemudian klik simpan.</span>
			</div>
			<form action="" id="form-pilih-jadwal" method="post">
			<div class="modal-body">
				<table class="table table-radio table-bordered table-responsive table-hover">
					<thead class="bg-silver">
						<tr>
							<th width="40"></th>
							<th class="text-center">Hari & Sesi</th>
							<th class="text-center">Ruang</th>
							<th class="text-center">Kode Dosen</th>
							<th class="text-center">Dosen</th>
						</tr>
					</thead>
					<tbody id="data-schedule"> </tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
				<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal animated fadeIn modal-danger" id="modal-delete-jadwal" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           	<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-question-circle"></i> Hapus!</h4>
                <span>Hapus Dosen dan Waktu pada Mata Kuliah ini?</span>
           	</div>
           	<div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <a href="#" id="btn-delete" class="btn btn-outline"> Hapus </a>
           	</div>
        </div>
    </div>
</div>
<?php
/* End of file susun-jadwal.php */
/* Location: ./application/modules/mahasiswa/views/jadwal/susun-jadwal.php */
?>