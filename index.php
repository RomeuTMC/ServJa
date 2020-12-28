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

require_once __DIR__.'/_defs.php'; //Definições do sistema e ambiente
require_once __DIR__.'/_load.php'; //Load do FRAMEWORK e funções sobre demanda
require_once __DIR__.'/_startup.php'; // Inicialização sessão/autenticação/validação
if (file_exists(__DIR__."/_controls/".$_SESSION['control']."_control.php")) {
    include_once __DIR__."_controls/".$_SESSION['control']."_control.php";
} else {
    if (AMBIENTE == 'DEVELOPER') {
        echo ($_SESSION['control']."_control.php");
    } else {
        $_SESSION['control']='main';
        $_SESSION['view']='view';
        $_SESSION['erro_no']='2';
        $_SESSION['erro']='CHAMADA PARA PROCEDIMENTO INVÁLIDO';
    }
}
for ($i=0; $i<1000000; $i++){
    echo "x";
    if (($i % 1000) == 0) {
        echo "<br>";
    }
}
_out("FINALIZADO COM SUCESSO", 200);
?>