<?php
error_reporting(1);
require_once(__DIR__ . "/../model/ExamModule.php");
require_once(__DIR__ . "/../util/config.php");
require_once(__DIR__ . "/../service/ModuleService.php");
require_once(__DIR__ . "/../service/UserAnswerService.php");
require_once(__DIR__ . "/../service/QuestionService.php");
require_once(__DIR__ . "/../dao/ExamModuleDAO.php");


class ExamModuleService{
    private ModuleService $moduleService;
    private UserAnswerService $userAnswerService;
    private QuestionService $questionService;
    private ExamModuleDAO $examModuleDao; 

    function __construct(){
        $this->moduleService = new ModuleService();
        $this->userAnswerService = new UserAnswerService();
        $this->questionService = new QuestionService();
        $this->examModuleDao = new ExamModuleDAO();
    }

    // Padrão de recebimento => $var['Matemática']['Module']='0'->id e $var['Matemática']['QuestionNumber']=9
    function handleRandomExamModules($exam_subjects_module_num){
        $exam_modules = [];

        foreach(Subjects::cases() as $subject):
            $subjectName = $subject->name;
            if(isset($exam_subjects_module_num[$subjectName])){
                
                $module = $exam_subjects_module_num[$subjectName]['Module'];
                $questions_num = $exam_subjects_module_num[$subjectName]['NumberQuestions'];

                if($module == 'ALL'){
                    $questions = $this->questionService->findRandomly($questions_num, $subjectName);
                    $questionsGroup = $this->splitByModule($questions);
                }else{
                    $module = $this->moduleService->findById($module);
                    $questionsGroup = [$this->questionService->findRandomly($questions_num, $subjectName, $module)];
                }

                foreach($questionsGroup as $questionsByModule){
                    $userAnswers = $this->userAnswerService->parseQuestionsToUserAnswers($questionsByModule);
                    $exam_module = new ExamModule();
                    $exam_module->setTotalQuestions(count($userAnswers));
                    $exam_module->setCorrectQuestions(0);
                    $exam_module->setIsProblem(_TRUE_);
                    $exam_module->setModule($userAnswers[0]->getQuestion()->getModule());
                    $exam_module->setUserAnswers($userAnswers);
                    
                    count($userAnswers)? array_push($exam_modules, $exam_module) : '';
                }

            }
        endforeach;

        return $exam_modules;
    }

    private function splitByModule($questions){
        $questionsByModule = [];
        foreach($questions as $question){
            if(!isset($questionsByModule[$question->getModule()])){
                $questionsByModule[$question->getModule()] = [];
            }
            $questionsByModule[$question->getModule()][] = $question;
        }
        return $questionsByModule;
    }

    function insertArray(Array $examModules, Exam $exam){
        foreach($examModules as $examModule):
            $examModule->setExam($exam);
            $this->examModuleDao->insert($examModule);
        endforeach;
    } 
} 