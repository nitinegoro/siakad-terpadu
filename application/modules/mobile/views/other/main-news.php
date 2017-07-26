<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('header', $this->data);
?>
    <header>
        <div class="indigo darken-3 navbar-fixed">
            <nav>
                <div class="nav-wrapper indigo darken-4" style="margin-bottom: 0px;">
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
                    <a href="" class="heading-text"><?php echo $title; ?></a>
                    <a href="#logoff" class="right"><i class="fa fa-sign-out"></i></a>
                </div>
            </nav>
        </div>
    </header>
    <section ng-controller="newsCtrl">
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
        <div class="row" ng-show="wrapper" style="margin-top: 7px;">
<!--             <div class="col s12">
    <img src="https://lorempixel.com/390/90/business/6" alt="ads stie pertiba" width="390" height="100">
</div> -->
            <div class="col s12" ng-repeat="item in results">
                <div class="card horizontal">
                    <div class="card-image">
                        <img src="{{item.image}}" alt="{{item.title}}" width="90" height="90" imageonload="doThis()">
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <a href="<?php echo site_url("mobile/news/get/2?from_url=".current_url()) ?>" class="news-link black-text">{{item.title}}
                                <div class="box-time grey-text darken-4">{{item.date | date:'MM/dd/yyyy' }}</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12">

            </div>
        </div>
     
<?php  

$this->load->view('footer', $this->data);

/* End of file main-news.php */
/* Location: ./application/modules/mobile/views/other/main-news.php */

#363D7A