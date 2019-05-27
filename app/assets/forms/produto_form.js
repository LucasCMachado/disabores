// JavaScript Document

$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#produto-SaveForm', function() {
	  
	   $.post("../assets/php/inserts/cadastrar_produto.php", $(this).serialize())
        .done(function(data){
        	var confirma = data;
        	$(confirma).prependTo('#tabela');
        	$('#produto-SaveForm')[0].reset();
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
		if(confirm('Deseja deletar o produto "'+nome+'"'))
		{
			$.post('../assets/php/delete/delete_produto.php', {'del_id':del_id}, function(data)
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
		var valor = $(this).data("value");
		$('#forms_produtos').toggle( "slow" );

		$('#edit_nome').attr({
			'value': nome,
			'placeholder': nome
		});
		$('#edit_valor').attr({
			'value': valor,
			'placeholder': valor
		});
		$('#edit_id').attr({
			'value': edit_id,
			'placeholder': edit_id
		});
		$('#produto-UpdateForm').css({
			'display': 'block'
		});$('#produto-SaveForm').css({
			'display': 'none'
		});
		
	});
	/* Get Edit ID  */
	
	/* Update Record  */
	$(document).on('submit', '#produto-UpdateForm', function() {
	   $.post("../assets/php/edit/update_produto.php", $(this).serialize())
        .done(function(data){
			window.location.href="produto";
		 });   
	     return false;
    });
	/* Update Record  */