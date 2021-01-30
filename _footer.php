<?php
/**
 *  BRASAP FRAMEWORK CLOSEUP FILE
 *   Fecha as conexões ao Banco de dados, faz a saída de todo o conteúdo
 *   com a saída OUT, que gera o LOG de saída e dados de DEBUG/ESTATISTICA
 *  php version 7.4.3
 * 
 * @category PHP_SimplifiedFrameworkNoOOP
 * @package  BRASAP_STARTUP
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */
$db->prepare('KILL CONNECTION_ID()');
$db->conection = null;
$db = null;
unset($db);
if (AMBIENTE != 'DEVELOPER') {
    unset($_POST);
    unset($_GET);
    unset($_FILES);
    unset($_REQUEST);
    unset($_SERVER);
    unset($_ENV);
}
gc_collect_cycles();
_out("Finalizado com Sucesso", 200);
?>