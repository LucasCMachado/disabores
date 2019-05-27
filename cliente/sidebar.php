<!-- Navbar Start -->
<nav class="navigation">
    <ul class="list-unstyled">
        <li <?php if ($page=='inicio') {
            echo 'class="active"';
        } ?>><a href="inicio"><i class="ion-home"></i> <span class="nav-label">Inicio</span></a></li>
        <li class="has-submenu <?php if($page=='fatura'){echo 'active';}?>"><a href="#"><i class="ion-clipboard"></i> <span class="nav-label">Faturas</span></a>
            <ul class="list-unstyled">
                <li class="<?php if($sub=='atual'){echo 'active';}?>"><a href="fatura-atual">Atual</a></li>
                <li class="<?php if($sub=='antigas'){echo 'active';}?>"><a href="faturas-antigas">Antigas</a></li>
            </ul>
        </li>
        <li class="<?php if($page=='config'){echo 'active';}?>"><a href="configuracoes"><i class="ion-gear-a"></i> <span class="nav-label">Configurações</span></a></li>
    </ul>
</nav>