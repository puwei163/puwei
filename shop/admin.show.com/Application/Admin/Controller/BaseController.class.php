<?php
/**
 * Created by PhpStorm.
 * User: weizi
 * Date: 2015/10/31
 * Time: 16:53
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{
    /**
     * 保存model模型类
     * @var Model
     */
    protected $model;
    public function _initialize(){
         //创建模型
        $this->model = D ( CONTROLLER_NAME );
    }
    /**
     * 显示列表页面
     */
    public function index ()
    {
        $wheres=array();
        $keyword=I('get.keyword');
        if(!empty($keyword)){
            $wheres['name']=array('like',"%$keyword%");
        }

        //使用模型中的getPageResult方法
        $rows = $this->model->getPageResult ($wheres);
        //分配变量到页面
        $this->assign ( $rows );
        $this->assign('meta_title',$this->meta_title);
        //获取请求URL保存到Cookie里面,后面好使用
        cookie ( '__forward__' , $_SERVER[ 'REQUEST_URI' ] );
        //显示视图
        $this->display ( 'index' );

    }

    /**
     * 添加页面
     */
    public function add ()
    {
        if ( IS_POST ) {

            //获取数据

            if (  $this->model->create () !== false ) {//判断数据是否正确
                //插入数据库
                if (  $this->model->add () !== false ) {
                    $this->success ( '添加成功' , cookie( '__forward__' ));
                    return;//防止后面代码执行
                }
            }
            $this->error ( '操作错误' . showError (  $this->model ) );
        } else {
            //显示视图,调用钩子函数
            $this->_before_edit_view();//给页面分配树的数据
            $this->assign ( 'meta_title' ,'添加'.$this->meta_title );
            $this->display ( 'add' );
        }
    }

    /**
     * 定义一个空函数
     */
protected function _before_edit_view(){
}

    public function edit ( $id )
    {

        if ( IS_POST ) {
            //获取数据
            if (  $this->model->create () !== false ) {//判断数据是否正确
                if (  $this->model->save () !== false ) {
                    $this->success ( '修改成功' , cookie ( '__forward__' ) );
                    return;//防止后面代码执行
                }
            }
            $this->error ( '修改失败' );
        } else {
            //调用钩子函数
            $this->_before_edit_view();//给页面分配树的数据
            $row =  $this->model->find ( $id );
            //页面分配数据
            $this->assign ( 'meta_title' , '编辑'.$this->meta_title);
            $this->assign ( 'row' , $row );
            $this->assign('id',$id);
            //加载视图
            $this->display ( 'add' );

        }

    }

    /**
     * 通过ID删除
     * 只是删除状态
     * $status 如果没有传就是-1
     * @param $id
     * @param $status
     */
    public function changeStatus ( $id , $status = - 1 )
    {
        //调用model的删除方法已ID删除
        $result =  $this->model->changeStatus ( $id , $status );
        if ( $result !== false ) {//判断是否删除成功
            $this->success ( '操作成功' , cookie ( '__forward__' ));
        } else {
            $this->error ( '操作失败' );
        }
    }
}
