<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . "/../util/config.php");

class Controller
{
    private String $actionDefault = "";

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

        //Se o médoto extiver em branco, chama o $actionDefault (caso exista)
        if ( (!$methodName) || empty(trim($methodName)) && method_exists($this, $methodName)) {
            $method = $this->actionDefault;
            $this->$method();
        
        //Verifica se o método da action recebido por parâmetro existe na classe
        //Se sim, chama-o
        } else if ($methodName && method_exists($this, $methodName)){
            $this->$methodName();

            //Código para esconder os parâmetros da URL, inclusive o action
            // $url_parts = parse_url($_SERVER['REQUEST_URI']); //Divide a URL em 'path' e 'query'
            // echo "<script>window.history.replaceState({}, '', '{$url_parts['path']}');</script>";
        }

        else {
            throw new BadFunctionCallException("Ação não implementada");
        }
    }

    protected function loadView(string $path, array $dados, string $errorMsgs = "", string $msgSucesso = "")
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

    public function setActionDefault($actionDefault) {
        $this->actionDefault = $actionDefault;

        return $this;
    }
}
