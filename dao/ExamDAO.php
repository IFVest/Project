<?php
error_reporting(E_ERROR);
require_once(__DIR__ . "/../model/Exam.php");
require_once(__DIR__ . "/../dao/ExamModuleDAO.php");
require_once(__DIR__ . "/../dao/UserDAO.php");
require_once(__DIR__ . "/../service/ExamModuleService.php");
require_once(__DIR__ . "/../connection/Connection.php");

class ExamDAO{
    private ExamModuleDAO $examModuleDao;
    private UserDAO $userDAO;

    function __construct(){
        $this->examModuleDao = new ExamModuleDAO();
        $this->userDAO = new UserDAO();
    }

    private function mapExams($sql){
        $exams = array();

        foreach($sql as $exam_sql){
            $exam = new Exam();
            $exam->setId($exam_sql['id']);

            $user = $this->userDao->findById($exam_sql['idUser']);
            $exam->setUser($user);

            $examModules = $this->examModuleDao->findByExam($exam);
            $question->setExamModules($examModules);

            array_push($exams, $exam);
        }

        return $questions;
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

        $sql = "INSERT INTO Exam (idUser) VALUES (:user)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('user', $exam->getUser()->getId());

        $stm->execute();

        //Pegando o último ID inserido, no caso a questão no situação. 
        $examModuleService = new ExamModuleService();
        $exam->setId($conn->lastInsertId());
        $examModuleService->insertArray($exam->getExamModules(), $exam); 
    }

    public function delete(Question $question){
        $conn = Connection::getConn();
        $sql = "DELETE FROM Question WHERE id = ?";
        $stm = $conn->prepare($sql);

        $this->alternativeDao->deleteByQuestion($question);

        $stm->execute([$question->getId()]);
    }
}

?>