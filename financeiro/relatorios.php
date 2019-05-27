<?php
include_once 'restrict.php';
$page='relatorios';
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
                    <h3 class="title">Relatórios</h3> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Gastos por fornecedor por período</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                                        <form role="form" action="fornecedor-gastos-periodo" id="form-fornecedor-gastos-periodo" method="POST" class="p-20">
                                            <div class="form-group">
                                                <label for="fornecedor">Fornecedor</label>
				                                <select class="select2" id="form" name="form">
				                                  <option value="#">&nbsp;</option>
				                                  <?php 
	                                                $stmt = $dbh->prepare('SELECT id, nome FROM fornecedor ORDER BY nome ASC');
	                                                $stmt->execute();

	                                                foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

	                                                echo '<option value="'.$row["id"].'">'.$row["nome"].'</option>';
	                                                }
	                                              ?>
				                                </select>
                                                
                                            </div>
                                            <div class="form-group">
                                                <label for="dataGastosInicial1">Data inicial</label>
                                                <input type="text" class="form-control date" id="dataGastosInicial1" name="dataGastosInicial1" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="dataGastosFinal1">Data final</label>
                                                <input type="text" class="form-control date" id="dataGastosFinal1" name="dataGastosFinal1" placeholder="">
                                            </div>
                                            <button type="button" class="btn btn-primary fornecedor-gastos-periodo">Gerar relatório</button>
                                        </form>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- End Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Gastos por período</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                                        <form role="form" action="gastos-periodo" id="form-gastos-periodo" method="POST" class="p-20">
                                            <div class="form-group">
                                                <label for="dataGastosInicial2">Data inicial</label>
                                                <input type="text" class="form-control date" id="dataGastosInicial2" name="dataGastosInicial2" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label for="dataGastosFinal2">Data final</label>
                                                <input type="text" class="form-control date" id="dataGastosFinal2" name="dataGastosFinal2" placeholder="">
                                            </div>
                                            <button type="button" class="btn btn-primary gastos-periodo">Gerar relatório</button>
                                        </form>                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- End Row -->

            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

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
        <script src="model/relatorios.js"></script>
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