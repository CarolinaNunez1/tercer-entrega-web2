<?php
require_once "./app/models/comentariosModel.php";
require_once "./app/views/api.view.php";

class ApiComentarioController{
    private $model;
    private $view;

    private $data;

    public function __construct() {
        $this->model = new comentariosModel();
        $this->view = new ApiView();
        
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    public function getComentarios($params = null) {
        $comentarios = $this->model->getAll();
        $this->view->response($comentarios);
    }

    public function getComentario($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $comentario = $this->model->get($id);

        // si no existe devuelvo 404
        if ($comentario)
            $this->view->response($comentario);
        else 
            $this->view->response("El comentario con el id=$id no existe", 404);
    }

    public function deleteComentario($params = null) {
        $id = $params[':ID'];

        /*if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }*/

        $comentario = $this->model->get($id);
        if ($comentario) {
            $this->model->delete($id);
            $this->view->response($comentario);
        } else 
            $this->view->response("El comentario con el id=$id no existe", 404);
    }
    

    public function insertComentario($params = null) {
        
        $comentario = $this->getData();

        if (empty($comentario->comentario) || empty($comentario->nota) || empty($comentario->id_noticia)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($comentario->comentario, $comentario->nota, $comentario->id_noticia);
            $comentario = $this->model->get($id);
            $this->view->response($comentario, 201);
        }
    }




}