<?php

  namespace views;

  require_once 'vendor/autoload.php';

  class BaseView{

    private $twig;


    function __construct(){

      $this->dir = dirname(__dir__);
      $this->tpls = $this->dir.'/template';

      foreach( scandir($this->tpls) as $f ){

        if (!in_array($f, array(".",".."))){
          $this->templates[$f] = file_get_contents($this->tpls.'/'.$f);
        }
      }

    }


    function split_args($args){
      return explode('/', $args);
    }


    function render($tpl_file, $vars){

      $loader = new \Twig\Loader\ArrayLoader($this->templates);
      $this->twig = new \Twig\Environment($loader);


      return $this->twig->render($tpl_file, $vars);
    }


  }

?>