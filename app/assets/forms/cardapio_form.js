// JavaScript Document

$(document).ready(function(){
	
	/* Update Record  */
	$(document).on('submit', '#cardapio-UpdateForm', function() {
	   $.post("../assets/php/edit/update_cardapio.php", $(this).serialize())
        .done(function(data){
        	operacaoRealizada.showNotification('top','right');        	
		 });   
	     return false;
    });

    /* Data Insert Starts Here */
	$(document).on('click', '.dia', function() {
	var dia_solicitado = $(this).data('dia');

	$.ajax({
    type: "POST",
    data: {data:dia_solicitado},
    url: "../assets/php/lists/lista_cardapio.php",
    success: function(data){
      //then append the result where ever you want like
      $("#cardapio").val(data); //data will be containing the vote count which you have echoed from the controller

        }
    });

	});
});
	/* Update Record  */