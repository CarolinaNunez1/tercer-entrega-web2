<?php
require_once './app/models/seccion.model.php';
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

    public function getSecciones($params = null) {
        $secciones = $this->model->getAll();
        $this->view->response($secciones);
    }

    public function getSeccion($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $seccion = $this->model->get($id);

        // si no existe devuelvo 404
        if ($seccion)
            $this->view->response($seccion);
        else 
            $this->view->response("La seccion con el id=$id no existe", 404);
    }

    public function deleteSeccion($params = null) {
        $id = $params[':ID'];

        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }

        $seccion = $this->model->get($id);
        if ($seccion) {
            $this->model->delete($id);
            $this->view->response($seccion);
        } else 
            $this->view->response("La seccion con el id=$id no existe", 404);
    }
    

    public function insertseccion($params = null) {
        if(!$this->authHelper->isLoggedIn()){
            $this->view->response("No estas logueado", 401);
            return;
        }
        
        $seccion = $this->getData();

        if (empty($seccion->id_noticia) || empty($seccion->tipo) || empty($seccion->descripcion) || empty($seccion->orden) ) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($seccion->id_noticia, $seccion->tipo, $seccion->descripcion, $seccion->orden);
            $seccion = $this->model->get($id);
            $this->view->response($seccion, 201);
        }
    } 

}