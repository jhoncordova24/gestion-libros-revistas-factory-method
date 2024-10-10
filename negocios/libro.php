<?php
require_once '../integracion/db.php';
require_once 'crudInterface.php';

class Libro implements CrudInterface
{
    private $connection;
    private $id;
    private $titulo;
    private $autor;
    private $editorial;
    private $unidades;
    private $precio;

    public function __construct()
    {
        $this->connection = Database::getInstance();
    }

    // Setters para las propiedades
    public function setId($id) // Setter para id
    {
        $this->id = $id;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }
    public function setUnidades($unidades)
    {
        $this->unidades = $unidades;
    }

    // Implementación del método crear
    public function crear()
    {
        $stmt = $this->connection->prepare("INSERT INTO libros (titulo, autor, editorial, precio, unidades) VALUES (:titulo, :autor, :editorial, :precio, :unidades)");
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':editorial', $this->editorial);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':unidades', $this->unidades);


        return $stmt->execute();
    }

    // Implementación del método listar
    public static function listar()
    {
        $connection = Database::getInstance();
        $stmt = $connection->prepare("SELECT * FROM libros");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cambia a estático para eliminar
    public static function eliminar($id)
    {
        $connection = Database::getInstance();
        $stmt = $connection->prepare("DELETE FROM libros WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Implementación del método editar
    public function editar()
    {
        $stmt = $this->connection->prepare("UPDATE libros SET titulo = :titulo, autor = :autor, editorial = :editorial, precio = :precio, unidades = :unidades WHERE id = :id");
        $stmt->bindParam(':titulo', $this->titulo);
        $stmt->bindParam(':autor', $this->autor);
        $stmt->bindParam(':editorial', $this->editorial);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':unidades', $this->unidades);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}
