<?php
echo "Algoritmos Disponíveis e Valores de exemplo<br><pre>";
foreach(hash_algos() as $k=>$v){
    echo "=> ".$v.var_dump(hash($v, "10203040"))."<br>";
}
echo "<br>======= PASSWORD HASH =======<br>";
$senha = "xoxotaGostosa";
$pass = password_hash($senha, PASSWORD_DEFAULT);
echo "Passrord: ".$pass."<br>";
if (password_verify($senha, $pass)) {
    echo 'Senha OK!<br>';
}
echo "<br>======= PASSWORD HASH =======<br>";
for($i=1; $i<10; $i++) {
    echo password_hash($senha, PASSWORD_DEFAULT)."<br>";
}
echo "</pre><br>";