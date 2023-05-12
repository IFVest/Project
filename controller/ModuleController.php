<?php

require_once(__DIR__ . "/../dao/ModuleDAO.php");
require_once(__DIR__ . "/../model/Module.php");
require_once(__DIR__ . "/Controller.php");
require_once(__DIR__ . "/../service/ModuleService.php");

class ModuleController extends Controller
{

    private ModuleDAO $moduleDao;
    private ModuleService $moduleService;

    public function __construct()
    {
        $this->moduleDao = new ModuleDAO();
        $this->moduleService = new ModuleService();
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

    public function list($errorMsgs = "")
    {
        $dados["lista"] = $this->moduleDao->list();

        $this->loadView("module/list_modules.php", $dados, $errorMsgs);

    }

    protected function create()
    {
        $this->loadView("module/create_module.php", []);
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
        
        $errors = $this->moduleService->validarDados($module);

        if (empty($errors)) {
            try{

                if ($dados["id"] == NULL)
                {
                    $this->moduleDao->insert($module);
                }
                else
                {
                    $this->moduleDao->update($module);
                }
                
                $this->list();

            } catch (PDOException $e) {
                $errors = "Erro ao salvar o módulo no banco de dados";
            }
            
        }
        
        $dados["module"] = $module;
        $errorMsgs = implode("<br>", $errors);
        $this->list($errorMsgs);
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
            $this->list();
        }
    }

    protected function delete()
    {
        $module = $this->findById();

        if($module)
        {
            $this->moduleDao->delete($module);
        }

        $this->list();
    }

    public function findByModuleId($moduleId)
    {
        return $this->moduleDao->findById($moduleId);
    }

    public function findBySubject() {

        $module_subject = $_GET['subject'];
        $modules = $this->moduleDao->findBySubject($module_subject);
    }

    public function test()
    {
        echo 'test';
    }
}

$mod = new ModuleController();
