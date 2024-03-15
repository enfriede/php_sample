<?php

  class App{

    private $classes = [
      'BaseView',
    ];

    private $modules = [
      'dashboard',
      'contact'
    ];


    function init(){

      foreach( $this->classes as $c ){
        include dirname(__file__) .'/classes/'. $c .'.php';
      }

      foreach( $this->modules as $m ){
        include dirname(__file__) .'/modules/'. $m .'/views.php';
      }
    }


    function handle($request){

      $pattern = "/^\/*([a-z0-9]+)+\/*([a-z0-9]+)*\/*([a-z\/]+)*/i";
      preg_match_all($pattern, $request, $url_match, PREG_SET_ORDER);

      $url_match = $url_match[0];


      $fullpath = array_key_exists(0, $url_match) ? $url_match[0] : null;
      $model    = array_key_exists(1, $url_match) ? $url_match[1] : null;
      $method   = array_key_exists(2, $url_match) ? $url_match[2] : 'index';
      $args     = array_key_exists(3, $url_match) ? $url_match[3] : null;


      if( in_array($model, $this->modules) ){

        $class = '\modules\\'.$model.'\\view';
        $modules = new $class();

        $method = trim($method, '/');
        $args = trim($args, '/');

        if( method_exists($modules, $method) )
        {
          $modules->$method($args);
        }
        else
        {
          echo "method do not exists";
        }
      }else{

        echo file_get_contents(dirname(__file__) .'/'.$request);

      }

    }

  }

?>