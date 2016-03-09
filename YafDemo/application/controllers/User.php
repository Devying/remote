<?php


class UserController extends Yaf_Controller_Abstract {
    public function indexAction(){
        echo "User indexAction";
        return false;
    }

    public function showAction(){
        echo "Index User showAction";
        return false;
    }
    public $actions =array(
        "info"=>"actions/Info.php",
    );
}