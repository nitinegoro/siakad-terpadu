jQuery(document).ready(function($)
{
    jQuery('time.timeago').timeago();
    
    $(".btn-print").printPage();
});

$(function () {

    $('table').tableCheckbox({
        selectedRowClass: 'info',
        checkboxSelector: 'td:first-of-type input[type="checkbox"],th:first-of-type input[type="checkbox"]',
        isChecked: function($checkbox) {
            return $checkbox.is(':checked');
        }
    });

    $('.table-radio').tableCheckbox({
        selectedRowClass: '',
        checkboxSelector: 'td:first-of-type input[type="radio"]',
        isChecked: function($radio) {
            return $radio.is(':checked');
        }
    });
    
	 $('[data-toggle="tooltip"]').tooltip(); 
});


// request permission on page load
document.addEventListener('DOMContentLoaded', function () {
    $.get( base_url + '/main/get_notif', function( data ) {
        if (Notification.permission !== "granted")
            Notification.requestPermission();
        else {
            if(data.status === true)
            {
                var notification = new Notification('Sistem Informasi Akademik', {
                    icon: base_path + '/img/logo-push.png',
                    body: data.messages,
                });
            }
        }

    });

});

