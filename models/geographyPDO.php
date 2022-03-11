<?php

// Amb PDO podem unificar la manera de fer QUERY en les BD per generalitzar-ho amb els diferents motors. Poguent utilitzar ORACLE, MySQL, Postgree

class GeographyPDO {

    private $pdo;

    function __construct(){

        # Conectamos a la base de datos
        $host='localhost';
        $dbname='geografia';
        $user='root';
        $pass='';

        # Estructura Try Catch (if modo pro)
        try {           
            # MySQL con PDO_MYSQL
            # Para que la conexion al mysql utilice las collation UTF-8 añadir charset=utf8 al string de la conexion.
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
          
            # Para que genere excepciones a la hora de reportar errores.
            $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
          
          }
          catch(PDOException $e) {
              echo $e->getMessage();
          }

    }

    public function getComunidades() {

        try {

            $sql = "SELECT nombre, id_comunidad FROM comunidades";
            $s = $this->pdo->prepare($sql);
            $s->execute();
            $s->setFetchMode(PDO::FETCH_ASSOC);
            return $s->fetchAll();

        } catch(PDOException $err) {
            // Mostrem un missatge d'error genèric

            echo "Error: ejecutando consulta SQL.";
        }
       
    }

    public function getProvincias($id) {

        try {

            $sql = "SELECT nombre, n_provincia FROM provincias WHERE id_comunidad =:id";
            $s = $this->pdo->prepare($sql);
            $s->bindParam(':id', $id, PDO::PARAM_INT); //PDO::PARAM_INT -> Obliguem a passar un número sencer! D'aquesta manera ens evitem validar
            $s->execute();
            $s->setFetchMode(PDO::FETCH_ASSOC);
            return $s->fetchAll();

        } catch(PDOException $err) {
            // Mostrem un missatge d'error genèric

            echo "Error: ejecutando consulta SQL.";
        }
    }

    public function  getMunicipios($id) {

        try {

            $sql = "SELECT nombre, id_localidad FROM localidades WHERE n_provincia = :id";
            $s = $this->pdo->prepare($sql);
            $s->bindParam(':id', $id, PDO::PARAM_INT); //PDO::PARAM_INT -> Obliguem a passar un número sencer! D'aquesta manera ens evitem validar
            $s->execute();
            $s->setFetchMode(PDO::FETCH_ASSOC);
            return $s->fetchAll();

        } catch(PDOException $err) {
            // Mostrem un missatge d'error genèric

            echo "Error: ejecutando consulta SQL.";
        }
    }

    public function getSummary($id) {

        try {

            $sql = "SELECT c.nombre AS comunidad, p.nombre AS provincia, l.nombre AS localidad
                    FROM comunidades c JOIN provincias p ON c.id_comunidad = p.id_comunidad
                    JOIN localidades l ON p.n_provincia = l.n_provincia
                    WHERE l.id_Localidad = :id;";
            $s = $this->pdo->prepare($sql);
            $s->bindParam(':id', $id, PDO::PARAM_INT); //PDO::PARAM_INT -> Obliguem a passar un número sencer! D'aquesta manera ens evitem validar
            $s->execute();
            $s->setFetchMode(PDO::FETCH_ASSOC);
            return $s->fetchAll();

        } catch(PDOException $err) {
            // Mostrem un missatge d'error genèric

            echo "Error: ejecutando consulta SQL.";
        }
    }


    public function  lastComunidad() {

        try {

            $sql = "SELECT MAX(id_comunidad) as max FROM comunidades";
            $s = $this->pdo->prepare($sql);
            $s->execute();
            $s->setFetchMode(PDO::FETCH_ASSOC);
            return $s->fetchAll();

        } catch(PDOException $err) {
            // Mostrem un missatge d'error genèric

            echo "Error: ejecutando consulta SQL.";
        }
    }

    public function  newComunidad($id,$name) {

        try {

            $sql = "INSERT INTO comunidades (id_comunidad, nombre) VALUES (':id',':name')";
            $s = $this->pdo->prepare($sql);
            $s->bindParam(':id', $id, PDO::PARAM_INT); //PDO::PARAM_INT -> Obliguem a passar un número sencer! D'aquesta manera ens evitem validar
            $s->bindParam(':name', $name, PDO::PARAM_STR); //PDO::PARAM_INT -> Obliguem a passar un String! D'aquesta manera ens evitem validar
            $s->execute();
            $s->setFetchMode(PDO::FETCH_ASSOC);
            return $s->fetchAll();

        } catch(PDOException $err) {
            // Mostrem un missatge d'error genèric

            echo "Error: ejecutando consulta SQL.";
        }

    }

}

?>