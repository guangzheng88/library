<?php
/**
 * 权限模块
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Think\Controller;
class PermissionsController extends BaseController 
{
    /**
     * 权限列表
     */
    public function roleList()
    {
        //查询总数
        $count = M('permissions')->order('id desc')->count();
        $Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('first','首页');
        $Page->setConfig('last','尾页');
        $show = $Page->show();// 分页显示输出
        $role = M('permissions')->field(true)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$role);
        $this->assign('page',$show);
        $this->display();
    }
    /**
     * 权限详细信息
     */
    public function detail()
    {
        $id = I('id',0,'intval');
        if($id != 0)
        {
            $roleInfo = M('permissions')->where(array('id'=>$id))->find();
            $this->assign('item',$roleInfo);
        }
        $this->display();
    }
    /**
     * 添加权限
     */
    public function addRole()
    {
        $data = I('post.');
        $res = M('permissions')->data($data)->add();
        $result['success'] = true;
        $this->ajaxReturn($result);
    }
    /**
     * 修改权限
     */
    public function updateRole()
    {
        $id = I('id',0,'intval');
        $condition['id'] = array('eq',$id);
        $data = I('post.');
        M('permissions')->data($data)->where($condition)->save();
        $result['success'] = true;
        $this->ajaxReturn($result);
    }
}