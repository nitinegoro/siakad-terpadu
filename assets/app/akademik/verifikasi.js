
jQuery(function($) {

	// Delete Multiple Payments
	$('.jadikan-khs').click( function() {
		$.post( base_url + "/verifikasi_krs/cekkhs", $( "#form-krs" ).serialize(), function( data ) 
		{
			if(data.status === 'OK')
			{
				$('#btn-set-khs').html('<button type="submit" name="action" value="set_khs" class="btn btn-outline pull-right">Iya</button>');
				$('#jadikan-khs').addClass('modal-info');
				$('span#message-krs').html(data.message);
				$('#jadikan-khs').modal('show');
			} else {
				$('#btn-set-khs').html('<button type="submit" name="action" value="update_khs" class="btn btn-outline pull-right">Iya</button>');
				$('#jadikan-khs').addClass('modal-warning');
				$('span#message-krs').html(data.message);
				$('#jadikan-khs').modal('show');
			}
		});
	});
});