<?php
/**
 * BRASAP FRAMEWORK - BASE FUNCTIONS
 *  php version 7.4.3
 * 
 * @category BRASAP/FrameBase
 * @package  BRASAP
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */

/**
 * Realiza a saída com retorno de código de erro http
 * 
 * @param $_msg   = Mensagem de Erro 
 * @param $excode = Código de ERRO HTTP conforme tabela: 
 *                https://developer.mozilla.org/pt-BR/docs/Web/HTTP/Status
 * 
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
        echo "<center><h1>UM ERRO OCORREU!</h1><h2>".
             "UMA FALHA IMPEDIU A EXECUÇÃO DE SUA SOLICITAÇÃO, ".
             "A MENSAGEM RETORNADA PELO SISTEMA FOI:<br>$_msg</h2></center>";
        exit($excode);
    }
    return 0;
}

/**
 * Verifica se a SESSÃO está LOGADA com o perfil correto
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
 * Converte uma String de Texto no padrão SLUG URL
 * 
 * @param $text = Texto que sera transformado em SLUG
 * 
 * @return STRING = Texto com os caracteres no formato SLUG para URL
 */
function slug($text)
{
    // replace não letras ou digitos por -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    // transliterate
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    // remove Caracteres Inválidos
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    // remove duplicidades de replace
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text); 
    if (empty($text)) {
        // retorna n-a nome vazio
        return 'n-a';
    }
    // retorna TEXTO em formato SLUG
    return $text; 
}
?>