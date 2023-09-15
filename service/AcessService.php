<?php
require_once(__DIR__ . "/../model/UserRoles.php");

class AcessService {
    public function __construct() {
        $this->verifySession();
    }

    private function verifySession() {
        if(session_status() != PHP_SESSION_ACTIVE)
        session_start();
    
        if (! isset($_SESSION["userId"])) {
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