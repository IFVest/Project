<?php

require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/../connection/Connection.php");

class ModuleDAO{

    private function mapModules($sql)
    {
        $modules = array();

        foreach($sql as $mod){
            $module = new Module();
            $module->setId($mod['id']);
            $module->setName($mod['name']);
            $module->setDescription($mod['description']);
            $module->setSubject($mod['subject']);

            array_push($modules, $module);
        }

        return $modules;
    }

    public function findById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Module m WHERE m.id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $modules = $this->mapModules($result);

        return $modules[0];
    }

    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Module";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapModules($result);
    }

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

    public function update(Module $module)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE Module SET name = :name, description = :desc, subject = :sub WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue('name', $module->getName());
        $stm->bindValue('desc', $module->getDescription());
        $stm->bindValue('sub', $module->getSubject());
        $stm->bindValue('id', $module->getId());
        $stm->execute();
    }

    public function delete(Module $module)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM Module WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$module->getId()]);
    }
}

?>