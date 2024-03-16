<?php

  namespace Requests;

  class RequestHandler{

    function __construct($modules){
      $this->modules = $modules;

      $this->module = 'dashboard';
      $this->method = 'index';
      $this->sub_path = null;

    }


    function elab_path($path){
      list($this->module, $this->method, $this->sub_path) = explode('/', $path, 3);
    }


    function elab_data($data){
      echo var_dump($data);
    }


    function elab_request_data(){

      $path = $this->req['path'];
      $this->elab_path($path);

      unset($this->req['path']);

      $data = $this->req;
      $this->elab_data($data);
    }


    function handle($sub_uri, $data){

      $this->req = $sub_uri;
      $this->elab_request_data();

      echo $this->module;

      if( in_array($this->module, $this->modules) ){

        $class = '\modules\\'.$this->module.'\\view';
        $this->module = new $class();

        $method = $this->method;
        if( method_exists($this->module, $method) )
        {
          $this->module->$method($this->sub_path);
        }
        else
        {
          echo "module not loaded or not exists";
        }
      }else{
        echo file_get_contents(dirname(__file__) .'/'.$request);
      }

    }

  }

?>