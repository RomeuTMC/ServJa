<?php
/**
 * BRASAP FRAMEWORK START FILE
 *  php version 7.4.3
 * 
 * @category PHP_SimplifiedFrameworkNoOOP
 * @package  BRASAP_FRAMEWORK
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */
require_once __DIR__.'/_defs.php'; //Definições do sistema e ambiente
require_once __DIR__.'/_load.php'; //Load do FRAMEWORK e funções sobre demanda
require_once __DIR__.'/_startup.php'; // Inicialização sessão/autenticação/validação
// Executa o load do CONTROL requisitado pela URL
if (file_exists(__DIR__."/_controls/_".$route[0]."_control.php")) {
    include_once __DIR__."/_controls/_".$route[0]."_control.php";
} else {
    if (AMBIENTE == 'DEVELOPER') {
        _out("_".$route[0]."_control.php", 200);
    } else {
        $route[1] = '404';
        include_once __DIR__."/_controls/_main_control.php";
    }
}
// se o CONTROL não criou um redirecionamento, monta a estrutura base,
// importando os JAVASCRIPTS e CSS do Jquery/Bootstrap e outras
// bibliotecas de código disponíveis em repositórios
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" 
            content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="google-site-verification" 
            content="lwhjBq1Newn4vJWEU1Lx_0zaKWPWd4GlgDgg8PpPgL8" />
        <?php require_once "_dependencies.php"; ?>
        <title><?php echo $_SESSION['title']; ?></title>
    </head>

    <body data-spy="scroll" data-target=".navbar" data-offset="170">
        <header>
        <div id="loader" style="display: block;"><h1 class='loadertitle text-center display-1'>CARREGANDO</h1></div>
        <script>
            //Cria o SPINNER para fazer a tela de LOADING antes das chamadas AJAX
            var spinner = $('#loader');
            spinner.hide();
       
            // cria a função para mostrar as mensagens de erro 
            // de usuário geradas no PHP
            var error_no = <?php 
            if (isset($_SESSION['erro_no'])) {
                echo $_SESSION['erro_no']; 
            } else {
                echo "0" ;
            }
            ?>;
            if(error_no==1){ sTitulo='SUCESSO !'; sIcon='success'; }
            else if(error_no==2){ sTitulo='ERRO !';  sIcon='error';}
            else if(error_no==3){ sTitulo='ATENÇÃO !';  sIcon='warning';}
            else if(error_no==4){ sTitulo='INFORMAÇÃO !'; sIcon='info'; }
            else if(error_no==5){ sTitulo='QUESTÃO !'; sIcon='question'; }
            else { error_no=0; sTitulo=''; sIcon=''; }
            var sMens = '<?php 
            if (isset($_SESSION['erro'])) {
                echo $_SESSION['erro']; 
            } else {
                echo " " ;
            }
            unset($_SESSION['erro_no']);
            unset($_SESSION['erro']);
            ?>';
                if (error_no>0) {
                    Swal.fire({
                        title: sTitulo,
                        html: sMens,
                        icon: sIcon,
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'Fechar'
                    })
                }
            </script>
        </header>
        <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <?php require "_menu.php"; ?>
        </nav>
        <section>
            <div class='main'>
                <?php
                //INCLUI CONFORME A CHAMADA DO ROTEAMENTO
                if (file_exists(
                    __DIR__."/_views/_".$route[0].
                    '/_'.$_SESSION['view']."_view.php"
                )
                ) {
                    include_once __DIR__."/_views/_".$route[0].'/_'.
                                $_SESSION['view']."_view.php";
                } else {
                    if (AMBIENTE == 'DEVELOPER') {
                        echo "VIEW INEXISTENTE->/_".$route[0].'/_'.
                            $_SESSION['view']."_view.php";
                    } else {
                        include_once __DIR__."/_views/_main/_index_"."_view.php";
                    }
                }
                ?>
            </div>
        </section>
        <footer>
        </footer>
    </body>
</html>
<?php
    // Finaliza o script fechando as conexões e dando a saida do DEBUG
    require __DIR__."/_footer.php"; 
?>