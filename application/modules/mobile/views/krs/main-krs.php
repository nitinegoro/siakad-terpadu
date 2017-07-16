<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('header', $this->data);
?>
    <section ng-controller="lihatkrsCtrl">
        <header class="navbar-fixed">
            <div class="indigo darken-3">
                <nav>
                    <div class="nav-wrapper indigo darken-4" style="margin-bottom: 0px;">
                        <a href="#" onclick="return history.back()"><i class="fa fa-angle-double-left"></i></a>
                        <a href="#" class="heading-text"><?php echo $title ?></a>
                        <a href="#logoff" class="right"><i class="fa fa-sign-out"></i></a>
                    </div>
                </nav>
            </div>
        </header>
        <div class="progress indigo" ng-show="loading">
            <div class="indeterminate white"></div>
        </div>
        <section class="white" style="padding-bottom: 1px;margin-top: 50px">
            <div class="container" style="padding-top: 20px;">
                <div class="row">
                    <form name="lihat-krs-form">
                    <div class="col s12">
                        <div class="input-field col s12">
                            <select class="black-text" ng-model="data.semester" required />
                                <option value="">-- PILIH --</option>
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
                            <label class="black-text">Semester :</label>
                        </div>

                        <div class="input-field col s12">
                            <select class="gray-text" ng-model="data.thnakademik" required />
                                <option value="">-- PILIH --</option>
                                <?php  
                                /**
                                 * Loop Tahun Akademik
                                 *
                                 * @var Integer
                                 **/
                                $thn2 = 2011;
                                for($thn1 = 2010; $thn1 <= (date('Y')); $thn1++) :
                                ?>
                                    <option value="<?php echo $thn1.'/'.$thn2; ?>" <?php if(($thn1.'/'.$thn2)==$this->input->get('thn_ajaran')) echo "selected"; ?>><?php echo $thn1.'/'.$thn2; ?></option>
                                <?php  
                                $thn2++;
                                // End Loop thn Ajaran
                                endfor;
                                ?>
                            </select>
                            <label class="black-text">Akademik :</label>
                            <small class="red-text" ng-show="semestererror">Semester harus diisi! <br></small>
                            <small class="red-text" ng-show="thakademikerror">Tahun Akademik harus diisi!</small>
                        </div>
                        <div class="input-field col s12 center">
                            <button type="button" ng-click="getkrsdata();" class="waves-effect btn indigo darken-2 white-text">Lihat Kartu Rencana Studi</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="white" ng-show="datakrs">
            <div class="row">
                <div class="col s12" style="margin-top: 40px; ">
                    <div class="col s4 right">
                        Total SKS : <span class="bigger-1">{{krs.totalSks}}</span>
                    </div>
                </div>
            </div>
            <ul class="collection">
                <li class="collection-item" ng-repeat="item in krs.results  | orderBy : 'course_name'">
                    <span class="upper gray-text">{{item.course_name}}</span> 
                    <strong>
                        <i class="small right fa fa-check green-text" ng-show="item.verification == 1"></i>
                        <i class="small right fa fa-times red-text" ng-show="item.verification == 0"></i>
                    </strong>
                    <br> <small>{{item.course_code}} - {{item.sks}} SKS</small>
                </li>
            </ul>
            
        </section>
    </section>
<?php  

$this->load->view('footer', $this->data);

/* End of file main-jadwal.php */
/* Location: ./application/modules/mobile/views/jadwal/main-jadwal.php */