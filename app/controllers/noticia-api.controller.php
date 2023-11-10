<?php
require_once './app/models/noticia.model.php';
require_once './app/views/api.view.php';
require_once './app/helpers/auth-api.helper.php';

class seccionApiController {
    private $model;
    private $view;
    private $authHelper;

    private $data;

    public function __construct() {
        $this->model = new seccionModel();
        $this->view = new ApiView();
        $this->authHelper = new AuthApiHelper();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getNoticias($params = null) {
        $noticias = $this->model->getAll();
        $this->view->response($noticias);
    }

    public function getNoticia($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $noticia = $this->model->get($id);

        // si no existe devuelvo 404
        if ($noticia)
            $this->view->response($noticia);
        else 
            $this->view->response("La noticia con el id=$id no existe", 404);
    }

    public function deleteNoticia($params = null) {
        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }

        $noticia = $this->model->get($id);
        if ($noticia) {
            $this->model->delete($id);
            $this->view->response($noticia);
        } else 
            $this->view->response("La noticia con el id=$id no existe", 404);
    }
    

    public function insertnoticia($params = null) {
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }
        
        $noticia = $this->getData();

        if (empty($noticia->id_noticia) || empty($noticia->titulo) || empty($noticia->fecha) || empty($noticia->autor) || empty($noticia->texto) || empty($noticia->imagen)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($noticia->id_noticia, $noticia->titulo, $noticia->fecha, $noticia->autor, $noticia->texto, $noticia->imagen);
            $noticia = $this->model->get($id);
            $this->view->response($noticia, 201);
        }
    } 

    public function modificarNoticia($params = null) {
        $id = $params[':ID'];
    
        // Lee el cuerpo de la solicitud
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
    
        // Verifica si los campos requeridos están presentes
        if (
            !isset($data[':titulo']) ||
            !isset($data[':fecha']) ||
            !isset($data[':autor']) ||
            !isset($data[':texto']) ||
            !isset($data[':imagen'])  
        ) {
            $this->view->response("Parámetros incompletos", 400);
            return;
        }
    
        $titulo = $data[':titulo'];
        $fecha = $data[':fecha'];
        $autor = $data[':autor'];
        $texto = $data[':texto'];
        $imagen = $data[':imagen'];
    
      /*  if (!$this->authHelper->isLoggedIn()) {
            $this->view->response("No estás logueado", 401);
            return;
        }*/
    
        try {
            $noticia = $this->model->get($id);
    
            if ($noticia) {
                $this->model->modificar($id, $titulo, $fecha, $autor, $texto, $imagen);
                $this->view->response($noticia);
            } else {
                $this->view->response("La noticia con el id=$id no existe", 404);
            }
        } catch (Exception $e) {
            $this->view->response("Error interno en el servidor", 500);
        }
    }

}