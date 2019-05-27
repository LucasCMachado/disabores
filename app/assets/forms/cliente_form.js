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


	/* Data Insert Starts Here */
	$(document).on('submit', '#senha_cliente-SaveForm', function() {
	  
	   $.post("../assets/php/inserts/cadastrar_senha_cliente.php", $(this).serialize())
        .done(function(data){
        	if (data=='sucesso') {
        		sucessoCadastrousuario.showNotification('top','center');

			 // use setTimeout() to execute
			 setTimeout(showpanel, 1000)
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

	/* Data Delete Starts Here */
	$(".pagar").click(function()
	{
		var id = $(this).attr("id");
		var pag_id = id;
		var nome = $(this).data("name");
		var parent = $(this).parent().parent("tr");
		if(confirm('Deseja realizar o pagamento do cliente "'+nome+'"'))
		{
			$.post('../assets/php/edit/pagar_fatura.php', {'pag_id':pag_id}, function(data)
			{
				operacaoRealizada.showNotification('top','right');
				$('#'+id+'').replaceWith('<button type="button" class="btn btn-success btn-fill disabled">Pago</button>');
			});	
		} 
		return false;
	});
	/* Data Delete Ends Here */

	/* Data Delete Starts Here */
	$(".desbloquear").click(function()
	{
		var id = $(this).attr("id");
		var id = id;
		var nome = $(this).data("name");
		if(confirm('Deseja desbloquar o do cliente "'+nome+'"'))
		{
			$.post('../assets/php/edit/desbloquear.php', {'id':id}, function(data)
			{
				operacaoRealizada.showNotification('top','right');
			});	
		} 
		return false;
	});
	/* Data Delete Ends Here */


	$(document).on('click', '.listaPag-parcial', function(event) {

		var id = $(this).attr("id");
		var dataFatura = $(this).data("atual");
		var options='';

		$.post('../assets/php/edit/faturasParciais.php',{'cliente_id': id, 'data_fatura': dataFatura}, function(j){
              
                       
       $.post('../assets/php/edit/faturaAtual.php', {'cliente_id':id}, function(data)
			{

				var valorAtual = data;			

	            swal.queue([{
				title: 'Pagamento Parcial',
				confirmButtonText: 'Salvar',
				cancelButtonText: 'Cancelar',
				showCancelButton: true,
				html:
				    'Valor total da fatura aberta de R$ '+valorAtual+'' +
				    '<p>Outros pagamentos parciais: '+j+'</p>' +
				    '<p>Ps.: O valor informado será debitado da fatura gerada no fim do mês.</p>' +
				    '<form method="post" id="faturasParcialPagamento" action="#" role="form">' +
				    '<input type="text" name="id_cl" id="id_cl" value="'+id+'" hidden>'+
				    '<input type="text" name="valor_pago" id="valor_pago" class="form-control money" placeholder="Insira o valor do almoço">'+
				    '</form>',
				showLoaderOnConfirm: true,
				  
				preConfirm: function () {
				    return new Promise(function (resolve) {
				    $.post("../assets/php/inserts/pagamento_parcial.php", $('#faturasParcialPagamento').serialize())
			        .done(function(data){
			        	if (data=='sucesso') {
			        		swal.insertQueueStep("Pagamento realizado com sucesso!");
			        		resolve()
			        	}else{
			        		swal.insertQueueStep(data);
			        		resolve()
			        	}
					 });
				    })
				  }
				}]);
    		});
        });

	});

	$(document).on('click', '.pagar-link', function(event) {

			var id = $(this).attr("id");

			var valorAtual = $(this).data('valor');

			swal.queue([{
			title: 'Pagamento Parcial',
			confirmButtonText: 'Salvar',
			cancelButtonText: 'Cancelar',
			showCancelButton: true,
			html:
			    'Valor total da última fatura aberta de R$ '+valorAtual+'' +
			    '<p>Ps.: O valor informado será debitado da fatura gerada no fim do mês.</p>' +
			    '<form method="post" id="faturasParcialPagamento" action="#" role="form">' +
			    '<input type="text" name="id_cl" id="id_cl" value="'+id+'" hidden>'+
			    '<input type="text" name="valor_pago" id="valor_pago" class="form-control money" placeholder="Insira o valor do almoço">'+
			    '</form>',
			showLoaderOnConfirm: true,
			  
			preConfirm: function () {
			    return new Promise(function (resolve) {
			    $.post("../assets/php/inserts/pagamento_parcial.php", $('#faturasParcialPagamento').serialize())
		        .done(function(data){
		        	if (data=='sucesso') {
		        		swal.insertQueueStep("Pagamento realizado com sucesso!");
		        		resolve()
		        	}else{
		        		swal.insertQueueStep(data);
		        		resolve()
		        	}
				 });
			    })
			  }
			}]);			  
			return false;
	});


	$(document).on('click', '.listaPag-total', function(event) {
		$('#faturasTotaisPagamento').html('');
		var id_cliente=$(this).attr("id");
		$.getJSON('../assets/php/edit/faturasTotais.php?search=',{cliente_id:id_cliente,  ajax: 'true'}, function(j){
            var options='';   
            for (var i = 0; i < j.length; i++) {
                options += '<div data-valor="'+j[i].valor_fatura+'" data-multa="'+j[i].multa+'" data-juros="'+j[i].juros+'" data-valor_total="'+j[i].valor_total+'" data-data="'+j[i].data_fatura+'" id="'+id_cliente+'" data-fatura="'+j[i].id_fatura+'" class="alert alert-primary completa-link"><span>Vencimento em <b>'+j[i].data_fatura+'</b> no valor de <b>R$ '+j[i].valor_total+'</b></span></div>';
            }
            $('#faturasTotaisPagamento').html(options).show();
        });
	});

	$(document).on('click', '.completa-link', function(event) {

		$('#faturas').modal('hide');

		var fatura = $(this);

		var id = fatura.attr("id");
		var valorAtual = fatura.data('valor');
		var dataFatura = fatura.data('data');
		var idFatura = fatura.data('fatura');
		var multa = fatura.data('multa');
		var juros = fatura.data('juros');
		var valor_total = fatura.data('valor_total');

		var options='';

		$.post('../assets/php/edit/faturasParciais.php',{'cliente_id': id, 'data_fatura': dataFatura}, function(j){
           
			swal.queue([{
			title: 'Fatura completa',
			confirmButtonText: 'Pagar',
			cancelButtonText: 'Cancelar',
			showCancelButton: true,
			html:
			    'Realizar o pagamento da '+options+' fatura no valor de R$ '+valor_total+'' +
			    '<p>Pagamentos parciais já debitados: '+j+'</p>' +
			    '<p>Multa por atraso: R$ '+multa+' + Total de juros: R$ '+juros+''+
			    '<p>Valor fatura original: R$ '+valorAtual+'</p>' +
			    '<form method="post" id="completa-SaveForm" action="#" role="form">' +
			    '<input type="text" name="pag_id" value="'+id+'" hidden>' +
			    '<input type="text" name="idFatura" value="'+idFatura+'" hidden>' +
			    '</form>',
			showLoaderOnConfirm: true,
			  
			preConfirm: function () {
			    return new Promise(function (resolve) {
			    $.post('../assets/php/edit/pagar_fatura.php', $('#completa-SaveForm').serialize())
			        .done(function(data){
		        	if (data=='sucesso') {
		        		swal.insertQueueStep("Pagamento realizado com sucesso!");
		        		resolve()
		        	}else{
		        		swal.insertQueueStep(data);
		        		resolve()
		        	}
				 });
			    })
			  }
			}]);
        });

		return false;
	});

	$(document).on('click', '.senha-compra-link', function(event) {

			var id = $(this).attr("id");
			  swal.queue([{
			  title: 'Recuperar senha de compra',
			  confirmButtonText: 'Salvar',
			  cancelButtonText: 'Cancelar',
			  showCancelButton: true,
			  html:
			    'Ps.: A senha será alterada imediatamente.' +
			    '<form method="post" id="senha-compra-SaveForm" action="#" role="form">' +
			    '<input type="text" name="id_cl" id="id_cl" value="'+id+'" hidden>'+
			    '<input type="password" name="senha_compra" id="senha_compra" class="form-control num" placeholder="Insira a senha de compra" autofocus>'+
			    '</form>',
			  showLoaderOnConfirm: true,
			  
			  preConfirm: function () {
			    return new Promise(function (resolve) {
			    $.post("../assets/php/edit/recuperar_senha_compra.php", $('#senha-compra-SaveForm').serialize())
		        .done(function(data){
		        	if (data=='sucesso') {
		        		swal.insertQueueStep("Sucesso!");
		        		resolve()
		        	}else{
		        		swal.insertQueueStep(data);
		        		resolve()
		        	}
				 });
			    })
			  }
			}]);
			return false;
	});

	$(document).on('click', '.enviar-email', function(event) {
		event.preventDefault();

			var id = $(this).attr("id");
			var nome = $(this).data("name");
			if(confirm('Enviar e-mail para o cliente "'+nome+'"'))
			{
				$.post('../assets/php/edit/enviar_cobranca.php', {'id':id}, function(data)
				{
					operacaoRealizada.showNotification('top','center');
				});	
			}
			return false;
	});	

	$(document).on('click', '.enviar-email-rh', function(event) {
		event.preventDefault();

			var id = $(this).attr("id");
			var nome = $(this).data("name");
			if(confirm('Enviar cobrança de RH para o cliente "'+nome+'"'))
			{
				$.post('../assets/php/edit/enviar_cobranca_rh.php', {'id':id}, function(data)
				{
					operacaoRealizada.showNotification('top','center');
				});	
			}
			return false;
	});
	
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

	  function showpanel() {     
    $(".navigation").hide();
    $(".page").children(".panel").fadeIn(1000);
 }
		});