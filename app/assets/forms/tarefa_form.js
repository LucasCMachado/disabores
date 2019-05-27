// JavaScript Document

$(document).ready(function(){
	
	/* Data Insert Starts Here */
	$(document).on('submit', '#tarefa-SaveForm', function() {
	  
	   $.post("../assets/php/inserts/cadastrar_tarefa.php", $(this).serialize())
        .done(function(data){
        	var confirma = data;
        	$(confirma).prependTo('#tabela');
        	$('#tarefa-SaveForm')[0].reset();
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
		if(confirm('Deseja deletar o tarefa "'+nome+'"'))
		{
			$.post('../assets/php/delete/delete_tarefa.php', {'del_id':del_id}, function(data)
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
		var data = $(this).data("data");

		var visible = $('#forms_tarefas').css('display');

		if (visible == "none") {
			$('#forms_tarefas').toggle( "slow" );
		}
		$('#edit_nome').attr({
				'value': nome,
				'placeholder': nome
			});
			$('#edit_data').attr({
				'value': data,
				'placeholder': data
			});
			$('#edit_id').attr({
				'value': edit_id,
				'placeholder': edit_id
			});

			$('#tarefa-UpdateForm').css({
				'display': 'block'
			});$('#tarefa-SaveForm').css({
				'display': 'none'
			});
		
	});
	/* Get Edit ID  */
	
	/* Update Record  */
	$(document).on('submit', '#tarefa-UpdateForm', function() {
	   $.post("../assets/php/edit/update_tarefa.php", $(this).serialize())
        .done(function(data){
        	 alert(data);
			//window.location.href="tarefas";
		 });   
	     return false;
    });
	/* Update Record  */
	});
	
	