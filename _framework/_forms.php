<?php
/**
 * BRASAP FRAMEWORK START FILE
 * Funções para tratamento de FORMUlÁRIOS HTML
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
 * @param  $nome_campo   = String - nome e id do campo no html
 * @param  $valor        = String - valor pré-selecionado
 * @param  $lista_opcoes = Aray - Possiveis OPTIONS em pares CHAVE:VALOR
 * @param  $script       = String - Nome da função JAVASCRIPT para ser chamada no OnChange
 * @param  $class        = String - nome das CLASSES CSS que serão atribuidas
 * @return HTML = HTML do SELECT e OPTIONS gerado
 */
function mkSelect($nome_campo = 'nome', $valor=0, $lista_opcoes=array(), $script = '', $class=''){
    $rt="<select name='$nome_campo' id='id_$nome_campo' class='form-control custom-select $class' ";
    if ($script<>'') {
        $rt=$rt."onchange='$script();'";
    }
    $rt=$rt.">";
    foreach ($lista_opcoes as $k=>$v) {
        $rt=$rt."<option value='$k'";
        if ($k==$valor){ 
            $rt=$rt.'selected';
        }
        $rt=$rt.">".$v.'</option>';
    }
    $rt=$rt.'</select>';
    return $rt;
}

function mk_check($nome_campo = 'nome', $valor=array(), $lista_opcoes=array()){
  $n=0;
  foreach($lista_opcoes as $k=>$v){
    $n++;
    echo "<div class='check_block'><input type='checkbox' id='id_".$n."_$nome_campo' name='".$nome_campo."[]' value='$k'";
    foreach($valor as $v1=>$v2){
      if($k == $v2){
        echo ' checked ';
      }
    }
    echo ">";
    echo "<label for='id_".$n."_$nome_campo' class='custom-checkbox'>$v</label></div>";
  }
  return true;
}
