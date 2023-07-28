<?php

require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/../dao/ModuleDAO.php");
require_once(__DIR__ . "/../model/Subjects.php");
<<<<<<< HEAD
=======
ini_set("display_errors", "1");
error_reporting(E_ALL);
>>>>>>> 8456543e7376c94c24e1e6bc88c40e1047742b76

class ModuleService {

    private $moduleDao;

    public function __construct()
    {
        $this->moduleDao = new ModuleDAO;
    }

<<<<<<< HEAD
    public function validarDados(Module $module) {
=======
    public function validateData(Module $module) {
>>>>>>> 8456543e7376c94c24e1e6bc88c40e1047742b76
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
<<<<<<< HEAD
}
?>
=======

    function findRandomlyBySubject($subjectName, $maxModulesNum){
        $modules = [];
        $allModules = $this->moduleDAO->findBySubject($subjectName);
        if(count($allModules) != 0){
            $modulesNumber = ($maxModulesNum < count($allModules))? rand(1, $maxModulesNum) : count($allModules);
            for($i = 0; $i<$modulesNumber; $i++){
                $modulePosition = rand(1, count($allModules)) - 1;
                if(!in_array($allModules[$modulePosition], $modules)){
                    array_push($modules, $allModules[$modulePosition]);
                }else{
                    $i--;
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


    
>>>>>>> 8456543e7376c94c24e1e6bc88c40e1047742b76
