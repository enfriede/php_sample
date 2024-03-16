<?php

  namespace modules\contact;


  class view extends \views\BaseView {

    function __construct(){
      parent::__construct();

      $this->dir = dirname(__file__);
      $this->tpls = $this->dir.'/templates';

      foreach( scandir($this->tpls) as $f ){
        if (!in_array($f, array(".",".."))){
          $this->templates[$f] = file_get_contents($this->tpls.'/'.$f);
        }
      }

    }


    function index($args){

      echo $this->render('contacts.html', ['name' => 'Contacts']);
    }

  }

?>
