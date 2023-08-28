<?php
error_reporting(1);
require_once(__DIR__ . "/../model/ExamModule.php");
require_once(__DIR__ . "/../dao/ExamDAO.php");
require_once(__DIR__ . "/../dao/ModuleDAO.php");
require_once(__DIR__ . "/../dao/UserAnswerDAO.php");
require_once(__DIR__ . "/../service/UserAnswerService.php");
require_once(__DIR__ . "/../connection/Connection.php");

class ExamModuleDAO{

    function __construct(){

    }

    private function mapExamModules($sql){
        $examDao = new ExamDAO();
        $moduleDao = new ModuleDAO();
        $userAnswerDao = new UserAnswerDAO();
        $examModules = array();

        foreach($sql as $exMod){
            $examModule = new ExamModule();
            $examModule->setId($exMod['id']);
            $examModule->setTotalQuestions($exMod['totalQuestions']);
            $examModule->setCorrectQuestions($exMod['correctQuestions']);
            $examModule->setIsProblem($exMod['isProblem']);

            $examModule->setExam($exMod['idExam']);

            $module = $moduleDao->findById($exMod['idModule']);
            $examModule->setModule($module);

            $userAnswers = $userAnswerDao->findByExamModule($examModule);
            $examModule->setUserAnswers($userAnswers);

            array_push($examModules, $examModule);
        }

        return $examModules;
    }

    public function findById(int $id){
        $conn = Connection::getConn();
        $sql = "SELECT * FROM ExamModule em WHERE em.id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $examModules = $this->mapExamModules($result);

        return $examModules[0];
    }

    public function findByExam(Exam $exam){
        $conn = Connection::getConn();
        $sql = "SELECT * FROM ExamModule em WHERE em.idExam = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$exam->getId()]);
        $result = $stm->fetchAll();

        $examModules = $this->mapExamModules($result);

        return $examModules;
    }

    public function list(){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM ExamModule";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapExamModules($result);
    }

    public function insert(ExamModule $examModule){
        $conn = Connection::getConn();

        $sql = "INSERT INTO ExamModule (totalQuestions, correctQuestions, isProblem, idExam, idModule) VALUES 
            (:totalQuestions, :correctQuestions, :isProblem, :exam, :module)";
        $stm = $conn->prepare($sql);
        $stm->bindValue('totalQuestions', $examModule->getTotalQuestions());
        $stm->bindValue('correctQuestions', $examModule->getCorrectQuestions());
        $stm->bindValue('isProblem', $examModule->getIsProblem());
        $stm->bindValue('exam', $examModule->getExam()->getId());
        $stm->bindValue('module', $examModule->getModule()->getId());
        $stm->execute();

        //Pegando o último ID inserido, no caso a questão no situação. 
        $examModule->setId($conn->lastInsertId());
        $userAnswerService = new UserAnswerService();
        $userAnswerService->insertArray($examModule->getUserAnswers(), $examModule); 
    }

    public function update(ExamModule $examModule){
        $conn = Connection::getConn();

        $sql = "UPDATE ExamModule SET totalQuestions = :totalQuestions, correctQuestions = :correctQuestions,
            isProblem= :isProblem, idExam = :exam, idModule = :module WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue('totalQuestions', $examModule->getTotalQuestions());
        $stm->bindValue('correctQuestions', $examModule->getCorrectQuestions());
        $stm->bindValue('isProblem', $examModule->getIsProblem());
        $stm->bindValue('exam', $examModule->getExam());
        $stm->bindValue('module', $examModule->getModule()->getId());
        $stm->bindValue('id', $examModule->getId());
        $stm->execute();
    }

    public function delete(ExamModule $examModule){
        $conn = Connection::getConn();
        $sql = "DELETE FROM ExamModule WHERE id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$examModule->getId()]);
    }
}

?>