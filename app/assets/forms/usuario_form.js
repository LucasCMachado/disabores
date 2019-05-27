// JavaScript Document

$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#usuario-SaveForm', function() {
	  
	   $.post("../assets/php/inserts/cadastrar_usuario.php", $(this).serialize())
        .done(function(data){
        	var confirma = data;
        	$(confirma).prependTo('#tabela');
        	$('#usuario-SaveForm')[0].reset();
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
		if(confirm('Deseja inativar esse usuário "'+nome+'"'))
		{
			$.post('../assets/php/delete/delete_usuario.php', {'del_id':del_id}, function(data)
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
		var data = $(this).data("data");

		var visible = $('#forms_usuarios').css('display');

		if (visible == "none") {
			$('#forms_usuarios').toggle( "slow" );
		}
		$('#edit_nome').attr({
				'value': nome,
				'placeholder': nome
			});
			$('#edit_data').attr({
				'value': data,
				'placeholder': data
			});
			$('#edit_email').attr({
				'value': email,
				'placeholder': email
			});
			$('#edit_id').attr({
				'value': edit_id,
				'placeholder': edit_id
			});

			$('#usuario-UpdateForm').css({
				'display': 'block'
			});$('#usuario-SaveForm').css({
				'display': 'none'
			});
		
	});
	/* Get Edit ID  */
	
	/* Update Record  */
	$(document).on('submit', '#usuario-UpdateForm', function() {
	   $.post("../assets/php/edit/update_usuario.php", $(this).serialize())
        .done(function(data){
        	alert(data);
			window.location.href="usuarios";
		 });   
	     return false;
    });
	/* Update Record  */