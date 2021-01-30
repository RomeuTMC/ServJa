<?php
/**
 * BRASAP FRAMEWORK MENU
 *  Cria um MENU DE NAVEGAÇÃO com base nas credenciais do Usuário
 *  php version 7.4.3
 * 
 * @category PHP_SimplifiedFrameworkNoOOP
 * @package  BRASAP_MAIN
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */
?>
<a class="navbar-brand" href="#">ServJa</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" 
    data-target="#main_nav">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="main_nav">
    <ul class="navbar-nav">
        <?php
        $menus = menu(0);
        foreach ($menus as $menu) {
            if ($menu['filhos']==0) {
                //SE NÃO TEM FILHO
                echo "<li class='nav-item'><a class='nav-link'
                    href='".URL.$menu['endpoint']."'>".
                    "<i class='".$menu['icone']."'></i> ".$menu['menu']."</a></li>";
            } else {
                echo "<li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle' href='".URL.$menu['endpoint']."'
                data-toggle='dropdown'>"."<i class='".$menu['icone']."'></i> ".
                $menu['menu']."</a>";
                submenu($menu['id']);
            }
        }
        ?>
    </ul>
</div>
