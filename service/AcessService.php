<?php
require_once(__DIR__ . "/../model/UserRoles.php");

class AcessService {
    public function __construct() {
        $this->verifySession();
    }

    private function verifySession() {
        if(session_status() != PHP_SESSION_ACTIVE)
        session_start();
        
        // Se não estiver cadastrado ou estar inativo, é lançado para a página de login
        if (! isset($_SESSION["userId"]) || ! $_SESSION["userActive"]) {
            header("location: ". SIGNIN_PAGE);
        }
    }

    public function hasRole($role) {
        if ($_SESSION["userRole"] == $role->name) {
            return true;
        }

        return false;
    }
}
?>