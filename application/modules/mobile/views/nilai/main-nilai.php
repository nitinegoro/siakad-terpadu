<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('header', $this->data);
?>
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
    <section class="white" style="padding-bottom: 1px; margin-top: 20px">
        <div class="container">

        <div class="row">
            <div class="col s12 white" style="margin-top: 40px; ">
                <div class="col s6 center">
                    <span class="bigger-1">IPK <strong><?php echo str_replace('.', ',', substr($hasil['ipk'], 0, 5)); ?></strong></span>
                </div>
                <div class="xol s6 center">
                   Total SKS <strong class="bigger-1"><?php echo $hasil['sks'] ?></strong>
                </div>
            </div>
            <div class="col s12" style="margin-top: 20px;">
                <span class="left" style="padding-left:30px;">Mata Kuliah</span>
                <span class="right" style="padding-right:30px;">Grade Nilai</span>
            </div>
        </div>
        </div>
        <ul class="collapsible " data-collapsible="accordion">
        <?php  
        /**
         * Daftar Nilai (MK yang telah ditempuh Mahasiswa)
         *
         * @param Integer (student_id)
         **/
        $sks = 0;
        $bobot = 0;
        $ipk = 0;
        foreach($this->point->get() as $key => $value) :
        ?>
            <li>
                <div class="collapsible-header">
                    <?php echo ++$key ?>. <span class="upper"><?php echo $value->course_name; ?></span> <br>
                    <small><?php echo $value->course_code." - ".$value->sks." SKS"; ?></small>
                    <span class="right">
                        <span style="font-weight: normal;"><?php echo $value->point; ?></span> 
                        <?php echo $value->grade; ?>
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
                                <td><?php echo $value->absent; ?></td>
                                <td><?php echo $value->task; ?></td>
                                <td><?php echo $value->midterms; ?></td>
                                <td><?php echo $value->final; ?></td>
                                <td><?php echo $value->point; ?></td>
                            </tr>
                        </tbody>
                    </table>
            </li>
        <?php  
        $sks += $value->sks;
        $bobot += $value->quality;
        // End Loop daftar nilai

        $ipk = ($bobot / $sks);
        endforeach;
        ?>
        </ul>
    </section>


<?php  

$this->load->view('footer', $this->data);

/* End of file main-jadwal.php */
/* Location: ./application/modules/mobile/views/jadwal/main-jadwal.php */