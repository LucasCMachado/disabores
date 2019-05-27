<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head_main.php'; ?>
    </head>
    <body>
        <div class="wrapper-page animated fadeInDown">
            <div class="panel panel-color panel-inverse">
                <div class="panel-heading"> 
                   <h3 class="text-center m-t-10"> Área do cliente</h3>
                </div> 
                <form action="entrar" method="post" class="form-horizontal m-t-40">                                            
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" name="email" type="text" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group ">                        
                        <div class="col-xs-12">
                            <input class="form-control" name="senha" type="password" placeholder="Password">
                        </div>
                    </div>
                    
                    <div class="form-group text-right">
                        <div class="col-xs-12">
                            <button class="btn btn-purple w-md" type="submit">Entrar</button>
                        </div>
                    </div>
                    <div class="form-group m-t-30">
                        <div class="col-sm-7">
                            <a href="recoverpw.php"><i class="fa fa-lock m-r-5"></i> Esqueci minha senha</a>
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

        <!--common script for all pages-->
        <script src="js/jquery.app.js"></script>
    
    </body>
</html>
