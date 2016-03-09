<?php
echo 111;
echo 222;
echo 333;
/**
 * Created by PhpStorm.
 * User: Xiaot
 * Date: 2014/12/5
 * Time: 14:15
 */

class CampuslistAction extends Ap_Base_Action
{
    public function execute() {
echo 111111;        
Yaf_Dispatcher::getInstance()->disableView();
        $uid = $this->getUid();

        if( $uid < 1 ){
            header('location: /activity/signup');
            exit();
        }
	echo 444;
        $role_type = intval( Ap_Service_Data_Loginuser::UserRole() );
        if ( !in_array($role_type, array(1,2,3,4) ) ){
            header('location: /activity/signup');
            exit();
        }
        echo 23333;
        $pageSize = 15;
        $page = $this->post('page', 1);

        $reg_type_name = array("移动端", "web端", "后台生成", "wap端");

        $campusDao = new Ap_Dao_ActivityCampus();
        $campusData = $campusDao->getUserList( '', $page, $pageSize );
        //var_dump($campusData);
        if (!empty($campusData['data']))
        {
            foreach ($campusData['data'] as $val)
            {
                $userIds[] = $val['uid'];
            }
            $userDao = new Ap_Dao_User();
            $userChannelDatas = $userDao->getChannelByUids($userIds);
            //var_dump($userChannelDatas);
            $userService = new Ap_Service_Data_User();
            $fields = array('nickname', 'email', 'phone', 'reg_time', 'reg_type');
            $userDatas = $userService->GetUserInfos($userIds, $fields);
            //var_dump($userDatas);
            $userExtService = new Ap_Service_Data_UserExt();
            echo 11111;
            foreach ($campusData['data'] as &$val)
            {
                if (!empty($userChannelDatas))
                {
                    foreach ($userChannelDatas as $userChannelData)
                    {
                        if ($val['uid'] == $userChannelData['uid'])
                        {
                            //var_dump($userChannelData['channel']);
                            $result = $userDao->getChannelByCid($userChannelData['channel']);
                            $val['channel'] = $result['channel_name'];
                        }
                    }
                }
            echo "abcdefg12344234";
            echo "123123124141";
            echo "234nfhj234215";
                foreach ($userDatas as $userData)
                {
                    {
                        $val['nickname'] = htmlspecialchars($userData['nickname'],ENT_QUOTES,"utf-8");
                        $val['phone'] = $userData['phone'];
                        $val['reg_time'] = date('Y-m-d H:i:s', $userData['reg_time']);

                        $val['reg_type'] = $reg_type_name[$userData['reg_type']];
                    }
                }
                $val['school'] = htmlspecialchars($val['school'],ENT_QUOTES,"utf-8");
                $val['major'] = htmlspecialchars($val['major'],ENT_QUOTES,"utf-8");
                $last_longintime = $userExtService->getUserCount($val['uid'], 'last_logintime');
                $val['last_logintime'] = date('Y-m-d H:i:s', $last_longintime['last_logintime']);
            }
            echo 1111;
            echo 34523462;
            $this->_view->assign('data', $campusData);
        }
        $count = $campusData['count'];
	$name ="this is add new line in  by huangbaoying@oasgames.com";

        $this->assign('pageHtml', $pageHtml);

        echo 123123123;
        $this->_view->display ( "campus/be-signup.phtml" );
    }
}
