<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('header', $this->data);
?>
    <header class="navbar-fixed">
        <div class="indigo darken-3">
            <nav>
                <div class="nav-wrapper indigo darken-4" style="margin-bottom: 0px;">
                    <a href="#" onclick="return history.back()"><i class="fa fa-angle-double-left"></i></a>
                    <a href="#" class="heading-text">Jadwal Kuliah</a>
                    <a href="#logoff" class="right"><i class="fa fa-sign-out"></i></a>
                </div>
            </nav>
        </div>
    </header>
    <section ng-controller="scheduleCtrl">
        <div class="center" style="margin-top: 50px;" ng-show="loading">
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

        <div class="white top-fixed" style="padding-bottom: 1px;" ng-show="datajadwal">
            <div class="container">
                <div class="row">
          			<table class="striped">
            			<tbody>
              				<tr ng-repeat="item in schedule | orderBy : '-day'">
                				<td>
    								<span class="upper bigger-2">{{item.course_name}}</span><br>
    								<span>{{item.course_code}} ({{item.sks}} SKS)</span><br>
    								<span>{{item.name}}</span>
    								<ul class="list-inline">
    									<li class="indigo darken-4">{{item.day | uppercase}}</li>
    									<li class="light-blue darken-3">{{item.session_start}} - {{item.session_end}}</li>
    									<li class="yellow darken-3">Ruang {{item.class_name}}</li>
    								</ul>
                				</td>
              				</tr>
            			</tbody>
          			</table>
                </div>
            </div>
        </div>
    </section>

<?php  

$this->load->view('footer', $this->data);

/* End of file main-jadwal.php */
/* Location: ./application/modules/mobile/views/jadwal/main-jadwal.php */