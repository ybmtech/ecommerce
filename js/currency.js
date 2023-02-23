
    $("#price-currency").on('change',function(){
         let currency=$(this).find('option:selected').val();
        $.ajax({
		url : "admin/currency-switch.php",
		data : "currency="+currency,
		type : 'GET',
		success : function(data) {
      var delay = 1000;
      setTimeout(function() {
     window.location.href = './'
         }, delay);
		}
	});
      });