$(document).ready(function() {

    // Uploads IMPORT data Buku 
    $('#form-import-nilai').formValidation({
        excluded: [':disabled'],
        fields: {
            file_excel: { 
                validators: { 
                   notEmpty: {  message: 'Harap isi File.' },
                   file: { extension: 'xlsx' }
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
            notify.update({'message': '<strong>Membaca</strong> file excel ....', 'progress': 35});
        }, 10000);

        setTimeout(function() {
             notify.update({'type':'info','message': '<strong>Mengimport</strong> data Nilai.', 'progress': 45});
        }, 70000);

        var $form     = $(e.target);

        $.ajaxFileUpload({
            url : base_url + '/entrypoint/save_import', 
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

 });