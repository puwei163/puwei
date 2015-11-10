<?php

namespace Admin\Controller;


use Think\Controller;

class GoodsCategoryController extends BaseController
{
    protected $meta_title = '商品分类';

    /**
     * 显示列表页面
     */
    public function index ()
    {
        //使用模型中的getPageResult方法
        $rows = $this->model->getList ();
        //分配变量到页面
        $this->assign ( 'rows' , $rows );
        $this->assign ( 'meta_title' , $this->meta_title );
        //获取请求URL保存到Cookie里面,后面好使用
        cookie ( '__forward__' , $_SERVER[ 'REQUEST_URI' ] );
        //显示视图
        //获取请求URL保存到Cookie里面,后面好使用
        cookie ( '__forward__' , $_SERVER[ 'REQUEST_URI' ] );
        $this->display ( 'index' );
    }

    /**
     * 给页面准备数的数据
     */
    protected function _before_edit_view ()
    {
        $rows = $this->model->getList ();//获取一行
        $this->assign ( 'nodes' , json_encode ( $rows ) );
    }


}