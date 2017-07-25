<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$date = new DateTime($get->birts);
?>
<div class="row">
	<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
	<div class="col-md-12">
		<div class="box pad box-primary bigger-font">
			<div class="box-body with-border">
				<div class="col-md-4 pull-right">
					<a href="<?php echo site_url("akademik/student"); ?>" class="btn btn-app"><i class="fa fa-reply"></i> Kembali</a>
					<a href="<?php echo site_url("akademik/student/update/{$get->student_id}"); ?>" class="btn btn-app"><i class="fa fa-pencil"></i> Sunting</a>
					<a href="<?php echo site_url("akademik/student/getprint/{$get->student_id}"); ?>" class="btn btn-app btn-print"><i class="fa fa-print"></i> Cetak</a>
				</div>
				<div class="col-md-10 col-md-offset-2"> <h4>Identitas Mahasiswa</h4><hr> </div>
				<div class="col-md-2">
					<img src="<?php echo ($get->photo != '') ? base_url("assets/img/account/{$get->photo}") : base_url("assets/img/avatar.jpg"); ?>" alt="">
				</div>
				<div class="col-md-5">
					<table>
						<tr>
							<th>Nama Lengkap </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->name; ?></td>
						</tr>
						<tr>
							<th>Jenis Kelamin</th><th width="30" class="text-center">:</th>
							<td><?php echo ucfirst($get->gender); ?></td>
						</tr>
						<tr>
							<th>Tempat, Tanggal Lahir </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->place_of_birts.", ".$date->format('d M Y'); ?></td>
						</tr>
						<tr>
							<th>Agama </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->religion; ?></td>
						</tr>
						<tr>
							<th>Pekerjaan </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->jobs; ?></td>
						</tr>
						<tr>
							<th>Alamat </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->address; ?></td>
						</tr>
					</table>		
				</div>
				<div class="col-md-4">
					<table>
						<tr>
							<th>NPM </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->npm; ?></td>
						</tr>
						<tr>
							<th>Jurusan </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->study; ?></td>
						</tr>
						<tr>
							<th>Jenjang </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->ladder; ?></td>
						</tr>
						<tr>
							<th>Konsentrasi </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->concentration_name; ?></td>
						</tr>
						<tr>
							<th>Kelas </th><th width="30" class="text-center">:</th>
							<td><?php echo ucfirst($get->class) ?></td>
						</tr>
						<tr>
							<th>Tahun Masuk </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->register_year; ?></td>
						</tr>
					</table>
				</div>
				<div class="col-md-10 col-md-offset-2" style="margin-top: 20px;"> <h4>Data Asal Sekolah</h4><hr> </div>
				<div class="col-md-5 col-md-offset-2">
					<table>
						<tr>
							<th>Nama Sekolah </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->school_name; ?></td>
						</tr>
						<tr>
							<th>Jurusan <small>(yg ditempuh)</small></th><th width="30" class="text-center">:</th>
							<td><?php echo $get->school_study; ?></td>
						</tr>
						<tr>
							<th>Alamat Sekolah</th><th width="30" class="text-center">:</th>
							<td><?php echo $get->school_address; ?></td>
						</tr>
						<tr>
							<th>Tahun Lulus</th><th width="30" class="text-center">:</th>
							<td><?php echo $get->graduation_year; ?></td>
						</tr>
					</table>		
				</div>
				<div class="col-md-4">
					<table>
						<tr>
							<th>Nilai Kelulusan </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->grade_value; ?></td>
						</tr>
						<tr>
							<th>Nomor Ijazah </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->certificate_number; ?></td>
						</tr>
					</table>
				</div>
				<div class="col-md-10 col-md-offset-2" style="margin-top: 20px;"> <h4>Data Orang Tua</h4><hr> </div>
				<div class="col-md-5 col-md-offset-2">
					<table>
						<tr>
							<th>Nama Ayah </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->father_name; ?></td>
						</tr>
						<tr>
							<th>Pekerjaan Ayah</th><th width="30" class="text-center">:</th>
							<td><?php echo $get->father_jobs; ?></td>
						</tr>
						<tr>
							<th>Kisaran Pendapatan</th><th width="30" class="text-center">:</th>
							<td><?php echo $get->revenue; ?></td>
						</tr>
						<tr>
							<th>Nomor Telepon</th><th width="30" class="text-center">:</th>
							<td><?php echo $get->phone_number; ?></td>
						</tr>
						<tr>
							<th>Alamat</th><th width="30" class="text-center">:</th>
							<td><?php echo $get->parent_address; ?></td>
						</tr>
					</table>		
				</div>
				<div class="col-md-4">
					<table>
						<tr>
							<th>Nama Ibu </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->mother_name; ?></td>
						</tr>
						<tr>
							<th>Pekerjaan Ibu </th><th width="30" class="text-center">:</th>
							<td><?php echo $get->mother_jobs; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>
<?php
/* End of file detail-mahasiswa.php */
/* Location: ./application/modules/Akademik/views/student/detail-mahasiswa.php */	
?>