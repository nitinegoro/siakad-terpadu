$(document).ready(function(){

var $dateFrom = $('.js-date-from').pickadate({format:'dd-mm-yyyy'}),
    dateFromPicker = $dateFrom.pickadate('picker');

var $dateTo = $('.js-date-to').pickadate({format:'dd-mm-yyyy'}),
    dateToPicker = $dateTo.pickadate('picker');

dateFromPicker.on({
  open: function(e) {
    console.log('Open js-date-from');
    if ($dateFrom.val()) {
      console.log('User is making a change to js-date-from');
    }
  },
  close: function(e) {
    if ($dateFrom.val() && !$dateTo.val()) {
      console.log('Open js-date-to via js-date-from');
      dateToPicker.open();
    }
    else if (!$dateFrom.val()) {
      console.log('User left js-date-from empty. Not popping js-date-to');
    }
    console.log('Close js-date-from');
    // workaround for github issue #160
    $(document.activeElement).blur();
  }
});
dateToPicker.on({
  open: function(e) {
    console.log('Poppped js-date-to');
    if ($dateTo.val()) {
      console.log('User is making a change to js-date-to');
    }
  },
  close: function(e) {
    if (!$dateTo.val()) {
      console.log('User left js-date-to empty. Not popping js-date-from or js-date-to');
    }
    console.log('Close js-date-to');
    // workaround for github issue #160
    $(document.activeElement).blur();
  }
});


   

});