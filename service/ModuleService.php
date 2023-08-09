<?php

require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/../dao/ModuleDAO.php");
require_once(__DIR__ . "/../model/Subjects.php");
ini_set("display_errors", "1");
error_reporting(E_ALL);

class ModuleService {

    private $moduleDao;

    public function __construct()
    {
        $this->moduleDao = new ModuleDAO();
    }

    public function validateData(Module $module) {
        $errors = array();
        $moduleSubject = $module->getSubject();

        if (! $module->getName()) {
            array_push($errors, "O campo NOME é obrigatório");
        }
        
        $isValidSubject = false;
        foreach(Subjects::cases() as $subject) {
            if ($subject->value == $moduleSubject) {
                $isValidSubject = true;
            }

        }

        if (! $isValidSubject) {
            array_push($errors, "Campo MATÉRIA não é válido");
        }

        return $errors;
    }

    public function findModulesBySubject($subject)
    {
        $modules = $this->moduleDao->findBySubject($subject);
        $modulesJSON = json_encode($modules);
        return $modulesJSON;
    }

    function findRandomlyBySubject($subjectName, $maxModulesNum){
        $modules = [];
        $allModules = $this->moduleDao->findBySubject($subjectName);
        if(count($allModules) != 0){
            $modulesNumber = ($maxModulesNum < count($allModules))? rand(1, $maxModulesNum) : count($allModules);
            for($i = 0; $i<$modulesNumber; $i++){
                $modulePosition = rand(0, count($allModules)-1);
                if(!in_array($allModules[$modulePosition], $modules)){
                    array_push($modules, $allModules[$modulePosition]);
                }else{
                    $i -= 1;
                }
            }
        } 
        return $modules;
    }

    function findById($id){
        return $this->moduleDao->findById($id);
    }
}
?>


    
