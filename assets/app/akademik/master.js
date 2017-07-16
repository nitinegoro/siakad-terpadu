$(function () {

	$('.get-delete-mk').click( function() {
		$('#modal-delete-mk').modal('show');
		$('a#btn-delete').attr('href', base_url + '/course/delete/' + $(this).data('id'));
	});

    $('.get-delete-mk-multiple').click(function() {
        if( $('input[type=checkbox]').is(':checked') != '' ) 
        {
            $('#modal-delete-mk-multiple').modal('show');
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