<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$account = $this->account->get();
?>
        <ul id="slide-out" class="side-nav">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="<?php echo base_url("assets/mobile/images/bg.jpg"); ?>" alt="">
                    </div>
                    <a href=""><img class="circle" src="<?php echo base_url("assets/img/avatar.jpg"); ?>"></a>
                    <a href="#">
                        <span class="white-text name">
                        <?php echo $account->name; ?> (<?php echo $account->npm; ?>)
                        </span>
                    </a>
                    <a href="#">
                        <span class="white-text email">
                            <?php echo $account->email; ?>        
                        </span>
                    </a>
                </div>
            </li>
            <li><a href="<?php echo site_url('mobile/schedule') ?>">Jadwal Kuliah</a></li>
            <li><a href="<?php echo site_url('mobile/point/point_semester') ?>">Kartu Hasil Studi</a></li>
            <li><a href="<?php echo site_url('mobile/point') ?>">Transkrip Nilai</a></li>
            <li><a href="<?php echo site_url('mobile/plain') ?>">Kartu Rencana Studi</a></li>
            <li><a href="">Pembayaran</a></li>
            <li><a href="">Pengumuman</a></li>
            <li><a href="">Journal Online</a></li>
            <li><a href="">Info Loker</a></li>
            <li><a href="">G-Drive</a></li>
            <li><a href="">Agenda Kampus</a></li>
            <li><div class="divider"></div></li>
            <li><a href="<?php echo site_url('mobile/main/account') ?>">Pengaturan Akun</a></li>
            <li><a href="">Bantuan</a></li>
        </ul>

        <div id="logoff" class="modal">
            <div class="modal-content">
                <h5>Keluar Aplikasi?</h5>
            </div>
            <div class="modal-footer">
                 <a class="modal-action modal-close waves-effect waves-green btn-flat">Tidak</a>
                <a href="<?php echo site_url('mobile/login/signout') ?>" class="modal-action modal-close waves-effect waves-green btn-flat">Ya</a>
            </div>
        </div>
          
    </section>

	<script src="<?php echo base_url("assets/plugins/jQuery/jquery-2.2.3.min.js"); ?>"></script>
	<script src="<?php echo base_url("assets/mobile/materialize/js/materialize.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/angular/angular.min.js") ?>"></script>
    <script src="<?php echo base_url("assets/angular/angular-route.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/angular/angular-animate.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/angular/angular-messages.min.js"); ?>"></script> 
    <script src="<?php echo base_url("assets/angular/angular-resource.min.js"); ?>"></script>
    <script>
        let base_url = '<?php echo site_url('mobile') ?>';

        let app = angular.module('app', []);

        $(".button-collapse").sideNav();
         //$('.carousel.carousel-slider').carousel({fullWidth: true});
        $('.parallax').parallax();

        $('.modal').modal();

        $('select').material_select();
    
    </script>
    <script src="<?php echo base_url("assets/app/mobile/main-utama.js"); ?>"></script>
    <!-- </body></html> -->
</body>
</html>
<?php
/* End of file footer.php */
/* Location: ./application/modules/mobile/views/footer.php */