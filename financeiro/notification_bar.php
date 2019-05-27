<!-- Notification -->
<li class="dropdown">
    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
        <i class="zmdi zmdi-notifications-none"></i>

        <?php
        $count=0;
        $data_atual= date('Y-m-d');
        $stmt = $dbh->prepare('SELECT COUNT(id) as numVencidas FROM conta WHERE status=1 AND data_vencimento < :data_atual');
        $stmt->bindParam(":data_atual", $data_atual, PDO::PARAM_STR);
        $stmt->execute();
        $num_vencidas=$stmt->fetch();

        if ($num_vencidas['numVencidas'] > 0) {
           echo '<span class="badge badge-sm up bg-danger count">'.$num_vencidas['numVencidas'].'</span>';
        }

        
        ?>
        
    </a>
    <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
        <li class="noti-header">
            <p>Notificações</p>
        </li>
        <?php 
            $stmt = $dbh->prepare('SELECT nome, data_vencimento, status FROM conta WHERE status=1 ORDER BY data_vencimento ASC');
            $stmt->execute();

            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {

                $data_vencimento=validaData($row["data_vencimento"]);
                if ($data_vencimento) {
                    echo'<li>
                            <a href="#">
                                <span class="pull-left"><i class="zmdi zmdi-alert-polygon text-danger"></i></span>
                                <span>'.$row["nome"].'<br><small class="text-muted">Venc.: '.inverteData($row["data_vencimento"]).'</small></span>
                            </a>
                        </li>';
                }
            }
        ?>
    </ul>
</li>
<!-- /Notification -->