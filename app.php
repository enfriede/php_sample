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



    function req_demux2modules($request){

      $path = $request['path'];
      unset($request['path']);
      $data = $request;

      $path_expl = explode('/', $path, 2);

      $module_name = array_splice($path_expl, 0, 1)[0];
      $sub_uri = $path_expl ? $path_expl[0] : null;


      if( in_array($module_name, $this->modules) ){

        $module_class = '\modules\\'.$module_name.'\\view';
        $module = new $module_class();

        $module->handle($sub_uri, $data);

      }
      else
      {
        echo "module not loaded or not exists";
      }

    }


    function run(){
      $this->req_demux2modules($_REQUEST);
    }


  }

?>