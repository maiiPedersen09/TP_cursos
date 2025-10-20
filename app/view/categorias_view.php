<?php
class categorias_view{
    function mostrarListadoCategorias($categorias){
        require_once 'listadoCategorias.phtml';
    }
    function mostrarFormCat($categorias){
        require_once 'formAñadirCat.php';
    }
    function mostrarUpdateCategoria($categoria){
        require_once 'formUpdateCat.php';
    }
}