<?php
namespace Admin\Model;


use Think\Model;

class GoodsModel extends BaseModel
{
    // 自动验证定义
    protected $_validate11 = array (
        array ( 'name' , 'require' , '名称不能够为空!' ) ,
        array ( 'goods_category_id' , 'require' , '父分类不能够为空!' ) ,
        array ( 'brand_id' , 'require' , '品牌不能够为空!' ) ,
        array ( 'supplier_id' , 'require' , '供货商不能够为空!!' ) ,
        array ( 'shop_price' , 'require' , '本店价格不能够为空!' ) ,
        array ( 'market_price' , 'require' , '市场价格不能够为空!' ) ,
        array ( 'stock' , 'require' , '库存不能够为空!' ) ,
        array ( 'is_on_sale' , 'require' , '是否上架不能够为空!' ) ,
        array ( 'goods_status' , 'require' , '商品状态不能够为空!' ) ,
        array ( 'keyword' , 'require' , '关键字不能够为空!' ) ,
        array ( 'logo' , 'require' , 'LOGO不能够为空!' ) ,
        array ( 'status' , 'require' , '状态不能够为空!' ) ,
        array ( 'sort' , 'require' , '排序不能够为空!' ) ,
    );

    /**
     * 重写方法
     * $requestData 接收使用post的参数
     */
    public function add ( $requestData )
    {

        $this->startTrans (); //开始事物
        //处理商品状态,转换为一个整数
        $this->handleGoodsStatus ();
        $id = parent::add ();//调用父类的添加方法得到ID
        if ( $id === false ) {
            $this->rollback ();//如果插入失败不提交事物
            return false;
        }
        //根据ID计算出货号 ,
        $sn = date ( 'Ymd' ) . str_pad ( $id , 8 , '0' , STR_PAD_LEFT );
        $result = parent::save ( array ( 'sn' => $sn , 'id' => $id ) );
        if ( $result === false ) {
            $this->rollback ();//如果插入失败不提交事物
            return false;
        }

        //处理商品描述
        $result = $this->handleGoodsIntro ( $id , $requestData[ 'intro' ] );
        if ( $result === false ) {
            return false;
        }
        //处理相册
        $result = $this->handleGoodsGallery ( $id , $requestData[ 'gallery_path' ] );
        if ( $result === false ) {
            return false;
        }
        //处理相关文章
        $result = $this->handleGoodsArticle ( $id , $requestData[ 'article_id' ] );
        if ( $result === false ) {
            return false;
        }
        //准备添加会员价格的
        $this->handleGoodsMemberPrice ( $id , $requestData[ 'memberPrice' ] );

        $this->commit ();//保存成功提交事物
        return $id;//保存成功返回ID
    }

    /**
     * 根据请求中的数据更新
     */
    public function save ( $requestData )
    {
        $this->startTrans (); //开始事物
        //计算商品状态
        $this->handleGoodsStatus ();


        //处理简介
        $result = $this->handleGoodsIntro ( $this->data[ 'id' ] , $requestData[ 'intro' ] );
        if ( $result === false ) {
            return false;
        }
        //处理相册
        $result = $this->handleGoodsGallery ( $this->data[ 'id' ] , $requestData[ 'gallery_path' ] );
        if ( $result === false ) {
            return false;
        }
        //处理关联文章
        $result = $this->handleGoodsArticle ( $this->data[ 'id' ] , $requestData[ 'article_id' ] );
        if ( $result === false ) {
            return false;
        }

        //调用父类的更新数据
        $result = parent::save ();
        if ( $result === false ) {
            $this->rollback ();//如果插入失败不提交事物
            return false;
        }

        $this->commit ();//保存成功提交事物
        return $result;//保存成功返回状态

    }

    private function handleGoodsMemberPrice ( $goods_id , $memberPrices )
    {
        $rows = array ();
        foreach ( $memberPrices as $member_level_id=>$price ) {
            $rows[] = array ( 'goods_id' => $goods_id , 'member_level_id' => $member_level_id,'price'=>$price );
        }
        $goodsmemberpriceModel = M ( 'GoodsMemberPrice' );
        //先删除在更新
        $goodsmemberpriceModel->where ( array ( 'goods_id' => $goods_id ) )->delete ();
        if ( ! empty( $rows ) ) {
            $result = $goodsmemberpriceModel->addAll ( $rows );
            if ( $result === false ) {
                $this->rollback ();
                $this->error = '保存相关文章失败!';
                return false;
            }
        }

    }

    /**
     * 根据用户传过来的值,计算商品状态,是一个整数
     */
    private function handleGoodsStatus ()
    {
        $goods_status = 0;
        foreach ( $this->data[ 'goods_status' ] as $v ) {
            $goods_status = $goods_status | $v; // 相与之后得到状态
        }
        $this->data[ 'goods_status' ] = $goods_status;

    }

    /**
     * 处理商品简介
     * @param $goods_id 商品ID
     * @param $intro 商品简介
     * @return bool
     */
    private function handleGoodsIntro ( $goods_id , $intro )
    {
        $introMode = M ( 'GoodsIntro' );
        //首先删除在插入,在保存新的,没有就不删除就是
        $introMode->where ( array ( 'goods_id' => $goods_id ) )->delete ();
        //根据商品ID插入数据到商品描述表里面
        $result = $introMode->add ( array ( 'goods_id' => $goods_id , 'intro' => $intro ) );
        if ( $result === false ) {
            $this->rollback ();//如果插入失败不提交事物
            $this->error = '保存商品失败!';
            return false;
        }
    }

    /**
     * 将用户上传上来的图片保存到goods_gallery中
     * @param $goods_id 商品ID
     * @param $gallery_paths 相册路劲
     */
    public function handleGoodsGallery ( $goods_id , $gallery_paths )
    {
        $rows = array ();
        foreach ( $gallery_paths as $gallery_path ) {
            $rows[] = array ( 'goods_id' => $goods_id , 'path' => $gallery_path );
        }

        $goods_gallery = M ( 'GoodsGallery' );
        if ( ! empty( $rows ) ) {
            $result = $goods_gallery->addAll ( $rows );
            if ( $result === false ) {
                $this->rollback ();//如果插入失败不提交事物
                $this->error = '保存相册失败!';
                return false;
            }
        }
    }

    /**
     * 保存文章
     * @param $id
     * @param $article_ids
     * @return bool
     */
    private function handleGoodsArticle ( $id , $article_ids )
    {
        $rows = array ();
        foreach ( $article_ids as $article_id ) {
            $rows[] = array ( 'goods_id' => $id , 'article_id' => $article_id );
        }

        $goodsArticleModel = M ( 'GoodsArticle' );
        //先删除在更新
        $goodsArticleModel->where ( array ( 'goods_id' => $id ) )->delete ();
        if ( ! empty( $rows ) ) {

            $result = $goodsArticleModel->addAll ( $rows );
            if ( $result === false ) {
                $this->rollback ();
                $this->error = '保存相关文章失败!';
                return false;
            }
        }
    }
}