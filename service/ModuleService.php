<?php
require_once(__DIR__ . "/../dao/ModuleDAO.php");
ini_set("display_errors", "1");
error_reporting(E_ALL);
class ModuleService{
    private ModuleDAO $moduleDAO;
    
    function __construct(){
        $this->moduleDAO = new ModuleDAO();
    }

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