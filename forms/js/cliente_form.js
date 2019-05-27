// JavaScript Document

$(document).ready(function(){

    /* Recuperar senha  */
    $(document).on('submit', '#recuperaSenha-SaveForm', function() {
       $.post("forms/php/envia_email.php", $(this).serialize())
        .done(function(data){
                alert("E-mail de recuperação de senha enviado!");
                window.location.href = "http://disabores.com.br/";                               
         });   
         return false;
    });

    /* Recuperar senha  */
    $(document).on('submit', '#compra-SaveForm', function() {
       $.post("app/assets/php/edit/recuperar_senha_compra.php", $(this).serialize())
        .done(function(data){
            if (data=='sucesso') {
                swal('Sucesso!','success');
                location.reload();
            }else{
                swal(data, 'error');
            }                          
         });   
         return false;
    });

    $(document).on('click', '#recSenha', function() {
        /* Act on the event */
        $('#loginCliente-SaveForm').fadeOut();
        $('#recuperaSenha-SaveForm').delay(1000).fadeIn();
        return false;
    });

});