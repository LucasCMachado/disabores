<?php
include_once 'restrict.php';
$page='contas';
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
                    <h3 class="title">Contas de saída</h3> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Listagem de contas pagas</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <a href="listar-saidas" class="btn btn-primary btn-rounded m-b-5">Saídas pendentes</a>
                                    <a href="listar-entradas" class="btn btn-primary btn-rounded m-b-5">Entradas</a>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nome</th>
                                                    <th>Valor</th>
                                                    <th>Data Entrada</th>
                                                    <th>Data Vencimento</th>
                                                    <th>Forncededor</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $stmt = $dbh->prepare('SELECT c.id, c.nome, c.valor, c.data_entrada, c.data_vencimento, c.status, f.nome AS nomeFornecedor FROM conta AS c LEFT JOIN fornecedor AS f ON c.id_fornecedor=f.id WHERE c.tipo=1 AND c.status=0 ORDER BY c.data_vencimento ASC');
                                                $stmt->execute();

                                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

                                                echo '
                                                    <tr>
                                                        <td>'.$row["nome"].'</td>
                                                        <td>R$ '.$row["valor"].'</td>
                                                        <td>'.inverteData($row["data_entrada"]).'</td>
                                                        <td>'.inverteData($row["data_vencimento"]).'</td>
                                                        <td>'.$row["nomeFornecedor"].'</td>
                                                        <td style="text-align:center;">';if ($row["status"]>0) {
                                                            echo '<span class="label label-danger">PENDENTE</span>';
                                                        }else{
                                                            echo'<span class="label label-default">PAGO</span>';}echo'</td>
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

            <?php include('ui_parts/modal/conta.php') ?>
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
        <script src="model/conta_model.js"></script>
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
                // Select2
                jQuery(".select2").select2({
                    width: '100%'
                });
                $('.money').mask('000.000,00', {reverse: true});
                $('.date').mask('00/00/0000');
            } );
        </script>

    </body>
</html>