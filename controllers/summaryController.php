<?php

# CONECTARSE A LA BASE DE DATOS
require 'models/geography.php';
$geo = new Geography();

echo "<script> console.log('Controller Provincias: Connection successful!'); </script>";

# CONSULTAR LAS PROVINCIAS
# TODO: Check POST exits or die
$id = $_POST['municipios'];
print_r($id);
 echo "<br>";
$data = $geo->getSummary($id);
print_r($data);

# PASAR LOS DATOS A LA VISTA COMUNIDADES
require 'views/summary.php';

?>