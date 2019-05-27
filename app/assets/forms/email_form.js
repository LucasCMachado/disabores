$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#email-SaveForm', function() {
	  
	   $.post("../assets/php/edit/enviar_email.php", $(this).serialize())
        .done(function(data){
        	var confirma = data;
        	if (data=='sucesso') {
        		swal({
				  title: 'Sucesso',
				  text: 'E-mail enviado com sucesso.',
				  type: 'success'
				}).then(function() {
				    location.reload();
				})
        	}
		 });   
	     return false;
    }); 
	/* Data Insert Ends Here */
});