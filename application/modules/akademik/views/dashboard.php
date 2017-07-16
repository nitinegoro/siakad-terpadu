<div class="row">
	<div class="col-lg-3 col-xs-6">
	    <!-- small box -->
	    <div class="small-box bg-aqua">
	        <div class="inner">
	            <h3>
	            	<?php echo $this->db->get_where('students', array('status' => 'active'))->num_rows(); ?>
	            </h3>
	            <p>Mahasiswa Aktif</p>
	        </div>
	        <div class="icon">
	            <i class="ion ion-ios-people"></i>
	        </div>
	        <a href="<?php echo site_url('akademik/student?status=1') ?>" class="small-box-footer">Selengkapnya.. <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	    <!-- small box -->
	    <div class="small-box bg-yellow">
	        <div class="inner">
	            <h3>
	            	<?php echo $this->db->get_where('students', array('status' => 'deactive'))->num_rows(); ?>
	            </h3>
	            <p>Mahasiswa Non Aktif</p>
	        </div>
	        <div class="icon">
	            <i class="ion ion-ios-people"></i>
	        </div>
	        <a href="<?php echo site_url('akademik/student?status=0') ?>" class="small-box-footer">Selengkapnya.. <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	    <!-- small box -->
	    <div class="small-box bg-green">
	        <div class="inner">
	            <h3><?php echo $this->db->count_all('course'); ?></h3>
	            <p>Mata Kuliah</p>
	        </div>
	        <div class="icon">
	            <i class="ion ion-ios-bookmarks"></i>
	        </div>
	        <a href="<?php echo site_url('akademik/course') ?>" class="small-box-footer">Selengkapnya.. <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
	    <!-- small box -->
	    <div class="small-box bg-teal">
	        <div class="inner">
	            <h3><?php echo $this->db->count_all('lecturer'); ?></h3>
	            <p>Total Dosen</p>
	        </div>
	        <div class="icon">
	            <i class="ion ion-person-stalker"></i>
	        </div>
	        <a href="<?php echo site_url('akademik/lecturer') ?>" class="small-box-footer">Selengkapnya.. <i class="fa fa-arrow-circle-right"></i></a>
	    </div>
	</div>
	<!-- ./col -->
	<div class="col-md-8">
		<div class="box box-primary">
			<div class="box-body">
				<div id="chart_div" style="width: 100%;"></div>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-xs-6">
		<div class="callout bg-silver">
		    <h4 class="text-primary">Panduan Penggunaan SIAKAD</h4>
		    <ol style="font-size: 16px; font-style: italic;">
		    	<li>
		    		<a href="" class="link">Verifikasi Krs</a>
		    	</li>
		    	<li>
		    		<a href="" class="link">Pengentrian Nilai</a>
		    	</li>
		    	<li>
		    		<a href="" class="link">Kelola Data Mata Kuliah</a>
		    	</li>
		    	<li>
		    		<a href="" class="link">Kelola Data Mahasiswa</a>
		    	</li>
		    	<li>
		    		<a href="" class="link">Ganti Password</a>
		    	</li>
		    </ol>
		</div>
	</div>
	<div class="col-lg-4 col-xs-6">
		<div class="callout bg-silver">
		    <h4 class="text-primary"> SIAKAD Helpdesk <i class="ion ion-help"></i></h4>
              <blockquote>
                <p>0856-9809-9898 / 0856-9897-9790</p>
                <small>Adi Suputra, M.Kom.</small>
              </blockquote>
		</div>
	</div>
</div>

<script>
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);
    
    function drawChart() 
    {
	    var data = google.visualization.arrayToDataTable(
	    <?php  
	        $output = array(
	        	array('Tahun Masuk', 'Reguler', 'Pindahan', 'Lulus'), 
	        );
	        
	        for($tahun = 2011; $tahun <= date('Y'); $tahun++)
	        	$output[] = array(
	        		"$tahun",
	        		$this->dashboard->studentsByYear(TRUE, $tahun), 
	        		$this->dashboard->studentsByYear(FALSE, $tahun),
	        		$this->dashboard->studentsGoals($tahun)
	        );
	        echo json_encode($output);
	    ?>
	    );
    
	    var options = {
	        chart: {
	          	title: 'Data Mahasiswa',
	          	subtitle: 'Reguler, Pindahan, dan Lulus : <?php echo "2011 - ".date('Y') ?>',
	        },
	        bars: 'vertical',
	        vAxis: {format: ''},
	        height: 330,
	        width: '100%',
	        colors: ['#80B5D3', '#F7BF65', '#5AC594']
	    };
    
      	var chart = new google.charts.Bar(document.getElementById('chart_div'));
    
      	chart.draw(data, google.charts.Bar.convertOptions(options));
    }
    
</script>	