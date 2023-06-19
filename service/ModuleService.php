<?php

require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/../model/Subjects.php");

class ModuleService {

    public function validarDados(Module $module) {
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
}
?>