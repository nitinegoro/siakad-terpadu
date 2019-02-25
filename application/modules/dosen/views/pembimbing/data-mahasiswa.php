<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<div class="col-md-7">
					<h3 class="box-title">Data Mahasiswa PA</h3>
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
				        <label>Kelas :</label>
				        <select name="class" class="form-control input-sm">
				        	<option value="">-- PILIH --</option>
				        	<option value="pagi" <?php if($this->input->get('class')=='pagi') echo 'selected'; ?>>Pagi</option>
				        	<option value="sore" <?php if($this->input->get('class')=='sore') echo 'selected'; ?>>Sore</option>
				        	<option value="malam" <?php if($this->input->get('class')=='malam') echo 'selected'; ?>>Malam</option>
				        </select>	
				    </div>
				</div>
				<div class="col-md-2">
				    <div class="form-group">
				        <label>Jenis Kelamin :</label>
				        <select name="gender" class="form-control input-sm">
				        	<option value="">-- PILIH --</option>
				        	<option value="pria" <?php if($this->input->get('gender')=='pria') echo 'selected'; ?>>Pria</option>
				        	<option value="wanita" <?php if($this->input->get('gender')=='wanita') echo 'selected'; ?>>Wanita</option>
				        </select>	
				    </div>
				</div>
				<div class="col-md-2">
				    <div class="form-group">
				        <label>Tahun Masuk :</label>
				        <select name="registration" class="form-control input-sm">
				        	<option value="">-- PILIH --</option>
					<?php  
					/**
					 * Loop 10 to 100
					 * Guna untuk limit data yang ditampilkan
					 * 
					 * @var 10
					 **/
					$year = 2010; 
					while($year <= date('Y')) :
						$selected_year = ($year == $this->input->get('registration')) ? 'selected' : '';
						echo "<option value='{$year}' " . $selected_year . ">{$year}</option>";

						$year++;
					endwhile;
					?>
				        </select>	
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group">
				        <label>Kata Kunci :</label>
				        <input type="text" name="query" class="form-control input-sm" value="<?php echo $this->input->get('query') ?>" placeholder="NPM / Nama / Alamat . . . ">
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group">
                    <button type="submit" class="btn btn-default top"><i class="fa fa-filter"></i> Filter</button>
                    <a href="<?php echo site_url('dosen/pembimbing') ?>" class="btn btn-default top" style="margin-left: 10px;"><i class="fa fa-times"></i> Reset</a>
				    </div>
				</div>
			</div>
<?php  
// Close Form Filter
echo form_close();

?>
			<div class="box-body">
				<div class="col-md-6">
					Tampilkan 
					<select name="per_page" class="form-control input-sm" style="width:60px; display: inline-block;" onchange="window.location = '<?php echo site_url('dosen/pembimbing?per_page='); ?>' + this.value;">
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
				<div class="col-md-12"><hr>
					<table class="table table-bordered table-hover table-black table-bordered-black mini-font">
						<thead class="bg-silver">
							<tr>
								<th width="30">No.</th>
								<th width="100" class="text-center">NPM</th>
								<th class="text-center">Nama Lengkap</th>
								<th class="text-center">Jenis Kelamin</th>
								<th class="text-center">Tahun Masuk</th>
								<th class="text-center">Konsentrasi</th>
								<th class="text-center">Kelas</th>
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
					$number = ($this->input->get('page') != '') ? $this->input->get('page') : 0;
					foreach($data_mahasiswa as $row) :
					?>
							<tr>
								<td><?php echo ++$number; ?>.</td>
								<td style="font-size: 13.5px;" class="text-center"><?php echo $row->npm; ?></td>
								<td><?php echo $row->name; ?></td>
								<td><?php echo strtoupper($row->gender) ?></td>
								<td><?php echo $row->register_year; ?></td>
								<td><?php echo $row->concentration_name; ?></td>
								<td><?php echo ucfirst($row->class); ?></td>
								<td class="text-center">
									<a href="<?php echo site_url("dosen/pembimbing/getmhs/{$row->student_id}"); ?>" class="icon-button text-green" data-toggle="tooltip" data-placement="top" title="Lihat lebih Lengkap">
										<i class="fa fa-eye"></i>
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
									<span class="pull-right"><?php echo count($data_mahasiswa) . " dari " . $jumlah_mahasiswa . " data"; ?></span>	
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>

			<div class="box-footer text-center">
				<?php echo $this->pagination->create_links(); ?>
			</div>
		</div>
	</div>
</div>

<?php
/* End of file data-mahasiswa.php */
/* Location: ./application/modules/Akademik/views/student/data-mahasiswa.php */	

?>