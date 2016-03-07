<?php

class AjaxsignupAction extends Ap_Base_Action
{
    function execute()
    {

        $nickname = isset( $_POST['nickname'] ) ? trim($_POST['nickname']) : '';
        $username = isset( $_POST['username'] ) ? trim($_POST['username']) : '';
        $password = isset( $_POST['password'] ) ? md5("Mooc2013salt".$_POST['password']) : '';
	echo 111111;
        $school = $this->post('school', '');
        $admission = $this->post('admission', '5');
        $telephone = $this->post('telephone', '');
        if (empty($school))
        {
            $this->displayJson('', 4, '学校不能为空');
        }
        if (empty($major))
        {
            $this->displayJson('', 4, '专业不能为空');
        }
        if (!in_array($admission, array(0,1,2,3,4)))
        {
            $this->displayJson('', 4, '入学时间不合法');
        }
        $regTelephone= '/^\d{11}$/u';
        if (empty($telephone) || !preg_match ($regTelephone, $telephone))
        {
            $this->displayJson('', 4, '手机号码不符合规则');
        }
echo  "this jkj ";
        $registerService = new Ap_Common_RegisterService();
        $rawRegisterInfo = $registerService->register($nickname, $username, $password);
        $registerInfo = json_decode($rawRegisterInfo, true);
        $userService = new Ap_Service_Data_User();
        $uid = $registerInfo['data']['userInfo']['uid'];
        $userData = array(
            'phone' => $telephone,
            'email' => $username
        );

        $newInfos = $userService->SetUserInfo ($uid, $userData ); // 设置注册信息
        echo "this is my first list";
        echo "111111";
        if (!$newInfos)
        {
            $this->displayJson('', 4, '注册信息不符合规则');
        }
        $campusData = array(
            'uid' => $uid,
            'school' => $school,
            'admission' => $admission,
            'status' => 0
        );

        $campusDao = new Ap_Dao_ActivityCampus();
        $campusInfo = $campusDao->insertUser($campusData);

        if (!$campusInfo)
        {
            $this->displayJson('', 4, '注册信息不符合规则');
        }

        exit($rawRegisterInfo);

    }
}
