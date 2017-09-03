<?php
/**
 * 后台首页
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Think\Controller;
class IndexController extends BaseController 
{
    /**
     * 管理员信息
     */
    public function index()
    {
        $condition['id'] = array('eq',$_SESSION['USER']['id']);
        $item = M('admin')->field(true)->where($condition)->find();
        $this->assign('item',$item);
        $this->display();
    }
    /**
     * 修改管理员信息
     */
    public function updateAdmin()
    {
        $data = I('post.');
        //如果密码为空的话代表不修改
        if($data['password'] != '') 
        {
            $data['password'] = md5(trim($data['password']));
        }else
        {
            unset($data['password']);
        }
        $data['update_time'] = date('Y-m-d H:i:s');
        $condition['id'] = array('eq',$data['id']);
        M('admin')->where($condition)->save($data);
        $this->success('操作成功',U('Admin/Index/index'));
    }
}