<!-- Navbar Start -->
<nav class="navigation">
    <ul class="list-unstyled">
        <li class="<?php if ($page=='inicio'){echo "active";}?>"><a href="inicio"><i class="zmdi zmdi-view-dashboard"></i> <span class="nav-label">Dashboard</span></a></li>
        <li class="<?php if ($page=='contas'){echo "active";}?>"><a href="listar-saidas"><i class="zmdi zmdi-calendar-note"></i> <span class="nav-label">Contas</span></a></li>
        <li class="<?php if ($page=='listar-fornecedor'){echo "active";}?>"><a href="listar-fornecedores"><i class="ion-ios7-cart"></i> <span class="nav-label">Fornecedores</span></a></li>
        <li class="<?php if ($page=='relatorios'){echo "active";}?>"><a href="relatorios"><i class="zmdi zmdi-assignment"></i> <span class="nav-label">Relatórios</span></a></li>
    </ul>
</nav>