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

$('.desativar').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	//Insere os valores no modal
	var item= $(this);

	var id=item.data('id');
	var nome=item.data('nome');

	$('#desativaId').val(id);
	$('#desativaNome').html(nome);
});

$('.reativar').on('click', function(event) {
	event.preventDefault();
	/* Act on the event */
	//Insere os valores no modal
	var item= $(this);

	var id=item.data('id');
	var nome=item.data('nome');

	$('#reativaId').val(id);
	$('#reativaNome').html(nome);
});

/* Insert do fornecedor Starts Here */
$(document).on('submit', '#fornecedor-EnviaForm', function() {
	//Envia os dados para cadastro
   $.post("../controller/fornecedor_controller.php", $(this).serialize())
    .done(function(data){
    	if (data=='sucesso') {
			swal({   
				title: 'Sucesso',
				text: "Fornecedor cadastrado com sucesso!",
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
/* Insert do fornecedor Ends Here */

/* Insert do fornecedor Starts Here */
$(document).on('submit', '#fornecedor-EditarForm', function() {
	//Envia os dados para cadastro
   $.post("../controller/fornecedor_controller.php", $(this).serialize())
    .done(function(data){
    	if (data=='sucesso') {
			swal({   
				title: 'Sucesso',
				text: "Fornecedor editado com sucesso!",
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
/* Insert do fornecedor Ends Here */

/* Desativa do fornecedor Starts Here */
$(document).on('submit', '#fornecedor-DesativaForm', function() {
	//Envia os dados para cadastro
   $.post("../controller/fornecedor_controller.php", $(this).serialize())
    .done(function(data){
    	if (data=='sucesso') {
			swal({   
				title: 'Sucesso',
				text: "Fornecedor desativado com sucesso!",
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
/* Desativa do fornecedor Ends Here */

/* Reativa do fornecedor Starts Here */
$(document).on('submit', '#fornecedor-ReativaForm', function() {
	//Envia os dados para cadastro
   $.post("../controller/fornecedor_controller.php", $(this).serialize())
    .done(function(data){
    	if (data=='sucesso') {
			swal({   
				title: 'Sucesso',
				text: "Fornecedor reativado com sucesso!",
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
/* reativa do fornecedor Ends Here */