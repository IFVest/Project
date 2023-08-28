<?php

require_once(__DIR__ . "/../model/User.php");
require_once(__DIR__ . "/../util/config.php");
require_once(__DIR__ . "/../connection/Connection.php");

class UserDAO{
    private function mapUsers($sql){
        $users = array();

        foreach($sql as $us){
            $user = new User();
            $user->setId($us['id']);
            $user->setEmail($us['email']);
            $user->setPassword($us['password']);
            $user->setCompleteName($us['completeName']);
            $user->setRole($us['role']);

            array_push($users, $user);
        }

        return $users;
    }

    public function findById(int $id){
        $conn = Connection::getConn();
        $sql = "SELECT * FROM User u WHERE u.id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $users= $this->mapUsers($result);

        return $users[0];
    }

    public function list(){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM User";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapUsers($result);
    }

    public function insert(User $user){
        $conn = Connection::getConn();

        $sql = "INSERT INTO User (email, password, completeName, role, active) VALUES (:email, :password, :completeName, :role, :active)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('email', $user->getEmail());
        $stm->bindValue('password', $user->getPassword());
        $stm->bindValue('completeName', $user->getCompleteName());
        $stm->bindValue('role', $user->getRole());
        $stm->bindValue('active', chr(_TRUE_)); // é usado char pois tabela active é do tipo BIT
        $stm->execute();
    }

    public function update(User $user){
        $conn = Connection::getConn();

        $sql = "UPDATE User SET email = :email, password=:password, completeName=:completeName, role=:role, active=:active WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue('email', $user->getEmail());
        $stm->bindValue('password', $user->getPassword());
        $stm->bindValue('completeName', $user->getCompleteName());
        $stm->bindValue('role', $user->getRole());
        $stm->bindValue('active', $user->getActive());
        $stm->bindValue('id', $user->getId());
        $stm->execute();
    }

    public function editingUpdate(User $user) {
        $conn = Connection::getConn();

        $sql = "UPDATE User SET role = :role, active = :active WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue('role', $user->getRole());

        $isActive = $user->getActive();
        if ($isActive == "0") {
            $stm->bindValue('active', chr(_FALSE_));
        }
        else {
            $stm->bindValue('active', chr(_TRUE_));
           
        }
        $stm->bindValue('id', $user->getId());
        $stm->execute();
    }

    public function delete(User $user){
        $conn = Connection::getConn();
        $sql = "DELETE FROM User WHERE id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$user->getId()]);
    }

    public function findByEmail($email) {
        $conn = Connection::getConn();
        
        $sql = "SELECT * FROM User WHERE email = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$email]);
        $result = $stm->fetchAll();

        return $this->mapUsers($result);
    }
}

?>