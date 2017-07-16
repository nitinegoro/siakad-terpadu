<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
       </section>
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
                <span><?php echo $this->session->userdata('account')->name; ?>, Yakin anda akan Keluar dari sistem?</span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tidak</button>
                <a href="<?php echo site_url("akademik/login/signout?from_url=" . current_url()) ?>" type="button" class="btn btn-outline"> Iya </a>
              </div>
            </div>
          </div>
        </div>
   </div>
   <script src="<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/bootstrap/bootstrap.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/plugins/slimScroll/jquery.slimscroll.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/plugins/fastclick/fastclick.js"); ?>"></script>
   <script src="<?php echo base_url("assets/dist/app.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/dist/demo.js"); ?>"></script>
   <script src="<?php echo base_url("assets/dist/jquery.tableCheckbox.js"); ?>"></script>
   <script src="<?php echo base_url("assets/dist/jquery.printPage.js"); ?>"></script>
   <script src="<?php echo base_url("assets/plugins/bnotify/bootstrap-notify.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/dist/moment.min.js"); ?>"></script>
   <script src="<?php echo base_url('assets/plugins/validation/js/formValidation.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/validation/js/framework/bootstrap.js') ?>"></script>
   <script src="<?php echo base_url('assets/plugins/validation/js/language/id_ID.js') ?>"></script>
   <script src="<?php echo base_url('assets/dist/ajaxFileUpload.js'); ?>"></script>
   <script src="<?php echo base_url("assets/plugins/select2/select2.full.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/dist/less-1.3.0.min.js"); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url("assets/dist/prefixfree.min.js"); ?>" type="text/javascript"></script>
   <script type="text/javascript"> 
      var base_url   = '<?php echo site_url('dosen'); ?>';
      var base_path  = '<?php echo base_url('assets'); ?>';
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
<?php 
/* End of file footer.php */
/* Location: ./application/modules/Akademik/views/_template/footer.php */
?>