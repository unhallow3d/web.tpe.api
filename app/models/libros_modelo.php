<?php
require_once 'abstract_modelo.php';
class libros_modelo extends abstract_modelo
{

    public function obtenerLibros($id_autor = null)
    {
        
        $sql = $id_autor ? 'SELECT * FROM libros WHERE id_autor = ? ORDER BY libro_titulo' : 'SELECT * FROM libros ORDER BY libro_titulo';
        $data_query = [];
        if ($id_autor) {
            $data_query[] = $id_autor; 
        }
        $query = $this->db->prepare($sql);
        $query->execute($data_query);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function obtenerLibro($id)
    {
        $query = $this->db->prepare('SELECT * FROM libros WHERE id_libro = ? LIMIT 1');
        $query->execute([$id]);
        return $query->fetchObject();
    }
}
