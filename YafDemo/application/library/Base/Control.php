<?php

class Base_Control extends Yaf_Controller_Abstract{

    public function init(){
        $actions=$this->actions;

        echo "<pre>";
        print_r($actions);

        $action=$this->_request->action;
        if(isset($actions[$action])){
            //echo $actions[$action];
        }else{
            echo "bad gateway";
        }
        //print_r($this->_request);

    }
}