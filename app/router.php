<?php
require_once 'libs/response.php';
require_once 'controller/cursos_controller.php';
require_once 'controller/categorias_controller.php';

define ('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' .$_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');
define('ROOT_DIR', __DIR__ . '/'); 
define('IMG_UPLOAD_DIR', ROOT_DIR . 'view/imgs/');

$res = new Response();

$action = 'listar';
if(!empty( $_GET['action'])){
    $action = $_GET ['action'];
}

$params = explode('/', $action); 

switch ($params[0]) {
    case 'listar':
        $controller = new cursos_controller($res);
        $controller->showCursos();
        break;
    case 'añadirCurso':
        $controller = new cursos_controller($res);
        $controller -> addCursos();
        break;
    case 'mostrarFormDeAñadir':
        $controller = new cursos_controller($res);
        $controller -> mostrarFormCursos();
        break;

    case 'eliminarCurso':
        $controller = new cursos_controller($res);
        $controller -> deleteCurso($params[1]);
        break;  

    case 'editarCurso':
        $controller = new cursos_controller($res);
        $controller -> editarCurso($params[1] ?? null);
        break;

    case 'listarCategorias':
        $controllerCategoria = new categorias_controller($res);
        $controllerCategoria -> showCategorias();
        break;
    case 'añadirCategoria':
        $controllerCategoria = new categorias_controller($res);
        $controllerCategoria -> addCategorias();
        break;
    case 'mostrarFormCat':
        $controllerCategoria = new categorias_controller($res);
        $controllerCategoria -> mostrarFormCat();
        break;
    case 'eliminarCat':
        $controllerCategoria = new categorias_controller($res);
        $controllerCategoria -> eliminarCategoria($params[1]);
        break;
    case 'editarCat':
        $controllerCategoria = new categorias_controller($res);
        $controllerCategoria -> updateCategorias($params[1] ?? null);
        break;
    case 'listarPorCategoria':
        $controller = new cursos_controller($res);
        $controller->listarPorCategoria($params); 
        break;
    case 'detalle':
        $controller = new cursos_controller($res);
        $controller->verDetalle($params[1]); 
        break;
    default:
        # code...
        break;
}