
jQuery(function($){


	$('.get_schedule').click( function() 
	{
		var course = $(this).data('id');

		var query = $(this).data('query');

	    $.get( base_url + '/jadwal/getschedule/' + course + '/' + query, function( data ) {
	        if (data.status === true)
	        {
	        	$('div#modal-jadwal').modal('show');

				var code = '';

				code += '<input type="hidden" name="course" value="' + data.results[0].course_id + '" />';

				$.each(data.results, function(key, item) 
				{
					code += '<tr><td>\n';
					code += '<div class="radio radio-inline radio-primary">\n';
					code += '<input id="radio1" type="radio" name="schedule" value="'+ item.lecturer_schedule_id +'" required> <label for="radio1"></label>\n';
					code += '</div></td>\n';
					code += '<td>'+ item.day.toUpperCase() +', '+ item.session_start +' - ' + item.session_end + '</td>\n';
					code += '<td class="text-center">'+ item.class_name +'</td>\n';
					code += '<td class="text-center">' + item.lecturer_code + '</td>\n';
					code += '<td>' + item.name + '</td>\n';
					code += '</tr>';
				});

				$('tbody#data-schedule').html(code);

				$('form#form-pilih-jadwal').attr('action', base_url + '/jadwal/save/' + course + '/' + query);
	        } else {
				$.notify({
					icon: 'fa fa-warning',
					message: "Maaf jadwal tidak tersedia atau belum dibuat."
				},{
					type: 'warning',
					allow_dismiss: true,
					delay:3000,
					placement: {
						from: "top",
						align: "center"
					},
				});
	        }
	    });
	});

	$('.delete_schedule').click( function() 
	{
		$('div#modal-delete-jadwal').modal('show');
		$('a#btn-delete').attr('href', base_url + '/jadwal/reset/' + $(this).data('id') + $(this).data('query'));
	});

});