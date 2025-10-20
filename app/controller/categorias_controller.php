 <?php   
    require_once 'model/cursos_model.php';
    require_once 'model/categorias_model.php';
    require_once 'view/cursos_view.php';
        require_once 'view/categorias_view.php';
    class categorias_controller{
    private $viewC; 
    private $categorias_model;
    private $viewError;

    function __construct($res) {
        $this ->viewC = new categorias_view($res);
        $this ->viewError = new cursos_view($res);
        $this ->categorias_model = new categorias_model();
    }

        function showCategorias(){
        $categoria = $this->categorias_model->getCategorias();
        return $this->viewC->mostrarListadoCategorias($categoria);
    }

    function addCategorias(){
        $nombre = $_POST['nombre'];
        $this->categorias_model->añadirCategoria($nombre);
        header('Location: ' . BASE_URL . 'listarCategorias');
    }

    function mostrarFormCat(){
        $categorias = $this->categorias_model->getCategorias();
        return $this->viewC->mostrarFormCat($categorias);
    }

    
    function updateCategorias($id){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $categoria = $this->categorias_model->getCategoriaID($id);

            if (!$categoria) {
                return $this->viewError->mostrarError("La categoria a editar no existe.");
            }

            return $this->viewC->mostrarUpdateCategoria($categoria);
        }
        $nombre = $_POST['nombre'];
        
        $catActual = $this->categorias_model->getCategoriaID($id);
        if(!$catActual){
            return $this->viewError->mostrarError("La categoria a editar no existe.");
        }

        $this->categorias_model->editarCategoria($nombre, $id);
        header('Location: ' . BASE_URL . "listarPorCategoria/$id");
        exit;
    }


    function eliminarCategoria($id){
        $this->categorias_model->deleteCategoria($id);

        header('Location: ' . BASE_URL . 'listarCategorias');
        exit;
    }
}