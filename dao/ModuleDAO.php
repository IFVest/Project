<?php

require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/../connection/Connection.php");
<<<<<<< HEAD
class ModuleDAO{
    private function mapModules($sql){
=======
require_once(__DIR__ . "/../dao/QuestionDAO.php");

class ModuleDAO{

    private function mapModules($sql)
    {
>>>>>>> 8456543e7376c94c24e1e6bc88c40e1047742b76
        $modules = array();

        foreach($sql as $mod){
            $module = new Module();
            $module->setId($mod['id']);
            $module->setName($mod['name']);
            $module->setDescription($mod['description']);
            $module->setSubject($mod['subject']);

<<<<<<< HEAD
=======
            $questDao = new QuestionDAO();
            $questions = $questDao->findByModule($module);
            $module->setQuestions($questions);

>>>>>>> 8456543e7376c94c24e1e6bc88c40e1047742b76
            array_push($modules, $module);
        }

        return $modules;
    }

<<<<<<< HEAD
    public function findById(int $id){
=======
    public function findById(int $id)
    {
>>>>>>> 8456543e7376c94c24e1e6bc88c40e1047742b76
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Module m WHERE m.id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $modules = $this->mapModules($result);

        if (count($modules) == 1) {
            return $modules[0];
        }
<<<<<<< HEAD
        else if(count($modules) == 0) {
            return null;
        }

        die("ModuleDAO.findById() - ERRO: Mais de um módulo encontrado");
    }

    public function list(){
=======
        else if(count($modules) > 1) {
            return "More than 1 module found";
        }

        die("Invalid module");
    }

    public function list()
    {
>>>>>>> 8456543e7376c94c24e1e6bc88c40e1047742b76
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Module";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapModules($result);
    }

<<<<<<< HEAD
    public function insert(Module $module){
=======
    public function insert(Module $module)
    {
>>>>>>> 8456543e7376c94c24e1e6bc88c40e1047742b76
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
        $stm->bindValue("name", $module->getName());
        $stm->bindValue("desc", $module->getDescription());
        $stm->bindValue("sub", $module->getSubject());
        $stm->bindValue("id", $module->getId());
        $stm->execute();
    }

    public function delete(Module $module)
    {
        $conn = Connection::getConn();

        $sql = "DELETE FROM Module WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$module->getId()]);
    }

    public function findBySubject($subject) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Module WHERE subject = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$subject]);
        $result = $stm->fetchAll();
<<<<<<< HEAD

        return $this->mapModules($result);
    }
}
=======
        return $this->mapModules($result);
    }
}

?>
>>>>>>> 8456543e7376c94c24e1e6bc88c40e1047742b76
