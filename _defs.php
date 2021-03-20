<?php
/**
 * BRASAP FRAMEWORK ARQUIVO DE DEFINIÇÔES DO USUARIO
 *  php version 7.4.3
 * 
 * @category PHP_SimplifiedFrameworkNoOOP
 * @package  BRASAP_DEFINITIONS
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */

// Define as CONSTANTES DE PARAMETRIZAÇÃO 
define("SISTEMA", 'ServJa - Portal de Serviços');
define("VERSAO", "Versão 1.0"); // VERSÃO DO SISTEMA 
define( 
    "COPYRIGHT", "Copyright Romeu Gomes de Sousa - ".
    "Brasap Sistemas - 11/2020 - ".date('m/Y').' - '.
    "Livre Uso e Distribução, se citada a fonte." 
); 
define("URL", "http://127.0.0.1/ServJa/"); //URL da RAIZ do SISTEMA 
define("_FS", "/DRIVE/SITES/ServJa/");
define("EMAIL", "contato@brasap.com.br"); //Email do Servidor/Administrador 
define("EMAIL_FROM", SISTEMA." <".EMAIL.">"); 
define("SERVERDB", "127.0.0.1"); 
define("DBNAME", "brasap_servja"); 
define("DBUSER", "brasap_servja"); 
define("DBPASSW", "Romeu27928214-x"); 
define("SNAME", "SERVJA"); //nome do serviço ou api 
define(
    "USER", md5(
        $_SERVER['REMOTE_ADDR'].
        $_SERVER['HTTP_USER_AGENT']
    )
); //hash do ip/navegador do usuario 
define("SSID", SNAME.USER); //sessao especifica do usuario para os cookies 
define("AMBIENTE", "DEVELOPER"); //DEVELOPER, HOMOLOG, PRODUCTION 
// Define as diretrizes de INICIALIZAÇÃO DO AMBIENTE DO SERVIDOR 
date_default_timezone_set('America/Sao_Paulo'); 
$cookieParams['lifetime'] = 0; 
$cookieParams['domain'] = URL; 
$cookieParams['secure'] = true; 
$cookieParams['httponly'] = true; 
$cookieParams['samesite'] = "Lax"; 
//session_set_cookie_params($cookieParams); 
if (AMBIENTE == 'DEVELOPER') { 
    error_reporting(E_ALL); 
    ini_set("display_startup_errors", true);
    ini_set("display_errors", true);
    ini_set("ignore_repeated_errors", true);
    ini_set("error_log", _FS."_ERROS_DEV.LOG");
    ini_set("track_errors", true);
} elseif (AMBIENTE == 'HOMOLOG') {
    error_reporting(E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR);
    ini_set("display_startup_errors", false);
    ini_set("display_errors", true);
    ini_set("ignore_repeated_errors", true);
    ini_set("error_log", _FS."_ERROS_HOM.LOG");
    ini_set("track_errors", false);
} else {
    error_reporting(E_ERROR);
    ini_set("display_startup_errors", false);
    ini_set("display_errors", false);
    ini_set("ignore_repeated_errors", false);
    ini_set("error_log", _FS."_ERROS_PRO.LOG");
    ini_set("track_errors", false);
} 
session_name(SSID); 
ini_set("log_errors", true);
ini_set("default_charset", "UTF-8"); 
ini_set("sendmail_from", EMAIL);
?>