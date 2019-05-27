<?php
include('session.php');
?>
<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                <a href="">
                <?php if(empty ($_SESSION['UsuarioNome']))
                    {
                        echo '';
                    }else{
                        echo $_SESSION['UsuarioNome'];
                    }
                    ?>
                 </a>
             </li>
             <li>
                <a href="logout">
                    Sair
                </a>
            </li>
        </ul>
    </div>
</div>
</nav>