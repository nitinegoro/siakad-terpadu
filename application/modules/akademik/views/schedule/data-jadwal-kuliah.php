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
              <h3 class="box-title">Cari Jadwal Kuliah</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                	<i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
			<div class="box-body with-border">
				<div class="col-md-4">
					<label for="thn_akademik">Tahun Ajaran :</label>
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
				</div>
				<div class="col-md-4">
					<label for="semester">Semester :</label>
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
					<a href="<?php echo site_url('akademik/schedule') ?>" class="btn btn-app">
						<i class="fa fa-times"></i> Reset
					</a>
				</div>
			</div>
		</div>		
	</div>
<?php  
// End Serach Form
echo form_close();
?>
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
<?php  
	/**
	 * Tampilkan Data Jadwal Kuliah
	 *
	 **/
	if($jadwal_kuliah) :
?>
		<div class="box pad box-primary">
			<div class="box-body with-border">
				<div class="col-md-6">
					Tampilkan 
					<select name="per_page" class="form-control input-sm" style="width:60px; display: inline-block;" onchange="window.location = '<?php echo site_url("akademik/schedule?thn_akademik={$this->schedule->thn_akademik}&semester={$this->schedule->semester}&per_page="); ?>' + this.value;">
					<?php  
					/**
					 * Loop 10 to 100
					 * Guna untuk limit data yang ditampilkan
					 * 
					 * @var 10
					 **/
					$start = 20; 
					while($start <= 100) :
						$selected = ($start == $this->input->get('per_page')) ? 'selected' : '';
						echo "<option value='{$start}' " . $selected . ">{$start}</option>";

						$start += 10;
					endwhile;
					?>
					</select>
					per Halaman
				</div>
				<div class="col-md-8" style="margin-top: 30px;">
					<h4>Jadwal Kuliah Semester <?php echo ucfirst($this->schedule->semester) ?> Tahun Akademik <?php echo $this->schedule->thn_akademik; ?></h4>
				</div>
				<div class="col-md-4 pull-right">
					<a href="<?php echo site_url("akademik/schedule/get_print?{$this->input->server('QUERY_STRING')}") ?>" class="btn btn-app btn-print"><i class="fa fa-print"></i> Cetak</a>
					<button type="submit" class="btn btn-app disabled"><i class="fa fa-file-pdf-o"></i> Unduh PDF</button>
					<button type="submit" class="btn btn-app disabled"><i class="fa fa-download"></i> Export</button>
				</div>
		<?php  
		echo form_open(site_url("akademik/schedule/bulk_action?{$this->input->server('QUERY_STRING')}"));
		?>
				<div class="col-md-12"><hr>
					<table class="table table-bordered table-hover table-black table-bordered-black mini-font">
						<thead class="bg-silver">
							<tr>
								<th width="40">
				                    <div class="checkbox checkbox-inline">
				                        <input id="checkbox1" type="checkbox"> <label for="checkbox1"></label>
				                    </div>
								</th>
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
					 * Data Daftar Kuliah
					 *
					 **/
					foreach($jadwal_kuliah as $row) :
					?>
							<tr>
								<td>
				                    <div class="checkbox checkbox-inline">
				                        <input id="checkbox1" type="checkbox" name="schedules[]" value="<?php echo $row->lecturer_schedule_id; ?>"> <label for="checkbox1"></label>
				                    </div>
								</td>
								<td class="text-center"><?php echo $row->course_code; ?></td>
								<td>
									<?php echo $row->course_name; ?> <br> <small><i><?php echo $row->course_name_english; ?></i></small>
								</td>
								<td class="text-center"><?php echo $row->sks; ?></td>
								<td class="text-center"><?php echo ucfirst($row->day); ?></td>
								<td class="text-center"><?php echo $row->session_start." - ".$row->session_end; ?></td>
								<td class="text-center"><?php echo $row->class_name; ?></td>
								<td class="text-center"><?php echo $row->lecturer_code; ?></td>
								<td><?php echo $row->name; ?></td>
								<td class="text-center">
									<a href="<?php echo site_url("akademik/schedule/update/{$row->lecturer_schedule_id}") ?>" class="icon-button text-blue" data-toggle="tooltip" data-placement="top" title="Sunting">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="icon-button text-red get-delete-schedule" data-id="<?php echo $row->lecturer_schedule_id; ?>" data-query="?<?php echo $this->input->server('QUERY_STRING'); ?>" data-toggle="tooltip" data-placement="top" title="Hapus">
										<i class="fa fa-trash-o"></i>
									</a>
								</td>
							</tr>
					<?php  
					endforeach;
					?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="11">
									<label style="font-size: 11px; margin-right: 10px;">Yang terpilih :</label>
									<a class="btn btn-xs btn-round btn-danger get-delete-schedule-multiple"><i class="fa fa-trash-o"></i> Hapus</a>
									<span class="pull-right"><?php echo count($jadwal_kuliah) . " dari " . $jumlah_jadwal . " data"; ?></span>	
								</td>
							</tr>
						</tfoot>
					</table>
				</div>

				<div class="modal animated fadeIn modal-danger" id="modal-delete-schedule-multiple" tabindex="-1" data-backdrop="static" data-keyboard="false">
					<div class="modal-dialog modal-sm">
					    <div class="modal-content">
					        <div class="modal-header">
					            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					            <h4 class="modal-title"><i class="fa fa-question-circle"></i> Hapus!</h4>
					            <span>Hapus pengguna ini dari sistem?</span>
					        </div>
					        <div class="modal-footer">
					            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
					            <button type="submit" name="action" value="delete" id="btn-delete" class="btn btn-outline"> Hapus </button>
					        </div>
					    </div>
					</div>
				</div>
<?php  
		// End Form Bulk Actiom
		echo form_close();
	else :
		if($this->input->get('action')) :
?>
				<div class="col-md-8 col-md-offset-2 col-xs-12">
					<div class="alert alert-warning animated bounce">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong><i class="fa fa-warning"></i> Maaf!</strong> <p>Jadwal Kuliah Semester <?php echo ucfirst($this->schedule->semester) ?> Tahun Akademik <?php echo $this->schedule->thn_akademik; ?> tidak tersedia, atau belum dibuat.</p>
					</div>
				</div>
<?php  
		endif;
	endif;
?>
			</div>
		</div>
	</div>
</div>

<div class="modal animated fadeIn modal-danger" id="modal-delete-schedule" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           	<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-question-circle"></i> Hapus!</h4>
                <span>Hapus data Mahasiswa ini dari sistem?</span>
           	</div>
           	<div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <a href="#" id="btn-delete" class="btn btn-outline"> Hapus </a>
           	</div>
        </div>
    </div>
</div>
<?php  
/* End of file data-jadwal-kuliah.php */
/* Location: ./application/modules/Akademik/views/schedule/data-jadwal-kuliah.php */
?>