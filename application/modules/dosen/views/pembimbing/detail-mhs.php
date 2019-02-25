<div class="col-md-8 col-md-offset-2 col-xs-12"><?php echo $this->session->flashdata('alert'); ?></div>
<div class="col-md-12">
	<div class="box pad box-primary">
		<div class="box-body with-border">
			<div class="col-md-2">
				<img src="<?php echo ($get->photo != '') ? base_url("assets/img/account/{$get->photo}") : base_url("assets/img/avatar.jpg"); ?>" alt="foto mahasiswa">
			</div>
			<div class="col-md-5">
				<table>
					<tr>
						<th>NPM </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->npm; ?></td>
					</tr>
					<tr>
						<th>Nama Lengkap </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->name; ?></td>
					</tr>
					<tr>
						<th>Tempat, Tanggal Lahir </th><th width="30" class="text-center">:</th>
						<td><?php echo ucfirst($get->place_of_birts); ?>, <?php echo tgl_indo($get->birts) ?></td>
					</tr>
					<tr>
						<th>Jenis Kelamin </th><th width="30" class="text-center">:</th>
						<td><?php echo ucfirst($get->gender); ?></td>
					</tr>
					<tr>
						<th>Agama </th><th width="30" class="text-center">:</th>
						<td><?php echo ucfirst($get->religion); ?></td>
					</tr>
					<tr>
						<th>Alamat Rumah </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->address; ?></td>
					</tr>
					<tr>
						<th>Nama Sekolah </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->school_name; ?></td>
					</tr>
					<tr>
						<th>Jurusan </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->school_study; ?></td>
					</tr>
					<tr>
						<th>Alamat Sekolah </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->school_address ?></td>
					</tr>
				</table>		
			</div>
			<div class="col-md-4">
				<table>
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
						<th>Tahun Masuk </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->register_year; ?></td>
					</tr>
					<tr>
						<th>Kelas </th><th width="30" class="text-center">:</th>
						<td><?php echo ucfirst($get->class) ?></td>
					</tr>
					<tr>
						<th>Status Mahasiswa </th><th width="30" class="text-center">:</th>
						<td><?php echo ($get->status) ? "AKTIF" : "TIDAK AKTIF"; ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="box-body with-border">
			<div class="box-header with-border" style="margin-bottom: 20px;">
					<h3 class="box-title">Data Orang Tua / Wali</h3>
			</div>
			<div class="col-md-2">
				<a href="<?php echo site_url('dosen/pembimbing') ?>" class="btn btn-app">
					<i class="fa fa-undo"></i> Kembali
				</a>
			</div>
			<div class="col-md-5">
				<table>
					<tr>
						<th>Nama Ayah </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->father_name; ?></td>
					</tr>
					<tr>
						<th>Nama Ibu </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->mother_name; ?></td>
					</tr>
					<tr>
						<th>Alamat Rumah </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->parent_address ?></td>
					</tr>
				</table>		
			</div>
			<div class="col-md-4">
				<table>
					<tr>
						<th>Nomor Telepon </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->phone_number; ?></td>
					</tr>
					<tr>
						<th>Pekerjaan Ayah </th><th width="30" class="text-center">:</th>
						<td><?php echo $get->father_jobs; ?></td>
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