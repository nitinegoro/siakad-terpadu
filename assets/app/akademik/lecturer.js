$(function () {

	$('.get-delete-lecturer').click( function() {
		$('#modal-delete-lecturer').modal('show');
		$('a#btn-delete').attr('href', base_url + '/lecturer/delete/' + $(this).data('id'));
	});

    $('.get-delete-lecturer-multiple').click(function() {
        if( $('input[type=checkbox]').is(':checked') != '' ) 
        {
            $('#modal-delete-lecturer-multiple').modal('show');
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

});