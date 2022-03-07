<?php

class Geography {

    private $mysqli;

    function __construct(){

        $this->mysqli = new mysqli('localhost', 'root', '', 'geografia2');

        if ($this->mysqli->connect_errno){

            echo "<script> console.log('Error connecting to server, $this->mysqli->connect_errno: $this->mysqli->connect_error'); </script>";

            die(); 
        
        }

        echo "<script> console.log('Succesfully connected to the server'); </script>";


        if (!$this->mysqli->set_charset("utf8")) { //Comprovar si la connexió es troba en utf-8 (Per a no liarla)

            echo "<script> console.log('Error loading character set utf8: %s\n, $this->mysqli->error'); </script>";

            die();

        }

    }

    public function getComunidades() {
        $sql = "SELECT nombre, id_comunidad FROM comunidades";

        $res = $this->mysqli->query($sql);

        if (!$res) {
            echo "<script> console.log('Result set is null: no data available'); </script>";
        }

        $rows = $res->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }

    public function getProvincias($id) {
        $sql = "SELECT nombre, n_provincia FROM provincias WHERE id_comunidad =  $id";

        $res = $this->mysqli->query($sql);

        if (!$res) {
            echo "<script> console.log('Result set is null: no data available'); </script>";
        }

        $rows = $res->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }

    public function getMunicipios($id) {
        $sql = "SELECT municipio, id FROM municipios WHERE provincia_id = $id";

        $res = $this->mysqli->query($sql);

        if (!$res) {
            echo "<script> console.log('Result set is null: no data available'); </script>";
        }

        $rows = $res->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }

    public function getSummary($id) {
        $sql = "SELECT c.comunidad AS comunidad, p.provincia AS provincia, m.municipio AS municipios, m.latitud AS latitud, m.longitud AS longitud
                FROM comunidades c JOIN provincias p ON c.id = p.comunidad_id
                JOIN municipios m ON p.id = m.provincia_id
                WHERE m.id = $id;";

        $res = $this->mysqli->query($sql);

        if (!$res) {
            echo "<script> console.log('Result set is null: no data available'); </script>";
        }

        $rows = $res->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }


}

?>