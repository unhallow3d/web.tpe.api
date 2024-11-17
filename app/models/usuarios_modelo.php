<?php
require_once 'abstract_modelo.php';
class usuarios_modelo extends abstract_modelo
{

    public function obtenerUsuario($nombre_usuario)
    {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE nombre_usuario = ? LIMIT 1 ');

        $query->execute([$nombre_usuario]);

        $resul = $query->fetchObject();

        return $resul;
    }
}
