<?php
require_once(__DIR__ . '/../util/config.php');
require_once(__DIR__ . "/../model/Subjects.php");
require_once(__DIR__ . "/Controller.php");
error_reporting(1);

class SubjectsController extends Controller{
      function __construct(){
            $this->handleAction();
      }

      protected function findAll(){
            $text = '';
            foreach(Subjects::cases() as $sub){
                $text .= ($sub->name.' ');  
            }
            echo $text;
      }
}

$subController = new SubjectsController();
