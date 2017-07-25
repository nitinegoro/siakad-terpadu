
	$('.get-delete-user').click( function() {
		$('#modal-delete-user').modal('show');
		$('a#btn-delete').attr('href', base_url + '/user/delete/' + $(this).data('id'));
	});

	// Delete Multiple User
	$('.get-delete-user-multiple').click( function() {
		if( $('input[type=checkbox]').is(':checked') != '' ) 
		{
			$('#modal-delete-user-multiple').modal('show');
		} else {
			$.notify({
				icon: 'fa fa-warning',
				message: "Tidak ada data yang dipilih."
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