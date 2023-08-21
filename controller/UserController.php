<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/UserRoles.php");
require_once(__DIR__ . "/../dao/UserDAO.php");
require_once(__DIR__ . "/../service/UserService.php");

class UserController extends Controller{

    private UserDAO $userDao;
    private UserService $userService;

    public function __construct() {
        $this->userDao = new UserDAO();
        $this->userService = new UserService();
        $this->setActionDefault("signin");
        $this->handleAction();
    }

    protected function list() {
        $dados["lista"] = $this->userDao->list();
        $this->loadView("user/list_users.php", $dados);
    }

    protected function signup($dados = [], $errorMsgs = "") {
        $this->loadView("user/signup.php", $dados, $errorMsgs);
    }

    protected function signin($dados = [], $errorMsgs = "") {
        $this->loadView("user/signin.php", $dados, $errorMsgs);
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
        $userToSave->setRole(UserRoles::Aluno->name);

        // TODO: Verificar se email já existe

        $this->userDao->insert($userToSave);

        $this->loadView("user/signin.php", [], "");
    }

    protected function login() {
        $userEmail = isset($_POST["email"]) ? $_POST["email"] : null;
        $userPass = isset($_POST["pass"]) ? $_POST["pass"] : null;

        $userToLogin = new User();
        $userToLogin->setEmail($userEmail);
        $userToLogin->setPassword($userPass);

        $errors = $this->userService->validateData($userToLogin);

        if (empty($errors)) {
            try {
                // Verificar se senhas batem
                $foundUser = $this->userService->findUserByEmail($userToLogin->getEmail())[0];

                if (! password_verify($userToLogin->getPassword(), $foundUser->getPassword())) {
                    array_push($errors, "Senha errada");
                } else {
                    $this->createUserSession($foundUser);
                    $this->loadView("/ingresso.php", [], "");
                    exit;
                }
            }
            catch (PDOException $e) {
                $errors = "Usuário não encontrado";
            }
        }
        
        $dados["user"] = $userToLogin;
        $errorMsgs = implode("<br>", $errors);
        $this->signin($dados, $errorMsgs);
    }

    private function createUserSession(User $user) {
        session_start();

        $_SESSION["userId"] = $user->getId();
        $_SESSION["userName"] = $user->getCompleteName();
        $_SESSION["userRole"] = $user->getRole();
    }

    public function logout() {
        session_start();

        session_destroy();
        $this->loadView("user/signin.php", [], "");
    }
}

$usr = new UserController();