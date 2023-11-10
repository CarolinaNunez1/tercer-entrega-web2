<?php

class NoticiaModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=eclipse;charset=utf8', 'root', '');
    }

    /**
     * Devuelve la lista de noticia 
     */
    public function getAll() {
        $query = $this->db->prepare("SELECT * FROM noticia ORDER BY fecha ASC");
        $query->execute();

        
        $noticias = $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        
        return $noticias;
    }

    //ver id pasado por parametro
    public function get($id) {
        $query = $this->db->prepare("SELECT * FROM noticia WHERE id_noticia = ?");
        $query->execute([$id]);
        $noticia = $query->fetch(PDO::FETCH_OBJ);
        
        return $noticia;
    }

    /**
     * Inserta una noticia en la base de datos.
     */
    public function insert($titulo, $fecha, $autor, $texto, $imagen) {
        $query = $this->db->prepare("INSERT INTO noticia (titulo, fecha, autor, texto, imagen) VALUES (?,?,?,?,?)");
        $noticia = $query->execute([$titulo, $fecha, $autor, $texto, $imagen]);

        return $noticia;
    }

    //actualiza una noticia

    public function modificar($id_noticia, $titulo, $fecha, $autor, $texto, $imagen){
        $query = $this->db->prepare("UPDATE noticia SET  titulo = ?, fecha = ?, autor = ?, texto = ?, imagen = ? WHERE id_noticia = ?");
        $query->execute([$titulo, $fecha, $autor, $texto, $imagen, $id_noticia]);
    }

    /**
     * Elimina una noticia dado su id.
     */
    function delete($id) {
        $query = $this->db->prepare('DELETE FROM noticia WHERE id_noticia = ?');
        $query->execute([$id]);
    }

    
}
