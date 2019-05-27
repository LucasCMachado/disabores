/* Data Insert Starts Here */
$(document).on('submit', '#dados-EditForm', function() {
  
   $.post("assets/php/editarDadosUsuario.php", $(this).serialize())
    .done(function(data){
        if (data=='sucesso') {
        swal({
          title: 'Sucesso!',
          text: 'Atualizando dados.',
          timer: 1000,
          type: 'success',
          onOpen: () => {
            swal.showLoading()
          }
        }).then((result) => {
          if (result.dismiss === 'timer') {
            window.location.href = "configuracoes";
          }
        })                  
         
      }else{
        swal(
          'Erro!',
          'Erro ao atualizar os dados: '+data+'',
          'error'
        )
      }         
     });   
     return false;
});

/* Data Insert Starts Here */
$(document).on('submit', '#senha-compra-EditForm', function() {
  
   $.post("../app/assets/php/edit/recuperar_senha_compra.php", $(this).serialize())
    .done(function(data){
    	if (data=='sucesso') {
        swal({
          title: 'Sucesso!',
          text: 'Atualizando dados.',
          timer: 1000,
          type: 'success',
          onOpen: () => {
            swal.showLoading()
          }
        }).then((result) => {
          if (result.dismiss === 'timer') {
            window.location.href = "configuracoes";
          }
        })                  
         
      }else{
        swal(
          'Erro!',
          'Erro ao atualizar os dados: '+data+'',
          'error'
        )
      }         	
	 });   
     return false;
});

/* Recuperar senha  */
$(document).on('submit', '#recuperaSenha-SaveForm', function() {
   $.post("assets/php/envia_email.php", $(this).serialize())
    .done(function(data){
            alert("E-mail de recuperação de senha enviado!");                               
     });   
     return false;
});
	