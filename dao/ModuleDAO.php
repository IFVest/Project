<?php

require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/../connection/Connection.php");

class ModuleDAO{

    public function insert(Module $module)
    {
        $conn = Connection::getConn();

        $sql = "INSERT INTO module (name, description) VALUES (:name,:desc)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('name', $module->getName());
        $stm->bindValue('desc', $module->getDescription());

        $stm->execute();
    }
}

?>