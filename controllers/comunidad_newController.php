<?php

# CONECTARSE A LA BASE DE DATOS USANDO PDO
require 'models/geographyPDO.php';
$geo = new GeographyPDO();

# CONECTARSE A LA BASE DE DATOS USANDO MySQL
// require 'models/geography.php';
// $geo = new Geography();

echo "<script> console.log('Controller Comunidades: Connection successful!'); </script>";

$name = $_POST['comunidad_new'];
$id = $geo->lastComunidad();

# NEW Comunidad
print_r($id);
$id ++;

$status = $geo->newComunidad($id,$name);
// print_r($data);

# PASAR LOS DATOS A LA VISTA COMUNIDADES
$data = $geo->getComunidades();
require 'views/comunidades.php';

?>