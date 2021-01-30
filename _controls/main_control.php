<?php
/**
 * BRASAP FRAMEWORK MAIN_CENTROL
 *  Controle Principal, controle para acesso geral/index
 *  php version 7.4.3
 * 
 * @category PHP_SimplifiedFrameworkNoOOP
 * @package  BRASAP_MAIN
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */
$perfil_usuario = logado();
if (isset($route[1]) 
    && file_exists(
        __DIR__."/_views/".$_SESSION['control'].'_'.$route[1]."_view.php"
    ) 
) {
    $_SESSION['view'] = $route[1];
} else {
    $_SESSION['view'] = 'index';
}