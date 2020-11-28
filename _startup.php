<?php 
/**
 * BRASAP FRAMEWORK START FILE
 *  php version 7.4.3
 * 
 * @category PHP_SimplifiedFrameworkNoOOP
 * @package  BRASAP
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */

//Se a autenticação não está feita, define explicitamante como falsa
if (!isset($_SESSION['login'])) {
    $_SESSION['login']=false;
}
$_SESSION['server']=URL;
$_SESSION['SSID']=SSID;
$_SESSION['rtStart'] = microtime(true);

//Faz o ROUTE do CONTROL/VIEW
if (isset($_GET['route'])) {
    $route = $_GET['route'];
    $route = explode('/', $route);
    $route = filter_var_array($route, FILTER_SANITIZE_URL);
} else {
    $route[0]='0';
}
$_SESSION['route']=$route;
$_SESSION['control']='main';
$_SESSION['view']=false;
$_SESSION['action']=false;
?>