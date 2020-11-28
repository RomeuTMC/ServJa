<?php
/**
 * BRASAP FRAMEWORK START FILE
 * Funções de atalho para DB MYSQL
 *  php version 7.4.3
 * @version 1.0.1-alpha 
 * @author Romeu Gomes de Sousa
 * @category PHP Simplified Framework - No OOP
 * @package BRASAP
 * @license GNU GPL 3.0 - Livre uso e Distribuição
 * @link https://brasap.com.br
 */

 /**
 * Realiza a saída com retorno de código de erro http
 * 
 * @param  $_msg   = Mensagem de Erro 
 * @param  $excode = Código de ERRO HTTP conforme tabela: 
 *                 https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Status
 * @return VOID - Gera um ERRO HTTP conforme especificado
 */
function _out($_msg, $excode = 200) 
{
    $_SESSION['rtStop'] = microtime(true);
    $time = $_SESSION['rtStop']-$_SESSION['rtStart'];
    $_SESSION['exec_time']="".round($time, '3')." - Segundos";
    $_SESSION['HTTP_ERRO']=$excode;
    $_SESSION['MENSAGEM']=$_msg;
    if (AMBIENTE == 'DEVELOPER') {
        http_response_code($excode);
        echo "<h3>$_msg</h3><pre><br>SESSION========================<br>";
        print_r($_SESSION);
        echo "<br>POST=========================<br>";
        print_r($_POST);
        echo "<br>GET=========================<br>";
        print_r($_GET);
        echo "<br>GET=========================<br>";
        print_r($_COOKIE);
        exit($excode);
    } else {
        echo "<center><h1>UM ERRO OCORREU!</h1><h2>UMA FALHA IMPEDIU A EXECUÇÃO DE SUA SOLICITAÇÃO, A MENSAGEM RETORNADA PELO SISTEMA FOI:<br>$_msg</h2></center>";
        exit($excode);
    }
}

/**
 * Faz a conexão com o BANCO DE DADOS PDO::MYSQL
 * 
 * @return POINTER - Ponteiro para a conexão do BD
 */
function conectDb() 
{
    global $db;
    try {
        $dbhost=SERVERDB;
        $dbname=DBNAME;
        $dbuser=DBUSER;
        $dbpass=DBPASSW;
        $db = new PDO(
            "mysql:host=$dbhost;dbname=$dbname;charset=utf8", 
            $dbuser,
            $dbpass
        );
    } catch (PDOException $e) {
        _out("ERRO! Banco de Dados: " . $e->getMessage(),503);
    }
    $r=SqlQuery("SET NAMES utf8");
    return $db;
}

/**
 * Realiza a saída com retorno de código de erro http
 * 
 * @param $perfil = string - nome da sessão de login
 * 
 * @return BOOLEAN = true se logado com o perfil, 
 *                 false se não logado ou com perfil diferente
 */  
function logado($perfil = 'LOGON GENERICO') 
{
    if ($_SESSION['login']!="$perfil") {
        _out('PERFIL DE LOGON ERRADO - REFAÇA SEU LOGIN', 200);
        return false;
    } else {
        $_SESSION['login']="$perfil";
        return true;
    }
}

/**
 * Realiza a saída com retorno de código de erro http
 * 
 * @param  $sql = String - Query SQL a ser executada
 * @param  $pr  = Array - Opcional, dos dados em PREPARE
 * @return POINTER = Ponteiro para os dados retornados
 *         FALSE   = Em caso de falha com a execução da query
 */
function sqlQuery($sql, array $pr = null) 
{
    global $db;
    $r=$db->prepare("$sql");
    if (!$r->execute($pr)) {
        $error= $r->errorInfo();
        if (AMBIENTE == 'DEVELOPER') {
            $erro="SQL ERRO:".$error[0].'-'.$error[1].'-'.$error[2];
        } else {
            $erro="SQL ERRO:".$error[1].'-'.$error[2];;
        }
        _out("$erro", 504);
        return false;
    };
    return $r;
}

/**
 * Realiza a saída com retorno de código de erro http
 * 
 * @param $tbl  = TABELA que contém os dados
 * @param $colu = COLUNA nome da coluna com o valor ENUM
 * @return ARRAY = Array com todos os valores possíveis
 */
function getenumval($tbl, $colu)
{
    global $db;
    $r=SqlQuery("SELECT SUBSTRING(COLUMN_TYPE,5) as v FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='thaila52_meet' AND TABLE_NAME='$tbl' AND COLUMN_NAME='$colu'");
    $l=$r->fetch(PDO::FETCH_ASSOC);
    $l=trim(trim($l['v'], "()"));
    $l=str_getcsv($l, ',', "'");
    foreach ($l as $k=>$v) {
        $m[$v]=$v;
    }
    asort($m);
    return $m;
}
  
?>