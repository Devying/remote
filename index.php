<?php
$name = Ap_Common_Htmlpurifier::stylePurifier($_POST['name']);
        $credentials_num = Ap_Common_Htmlpurifier::stylePurifier($_POST['credentials_num']);
        $credentials_type = $_POST['credentials_type'];
        $phone = Ap_Common_Htmlpurifier::stylePurifier($_POST['phone']);
        $sex = $_POST['sex'];
        $age = Ap_Common_Htmlpurifier::stylePurifier($_POST['age']);
        $unit = Ap_Common_Htmlpurifier::stylePurifier($_POST['unit']);
        $major = Ap_Common_Htmlpurifier::stylePurifier($_POST['major']);
        echo 1123;
        $address =Ap_Common_Htmlpurifier::stylePurifier($_POST['address']);
        if($name==""||$credentials_num==""||$phone==""){
            $this->assign( 'step', "2");
            $this->assign( 'msg', "请填写好必填信息!");
            return;
        }
        $a="this is the first add a new line by huangbaoying@oasgames.com";
        $user_info=array();
        $_SESSION['name']=$name;
        $user_info['credentials_num']=$credentials_num;
        $user_info['phone']=$phone;
        $user_info['sex']=intval($sex);
        $user_info['age']=intval($age);
        echo 123123;
        $user_info['unit']=$unit;
        $user_info['major']=$major;
        $user_info['address']=$address;
        $_SESSION['reg_user_info']=$user_info;
?>
