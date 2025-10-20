<?php 
require_once 'model/auth_model.php';
require_once 'view/autenticationView.php';

class auth_controller{
    private $model;
    private $view;

    public function __construct($user=null){
        $this -> model = new auth_model();
        $this -> view = new autenticationView($user); 
    }
    
    public function showLogin(){
        return $this->view->showLogin();
    }
    public function showRegister() {
        return $this->view->showRegister();
    }


        public function login(){
        if (!isset($_POST['email']) || empty ($_POST['email'])) {
            return $this->view->showLogin('falta completar el nombre de usuario');
        }
        if (!isset($_POST['password']) || empty ($_POST['password'])){
            return $this->view->showLogin('falta completar la contraseña de usuario');
        }
        $email = $_POST ['email'];
        $password = $_POST ['password'];

        $userFromDB = $this->model->getUserByEmail($email);
        if(password_verify($password, $userFromDB->password)){
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
            $_SESSION['ES_ADMIN'] = $userFromDB->es_admin;
            $_SESSION['ROL_USER'] = $userFromDB->rol;

            header('Location: ' . BASE_URL . 'listar');
        } else {
            return $this->view->showLogin('credenciales incorrectas');
        }
    }


        public function register() {
        if (!isset($_POST['email']) || empty($_POST['email']) ||
            !isset($_POST['password']) || empty($_POST['password']) ||
            !isset($_POST['confirm_password']) || empty($_POST['confirm_password'])) {
            return $this->view->showRegister('Faltan campos obligatorios');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm = $_POST['confirm_password'];

        if ($password !== $confirm) {
            return $this->view->showRegister('Las contraseñas no coinciden');
        }

        $userExists = $this->model->getUserByEmail($email);
        if ($userExists) {
            return $this->view->showRegister('Este email ya está registrado');
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->model->createUser($email, $hashedPassword);

        header('Location: ' . BASE_URL . 'showLogin');
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL . 'listar');
    }
}