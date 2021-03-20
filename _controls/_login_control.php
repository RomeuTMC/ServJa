<?php
/**
 * BRASAP FRAMEWORK LOGIN_CONTROL
 *  Controle de login e sessão de usuários
 *  php version 7.4.3
 * 
 * @category PHP_SimplifiedFrameworkNoOOP
 * @package  BRASAP_LOGIN
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */
switch ($route[1]) {
case 'login':
    //se usuário requisitou a tela LOGIN
    if ($_SESSION['logado']<>'0') {
        // SE EXISTE UM PERFIL LOGADO, MOSTRA O MINHA CONTA E NÃO FAZ LOGIN
        $_SESSION['title'] = SISTEMA.' - Minha Conta';
        $_SESSION['view']='minhaconta';
        $_SESSION['erro_no'] = 3;
        $_SESSION['erro'] = 'Usuário já logado, faça LOGOFF para saír.';
        return;
    } 
    if (isset($_POST['login']) && isset($_POST['passw'])) {
        // se as variáveis foram preenchidas, vamos recebe-las e buscar no SQL
        $pr['email'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
        $passw = filter_input(INPUT_POST, 'passw', FILTER_DEFAULT);
        $sql = "SELECT * from usuarios_login where email = :email limit 1";
        $rs = sqlQuery($sql, $pr);
        $r = $rs->fetch(PDO::FETCH_ASSOC);
        if ($rs->rowCount()==0) {
            // SE NÃO ACHOU EMAIL, MOSTRA ERRO DE USUÁRIO INVÁLIDO, DANDO SLEEP
            // PARA RETARDAR AS TENTATIVAS DE FORÇA BRUTA
            $_SESSION['logado'] = '0';
            $_SESSION['view'] = 'login';
            $_SESSION['title'] = SISTEMA.' - LOGIN';
            $_SESSION['erro_no'] = ERRO;
            $_SESSION['erro'] = 'USUÁRIO OU SENHA INVÁLIDOS OU NÃO CADASTRADOS';
            sleep(rand(3, 7)); //Pausa entre 3 e 6 segundos
            return;
        } else {
            // SE EXISTE O CADASTRO, VERIFICA A SENHA
            if (!password_verify($passw, $r['password'])) {
                //PASSWORD INVÁLIDO, PARA TEMPO MAIOR, E DEVOLVE O ERRO DE LOGIN
                $_SESSION['logado'] = '0';
                $_SESSION['view'] = 'login';
                $_SESSION['title'] = SISTEMA.' - LOGIN';
                $_SESSION['erro_no'] = ERRO;
                $_SESSION['erro'] = 'SENHA INVÁLIDA';
                sleep(rand(5, 10)); //Pausa entre 5 e 10 segundos
                return;
            } else {
                //LOGIN EFETUADO, CONTINUE PARA VERIFICAR OS BLOQUEIOS OU LIBERE
                $_SESSION['logado'] = $r['id_perfil'];
                $_SESSION['view'] = 'minhaconta';
                $_SESSION['title'] = SISTEMA.' - Minha Conta';
                $_SESSION['erro_no'] = SUCESSO;
                $_SESSION['erro'] = 'LOGIN EFETUADO COM SUCESSO!';
                break; //CONTINUA O LAÇO PARA VERIFICAR OS BLOQUEIOS
            }
        }
    } else {
        //se variáveis não existem, abre a view da tela de login
        $_SESSION['logado'] = '0';
        $_SESSION['view'] = 'login';
        $_SESSION['title'] = SISTEMA.' - LOGIN';
        return;
    }
    break;
case 'logout':
    // se requisitou a tela de LOGOUT
    session_destroy();
    session_start();
    $_SESSION['logado'] = 0;
    $_SESSION['userid'] = 0;
    $_SESSION['view'] = 'login';
    $_SESSION['title'] = SISTEMA.' - LOGIN';
    $_SESSION['erro_no'] = SUCESSO;
    $_SESSION['erro'] = 'LOGOUT EFETUADO COM SUCESSO!';
    return;
case 'minhaconta':
    // se requisitou a tela de MINHA CONTA, VERIFICA SE LOGADO E LIBERA
    if ($_SESSION['logado'] <> '0') {
        $_SESSION['view']='minhaconta';
        return;
    } else {
        $_SESSION['view']='login';
        $_SESSION['title'] = SISTEMA.' - LOGIN';
        return;
    }
case 'cadastro':
    // se chamou a tela de CADASTRO, verifica se não está logado e libera
    if ($_SESSION['logado'] != '0') {
        $_SESSION['view']='minhaconta';
        $_SESSION['erro_no'] = ALERT;
        $_SESSION['erro'] = 'Você já está logado no sistema!';
        return;
    } else {
        $data=array(
            'NOME'=>'',
            'LOGIN'=>'',
            'PASSW'=>''
        );
        $_SESSION['title'] = SISTEMA.' - CRIE SUA CONTA';
        $_SESSION['view']='criaconta';
        return;
    }
case 'criaconta':
    // se cadastro preenchido e enviado, vamos processar os dados
    $data=array(
        'NOME'=>'',
        'LOGIN'=>'',
        'PASSW'=>''
    );
    if ($_SESSION['logado'] != '0') {
        $_SESSION['view']='minhaconta';
        $_SESSION['erro_no'] = ALERT;
        $_SESSION['erro'] = 'Você já está logado no sistema!';
        return;
    }
    if (!isset($_POST['nome']) 
        || !isset($_POST['login']) 
        || !isset($_POST['passw'])
    ) {
        $_SESSION['view']='criaconta';
        $_SESSION['erro_no'] = ALERT;
        $_SESSION['erro'] = 'Dados Obrigatórios Não Preenchidos,'.
            ' preencha todos os campos marcados!';
        return;
    }
    $pr['nome'] = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $pr['login'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_EMAIL);
    $pr['passw'] = filter_input(INPUT_POST, 'passw', FILTER_DEFAULT);
    $data=array(
        'NOME'=>$pr['nome'],
        'LOGIN'=>$pr['login'],
        'PASSW'=>$pr['passw']
    );
    if (strlen($pr['passw'])<8 || strlen($pr['passw'])>15) {
        $_SESSION['view']='criaconta';
        $_SESSION['erro_no'] = ALERT;
        $_SESSION['erro'] = 'Password - Deve ter no mínimo 8 caracteres e no máximo 15';
        return;
    }
    if (preg_match('~[0-9]~', $pr['passw']) == 0) {
        $_SESSION['view']='criaconta';
        $_SESSION['erro_no'] = ALERT;
        $_SESSION['erro'] = 'Password - Deve conter no mínimo 1 caractere numérico!';
        return;
    }
    if (preg_match('~[A-Z]~', $pr['passw']) == 0) {
        $_SESSION['view']='criaconta';
        $_SESSION['erro_no'] = ALERT;
        $_SESSION['erro'] = 'Password - Deve conter pelo menos 1 caractere MAIUSCULO!';
        return;
    }
    if (preg_match('~[a-z]~', $pr['passw']) == 0) {
        $_SESSION['view']='criaconta';
        $_SESSION['erro_no'] = ALERT;
        $_SESSION['erro'] = 'Password - Deve conter pelo menos 1 caractere minusculo!';
        return;
    }
    $sql = "SELECT id from usuarios_login where email = {$pr['login']}";
    $rs = sqlQuery($sql);
    if ($rs->rowCount()==0) {
        $_SESSION['view']='criaconta';
        $_SESSION['erro_no'] = ALERT;
        $_SESSION['erro'] = 'LOGIN - Este E-Mail já está cadastrado, por favor, utilize outro!';
        return;
    }
    
default:
    //se não encontrou o método chamado, direciona para o 404
    $_SESSION['title'] = SISTEMA.' - PAGINA NÃO ENCONTRADA';
    header("Location: ".URL."main/404");
    return false;
}
/*  
 * Neste ponto, fazemos as checagens para verificação avançada de login, e LOGs de
 *    acesso, controle de bloqueios administrativos e verificações de pagamento, se
 *    for necessário.
 */
if ($r['ativado']=='0') {
    $_SESSION['logado'] = '0';
    $_SESSION['view'] = 'login';
    $_SESSION['title'] = SISTEMA.' - LOGIN';
    $_SESSION['erro_no'] = ALERT;
    $_SESSION['erro'] = 'SEU E-MAIL NÃO FOI VALIDADO, '.
                        '<a href="'.URL.'/login/valida/'.(int)$r['id'].
                        '">NESTE LINK</a> PARA RE-ENVIAR O EMAIL DE VALIDAÇÃO';
    return;
}
if ($r['bloqueio_geral']!='0') {
    //SE POSSUI, DEVOLVE A MENSAGEM DE BLOQUEIO CADASTRADA
    $_SESSION['logado'] = '0';
    $_SESSION['view'] = 'login';
    $_SESSION['title'] = SISTEMA.' - LOGIN';
    if ($r['bloqueio_geral']>5) {
        $_SESSION['erro_no'] = INFO;
    } else {
        $_SESSION['erro_no'] = $r['bloqueio_geral'];
    }
    $_SESSION['erro'] = $r['bloqueio_mensagem'];
    return;
}
$_SESSION['usuario']=$r['nome'];
$_SESSION['userid']=(int)$r['id'];
$_SESSION['erro_no']=SUCESSO;
$_SESSION['erro']='Olá, <b class="text-primary">'.$r['nome'].
    '</b><br>LOGIN efetuado Com Sucesso!';
if (isset($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (isset($_SERVER['REMOTE_ADDR'])) {
    $ip = $_SERVER['REMOTE_ADDR'];
} else {
    $ip = '127.0.0.1'; //IP LOCALHOST PARA CASO DE FALHA
}
$ip = filter_var($ip, FILTER_VALIDATE_IP);
$geo=getIpGeolocation($ip);
if ($geo['error']!=0) {
    error_log(
        "ERRO NA OBTENÇÃO DO GeoIp - IP:{$ip} - Erro: {$geo['error']}",
        3, '_ERROS_USER.LOG'
    );
}
unset($pr);
$pr['ip_acesso'] = $ip;
$pr['ip_country'] = $geo['code'];
$pr['details_login'] = serialize($geo['data']);
$pr['data_login'] = date('Y-m-d h:i:s');
$pr['userid'] = (int)$r['id'];
$sql = "UPDATE usuarios_login SET ip_acesso = :ip_acesso, 
        ip_country = :ip_country,
        details_login = :details_login, data_login = :data_login 
    where id = :userid limit 1";
$rs = sqlQuery($sql, $pr);
$_SESSION['view'] = 'minhaconta';
$_SESSION['title'] = SISTEMA.' - Minha Conta';