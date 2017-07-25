<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="col-md-7">
					<h3 class="box-title">Data Dosen / Pengajar</h3>
				</div>
			</div>
<?php  
/**
 * Open Form Filter
 *
 * @var string
 **/
echo form_open(current_url(), array('method' => 'get'));
?>
			<div class="box-body">
				<div class="col-md-2">
				    <div class="form-group">
				        <label>Status Dosen :</label>
				        <select name="status" class="form-control input-sm">
				        	<option value="">-- PILIH --</option>
				        	<option value="ds_tetap" <?php if($this->input->get('status')=='ds_tetap') echo 'selected'; ?>>Dosen Tetap</option>
				        	<option value="ds_luar_biasa" <?php if($this->input->get('status')=='ds_luar_biasa') echo 'selected'; ?>>Dosen Luar Biasa</option>
				        </select>	
				    </div>
				</div>
				<div class="col-md-4">
				    <div class="form-group">
				        <label>Kata Kunci :</label>
				        <input type="text" name="query" class="form-control input-sm" value="<?php echo $this->input->get('query') ?>" placeholder="Kode Dosen / Nama Dosen . . . ">
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group">
                    <button type="submit" class="btn btn-default top"><i class="fa fa-filter"></i> Filter</button>
                    <a href="<?php echo site_url('akademik/lecturer') ?>" class="btn btn-default top" style="margin-left: 10px;"><i class="fa fa-times"></i> Reset</a>
				    </div>
				</div>
			</div>
<?php  
// Close Form Filter
echo form_close();

// Start Checkbox Table
echo form_open(site_url("akademik/lecturer/bulk_action"));
?>
			<div class="box-body">
				<div class="col-md-6">
					Tampilkan 
					<select name="per_page" class="form-control input-sm" style="width:60px; display: inline-block;" onchange="window.location = '<?php echo site_url('akademik/lecturer?per_page='); ?>' + this.value;">
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
				<div class="col-md-5 pull-right">
					<a href="<?php echo site_url('akademik/lecturer/add') ?>" class="btn btn-app">
						<i class="fa fa-plus"></i> Tambah 
					</a>
					<a href="<?php echo site_url("akademik/lecturer/get_print?{$this->input->server('QUERY_STRING')}"); ?>" class="btn btn-app btn-print">
						<i class="fa fa-print"></i> Cetak
					</a>
					<a href="<?php echo site_url("akademik/lecturer/import"); ?>" class="btn btn-app disabled">
						<i class="fa fa-upload"></i> Import Data
					</a>
					<a href="<?php echo site_url("akademik/lecturer/get_export?{$this->input->server('QUERY_STRING')}") ?>" class="btn btn-app">
						<i class="fa fa-download"></i> Export Data
					</a>
				</div>
				<div class="col-md-12"><hr>
					<table class="table table-bordered table-hover table-black table-bordered-black mini-font">
						<thead class="bg-silver">
							<tr>
								<th width="40">
				                    <div class="checkbox checkbox-inline">
				                        <input id="checkbox1" type="checkbox"> <label for="checkbox1"></label>
				                    </div>
								</th>
								<th width="30">No.</th>
								<th width="100" class="text-center">Kode Dosen</th>
								<th class="text-center">Nama Dosen</th>
								<th class="text-center">Alamat</th>
								<th class="text-center">Telepon</th>
								<th class="text-center">Status</th>
								<th width="100"></th>
							</tr>
						</thead>
						<tbody>
					<?php  
					/**
					 * Start Loop Data Mahasiswa
					 *
					 * @var string
					 **/
					$number = ($this->input->get('page') != '') ? $this->input->get('page') : 1;
					foreach($daftar_dosen as $row) :
					?>
							<tr>
								<td>
				                    <div class="checkbox checkbox-inline">
				                        <input id="checkbox1" type="checkbox" name="lecturer[]" value="<?php echo $row->lecturer_id; ?>"> <label for="checkbox1"></label>
				                    </div>
								</td>
								<td class="text-center"><?php echo $number++; ?>.</td>
								<td class="text-center"><?php echo $row->lecturer_code; ?></td>
								<td> <?php echo $row->name; ?> <br><small><?php echo $row->nidn; ?></small></td>
								<td><?php echo $row->address; ?></td>
								<td><?php echo $row->phone; ?></td>
								<td class="text-center"><?php echo data_status($row->status); ?></td>
								<td class="text-center">
									<a href="<?php echo site_url("akademik/lecturer/update/{$row->lecturer_id}") ?>" class="icon-button text-blue" data-toggle="tooltip" data-placement="top" title="Sunting">
										<i class="fa fa-pencil"></i>
									</a>
									<a class="icon-button text-red get-delete-lecturer" data-id="<?php echo $row->lecturer_id; ?>" data-toggle="tooltip" data-placement="top" title="Hapus">
										<i class="fa fa-trash-o"></i>
									</a>
								</td>
							</tr>
					<?php  
					// End Loop Data Mahasiswa
					endforeach;
					?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="9">
									<label style="font-size: 11px; margin-right: 10px;">Yang terpilih :</label>
									<a class="btn btn-xs btn-round btn-danger get-delete-lecturer-multiple"><i class="fa fa-trash-o"></i> Hapus</a>
									<span class="pull-right"><?php echo count($daftar_dosen) . " dari " . $jumlah_dosen . " data"; ?></span>	
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>


			<div class="modal animated fadeIn modal-danger" id="modal-delete-lecturer-multiple" tabindex="-1" data-backdrop="static" data-keyboard="false">
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
// Form Close Checkbox Mahasiswa
echo form_close();
?>
			<div class="box-footer text-center">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
</div>


<div class="modal animated fadeIn modal-danger" id="modal-delete-lecturer" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><i class="fa fa-question-circle"></i> Hapus!</h4>
				<span>Hapus Dosen ini dari sistem?</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
				<a href="#" id="btn-delete" class="btn btn-outline"> Hapus </a>
			</div>
		</div>
	</div>
</div>