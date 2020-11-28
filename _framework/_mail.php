<?php
function eMail($email,$assunto,$file_html){
  $h  = "MIME-Version: 1.0\r\n";
  $h .= "Content-type: text/html; charset=utf-8\r\n";
  $h .= "From: ".EMAIL_FROM."\r\n";
  $html=file_get_contents(_FS."msgs/$file_html");
  if (mail($email, $assunto, $html, $h, "-f ".EMAIL)){
    return TRUE;
  } else {
    return FALSE;
  }
}

function eMailMsg($from='Another User <anotheruser@example.com>',$to='Another User <anotheruser@example.com>',$assunto = 'Assunto EMail',$msg=array()){
  $h  = "MIME-Version: 1.0\r\n"."Content-type: text/html; charset=utf-8\r\n"."From: ".$from."\r\n";
  $msge='';
  foreach($msg as $c=>$v){
    $msge="$msge $c : $v <br>";
  }
  $msge=$msge.'<br>Criado em:'.date('d/m/Y h:i:s').'<br><br>';
  if (mail($to, $assunto, $msge, $h, "-f ".$from)){
    return TRUE;
  } else {
    return FALSE;
  }
}