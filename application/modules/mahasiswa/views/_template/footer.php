		
				</section><!--/content-->
		</div>
	</div>

			<footer class="main-footer">
			    <div class="pull-right hidden-xs">
			      <b>Versi</b> <?php echo MODULE_MAHASISWA; ?>
			    </div>
			   <div class="container text-center">
			     <small>Hak Cipta &copy; 2016 - <?php echo date('Y'); ?> <a href="">IT Division</a> STIE Pertiba Pangkalpinang. All rights
			      reserved.<small>
			   </div>
			</footer>
		    <div class="modal animated fadeIn modal-danger" id="logout" tabindex="-1" data-backdrop="static" data-keyboard="false">
		      <div class="modal-dialog modal-sm">
		        <div class="modal-content">
		          <div class="modal-header">
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		            <h4 class="modal-title"><i class="fa fa-question-circle"></i> Question!</h4>
		            <span>Hai, Yakin anda akan Keluar dari sistem?</span>
		          </div>
		          <div class="modal-footer">
		            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
		            <a href="<?php echo site_url("mahasiswa/login/signout?from_url=" . current_url()) ?>" type="button" class="btn btn-outline"> Iya </a>
		          </div>
		        </div>
		      </div>
		    </div>
</div>
		<script src="<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/bootstrap/bootstrap.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/slimScroll/jquery.slimscroll.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/dist/jquery.tableCheckbox.js"); ?>"></script>
		<script src="<?php echo base_url("assets/dist/jquery.timeago.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/fastclick/fastclick.js"); ?>"></script>
		<script src="<?php echo base_url("assets/dist/app.min.js"); ?>"></script>
	   <script src="<?php echo base_url("assets/plugins/picdate/picker.js"); ?>"></script>
	   <script src="<?php echo base_url("assets/plugins/picdate/picker.date.js"); ?>"></script>
	   <script src="<?php echo base_url("assets/plugins/picdate/picker.time.js"); ?>"></script>
	   <script src="<?php echo base_url("assets/plugins/picdate/legacy.js"); ?>"></script>
		<script src="<?php echo base_url("assets/dist/jquery.tableCheckbox.js"); ?>"></script>
		<script src="<?php echo base_url("assets/dist/jquery.printPage.js"); ?>"></script>
		<script src="<?php echo base_url("assets/plugins/bnotify/bootstrap-notify.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/dist/less-1.3.0.min.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/dist/prefixfree.min.js"); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url("assets/app/mahasiswa/main.js?v=1.0.1"); ?>"></script>
		<script type="text/javascript"> 
			var base_url 	= '<?php echo site_url('mahasiswa'); ?>';
			var base_path 	= '<?php echo base_url('assets'); ?>';
			var current_url = '<?php echo current_url(); ?>';
		</script>
		<?php 

		/**
		 * Load js from loader core
		 *
		 * @return CI_OUTPUT
		 **/
		if(isset($js) ==! FALSE) : foreach($js as $file) :  ?>
				<script src="<?php echo $file; ?>"></script>
		<?php endforeach; endif; ?>
	</body>
</html>