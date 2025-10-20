<?php
class categorias_view{
    function mostrarListadoCategorias($categorias){
        require_once 'listadoCategorias.phtml';
    }
    function mostrarFormCat($categorias){
        require_once 'formAñadirCat.php';
    }
}