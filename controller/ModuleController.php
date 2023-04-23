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

    private function findById()
    {
        if (isset($_GET['id']))
        {
            $id = $_GET['id'];
            return $this->moduleDao->findById($id);
        }
    }

    public function list()
    {
        return $this->moduleDao->list();
    }

    protected function save()
    {
        $dados["id"] = isset($_POST['module_id']) ? $_POST['module_id'] : NULL;
        $module_name = isset($_POST['module_name']) ? $_POST['module_name'] : NULL;
        $module_desc = isset($_POST['module_desc']) ? $_POST['module_desc'] : NULL;
        $module_subject = isset($_POST['module_subject']) ? $_POST['module_subject'] : NULL;

        $module = new Module();
        $module->setId($dados['id']);
        $module->setName($module_name);
        $module->setDescription($module_desc);
        $module->setSubject($module_subject);

        if ($dados["id"] == NULL)
        {
            $this->moduleDao->insert($module);
        }
        else
        {
            $this->moduleDao->update($module);
        }
        
        $this->loadView("module/list_modules.php", []);
    }

    protected function edit()
    {
        $module = $this->findById();

        if($module)
        {
            $dados["id"] = $module->getId();
            $dados["module"] = $module;
            $this->loadView("module/create_module.php", $dados);
        }
        else
        {
            $this->loadView("module/list_modules.php", [], "Módulo não encontrado");
        }
    }

    protected function delete()
    {
        $module = $this->findById();

        if($module)
        {
            $this->moduleDao->delete($module);
            $this->loadView("module/list_modules.php", []);
        }
        else
        {
            $this->loadView("module/list_modules.php", [], "Módulo não encontrado");
        }
    }

    public function findByModuleId($moduleId)
    {
        return $this->moduleDao->findById($moduleId);
    }
}

$mod = new ModuleController();
