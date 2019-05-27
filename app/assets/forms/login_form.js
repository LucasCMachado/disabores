// JavaScript Document

$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#login-SaveForm', function() {
	  
	   $.post("../assets/php/inserts/login.php", $(this).serialize())
        .done(function(data){
        	var status = data;
        	console.log(data);
        	if (status == "login_incorreto") {
        		loginIncorreto.showNotification('top','center');
        		$('#login-SaveForm')[0].reset();
        	}else{
        		window.location.href="inicio";
        	}
		 });   
	     return false;
    }); 
	/* Data Insert Ends Here */
	});