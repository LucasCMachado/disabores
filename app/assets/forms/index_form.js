
$(".concluir-link").click(function()
{
	var id = $(this).attr("id");
	var conclui = id;
	var nome = $(this).data("name");
	var parent = $(this).parent().parent("tr");
	if(confirm('Deseja concluir a tarefa "'+nome+'"'))
	{
		$.post('../assets/php/edit/concluir_tarefa.php', {'conclui':conclui}, function(data)
		{
		alert(data);
		operacaoRealizada.showNotification('top','right');
		parent.fadeOut('slow');
		});	
	}
	return false;
});


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