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
        $this->setActionDefault("list");
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
        $dados["lista"] = $this->moduleDao->list();

        $this->loadView("module/list_modules.php", $dados);

    }

    protected function create($dados = [], $errorMsgs = "")
    {
        $this->loadView("module/create_module.php", $dados, $errorMsgs);
    }

    protected function save()
    {
        $dados["id"] = $_POST['module_id'] ?? NULL;
        $module_name = $_POST['module_name'] ?? NULL;
        $module_desc = $_POST['module_desc'] ?? NULL;
        $module_diff = $_POST['module_diff'] ?? NULL;
        $module_min = intval($_POST['module_min']) ?? NULL;
        $module_subject = isset($_POST['module_subject']) ? $_POST['module_subject'] : NULL;

        $module = new Module();
        $module->setId($dados['id']);
        $module->setName($module_name);
        $module->setDescription($module_desc);
        $module->setDifficulty($module_diff);
        $module->setSubject($module_subject);
        $module->setMinimumPercentageCorrect($module_min);

        $errors = $this->moduleService->validateData($module);

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
                exit;

            } catch (PDOException $e) {
                $errors = "Erro ao salvar o módulo no banco de dados";
            }
            
        }
        
        $dados["module"] = $module;
        $errorMsgs = implode("<br>", $errors);
        $this->create($dados, $errorMsgs);
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

    protected function delete(){
        $module = $this->findById();

        if($module){
            $this->moduleDao->delete($module);
            $this->loadView("module/list_modules.php", []);
        }
        else{
            $this->loadView("module/list_modules.php", [], "Módulo não encontrado");
        }

        $this->list();
    }

    protected function findModulesBySubject()
    {
        $subject = $_GET["subject"];
        echo $this->moduleService->findModulesBySubject($subject);
    }
}

$mod = new ModuleController();
