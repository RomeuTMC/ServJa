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

// Define as CONSTANTES DE PARAMETRIZAÇÃO
define("SISTEMA", 'ServJa - Portal de Serviços'); 
define("VERSAO", "Versão 1.0"); // VERSÃO DO SISTEMA
define(
    "COPYRIGHT", 
    "Copyright Romeu Gomes de Sousa - ".
    "Brasap Sistemas - 11/2020 - ".
    "Livre Uso e Distribução, se citada a fonte."
);
define("URL", "https://servja.brasap.com.br"); //URL da RAIZ do SISTEMA
define("EMAIL", "contato@brasap.com.br"); //Email do Servidor/Administrador
define("EMAIL_FROM", SISTEMA." <".EMAIL.">");
define("SERVERDB", "127.0.0.1");
define("DBNAME", "");
define("DBUSER", "");
define("DBPASSW", "");
define("SNAME", "SERVJA");
define("USER", md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));
define("SSID", SNAME.USER);
define("AMBIENTE", "DEVELOPER"); //DEVELOPER, HOMOLOG, PRODUCTION

// Define as diretrizes de INICIALIZAÇÃO
ini_set("session.name", SSID);
date_default_timezone_set('America/Sao_Paulo');
$cookieParams['lifetime'] = 0;
$cookieParams['domain'] = URL;
$cookieParams['secure'] = true;
$cookieParams['httponly'] = true;
$cookieParams['samesite'] = "Lax";
session_set_cookie_params($cookieParams);
session_name(SSID);
session_start();
error_reporting(E_ALL);
ini_set("display_startup_errors", true);
ini_set("default_charset", "UTF-8");
ini_set("sendmail_from", EMAIL);
ini_set("display_errors", true);
?>