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

/**
 * Faz a conexão com o BANCO DE DADOS PDO::MYSQL
 *
 * @return POINTER - Ponteiro para a conexão do BD
 */
function conectDb()
{
    global $db;
    try {
        $dbhost = SERVERDB;
        $dbname = DBNAME;
        $dbuser = DBUSER;
        $dbpass = DBPASSW;
        $db = new PDO(
            "mysql:host=$dbhost;dbname=$dbname;charset=utf8",
            $dbuser,
            $dbpass
        );
    } catch (PDOException $e) {
        _out("ERRO! Banco de Dados: " . $e->getMessage(), 503);
    }
    $r = SqlQuery("SET NAMES utf8");
    return $db;
}

/**
 * Executa uma QUERY SELECT com ou sem PREPARE
 *
 * @param $sql = String - Query SQL a ser executada
 * @param $pr  = Array - Opcional, dos dados em PREPARE
 *
 * @return POINTER = Ponteiro para os dados retornados
 *         FALSE   = Em caso de falha com a execução da query
 */
function sqlQuery($sql, array $pr = null)
{
    global $db;
    $r = $db->prepare("$sql");
    if (!$r->execute($pr)) {
        $error = $r->errorInfo();
        if (AMBIENTE == 'DEVELOPER') {
            $erro = "SQL ERRO:" . $error[0] . '-' . $error[1] . '-' . $error[2];
        } else {
            $erro = "SQL ERRO:" . $error[1] . '-' . $error[2];
            ;
        }
        _out("$erro", 504);
        return false;
    };
    return $r;
}

/**
 * Realiza a consulta de valores válidos para campos salvos
 *  em um campo ENUM, para a criação de selects ou drops em geral
 *
 * @param $tbl   = TABELA que contém os dados
 * @param $colum = COLUNA nome da coluna com o valor ENUM
 *
 * @return ARRAY = Array com todos os valores possíveis
 */
function getenumval($tbl, $colum)
{
    global $db;
    $r = SqlQuery(
        "SELECT SUBSTRING(COLUMN_TYPE,5) as v 
        FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='" . DBNAME . "' 
        AND TABLE_NAME='$tbl' AND COLUMN_NAME='$colum'"
    );
    $l = $r->fetch(PDO::FETCH_ASSOC);
    $l = trim(trim($l['v'], "()"));
    $l = str_getcsv($l, ',', "'");
    foreach ($l as $k => $v) {
        $m[$v] = $v;
    }
    asort($m);
    return $m;
}

function sdate($datemysql = '1978-12-12 01:01:15')
{
    return date('d/m/Y', strtotime($datemysql));
}
