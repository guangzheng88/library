<?php
/**
 * 后台控制基类
 */
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller 
{
    /**
     * 初始化方法
     */
    public function _initialize()
    {
        //dump($_SESSION['USER']);exit;
        $userinfo = $_SESSION['USER'];
        if(empty($userinfo['id']))
        {
            $this->error('登录失败或登录超时',U('Admin/Login/index'));
        }
    }
}