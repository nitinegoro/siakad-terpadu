<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('header', $this->data);
?>
    <header>
        <div class="indigo darken-3" style="padding-bottom: 10px;">
            <nav>
                <div class="nav-wrapper indigo darken-4" style="margin-bottom: 0px;">
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                    <img src="<?php echo base_url("assets/img/brand.png"); ?>" class="brand-logo center" alt="Logo STIE Pertiba">
                    <a href="#logoff" class="right"><i class="fa fa-sign-out"></i></a>
                </div>
            </nav>
        </div>
        <div class="parallax-container">
            <div class="parallax indigo darken-3">
                <img src="<?php echo base_url("assets/mobile/images/mahasiswa.png"); ?>">
            </div>
        </div>  
    </header>
    <section>
        <div class="container">
            <div class="row">
                <div class="col s4 center">
                    <div class="box-shorcuts z-depth-3">
                        <a href="<?php echo site_url('mobile/schedule') ?>" class="center">
                            <div class="icon-shortcuts indigo darken-4">
                                <i class="icon fa fa-calendar"></i>
                            </div>
                            <span>Jadwal Kuliah</span>
                        </a>
                    </div>
                </div>
                <div class="col s4 center">
                    <div class="box-shorcuts z-depth-3">
                        <a href="<?php echo site_url('mobile/point') ?>" class="center">
                            <div class="icon-shortcuts indigo darken-4">
                                <i class="icon fa fa-trophy"></i>
                            </div>
                            <span>Transkrip</span>
                        </a>
                    </div>
                </div>
                <div class="col s4 center">
                    <div class="box-shorcuts z-depth-3">
                        <a href="<?php echo site_url('mobile/point/point_semester') ?>" class="center">
                            <div class="icon-shortcuts indigo darken-4">
                                <i class="icon fa fa-file-text-o"></i>
                            </div>
                            <span>Hasil Studi</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s4 center">
                    <div class="box-shorcuts z-depth-3">
                        <a href="<?php echo site_url('mobile/plain/create') ?>" class="center">
                            <div class="icon-shortcuts indigo darken-4">
                                <i class="icon fa fa-pencil"></i>
                            </div>
                            <span>Susun KRS</span>
                        </a>
                    </div>
                </div>
                <div class="col s4 center">
                    <div class="box-shorcuts z-depth-3">
                        <a href="" class="center">
                            <div class="icon-shortcuts indigo darken-4">
                                <i class="icon fa fa-credit-card"></i>
                            </div>
                            <span>Pembayaran</span>
                        </a>
                    </div>
                </div>
                <div class="col s4 center">
                    <div class="box-shorcuts z-depth-3">
                        <a href="" class="center">
                            <div class="icon-shortcuts indigo darken-4">
                                <i class="icon fa fa-bullhorn"></i>
                            </div>
                            <span>Pengumuman</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12 box-footer">
            <p>&copy; 2017 STIE Pertiba Pangkalpinang</p>
            <p>Versi 1.0 Beta</p>
        </div>
<?php  

$this->load->view('footer', $this->data);

/* End of file main.php */
/* Location: ./application/modules/mobile/views/main.php */