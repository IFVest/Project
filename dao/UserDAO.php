<?php

require_once(__DIR__ . "/../model/User.php");
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
            $user->setRoles($us['roles']);

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

        $sql = "INSERT INTO User (email, password, completeName, roles) VALUES (:email, :password, :completeName, :roles)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('email', $user->getEmail());
        $stm->bindValue('password', $user->getPassword());
        $stm->bindValue('completeName', $user->getCompleteName());
        $stm->bindValue('roles', $user->getRoles());
        $stm->execute();
    }

    public function update(User $user){
        $conn = Connection::getConn();

        $sql = "UPDATE User SET email = :email, password=:password, completeName=:completeName, roles=:roles WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue('email', $user->getEmail());
        $stm->bindValue('password', $user->getPassword());
        $stm->bindValue('completeName', $user->getCompleteName());
        $stm->bindValue('roles', $user->getRoles());
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