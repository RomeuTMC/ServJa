<?php
/**
 * BRASAP FRAMEWORK EXTERNAL API's
 *  php version 7.4.3
 * 
 * Funções para a ABSTRAÇÃO das CHAMADAS A API'S Externas, caso exista alguma
 *  necessidade de alteração a API externa, basta alterar todas as chamadas a
 *  esta, neste ponto, facilitando uma manutenção futura em caso de troca do
 *  fornecedor, ou alterações na forma que for feita a chamada.
 * 
 * @category PHP_SimplifiedFrameworkNoOOP
 * @package  BRASAP_FRAMEWORK
 * @author   Romeu Gomes de Sousa <romeugomes@gmail.com>
 * @license  GNU GPL 3.0 - Livre uso e Distribuição
 * @version  GIT:  
 * @link     https://brasap.com.br
 */

 /**
  * API DE GEOLOCALIZAÇÃO DA ABSTRACT
  *     https://app.abstractapi.com/
  * 
  * @param $ip = IP a ser consultado V4 ou V6
  * 
  * @return ARRAY - Geolocalização e Serialização da resposta
  */
function getIpGeolocation($ip = 'IP_V4 or IP_V6') 
{
    $apikey = '4fd521fbd1b94391b5917aea5a9b1a6d'; // MINHA CHAVE PARTICULAR DE ACESSO
    $ip = filter_var($ip, FILTER_VALIDATE_IP);
    $ch = curl_init(
        "https://ipgeolocation.abstractapi.com/v1/?api_key=$apikey&ip_address=$ip"
    );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($data,true);
    if(isset($data['country'])){
        $r['pais'] = $data['country'];
        $r['code'] = $data['country_code'];
        $r['cidade'] = $data['city'];
        $r['bandeira'] = $data['flag']['svg'];
        $r['moeda'] = $data['currency']['currency_code'];
        $r['data'] = $data;    
    } else {
        $r['pais'] = 'UNDEFINED';
        $r['code'] = '00';
        $r['cidade'] = 'UNDEFINED';
        $r['bandeira'] = URL.'/resources/imagens/flag-error.svg';
        $r['moeda'] = "UNDEFINED";
        $r['data'] = 'FALHA NA OBTENÇÃO DA CONSULTA';
    }
    if (curl_errno($ch)) {
        $r['error'] = curl_error($ch);
    } else {
        $r['error'] = 0; //sucesso
    }
    return $r;
}
?>