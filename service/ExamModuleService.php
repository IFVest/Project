<?php
error_reporting(1);
require_once(__DIR__ . "/../model/ExamModule.php");
require_once(__DIR__ . "/../service/ModuleService.php");
require_once(__DIR__ . "/../service/UserAnswerService.php");
require_once(__DIR__ . "/../dao/ExamModuleDAO.php");


class ExamModuleService{
    private ModuleService $moduleService; 
    private UserAnswerService $userAnswerService; 
    private ExamModuleDAO $examModuleDao; 

    function __construct(){
        $this->moduleService = new ModuleService();
        $this->userAnswerService = new UserAnswerService();
        $this->examModuleDao = new ExamModuleDAO();
    }

    // Padrão de recebimento => $var['Matemática']['Module']='0'->id e $var['Matemática']['QuestionNumber']=9
    function handleRandomExamModules($exam_subjects_module_num){
        $exam_modules = [];

        foreach(Subjects::cases() as $subject):
            $subjectName = $subject->name;
            if(!isset($exam_subjects_module_num[$subjectName])){
               break; 
            }
            $module = $exam_subjects_module_num[$subjectName]['Module'];
            $questions_num = $exam_subjects_module_num[$subjectName]['NumberQuestions'];
            
            $modules = [];
            if($module == 'ALL'){
                $modules = $this->moduleService->findRandomlyBySubject($subjectName, $questions_num);
            }else{
                $module = $this->moduleService->findById($module);
                $modules = [$module];
            }

            $num_questions_by_module = $this->defineQuestionsNum(count($modules), $questions_num);
            for($i = 0; $i<count($modules); $i++){
                $userAnswers = $this->userAnswerService->handleRandomQuestions($modules[$i], $num_questions_by_module[$i]);
                $exam_module = new ExamModule();
                $exam_module->setTotalQuestions(count($userAnswers));
                $exam_module->setCorrectQuestions(0);
                $exam_module->setIsProblem(true);
                $exam_module->setModule($modules[$i]);
                $exam_module->setUserAnswers($userAnswers);
                array_push($exam_modules, $exam_module);
            }
        endforeach;

        return $exam_modules;
    }

    private function defineQuestionsNum($modulesNum, $questionsNum){
        $questionsNumAux = $questionsNum;
        $result = [];
        for($i=0; $i<$modulesNum; $i++){
            $range = $questionsNumAux - $modulesNum + 1 + $i;
            $numberQuestions = ($i == ($modulesNum - 1))? $range : rand(1, $range);
            $questionsNumAux -= $numberQuestions;
            array_push($result, $numberQuestions);
        }
        return $result;
    }

    function insertArray(Array $examModules, Exam $exam){
        foreach($examModules as $examModule):
            echo $examModule->getModule()->getName();
            $examModule->setExam($exam);
            $this->examModuleDao->insert($examModule);
        endforeach;
    } 
} 