<?php
require_once 'abstract_modelo.php';
class autores_modelo extends abstract_modelo
{

    public function obtenerAutores($orderBy = null, $asc = true, $tieneBiografia = null, $filtrarNombre = null, $pagina = 1, $resultados = 10)
    { //
        $sql = 'SELECT * FROM autores';
        $condiciones = [];
        if ($tieneBiografia) {
            $condiciones[] = '(biografia_autor IS NOT null AND biografia_autor <> "")';
        }

        if ($filtrarNombre) {
            $condiciones[] = 'nombre_autor LIKE "%' . $filtrarNombre . '%"';
        }

        if ($condiciones) {
            $sql .= ' WHERE ' . implode(' AND ', $condiciones);
        }

        if ($orderBy) {
            switch ($orderBy) {
                case 'nombre':
                    $sql .= ' ORDER BY nombre_autor ' . ($asc ? 'ASC' : 'DESC');
                    break;

                case 'libros':
                    $sql .= ' ORDER BY cant_libros ' . ($asc ? 'ASC' : 'DESC');
                    break;
            }
        }
        $offset = ($pagina - 1) * $resultados;
        $sql .= ' LIMIT ' . $resultados . ' OFFSET ' . $offset;


        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function obtenerAutor($id)
    {
        $query = $this->db->prepare('SELECT * FROM autores WHERE id_autor = ? LIMIT 1');
        $query->execute([$id]);
        return $query->fetchObject();
    }
    public function agregarAutor($nombre, $nacionalidad, $archivo_foto, $biografia_autor)
    {
        $query = $this->db->prepare('INSERT INTO autores (nombre_autor, nacionalidad_autor, archivo_foto, biografia_autor) VALUES (?, ?, ?, ?)');
        return $query->execute([$nombre, $nacionalidad, $archivo_foto, $biografia_autor]) ? $this->db->lastInsertId() : false;
    }

    public function editarAutor($id, $nombre, $nacionalidad, $archivo_foto, $biografia_autor)
    {
        $campos = [];
        $nuevosValores = [];
        if ($nombre) {
            $campos[] = 'nombre_autor = ?';
            $nuevosValores[] = $nombre;
        }
        if ($nacionalidad) {
            $campos[] = 'nacionalidad_autor = ?';
            $nuevosValores[] = $nacionalidad;
        }
        if ($biografia_autor) {
            $campos[] = 'biografia_autor = ?';
            $nuevosValores[] = $biografia_autor;
        }
        if (!$campos) {
            return true;
        }
        $sqlCampos = implode(',', $campos);
        $nuevosValores[] = $id;
        $query = $this->db->prepare('UPDATE autores SET ' . $sqlCampos . ' WHERE id_autor = ? LIMIT 1');
        return $query->execute($nuevosValores);
    }

    public function eliminarAutor($id)
    {
        $query = $this->db->prepare('DELETE FROM autores WHERE id_autor = ? LIMIT 1');
        return $query->execute([$id]);
    }
}
