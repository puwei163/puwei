<?php

namespace Admin\Controller;


use Think\Controller;

class GoodsController extends BaseController
{
    protected $meta_title = '商品';

    public function _before_edit_view ()
    {
        //获取商品分类
        $GoodsCategory = D ( 'GoodsCategory' );
        $rows = $GoodsCategory->getList ();//获取一行
        $this->assign ( 'nodes' , json_encode ( $rows ) );
        //准备品牌数据,分配给页面
        $brand = D ( 'Brand' );
        $brands = $brand->getShowList ();
        $this->assign ( 'brands' , $brands );
        //准备供货商的数据,分配到页面
        $supplier = D ( 'Supplier' );
        $suppliers = $supplier->getShowList ();
        $this->assign ( 'supplier' , $suppliers );
        //准备会员价格数据
        $memberlevel = D ( 'MemberLevel' );
        $memberLevels = $memberlevel->getShowList ( 'id,name' );
        $this->assign ( 'memberLevels' , $memberLevels );

        //当编辑时
        $id = I ( 'get.id' );
        if ( ! empty( $id ) ) {
            //查询商品描述信息
            $goodsIntroModel = D ( 'GoodsIntro' );
            $intros = $goodsIntroModel->getFieldByGoods_id ( $id , 'intro' );
            $this->assign ( 'intro' , $intros );
            //准备当前对应的相册
            $goodsGalleryModel = D ( 'GoodsGallery' );
            $goodsGallerys = $goodsGalleryModel->getGalleryByGoods_id ( $id );
            $this->assign ( 'goodsGallerys' , $goodsGallerys );

            //>>4.3准备当前上面相关的文章数据
            $goodsArticleModel = D ( 'GoodsArticle' );
            $goodsAritcles = $goodsArticleModel->getArticleByGoodsId ( $id );
            $this->assign ( 'goodsAritcles' , $goodsAritcles );
            //>>4.4 根据商品的id将当前商品的会员价格查询出来
            $GoodsMemberPricemodel = D ( 'GoodsMemberPrice' );
            $goodsMemberPrice=$GoodsMemberPricemodel->getMemberPrice($id);
            $this->assign('goodsMemberPrice',$goodsMemberPrice);
        }

    }

    /**
     * 添加页面
     * 重写父类的方法,父类的ADD方法满足不了要求
     */
    public function add ()
    {
        if ( IS_POST ) {
            //获取数据
            if ( $this->model->create () !== false ) {//判断数据是否正确
                //插入数据库
                $requestData = I ( 'post.' );

                //通过第三个参数告知不额外处理
                $requestData[ 'intro' ] = I ( 'post.intro' , '' , false );
                if ( $this->model->add ( $requestData ) !== false ) {
                    $this->success ( '添加成功' , cookie ( '__forward__' ) );
                    return;//防止后面代码执行
                }
            }
            $this->error ( '操作错误' . showError ( $this->model ) );
        } else {
            //显示视图,调用钩子函数
            $this->_before_edit_view ();//给页面分配树的数据
            $this->assign ( 'meta_title' , '添加' . $this->meta_title );
            $this->display ( 'add' );
        }
    }

    public function edit ( $id )
    {

        if ( IS_POST ) {
            //获取数据
            if ( $this->model->create () !== false ) {//判断数据是否正确
                //插入数据库
                $requestData = I ( 'post.' );
                //通过第三个参数告知不额外处理
                $requestData[ 'intro' ] = I ( 'post.intro' , '' , false );
                if ( $this->model->save ( $requestData ) !== false ) {
                    $this->success ( '修改成功' , cookie ( '__forward__' ) );
                    return;//防止后面代码执行
                }
            }
            $this->error ( '修改失败' );
        } else {
            //调用钩子函数
            $this->_before_edit_view ();//给页面分配树的数据
            $row = $this->model->find ( $id );
            //页面分配数据
            $this->assign ( 'meta_title' , '编辑' . $this->meta_title );
            $this->assign ( 'row' , $row );
            $this->assign ( 'id' , $id );
            //加载视图
            $this->display ( 'add' );
        }
    }

    /**
     * 根据ID删除相册图片的数据
     * @param $gallery_id
     */
    public function deleteGallery ( $gallery_id )
    {

        $GoodsGalleryModel = D ( 'GoodsGallery' );
        $result = array ( 'success' => false );
        if ( $GoodsGalleryModel->delete ( $gallery_id ) !== false ) {
            $result[ 'success' ] = true;
        }
        $this->ajaxReturn ( $result );
    }
}
