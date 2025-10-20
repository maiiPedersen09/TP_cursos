<?php
class categorias_model{


    function connect(){    
    $db = new PDO('mysql:host=localhost;dbname=db_cursos;charset=utf8', 'root', '');
    return $db;
    }

    function getCategorias(){
        $db=$this->connect();
        $query = $db->prepare('SELECT * FROM categoria');
        $query->execute();
        $categoria = $query->fetchAll(PDO::FETCH_OBJ);
        return $categoria;
    }
    function getCategoriaID($id){
        $db = $this->connect();
        $query = $db->prepare('SELECT * FROM categoria WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function añadirCategoria($nombre){
        $db = $this->connect();
        $query = $db->prepare("INSERT INTO categoria(nombre) VALUES (?)");
        $query->execute([$nombre]);
        return $db->lastInsertId();
    }
    function editarCategoria($nombre, $id){
        $db = $this->connect();
        $query = $db->prepare("UPDATE categoria SET nombre = ? WHERE id = ?");
        $query->execute([$nombre,$id]);
    }
    function deleteCategoria($id){
        $db = $this->connect();
        $query = $db->prepare("DELETE FROM categoria WHERE id = ?");
        $query->execute([$id]);
        return;
    }
}