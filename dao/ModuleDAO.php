<?php

require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../dao/QuestionDAO.php");
require_once(__DIR__ . "/../dao/LessonDAO.php");

class ModuleDAO{

    private function mapModules($sql)
    {
        $modules = array();
        $questDao = new QuestionDAO();
        $lessonDao = new LessonDAO();

        foreach($sql as $mod){
            $module = new Module();
            $module->setId($mod['id']);
            $module->setName($mod['name']);
            $module->setDescription($mod['description']);
            $module->setDifficulty($mod['difficulty']);
            $module->setMinimumPercentageCorrect($mod['minimumPercentageCorrect']);
            $module->setSubject($mod['subject']);

            $questions = $questDao->findByModule($module);
            $module->setQuestions($questions);

            $lessons = $lessonDao->findByModuleId($mod['id']);
            $module->setLessons($lessons);

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

        if (count($modules) == 1) {
            return $modules[0];
        }
        else if(count($modules) > 1) {
            return "Mais de um módulo achado";
        }

        die("Modulo inválido");
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

        $sql = "INSERT INTO Module (name, description, difficulty, subject, minimumPercentageCorrect) VALUES (:name,:desc,:diff,:sub, :min)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('name', $module->getName());
        $stm->bindValue('desc', $module->getDescription());
        $stm->bindValue('diff', $module->getDifficulty());
        $stm->bindValue('sub', $module->getSubject());
        $stm->bindValue('min', $module->getMinimumPercentageCorrect());

        $stm->execute();
    }

    public function update(Module $module)
    {
        $conn = Connection::getConn();

        $sql = "UPDATE Module SET name = :name, description = :desc, difficulty = :diff, subject = :sub, minimumPercentageCorrect = :min WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue("name", $module->getName());
        $stm->bindValue("desc", $module->getDescription());
        $stm->bindValue("diff", $module->getDifficulty());
        $stm->bindValue("sub", $module->getSubject());
        $stm->bindValue('min', $module->getMinimumPercentageCorrect());
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
        return $this->mapModules($result);
    }
}

?>
