<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('header', $this->data);
?>
    <section ng-controller="susunkrsCtrl">
        <header class="navbar-fixed">
            <div class="indigo darken-3">
                <nav>
                    <div class="nav-wrapper indigo darken-4" style="margin-bottom: 0px;">
                        <a href="#" onclick="return history.back()"><i class="fa fa-angle-double-left"></i></a>
                        <a href="#" class="heading-text"><?php echo $title ?></a>
                        <a href="#logoff" class="right"><i class="fa fa-sign-out"></i></a>
                    </div>
                    <div class="nav-wrapper indigo darken-4" style="margin-bottom: 0px;">
                        <a href="#" class="left" style="padding-left: 20px;">Total SKS : {{count}}</a>
                    </div>
                </nav>
            </div>
        </header>
        <form name="susun-krs-form">
        <section class="white" style="padding-bottom: 1px;margin-top: 105px">
            <div class="container" style="padding-top: 20px;">
                <div class="row">
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
                            <label class="black-text">Tahun Akademik :</label>
                            <small class="red-text" ng-show="semestererror">Semester harus diisi! <br></small>
                            <small class="red-text" ng-show="thakademikerror">Tahun Akademik harus diisi!</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="center" style="padding-top: 50px;" ng-show="loading">
                <div class="preloader-wrapper big active">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>
            <ul class="collection">
                <li class="collection-item" ng-repeat="course in courses">
                    <input type="checkbox" id="{{course.id}}" name="data.mk[{{course.id}}]" data-sks="{{course.sks}}" ng-model="data.mk[course.id].selected" ng-value="{{course.id}}" ng-click="mkChanged($event, course.id)" />
                    <label for="{{course.id}}">
                        <span class="bigger-2">{{course.text}}</span><br>
                        <small>{{course.code}} - {{course.sks}} SKS</small>
                    </label>
                </li>
            </ul>
            <div class="row" style="padding-bottom: 40px;">
                <div class="input-field col s12 center">
                    <button type="button" ng-click="createkrs();" class="waves-effect btn indigo darken-2 white-text">Simpan Pengajuan KRS</button>
                </div>
            </div>
        </section>
        </form>
    </section>
<?php  

$this->load->view('footer', $this->data);

/* End of file main-jadwal.php */
/* Location: ./application/modules/mobile/views/jadwal/main-jadwal.php */