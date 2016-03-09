<?php
echo "<pre>";
print_r($_SERVER);
error_reporting(E_ALL);
define('ROOT_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
ini_set('yaf.library',ROOT_PATH."application/library");
$application = new Yaf_Application( ROOT_PATH . "conf/application.ini");

try {
    $application->bootstrap ()->run ();
}catch (Exception $ex){
    $message = $ex->getMessage();
    var_dump($message);

    if (ini_get('display_errors')) {
        $message .= '<br>'. nl2br($ex->getTraceAsString());
        echo $message;
    } elseif ($_SERVER['REQUEST_URI'] != '/error/wrong') {
        header('Location:/error/noexists');
        exit;
    }
}
?>
