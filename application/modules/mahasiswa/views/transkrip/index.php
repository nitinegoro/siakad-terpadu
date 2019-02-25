<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
			    <div class="col-xs-12 col-md-10" style="margin-bottom: 10px; margin-top: 20px;">
					<a href="<?php echo site_url("mahasiswa/point/get_print") ?>" target="_blank" class="btn btn-default btn-flat pull-right btn-print"><i class="fa fa-print"></i> Cetak</a>
			    </div>
					<table class="table table-hover table-bordered table-responsive col-xs-12 mini-font table-black table-bordered-black">
						<thead class="bg-silver">
							<tr>
								<th rowspan="2" class="text-center" width="40">No</th>
								<th rowspan="2" class="text-center" width="150">Kode MK</th>
								<th rowspan="2" class="text-center"> Mata Kuliah</th>
								<th rowspan="2" class="text-center">SKS</th>
								<th colspan="4" class="text-center hidden-xs">Nilai</th>
								<th rowspan="2" class="text-center hidden-xs"><span class="hidden-xs">Nilai Akhir</span><span class="hidden-md hidden-lg">NA</span></th>
								<th rowspan="2" class="text-center"> Grade </th>
								<th rowspan="2" class="text-center"> Bobot </th>
							</tr>
							<tr>
								<th class="text-center hidden-xs">Kehadiran</th>
								<th class="text-center hidden-xs">Tugas</th>
								<th class="text-center hidden-xs">MID</th>
								<th class="text-center hidden-xs">UAS</th>
							</tr>
						</thead>
						<tbody>
					<?php  
					/**
					 * Daftar Nilai (MK yang telah ditempuh Mahasiswa)
					 *
					 * @param Integer (student_id)
					 **/
					$sks = 0;
					$bobot = 0;
					$ipk = 0;
					foreach($get as $key => $value) :
					?>
							<tr>
								<td class="text-center"><?php echo ++$key; ?>.</td>
								<td class="text-center"><?php echo $value->course_code; ?></td>
								<td><?php echo $value->course_name; ?></td>
								<td class="text-center"><?php echo $value->sks; ?></td>
								<td class="text-center hidden-xs"><?php echo $value->absent; ?></td>
								<td class="text-center hidden-xs"><?php echo $value->task; ?></td>
								<td class="text-center hidden-xs"><?php echo $value->midterms; ?></td>
								<td class="text-center hidden-xs"><?php echo $value->final; ?></td>
								<td class="text-center hidden-xs"><?php echo $value->point; ?></td>
								<td class="text-center"><?php echo $value->grade; ?></td>
								<td class="text-center"><?php echo $value->quality; ?></td>
							</tr>
					<?php  
					$sks += $value->sks;
					$bobot += $value->quality;
					// End Loop daftar nilai

					$ipk = ($bobot / $sks);
					endforeach;
					?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3"><span class="pull-right"><small>Jumlah SKS yang sudah ditempuh :</small></span></th>
								<th><?php echo $sks; ?></th>
								<th colspan="<?php echo ($this->agent->is_mobile()) ? 1 : 6; ?>"><span class="pull-right">Jumlah Bobot :</span></th>
								<th><?php echo $bobot ?></th>
							</tr>
							<tr>
								<th colspan="3"><span class="pull-right"><small>Jumlah SKS yang harus ditempuh :</small></span></th>
								<th>153</th>
								<th colspan="<?php echo ($this->agent->is_mobile()) ? 1 : 6; ?>"><span class="pull-right">Index Prestasi (IP) :</span></th>
								<th><span style="font-size: 13px;"><?php echo str_replace('.', ',', substr($ipk, 0, 5)); ?></span></th>
							</tr>
							<tr>
								<th colspan="3"><span class="pull-right"><small>Jumlah SKS yang tersisa :</small></span></th>
								<th colspan="8"><?php echo (153-$sks); ?></th>
							</tr>
						</tfoot>
					</table>
			</div>
		</div>
	</div>
</div>
<?php
/* End of file index.php */
/* Location: ./application/modules/Mahasiswa/views/transkrip/index.php */
?>