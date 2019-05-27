// JavaScript Document

$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#senha_compra-SaveForm', function() {
	  
	   $.post("../assets/php/inserts/senha_compra.php", $(this).serialize())
        .done(function(data){
        	var confirma = data;
        	if (confirma == 'sucesso') {
				swal({
			      title: '',
			      text: 'Operação realizada com sucesso.',
			      type: 'success'
			    }).then(function() {
			        window.location.href = "http://www.disabores.com.br";
			    })
				
        	}else{
				operacaoNaoRealizada.showNotification('top','right');
        	}
        	$('#orcamento-SaveForm')[0].reset();
		 });   
	     return false;
    }); 
	/* Data Insert Ends Here */
	});