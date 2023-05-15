<?php
    ini_set('display_errors', 1);
    error_reporting(E_ERROR);
    require_once(__DIR__ . "/../util/config.php");

class Controller
{

    protected function handleAction()
    {
        $action = NULL;
        if (isset($_GET['action']))
            $action = $_GET['action'];

        $this->callAction($action);
    }

    protected function callAction($methodName)
    {
        $methodNoAction = "noAction";
        if ($methodName && method_exists($this, $methodName)){
            $this->$methodName();
        }else if (method_exists($this, $methodNoAction)){
            $this->$methodNoAction();
        }
        else {
            throw new BadFunctionCallException("Ação não implementada");
        }
    }

    protected function loadView(string $path, array $dados, string $msgErro = "", string $msgSucesso = "")
    {
        $caminho = __DIR__ . "/../view/" . $path;
        if (file_exists($caminho)) {
            require $caminho;
        } else {
            echo "Erro ao carrega a view solicitada<br>";
            echo "Caminho: " . $caminho;
        }
    }

    private function noAction()
    {
        echo "Ação não encontrada no controller.<br>";
        echo "Verifique com o administrador do sistema.";
    }
}
