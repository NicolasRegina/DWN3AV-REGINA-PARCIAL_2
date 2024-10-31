<?php
class Testimonio {
    private $id;
    private $nombre;
    private $testimonio;
    private $edad;
    private $profesion;
    private $ciudad;
    private $imagen;

    // Devuelve el completo de testimonios
    public function testimoniosCompleto(): array {
        $conexion = Conexion::getConexion();
        $query = "SELECT t.*, u.nombre_completo 
        FROM testimonios t
        JOIN usuarios u ON t.usuario_id = u.id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute();
    
        $result = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

        $testimonios = [];
        foreach ($result as $value) {
            $testimonio = new Self();
            $testimonio->id = $value['id'];
            $testimonio->nombre = $value['nombre_completo'];
            $testimonio->testimonio = $value['testimonio'];
            $testimonio->edad = $value['edad'];
            $testimonio->profesion = $value['profesion'];
            $testimonio->ciudad = $value['ciudad'];
            $testimonio->imagen = $value['imagen'];
    
            $testimonios[] = $testimonio;
        }
    
        return $testimonios;
    }

    // Devuelve concatenando el nombre, edad y profesión del testimonio
    public function nombreCompleto(): string {
        return $this->nombre . " (" . $this->edad . ") - " . $this->profesion;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTestimonio() {
        return $this->testimonio;
    }

    public function getEdad() {
        return $this->edad;
    }

    public function getProfesion() {
        return $this->profesion;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function getImagen() {
        return $this->imagen;
    }
}