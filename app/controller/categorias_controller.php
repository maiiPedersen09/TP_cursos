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
}