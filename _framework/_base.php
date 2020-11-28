<?php
/**
 * BRASAP FRAMEWORK START FILE
 * Funções principais, necessárias para o funcionamento do BRASAP FRAMEWORK
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
 * @param $text = Texto que sera transformado em SLUG
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