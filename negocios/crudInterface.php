<?php

interface CrudInterface
{
    public function crear();
    public static function listar();
    public static function eliminar($id);
    public function editar();
}
