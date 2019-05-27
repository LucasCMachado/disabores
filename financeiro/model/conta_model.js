$('.editar').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	//Insere os valores no modal
	var item= $(this);

	var id=item.data('id');
	var nome=item.data('nome');
	var cnpj=item.data('cnpj');
	var telefone=item.data('telefone');

	$('#editaId').val(id);
	$('#editaNome').val(nome);
	$('#editaCnpj').val(cnpj);
	$('#editaTelefone').val(telefone);
});

$('.pagar').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	//Insere os valores no modal
	var item= $(this);

	var id=item.data('id');
	var nome=item.data('nome');

	$('#pagaId').val(id);
	$('#pagaConta').html(nome);
});

$('.receber').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	//Insere os valores no modal
	var item= $(this);

	var id=item.data('id');
	var nome=item.data('nome');

	$('#recebeId').val(id);
	$('#recebeConta').html(nome);
});

$('.deletar').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	//Insere os valores no modal
	var item= $(this);

	var id=item.data('id');
	var nome=item.data('nome');

	$('#deletaId').val(id);
	$('#deletaConta').html(nome);
});

/* Insert do conta Starts Here */
$(document).on('submit', '#conta-EnviaForm', function() {
	//Envia os dados para cadastro
   $.post("../controller/conta_controller.php", $(this).serialize())
    .done(function(data){
    	if (data=='sucesso') {
			swal({   
				title: 'Sucesso',
				text: "conta cadastrado com sucesso!",
				type: 'success',   
				showCancelButton: false,   
				confirmButtonText: "Atualizar",   
				closeOnConfirm: true 
	        }, function(){   
	            window.location.reload();
	        });
    	}else{
    		swal(
			  'Oops...',
			  ''+data+'',
			  'error'
			)
    	}
    	
	 });   
     return false;
}); 
/* Insert do conta Ends Here */

/* Insert do conta Starts Here */
$(document).on('submit', '#conta-EditarForm', function() {
	//Envia os dados para cadastro
   $.post("../controller/conta_controller.php", $(this).serialize())
    .done(function(data){
    	if (data=='sucesso') {
			swal({   
				title: 'Sucesso',
				text: "conta editado com sucesso!",
				type: 'success',   
				showCancelButton: false,   
				confirmButtonText: "Atualizar",   
				closeOnConfirm: true 
	        }, function(){   
	            window.location.reload();
	        });
    	}else{
    		swal(
			  'Oops...',
			  ''+data+'',
			  'error'
			)
    	}
    	
	 });   
     return false;
}); 
/* Insert do conta Ends Here */

/* Desativa do conta Starts Here */
$(document).on('submit', '#conta-pagaForm', function() {
	//Envia os dados para cadastro
   $.post("../controller/conta_controller.php", $(this).serialize())
    .done(function(data){
    	if (data=='sucesso') {
			swal({   
				title: 'Sucesso',
				text: "Pagamento realizado com sucesso!",
				type: 'success',   
				showCancelButton: false,   
				confirmButtonText: "Atualizar",   
				closeOnConfirm: true 
	        }, function(){   
	            window.location.reload();
	        });
    	}else{
    		swal(
			  'Oops...',
			  ''+data+'',
			  'error'
			)
    	}
    	
	 });   
     return false;
}); 
/* Desativa do conta Ends Here */

/* Desativa do conta Starts Here */
$(document).on('submit', '#conta-recebeForm', function() {
	//Envia os dados para cadastro
   $.post("../controller/conta_controller.php", $(this).serialize())
    .done(function(data){
    	if (data=='sucesso') {
			swal({   
				title: 'Sucesso',
				text: "Pagamento recebido com sucesso!",
				type: 'success',   
				showCancelButton: false,   
				confirmButtonText: "Atualizar",   
				closeOnConfirm: true 
	        }, function(){   
	            window.location.reload();
	        });
    	}else{
    		swal(
			  'Oops...',
			  ''+data+'',
			  'error'
			)
    	}
    	
	 });   
     return false;
}); 
/* Desativa do conta Ends Here */

/* Reativa do conta Starts Here */
$(document).on('submit', '#conta-deletaForm', function() {
	//Envia os dados para cadastro
   $.post("../controller/conta_controller.php", $(this).serialize())
    .done(function(data){
    	if (data=='sucesso') {
			swal({   
				title: 'Sucesso',
				text: "Conta excluída com sucesso!",
				type: 'success',   
				showCancelButton: false,   
				confirmButtonText: "Atualizar",   
				closeOnConfirm: true 
	        }, function(){   
	            window.location.reload();
	        });
    	}else{
    		swal(
			  'Oops...',
			  ''+data+'',
			  'error'
			)
    	}
    	
	 });   
     return false;
}); 
/* reativa do conta Ends Here */