<?php

class autenticationView{
        
        public function showLogin ($error = ''){
            require_once 'seguridad/form_inicio_sesion.php';
        }

        public function showRegister ($error = ''){
            require_once 'seguridad/form_registro_sesion.php';
        }
}