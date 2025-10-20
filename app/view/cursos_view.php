

<?php
class cursos_view{
    function mostrarListado($curso,$categorias){
        require_once 'listado.phtml';
    }
    function mostrarFormCurso($curso, $categorias){
        require_once 'formAñadirCurso.php';
    }
    function mostrarError($error){
        echo $error;
    } 
    function mostrarCursosPorCategoria($cursos, $nombre_categoria, $categorias){
        require_once 'ListadoPorCategoria.phtml';
    }
    function mostrarUpdateCurso($curso, $categorias){
        require_once 'formUpdateCurso.phtml';
    }
    function mostrarDetalle($curso, $categorias){
        require_once 'detalle.phtml';
    }
}