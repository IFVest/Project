<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/UserRoles.php");
require_once(__DIR__ . "/../dao/UserDAO.php");

class UserController extends Controller{

    private UserDAO $userDao;

    public function __construct() {
        $this->userDao = new UserDAO();
        $this->setActionDefault("create");
        $this->handleAction();
    }

    protected function create($dados = [], $errorMsgs = "") {
        $this->loadView("user/signup.php", $dados, $errorMsgs);
    }

    protected function save() {
        $userName = isset($_POST["name"]) ? $_POST["name"] : null;
        $userEmail = isset($_POST["email"]) ? $_POST["email"] : null;
        $userPass = isset($_POST["pass"]) ? $_POST["pass"] : null;
        $userPassConfirm = isset($POST["passConfirm"]) ? $_POST["pass"] : null;
        
        // Encriptar senha
        $hashedPass = password_hash($userPass, PASSWORD_DEFAULT);

        $userToSave = new User();
        $userToSave->setCompleteName($userName);
        $userToSave->setEmail($userEmail);
        $userToSave->setPassword($hashedPass);
        $userToSave->setRoles(UserRoles::Aluno->name);

        // TODO: Verificar se email já existe

        $this->userDao->insert($userToSave);

        $this->loadView("user/signin.php", [], "");
    }

    protected function login() {
        $userEmail = isset($_POST["email"]) ? $_POST["email"] : null;
        $userPass = isset($_POST["pass"]) ? $_POST["pass"] : null;
        
        // Comparar senha que foi digitada com a senha hasheada do usuário
        $hashedPass = password_hash($userPass, PASSWORD_DEFAULT);
    }
}

$usr = new UserController();