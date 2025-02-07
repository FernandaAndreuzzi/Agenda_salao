<?php
function renderMenu($activePage = '') {    
    if( $_SESSION['tipoUsuario']==0)
    {
        $menuItems = [
            'home.php' => 'Início',
            'agendamento_index.php' => 'Agendamento',
            'about.php' => 'Sobre',
            'logout.php' => 'Sair'
        ];
    }
    else{
        $menuItems = [
            'home.php' => 'Início',
            'agendamento_index.php' => 'Agendamento',
            'cliente_index.php' => 'Usuário',
            'about.php' => 'Sobre',
            'logout.php' => 'Sair'
        ];
    }
    

    echo '<nav>';
    echo '<ul>';
    foreach ($menuItems as $link => $label) {
        $activeClass = ($activePage === $link) ? 'class="active"' : '';
        echo "<li><a href='$link' $activeClass>$label</a></li>";
    }
    echo '</ul>';
    echo '</nav>';
}
?>