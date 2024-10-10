<?php
require_once 'Libro.php';   
require_once 'Revista.php'; 

class ProductoFactory
{
    public static function crearProducto($tipo)
    {
        if ($tipo == 'libro') {
            return new Libro();
        } elseif ($tipo == 'revista') {
            return new Revista();
        } else {
            throw new Exception("Tipo de producto no válido.");
        }
    }
}
