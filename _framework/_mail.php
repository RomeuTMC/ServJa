<?php
/**
 * BRASAP FRAMEWORK START FILE
 *  php version 7.4.3
 * 
 * @category BRASAP
 * @package  BRASAP/MailSender
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */

/**
 * Envia um email de um arquivo HTML estático
 * 
 * @param $email     = URL - email_do_destinatario
 * @param $assunto   = String - Assunto do email
 * @param $file_html = basename - nome de um arquivo do diretório de emails
 * 
 * @return BOOLEAN - true para enviado / false para falha
 */
function eMail($email, $assunto, $file_html)
{
    $header  = "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html; charset=utf-8\r\n";
    $header .= "From: ".EMAIL_FROM."\r\n";
    $html=file_get_contents(__DIR__."/_framework/_mailfile/$file_html");
    if (mail($email, $assunto, $html, $header, "-f ".EMAIL)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Envia um email com campos de um FORM/mensagem chave:valor
 * 
 * @param $email   = URL - email_do_destinatario
 * @param $assunto = String - Assunto do email
 * @param $dados   = Array - Conjunto de CHAVE/VALOR para os campos
 * 
 * @return BOOLEAN - true para enviado / false para falha
 */
function eMailMsg($email='Another User <anotheruser@example.com>', 
    $assunto = 'Assunto EMail', $dados=array()
) {
    $header  = "MIME-Version: 1.0\r\n"."Content-type: text/html; charset=utf-8\r\n".
               "From: ".EMAIL."\r\n";
    $mensagem='';
    foreach ($dados as $c=>$v) {
        $mensagem=$mensagem."$c : $v <br>";
    }
    $mensagem=$mensagem.'<br>Criado em:'.date('d/m/Y h:i:s').'<br><br>';
    if (mail($email, $assunto, $mensagem, $header, "-f ".EMAIL)) {
        return true;
    } else {
        return true;
    }
}