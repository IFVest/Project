<?php
require_once(__DIR__ . '/../util/config.php');
require_once(__DIR__ . "/../model/Subject.php");
require_once(__DIR__ . "/Controller.php");
error_reporting(1);

class SubjectsController extends Controller{
    function __construct(){
          $this->handleAction();
    }

    protected function findAll(){
          
          echo Subjects::cases();
    }
}

$subController = new SubjectsController();
