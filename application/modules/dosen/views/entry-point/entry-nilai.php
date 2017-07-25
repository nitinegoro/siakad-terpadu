<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="box pad box-primary">
			<div class="box-body with-border">
				<div class="col-md-4">
					<a href="" class="btn btn-app"><i class="fa fa-undo"></i> Kembali</a>
					<a href="" class="btn btn-app btn-print"><i class="fa fa-print"></i> Cetak</a>
					<a href="" class="btn btn-app"><i class="fa fa-download"></i> Ekspor</a>
				</div>
				<div class="col-md-4">
					<table>
						<tr>
							<th>Kode MK </th><th width="30" class="text-center">:</th>
							<td><?php echo $jadwal->course_code; ?></td>
						</tr>
						<tr style="vertical-align: top;">
							<th>Mata Kuliah </th><th width="30" class="text-center">:</th>
							<td><?php echo $jadwal->course_name; ?> <br> <small><i><?php echo $jadwal->course_name_english ?></i></small></td>
						</tr>
						<tr>
							<th>Jumlah SKS </th><th width="30" class="text-center">:</th>
							<td><?php echo $jadwal->sks; ?></td>
						</tr>
					</table>
				</div>
				<div class="col-md-4">
					<table>
						<tr>
							<th>Tahun Ajaran </th><th width="30" class="text-center">:</th>
							<td><?php echo $jadwal->years; ?></td>
						</tr>
						<tr>
							<th>Semester </th><th width="30" class="text-center">:</th>
							<td><?php echo ucfirst($jadwal->semester); ?></td>
						</tr>
						<tr>
							<th>Hari </th><th width="30" class="text-center">:</th>
							<td><?php echo ucfirst($jadwal->day); ?></td>
						</tr>
						<tr>
							<th>Sesi </th><th width="30" class="text-center">:</th>
							<td><?php echo $jadwal->session_start." - ".$jadwal->session_end; ?></td>
						</tr>
						<tr>
							<th>Ruang </th><th width="30" class="text-center">:</th>
							<td><?php echo $jadwal->class_name ?></td>
						</tr>
					</table>
				</div>
		<?php  
		echo form_open(site_url("dosen/entrypoint/set_nilai/{$this->uri->segment(4)}"));
		?>
					<div class="col-md-12"><hr></div>
					<table class="table table-bordered table-responsive table-nilai-input">
						<thead class="bg-silver">
							<tr>
								<th rowspan="2" width="30" class="text-center">No.</th>
								<th rowspan="2" width="130" class="text-center">NPM</th>
								<th rowspan="2" class="text-center">Nama</th>
								<th colspan="4" class="text-center">Nilai</th>
								<th rowspan="2" width="85" class="text-center">Nilai Akhir</th>
								<th rowspan="2" width="85" class="text-center">Grade</th>
								<th rowspan="2" width="85" class="text-center">Bobot</th>
							</tr>
							<tr>
								<th width="80" class="text-center">Kehadiran</th>
								<th width="85" class="text-center">Tugas</th>
								<th width="85" class="text-center">UTS</th>
								<th width="85" class="text-center">UAS</th>
							</tr>
						</thead>
						<tbody>
						<?php  
						/**
						 * Loop data Nilai Mahasiswa
						 *
						 * @var string
						 **/
						foreach($mahasiswa as $key => $value) :
							echo form_hidden("point[{$value->result_id}][sks]", $value->sks);
						?>
							<tr>
								<td class="text-center"><?php echo ++$key; ?>.</td>
								<td><?php echo $value->npm; ?></td>
								<td><?php echo $value->name; ?></td>
								<td class="td-nilai">
									<input type="text" value="<?php echo $value->absent; ?>" name="point[<?php echo $value->result_id ?>][absent]" class="input-nilai">
								</td>
								<td class="td-nilai">
									
									<input type="text" value="<?php echo $value->task; ?>" name="point[<?php echo $value->result_id ?>][task]" class="input-nilai">
								</td>
								<td class="td-nilai">
									
								<input type="text" value="<?php echo $value->midterms; ?>" name="point[<?php echo $value->result_id ?>][midterms]" class="input-nilai">
								</td>
								<td class="td-nilai">
										
									<input type="text" value="<?php echo $value->final; ?>" name="point[<?php echo $value->result_id ?>][final]" class="input-nilai">
								</td>
								<td class="text-center"><?php echo $value->point; ?></td>
								<td class="text-center"><?php echo $value->grade; ?></td>
								<td class="text-center"><?php echo $value->quality; ?></td>
							</tr>
						<?php  
						endforeach;
						?>
						</tbody>
					</table>
				<?php if($this->option->get('entry_nilai_dosen') == 'yes') : ?>
				<div class="col-md-12">
					<div class="col-md-10 col-md-offset-1">
						<button type="submit" class="btn btn-app pull-right"><i class="fa fa-save"></i> Simpan</button>
					</div>
				</div>
			<?php endif; ?>
			<?php  
			echo form_close();
			?>
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
/* End of file cari-kelas.php */
/* Location: ./application/modules/Akademik/views/schedule/cari-kelas.php */
?>