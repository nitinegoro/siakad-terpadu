
$(function () {

    $('table').tableCheckbox({
        selectedRowClass: 'info',
        checkboxSelector: 'td:first-of-type input[type="checkbox"],th:first-of-type input[type="checkbox"]',
        isChecked: function($checkbox) {
            return $checkbox.is(':checked');
        }
    });

    $(".btn-print").printPage();
    
	 $('[data-toggle="tooltip"]').tooltip(); 
});


