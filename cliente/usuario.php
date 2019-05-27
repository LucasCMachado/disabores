<?php
include 'restrict.php';
$page='config';

require_once '../_connect/connect_pdo.php';
$dbh = Database::conexao();

$id = $_SESSION['UsuarioID'];

$sql = 'SELECT nome, email FROM cliente WHERE id=:id';
$sth = $dbh->prepare($sql);
$sth->bindValue(':id', $id);
$sth->execute();
$usuario = $sth->fetch();?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'head_main.php'; ?>
    </head>
    <body>
        <?php include 'header.php'; ?>

        <!--Main Content Start -->
        <section class="content">            
            <?php include 'navbar.php'; ?>
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="bg-picture" style="background-image:url('img/img_bg_1.jpg')">
                          <span class="bg-picture-overlay"></span><!-- overlay -->
                          <!-- meta -->
                          <div class="box-layout meta bottom">
                            <div class="col-sm-6 clearfix">
                              <span class="img-wrapper pull-left m-r-15"><img src="img/user.png" alt="" style="width:64px" class="br-radius"></span>
                              <div class="media-body">
                                <h3 class="text-white mb-2 m-t-10 ellipsis"><?php echo $_SESSION['UsuarioNome']; ?></h3>
                              </div>
                            </div>
                          </div>
                          <!--/ meta -->
                        </div>
                    </div>
                </div>

                <div class="row m-t-30">
                    <div class="col-sm-12">
                        <div class="panel panel-default p-0">
                            <div class="panel-body p-0"> 
                                <ul class="nav nav-tabs profile-tabs">
                                    <li class="active"><a data-toggle="tab" href="#dadosCliente">Dados do cliente</a></li>
                                    <li class=""><a data-toggle="tab" href="#editar-dados">Editar dados</a></li>
                                    <li class=""><a data-toggle="tab" href="#senha-compra">Senha compra</a></li>
                                </ul>
                                <div class="tab-content m-0"> 

                                    <div id="dadosCliente" class="tab-pane active">
                                    <div class="profile-desk">
                                        <table class="table table-condensed">
                                            <thead>
                                                <tr>
                                                    <th colspan="3"><h3>Contact Information</h3></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><b>#</b></td>
                                                    <td>
                                                        <?php echo $_SESSION['UsuarioID'];?>
                                                    </a></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Nome</b></td>
                                                    <td>
                                                        <?php echo $usuario['nome'];?>
                                                    </a></td>
                                                </tr>
                                                <tr>
                                                    <td><b>E-mail</b></td>
                                                    <td>
                                                       <?php echo $usuario['email'];?>
                                                    </a></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Status</b></td>
                                                    <td><span class="label label-success"><?php echo $_SESSION['UsuarioStatus'];?></span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> <!-- end profile-desk -->
                                </div> <!-- about-me -->

                                <!-- settings -->
                                <div id="editar-dados" class="tab-pane">
                                    <div class="user-profile-content">
                                        <form role="form" id='dados-EditForm' action="#" role="form">
                                            <div class="form-group">
                                                <label for="nome">Nome</label>
                                                <input type="text" value="<?php echo $usuario['nome'];?>" name="nome" id="nome" class="form-control">
                                                <input type="text" value="<?php echo $_SESSION['UsuarioID'];?>" name="id" id="id" style="display: none;">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input type="text" value="<?php echo $usuario['email'];?>" name="email" id="email" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="senha">Senha</label>
                                                <input type="password" value="" name="senha" id="senha" class="form-control">
                                            </div>

                                            <button class="btn btn-primary" type="submit">Salvar</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- settings -->
                                <div id="senha-compra" class="tab-pane">
                                    <div class="user-profile-content">
                                        <form role="form" id='senha-compra-EditForm' action="#" role="form">
                                            <div class="form-group">
                                                <label for="senha_compra">Senha compra</label>
                                                <input type="senha_compra" placeholder="Senha com 4 digitos" id="senha_compra" class="form-control num">
                                                <input type="text" value="<?php echo $_SESSION['UsuarioID'];?>" name="id_usuario" id="id" style="display: none;">
                                            </div>
                                            <button class="btn btn-primary" type="submit">Salvar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>             
                        </div> 
                    </div>
                </div>
            </div>  
        </div>

        <!-- Page Content Ends -->
        <!-- ================== -->

        <?php include 'footer.php'; ?>

    </section>
    <!-- Main Content Ends -->

    <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.scrollTo.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    
        <script src="js/jquery.app.js"></script>
        <script src="assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="assets/forms/usuario_form.js"></script>

        <!-- Forms -->
        <script src="js/mask/dist/jquery.mask.min.js"></script>

        <script>
            jQuery(document).ready(function($) {
                $('.num').mask('0000');
            });
        </script>

  </body>
</html>
