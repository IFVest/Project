<?php

require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../model/UserRoles.php");
require_once(__DIR__ . "/../dao/UserDAO.php");
require_once(__DIR__ . "/../service/UserService.php");
require_once(__DIR__ . "/../util/config.php");

class UserController extends Controller{

    private UserDAO $userDao;
    private UserService $userService;

    public function __construct() {
        $this->userDao = new UserDAO();
        $this->userService = new UserService();
        $this->setActionDefault("signin");
        $this->handleAction();
    }

    private function findById() {
        if (isset($_GET["id"])) {
            $userId = $_GET["id"];
            $user = $this->userDao->findById($userId);
            
            return $user;
        }
    }

    protected function list($dados = [], $errorMsgs = "") {
        $dados["lista"] = $this->userDao->list();
        $this->loadView("user/list_users.php", $dados, $errorMsgs);
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
        $userToSave->setActive(_TRUE_);

        // TODO: Verificar se email já existe

        $this->userDao->insert($userToSave);

        $this->loadView("user/signin.php", [], "");
    }

    protected function edit() {
        $id = isset($_POST["user_id"]) ? $_POST["user_id"] : NULL;
        $role = isset($_POST["user_role"]) ? $_POST["user_role"] : UserRoles::Aluno;
        $active = isset($_POST["user_active"]) ? $_POST["user_active"] : "1";

        $userToFind = new User();
        $userToFind->setId($id);
        $userToFind->setRole($role);
        $userToFind->setActive($active);

        $errors = $this->userService->validateEditingData($userToFind);

        if (empty($errors)) {
            try {
                $this->userDao->editingUpdate($userToFind);

                $this->list();
                exit;
            }
            catch (PDOException $e) {
                array_push($errors, "Erro ao atualizar usuário no banco de dados"); 
            }
        }

        $errorMsgs = implode("<br>", $errors);
        $this->list([], $errorMsgs);
    }

    protected function alter() {
        $user = $this->findById();
        
        $dados["id"] = $user->getId();
        $dados["user"] = $user;
        $this->loadView("user/alter_user.php", $dados, "");
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
        $_SESSION["userActive"] = $user->getActive();
    }

    public function logout() {
        session_start();

        session_destroy();
        $this->loadView("user/signin.php", [], "");
    }

    protected function findByName() {
        $userName = $_GET["userName"];
        echo $this->userService->findUsersByName($userName);
    }
}

$usr = new UserController();