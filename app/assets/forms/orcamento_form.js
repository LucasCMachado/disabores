// JavaScript Document

$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#orcamento-SaveForm', function() {
	  
	   $.post("../assets/php/inserts/cadastrar_orcamento.php", $(this).serialize())
        .done(function(data){
        	var confirma = data;
        	if (confirma == 'sucesso') {
				swal({
			      title: '',
			      text: 'Operação realizada com sucesso.',
			      type: 'success'
			    }).then(function() {
			        window.location.href = "novo-orcamento";
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
	
	/* Data Delete Starts Here */
	$(".delete-link").click(function()
	{
		var id = $(this).attr("id");
		var del_id = id;
		var nome = $(this).data("name");
		var parent = $(this).parent().parent("tr");
		if(confirm('Deseja deletar o orcamento "'+nome+'"'))
		{
			$.post('../assets/php/delete/delete_orcamento.php', {'del_id':del_id}, function(data)
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
		window.location.href="editar-orcamento-"+edit_id+"";
		
	});
	/* Get Edit ID  */
	
	/* Update Record  */
	$(document).on('submit', '#orcamento-UpdateForm', function() {
	   $.post("../assets/php/edit/update_orcamento.php", $(this).serialize())
        .done(function(data){
			if (data == "sucesso") {
				swal({
			      title: '',
			      text: 'Operação realizada com sucesso.',
			      type: 'success'
			    }).then(function() {
			        window.location.href = "orcamentos";
			    })
			}else{
				swal({
			      title: '',
			      text: 'Houve um problema ao realizar a operação, por gentileza tente novamente.',
			      type: 'error'
			    }).then(function() {
			        window.location.href = "orcamentos";
			    })
			}
		 });   
	     return false;
    });
	/* Update Record  */
	function showpanel() {     
    $(".navigation").hide();
    $(".page").children(".panel").fadeIn(1000);
 }

$(document).on('click', '.pagar-link', function(event) {

var id = $(this).attr("id");
swal.queue([{
  title: 'Fechar pedido',
  confirmButtonText: 'Sim',
  cancelButtonText: 'Não',
  showCancelButton: true,
  html:
    'Realizar o fechamento da fatura?' +
    '<form method="post" id="fechaOrcamento-SaveForm" action="#" role="form">' +
    '<input type="text" name="id_orc" id="id_orc" value="'+id+'" hidden>'+
    '</form>',
  showLoaderOnConfirm: true,
  
  preConfirm: function () {
    return new Promise(function (resolve) {
    $.post("../assets/php/edit/fechar_orcamento.php", $('#fechaOrcamento-SaveForm').serialize())
    .done(function(data){
    	if (data=='sucesso') {
    		swal({
		      title: '',
		      text: 'Operação realizada com sucesso.',
		      type: 'success'
		    }).then(function() {
		        window.location.href = "orcamentos";
		    })
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