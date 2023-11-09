<?php

class SeccionModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=eclipse;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de secciones
     */
    public function getAll() {
        $query = $this->db->prepare("SELECT * FROM seccion ORDER BY tipo ASC");
        $query->execute();

        
        $secciones = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $secciones;
    }

    //ver id pasado por parametro
    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM seccion WHERE id_seccion = ?");
        $query->execute([$id]);
        $seccion = $query->fetch(PDO::FETCH_OBJ);
        
        return $seccion;
    }

    /**
     * Inserta una seccion en la base de datos.
     */
    public function insert($id_noticia, $tipo, $descripcion, $orden) {
        $query = $this->db->prepare("INSERT INTO seccion (id_noticia, tipo, descripcion, orden) VALUES (?,?,?,?)");
        $query->execute([$id_noticia, $tipo, $descripcion, $orden]);

        return $this->db->lastInsertId();
    }

    //actualiza 

    public function modificar($id_noticia, $tipo, $descripcion, $orden){
        $query = $this->db->prepare("UPDATE seccion SET id_noticia = ?, tipo = ?, descripcion = ?, orden = ?");
        $query->execute([$id_noticia, $tipo, $descripcion, $orden]);
    }

    /**
     * Elimina un seccion dado su id.
     */
    function delete($id) {
        $query = $this->db->prepare('DELETE FROM seccion WHERE id_seccion = ?');
        $query->execute([$id]);
    }

    
}
