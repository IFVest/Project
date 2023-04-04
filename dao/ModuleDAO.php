<?php

require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/../connection/Connection.php");

class ModuleDAO{

    public function insert(Module $module)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO Module (name, description, subject) VALUES (:name,:desc,:sub)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('name', $module->getName());
        $stm->bindValue('desc', $module->getDescription());
        $stm->bindValue('sub', $module->getSubject());

        $stm->execute();
    }
}

?>