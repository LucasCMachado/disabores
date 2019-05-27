<?php
include 'restrict.php';
date_default_timezone_set('America/Sao_Paulo');
$page='fatura';
$sub='atual';
include 'functions.php';
require_once '../_connect/connect_pdo.php';
$dbh = Database::conexao();
$id_usuario=$_SESSION['UsuarioID'];
?>
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
                
            </header>
            <!-- Header Ends -->
            <!-- Page Content Start -->
            <!-- ================== -->

            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">Fatura Atual</h3> 
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                                <h4>Invoice</h4>
                            </div> -->
                            <div class="panel-body">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="text-right"><img src="img/logo_dark.png" alt="velonic"></h4>
                                        
                                    </div>
                                    <div class="pull-right">
                                        <h4>Fatura # <br>
                                            <strong>-</strong>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="pull-left m-t-30">
                                            <address>
                                              <strong>Cantina DiSabores</strong><br>
                                              <abbr title="e-mail">E-mail:</abbr> contato@disabores.com.br<br>
                                              <abbr title="e-mail">Ramal:</abbr> 100
                                              </address>
                                        </div>
                                        <div class="pull-right m-t-30">
                                            <p><strong>Data da fatura: </strong> <?php echo date('m/Y'); ?></p>
                                            <p class="m-t-10"><strong>Status da fatura: </strong> <span class="label label-warning">PENDENTE</span></p>
                                            <p class="m-t-10"><strong>ID Cliente: </strong> <?php echo $id_usuario; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-h-50"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead>
                                                    <tr><th>#</th>
                                                    <th>Período</th>
                                                    <th>Data Compra</th>
                                                    <th>Produtos</th>
                                                    <th>Valor</th>
                                                </tr></thead>
                                                <tbody>
                                                    <?php faturaAtual($dbh,$id_usuario);?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="border-radius: 0px;">
                                    <div class="col-md-3 col-md-offset-9">
                                        <p class="text-right"><b>Pagamento parcial:</b> <?php somaPagamentoParcialAtual($dbh,$id_usuario); ?></p><hr>
                                        <h3 class="text-right">Total R$ <?php totalFaturaAtual($dbh,$id_usuario);?></h3>
                                    </div>
                                </div>
                                <hr>
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
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>


        <script src="js/jquery.app.js"></script>


    </body>
</html>
