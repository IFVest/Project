<?php
error_reporting(1);
require_once(__DIR__ . "/../model/ExamModule.php");
require_once(__DIR__ . "/../service/UserAnswerService.php");
require_once(__DIR__ . "/../connection/Connection.php");

class ExamModuleDAO{

    function __construct(){
        $this->userAnswerService = new UserAnswerService();
    }

    private function mapExamModules($sql){
        $examModules = array();

        foreach($sql as $exMod){
            $examModule = new Question();
            $examModule->setId($exMod['id']);
            $examModule->setText($exMod['totalQuestions']);
            $examModule->setCorrectQuestions($exMod['correctQuestions']);
            $examModule->setIsProblem($exMod['isProblem']);

            $exam = $this->examDao->findById($exMod['idExam']);
            $examModule->setExam($exam);

            $module = $this->moduleDao->findById($exMod['idModule']);
            $exam->setmodule($module);

            $userAnswers = $this->userAnswerDAO->findByExamModule($examModule);
            $examModule->setUserAnswer($userAnswers);

            array_push($examModules, $examModue);
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

        return $examModules[0];
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
        $this->userAnswerService->insertArray($examModule->getUserAnswers()); 
    }

    public function update(ExamModule $examModule){
        $conn = Connection::getConn();

        $sql = "UPDATE ExamModule SET totalQuestions = :totalQuestions, correctQuestions = :correctQuestions
            isProblem= :isProblem, idExam = :exam idModule = :module WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue('totalQuestions', $examModule->getTotalQuestions());
        $stm->bindValue('correctQuestions', $examModule->getCorrectQuestions());
        $stm->bindValue('isProblem', $examModule->getIsProblem());
        $stm->bindValue('exam', $examModule->getExam()->getId());
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