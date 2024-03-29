<?php

require_once(__DIR__ . "/../model/Exam.php");
require_once(__DIR__ . "/../dao/ExamModuleDAO.php");
require_once(__DIR__ . "/../dao/UserDAO.php");
require_once(__DIR__ . "/../dao/StudyPlanDAO.php");
require_once(__DIR__ . "/../service/ExamModuleService.php");
require_once(__DIR__ . "/../connection/Connection.php");

class ExamDAO{
    function __construct(){
    }

    private function mapExams($sql){
        $examModuleDao = new ExamModuleDAO();
        $studyPlanDao = new StudyPlanDAO();
        $userDao = new UserDAO();
        $exams = array();

        foreach($sql as $exam_sql){
            $exam = new Exam();
            $exam->setId($exam_sql['id']);

            $user = $userDao->findById($exam_sql['idUser']);
            $exam->setUser($user);

            $examModules = $examModuleDao->findByExam($exam);
            $exam->setExamModules($examModules);

            $exam->setFinished($exam_sql['finished']);
            $exam->setTotalQuestions($exam_sql['totalQuestions']);
            $exam->setTotalQuestionsCorrect($exam_sql['totalQuestionsCorrect']);
            $exam->setPercentageCorrect($exam_sql['percentageCorrect']);
            $exam->setFinished($exam_sql['finished']);

            $studyPlan = $studyPlanDao->findByExam($exam);
            $exam->setStudyPlans($studyPlan);

            array_push($exams, $exam);
        }

        return $exams;
    }

    public function findById(int $id){
        $conn = Connection::getConn();
        $sql = "SELECT * FROM Exam e WHERE e.id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $exams = $this->mapExams($result);

        return $exams[0];
    }

    public function list(){
        $conn = Connection::getConn();

        $sql = "SELECT * FROM Exam";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapExams($result);
    }

    public function insert(Exam $exam){
        $conn = Connection::getConn();

        $sql = "INSERT INTO Exam (idUser, finished, totalQuestions) VALUES (:user, :finished, :totalQuest)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('user', $exam->getUser()->getId());
        $stm->bindValue('finished', $exam->getFinished());
        $stm->bindValue('totalQuest', $exam->getTotalQuestions());
        $stm->execute();

        //Pegando o último ID inserido, no caso a questão no situação. 
        $examModuleService = new ExamModuleService();
        $exam->setId($conn->lastInsertId());
        $examModuleService->insertArray($exam->getExamModules(), $exam); 
    }

    public function update(Exam $exam){
        $conn = Connection::getConn();
        $sql = "UPDATE Exam set finished = :finished WHERE id = :id";

        $stm = $conn->prepare($sql);
        $stm->bindValue('finished', $exam->getFinished());
        $stm->bindValue('id', $exam->getId());
        $stm->execute();
    }

    public function delete(Exam $exam){
        $conn = Connection::getConn();
        $sql = "DELETE FROM Exam WHERE id = ?";
        $stm = $conn->prepare($sql);

        $stm->execute([$exam->getId()]);
    }

    public function findByUser($idUser)
    {
        $conn = Connection::getConn();
        $sql = "SELECT * FROM Exam e WHERE e.idUser = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$idUser]);
        $result = $stm->fetchAll();

        $exams = $this->mapExams($result);

        return $exams;
    }

    public function findByUserAnswer($getId){
        $conn = Connection::getConn();
        $sql = "SELECT e.* FROM Exam e, ExamModule em, UserAnswer ua WHERE ua.idExamModule = em.id AND em.idExam = e.id AND ua.id = ?";
        $stm = $conn->prepare($sql);
        $stm->execute([$getId]);
        $result = $stm->fetchAll();

        $exams = $this->mapExams($result);

        return $exams[0];
    }
}

?>