$(document).ready(function()
{
    'use strict';

    $('#cek-login').on('click', function(event) 
    {
    	event.preventDefault();

    	$.post(base_url + "/login/auth", {
    			usernpm : $('input[name="npm"]').val(), 
    			pass : $('input[name="pass"]').val()
   		}, function(data) 
    	{
    		console.log(data);
    		
    		if(data.status === "success")
    		{
    			window.location.href = base_url + "/main";
    		} else {
    			 Materialize.toast('Maaf NPM dan Password tidak valid!', 4000, 'rounded red');
    		}
    	});


    });
});

