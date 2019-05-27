<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once 'header.php'; ?>
    </head>

    <body>

        <div class="wrapper-page">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading"> 
                   <h3 class="text-center m-t-10"> Financeiro <strong>DiSabores</strong> </h3>
                </div> 

                <div class="panel-body">
                    <form class="form-horizontal m-t-10 p-20 p-b-0" action="entrar" method="POST">
                                            
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <label for="email">E-mail</label>
                                <input class="form-control" id="email" name="email" type="text" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group ">
                            
                            <div class="col-xs-12">
                                <label for="senha">Senha</label>
                                <input class="form-control" id="senha" name="senha" type="password" placeholder="Password">
                            </div>
                        </div>
                        
                        <div class="form-group text-right">
                            <div class="col-xs-12">
                                <button class="btn btn-success w-md" type="submit">Entrar</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        
        <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>            

        <!--common script for all pages-->
        <script src="js/jquery.app.js"></script>
    
    </body>
</html>
