<?php
require_once '../integracion/db.php';
require_once 'crudInterface.php';

class Revista implements CrudInterface
{
    private $connection;
    private $titulo;
    private $fecha_publicacion;
    private $editorial;
    private $precio;
    private $unidades; // Nueva propiedad para unidades
    private $id;

    public function __construct()
    {
        $this->connection = Database::getInstance();
    }

    // Setters para las propiedades
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setFechaPublicacion($fecha_publicacion)
    {
        $this->fecha_publicacion = $fecha_publicacion;
    }

    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function setUnidades($unidades) // Setter para unidades
    {
        $this->unidades = $unidades;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Implementación del método crear
    public function crear()
    {
        $stmt = $this->connection->prepare("INSERT INTO revistas (titulo, fecha_publicacion, editorial, precio, unidades) VALUES (:titulo, :fecha_publicacion, :editorial, :precio, :unidades)");
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':fecha_publicacion', $this->fecha_publicacion);
        $stmt->bindParam(':editorial', $this->editorial);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':unidades', $this->unidades); // Agregar unidades

        return $stmt->execute();
    }

    // Implementación del método listar
    public static function listar()
    {
        $connection = Database::getInstance();
        $stmt = $connection->prepare("SELECT * FROM revistas ORDER BY fecha_publicacion DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function eliminar($id)  
    {
        $connection = Database::getInstance();
        $stmt = $connection->prepare("DELETE FROM revistas WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function editar()
    {
        $stmt = $this->connection->prepare("UPDATE revistas SET titulo = :titulo, fecha_publicacion = :fecha_publicacion, editorial = :editorial, precio = :precio, unidades = :unidades WHERE id = :id");
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':fecha_publicacion', $this->fecha_publicacion);
        $stmt->bindParam(':editorial', $this->editorial);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':unidades', $this->unidades); 
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
