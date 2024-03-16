<?php

  namespace views;

  require_once 'vendor/autoload.php';

  class BaseView{

    private $twig;


    function __construct(){

      $this->dir = dirname(__dir__);
      $this->tpls = $this->dir.'/template';

      $this->method = 'index';
      $this->sub_path = '';

      $this->get_templates();

    }

    function get_templates(){

      foreach( scandir($this->tpls) as $f ){
        if (!in_array($f, array(".",".."))){
          $this->templates[$f] = file_get_contents($this->tpls.'/'.$f);
        }
      }

    }


    function sub_uri2methods($sub_uri){
      $expl = explode('/', $sub_uri, 2);

      $this->method = array_slice($expl, 0,1)[0];
      $this->sub_path = $expl[0];
    }


    function handle($sub_uri, $data){

      if($sub_uri){
        $this->sub_uri2methods($sub_uri);
      }


      if( method_exists($this, $this->method) )
      {
        $method = $this->method;
        $this->$method($this->sub_path);
      }
      else
      {
        echo "method not implemented";
      }
    }



    function render($tpl_file, $vars){

      $loader = new \Twig\Loader\ArrayLoader($this->templates);
      $this->twig = new \Twig\Environment($loader);


      return $this->twig->render($tpl_file, $vars);
    }


  }

?>