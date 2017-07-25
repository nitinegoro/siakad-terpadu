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
    
	 $('[data-toggle="tooltip"]').tooltip(); 



});


