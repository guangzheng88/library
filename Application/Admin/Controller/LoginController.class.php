<?php
/**
 * 登录模块
 */
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller 
{
    /**
     * 登录页
     */
    public function index()
    {
        $this->display();
    }
    /**
     * 验证登录信息
     */
    public function submit()
    {
        //用户名或密码不可为空
        $username = trim(I('post.username'));
        $password = trim(I('post.password'));
        if(empty($username) || empty($password))
        {
            $this->error('用户名或密码错误');
        }
        //数据库查询用户是否存在
        $condition['username'] = array('eq',$username);
        $condition['password'] = array('eq',$password);
        $userInfo = M('admin')->where($condition)->field(true)->find();
        if(!$userInfo)
        {
            $this->error('用户名或密码错误');
        }
        //注册session
        $_SESSION['USER'] = $userInfo;
        //登录成功跳转到后台首页
        $this->success('登录成功',U('Admin/Index/index'));
    }
    /**
     * 退出登录
     */
    public function loginOut()
    {
        $_SESSION['USER'] = null;
        $this->redirect('Login/index');
    }
}