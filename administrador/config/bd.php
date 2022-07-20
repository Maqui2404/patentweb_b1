<?php
$host="localhost";
$bd="id19299328_patentweb";
$usuario="id19299328_root";
$contrasenia="eVmKU5Rz=MA6jJ#@";

try {
    $conexion=new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);

} catch (Exception $ex){

    echo $ex->getMessage();
}
?>