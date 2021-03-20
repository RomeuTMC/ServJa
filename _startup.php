<?php 
/**
 * BRASAP FRAMEWORK START FILE
 *  php version 7.4.3
 * 
 * @category PHP_SimplifiedFrameworkNoOOP
 * @package  BRASAP_STARTUP
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */
session_start();
//Se a autenticação não está feita, define explicitamante como falsa
if (!isset($_SESSION['logado'])) {
    $_SESSION['logado'] = 0; //false
}
$_SESSION['server']=URL;
$_SESSION['SSID']=SSID;
$_SESSION['rtStart'] = microtime(true);
$_SESSION['memoryStart'] = "MEMORY USAGE: ".
    number_format((memory_get_usage(false)/1000), 2)."Kb / ".
    number_format((memory_get_usage(true)/1000000), 2)."Mb";
//Faz o ROUTE do CONTROL/VIEW
if (isset($_GET['route'])) {
    $route = $_GET['route'];
    $route = explode('/', $route);
    $route = filter_var_array($route, FILTER_SANITIZE_URL);
} else {
    $route[0] = 'main';
}
// se foi incluido um modulo de banco_de dados, cria a conexão
if (function_exists('conectDb')) {
    $db = conectDb();
} else {
    $db = false;
    _out('FALHA NA CONEXÃO COM UM BANCO DE DADOS', 200);
}
$_SESSION['title']=SISTEMA;
?>