<?php

$username = $_POST['usuario'];
$password = $_POST['password'];

$usuarios = ['usuario1', 'usuario2', 'usuario3', 'usuario4', 'usuario5'];
$passwords = ['usuario1', 'usuario2', 'usuario3', 'usuario4', 'usuario5'];

$bd = array_combine($usuarios, $passwords);
$flag = 0;

if (array_key_exists($username, $bd)) {
    $flag = 1;
    $passBD = $bd[$username];
}

if($password == $passBD){
    $flag = 2;
}


if ($flag == 1 || $flag == 0){
    header('Location: index.php?error');
}
else{
    header('Location: menu.php?usuario='.$_POST['usuario']);
}