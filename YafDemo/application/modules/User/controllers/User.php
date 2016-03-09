<?php


class UserController extends Base_Control {
    public function showAction(){
        var_dump($this->getRequest()->getParams());

        var_dump($_GET['uid']);
        echo "User showAction";
//        return false;
        $this->display('user/show');
        $this->display('show');

    }
    public function infoAction(){
        echo ini_get('yaf.environ');
        echo "info Action2343";
        //echo self::getRequest();

    }

    #分离action的做法
    public $actions=array(
        "userlist" => "modules/User/actions/UserList.php",
        "useradd" => "modules/User/actions/userAdd.php",
        "dummy" => "modules/User/actions/Dummy_action.php",
    );
}