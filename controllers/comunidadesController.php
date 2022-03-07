<?php

# CONECTARSE A LA BASE DE DATOS
require 'models/geography.php';
$geo = new Geography();

echo "<script> console.log('Controller Comunidades: Connection successful!'); </script>";

# CONSULTAR LAS COMUNIDADES
# [[1, Aragon]]
$data = $geo->getComunidades();
print_r($data);

# PASAR LOS DATOS A LA VISTA COMUNIDADES
require 'views/comunidades.php';

?>