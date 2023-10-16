<?php
require_once(__DIR__ . "/../connection/Connection.php");
require_once(__DIR__ . "/../model/SuggestedModule.php");
require_once(__DIR__ . "/../dao/ModuleDAO.php");

class SuggestedModuleDAO{

      private function mapSuggestedModule($sql){
        $suggestedModules = array();
        $moduleDao = new ModuleDAO();
        foreach($sql as $sug){
            $suggestedModule = new SuggestedModule();
            $suggestedModule->setId($sug['id']);
            $suggestedModule->setStudyPlan($sug['idStudyPlan']);

            $module = $moduleDao->findById($sug['idModule']);
            $suggestedModule->setModule($module);

            array_push($suggestedModules, $suggestedModule);
        }

        return $suggestedModules;
    }

    public function findById(int $id)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM SuggestedModule s WHERE s.id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $result = $stm->fetchAll();

        $suggestedModules = $this->mapSuggestedModule($result);

        return $suggestedModules[0];
    }

    public function findByStudyPlan($studyPlan)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM SuggestedModule s WHERE s.idStudyPlan = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$studyPlan->getId()]);
        $result = $stm->fetchAll();

        $suggestedModules = $this->mapSuggestedModule($result);

        return $suggestedModules;
    }

    public function list()
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM SuggestedMOdule";

        $stm = $conn->prepare($sql);
        $stm->execute();
        $result = $stm->fetchAll();

        return $this->mapSuggestedModule($result);
    }

    public function insert(SuggestedModule $suggestedModule){
        $conn = Connection::getConn();

        $sql = "INSERT INTO SuggestedModule (idStudyPlan, idModule) VALUES (:idStudyPlan, :idModule)";

        $stm = $conn->prepare($sql);
        $stm->bindValue('idStudyPlan', $suggestedModule->getStudyPlan()->getId());
        $stm->bindValue('idModule', $suggestedModule->getModule()->getId());

        $stm->execute();
    }

    public function delete(SuggestedModule $suggestedModule){
        $conn = Connection::getConn();

        $sql = "DELETE FROM SuggestedModule WHERE id = ?";

        $stm = $conn->prepare($sql);
        $stm->execute([$suggestedModule->getId()]);
    }
}

?>