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
echo form_open_multipart(site_url("akademik/entrypoint/save_import"), array('class' => 'form-horizontal', 'id' => 'form-import-nilai'))	
?>
			<div class="box-body" style="margin-top: 10px;">
				<div class="form-group pad">
					<div class="col-md-12">
			           <div class="callout callout-default">
			               <h4><i class="fa fa-bullhorn"></i> Perhatian!</h4>
			               <p>- File harus berekstensi (.xlxs) atau berformat Microsoft Excel 2007 - 2010</p>
			               <p>- Ukuran File tidak lebih dari 3MB</p>
			               <p>- Field - field yang diunggah harus sesuai dengan contoh yang ada. <a href="" class="text-blue">Lihat Disini</a></p>
			           </div>
					</div>
				</div>
				<div class="form-group">
					<label for="file_excel" class="control-label col-md-2 col-xs-12">File : <strong class="text-red">*</strong></label>
					<div class="col-md-8">
						<input type="file" name="file_excel" class="form-control" id="file-excel">
						<p class="help-block"><?php echo form_error('file_excel', '<small class="text-red">', '</small>'); ?></p>
					</div>
				</div>
			</div>

			<div class="box-footer with-border">
				<div class="col-md-4 col-xs-5">
					<a href="" class="btn btn-app pull-right">
						<i class="fa fa-times"></i> Reset
					</a>
				</div>
				<div class="col-md-6 col-xs-6">
					<button type="submit" class="btn btn-app pull-right">
						<i class="fa fa-upload"></i> Unggah
					</button>
				</div>
			</div>
			<div class="box-footer with-border">
					<small><strong class="text-red">*</strong>	Field wajib diisi!</small> <br>
			</div>
<?php  
// End Form
echo form_close();
?>
		</div>
	</dov>
</div>