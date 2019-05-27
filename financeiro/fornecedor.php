<?php
include_once 'restrict.php';
$page='listar-fornecedor';
require_once './_connect/connect_pdo.php';
require_once './controller/functions.php';
$dbh = Database::conexao();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once 'header.php'; ?>
        <!-- DataTables -->
        <link href="assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body>

        <!-- Aside Start-->
        <aside class="left-panel">
            <?php include_once 'logo.php'; ?>
            <?php include_once 'navbar.php'; ?>
                
        </aside>
        <!-- Aside Ends-->

        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            <header class="top-head container-fluid">
                <?php include_once 'toggle_navigation.php'; ?>                
                <!-- Left navbar -->
                <nav class=" navbar-default" role="navigation">

                    <!-- Right navbar -->
                    <ul class="nav navbar-nav navbar-right top-menu top-right-menu">  

                        <?php include_once 'notification_bar.php'; ?>
                        <?php include_once 'user_login_bar.php'; ?>
                            
                    </ul>
                    <!-- End right navbar -->
                </nav>
                
            </header>
            <!-- Header Ends -->

            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">Fornecedores</h3> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Listagem</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <button type="button" class="btn btn-primary btn-rounded m-b-5" data-toggle="modal" data-target="#cadastrar">Novo</button>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>CNPJ</th>
                                                    <th>Telefone</th>
                                                    <th>Status</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $stmt = $dbh->prepare('SELECT * FROM fornecedor ORDER BY id DESC');
                                                $stmt->execute();

                                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

                                                echo '
                                                    <tr>
                                                        <td>'.$row["nome"].'</td>
                                                        <td class="cnpj">'.$row["cnpj"].'</td>
                                                        <td class="phone">'.$row["telefone"].'</td>
                                                        <td style="text-align:center;">';if ($row["status"]>0) {
                                                            echo '<i class="zmdi zmdi-check-circle" style="font-size:25px;color:green;"></i>';
                                                        }else{
                                                            echo'<i class="zmdi zmdi-check-circle" style="font-size:25px;color:grey;"></i>';}echo'</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-inverse btn-rounded m-b-5 dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Opções <i class="ion-gear-a"></i> </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <li><a href="#" class="editar" data-nome="'.$row["nome"].'" data-id="'.$row["id"].'" data-cnpj="'.$row["cnpj"].'" data-telefone="'.$row["telefone"].'" data-toggle="modal" data-target="#editar">Editar</a></li>
                                                                    <li class="divider"></li>
                                                                    ';if ($row["status"]>0) {
                                                                        echo'<li><a href="#" class="desativar" data-nome="'.$row["nome"].'" data-id="'.$row["id"].'" data-toggle="modal" data-target="#desativar">Desativar</a></li>';
                                                                    }else{
                                                                        echo'<li><a href="#" class="reativar" data-nome="'.$row["nome"].'" data-id="'.$row["id"].'" data-toggle="modal" data-target="#reativar">Reativar</a></li>';
                                                                    }echo'
                                                                    
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>';
                                                }
                                                ?>                                                
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- End Row -->

            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <?php include('ui_parts/modal/fornecedor.php') ?>
            <?php include('footer.php') ?>

        </section>
        <!-- Main Content Ends -->      

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="assets/select2/select2.min.js" type="text/javascript"></script>

        <script src="js/jquery.app.js"></script>
        <script src="model/fornecedor_model.js"></script>
        <script src="js/jquery.mask.min.js"></script>

        <script src="assets/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/datatables/dataTables.bootstrap.js"></script>
        <script src="assets/modal-effect/js/classie.js"></script>
        <script src="assets/modal-effect/js/modalEffects.js"></script>

        <script src="assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="assets/sweet-alert/sweet-alert.init.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('.phone').mask('(00) 000000000');
                $('.cnpj').mask('00.000.000/0000-00');
            } );
        </script>

    </body>
</html>