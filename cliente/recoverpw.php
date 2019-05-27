<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head_main.php'; ?>
    </head>

    <body>

        <div class="wrapper-page animated fadeInDown">
            <div class="panel panel-color panel-primary">

                <form role="form" id='recuperaSenha-SaveForm' action="#" role="form" class="text-center"> 
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Insira o <b>e-mail</b> cadastrado e enviaremos uma mensagem para que você recupere seu acesso!
                    </div>
                    <div class="form-group m-b-0"> 
                        <div class="input-group"> 
                            <input type="email" name="email_recuperacao" class="form-control" placeholder="Insira seu e-mail"> 
                            <span class="input-group-btn"> <button type="submit" class="btn btn-primary">Enviar e-mail</button> </span> 
                        </div> 
                    </div>                     
                </form>                                     
            </div>
        </div>   

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

        <script src="assets/forms/usuario_form.js"></script>            

        <!--common script for all pages-->
        <script src="js/jquery.app.js"></script>

    
    </body>
</html>
