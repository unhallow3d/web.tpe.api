<?php
require_once './app/models/autores_modelo.php';
require_once './app/views/json_view.php';
require_once './app/models/libros_modelo.php';
class BibliotecaApiController
{
    private $modelAutores;
    private $view;
    private $modelLibros;
    public function __construct()
    {
        $this->modelAutores = new autores_modelo();
        $this->view = new JSONView();
        $this->modelLibros = new libros_modelo();
    }
    public function obtenerAutores($req, $res)
    {





        $filtrarTieneBiografia = null;

        if (!empty($req->query->bio)) {
            $filtrarTieneBiografia = true;
        }

        $orderBy = false;
        if (isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $asc = !isset($req->query->asc) || $req->query->asc == 1;

        $filtrarNombre = null;
        if (isset($req->query->filtrarNombre)) {
            $filtrarNombre = $req->query->filtrarNombre;
        }
        if (isset($req->query->pagina) || isset($resultados) && is_int($req->query->pagina) && is_int($req->query->resultados && $req->query->pagina > 0 && $req->query->resultados > 0)) {
            $pagina = $req->query->pagina;
            $resultados = $req->query->resultados;
        }
        $autores = $this->modelAutores->obtenerAutores($orderBy, $asc, $filtrarTieneBiografia, $filtrarNombre, $pagina, $resultados);


        return $this->view->response($autores);
    }

    public function obtenerAutor($req, $res)
    {

        $id = $req->params->id;


        $autor = $this->modelAutores->obtenerAutor($id);

        if (!$autor) {
            return $this->view->response("El autor con el id=$id no existe", 404);
        }


        return $this->view->response($autor);
    }



    public function eliminarAutor($req, $res)
    {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401); // dejo autorizacion para DELETE, me parece adecuado
        }
        $id = $req->params->id;

        $autor = $this->modelAutores->obtenerAutor($id);

        if (!$autor) {
            return $this->view->response("El autor con el id=$id no existe", 404);
        }

        $this->modelAutores->eliminarAutor($id);
        $this->view->response("El autor con el id=$id se eliminó con éxito");
    }

    public function agregarAutor($req, $res)
    {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401); 
        }
        // valido los datos
        if (empty($req->body->nombre_autor) || empty($req->body->nacionalidad_autor)) {
            return $this->view->response('Faltan completar datos', 400);
        }


        $nombre = $req->body->nombre_autor;
        $nacionalidad = $req->body->nacionalidad_autor;

        $biografia = null;
        if (!empty($req->body->biografia_autor)) {
            $biografia = $req->body->biografia_autor;
        }
        $archivo_foto = null; // dejo nulo porque no tiene sentido que se cargue en json
        $id = $this->modelAutores->agregarAutor($nombre, $nacionalidad, $archivo_foto, $biografia);

        if (!$id) {
            return $this->view->response("Error al insertar autor", 500);
        }

        $autor = $this->modelAutores->obtenerAutor($id);
        return $this->view->response($autor, 201);
    }



    public function obtenerCantidadLibros($id_autor)
    {
        // funcion que podria usarse si se cargaran libros en la db
        $libros = $this->modelLibros->obtenerLibros($id_autor);
        return count($libros);
    }

    public function editarAutor($req, $res)
    {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $id = $req->params->id;


        $autor = $this->modelAutores->obtenerAutor($id);
        if (!$autor) {
            return $this->view->response("El autor con el id =$id no existe", 404);
        }
        $nombre = null;
        if (!empty($req->body->nombre_autor)) {
            $nombre = $req->body->nombre_autor;
        }
        $nacionalidad = null;
        if (!empty($req->body->nacionalidad_autor)) {
            $nacionalidad = $req->body->nacionalidad_autor;
        }
        $biografia = null;
        if (!empty($req->body->biografia_autor)) {
            $biografia = $req->body->biografia_autor;
        }
        $archivo_foto = null;


        $cant_libros = $this->obtenerCantidadLibros($id);

        $this->modelAutores->editarAutor($id, $nombre, $nacionalidad, $archivo_foto, $biografia, $cant_libros);


        $autor = $this->modelAutores->obtenerAutor($id);
        $this->view->response($autor, 200);
    }
}
