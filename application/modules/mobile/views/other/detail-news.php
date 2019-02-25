<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('header', $this->data);
?>
    <header>
        <div class="indigo darken-3 navbar-fixed">
            <nav>
                <div class="nav-wrapper indigo darken-4" style="margin-bottom: 0px;">
                    <a href="<?php echo $this->input->get('from_url') ?>"><i class="fa fa-angle-double-left"></i></a>
                    <a href="" class="heading-text"><?php echo $title; ?></a>
                    <a href="#logoff" class="right"><i class="fa fa-sign-out"></i></a>
                </div>
            </nav>
        </div>
    </header>
    <section ng-controller="getnewsCtrl">
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
        <div class="row" ng-show="wrapper" style="margin-top: -3px;">
            <div class="card">
                <div class="card-image">
                    <img class="materialboxed" src="https://lorempixel.com/300/150/business/" data-caption="Lorem ipsum dolor sit amet">
                    <span class="card-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                </div>
                <div class="card-content">
                    <p><small class="grey-text darken-4">Sabtu, 23 Juli 2017 - 13:00 PM</small></p>
                    <p>I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro, quaerat accusamus repellat, vel cumque tempore nam! Eligendi, voluptatem sed officia.</p>
                        <p>Obcaecati vero, harum perspiciatis facilis suscipit, dolore esse at et, facere totam sunt laudantium eum! Magni ullam, amet sunt voluptates.</p>
                        <p>Quae non, necessitatibus quod explicabo eos quidem autem unde libero dolore ab voluptates minima vel iste, facilis a, quo maiores.</p>    
                </div>
            </div>          
        </div>
        <div class="row" style="margin-top: -15px;">
            <div class="col s12">
                <h5>Baca Juga</h5>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="card-image">
                        <img src="https://lorempixel.com/300/150/business/">
                    </div>
                    <div class="card-more">
                        <a href="#">
                            <small class="grey-text darken-4">Sabtu, 23 Juli 2017 - 13:00 PM</small>
                            <span class="black-text darken-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col s6">
                <div class="card">
                    <div class="card-image">
                        <img src="https://lorempixel.com/300/150/business/">
                    </div>
                    <div class="card-more">
                        <a href="#">
                            <small class="grey-text darken-4">Sabtu, 23 Juli 2017 - 13:00 PM</small>
                            <span class="black-text darken-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
<?php  

$this->load->view('footer', $this->data);

/* End of file detail-news.php */
/* Location: ./application/modules/mobile/views/other/detail-news.php */

