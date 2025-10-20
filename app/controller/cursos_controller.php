 <?php   
    require_once 'model/cursos_model.php';
    require_once 'model/categorias_model.php';
    require_once 'view/cursos_view.php';
    class cursos_controller{
    private $model;
    private $view; 
    private $categorias_model;

    function __construct($res) {
        $this ->model = new cursos_model();
        $this ->view = new cursos_view($res);
        $this ->categorias_model = new categorias_model();
    }

    function showCursos(){
        $curso =$this->model->getCursos();
        $categoria = $this->categorias_model->getCategorias();
        $this->asignarNombreCategoria($curso, $categoria);
        return $this->view->mostrarListado($curso,$categoria);
    }

    function asignarNombreCategoria($curso,$categoria){
        foreach ($curso as $cur) {
            // Busco la categoría correspondiente al curso
            foreach ($categoria as $cat) {
                if ($cur->id_categoria == $cat->id) {
                    $cur->categoria_nombre = $cat->nombre;
                    break;
                }
            }
        }
    }
    function addCursos(){
        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion']; 
        $id_categoria = $_POST['id_categoria'];
        $instructor =$_POST['instructor'];

        $imagenUrl = null;

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $directorioDestino = 'app/view/imgs/';
            $archivoTmp = $_FILES['imagen']['tmp_name'];
            $nombreArchivo = uniqid() . '-' . $_FILES['imagen']['name'];

            if (move_uploaded_file($archivoTmp, $directorioDestino . $nombreArchivo)) {
                $imagenUrl = $nombreArchivo;
            } else {
                return $this->view->mostrarError(" Error al mover la imagen (permisos o ruta).");
            }
        }

        $id_nuevo_curso = $this->model->añadirCursos($titulo, $descripcion,$instructor, $imagenUrl, $id_categoria);

        if (!$id_nuevo_curso || $id_nuevo_curso <= 0) {
            return $this->view->mostrarError("Error al obtener el ID del producto insertado.");
        }
        header('Location: ' . BASE_URL . 'listar');
    }

    function mostrarFormCursos() {
        $curso = $this->model->getCursos();
        $categorias = $this->categorias_model->getCategorias();
        return $this->view->mostrarFormCurso($curso, $categorias);
    }

    function listarPorCategoria($params = []) {
        $id_categoria = null;
        $categorias = $this->categorias_model->getCategorias();
        if (isset($params[1]) && is_numeric($params[1])) {
            $id_categoria = (int)$params[1];
        } else {
            return $this->view->mostrarError("Error: Se requiere un ID de categoría válido.");
        }

        $cursos = $this->model->getCursosByCategoria($id_categoria);
        
        $nombre_categoria = "Cursos Filtrados";
        if (!empty($cursos)) {
            $nombre_categoria = $cursos[0]->nombre_categoria; 
        } 
        $this->view->mostrarCursosPorCategoria($cursos, $nombre_categoria, $categorias);
    }

    function deleteCurso($id){
        $this->model->eliminarCurso($id);

        header('Location: ' . BASE_URL . 'listar');
    }


    function editarCurso($id){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $curso = $this->model->curso($id);
            $categorias = $this->categorias_model->getCategorias();

            if (!$curso) {
                return $this->view->mostrarError("El curso a editar no existe.");
            }

            return $this->view->mostrarUpdateCurso($curso, $categorias);
        }

        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $instructor = $_POST['instructor'];
        $id_categoria = $_POST['id_categoria'];

        $productoActual = $this->model->curso($id);

        if (!$productoActual) {
            return $this->view->mostrarError("El curso con ID $id no existe o fue eliminado.");
        }

        $imagenUrl = $productoActual->imagen;

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $directorioDestino = 'app/view/imgs/';
            $archivoTmp = $_FILES['imagen']['tmp_name'];
            $nombreArchivo = uniqid() . '-' . $_FILES['imagen']['name'];

            if (move_uploaded_file($archivoTmp, $directorioDestino . $nombreArchivo)) {
                $imagenUrl = $nombreArchivo;
            } else {
                return $this->view->mostrarError("Error al mover la imagen (permisos o ruta).");
            }
        }

        $this->model->updateCurso($id, $titulo, $descripcion, $instructor, $id_categoria, $imagenUrl);

        header('Location: ' . BASE_URL . "detalle/$id");
        exit;
    }


    function verDetalle($id){
         $curso = $this->model->curso($id);
         $categorias = $this->categorias_model->getCategorias();

         if(!$curso){
            $this->view->mostrarError("Curso no encontrado");
         }

         $this->view->mostrarDetalle($curso,$categorias);
    }
}