<?php
/**
 * BRASAP FRAMEWORK - BASE FUNCTIONS - CORE DO FRAMEWORK
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
    $_SESSION['memoryStop'] = "MEMORY USAGE: ".
        number_format((memory_get_usage(false)/1000), 2)."Kb / ".
        number_format((memory_get_usage(true)/1000000), 2)."Mb;";
    $_SESSION['exec_time']="".round($time, '3')." - Segundos";
    $_SESSION['HTTP_ERRO']=$excode;
    $_SESSION['MENSAGEM']=$_msg;
    error_log(date('Y-m-d h:i:s')." $_msg - $excode\n", 3, _FS.'/_ERROS_OUT.LOG');
    if (AMBIENTE == 'DEVELOPER') {
        http_response_code($excode);
        echo "<h3>$_msg</h3>";
        echo "<h4>Request Method:".$_SERVER['REQUEST_METHOD']."</h4>";
        echo "<h4>MEMORY USAGE: ".number_format((memory_get_usage(false)/1000), 2).
            "Kb / ".number_format((memory_get_usage(true)/1000000), 2)."Mb</h4>";
        echo "<pre><br>SESSION=================<br>";
        print_r($_SESSION);
        echo "<br>POST=========================<br>";
        print_r($_POST);
        echo "<br>GET=========================<br>";
        print_r($_GET);
        echo "<br>FILES=======================<br>";
        print_r($_FILES);
        echo "<br>COOKIE======================<br>";
        print_r($_COOKIE);
        echo "<br>SERVER======================<br>";
        print_r($_SERVER);
        echo "<br>REQUEST=====================<br>";
        print_r($_REQUEST);
        echo "<br>ENV=========================<br>";
        print_r($_ENV);
        echo "<br>LAST ERROR =================<br>";
        if (isset($php_errormsg)) {
            print_r($php_errormsg);
        } else {
            echo "NO ERROR MESSAGE";
        }
        exit($excode);
    } else {
        if ($excode!=200) {
            echo "<center><h1>UM ERRO OCORREU!</h1><h2>".
            "UMA FALHA IMPEDIU A EXECUÇÃO DE SUA SOLICITAÇÃO, ".
            "A MENSAGEM RETORNADA PELO SISTEMA FOI:<br>$_msg</h2></center>";
        }
        exit($excode);
    }
    return 0;
}

/**
 * Verifica se a SESSÃO está LOGADA com o perfil correto
 * 
 * @return BOOLEAN = true se logado com o perfil, 
 *                 false se não logado ou com perfil diferente
 */  
function logado() 
{
    if (!isset($_SESSION['logado'])) {
        return 0;
    } else {
        return $_SESSION['logado'];
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

/**
 * Cria um Array de menu de acesso para o usuário/perfil vigente
 *
 * @param Integer $id_pai Identificador para o menu_pai (se rescursivo)
 * 
 * @return Array Menus/Submenus que o usuário tem acesso
 **/
function menu($id_pai = 0)
{
    $menu=array();
    $perfil = logado();
    $sql = "SELECT id, menu, endpoint, descricao, icone FROM permissoes_acesso 
        WHERE id_pai='$id_pai' and perfis LIKE '%$perfil,%' order by ordem";
    $rs = sqlQuery($sql);
    while ($r = $rs->fetch(PDO::FETCH_ASSOC)) {
        $menu[$r['id']]=$r;
        $sql = "SELECT count(id) as filhos FROM permissoes_acesso
            WHERE id_pai=".$r['id']." and perfis LIKE '%$perfil,%'";
        $rf = sqlQuery($sql);
        $filhos = $rf->fetch(PDO::FETCH_ASSOC);
        if ($filhos['filhos']>=1) {
            $menu[$r['id']]['filhos'] = 1;
        } else {
            $menu[$r['id']]['filhos'] = 0;
        }
    }
    return $menu;
}

/**
 * Cria um Array de menu de acesso para o usuário/perfil vigente
 *
 * @param Integer $id_pai  Identificador para o menu_pai (se rescursivo)
 * @param String  $submenu Classe para um submenu
 * 
 * @return Array Menus/Submenus que o usuário tem acesso
 **/
function submenu($id_pai = 0, $submenu = ' ')
{
    echo "<ul class='$submenu dropdown-menu'>";
    $perfil = logado();
    $sql = "SELECT id, menu, endpoint, descricao, icone FROM permissoes_acesso 
        WHERE id_pai='$id_pai' and perfis LIKE '%$perfil,%' order by ordem";
    $rs = sqlQuery($sql);
    while ($r = $rs->fetch(PDO::FETCH_ASSOC)) {
        $sql = "SELECT count(id) as filhos FROM permissoes_acesso 
                WHERE id_pai='".$r['id']."' and perfis LIKE '%$perfil,%'
                order by ordem";
        $rf = sqlQuery($sql);
        $filhos = $rf->fetch(PDO::FETCH_ASSOC);
        if ($filhos['filhos']>0) {
            echo "<li><a class='dropdown-item' href='".URL.$r['endpoint']."'> 
            <i  class='".$r['icone']."'></i> ".$r['menu'].
            "&emsp;&emsp;&emsp;&emsp;<i class='fas fa-caret-right'></i> </a>";
            submenu($r['id'], 'submenu');
        } else {
            echo "<li><a class='dropdown-item' href='".URL.$r['endpoint']."'> 
            <i  class='".$r['icone']."'></i> ".$r['menu']."</a></li>";
        }
        echo "</li>";
    }
    echo "</ul>";
    return true;
}