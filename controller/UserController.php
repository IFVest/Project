<?php

require_once(__DIR__ . "/Controller.php");

class UserController extends Controller{

    public function __construct() {
        $this->setActionDefault("create");
        $this->handleAction();
    }

    protected function create($dados = [], $errorMsgs = "") {
        $this->loadView("user/signup.php", $dados, $errorMsgs);
    }

    protected function save() {
        
    }
}

$usr = new UserController();