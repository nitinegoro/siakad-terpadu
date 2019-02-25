<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('header', $this->data);
?>
    <section ng-controller="lihatkhsCtrl">
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
                    <form name="lihat-khs-form">
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
                            <button type="button"  ng-click="getkhsdata();" class="waves-effect btn indigo darken-2 white-text">Lihat Hasil Studi</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>
        <section class="white" ng-show="datakhs">
            <div class="row">
                <div class="col s12" style="margin-top: 40px; ">
                    <div class="col s6 center">
                        <span class="bigger-1">IPK <strong>{{khs.ipk}}</strong></span>
                    </div>
                    <div class="xol s6 center">
                       Total SKS <strong class="bigger-1">{{khs.sks}}</strong>
                    </div>
                </div>
                <div class="col s12" style="margin-top: 20px;">
                    <span class="left" style="padding-left:30px;">Mata Kuliah</span>
                    <span class="right" style="padding-right:30px;">Grade Nilai</span>
                </div>
            </div>
            <ul class="collapsible" data-collapsible="accordion">
                <li ng-repeat="item in khs.nilai  | orderBy : 'course_name'">
                    <div class="collapsible-header">
                        <span class="upper">{{item.course_name}}</span> <br>
                        <small>{{item.course_code}} - {{item.sks}} SKS</small>
                        <span class="right">
                            <span style="font-weight: normal;">{{item.point}} </span>  {{item.grade}}
                        </span>
                    </div>
                    <table class="collapsible-body white">
                        <thead>
                            <tr>
                                <th>Absensi</th>
                                <th>Tugas</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>NA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{item.absent}}</td>
                                <td>{{item.task}}</td>
                                <td>{{item.midterms}}</td>
                                <td>{{item.final}}</td>
                                <td>{{item.point}}</td>
                            </tr>
                        </tbody>
                    </table>
                </li>
            </ul>
        </section>
    </section>
<?php  

$this->load->view('footer', $this->data);

/* End of file main-jadwal.php */
/* Location: ./application/modules/mobile/views/jadwal/main-jadwal.php */