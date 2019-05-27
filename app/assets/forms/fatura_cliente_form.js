// JavaScript Document

$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#cliente-SaveForm', function() {
	  
	   $.post("../assets/php/inserts/cadastrar_cliente.php", $(this).serialize())
        .done(function(data){
        	var confirma = data;
        	$(confirma).prependTo('#tabela');
        	$('#cliente-SaveForm')[0].reset();
		 });   
	     return false;
    }); 
	/* Data Insert Ends Here */
	});

	/* Data Insert Starts Here */
	$(document).on('submit', '#senha_cliente-SaveForm', function() {
	  
	   $.post("../assets/php/inserts/cadastrar_senha_cliente.php", $(this).serialize())
        .done(function(data){
        	if (data=='sucesso') {
        		sucessoCadastrousuario.showNotification('top','center');
        		$("input").prop('disabled', true);
        		$("button").prop('disabled', true);
        	}
		 });   
	     return false;
    }); 
	/* Data Insert Ends Here */
	
	/* Data Delete Starts Here */
	$(".delete-link").click(function()
	{
		var id = $(this).attr("id");
		var del_id = id;
		var nome = $(this).data("name");
		var parent = $(this).parent().parent("tr");
		if(confirm('Deseja deletar o cliente "'+nome+'"'))
		{
			$.post('../assets/php/delete/delete_cliente.php', {'del_id':del_id}, function(data)
			{
				parent.fadeOut('slow');
			});	
		}
		return false;
	});
	/* Data Delete Ends Here */
	
	/* Get Edit ID  */
	$(".edit-link").click(function()
	{
		var id = $(this).attr("id");
		var edit_id = id;
		var nome = $(this).data("name");
		var email = $(this).data("email");
		var pagamento = $(this).data("pagamento");

		var visible = $('#forms_clientes').css('display');

		if (visible == "none") {
			$('#forms_clientes').toggle( "slow" );
		}
		$('#edit_nome').attr({
				'value': nome,
				'placeholder': nome
			});
			$('#edit_email').attr({
				'value': email,
				'placeholder': email
			});
			$('#edit_id').attr({
				'value': edit_id,
				'placeholder': edit_id
			});
			$('#edit_forma_pagamento').attr({
				'value': pagamento,
				'placeholder': pagamento
			});
			if ('#') {}
			$('#cliente-UpdateForm').css({
				'display': 'block'
			});$('#cliente-SaveForm').css({
				'display': 'none'
			});
		
	});
	/* Get Edit ID  */
	
	/* Update Record  */
	$(document).on('submit', '#cliente-UpdateForm', function() {
	   $.post("../assets/php/edit/update_cliente.php", $(this).serialize())
        .done(function(data){
			window.location.href="cliente";
		 });   
	     return false;
    });
	/* Update Record  */