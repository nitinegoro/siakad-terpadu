
jQuery(function($) {

	$('.get-delete-schedule').click( function() 
	{
		$('#modal-delete-schedule').modal('show');
		$('a#btn-delete').attr('href', base_url + '/schedule/delete/' + $(this).data('id') + $(this).data('query'));
	});

    $('.get-delete-schedule-multiple').click(function() {
        if( $('input[type=checkbox]').is(':checked') != '' ) 
        {
            $('#modal-delete-schedule-multiple').modal('show');
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

	$(".select2").select2();

	$(".select2-copy").select2();

	$(".select2-copy1").select2();

});