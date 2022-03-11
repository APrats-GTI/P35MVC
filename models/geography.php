<?php

class Geography {

    private $mysqli;

    function __construct(){

        $this->mysqli = new mysqli('localhost', 'root', '', 'geografia');

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
        $sql = "SELECT nombre, id_localidad FROM localidades WHERE n_provincia = $id";

        $res = $this->mysqli->query($sql);

        if (!$res) {
            echo "<script> console.log('Result set is null: no data available'); </script>";
        }

        $rows = $res->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }

    public function getSummary($id) {
        $sql = "SELECT c.nombre AS comunidad, p.nombre AS provincia, l.nombre AS localidad
                FROM comunidades c JOIN provincias p ON c.id_comunidad = p.id_comunidad
                JOIN localidades l ON p.n_provincia = l.n_provincia
                WHERE l.id_Localidad = $id;";

        $res = $this->mysqli->query($sql);

        if (!$res) {
            echo "<script> console.log('Result set is null: no data available'); </script>";
        }

        $rows = $res->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }


    public function  lastComunidad() {
        $sql = "SELECT MAX(id_comunidad) as max FROM comunidades";

        $res = $this->mysqli->query($sql);

        if (!$res) {
            echo "<script> console.log('Result set is null: no data available'); </script>";
        }

        $row = $res->fetch_all(MYSQLI_ASSOC);

        // print_r($row);
        // echo $row[0]['max'];

        return $row[0]['max'];
    }


    public function  newComunidad($id,$name) {
        $sql = "INSERT INTO comunidades (id_comunidad, nombre) VALUES ('$id','$name')";
        // echo "<p>$sql</p>";
        $status = $this->mysqli->query($sql);

        if (!$status) {
            echo "<script> console.log('Insert done: nothing changed!'); </script>";
        }

        return $status;
    }


}

?>