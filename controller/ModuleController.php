<?php

require_once(__DIR__ . "/../dao/ModuleDAO.php");
require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/Controller.php");

class ModuleController extends Controller
{

    private ModuleDAO $moduleDao;

    public function __construct()
    {
        $this->moduleDao = new ModuleDAO();
        $this->handleAction();
    }

    protected function save()
    {
        $module_name = $_POST['module_name'];
        $module_desc = $_POST['module_desc'];
        $module_subject = $_POST['module_subject'];

        $module = new Module();
        $module->setName($module_name);
        $module->setDescription($module_desc);
        $module->setSubject($module_subject);

        $this->moduleDao->insert($module);

        $this->loadView("create_module.php", []);
    }
}

$mod = new ModuleController();
