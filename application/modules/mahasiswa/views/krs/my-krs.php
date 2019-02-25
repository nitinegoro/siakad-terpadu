<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-12">
	<div class="box pad box-primary">
		<div class="box-header">
			<div class="col-md-8 col-md-offset-2"><?php echo $this->session->flashdata('alert'); ?></div>
		</div>
		<div class="form-horizontal">
			<div class="form-group">
				<div class="col-xs-12 col-md-8 col-md-offset-2">
		           <div class="callout callout-default">
		               <h4><i class="fa fa-bullhorn"></i> Info!</h4>
		               <p>Berikut ini adalah Mata Kuliah yang akan diambil pada <strong> Semester <?php echo ucfirst($get[0]->semester); ?> Tahun ajaran <?php echo ucfirst($get[0]->years); ?></strong>. Anda dapat merubahnya sebelum diverifikasi oleh bagian Akademik.</p>
		               <p>Untuk Mata Kuliah yang telah terverifikasi anda tidak dapat mengganti, hubungi Bagian Akademik / Dosen PA untuk melakukan pergantian Mata Kuliah.</p>
		           </div>
		        </div>
		        <div class="col-xs-12 col-md-8 col-md-offset-2" style="margin-bottom: 10px;">
					<a href="<?php echo site_url("mahasiswa/krs/get_print"); ?>" class="btn btn-default btn-flat pull-right btn-print"><i class="fa fa-print"></i> Cetak</a>
					<button class="btn btn-default btn-flat pull-right add-mk" style="margin-right: 10px;"><i class="fa fa-plus"></i> Tambah Mata Kuliah</button>
		        </div>
				<div class="col-xs-12 col-md-8 col-md-offset-2">
					<table class="table table-hover table-bordered table-striped table-responsive col-xs-12 table-black table-bordered-black">
						<thead style="background-color: white;">
							<tr>
								<th width="30">No.</th>
								<th width="100">Kode MK</th>
								<th class="text-center">Mata Kuliah</th>
								<th>SKS</th>
								<th class="hidden-xs text-center">Status</th>
								<th class="text-center"><i class="fa fa-cogs"></i></th>
							</tr>
						</thead>
						<tbody> 
				<?php  
				/**
				 * Get Plain Study
				 *
				 * @return Result
				 **/
				$sks = 0;
				foreach($get as $key => $value) :
				?>
							<tr>
								<td><?php echo ++$key; ?>.</td>
								<td><?php echo $value->course_code; ?></td>
								<td><?php echo $value->course_name; ?></td>
								<td><?php echo $value->sks; ?></td>
								<td class="hidden-xs">
									<small class="<?php echo ($value->verification) ? '' : 'text-line'; ?>">Terverifikasi</small> / 
									<small class="<?php echo ($value->verification) ? 'text-line' : ''; ?>">Belum</small>
								</td>
								<td class="text-center" style="font-size: 15px;">
								<?php if($value->verification == FALSE) : ?>
									<a class="text-blue ganti-mk" data-id="<?php echo $value->plain_id; ?>" data-course-id="<?php echo $value->course_id; ?>" data-course="<?php echo $value->course_name; ?>" data-toggle="tooltip" title="Ganti"><i class="fa fa-pencil"></i></a>
								<?php endif; ?>
								</td>
							</tr>
				<?php  
				// End Loop
				$sks += $value->sks;
				endforeach;
				?>
						</tbody>
						<thead>
							<tr>
								<th colspan="3" class="text-right">Total SKS : </th>
								<th colspan="3"><?php echo $sks; ?></th>
							</tr>
						</thead>
					</table>						
				</div>
			</div>
		</div>
		<div class="box-footer with-border">
			<div class="col-md-8 col-md-offset-2 col-xs-12">

			</div>
		</div>
	</div>
	</div>
</div>
<!-- MODAL UPDATE MK -->
<div class="modal animated fadeIn modal-default" id="modal-ganti-mk" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		    <div class="modal-header">
		       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		       <h4 class="modal-title"><i class="fa fa-pencil text-blue"></i> Ganti Mata Kuliah <span id="krs-title"></span></h4>
		       <span>Silahkan pilih mata kuliah pengganti kemudian klik simpan.</span>
		    </div>
<?php  
/**
 * Open Form Update MK Plain
 *
 * @return string
 **/
echo form_open('', array('id' => 'form-update-krs'));
?>
		    <div class="moda-body">
		    	<div class="col-xs-12" style="margin-top: 10px;">
		    		<input type="hidden" name="last-mk" value="" id="mk-diganti">
			    	<table class="table table-hover table-bordered table-responsive">
			    		<thead>
			    			<tr>
			    				<th width="30"></th>
								<th width="100">Kode MK</th>
								<th>Mata Kuliah</th>
								<th>SKS</th>
			    			</tr>
			    		</thead>
			    		<tbody id="repeat-update-mk"></tbody>
			    	</table>
		    	</div>
		    </div>
		    <div class="modal-footer">
		       <button type="button" class="btn btn-flat pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
		       <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-save"></i> Simpan </button>
		    </div>
<?php  
// End Form
echo form_close();
?>
		</div>
	</div>
</div>
<!-- MODAL ADD MK -->
<div class="modal animated fadeIn modal-default" id="modal-add-mk" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		    <div class="modal-header">
		       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		       <h4 class="modal-title"><i class="fa fa-plus"></i> Tambah Mata Kuliah</h4>
		       <span>Silahkan pilih mata kuliah yang akan ditambah kemudian klik simpan.</span>
		    </div>
<?php  
/**
 * Open Form Update MK Plain
 *
 * @return string
 **/
echo form_open(site_url('mahasiswa/krs/add'), array('id' => 'form-add-mk'));
?>
		    <div class="moda-body">
		    	<div class="col-xs-12" style="margin-top: 10px;">
		    		<input type="hidden" name="last-mk" value="" id="mk-diganti">
			    	<table class="table table-hover table-bordered table-responsive">
			    		<thead>
			    			<tr>
			    				<th width="30"></th>
								<th width="100">Kode MK</th>
								<th>Mata Kuliah</th>
								<th>SKS</th>
			    			</tr>
			    		</thead>
			    		<tbody id="repeat-add-mk"></tbody>
			    	</table>
		    	</div>
		    </div>
		    <div class="modal-footer">
		       <button type="button" class="btn btn-flat pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
		       <button type="submit" class="btn btn-flat btn-primary"><i class="fa fa-save"></i> Simpan </button>
		    </div>
<?php  
// End Form
echo form_close();
?>
		</div>
	</div>
</div>
<?php
/* End of file index.php */
/* Location: ./application/modules/Mahasiswa/views/krs/my_krs.php */
?>
