$(document).ready(function(){


    $('.get-delete-mhs').click( function() {
        $('#modal-delete-mhs').modal('show');
        $('a#btn-delete').attr('href', base_url + '/student/delete/' + $(this).data('id'));
    });


    $('.get-delete-mhs-multiple').click(function() {
        if( $('input[type=checkbox]').is(':checked') != '' ) 
        {
            $('#modal-delete-mhs-multiple').modal('show');
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

    $('div.progress').addClass('progress-xxs');

	$('#datepicker').pickadate({
		  selectMonths: true,
		  selectYears: true,
		  hiddenName: true
	});

    // Uploads IMPORT data Buku 
    $('#form-import-mahasiswa').formValidation({
        excluded: [':disabled'],
        fields: {
            file_excel: { 
                validators: { 
                   notEmpty: {  message: 'Harap isi File.' },
                   file: { extension: 'xlsx', maxSize: 97152 }
               }  
            }
        }
    })
    .on('success.form.fv', function(e) {

        e.preventDefault();

        var notify = $.notify('<strong>Mengunggah</strong> jangan tinggalkan halaman ini...', {
            type: 'success',
            allow_dismiss: false,
            showProgressbar: true
        });

        setTimeout(function() {
            notify.update({'message': '<strong>Membaca</strong> file excel ....', 'progress': 25});
        }, 40000);

        setTimeout(function() {
             notify.update({'type':'info','message': '<strong>Mengimport</strong> data mahasiswa.', 'progress': 45});
        }, 60000);

        var $form     = $(e.target);

        $.ajaxFileUpload({
            url : base_url + '/student/set_import', 
            secureuri : false,
            fileElementId :'file-excel',
            dataType : 'json',
            success : function (res)
            {   
                if(res.status === 'OK') 
                {
                    $.notify({
                        icon: 'fa fa-check',
                        message: res.message
                    },{
                        type: 'success',
                        allow_dismiss: false,
                        delay:2000,
                            placement: {
                        from: "top",
                            align: "center"
                        },
                    }); 
                } else {
                    $.notify({
                        icon: 'fa fa-warning',
                        message: res.message
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
                
               $form.formValidation('disableSubmitButtons', false).formValidation('resetForm', true); 
            },
            error: function(res) 
            {

            }
        });
        return false;
    });


    $('#datepicker')
        .pickadate('picker')
        .on('render', function() {
            $('#form-add-mahasiswa').formValidation('revalidateField', 'birts');
    });

    $('#form-add-mahasiswa').formValidation({
        framework: 'bootstrap',
        locale: 'id_ID',
        fields: { 
            birts: {
                validators: {
                    notEmpty: {
                        message: 'The date of birth is required'
                    }
                }
            }
        }
    });



});