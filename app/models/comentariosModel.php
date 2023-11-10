<?php

class comentariosModel{

    private $db;

    function __construct(){

        $this->db = new PDO('mysql:host=localhost;'.'dbname=eclipse;charset=utf8','root','');
    }


    public function getAll() {
        $query = $this->db->prepare("SELECT * FROM comentarios");
        $query->execute();

        
        $comentarios = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $comentarios;
    }

    //ver id pasado por parametro
    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM comentarios WHERE id_comentario = ?");
        $query->execute([$id]);
        $comentario = $query->fetch(PDO::FETCH_OBJ);
        
        return $comentario;
    }

    /**
     * Inserta un comentario en la base de datos.
     */
    public function insert($comentario, $nota,$id_noticia) {
        $query = $this->db->prepare("INSERT INTO comentario (comentario, nota, id_noticia$id_noticia) VALUES (?,?,?)");
        $query->execute([$comentario, $nota, $id_noticia]);

        return $this->db->lastInsertId();
    }


    /**
     * Elimina un comentario dado su id.
     */
    function delete($id) {
        $query = $this->db->prepare('DELETE FROM comen WHERE id_comentario = ?');
        $query->execute([$id]);
    }





}
