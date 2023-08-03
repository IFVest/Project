<?php

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../dao/UserDAO.php");

class UserService {
    private UserDAO $userDao;

    public function __construct() {
        $this->userDao = new UserDAO();
    }

    public function validateData(User $user) {
        $errors = array();

        if (! $user->getEmail()) {
            array_push($errors, "O campo EMAIL é obrigatório");
        }
        if (! $user->getPassword()) {
            array_push($errors, "O campo SENHA é obrigatório");
        }
        
        // Verificar se senhas batem
        $foundUser = $this->findUserByEmail($user->getEmail())[0];
        if (! password_verify($user->getPassword(), $foundUser->getPassword())) {
            array_push($errors, "Senha errada");
        }

        return $errors;
    }

    public function findUserByEmail($email) {
        return $this->userDao->findByEmail($email);
    }
}