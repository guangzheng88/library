<?php
/**
 * 图书模块
 */
namespace Admin\Controller;
use Admin\Controller\BaseController;
use Think\Controller;
class BookController extends BaseController 
{
    /**
     * 图书列表
     */
    public function bookList()
    {
        //查询总数
        $count = M('book')->order('id desc')->count();
        $Page = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev','上一页');
        $Page->setConfig('next','下一页');
        $Page->setConfig('first','首页');
        $Page->setConfig('last','尾页');
        $show = $Page->show();// 分页显示输出
        $role = M('book')->field(true)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$role);
        $this->assign('page',$show);
        $this->display();
    }
    /**
     * 图书详细信息
     */
    public function detail()
    {
        $id = I('id',0,'intval');
        if($id != 0)
        {
            $bookInfo = M('book')->where(array('id'=>$id))->find();
            $this->assign('item',$bookInfo);
        }
        $this->display();
    }
    /**
     * 添加图书
     */
    public function addBook()
    {
        $data = I('post.');
        $data['create_time'] = date('Y-m-d H:i:s');
        $res = M('book')->data($data)->add();
        $result['success'] = true;
        $this->ajaxReturn($result);
    }
    /**
     * 修改图书
     */
    public function updateBook()
    {
        $id = I('id',0,'intval');
        $condition['id'] = array('eq',$id);
        $data = I('post.');
        M('book')->data($data)->where($condition)->save();
        $result['success'] = true;
        $this->ajaxReturn($result);
    }
    /**
     * 删除
     */
    public function deleteBook()
    {
        $id = I('id',0,'intval');
        $condition['id'] = array('eq',$id);
        M('book')->where($condition)->delete();
        $this->redirect('Book/bookList');
    }
}