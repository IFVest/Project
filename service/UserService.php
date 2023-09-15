<?php

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../dao/UserDAO.php");
require_once(__DIR__ . "/../model/UserRoles.php");

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

        return $errors;
    }

    public function validateEditingData(User $user) {
        $errors = array();
        
        $userFound = "";
        try{
            $userFound = $this->userDao->findById($user->getId());
        } 
        catch (PDOException $e) {
            array_push($errors, "Usuário não encontrado");
        }

        if ($userFound->getRole() == UserRoles::Administrador->name) {
            array_push($errors, "Não é possível alterar um Administrador");
        }

        $isValidRole = $this->validRole($user->getRole());
        if (!$isValidRole) {
            array_push($errors, "Função não é válida");
        }
        
        return $errors;
    }

    private function validRole($userRole) {
        foreach(UserRoles::cases() as $role) {
            if ($userRole == $role->name) {
                return true;
            }
        }

        return false;
    }

    public function findUserByEmail($email) {
        return $this->userDao->findByEmail($email);
    }

    public function findUsersByName($name) {
        $users = $this->userDao->findByName($name);
        $usersJSON = json_encode($users);
        return $usersJSON;

    }
}