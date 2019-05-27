<?php
include_once 'restrict.php';
$page='inicio';
require_once './_connect/connect_pdo.php';
require_once './controller/functions.php';
$dbh = Database::conexao();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once 'header.php'; ?>
        <link href="assets/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/select2/select2.css" />
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
                    <h3 class="title">Destaques</h3> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Contas a pagar</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>Valor</th>
                                                        <th>Data de vencimento</th>
                                                        <th>Fornecedor</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                $stmt = $dbh->prepare('SELECT c.id, c.nome, c.valor, c.data_entrada, c.data_vencimento, c.status, f.nome AS nomeFornecedor FROM conta AS c LEFT JOIN fornecedor AS f ON c.id_fornecedor=f.id WHERE c.tipo=1 AND c.status=1 ORDER BY c.data_vencimento ASC');
                                                $stmt->execute();

                                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

                                                echo '
                                                    <tr>
                                                        <td>'.$row["nome"].'</td>
                                                        <td>R$ '.$row["valor"].'</td>
                                                        <td>'.inverteData($row["data_vencimento"]).'</td>
                                                        <td>'.$row["nomeFornecedor"].'</td>
                                                        <td style="text-align:center;">';

                                                        $data_vencimento=validaData($row["data_vencimento"]);
                                                        if ($data_vencimento) {
                                                            echo '<span class="label label-danger">VENCIDA</span>';
                                                        }else{
                                                            echo'<span class="label label-success">CONTA EM DIA</span>';}

                                                        echo'</td>
                                                        <td>
                                                            <a href="#" class="btn btn-inverse btn-rounded m-b-5 pagar" data-nome="'.$row["nome"].'" data-id="'.$row["id"].'" data-toggle="modal" data-target="#pagar">Pagar</a>
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
                    </div>
                    <!-- Contas a receber -->
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Contas a receber</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nome</th>
                                                        <th>Valor</th>
                                                        <th>Data de vencimento</th>
                                                        <th>Fornecedor</th>
                                                        <th>Status</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                $stmt = $dbh->prepare('SELECT c.id, c.nome, c.valor, c.data_entrada, c.data_vencimento, c.status, f.nome AS nomeFornecedor FROM conta AS c LEFT JOIN fornecedor AS f ON c.id_fornecedor=f.id WHERE c.tipo=0 AND c.status=1 ORDER BY c.data_vencimento ASC');
                                                $stmt->execute();

                                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

                                                echo '
                                                    <tr>
                                                        <td>'.$row["nome"].'</td>
                                                        <td>R$ '.$row["valor"].'</td>
                                                        <td>'.inverteData($row["data_vencimento"]).'</td>
                                                        <td>'.$row["nomeFornecedor"].'</td>
                                                        <td>';
                                                        $data_vencimento=validaData($row["data_vencimento"]);
                                                        if ($data_vencimento) {
                                                            echo '<span class="label label-danger">VENCIDA</span>';
                                                        }else{
                                                            echo'<span class="label label-success">CONTA EM DIA</span>';}

                                                    echo'</td>
                                                        <td>
                                                            <a href="#" class="btn btn-inverse btn-rounded m-b-5 receber" data-nome="'.$row["nome"].'" data-id="'.$row["id"].'" data-toggle="modal" data-target="#receber">Receber</a>
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
                    </div>
                </div>

            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <?php include('ui_parts/modal/conta.php'); ?>
            <?php include('footer.php'); ?>

        </section>
        <!-- Main Content Ends -->      

        <!-- js placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>

        <script src="js/jquery.app.js"></script>
        <script src="model/conta_model.js"></script>
        <script src="assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="assets/sweet-alert/sweet-alert.init.js"></script>    

    </body>
</html>