<?php
class IndexController extends Yaf_Controller_Abstract {
    public $actions = array(
        /** now dummyAction is defined in a separate file */
        "dummy" => "actions/Dummy_action.php",
        "userlist"=>"actions/UserList.php",
    );

    /* action method may have arguments */
    public function indexAction($name, $id) {
        assert($name == $this->getRequest()->getParam("name"));
        assert($id   == $this->_request->getParam("id"));
    }
}
?>