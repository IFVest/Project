<?php

require_once(__DIR__ . "/../model/Module.php");

class ModuleService {

    public function validarDados(Module $module) {
        $errors = array();

        if (! $module->getName()) {
            array_push($errors, "O campo NOME é obrigatório");
        }

        return $errors;
    }
}
?>