<?php

namespace Admin\Controller;


use Think\Controller;

class ArticleController extends BaseController
{
    protected $meta_title = '文章分类';

    //覆盖父类个钩子方法
    protected function _before_edit_view ()
    {
        //准备文章分类列表
        $articleCategoryModel = D ( 'articleCategory' );
        $articleCategorys = $articleCategoryModel->getShowList ();
        $this->assign ( 'articleCategorys' , $articleCategorys );
    }

    /**
     * 根据传过来的值查询文章
     * @param $keyword
     */

    public function search ( $keyword )
    {
        $articleModel=D('Article');
        $whers=array();
        $whers['name']=array('like',"%".$keyword."%");
        $rows=$articleModel->getShowList('id,name',$whers);
        $this->ajaxReturn($rows);
    }
}