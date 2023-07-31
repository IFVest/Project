<?php

require_once(__DIR__ . "/../dao/UserDAO.php");

class UserService {
    private UserDAO $userDao;

    public function __construct() {
        $this->userDao = new UserDAO();
    }

    public function findUserByEmail($email) {
        
    }
}