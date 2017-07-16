

$(function () {

	$('#get-mk').change( function() {

		var code = '';

		if($('#thn-ajaran').val() === '')
		{
			$.notify({
				icon: 'fa fa-warning',
				title: 'Peringatan!',
				message: "Maaf silahkan pilih tahun ajaran."
			},{
				type: 'warning',
				allow_dismiss: false,
				delay:2000,
				placement: {
					from: "top",
					align: "center"
				},
			});
		} else {
			$.post( base_url + "/krs/getmk",$( "#form-susun-krs" ).serialize(), function( data ) 
			{
				if(data.status === 'OK')
				{
					var code = '';
					$.each(data.results, function(key, item) 
					{
						code += '<tr id="#mk-'+item.course_id+'" class="">\n';
						code += '<td>\n';
						code += '<div class="checkbox checkbox-inline">\n';
						code += '<input  type="checkbox" name="mk[]" value="'+item.course_id+'" onclick="set_krs('+item.course_id+')">\n';
						code += '<label for="checkbox1"></label></div>\n';
						code += '</td>\n';
						code += '<td>'+ item.course_code +'</td>\n';
						code += '<td>'+item.course_name+'</td>\n';
						code += '<td>'+item.sks+'</td>\n';
						code += '</tr>';	
					});

					$('#mk-repeat').html(code);
				} else {
					$('#mk-repeat').html('');
					if(data.message)
					{
						$.notify({
							icon: 'fa fa-warning',
							message: data.message
						},{
							type: 'warning',
							allow_dismiss: false,
							delay:2000,
							placement: {
								from: "top",
								align: "center"
							},
						});	
					}
				}
			});
		}
	});


	$('#btn-krs').click( function() {
		$('#modal-valid-krs').modal('show');
	});


	/*
	* UPDATE MK
	*/
	$('.ganti-mk').click( function() {
		var plain_id = $(this).data('id');

		$('#mk-diganti').val($(this).data('course-id'));

		$('#krs-title').html('&nbsp;"' + $(this).data('course') + '"');

		$.get( base_url + "/krs/getmkupdate", function( data ) 
		{
			if(data.status === 'OK')
			{
				$('#modal-ganti-mk').modal('show');

				var code = '';
				$.each(data.results, function(key, item) 
				{
					code += '<tr>\n';
					code += '<td>\n<div class="radio radio-inline radio-info">';
					code += '<input name="mk" type="radio" value="'+item.course_id+'" required>\n';
					code += '<label></label></div></td>\n';
					code += '<td>'+item.course_code+'</td>\n';
					code += '<td>'+item.course_name+'</td>\n';
					code += '<td>'+item.sks+'</td>\n';
					code += '</tr>';
				});

				$('#repeat-update-mk').html(code);

				$('#form-update-krs').attr('action', base_url + '/krs/update/' + plain_id);
			} else {
				$.notify({
					icon: 'fa fa-warning',
					message: data.message
				},{
					type: 'warning',
					allow_dismiss: false,
					delay:2000,
					placement: {
						from: "top",
						align: "center"
					},
				});	
			}
		});
	});

	/*
	* ADD MK
	*/
	$('.add-mk').click( function() {
		$.get( base_url + "/krs/getadd", function( data ) 
		{
			if(data.status === 'OK')
			{
				$('#modal-add-mk').modal('show');

					var code = '';
					$.each(data.results, function(key, item) 
					{
						code += '<tr id="#mk-'+item.course_id+'" class="">\n';
						code += '<td>\n';
						code += '<div class="checkbox checkbox-inline">\n';
						code += '<input  type="checkbox" name="mk[]" value="'+item.course_id+'" onclick="cek_sksnya('+item.course_id+')">\n';
						code += '<label for="checkbox1"></label></div>\n';
						code += '</td>\n';
						code += '<td>'+ item.course_code +'</td>\n';
						code += '<td>'+item.course_name+'</td>\n';
						code += '<td>'+item.sks+'</td>\n';
						code += '</tr>';	
					});

					$('#repeat-add-mk').html(code);

			} else {
				$.notify({
					icon: 'fa fa-warning',
					message: data.message
				},{
					type: 'warning',
					allow_dismiss: false,
					delay:2000,
					placement: {
						from: "top",
						align: "center"
					},
				});	
			}
		});
	});

});

function set_krs(param)
{
	$.post( base_url + "/krs/set", $( "#form-susun-krs" ).serialize()).done(function( data ) 
	{
    	if(data.status==='OK') 
    	{
    		$('#total-mk').html(data.total_mk);
    		$('#total-sks').html(data.total_sks);

    		if(data.total_sks > data.max_sks)
    		{
				$.notify({
					icon: 'fa fa-warning',
					title: 'Peringatan!',
					message: "Maaf anda hanya diperkenankan mengambil " + data.max_sks + " SKS."
				},{
					type: 'danger',
					allow_dismiss: false,
					delay:2000,
					placement: {
						from: "top",
						align: "center"
					},
				});

    		}
    	}
  	});

}


function cek_sksnya(param) 
{
	$.post( base_url + "/krs/ceksks", $( "#form-add-mk" ).serialize()).done(function( data ) 
	{
    	if(data.status === 'ERROR') 
    	{
			$.notify({
				icon: 'fa fa-warning',
				title: 'Peringatan!',
				message: data.message
			},{
				type: 'danger',
				allow_dismiss: false,
				delay:2000,
				placement: {
					from: "top",
					align: "center"
				},
				z_index:3000
			});
    	}
  	});
}