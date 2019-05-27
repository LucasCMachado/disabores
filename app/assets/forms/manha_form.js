// JavaScript Document

$(document).ready(function(){
	
	/* Data Insert Starts Here */

    $(document).on('click', '#envia_compra', function(event) {
	event.preventDefault();
	/* Act on the event */

	var id = $('#cliente').val();
	$.post('../assets/php/inserts/verifica_bloqueio.php', {'id':id}, function(data){
	if (data>0) {
		swal.queue([{
		  title: 'Autenticação',
		  confirmButtonText: 'Salvar',
		  cancelButtonText: 'Cancelar',
		  showCancelButton: true,
		  html:
		    'Insira a senha de compra cadastrada' +
		    '<form method="post" id="valida_senha" action="#" role="form">' +
		    '<input type="text" name="id_cl" id="id_cl" value="'+id+'" hidden>'+
		    '<input type="password" name="senha" id="senha" class="form-control num" placeholder="Insira a senha de compra" autofocus>'+
		    '</form>',
		  showLoaderOnConfirm: true,
		  
		  preConfirm: function () {
		    return new Promise(function (resolve) {
		    $.post("../assets/php/edit/valida_senha.php", $('#valida_senha').serialize())
	        .done(function(data){
	        	if (data=='sucesso') {
	        		$.post("../assets/php/inserts/cadastrar_venda_manha.php", $('#manha-SaveForm').serialize()).done(function(data){
	        			if (data == "sucesso") {
	        				swal({
						      title: '',
						      text: 'Operação realizada com sucesso.',
						      type: 'success'
						    }).then(function() {
						        location.reload();
						    })	        					
	        			}else{
							swal.insertQueueStep(data);
	        				resolve()
	        			}	        				        	        	
					});		        		
	        	}else{
	        		swal.insertQueueStep(data);
	        		resolve()
	        	}
			 });
		    })
		  }
		}]);
	}else{
		swal({
	      title: '',
	      text: 'Usuário bloqueado.',
	      type: 'warning'
	    }).then(function() {
	        location.reload();
	    })
	}
});
    });

    $(document).on("input", "#senha", function () {
	    var limite = 4;
	    var caracteresDigitados = $(this).val().length;
	    var caracteresRestantes = limite - caracteresDigitados;

	    if (caracteresRestantes == 0) {
	    	$(this).next('.swal2-confirm').focus();
	    }
	});

    $(document).keypress(function(e) {
	    if(e.which == 13) {
	        $('.swal2-confirm').click();
		}
	});

    /* Data Insert Starts Here */
	$(document).on('submit', '#multiplos-SaveForm', function() {
	  
	   $.post("../assets/php/inserts/cadastrar_venda_multiplos.php", $(this).serialize())
        .done(function(data){
        	location.reload();        	
		 });   
	     return false;
    });
	
	
	/* Data Delete Starts Here */
	$(".delete-link").click(function()
	{
		var id = $(this).attr("id");
		var del_id = id;
		var nome = $(this).data("name");
		var parent = $(this).parent("td").parent("tr");
		if(confirm('Deseja deletar a venda selecionada?'))
		{
			$.post('../assets/php/delete/delete_venda.php', {'del_id':del_id}, function(data)
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
		$("#btn-add-manha").hide();
        $("#btn-view-manha").show();
		var id = $(this).attr("id");
		var edit_id = id;

			$(".content-loader").fadeOut('slow', function()
			 {
				$(".content-loader").fadeIn('slow');
				$(".content-loader").load('manha_form/edit_form.php?edit_id='+edit_id);
				$("#btn-add").hide();
				$("#btn-view").show();
			});
		
		return false;
	});
	/* Get Edit ID  */
	
	/* Update Record  */
	$(document).on('submit', '#cat-UpdateForm', function() {
	 
	   $.post("manha_form/update_manha.php", $(this).serialize())
        .done(function(data){
			$("#dis").fadeOut();
			$("#dis").fadeIn('slow', function(){
			     $("#dis").html('<div class="alert alert-info">'+data+'</div>');
			     $("#cat-UpdateForm")[0].reset();				 
		     });	
		});   
	    return false;
    });
	/* Update Record  */

	/* Abrir  Período  */
	$(document).on('submit', '#manha-AbrirForm', function() {
	   $.post("manha_form/status_manha.php", $(this).serialize())
        .done(function(data){
        	alert(data);
			window.location.href="manha";
		 });   
	     return false;
    });
	/* Update Record  */

	/* Abre o periodo Starts Here */
	$(".periodo").click(function()
	{
		var id = $(this).attr("id");
		var abre_id = id;
		var nome = $(this).data("nome");
		var nome_trim = nome.replace(/[áàâã]/g,'a').replace(/[éèê]/g,'e').replace(/[óòôõ]/g,'o').replace(/[úùû]/g,'u').replace(/[ç]/g,'c').toLowerCase();

		if(confirm('Deseja abrir o período "'+nome+'"'))
		{
			$.post('../assets/php/inserts/abre_periodo.php', {'abre_id':abre_id}, function(data)
			{
				
				if (data == "aberto") {
					periodoAberto.showNotification('top','right');
					window.location.href="periodos";	

				}else if (data == "fechar") {
					fecharPeriodo.showNotification('top','right');

				}else if (data == "problema") {
					problemaCadastro.showNotification('top','right');
					
				}else{
					alert(data);
				}
				

			});	
		}
		return false;
	});
	/* Abre o periodo Ends Here */

	/* Fecha o periodo Starts Here */
	$(".periodo_aberto").click(function()
	{
		var id = $(this).attr("id");
		var fecha_id = id;
		var nome = $(this).data("nome");
		var nome_trim = nome.replace(/[áàâã]/g,'a').replace(/[éèê]/g,'e').replace(/[óòôõ]/g,'o').replace(/[úùû]/g,'u').replace(/[ç]/g,'c').toLowerCase();

		if(confirm('Deseja fechar o período "'+nome+'"'))
		{
			window.location = "fecha-periodo-"+id; 
		}
		return false;
	});
	/* Abre o periodo Ends Here */
});