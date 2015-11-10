<?php
/**
 * Created by PhpStorm.
 * User: weizi
 * Date: 2015/11/9
 * Time: 20:35
 */

namespace Admin\Model;


use Think\Model;

class GoodsGalleryModel extends Model
{
    /**
     * 根据商品ID查询相册图片
     * @param $goods_id
     */
    public function getGalleryByGoods_id($goods_id){
        return $this->field('id,path')->where(array('goods_id'=>$goods_id))->select();
    }
}