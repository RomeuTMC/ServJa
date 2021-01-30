<?php
/**
 * BRASAP FRAMEWORK - HTML FORM FUNCTIONS
 *  php version 7.4.3
 * 
 * @category BRASAP
 * @package  BRASAP/FormsHtml
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */

/**
 * Cria um campo SELECT para um FORM HTML
 * 
 * @param $label  = String - Descrição do Campo
 * @param $name   = String - nome e id do campo no html
 * @param $valor  = String - valor pré-selecionado
 * @param $opcoes = Aray - Possiveis OPTIONS em pares CHAVE:VALOR
 * @param $script = String - Nome da função JAVASCRIPT para ser chamada no OnChange
 * @param $class  = String - nome das CLASSES CSS que serão atribuidas
 * 
 * @return HTML = HTML do SELECT e OPTIONS gerado
 */
function mkSelect( $label= 'Label', $name = 'nome', $valor=0,
    $opcoes=array(), $script = '', $class=''
) {
    $rt="<div class=\"form-group\">
    <label for=\"id_$name\">$label</label>
    <select name='$name' id='id_$name' class='form-control $class' ";
    if ($script<>'') {
        $rt=$rt."onchange='$script();'";
    }
    $rt=$rt.">";
    foreach ($opcoes as $k=>$v) {
        $rt=$rt."<option value='$k'";
        if ($k==$valor) { 
            $rt=$rt.'selected';
        }
        $rt=$rt.">".$v.'</option>';
    }
    $rt=$rt.'</select></div>';
    return $rt;
}

/**
 * Cria um campo CHECKBOX para o FORM HTML
 * 
 * @param $label  = String - Descrição do Campo
 * @param $name   = String - nome e id do campo no html
 * @param $valor  = String - valor pré-selecionado
 * @param $opcoes = Aray - Possiveis OPTIONS em pares CHAVE:VALOR
 * @param $script = String - Nome da função JAVASCRIPT para ser chamada no OnChange
 * @param $class  = String - nome das CLASSES CSS que serão atribuidas
 *  
 * @return HTML = HTML do CHECKBOX gerado
 */
function mkCheck($label = 'Label', $name = 'nome', $valor=array(), 
    $opcoes=array(), $script = '', $class=''
) {
    $n=0;
    $rt="<div class=\"form-group\">
        <label for=\"id_$name\">$label</label>";
    foreach ($opcoes as $k=>$v) {
        $n++;
        $rt=$rt."<div class='check_block'><input type='checkbox' id='id_".
                $n."_$name' name='".$name."[]' value='$k'";
        foreach ($valor as $v1=>$v2) {
            if ($k == $v2) {
                $rt=$rt.' checked ';
            }
        }
        $rt=$rt.">";
        $rt=$rt."<label for='id_".
            $n."_$name' class='form-control $class'>$v</label></div>";
    }
    return true;
}
